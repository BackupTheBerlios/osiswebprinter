<?php
/* ----------------------------------------------------------------------
   $Id: file_manager.php,v 1.15 2003/04/26 06:35:58 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: file_manager.php,v 1.37 2002/08/19 01:45:23 hpdl
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
 
  require(OWP_LANGUAGES_DIR . $language . '/' . $owpFilename['file_manager']);

  if (!isset($_SESSION['current_path'])) {
    $_SESSION['current_path'] = OWP_ROOT_PATH;
  }
  if (!empty($_GET['goto'])) {
    $_SESSION['current_path'] = $_GET['goto'];
    owpRedirect(owpLink($owpFilename['file_manager']));
  }
  $current_path = $_SESSION['current_path'];

  if (strstr($current_path, '..')) $current_path = OWP_ROOT_PATH;

  if (!is_dir($current_path)) $current_path = OWP_ROOT_PATH;

  if (!ereg('^' . OWP_ROOT_PATH, $current_path)) $current_path = OWP_ROOT_PATH;

  if ($_GET['action']) {
    switch ($_GET['action']) {
      case 'reset':
	$_SESSION['current_path'] = OWP_ROOT_PATH;
        owpRedirect(owpLink($owpFilename['file_manager']));
        break;
      case 'deleteconfirm':
        if (strstr($_GET['info'], '..')) owpRedirect(owpLink($owpFilename['file_manager']));

        owpRemove($current_path . '/' . $_GET['info']);
        if (!$owpRemoveError) owpRedirect(owpLink($owpFilename['file_manager']));
        break;
      case 'insert':
        if (mkdir($current_path . '/' . $_POST['folder_name'], 0777)) {
          owpRedirect(owpLink($owpFilename['file_manager'], 'info=' . urlencode($_POST['folder_name'])));
        }
        break;
      case 'save':
        if ($fp = fopen($current_path . '/' . $_POST['filename'], 'w+')) {
          fputs($fp, stripslashes($_POST['file_contents']));
          fclose($fp);
          owpRedirect(owpLink($owpFilename['file_manager'], 'info=' . urlencode($_POST['filename'])));
        }
        break;
      case 'processuploads':
        $_current_path = owpGetLocalPath($current_path);

        if (!is_writeable($_current_path)) {
          if (is_dir($_current_path)) {
            $messageStack->add_session(sprintf(ERROR_DIRECTORY_NOT_WRITEABLE, $_current_path), 'error');
          } else {
            $messageStack->add_session(sprintf(ERROR_DIRECTORY_DOES_NOT_EXIST, $_current_path), 'error');
          }
        } else {
          for ($i=1; $i<6; $i++) {
            $file = owpGetUploadedFile('file_' . $i);

            if (is_uploaded_file($file['tmp_name'])) {
              owpCopyUploadedFile($file, $_current_path);
            }
          }
        }
        owpRedirect(owpLink($owpFilename['file_manager']));
        break;
      case 'download':
        header('Content-type: application/x-octet-stream');
        header('Content-disposition: attachment; filename=' . urldecode($_GET['filename']));
        readfile($current_path . '/' . urldecode($_GET['filename']));
        exit;
        break;
      case 'upload':
      case 'new_folder':
      case 'new_file':
        $directory_writeable = true;
        if (!is_writeable($current_path)) {
          $directory_writeable = false;
          $messageStack->add(sprintf(ERROR_DIRECTORY_NOT_WRITEABLE, $current_path), 'error');
        }
        break;
      case 'edit':
        if (strstr($_GET['info'], '..')) owpRedirect(owpLink($owpFilename['file_manager']));

        $file_writeable = true;
        if (!is_writeable($current_path . '/' . $_GET['info'])) {
          $file_writeable = false;
          $messageStack->add(sprintf(ERROR_FILE_NOT_WRITEABLE, $current_path . '/' . $_GET['info']), 'error');
        }
        break;
      case 'delete':
        if (strstr($_GET['info'], '..')) owpRedirect(owpLink($owpFilename['file_manager']));
        break;
    }
  }

  $in_directory = substr(substr(OWP_ROOT_PATH, strrpos(OWP_ROOT_PATH, '/')), 1);
  $current_path_array = explode('/', $current_path);
  $document_root_array = explode('/', OWP_ROOT_PATH);
  $goto_array = array(array('id' => OWP_ROOT_PATH, 'text' => $in_directory));
  for ($i=0; $i<sizeof($current_path_array); $i++) {
    if ($current_path_array[$i] != $document_root_array[$i]) {
      $goto_array[] = array('id' => implode('/', owpArraySlice($current_path_array, 0, $i+1)), 'text' => $current_path_array[$i]);
    }
  }
  $breadcrumb->add(NAVBAR_TITLE,  owpLink($owpFilename['file_manager'], '', 'NONSSL'));
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
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr><?php echo owpDrawForm('goto', $owpFilename['file_manager'], '', 'get'); ?>
            <td class="owp-title"><?php echo HEADING_TITLE . '<br><span class="smallText">' . $current_path . '</span>'; ?></td>
            <td class="owp-title" align="right"><?php echo owpTransLine('1', '10'); ?></td>
            <td class="owp-title" align="right"><?php echo owpPullDownMenu('goto', $goto_array, $current_path, 'onChange="this.form.submit();"'); ?></td>
          </form></tr>
        </table></td>
      </tr>
<?php
  if ( ($directory_writeable) && ($_GET['action'] == 'new_file') || ($_GET['action'] == 'edit') ) {
    if (strstr($_GET['info'], '..')) owpRedirect(owpLink($owpFilename['file_manager']));

    if (!isset($file_writeable)) $file_writeable = true;
    $file_contents = '';
    if ($_GET['action'] == 'new_file') {
      $filename_input_field = owpInputField('filename');
    } elseif ($_GET['action'] == 'edit') {
      if ($file_array = file($current_path . '/' . $_GET['info'])) {
        $file_contents = htmlspecialchars(implode('', $file_array));
      }
      $filename_input_field = $_GET['info'] . owpDrawHiddenField('filename', $_GET['info']);
    }
?>
      <tr>
        <td><?php echo owpTransLine('1', '10'); ?></td>
      </tr>
      <tr><?php echo owpDrawForm('new_file', $owpFilename['file_manager'], 'action=save'); ?>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo TEXT_FILE_NAME; ?></td>
            <td class="main"><?php echo $filename_input_field; ?></td>
          </tr>
          <tr>
            <td class="main" valign="top"><?php echo TEXT_FILE_CONTENTS; ?></td>
            <td class="main"><?php echo owpTextareaField('file_contents', 'soft', '80', '20', $file_contents, (($file_writeable) ? '' : 'readonly')); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo owpTransLine('1', '10'); ?></td>
          </tr>
          <tr>
            <td align="right" class="main" colspan="2"><?php if ($file_writeable) echo owpImageSubmit('button_save.gif', IMAGE_SAVE) . '&nbsp;'; echo '<a href="' . owpLink($owpFilename['file_manager'], 'info=' . urlencode($_GET['info'])) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
          </tr>
        </table></td>
      </form></tr>
<?php
  } else {
    $showuser = (function_exists('posix_getpwuid') ? true : false);
    $contents = array();
    $dir = dir($current_path);
    while ($file = $dir->read()) {
      if ( ($file != '.') && ($file != 'CVS') && ( ($file != '..') || ($current_path != OWP_ROOT_PATH) ) ) {
        $file_size = number_format(filesize($current_path . '/' . $file)) . ' bytes';

        $permissions = owpGetFilePermissions(fileperms($current_path . '/' . $file));
        if ($showuser) {
          $user = @posix_getpwuid(fileowner($current_path . '/' . $file));
          $group = @posix_getgrgid(filegroup($current_path . '/' . $file));
        } else {
          $user = $group = array();
        }

        $contents[] = array('name' => $file,
                            'is_dir' => is_dir($current_path . '/' . $file),
                            'last_modified' => strftime(DATE_TIME_FORMAT, filemtime($current_path . '/' . $file)),
                            'size' => $file_size,
                            'permissions' => $permissions,
                            'user' => $user['name'],
                            'group' => $group['name']);
      }
    }

    function owpCmp($a, $b) {
      return strcmp( ($a['is_dir'] ? 'D' : 'F') . $a['name'], ($b['is_dir'] ? 'D' : 'F') . $b['name']);
    }
    usort($contents, 'owpCmp');
?>

      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_FILENAME; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_SIZE; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_PERMISSIONS; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_USER; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_GROUP; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_LAST_MODIFIED; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  for ($i=0; $i<sizeof($contents); $i++) {
    if (((!$_GET['info']) || (@$_GET['info'] == $contents[$i]['name'])) && (!$fInfo) && ($_GET['action'] != 'upload') && ($_GET['action'] != 'new_folder') ) {
      $fInfo = new objectInfo($contents[$i]);
    }

    if ($contents[$i]['name'] == '..') {
      $goto_link = substr($current_path, 0, strrpos($current_path, '/'));
    } else {
      $goto_link = $current_path . '/' . $contents[$i]['name'];
    }

    if ( (is_object($fInfo)) && ($contents[$i]['name'] == $fInfo->name) ) {
      if ($fInfo->is_dir) {
        echo '              <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'">' . "\n";
        $onclick_link = 'goto=' . $goto_link;
      } else {
        echo '              <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'">' . "\n";
        $onclick_link = 'info=' . urlencode($fInfo->name) . '&action=edit';
      }
    } else {
      echo '              <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'">' . "\n";
      $onclick_link = 'info=' . urlencode($contents[$i]['name']);
    }

    if ($contents[$i]['is_dir']) {
      if ($contents[$i]['name'] == '..') {
        $icon = owpImage(OWP_ICONS_DIR . 'previous_level.gif', ICON_PREVIOUS_LEVEL);
      } else {
        $icon = ((is_object($fInfo)) && ($contents[$i]['name'] == $fInfo->name) ? owpImage(OWP_ICONS_DIR . 'current_folder.gif', ICON_CURRENT_FOLDER) : owpImage(OWP_ICONS_DIR . 'folder.gif', ICON_FOLDER));
      }
      $link = owpLink($owpFilename['file_manager'], 'goto=' . $goto_link);
    } else {
      $icon = owpImage(OWP_ICONS_DIR . 'file_download.gif', ICON_FILE_DOWNLOAD);
      $link = owpLink($owpFilename['file_manager'], 'action=download&filename=' . urlencode($contents[$i]['name']));
    }
?>
                <td class="dataTableContent" onclick="document.location.href='<?php echo owpLink($owpFilename['file_manager'], $onclick_link); ?>'"><?php echo '<a href="' . $link . '">' . $icon . '</a>&nbsp;' . $contents[$i]['name']; ?></td>
                <td class="dataTableContent" align="right" onclick="document.location.href='<?php echo owpLink($owpFilename['file_manager'], $onclick_link); ?>'"><?php echo ($contents[$i]['is_dir'] ? '&nbsp;' : $contents[$i]['size']); ?></td>
                <td class="dataTableContent" align="center" onclick="document.location.href='<?php echo owpLink($owpFilename['file_manager'], $onclick_link); ?>'"><tt><?php echo $contents[$i]['permissions']; ?></tt></td>
                <td class="dataTableContent" onclick="document.location.href='<?php echo owpLink($owpFilename['file_manager'], $onclick_link); ?>'"><?php echo $contents[$i]['user']; ?></td>
                <td class="dataTableContent" onclick="document.location.href='<?php echo owpLink($owpFilename['file_manager'], $onclick_link); ?>'"><?php echo $contents[$i]['group']; ?></td>
                <td class="dataTableContent" align="center" onclick="document.location.href='<?php echo owpLink($owpFilename['file_manager'], $onclick_link); ?>'"><?php echo $contents[$i]['last_modified']; ?></td>
                <td class="dataTableContent" align="right"><?php if ($contents[$i]['name'] != '..') echo '<a href="' . owpLink($owpFilename['file_manager'], 'info=' . urlencode($contents[$i]['name']) . '&action=delete') . '">' . owpImage(OWP_ICONS_DIR . 'delete.gif', ICON_DELETE) . '</a>&nbsp;'; if (is_object($fInfo) && ($fInfo->name == $contents[$i]['name'])) { echo owpImage(OWP_IMAGES_DIR . 'icon_arrow_right.gif'); } else { echo '<a href="' . owpLink($owpFilename['file_manager'], 'info=' . urlencode($contents[$i]['name'])) . '">' . owpImage(OWP_IMAGES_DIR . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
              <tr>
                <td colspan="7"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr valign="top">
                    <td class="smallText"><?php echo '<a href="' . owpLink($owpFilename['file_manager'], 'action=reset') . '">' . owpImageButton('button_reset.gif', IMAGE_RESET) . '</a>'; ?></td>
                    <td class="smallText" align="right"><?php echo '<a href="' . owpLink($owpFilename['file_manager'], 'info=' . urlencode($_GET['info']) . '&action=upload') . '">' . owpImageButton('button_upload.gif', IMAGE_UPLOAD) . '</a>&nbsp;<a href="' . owpLink($owpFilename['file_manager'], 'info=' . urlencode($_GET['info']) . '&action=new_file') . '">' . owpImageButton('button_new_file.gif', IMAGE_NEW_FILE) . '</a>&nbsp;<a href="' . owpLink($owpFilename['file_manager'], 'info=' . urlencode($_GET['info']) . '&action=new_folder') . '">' . owpImageButton('button_new_folder.gif', IMAGE_NEW_FOLDER) . '</a>'; ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php
    $heading = array();
    $contents = array();
    switch ($_GET['action']) {
      case 'delete':
        $heading[] = array('text' => '<b>' . $fInfo->name . '</b>');

        $contents = array('form' => owpDrawForm('file', $owpFilename['file_manager'], 'info=' . urlencode($fInfo->name) . '&action=deleteconfirm'));
        $contents[] = array('text' => TEXT_DELETE_INTRO);
        $contents[] = array('text' => '<br><b>' . $fInfo->name . '</b>');
        $contents[] = array('align' => 'center', 'text' => '<br>' . owpImageSubmit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . owpLink($owpFilename['file_manager'], 'info=' . urlencode($fInfo->name)) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
        break;
      case 'new_folder':
        $heading[] = array('text' => '<b>' . TEXT_NEW_FOLDER . '</b>');

        $contents = array('form' => owpDrawForm('folder', $owpFilename['file_manager'], 'action=insert'));
        $contents[] = array('text' => TEXT_NEW_FOLDER_INTRO);
        $contents[] = array('text' => '<br>' . TEXT_NEW_FOLDER_NAME . '<br>' . owpInputField('folder_name'));
        $contents[] = array('align' => 'center', 'text' => '<br>' . (($directory_writeable) ? owpImageSubmit('button_save.gif', IMAGE_SAVE) : '') . ' <a href="' . owpLink($owpFilename['file_manager'], 'info=' . urlencode($_GET['info'])) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
        break;
      case 'upload':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_UPLOAD . '</b>');

        $contents = array('form' => owpDrawForm('file', $owpFilename['file_manager'], 'action=processuploads', 'post', 'enctype="multipart/form-data"'));
        $contents[] = array('text' => TEXT_UPLOAD_INTRO);
        for ($i=1; $i<6; $i++) $file_upload .= owpFileField('file_' . $i) . '<br>';
        $contents[] = array('text' => '<br>' . $file_upload);
        $contents[] = array('align' => 'center', 'text' => '<br>' . (($directory_writeable) ? owpImageSubmit('button_upload.gif', IMAGE_UPLOAD) : '') . ' <a href="' . owpLink($owpFilename['file_manager'], 'info=' . urlencode($_GET['info'])) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
        break;
      default:
        if (is_object($fInfo)) {
          $heading[] = array('text' => '<b>' . $fInfo->name . '</b>');

          if (!$fInfo->is_dir) $contents[] = array('align' => 'center', 'text' => '<a href="' . owpLink($owpFilename['file_manager'], 'info=' . urlencode($fInfo->name) . '&action=edit') . '">' . owpImageButton('button_edit.gif', IMAGE_EDIT) . '</a>');
          $contents[] = array('text' => '<br>' . TEXT_FILE_NAME . ' <b>' . $fInfo->name . '</b>');
          if (!$fInfo->is_dir) $contents[] = array('text' => '<br>' . TEXT_FILE_SIZE . ' <b>' . $fInfo->size . '</b>');
          $contents[] = array('text' => '<br>' . TEXT_LAST_MODIFIED . ' ' . $fInfo->last_modified);
        }
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
<?php
  }
?>
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
