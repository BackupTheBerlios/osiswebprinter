<?php
/* ----------------------------------------------------------------------
   $Id: configuration.php,v 1.12 2003/04/23 07:04:35 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: configuration.php,v 1.39 2002/08/13 18:53:04 dgw_
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
  
  require(OWP_LANGUAGES_DIR . $language . '/' . $owpFilename['configuration']);
  $breadcrumb->add(NAVBAR_TITLE,  owpLink($owpFilename['configuration'], 'gID=1', 'NONSSL'));
  
  if ($_GET['action']) {
    switch ($_GET['action']) {
      case 'save':
        $today = date("Y-m-d H:i:s");
        $db->Execute("UPDATE " . $owpDBTable['configuration'] . " 
	                 SET configuration_value = " . $db->qstr($configuration_value) . ", 
                             last_modified = " . $db->DBTimeStamp($today). "
                       WHERE configuration_id = '" . $_GET['cID'] . "'");
        owpRedirect(owpLink($owpFilename['configuration'], 'gID=' . $_GET['gID'] . '&cID=' . $_GET['cID']));
        break;
    }
  }

  $sql = "SELECT configuration_group_title 
          FROM " . $owpDBTable['configuration_group'] . " 
          WHERE configuration_group_id = '" . $_GET['gID'] . "'";
  $cfg_group_query = $db->Execute($sql);
  $cfg_group = $cfg_group_query->fields;
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
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="owp-title"><?php echo $cfg_group['configuration_group_title']; ?></td>
            <td class="owp-title" align="right"><?php echo owpTransLine(HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CONFIGURATION_TITLE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CONFIGURATION_VALUE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $sql = "SELECT configuration_id, configuration_title, configuration_value, use_function 
          FROM " . $owpDBTable['configuration'] . " 
          WHERE configuration_group_id = '" . $_GET['gID'] . "' 
          ORDER BY sort_order";
  $configuration_query = $db->Execute($sql);
  while ($configuration = $configuration_query->fields) {   
    if (owpNotNull($configuration['use_function'])) {
      $use_function = $configuration['use_function'];
      if (ereg('->', $use_function)) {
        $class_method = explode('->', $use_function);
        if (!is_object(${$class_method[0]})) {
          include(OWP_CLASSES_DIR . $class_method[0] . '.php');
          ${$class_method[0]} = new $class_method[0]();
        }
        $cfgValue = owpCallFunction($class_method[1], $configuration['configuration_value'], ${$class_method[0]});
      } else {
        $cfgValue = owpCallFunction($use_function, $configuration['configuration_value']);
      }
    } else {
      $cfgValue = $configuration['configuration_value'];
    }

    if (((!$_GET['cID']) || (@$_GET['cID'] == $configuration['configuration_id'])) && (!$cInfo) && (substr($_GET['action'], 0, 3) != 'new')) {
      $sql = "SELECT configuration_key, configuration_description, date_added, 
                     last_modified, use_function, set_function 
              FROM " . $owpDBTable['configuration'] . " 
              WHERE configuration_id = '" . $configuration['configuration_id'] . "'";
      $cfg_extra_query = $db->Execute($sql);
      $cInfo_array = owpArrayMerge($configuration, $cfg_extra_query->fields);
      $cInfo = new objectInfo($cInfo_array);
    }

    if ( (is_object($cInfo)) && ($configuration['configuration_id'] == $cInfo->configuration_id) ) {
      echo '                  <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . owpLink($owpFilename['configuration'], 'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id . '&action=edit') . '\'">' . "\n";
    } else {
      echo '                  <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . owpLink($owpFilename['configuration'], 'gID=' . $_GET['gID'] . '&cID=' . $configuration['configuration_id']) . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $configuration['configuration_title']; ?></td>
                <td class="dataTableContent"><?php echo htmlspecialchars($cfgValue); ?></td>
                <td class="dataTableContent" align="right"><?php if ( (is_object($cInfo)) && ($configuration['configuration_id'] == $cInfo->configuration_id) ) { echo owpImage(OWP_IMAGES_DIR . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . owpLink($owpFilename['configuration'], 'gID=' . $_GET['gID'] . '&cID=' . $configuration['configuration_id']) . '">' . owpImage(OWP_IMAGES_DIR . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    $configuration_query->MoveNext();
  }
?>
            </table></td>
<?php
  $heading = array();
  $contents = array();
  switch ($_GET['action']) {
    case 'edit':
      $heading[] = array('text' => '<b>' . $cInfo->configuration_title . '</b>');

      if ($cInfo->set_function) {
        eval('$value_field = ' . $cInfo->set_function . "'" . $cInfo->configuration_value . "');");
      } else {
        $value_field = owpInputField('configuration_value', $cInfo->configuration_value);
      }

      $contents = array('form' => owpDrawForm('configuration', $owpFilename['configuration'], 'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id . '&action=save'));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      $contents[] = array('text' => '<br><b>' . $cInfo->configuration_title . '</b><br>' . $cInfo->configuration_description . '<br>' . $value_field);
      $contents[] = array('align' => 'center', 'text' => '<br>' . owpImageSubmit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . owpLink($owpFilename['configuration'], 'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (is_object($cInfo)) {
        $heading[] = array('text' => '<b>' . $cInfo->configuration_title . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . owpLink($owpFilename['configuration'], 'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id . '&action=edit') . '">' . owpImageButton('button_edit.gif', IMAGE_EDIT) . '</a>');
        $contents[] = array('text' => '<br>' . $cInfo->configuration_description);
        $contents[] = array('text' => '<br>' . TEXT_INFO_DATE_ADDED . ' ' . owpDateShort($cInfo->date_added));
        if (owpNotNull($cInfo->last_modified)) $contents[] = array('text' => TEXT_INFO_LAST_MODIFIED . ' ' . owpDateShort($cInfo->last_modified));
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
