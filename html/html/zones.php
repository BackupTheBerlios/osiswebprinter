<?php
/* ----------------------------------------------------------------------
   $Id: zones.php,v 1.3 2003/04/23 16:29:39 r23 Exp $

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
        $zone_country_id = tep_db_prepare_input($HTTP_POST_VARS['zone_country_id']);
        $zone_code = tep_db_prepare_input($HTTP_POST_VARS['zone_code']);
        $zone_name = tep_db_prepare_input($HTTP_POST_VARS['zone_name']);

        $db->Execute("insert into " . $owpDBTable['zones'] . " (zone_country_id, zone_code, zone_name) values ('" . tep_db_input($zone_country_id) . "', '" . tep_db_input($zone_code) . "', '" . tep_db_input($zone_name) . "')");
        tep_redirect(owpLink($owpFilename['zones']));
        break;
      case 'save':
        $zone_id = tep_db_prepare_input($_GET['cID']);
        $zone_country_id = tep_db_prepare_input($HTTP_POST_VARS['zone_country_id']);
        $zone_code = tep_db_prepare_input($HTTP_POST_VARS['zone_code']);
        $zone_name = tep_db_prepare_input($HTTP_POST_VARS['zone_name']);

        $db->Execute("update " . $owpDBTable['zones'] . " set zone_country_id = '" . tep_db_input($zone_country_id) . "', zone_code = '" . tep_db_input($zone_code) . "', zone_name = '" . tep_db_input($zone_name) . "' where zone_id = '" . tep_db_input($zone_id) . "'");
        tep_redirect(owpLink($owpFilename['zones'], 'page=' . $_GET['page'] . '&cID=' . $zone_id));
        break;
      case 'deleteconfirm':
        $zone_id = tep_db_prepare_input($_GET['cID']);

        $db->Execute("delete from " . $owpDBTable['zones'] . " where zone_id = '" . tep_db_input($zone_id) . "'");
        tep_redirect(owpLink($owpFilename['zones'], 'page=' . $_GET['page']));
        break;
    }
  }
  
  require(OWP_LANGUAGES_DIR . $language . '/' . $owpFilename['zones']);
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
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
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="owp-title"><?php echo HEADING_TITLE; ?></td>
            <td class="owp-title" align="right"><?php echo owpTransLine(HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
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
                    <td colspan="2" align="right"><?php echo '<a href="' . owpLink($owpFilename['zones'], 'page=' . $_GET['page'] . '&action=new') . '">' . owpImageButton('button_new_zone.gif', IMAGE_NEW_ZONE) . '</a>'; ?></td>
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
      $contents[] = array('text' => '<br>' . TEXT_INFO_ZONES_NAME . '<br>' . tep_draw_input_field('zone_name'));
      $contents[] = array('text' => '<br>' . TEXT_INFO_ZONES_CODE . '<br>' . tep_draw_input_field('zone_code'));
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_NAME . '<br>' . tep_draw_pull_down_menu('zone_country_id', tep_get_countries()));
      $contents[] = array('align' => 'center', 'text' => '<br>' . owpImage_submit('button_insert.gif', IMAGE_INSERT) . '&nbsp;<a href="' . owpLink($owpFilename['zones'], 'page=' . $_GET['page']) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_ZONE . '</b>');

      $contents = array('form' => owpDrawForm('zones', $owpFilename['zones'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id . '&action=save'));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_INFO_ZONES_NAME . '<br>' . tep_draw_input_field('zone_name', $cInfo->zone_name));
      $contents[] = array('text' => '<br>' . TEXT_INFO_ZONES_CODE . '<br>' . tep_draw_input_field('zone_code', $cInfo->zone_code));
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_NAME . '<br>' . tep_draw_pull_down_menu('zone_country_id', tep_get_countries(), $cInfo->countries_id));
      $contents[] = array('align' => 'center', 'text' => '<br>' . owpImage_submit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . owpLink($owpFilename['zones'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_ZONE . '</b>');

      $contents = array('form' => owpDrawForm('zones', $owpFilename['zones'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $cInfo->zone_name . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . owpImage_submit('button_delete.gif', IMAGE_DELETE) . '&nbsp;<a href="' . owpLink($owpFilename['zones'], 'page=' . $_GET['page'] . '&cID=' . $cInfo->zone_id) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
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
