<?php
/* ----------------------------------------------------------------------
   $Id: backup.php,v 1.17 2003/04/29 06:24:52 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: backup.php,v 1.54 2002/10/27 18:43:35 dgw_
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  require('includes/system.php');
  
  if (!isset($_SESSION['user_id'])) {
    $_SESSION['navigation']->set_snapshot();
    owpRedirect(owpLink($owpFilename['login'], '', 'SSL'));
  } 
   
  require(OWP_LANGUAGES_DIR . $language . '/' . $owpFilename['backup']);

  if ($_GET['action']) {
    switch ($_GET['action']) {
      case 'forget':
        $db->Execute("delete from " . $owpDBTable['configuration'] . " where configuration_key = 'DB_LAST_RESTORE'");
        $messageStack->add_session(SUCCESS_LAST_RESTORE_CLEARED, 'success');
        owpRedirect(owpLink($owpFilename['backup']));
        break;
      case 'backupnow':
        owpSetTimeLimit(0);
        $schema = '# OSIS WebPrinter for your Homepage' . "\n" .
                  '# http://www.osisnet.de' . "\n" .
                  '#' . "\n" .
                  '# Database Backup For ' . OWP_NAME . "\n" . 
                  '# Copyright (c) ' . date('Y') . ' ' . OWP_OWNER . "\n" .
                  '#' . "\n" .
                  '# Database: ' . OWP_DB_DATABASE . "\n" .
                  '# Database Server: ' . OWP_DB_SERVER . "\n" . 
                  '#' . "\n" .
                  '# Backup Date: ' . date(PHP_DATE_TIME_FORMAT) . "\n\n";
        $tables_query = $db->Execute('show tables');
        while ($tables = $tables_query->fields) {
          list(,$table) = each($tables);
          $schema .= 'drop table if exists ' . $table . ';' . "\n" .
                     'create table ' . $table . ' (' . "\n";
          $table_list = array();
          $fields_query = $db->Execute("show fields from " . $table);
          while ($fields = $fields_query->fields) {
            $table_list[] = $fields['Field'];
            $schema .= '  ' . $fields['Field'] . ' ' . $fields['Type'];
            if (strlen($fields['Default']) > 0) $schema .= ' default \'' . $fields['Default'] . '\'';
            if ($fields['Null'] != 'YES') $schema .= ' not null';
            if (isset($fields['Extra'])) $schema .= ' ' . $fields['Extra'];
            $schema .= ',' . "\n";
            $fields_query->MoveNext();
          }
          $schema = ereg_replace(",\n$", '', $schema);

          // Add the keys
          $index = array();
          $keys_query = $db->Execute("show keys from " . $table);
          while ($keys = $keys_query->fields) {
            $kname = $keys['Key_name'];
            if (!isset($index[$kname])) {
              $index[$kname] = array('unique' => !$keys['Non_unique'],
                                     'columns' => array());
            }
            $index[$kname]['columns'][] = $keys['Column_name'];
            $keys_query->MoveNext();
          }
          while (list($kname, $info) = each($index)) {
            $schema .= ',' . "\n";
            $columns = implode($info['columns'], ', ');
            if ($kname == 'PRIMARY') {
              $schema .= '  PRIMARY KEY (' . $columns . ')';
            } elseif ($info['unique']) {
              $schema .= '  UNIQUE ' . $kname . ' (' . $columns . ')';
            } else {
              $schema .= '  KEY ' . $kname . ' (' . $columns . ')';
            }
          }
          $schema .= "\n" . ');' . "\n\n";

          // Dump the data
          $rows_query = $db->Execute("select " . implode(',', $table_list) . " from " . $table);
          while ($rows = $rows_query->fields) {
            $schema_insert = 'insert into ' . $table . ' (' . implode(', ', $table_list) . ') values (';
            reset($table_list);
            while (list(,$i) = each($table_list)) {
              if (!isset($rows[$i])) {
                $schema_insert .= 'NULL, ';
              } elseif ($rows[$i] != '') {
                $row = addslashes($rows[$i]);
                $row = ereg_replace("\n#", "\n".'\#', $row);
                $schema_insert .= '\'' . $row . '\', ';
              } else {
                $schema_insert .= '\'\', ';
              }
            }
            $schema_insert = ereg_replace(', $', '', $schema_insert) . ');' . "\n";
            $schema .= $schema_insert;
            $rows_query->MoveNext();
          }
          $schema .= "\n";
          $tables_query->MoveNext();
        }

        if ($_POST['download'] == 'yes') {
          $backup_file = 'db_' . DB_DATABASE . '-' . date('YmdHis') . '.sql';
          switch ($_POST['compress']) {
            case 'no':
              header('Content-type: application/x-octet-stream');
              header('Content-disposition: attachment; filename=' . $backup_file);
              echo $schema;
              exit;
              break;
            case 'gzip':
              if ($fp = fopen(DIR_FS_BACKUP . $backup_file, 'w')) {
                fputs($fp, $schema);
                fclose($fp);
                exec(LOCAL_EXE_GZIP . ' ' . DIR_FS_BACKUP . $backup_file);
                $backup_file .= '.gz';
              }
              if ($fp = fopen(DIR_FS_BACKUP . $backup_file, 'rb')) {
                $buffer = fread($fp, filesize(DIR_FS_BACKUP . $backup_file));
                fclose($fp);
                unlink(DIR_FS_BACKUP . $backup_file);
                header('Content-type: application/x-octet-stream');
                header('Content-disposition: attachment; filename=' . $backup_file);
                echo $buffer;
                exit;
              }
              break;
            case 'zip':
              if ($fp = fopen(DIR_FS_BACKUP . $backup_file, 'w')) {
                fputs($fp, $schema);
                fclose($fp);
                exec(LOCAL_EXE_ZIP . ' -j ' . DIR_FS_BACKUP . $backup_file . '.zip ' . DIR_FS_BACKUP . $backup_file);
                unlink(DIR_FS_BACKUP . $backup_file);
                $backup_file .= '.zip';
              }
              if ($fp = fopen(DIR_FS_BACKUP . $backup_file, 'rb')) {
                $buffer = fread($fp, filesize(DIR_FS_BACKUP . $backup_file));
                fclose($fp);
                unlink(DIR_FS_BACKUP . $backup_file);
                header('Content-type: application/x-octet-stream');
                header('Content-disposition: attachment; filename=' . $backup_file);
                echo $buffer;
                exit;
              }
          }
        } else {
          $backup_file = DIR_FS_BACKUP . 'db_' . DB_DATABASE . '-' . date('YmdHis') . '.sql';
          if ($fp = fopen($backup_file, 'w')) {
            fputs($fp, $schema);
            fclose($fp);
            switch ($_POST['compress']) {
              case 'gzip':
                exec(LOCAL_EXE_GZIP . ' ' . $backup_file);
                break;
              case 'zip':
                exec(LOCAL_EXE_ZIP . ' -j ' . $backup_file . '.zip ' . $backup_file);
                unlink($backup_file);
            }
          }
          $messageStack->add_session(SUCCESS_DATABASE_SAVED, 'success');
        }
        owpRedirect(owpLink($owpFilename['backup']));
        break;
      case 'restorenow':
      case 'restorelocalnow':
        owpSetTimeLimit(0);

        if ($_GET['action'] == 'restorenow') {
          $read_from = $_GET['file'];
          if (file_exists(DIR_FS_BACKUP . $_GET['file'])) {
            $restore_file = DIR_FS_BACKUP . $_GET['file'];
            $extension = substr($_GET['file'], -3);
            if ( ($extension == 'sql') || ($extension == '.gz') || ($extension == 'zip') ) {
              switch ($extension) {
                case 'sql':
                  $restore_from = $restore_file;
                  $remove_raw = false;
                  break;
                case '.gz':
                  $restore_from = substr($restore_file, 0, -3);
                  exec(LOCAL_EXE_GUNZIP . ' ' . $restore_file . ' -c > ' . $restore_from);
                  $remove_raw = true;
                  break;
                case 'zip':
                  $restore_from = substr($restore_file, 0, -4);
                  exec(LOCAL_EXE_UNZIP . ' ' . $restore_file . ' -d ' . DIR_FS_BACKUP);
                  $remove_raw = true;
              }

              if ( ($restore_from) && (file_exists($restore_from)) && (filesize($restore_from) > 15000) ) {
                $fd = fopen($restore_from, 'rb');
                $restore_query = fread($fd, filesize($restore_from));
                fclose($fd);
              }
            }
          }
        } elseif ($_GET['action'] == 'restorelocalnow') {
          $sql_file = owpGetUploadedFile('sql_file');

          if (is_uploaded_file($sql_file['tmp_name'])) {
            $restore_query = fread(fopen($sql_file['tmp_name'], 'r'), filesize($sql_file['tmp_name']));
            $read_from = $sql_file['name'];
          }
        }

        if ($restore_query) {
          $sql_array = array();
          $sql_length = strlen($restore_query);
          $pos = strpos($restore_query, ';');
          for ($i=$pos; $i<$sql_length; $i++) {
            if ($restore_query[0] == '#') {
              $restore_query = ltrim(substr($restore_query, strpos($restore_query, "\n")));
              $sql_length = strlen($restore_query);
              $i = strpos($restore_query, ';')-1;
              continue;
            }
            if ($restore_query[($i+1)] == "\n") {
              for ($j=($i+2); $j<$sql_length; $j++) {
                if (trim($restore_query[$j]) != '') {
                  $next = substr($restore_query, $j, 6);
                  if ($next[0] == '#') {
// find out WHERE the break position is so we can remove this line (#comment line)
                    for ($k=$j; $k<$sql_length; $k++) {
                      if ($restore_query[$k] == "\n") break;
                    }
                    $query = substr($restore_query, 0, $i+1);
                    $restore_query = substr($restore_query, $k);
// join the query before the comment appeared, with the rest of the dump
                    $restore_query = $query . $restore_query;
                    $sql_length = strlen($restore_query);
                    $i = strpos($restore_query, ';')-1;
                    continue 2;
                  }
                  break;
                }
              }
              if ($next == '') { // get the last insert query
                $next = 'insert';
              }
              if ( (eregi('create', $next)) || (eregi('insert', $next)) || (eregi('drop t', $next)) ) {
                $next = '';
                $sql_array[] = substr($restore_query, 0, $i);
                $restore_query = ltrim(substr($restore_query, $i+1));
                $sql_length = strlen($restore_query);
                $i = strpos($restore_query, ';')-1;
              }
            }
          }

          $db->Execute("drop table if exists address_book, address_format, banners, banners_history, categories, categories_description, configuration, configuration_group, counter, counter_history, countries, currencies, customers, customers_basket, customers_basket_attributes, customers_info, languages, manufacturers, manufacturers_info, orders, orders_products, orders_status, orders_status_history, orders_products_attributes, orders_products_download, products, products_attributes, products_attributes_download, prodcts_description, products_options, products_options_values, products_options_values_to_products_options, products_to_categories, reviews, reviews_description, sessions, specials, tax_class, tax_rates, geo_zones, whos_online, zones, zones_to_geo_zones");
          for ($i = 0, $n = sizeof($sql_array); $i < $n; $i++) {
            $db->Execute($sql_array[$i]);
          }

          $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'DB_LAST_RESTORE'");
          $db->Execute("insert into " . TABLE_CONFIGURATION . " values ('', 'Last Database Restore', 'DB_LAST_RESTORE', '" . $read_from . "', 'Last database restore file', '6', '', '', now(), '', '')");

          if ($remove_raw) {
            unlink($restore_from);
          }
        }

        $messageStack->add_session(SUCCESS_DATABASE_RESTORED, 'success');
        owpRedirect(owpLink($owpFilename['backup']));
        break;
      case 'download':
        $extension = substr($_GET['file'], -3);
        if ( ($extension == 'zip') || ($extension == '.gz') || ($extension == 'sql') ) {
          if ($fp = fopen(DIR_FS_BACKUP . $_GET['file'], 'rb')) {
            $buffer = fread($fp, filesize(DIR_FS_BACKUP . $_GET['file']));
            fclose($fp);
            header('Content-type: application/x-octet-stream');
            header('Content-disposition: attachment; filename=' . $_GET['file']);
            echo $buffer;
            exit;
          }
        } else {
          $messageStack->add(ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE, 'error');
        }
        break;
      case 'deleteconfirm':
        if (strstr($_GET['file'], '..')) owpRedirect(owpLink($owpFilename['backup']));

        owpRemove(DIR_FS_BACKUP . '/' . $_GET['file']);
        if (!$owpRemoveError) {
          $messageStack->add_session(SUCCESS_BACKUP_DELETED, 'success');
          owpRedirect(owpLink($owpFilename['backup']));
        }
        break;
    }
  }

// check if the backup directory exists
  $dir_ok = false;
  if (is_dir(owpGetLocalPath(DIR_FS_BACKUP))) {
    $dir_ok = true;
    if (!is_writeable(owpGetLocalPath(DIR_FS_BACKUP))) $messageStack->add(ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE, 'error');
  } else {
    $messageStack->add(ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST, 'error');
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo OWP_NAME . ' :: ' . TITLE; ?></title>
<META NAME="AUTHOR" CONTENT="OSIS GmbH">
<META NAME="GENERATOR" CONTENT="OSIS GmbH -- http://www.osisnet.de">
<META NAME="ROBOTS" content="NOFOLLOW">
<link rel="StyleSheet" href="style/style.css" type="text/css" />
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(OWP_INCLUDES_DIR . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(OWP_INCLUDES_DIR . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td class="owp-title"><?php echo HEADING_TITLE; ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TITLE; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_FILE_DATE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_FILE_SIZE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  if ($dir_ok) {
    $dir = dir(DIR_FS_BACKUP);
    $contents = array();
    while ($file = $dir->read()) {
      if (!is_dir(DIR_FS_BACKUP . $file)) {
        $contents[] = $file;
      }
    }
    sort($contents);

    for ($files = 0, $count = sizeof($contents); $files < $count; $files++) {
      $entry = $contents[$files];

      $check = 0;

      if (((!$_GET['file']) || ($_GET['file'] == $entry)) && (!$buInfo) && ($_GET['action'] != 'backup') && ($_GET['action'] != 'restorelocal')) {
        $file_array['file'] = $entry;
        $file_array['date'] = date(PHP_DATE_TIME_FORMAT, filemtime(DIR_FS_BACKUP . $entry));
        $file_array['size'] = number_format(filesize(DIR_FS_BACKUP . $entry)) . ' bytes';
        switch (substr($entry, -3)) {
          case 'zip': $file_array['compression'] = 'ZIP'; break;
          case '.gz': $file_array['compression'] = 'GZIP'; break;
          default: $file_array['compression'] = TEXT_NO_EXTENSION; break;
        }

        $buInfo = new objectInfo($file_array);
      }

      if (is_object($buInfo) && ($entry == $buInfo->file)) {
        echo '              <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'">' . "\n";
        $onclick_link = 'file=' . $buInfo->file . '&action=restore';
      } else {
        echo '              <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'">' . "\n";
        $onclick_link = 'file=' . $entry;
      }
?>
                <td class="dataTableContent" onclick="document.location.href='<?php echo owpLink($owpFilename['backup'], $onclick_link); ?>'"><?php echo '<a href="' . owpLink($owpFilename['backup'], 'action=download&file=' . $entry) . '">' . owpImage(OWP_ICONS_DIR . 'file_download.gif', ICON_FILE_DOWNLOAD) . '</a>&nbsp;' . $entry; ?></td>
                <td class="dataTableContent" align="center" onclick="document.location.href='<?php echo owpLink($owpFilename['backup'], $onclick_link); ?>'"><?php echo date(PHP_DATE_TIME_FORMAT, filemtime(DIR_FS_BACKUP . $entry)); ?></td>
                <td class="dataTableContent" align="right" onclick="document.location.href='<?php echo owpLink($owpFilename['backup'], $onclick_link); ?>'"><?php echo number_format(filesize(DIR_FS_BACKUP . $entry)); ?> bytes</td>
                <td class="dataTableContent" align="right"><?php if ( (is_object($buInfo)) && ($entry == $buInfo->file) ) { echo owpImage(OWP_IMAGES_DIR . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . owpLink($owpFilename['backup'], 'file=' . $entry) . '">' . owpImage(OWP_IMAGES_DIR . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
    $dir->close();
  }
?>
              <tr>
                <td class="smallText" colspan="3"><?php echo TEXT_BACKUP_DIRECTORY . ' ' . DIR_FS_BACKUP; ?></td>
                <td align="right" class="smallText"><?php if ( ($_GET['action'] != 'backup') && ($dir) ) echo '<a href="' . owpLink($owpFilename['backup'], 'action=backup') . '">' . owpImageButton('button_backup.gif', IMAGE_BACKUP) . '</a>'; if ( ($_GET['action'] != 'restorelocal') && ($dir) ) echo '&nbsp;&nbsp;<a href="' . owpLink($owpFilename['backup'], 'action=restorelocal') . '">' . owpImageButton('button_restore.gif', IMAGE_RESTORE) . '</a>'; ?></td>
              </tr>
<?php
  if (defined('DB_LAST_RESTORE')) {
?>
              <tr>
                <td class="smallText" colspan="4"><?php echo TEXT_LAST_RESTORATION . ' ' . DB_LAST_RESTORE . ' <a href="' . owpLink($owpFilename['backup'], 'action=forget') . '">' . TEXT_FORGET . '</a>'; ?></td>
              </tr>
<?php
  }
?>
            </table></td>
<?php
  $heading = array();
  $contents = array();
  switch ($_GET['action']) {
    case 'backup':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_BACKUP . '</b>');

      $contents = array('form' => owpDrawForm('backup', $owpFilename['backup'], 'action=backupnow'));
      $contents[] = array('text' => TEXT_INFO_NEW_BACKUP);

      if ($messageStack->size > 0) {
        $contents[] = array('text' => '<br>' . tep_draw_radio_field('compress', 'no', true) . ' ' . TEXT_INFO_USE_NO_COMPRESSION);
        $contents[] = array('text' => '<br>' . tep_draw_radio_field('download', 'yes', true) . ' ' . TEXT_INFO_DOWNLOAD_ONLY . '*<br><br>*' . TEXT_INFO_BEST_THROUGH_HTTPS);
      } else {
        $contents[] = array('text' => '<br>' . tep_draw_radio_field('compress', 'gzip', true) . ' ' . TEXT_INFO_USE_GZIP);
        $contents[] = array('text' => tep_draw_radio_field('compress', 'zip') . ' ' . TEXT_INFO_USE_ZIP);
        $contents[] = array('text' => tep_draw_radio_field('compress', 'no') . ' ' . TEXT_INFO_USE_NO_COMPRESSION);
        $contents[] = array('text' => '<br>' . owpCheckboxField('download', 'yes') . ' ' . TEXT_INFO_DOWNLOAD_ONLY . '*<br><br>*' . TEXT_INFO_BEST_THROUGH_HTTPS);
      }

      $contents[] = array('align' => 'center', 'text' => '<br>' . owpImageSubmit('button_backup.gif', IMAGE_BACKUP) . '&nbsp;<a href="' . owpLink($owpFilename['backup']) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'restore':
      $heading[] = array('text' => '<b>' . $buInfo->date . '</b>');

      $contents[] = array('text' => owpBreakString(sprintf(TEXT_INFO_RESTORE, DIR_FS_BACKUP . (($buInfo->compression != TEXT_NO_EXTENSION) ? substr($buInfo->file, 0, strrpos($buInfo->file, '.')) : $buInfo->file), ($buInfo->compression != TEXT_NO_EXTENSION) ? TEXT_INFO_UNPACK : ''), 35, ' '));
      $contents[] = array('align' => 'center', 'text' => '<br><a href="' . owpLink($owpFilename['backup'], 'file=' . $buInfo->file . '&action=restorenow') . '">' . owpImageButton('button_restore.gif', IMAGE_RESTORE) . '</a>&nbsp;<a href="' . owpLink($owpFilename['backup'], 'file=' . $buInfo->file) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'restorelocal':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_RESTORE_LOCAL . '</b>');

      $contents = array('form' => owpDrawForm('restore', $owpFilename['backup'], 'action=restorelocalnow', 'post', 'enctype="multipart/form-data"'));
      $contents[] = array('text' => TEXT_INFO_RESTORE_LOCAL . '<br><br>' . TEXT_INFO_BEST_THROUGH_HTTPS);
      $contents[] = array('text' => '<br>' . owpFileField('sql_file'));
      $contents[] = array('text' => TEXT_INFO_RESTORE_LOCAL_RAW_FILE);
      $contents[] = array('align' => 'center', 'text' => '<br>' . owpImageSubmit('button_restore.gif', IMAGE_restore) . '&nbsp;<a href="' . owpLink($owpFilename['backup']) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . $buInfo->date . '</b>');

      $contents = array('form' => owpDrawForm('delete', $owpFilename['backup'], 'file=' . $buInfo->file . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $buInfo->file . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . owpImageSubmit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . owpLink($owpFilename['backup'], 'file=' . $buInfo->file) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (is_object($buInfo)) {
        $heading[] = array('text' => '<b>' . $buInfo->date . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . owpLink($owpFilename['backup'], 'file=' . $buInfo->file . '&action=restore') . '">' . owpImageButton('button_restore.gif', IMAGE_RESTORE) . '</a> <a href="' . owpLink($owpFilename['backup'], 'file=' . $buInfo->file . '&action=delete') . '">' . owpImageButton('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_INFO_DATE . ' ' . $buInfo->date);
        $contents[] = array('text' => TEXT_INFO_SIZE . ' ' . $buInfo->size);
        $contents[] = array('text' => '<br>' . TEXT_INFO_COMPRESSION . ' ' . $buInfo->compression);
      }
      break;
  }

  if ( (owpNotNull($heading)) && (owpNotNull($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(OWP_INCLUDES_DIR . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(OWP_INCLUDES_DIR . 'nice_exit.php'); ?>
