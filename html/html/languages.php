<?php
/* ----------------------------------------------------------------------
   $Id: languages.php,v 1.17 2003/04/30 15:30:32 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: languages.php,v 1.32 2002/03/17 17:37:51 harley_vb
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
  
  require(OWP_LANGUAGES_DIR . $language . '/' . $owpFilename['languages']);

  switch ($_GET['action']) {
    case 'setflag':
      owpSetLanguageStatus($_GET['id'], $_GET['flag']);
      owpRedirect(owpLink($owpFilename['languages'], 'page=' . $_GET['page']));
      break;
    case 'insert':
      $langsequence = OWP_DB_PREFIX . '_sequence_languages';
      $langid = $db->GenID($langsequence);
      $sql = "INSERT INTO " . $owpDBTable['languages'] . " 
             (languages_id,
              name, 
              iso_639_2, 
              iso_639_1, 
              sort_order) 
              VALUES (" . $db->qstr($langid) . ','
                        . $db->qstr($name) . ','
                        . $db->qstr($iso_639_2) . ','
                        . $db->qstr($iso_639_1) . ','
                        . $db->qstr($sort_order) . ")";
      $db->Execute($sql);
      if ($_POST['default'] == 'on') {
        $db->Execute("UPDATE " . $owpDBTable['configuration'] . " 
	                 SET configuration_value = " . $db->qstr($iso_639_2) . "
                       WHERE configuration_key = 'DEFAULT_LANGUAGE'");
      }

      owpRedirect(owpLink($owpFilename['languages'], 'page=' . $_GET['page'] . '&lID=' . $langid));
      break;
    case 'save':
      $db->Execute("UPDATE " . $owpDBTable['languages'] . " 
	                 SET name = " . $db->qstr($name) . ",
	                     iso_639_2 = " . $db->qstr($iso_639_2) . ",
	                     iso_639_1 = " . $db->qstr($iso_639_1) . ",
	                     sort_order = " . $db->qstr($sort_order) . "
                       WHERE languages_id = '" . $_GET['lID'] . "'");                      
      if ($_POST['default'] == 'on') {
        $db->Execute("UPDATE " . $owpDBTable['configuration'] . " 
	                 SET configuration_value = " . $db->qstr($iso_639_2) . "
                       WHERE configuration_key = 'DEFAULT_LANGUAGE'");
        owpSetLanguageStatus($_GET['lID'], '1');
      }
      owpRedirect(owpLink($owpFilename['languages'], 'page=' . $_GET['page'] . '&lID=' . $_GET['lID']));
      break;
    case 'deleteconfirm':
      $sql = "SELECT languages_id 
              FROM " . $owpDBTable['languages'] . " 
              WHERE iso_639_2 = '" . DEFAULT_LANGUAGE . "'";
      $lng_query = $db->Execute($sql);
      $lng = $lng_query->fields;
      if ($lng['languages_id'] == $lID) {
        $db->Execute("UPDATE " . $owpDBTable['configuration'] . " 
                         SET configuration_value = '' 
                       WHERE configuration_key = 'DEFAULT_LANGUAGE'");
      }
      $db->Execute("DELETE FROM " . $owpDBTable['languages'] . " WHERE languages_id = '" . $_GET['lID'] . "'");
      owpRedirect(owpLink($owpFilename['languages'], 'page=' . $_GET['page']));
      break;
    case 'delete':
      $lng_query = $db->Execute("SELECT iso_639_2 FROM " . $owpDBTable['languages'] . " WHERE languages_id = '" . $_GET['lID'] . "'");
      $lng = $lng_query->fields;

      $remove_language = true;
      if ($lng['iso_639_2'] == DEFAULT_LANGUAGE) {
        $remove_language = false;
        $messageStack->add(ERROR_REMOVE_DEFAULT_LANGUAGE, 'error');
      }
      break;
    case 'download':
      $db_table_file = 'db_' . $owpDBTable['languages'] . '-' . date('YmdHis') . '.csv'; 
      $file = fopen (OWP_CSV_TEMP . $db_table_file, "a+");
      $sql = "SELECT languages_id, name, iso_639_2, 
                     iso_639_1, active, sort_order 
              FROM " . $owpDBTable['languages'] . " 
            ORDER BY sort_order";
      $rs = $db->Execute($sql);
      $rs->MoveFirst();
      rs2csvfile($rs, $file);
      fclose($file);
  
      if (CVS_SEND_MAIL == 'true') {
        $sql = "SELECT admin_gender, admin_firstname, admin_lastname, admin_email_address 
                FROM " . $owpDBTable['administrators'] . " 
                WHERE admin_id = '" . owpDBInput($_SESSION['user_id']) . "'";
        $mail_query = $db->Execute($sql);
        $mail_send_to = $mail_query->fields;
        // Let's build a message object using the email class
        $send_mail = new phpmailer();
        $send_mail->From = OWP_OWNER_EMAIL_ADDRESS;
        $send_mail->FromName = OWP_NAME;
        $send_mail->Subject = EMAIL_LANG_CVS . strftime(DATE_FORMAT_LONG);
        if ($mail_send_to['admin_gender'] == 'm') {
          $body = EMAIL_GREET_MR . $mail_send_to['admin_lastname'] . ',' . "\n\n";
        } else {
          $body = EMAIL_GREET_MS . $mail_send_to['admin_lastname'] . ',' . "\n\n";
        }    
        $body .= EMAIL_CVS_INTRO . ' ' . strftime(DATE_FORMAT_LONG) . "\n\n";
        $body .= EMAIL_FTP_INFO . "\n";
        $body .= '         ' . $db_table_file . "\n\n";
        $body .= EMAIL_FOOT; 
   
        $send_mail->Body = $body;
        $send_mail->AddAddress($mail_send_to['admin_email_address'], $mail_send_to['admin_firstname'] . ' ' . $mail_send_to['admin_lastname']);
        $send_mail->AddAttachment(OWP_CSV_TEMP . $db_table_file);
        $send_mail->Send();
        // Clear all addresses and attachments for next loop
        $send_mail->ClearAddresses();
        $send_mail->ClearAttachments();
        $messageStack->add_session(sprintf(SUCCESS_CVS_LANG_SENT, $mail_send_to['admin_email_address']), 'notice');          
      }
      // download
      if (CVS_DOWNLOAD == 'true') {
        $fp = fopen(OWP_CSV_TEMP . $db_table_file, 'r');     
	$buffer = fread($fp, filesize(OWP_CSV_TEMP . $db_table_file));
	fclose($fp);
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename="' . $db_table_file . '"');
	header('Expires: 0');
	header('Pragma: no-cache');
	echo $buffer;
      }
      if (CVS_DELETE_FILE == 'true') {
        @ unlink(OWP_CSV_TEMP . $db_table_file);
      }
      owpRedirect(owpLink($owpFilename['languages'], 'page=' . $_GET['page']));
      break;

  }
  
  $breadcrumb->add(NAVBAR_TITLE,  owpLink($owpFilename['languages'], '', 'NONSSL'));
  
  if (OWP_CSV_EXCEL == 'true') {
    $dir_ok = false;
    if (is_dir(owpGetLocalPath(OWP_CSV_TEMP))) {
      $dir_ok = true;
      if (!is_writeable(owpGetLocalPath(OWP_CSV_TEMP))) $messageStack->add(ERROR_CSV_TEMP_DIRECTORY_NOT_WRITEABLE, 'error');
    } else {
      $messageStack->add(ERROR_CSV_TEMP_DIRECTORY_DOES_NOT_EXIST, 'error');
    }
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
<script type="text/javascript" src="javascript/general.php"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" onload="SetFocus();">
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
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_LANGUAGE_NAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_LANGUAGE_ISO_639_2; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_LANGUAGE_ISO_639_1; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_LANGUAGE_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $languages_query_raw = "select languages_id, name, iso_639_2, iso_639_1, active, sort_order from " . $owpDBTable['languages'] . " order by sort_order";
  $languages_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $languages_query_raw, $languages_query_numrows);
  $languages_query = $db->Execute($languages_query_raw);
  while ($languages = $languages_query->fields) {
    if (((!$_GET['lID']) || (@$_GET['lID'] == $languages['languages_id'])) && (!$lInfo) && (substr($_GET['action'], 0, 3) != 'new')) {
      $lInfo = new objectInfo($languages);
    }

    if ( (is_object($lInfo)) && ($languages['languages_id'] == $lInfo->languages_id) ) {
      echo '                  <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . owpLink($owpFilename['languages'], 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id . '&action=edit') . '\'">' . "\n";
    } else {
      echo '                  <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . owpLink($owpFilename['languages'], 'page=' . $_GET['page'] . '&lID=' . $languages['languages_id']) . '\'">' . "\n";
    }

    if (DEFAULT_LANGUAGE == $languages['iso_639_2']) {
      echo '                <td class="dataTableContent"><b>' . $languages['name'] . ' (' . TEXT_DEFAULT . ')</b></td>' . "\n";
    } else {
      echo '                <td class="dataTableContent">' . $languages['name'] . '</td>' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $languages['iso_639_2']; ?></td>
                <td class="dataTableContent"><?php echo $languages['iso_639_1']; ?></td>
                <td class="dataTableContent" align="right">
<?php
      if ($languages['active'] == '1') {
        echo owpImage(OWP_ICONS_DIR . 'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . owpLink($owpFilename['languages'], 'action=setflag&flag=0&id=' . $languages['languages_id'] . '&page=' . $page, 'NONSSL') . '">' . owpImage(OWP_ICONS_DIR . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
      } else {
        echo '<a href="' . owpLink($owpFilename['languages'], 'action=setflag&flag=1&id=' . $languages['languages_id'] . '&page=' . $page, 'NONSSL') . '">' . owpImage(OWP_ICONS_DIR . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . owpImage(OWP_ICONS_DIR . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
      }
?>
                </td>
                <td class="dataTableContent" align="right"><?php if ((is_object($lInfo)) && ($languages['languages_id'] == $lInfo->languages_id)) { echo owpImage(OWP_ICONS_DIR . 'icon_arrow_right.gif'); } else { echo '<a href="' . owpLink($owpFilename['languages'], 'page=' . $_GET['page'] . '&lID=' . $languages['languages_id']) . '">' . owpImage(OWP_ICONS_DIR . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    $languages_query->MoveNext();
  }
?>
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $languages_split->display_count($languages_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_LANGUAGES); ?></td>
                    <td class="smallText" align="right"><?php echo $languages_split->display_links($languages_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>

<?php
  if (!$_GET['action']) {
?>
                  <tr>
                    <td align="right"><?php if (OWP_CSV_EXCEL == 'true') { echo '<a href="' . owpLink($owpFilename['languages'], 'page=' . $_GET['page'] . '&action=download') . '">' . owpImageButton('excel_now.gif', IMAGE_CSV_DOWNLOAD) . '</a>'; } ?></td>
                    <td align="right"><?php echo '<a href="' . owpLink($owpFilename['languages'], 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id . '&action=new') . '">' . owpImageButton('button_new_language.gif', IMAGE_NEW_LANGUAGE) . '</a>'; ?></td>
                  </tr>
<?php
  }
?>
                </table></td>
              </tr>
            </table></td>
<?php
  $direction_options = array( array('id' => '', 'text' => TEXT_INFO_LANGUAGE_DIRECTION_DEFAULT),
                              array('id' => 'ltr', 'text' => TEXT_INFO_LANGUAGE_DIRECTION_LEFT_TO_RIGHT),
                              array('id' => 'rtl', 'text' => TEXT_INFO_LANGUAGE_DIRECTION_RIGHT_TO_LEFT));

  $heading = array();
  $contents = array();
  switch ($_GET['action']) {
    case 'new':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_LANGUAGE . '</b>');

      $contents = array('form' => owpDrawForm('languages', $owpFilename['languages'], 'action=insert'));
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_INFO_LANGUAGE_NAME . '<br>' . owpInputField('name'));
      $contents[] = array('text' => '<br>' . TEXT_INFO_LANGUAGE_ISO_639_2 . '<br>' . owpInputField('iso_639_2'));
      $contents[] = array('text' => '<br>' . TEXT_INFO_LANGUAGE_ISO_639_1 . '<br>' . owpInputField('iso_639_1'));
      $contents[] = array('text' => '<br>' . TEXT_INFO_LANGUAGE_SORT_ORDER . '<br>' . owpInputField('sort_order'));
      $contents[] = array('text' => '<br>' . owpCheckboxField('default') . ' ' . TEXT_SET_DEFAULT);
      $contents[] = array('align' => 'center', 'text' => '<br>' . owpImageSubmit('button_insert.gif', IMAGE_INSERT) . ' <a href="' . owpLink($owpFilename['languages'], 'page=' . $_GET['page'] . '&lID=' . $_GET['lID']) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_LANGUAGE . '</b>');

      $contents = array('form' => owpDrawForm('languages', $owpFilename['languages'], 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id . '&action=save'));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_INFO_LANGUAGE_NAME . '<br>' . owpInputField('name', $lInfo->name));
      $contents[] = array('text' => '<br>' . TEXT_INFO_LANGUAGE_ISO_639_2 . '<br>' . owpInputField('iso_639_2', $lInfo->iso_639_2));
      $contents[] = array('text' => '<br>' . TEXT_INFO_LANGUAGE_ISO_639_1 . '<br>' . owpInputField('iso_639_1', $lInfo->iso_639_1));
      $contents[] = array('text' => '<br>' . TEXT_INFO_LANGUAGE_SORT_ORDER . '<br>' . owpInputField('sort_order', $lInfo->sort_order));
      if (DEFAULT_LANGUAGE != $lInfo->iso_639_2) $contents[] = array('text' => '<br>' . owpCheckboxField('default') . ' ' . TEXT_SET_DEFAULT);
      $contents[] = array('align' => 'center', 'text' => '<br>' . owpImageSubmit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . owpLink($owpFilename['languages'], 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_LANGUAGE . '</b>');

      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $lInfo->name . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . (($remove_language) ? '<a href="' . owpLink($owpFilename['languages'], 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id . '&action=deleteconfirm') . '">' . owpImageButton('button_delete.gif', IMAGE_DELETE) . '</a>' : '') . ' <a href="' . owpLink($owpFilename['languages'], 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (is_object($lInfo)) {
        $heading[] = array('text' => '<b>' . $lInfo->name . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . owpLink($owpFilename['languages'], 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id . '&action=edit') . '">' . owpImageButton('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . owpLink($owpFilename['languages'], 'page=' . $_GET['page'] . '&lID=' . $lInfo->languages_id . '&action=delete') . '">' . owpImageButton('button_delete.gif', IMAGE_DELETE) . '</a> <a href="' . owpLink($owpFilename['define_language'], 'lngdir=' . $lInfo->iso_639_2) . '">' . owpImageButton('button_define.gif', IMAGE_DEFINE) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_INFO_LANGUAGE_NAME . ' ' . $lInfo->name);
        $contents[] = array('text' => TEXT_INFO_LANGUAGE_ISO_639_2 . ' ' . $lInfo->iso_639_2);
        $contents[] = array('text' => '<br>' . owpImage(OWP_LANGUAGES_DIR . $lInfo->iso_639_2 . '/images/icon.gif', $lInfo->name));
        $contents[] = array('text' => '<br>' . TEXT_INFO_LANGUAGE_DIRECTORY . '<br>' . OWP_LANGUAGES_DIR . '<b>' . $lInfo->iso_639_2 . '</b>');
        $contents[] = array('text' => '<br>' . TEXT_INFO_LANGUAGE_SORT_ORDER . ' ' . $lInfo->sort_order);
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