<?php
/* ----------------------------------------------------------------------
   $Id: countries.php,v 1.5 2003/04/25 07:06:20 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: countries.php,v 1.25 2002/03/17 17:34:47 harley_vb
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  require('includes/system.php');

  if ($_GET['action']) {
    switch ($_GET['action']) {
      case 'insert':
        $sql = "INSERT INTO " . $owpDBTable['countries'] . " 
                (countries_name, 
                 countries_iso_code_2, 
                 countries_iso_code_3, 
                 address_format_id) 
                 VALUES (" . $db->qstr($countries_name) . ','
                           . $db->qstr($countries_iso_code_2) . ','
                           . $db->qstr($countries_iso_code_3) . ','
                           . $db->qstr($address_format_id) . ")";
        $db->Execute($sql);
        owpRedirect(owpLink($owpFilename['countries']));
        break;
      case 'save':
        $db->Execute("UPDATE " . $owpDBTable['countries'] . " 
	                 SET countries_name = " . $db->qstr($countries_name) . ", 
                             countries_iso_code_2 = " . $db->qstr($countries_iso_code_2) . ", 
                             countries_iso_code_3 = " . $db->qstr($countries_iso_code_3) . ",
                             address_format_id = " . $db->qstr($address_format_id) . " 
                       WHERE countries_id = '" . $_GET['cID'] . "'");
        owpRedirect(owpLink($owpFilename['countries'], 'page=' . $_GET['page'] . '&cID=' . $_GET['cID']));
        break;
      case 'deleteconfirm':
        $db->Execute("DELETE FROM " . $owpDBTable['countries'] . " 
                      WHERE countries_id = '" . $_GET['cID'] . "'");
        owpRedirect(owpLink($owpFilename['countries'], 'page=' . $_GET['page']));
        break;
      case 'download':
        $db_table_file = 'db_' . $owpDBTable['countries'] . '-' . date('YmdHis') . '.csv'; 
        $file = fopen (OWP_CSV_TEMP . $db_table_file, "a+");
        $sql = "select countries_id, countries_name, countries_iso_code_2, 
                       countries_iso_code_3, address_format_id 
                from " . $owpDBTable['countries'] . " 
                order by countries_name";
        $rs = $db->Execute($sql);
        $rs->MoveFirst();
        rs2csvfile($rs, $file);
        fclose($file);
	
        if (CVS_SEND_MAIL == 'true') {
	  // wir senden eine mail mit dem dateinamen $db_table_file an den user 
        }
	
        // download
        if (CVS_DOWNLOAD == 'true') {
          $fp = fopen(OWP_CSV_TEMP . $db_table_file, 'r');     
	  $buffer = fread($fp, filesize(OWP_CSV_TEMP . $db_table_file));
	  fclose($fp);
	  if ( (CVS_DELETE_FILE == 'true') && (CVS_SEND_MAIL == 'false') ){
	    @ unlink(OWP_CSV_TEMP . $db_table_file);
	  }
	  header('Content-Type: application/vnd.ms-excel');
	  header('Content-Disposition: attachment; filename="' . $db_table_file . '"');
	  header('Expires: 0');
	  header('Pragma: no-cache');
	  echo $buffer;
	} 
        owpRedirect(owpLink($owpFilename['countries'], 'page=' . $_GET['page']));
        break;
    }
  }
  
  require(OWP_LANGUAGES_DIR . $language . '/' . $owpFilename['countries']);
  $breadcrumb->add(NAVBAR_TITLE,  owpLink($owpFilename['countries'], '', 'NONSSL'));
  
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
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_COUNTRY_NAME; ?></td>
                <td class="dataTableHeadingContent" align="center" colspan="2"><?php echo TABLE_HEADING_COUNTRY_CODES; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $countries_query_raw = "select countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id from " . $owpDBTable['countries'] . " order by countries_name";
  $countries_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $countries_query_raw, $countries_query_numrows);
  $countries_query = $db->Execute($countries_query_raw);
  while ($countries = $countries_query->fields) {
    if (((!$_GET['cID']) || (@$_GET['cID'] == $countries['countries_id'])) && (!$cInfo) && (substr($_GET['action'], 0, 3) != 'new')) {
      $cInfo = new objectInfo($countries);
    }

    if ( (is_object($cInfo)) && ($countries['countries_id'] == $cInfo->countries_id) ) {
      echo '                  <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . owpLink($owpFilename['countries'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id . '&action=edit') . '\'">' . "\n";
    } else {
      echo '                  <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . owpLink($owpFilename['countries'], 'page=' . $_GET['page'] . '&cID=' . $countries['countries_id']) . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $countries['countries_name']; ?></td>
                <td class="dataTableContent" align="center" width="40"><?php echo $countries['countries_iso_code_2']; ?></td>
                <td class="dataTableContent" align="center" width="40"><?php echo $countries['countries_iso_code_3']; ?></td>
                <td class="dataTableContent" align="right"><?php if ( (is_object($cInfo)) && ($countries['countries_id'] == $cInfo->countries_id) ) { echo owpImage(OWP_IMAGES_DIR . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . owpLink($owpFilename['countries'], 'page=' . $_GET['page'] . '&cID=' . $countries['countries_id']) . '">' . owpImage(OWP_IMAGES_DIR . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    $countries_query->MoveNext();
  }
?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $countries_split->display_count($countries_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_COUNTRIES); ?></td>
                    <td class="smallText" align="right"><?php echo $countries_split->display_links($countries_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
<?php
  if (!$_GET['action']) {
?>
                  <tr>
                    <td align="right"><?php if (OWP_CSV_EXCEL == 'true') { echo '<a href="' . owpLink($owpFilename['countries'], 'page=' . $_GET['page'] . '&action=download') . '">' . owpImageButton('excel_now.gif', IMAGE_CSV_DOWNLOAD) . '</a>'; } ?></td>
                    <td align="right"><?php echo '<a href="' . owpLink($owpFilename['countries'], 'page=' . $_GET['page'] . '&action=new') . '">' . owpImageButton('button_new_country.gif', IMAGE_NEW_COUNTRY) . '</a>'; ?></td>
                  </tr>
<?php
  }
?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();
  switch ($_GET['action']) {
    case 'new':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_COUNTRY . '</b>');

      $contents = array('form' => owpDrawForm('countries', $owpFilename['countries'], 'page=' . $_GET['page'] . '&action=insert'));
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_NAME . '<br>' . owpInputField('countries_name'));
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_2 . '<br>' . owpInputField('countries_iso_code_2'));
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_3 . '<br>' . owpInputField('countries_iso_code_3'));
      $contents[] = array('text' => '<br>' . TEXT_INFO_ADDRESS_FORMAT . '<br>' . owpInputField('address_format_id'));
      $contents[] = array('align' => 'center', 'text' => '<br>' . owpImageSubmit('button_insert.gif', IMAGE_INSERT) . '&nbsp;<a href="' . owpLink($owpFilename['countries'], 'page=' . $_GET['page']) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_COUNTRY . '</b>');

      $contents = array('form' => owpDrawForm('countries', $owpFilename['countries'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id . '&action=save'));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_NAME . '<br>' . owpInputField('countries_name', $cInfo->countries_name));
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_2 . '<br>' . owpInputField('countries_iso_code_2', $cInfo->countries_iso_code_2));
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_3 . '<br>' . owpInputField('countries_iso_code_3', $cInfo->countries_iso_code_3));
      $contents[] = array('text' => '<br>' . TEXT_INFO_ADDRESS_FORMAT . '<br>' . owpInputField('address_format_id', $cInfo->address_format_id));
      $contents[] = array('align' => 'center', 'text' => '<br>' . owpImageSubmit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . owpLink($owpFilename['countries'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_COUNTRY . '</b>');

      $contents = array('form' => owpDrawForm('countries', $owpFilename['countries'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $cInfo->countries_name . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . owpImageSubmit('button_delete.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . owpLink($owpFilename['countries'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (is_object($cInfo)) {
        $heading[] = array('text' => '<b>' . $cInfo->countries_name . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . owpLink($owpFilename['countries'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id . '&action=edit') . '">' . owpImageButton('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . owpLink($owpFilename['countries'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->countries_id . '&action=delete') . '">' . owpImageButton('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_NAME . '<br>' . $cInfo->countries_name);
        $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_2 . ' ' . $cInfo->countries_iso_code_2);
        $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_3 . ' ' . $cInfo->countries_iso_code_3);
        $contents[] = array('text' => '<br>' . TEXT_INFO_ADDRESS_FORMAT . ' ' . $cInfo->address_format_id);
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
      <tr>
        <td><?php echo owpTransLine('1', '10'); ?></td>
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
