<?php
/* ----------------------------------------------------------------------
   $Id: zones.php,v 1.6 2003/04/26 06:41:11 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: zones.php,v 1.21 2002/03/17 18:07:48 harley_vb
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
        $sql = "INSERT INTO " . $owpDBTable['zones'] . " 
                (zone_country_id,
                 zone_code, 
                 zone_name) 
                 VALUES (" . $db->qstr($zone_country_id) . ','
                           . $db->qstr($zone_code) . ','
                           . $db->qstr($zone_name) . ")";
        $db->Execute($sql);
        owpRedirect(owpLink($owpFilename['zones']));
        break;
      case 'save':
        $db->Execute("UPDATE " . $owpDBTable['zones'] . " 
	                 SET zone_country_id = " . $db->qstr($zone_country_id) . ", 
                             zone_code = " . $db->qstr($zone_code) . ", 
                             zone_name = " . $db->qstr($zone_name) . " 
                       WHERE zone_id = '" . $_GET['cID'] . "'");
        owpRedirect(owpLink($owpFilename['zones'], 'page=' . $_GET['page'] . '&cID=' . $_GET['cID']));
        break;
      case 'deleteconfirm':
        $db->Execute("DELETE FROM " . $owpDBTable['zones'] . " 
                      WHERE zone_id = '" . $_GET['cID'] . "'");
        owpRedirect(owpLink($owpFilename['zones'], 'page=' . $_GET['page']));
        break;
      case 'download':
        $db_table_file = 'db_' . $owpDBTable['zones'] . '-' . date('YmdHis') . '.csv'; 
        $file = fopen (OWP_CSV_TEMP . $db_table_file, "a+");
        $sql = "SELECT z.zone_id, c.countries_id, c.countries_name, 
                       z.zone_name, z.zone_code, z.zone_country_id 
                FROM " . $owpDBTable['zones'] . " z, 
                     " . $owpDBTable['countries'] . " c 
                WHERE z.zone_country_id = c.countries_id 
                ORDER BY c.countries_name, z.zone_name";
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
        owpRedirect(owpLink($owpFilename['zones'], 'page=' . $_GET['page']));
        break;
    }
  }
  
  require(OWP_LANGUAGES_DIR . $language . '/' . $owpFilename['zones']);
  $breadcrumb->add(NAVBAR_TITLE,  owpLink($owpFilename['zones'], '', 'NONSSL'));
  
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
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ZONE_NAME; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_ZONE_CODE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $zones_query_raw = "select z.zone_id, c.countries_id, c.countries_name, z.zone_name, z.zone_code, z.zone_country_id from " . $owpDBTable['zones'] . " z, " . $owpDBTable['countries'] . " c where z.zone_country_id = c.countries_id order by c.countries_name, z.zone_name";
  $zones_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $zones_query_raw, $zones_query_numrows);
  $zones_query = $db->Execute($zones_query_raw);
  while ($zones = $zones_query->fields) {
    if (((!$_GET['cID']) || (@$_GET['cID'] == $zones['zone_id'])) && (!$cInfo) && (substr($_GET['action'], 0, 3) != 'new')) {
      $cInfo = new objectInfo($zones);
    }

    if ( (is_object($cInfo)) && ($zones['zone_id'] == $cInfo->zone_id) ) {
      echo '              <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . owpLink($owpFilename['zones'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id . '&action=edit') . '\'">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . owpLink($owpFilename['zones'], 'page=' . $_GET['page'] . '&cID=' . $zones['zone_id']) . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $zones['countries_name']; ?></td>
                <td class="dataTableContent"><?php echo $zones['zone_name']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $zones['zone_code']; ?></td>
                <td class="dataTableContent" align="right"><?php if ( (is_object($cInfo)) && ($zones['zone_id'] == $cInfo->zone_id) ) { echo owpImage(OWP_IMAGES_DIR . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . owpLink($owpFilename['zones'], 'page=' . $_GET['page'] . '&cID=' . $zones['zone_id']) . '">' . owpImage(OWP_IMAGES_DIR . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    $zones_query->MoveNext();
  }
?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $zones_split->display_count($zones_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_ZONES); ?></td>
                    <td class="smallText" align="right"><?php echo $zones_split->display_links($zones_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
<?php
  if (!$_GET['action']) {
?>
                  <tr>
                    <td align="right"><?php if (OWP_CSV_EXCEL == 'true') { echo '<a href="' . owpLink($owpFilename['zones'], 'page=' . $_GET['page'] . '&action=download') . '">' . owpImageButton('excel_now.gif', IMAGE_CSV_DOWNLOAD) . '</a>'; } ?></td>
                    <td align="right"><?php echo '<a href="' . owpLink($owpFilename['zones'], 'page=' . $_GET['page'] . '&action=new') . '">' . owpImageButton('button_new_zone.gif', IMAGE_NEW_ZONE) . '</a>'; ?></td>
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
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_ZONE . '</b>');

      $contents = array('form' => owpDrawForm('zones', $owpFilename['zones'], 'page=' . $_GET['page'] . '&action=insert'));
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_INFO_ZONES_NAME . '<br>' . owpInputField('zone_name'));
      $contents[] = array('text' => '<br>' . TEXT_INFO_ZONES_CODE . '<br>' . owpInputField('zone_code'));
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_NAME . '<br>' . owpPullDownMenu('zone_country_id', owpGetCountries()));
      $contents[] = array('align' => 'center', 'text' => '<br>' . owpImageSubmit('button_insert.gif', IMAGE_INSERT) . '&nbsp;<a href="' . owpLink($owpFilename['zones'], 'page=' . $_GET['page']) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_ZONE . '</b>');

      $contents = array('form' => owpDrawForm('zones', $owpFilename['zones'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id . '&action=save'));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_INFO_ZONES_NAME . '<br>' . owpInputField('zone_name', $cInfo->zone_name));
      $contents[] = array('text' => '<br>' . TEXT_INFO_ZONES_CODE . '<br>' . owpInputField('zone_code', $cInfo->zone_code));
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_NAME . '<br>' . owpPullDownMenu('zone_country_id', owpGetCountries(), $cInfo->countries_id));
      $contents[] = array('align' => 'center', 'text' => '<br>' . owpImageSubmit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . owpLink($owpFilename['zones'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_ZONE . '</b>');

      $contents = array('form' => owpDrawForm('zones', $owpFilename['zones'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $cInfo->zone_name . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . owpImageSubmit('button_delete.gif', IMAGE_DELETE) . '&nbsp;<a href="' . owpLink($owpFilename['zones'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (is_object($cInfo)) {
        $heading[] = array('text' => '<b>' . $cInfo->zone_name . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . owpLink($owpFilename['zones'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id . '&action=edit') . '">' . owpImageButton('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . owpLink($owpFilename['zones'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id . '&action=delete') . '">' . owpImageButton('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_INFO_ZONES_NAME . '<br>' . $cInfo->zone_name . ' (' . $cInfo->zone_code . ')');
        $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_NAME . ' ' . $cInfo->countries_name);
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
