<?php
/* ----------------------------------------------------------------------
   $Id: newsletters.php,v 1.14 2003/04/26 06:41:11 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: newsletters.php,v 1.14 2002/03/29 13:04:25 dgw_
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
 
  require(OWP_LANGUAGES_DIR . $language . '/' . $owpFilename['newsletters']);

  if ($_GET['action']) {
    switch ($_GET['action']) {
      case 'lock':
      case 'unlock':
        $newsletter_id = tep_db_prepare_input($_GET['nID']);
        $status = (($_GET['action'] == 'lock') ? '1' : '0');

        tep_db_query("update " . TABLE_NEWSLETTERS . " set locked = '" . $status . "' WHERE newsletters_id = '" . tep_db_input($newsletter_id) . "'");

        owpRedirect(owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']));
        break;
      case 'insert':
      case 'update':
        $newsletter_error = false;
        if (empty($title)) {
          $messageStack->add(ERROR_NEWSLETTER_TITLE, 'error');
          $newsletter_error = true;
        }
        if (empty($module)) {
          $messageStack->add(ERROR_NEWSLETTER_MODULE, 'error');
          $newsletter_error = true;
        }

        if (!$newsletter_error) {
          $sql_data_array = array('title' => $title,
                                  'content' => $content,
                                  'module' => $newsletter_module);

          if ($_GET['action'] == 'insert') {
            $sql_data_array['date_added'] = 'now()';
            $sql_data_array['status'] = '0';
            $sql_data_array['locked'] = '0';

            tep_db_perform(TABLE_NEWSLETTERS, $sql_data_array);
            $newsletter_id = tep_db_insert_id();
          } elseif ($_GET['action'] == 'update') {
            tep_db_perform(TABLE_NEWSLETTERS, $sql_data_array, 'update', 'newsletters_id = \'' . tep_db_input($newsletter_id) . '\'');
          }

          owpRedirect(owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $newsletter_id));
        } else {
          $_GET['action'] = 'new';
        }
        break;
      case 'deleteconfirm':
        $newsletter_id = tep_db_prepare_input($_GET['nID']);

        tep_db_query("delete FROM " . TABLE_NEWSLETTERS . " WHERE newsletters_id = '" . tep_db_input($newsletter_id) . "'");

        owpRedirect(owpLink($owpFilename['newsletters'], 'page=' . $_GET['page']));
        break;
      case 'delete':
      case 'new': if (!$_GET['nID']) break;
      case 'send':
      case 'confirm_send':
        $newsletter_id = tep_db_prepare_input($_GET['nID']);

        $check_query = tep_db_query("SELECT locked FROM " . TABLE_NEWSLETTERS . " WHERE newsletters_id = '" . tep_db_input($newsletter_id) . "'");
        $check = tep_db_fetch_array($check_query);

        if ($check['locked'] < 1) {
          switch ($_GET['action']) {
            case 'delete': $error = ERROR_REMOVE_UNLOCKED_NEWSLETTER; break;
            case 'new': $error = ERROR_EDIT_UNLOCKED_NEWSLETTER; break;
            case 'send': $error = ERROR_SEND_UNLOCKED_NEWSLETTER; break;
            case 'confirm_send': $error = ERROR_SEND_UNLOCKED_NEWSLETTER; break;
          }
          $messageStack->add_session($error, 'error');
          owpRedirect(owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']));
        }
        break;
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
<div id="spiffycalendar" class="text"></div>
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
<?php
  if ($_GET['action'] == 'new') {
    $form_action = 'insert';
    if ($_GET['nID']) {
      $nID = tep_db_prepare_input($_GET['nID']);
      $form_action = 'update';

      $newsletter_query = tep_db_query("SELECT title, content, module FROM " . TABLE_NEWSLETTERS . " WHERE newsletters_id = '" . tep_db_input($nID) . "'");
      $newsletter = tep_db_fetch_array($newsletter_query);

      $nInfo = new objectInfo($newsletter);
    } elseif ($_POST) {
      $nInfo = new objectInfo($_POST);
    } else {
      $nInfo = new objectInfo(array());
    }

    $file_extension = substr($owpSelf, strrpos($owpSelf, '.'));
    $directory_array = array();
    if ($dir = dir(OWP_MODULES_DIR . 'newsletters/')) {
      while ($file = $dir->read()) {
        if (!is_dir(OWP_MODULES_DIR . 'newsletters/' . $file)) {
          if (substr($file, strrpos($file, '.')) == $file_extension) {
            $directory_array[] = $file;
          }
        }
      }
      sort($directory_array);
      $dir->close();
    }

    for ($i=0; $i<sizeof($directory_array); $i++) {
      $modules_array[] = array('id' => substr($directory_array[$i], 0, strrpos($directory_array[$i], '.')), 'text' => substr($directory_array[$i], 0, strrpos($directory_array[$i], '.')));
    }
?>
      <tr>
        <td><?php echo owpTransLine('1', '10'); ?></td>
      </tr>
      <tr><?php echo owpDrawForm('newsletter', $owpFilename['newsletters'], 'page=' . $_GET['page'] . '&action=' . $form_action); if ($form_action == 'update') echo owpDrawHiddenField('newsletter_id', $nID); ?>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo TEXT_NEWSLETTER_MODULE; ?></td>
            <td class="main"><?php echo owpPullDownMenu('module', $modules_array, $nInfo->module); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo owpTransLine('1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_NEWSLETTER_TITLE; ?></td>
            <td class="main"><?php echo owpInputField('title', $nInfo->title, '', true); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo owpTransLine('1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main" valign="top"><?php echo TEXT_NEWSLETTER_CONTENT; ?></td>
            <td class="main"><?php echo owpTextareaField('content', 'soft', '100%', '20', $nInfo->content); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo owpTransLine('1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" align="right"><?php echo (($form_action == 'insert') ? owpImageSubmit('button_save.gif', IMAGE_SAVE) : owpImageSubmit('button_update.gif', IMAGE_UPDATE)). '&nbsp;&nbsp;<a href="' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
          </tr>
        </table></td>
      </form></tr>
<?php
  } elseif ($_GET['action'] == 'preview') {
    $nID = tep_db_prepare_input($_GET['nID']);

    $newsletter_query = tep_db_query("SELECT title, content, module FROM " . TABLE_NEWSLETTERS . " WHERE newsletters_id = '" . tep_db_input($nID) . "'");
    $newsletter = tep_db_fetch_array($newsletter_query);

    $nInfo = new objectInfo($newsletter);
?>
      <tr>
        <td align="right"><?php echo '<a href="' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']) . '">' . owpImageButton('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
      </tr>
      <tr>
        <td><tt><?php echo nl2br($nInfo->content); ?></tt></td>
      </tr>
      <tr>
        <td align="right"><?php echo '<a href="' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']) . '">' . owpImageButton('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
      </tr>
<?php
  } elseif ($_GET['action'] == 'send') {
    $nID = tep_db_prepare_input($_GET['nID']);

    $newsletter_query = tep_db_query("SELECT title, content, module FROM " . TABLE_NEWSLETTERS . " WHERE newsletters_id = '" . tep_db_input($nID) . "'");
    $newsletter = tep_db_fetch_array($newsletter_query);

    $nInfo = new objectInfo($newsletter);

    include(OWP_LANGUAGES_DIR . $language . '/modules/newsletters/' . $nInfo->module . substr($owpSelf, strrpos($owpSelf, '.')));
    include(OWP_MODULES_DIR . 'newsletters/' . $nInfo->module . substr($owpSelf, strrpos($owpSelf, '.')));
    $module_name = $nInfo->module;
    $module = new $module_name($nInfo->title, $nInfo->content);
?>
      <tr>
        <td><?php if ($module->show_choose_audience) { echo $module->choose_audience(); } else { echo $module->confirm(); } ?></td>
      </tr>
<?php
  } elseif ($_GET['action'] == 'confirm') {
    $nID = tep_db_prepare_input($_GET['nID']);

    $newsletter_query = tep_db_query("SELECT title, content, module FROM " . TABLE_NEWSLETTERS . " WHERE newsletters_id = '" . tep_db_input($nID) . "'");
    $newsletter = tep_db_fetch_array($newsletter_query);

    $nInfo = new objectInfo($newsletter);

    include(OWP_LANGUAGES_DIR . $language . '/modules/newsletters/' . $nInfo->module . substr($owpSelf, strrpos($owpSelf, '.')));
    include(OWP_MODULES_DIR . 'newsletters/' . $nInfo->module . substr($owpSelf, strrpos($owpSelf, '.')));
    $module_name = $nInfo->module;
    $module = new $module_name($nInfo->title, $nInfo->content);
?>
      <tr>
        <td><?php echo $module->confirm(); ?></td>
      </tr>
<?php
  } elseif ($_GET['action'] == 'confirm_send') {
    $nID = tep_db_prepare_input($_GET['nID']);

    $newsletter_query = tep_db_query("SELECT newsletters_id, title, content, module FROM " . TABLE_NEWSLETTERS . " WHERE newsletters_id = '" . tep_db_input($nID) . "'");
    $newsletter = tep_db_fetch_array($newsletter_query);

    $nInfo = new objectInfo($newsletter);

    include(OWP_LANGUAGES_DIR . $language . '/modules/newsletters/' . $nInfo->module . substr($owpSelf, strrpos($owpSelf, '.')));
    include(OWP_MODULES_DIR . 'newsletters/' . $nInfo->module . substr($owpSelf, strrpos($owpSelf, '.')));
    $module_name = $nInfo->module;
    $module = new $module_name($nInfo->title, $nInfo->content);
?>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" valign="middle"><?php echo owpImage(OWP_IMAGES_DIR . 'ani_send_email.gif', IMAGE_ANI_SEND_EMAIL); ?></td>
            <td class="main" valign="middle"><b><?php echo TEXT_PLEASE_WAIT; ?></b></td>
          </tr>
        </table></td>
      </tr>
<?php
  owpSetTimeLimit(0);
  flush();
  $module->send($nInfo->newsletters_id);
?>
      <tr>
        <td><?php echo owpTransLine('1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><font color="#ff0000"><b><?php echo TEXT_FINISHED_SENDING_EMAILS; ?></b></font></td>
      </tr>
      <tr>
        <td><?php echo owpTransLine('1', '10'); ?></td>
      </tr>
      <tr>
        <td><?php echo '<a href="' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']) . '">' . owpImageButton('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
      </tr>
<?php
  } else {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_NEWSLETTERS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_SIZE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_MODULE; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_SENT; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
    $newsletters_query_raw = "SELECT newsletters_id, title, length(content) as content_length, module, date_added, date_sent, status, locked FROM " . TABLE_NEWSLETTERS . " order by date_added desc";
    $newsletters_split = new owpSplitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $newsletters_query_raw, $newsletters_query_numrows);
    $newsletters_query = tep_db_query($newsletters_query_raw);
    while ($newsletters = tep_db_fetch_array($newsletters_query)) {
      if (((!$_GET['nID']) || (@$_GET['nID'] == $newsletters['newsletters_id'])) && (!$nInfo) && (substr($_GET['action'], 0, 3) != 'new')) {
        $nInfo = new objectInfo($newsletters);
      }

      if ( (is_object($nInfo)) && ($newsletters['newsletters_id'] == $nInfo->newsletters_id) ) {
        echo '                  <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=preview') . '\'">' . "\n";
      } else {
        echo '                  <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $newsletters['newsletters_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo '<a href="' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $newsletters['newsletters_id'] . '&action=preview') . '">' . owpImage(OWP_ICONS_DIR . 'preview.gif', ICON_PREVIEW) . '</a>&nbsp;' . $newsletters['title']; ?></td>
                <td class="dataTableContent" align="right"><?php echo number_format($newsletters['content_length']) . ' bytes'; ?></td>
                <td class="dataTableContent" align="right"><?php echo $newsletters['module']; ?></td>
                <td class="dataTableContent" align="center"><?php if ($newsletters['status'] == '1') { echo owpImage(OWP_ICONS_DIR . 'tick.gif', ICON_TICK); } else { echo owpImage(OWP_ICONS_DIR . 'cross.gif', ICON_CROSS); } ?></td>
                <td class="dataTableContent" align="center"><?php if ($newsletters['locked'] > 0) { echo owpImage(OWP_ICONS_DIR . 'locked.gif', ICON_LOCKED); } else { echo owpImage(OWP_ICONS_DIR . 'unlocked.gif', ICON_UNLOCKED); } ?></td>
                <td class="dataTableContent" align="right"><?php if ( (is_object($nInfo)) && ($newsletters['newsletters_id'] == $nInfo->newsletters_id) ) { echo owpImage(OWP_IMAGES_DIR . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $newsletters['newsletters_id']) . '">' . owpImage(OWP_IMAGES_DIR . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
?>
              <tr>
                <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $newsletters_split->display_count($newsletters_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS); ?></td>
                    <td class="smallText" align="right"><?php echo $newsletters_split->display_links($newsletters_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
                  <tr>
                    <td align="right" colspan="2"><?php echo '<a href="' . owpLink($owpFilename['newsletters'], 'action=new') . '">' . owpImageButton('button_new_newsletter.gif', IMAGE_NEW_NEWSLETTER) . '</a>'; ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();
  switch ($_GET['action']) {
    case 'delete':
      $heading[] = array('text' => '<b>' . $nInfo->title . '</b>');

      $contents = array('form' => owpDrawForm('newsletters', $owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $nInfo->title . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . owpImageSubmit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (is_object($nInfo)) {
        $heading[] = array('text' => '<b>' . $nInfo->title . '</b>');

        if ($nInfo->locked > 0) {
          $contents[] = array('align' => 'center', 'text' => '<a href="' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=new') . '">' . owpImageButton('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=delete') . '">' . owpImageButton('button_delete.gif', IMAGE_DELETE) . '</a> <a href="' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=preview') . '">' . owpImageButton('button_preview.gif', IMAGE_PREVIEW) . '</a> <a href="' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=send') . '">' . owpImageButton('button_send.gif', IMAGE_SEND) . '</a> <a href="' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=unlock') . '">' . owpImageButton('button_unlock.gif', IMAGE_UNLOCK) . '</a>');
        } else {
          $contents[] = array('align' => 'center', 'text' => '<a href="' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=preview') . '">' . owpImageButton('button_preview.gif', IMAGE_PREVIEW) . '</a> <a href="' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $nInfo->newsletters_id . '&action=lock') . '">' . owpImageButton('button_lock.gif', IMAGE_LOCK) . '</a>');
        }
        $contents[] = array('text' => '<br>' . TEXT_NEWSLETTER_DATE_ADDED . ' ' . owpDateShort($nInfo->date_added));
        if ($nInfo->status == '1') $contents[] = array('text' => TEXT_NEWSLETTER_DATE_SENT . ' ' . owpDateShort($nInfo->date_sent));
      }
      break;
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
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
