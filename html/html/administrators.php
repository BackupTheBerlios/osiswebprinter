<?php
/* ----------------------------------------------------------------------
   $Id: administrators.php,v 1.10 2003/05/06 13:48:11 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:

   Login and Logoff for osCommerce Administrators.

   Original Version by Blake Schwendiman
   blake@intechra.net

   Updated Version 1.1.0 (03/01/2002) by Christopher Conkie
   chris@conkiec.freeserve.co.uk

   This is a new admin module for osCommerce pr2.2 that allows 
   for login/logoff from the admin section of TEP.
   This way only valid administrators can access your site and in 
   varying degrees.

   This module is built around osCommerce CVS pr2.2 snapshot 02/01/2002
   ---------------------------------------------------------------------- 
   The Exchange Project - Community Made Shopping!
   http://www.theexchangeproject.org
  
   Implemented by Blake Schwendiman (blake@intechra.net)

   Copyright (c) 2000,2001 The Exchange Project
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

  require(OWP_LANGUAGES_DIR . $language . '/' . $owpFilename['administrators']);
  require_once(OWP_FUNCTIONS_DIR . 'owp_administrators.php');
  if ($_GET['action']) {
    switch ($_GET['action']) {
      case 'loginflag':
        if ( ($_GET['flag'] == '0') || ($_GET['flag'] == '1') ) {
          if ($_GET['aID']) {
            if ($_GET['flag'] == '0') {
              $db->Execute("UPDATE " . $owpDBTable['administrators'] . " 
	                       SET admin_login = '0' 
                             WHERE admin_id = '" . $_GET['aID'] . "'");
            } elseif ($_GET['flag'] == '1') {
	      $db->Execute("UPDATE " . $owpDBTable['administrators'] . " 
		               SET admin_login = '1'  
                             WHERE admin_id = '" . $_GET['aID'] . "'");
	      $sql = "SELECT admin_id, admin_gender, admin_firstname, admin_lastname,
                             admin_email_address, admin_password, admin_allowed_pages, admin_login 
                      FROM " . $owpDBTable['administrators'] . " 
                      WHERE admin_id = '" . $_GET['aID'] . "'";
              $check_admin_query = $db->Execute($sql);
              if ($check_admin_query->RecordCount()) {
                $check_admin = $check_admin_query->fields;
                $name = $check_admin['admin_firstname'] . " " . $check_admin['admin_lastname'];
                if ($check_admin['admin_gender'] == 'm') {
		  $email_text = EMAIL_GREET_MR . $check_admin['admin_lastname'] . ',' . "\n\n";
		} else {
		  $email_text = EMAIL_GREET_MS . $check_admin['admin_lastname'] . ',' . "\n\n";
		}
                $email_text .= EMAIL_WELCOME . EMAIL_TEXT;
                if ($check_admin['admin_password'] == '') {
                  include_once(OWP_FUNCTIONS_DIR . $owpFilename['password_crypt']);
                  $newpass = owpCreatePassword(PASSWORD_MIN_LENGTH);
                  $crpted_password = owpCryptPassword($newpass);
                  $db->Execute("UPDATE " . $owpDBTable['administrators'] . " 
                                   SET admin_password = " . $db->qstr($crpted_password) . "
                                  WHERE admin_id = '" . $_GET['aID'] . "'");
                  $email_text .= sprintf(EMAIL_PASSWORD_REMINDER_BODY, $newpass);
                }
                $email_text .= EMAIL_CONTACT . EMAIL_FOOT;
                owpMail($name, $check_admin['admin_email_address'], EMAIL_SUBJECT, nl2br($email_text), OWP_OWNER, OWP_OWNER_EMAIL_ADDRESS); 
                owpRedirect(owpLink($owpFilename['administrators'], 'page=' . $_GET['page'] . '&aID=' . $_GET['aID']));
              }
            }            
          }    
        } 
        break; 
      case 'update':
        $sPages = $_POST['adm_pages'];       
        if ( $adm_type == 'all' ) {
          $aPages = '*';
        } else {
          $aPages = implode( '|', $sPages ); 
        }
        $db->Execute("UPDATE " . $owpDBTable['administrators'] . " 
	                 SET admin_gender = " . $db->qstr($admin_gender) . ", 
                             admin_firstname = " . $db->qstr($admin_firstname) . ", 
                             admin_lastname = " . $db->qstr($admin_lastname) . ",
                             admin_email_address = " . $db->qstr($admin_email_address) . ", 
                             admin_telephone = " . $db->qstr($admin_telephone) . ",
                             admin_fax = " . $db->qstr($admin_fax) . ",
                             admin_allowed_pages = " . $db->qstr($aPages) . ", 
                             admin_newsletter = " . $db->qstr($admin_newsletter) . " 
                       WHERE admin_id = '" . $_GET['aID'] . "'");
        $today = date("Y-m-d H:i:s");
        $db->Execute("UPDATE " . $owpDBTable['administrators_info'] . " 
	                 SET admin_info_date_account_last_modified = " . $db->DBTimeStamp($today) . "
                       WHERE admin_info_id = '" . $_GET['aID'] . "'");
  
        owpRedirect(owpLink($owpFilename['administrators'], 'page=' . $_GET['page'] . '&aID=' . $_GET['aID']));
        break;  
      case 'deleteconfirm':
        $db->Execute("DELETE FROM " . $owpDBTable['administrators'] . " WHERE admin_id = '" . $_GET['aID'] . "'");
        $db->Execute("DELETE FROM " . $owpDBTable['administrators_info'] . " WHERE admin_info_id = '" . $_GET['aID'] . "'");
      
        $messageStack->add_session(SUCCESS_DELETE_USER, 'success');
        owpRedirect(owpLink($owpFilename['administrators'], 'page=' . $_GET['page']));
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
<script type="text/javascript" src="javascript/general.php"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onload="SetFocus();">
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
<?php
  if ($_GET['action'] == 'edit') {
    $admin_sql = "SELECT admin_id, admin_gender, admin_firstname, admin_lastname,
                         admin_email_address, admin_telephone, admin_fax, 
                         admin_password, admin_allowed_pages, admin_newsletter
                  FROM " . $owpDBTable['administrators'] . " 
                  WHERE admin_id = '" . $_GET['aID'] . "'";
    $admin_query = $db->Execute($admin_sql);
    $admins = $admin_query->fields;   
    $aInfo = new objectInfo($admins);

    $newsletter_array = array(array('id' => '1', 'text' => NEWSLETTER_YES),
                              array('id' => '0', 'text' => NEWSLETTER_NO));
?>
      <tr>
        <td class="owp-title"><?php echo HEADING_TITLE . ' : ' . $aInfo->admin_firstname . ' ' . $aInfo->admin_lastname ; ?></td>
      </tr>
      </tr>
      <tr>
        <td><?php echo owpTransLine('1', '10');; ?></td>
      </tr>
        <tr><?php echo owpDrawForm('user', $owpFilename['administrators'], 'page=' . $_GET['page'] . '&aID=' . $aInfo->admin_id . '&action=update', 'post'); ?>
        <td class="formAreaTitle"><?php echo CATEGORY_PERSONAL; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo GENDER; ?></td>
            <td class="main"><?php echo owpRadioField('admin_gender', 'm', false, $aInfo->admin_gender) . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . owpRadioField('admin_gender', 'f', false, $aInfo->admin_gender) . '&nbsp;&nbsp;' . FEMALE; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo FIRST_NAME; ?></td>
            <td class="main"><?php echo owpInputField('admin_firstname', $aInfo->admin_firstname, 'maxlength="32"', true); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo LAST_NAME; ?></td>
            <td class="main"><?php echo owpInputField('admin_lastname', $aInfo->admin_lastname, 'maxlength="32"', true); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo EMAIL_ADDRESS; ?></td>
            <td class="main"><?php echo owpInputField('admin_email_address', $aInfo->admin_email_address, 'maxlength="96"', true); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo owpTransLine('1', '10');; ?></td>
      </tr>
      <tr>
        <td class="formAreaTitle"><?php echo CATEGORY_CONTACT; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo TELEPHONE_NUMBER; ?></td>
            <td class="main"><?php echo owpInputField('admin_telephone', $aInfo->admin_telephone, 'maxlength="32"', true); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo FAX_NUMBER; ?></td>
            <td class="main"><?php echo owpInputField('admin_fax', $aInfo->admin_fax, 'maxlength="32"'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo NEWSLETTER; ?></td>
            <td class="main"><?php echo owpPullDownMenu('admin_newsletter', $newsletter_array, $aInfo->admin_newsletter); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo owpTransLine('1', '10');; ?></td>
      </tr>
      <tr>
        <td class="formAreaTitle"><?php echo TEXT_PARTIAL_ACCESS; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td><input type="radio" name="adm_type" value="all"></td>
            <td class="main"><?php print( TEXT_FULL_ACCESS ); ?></td>
          </tr>
          <tr>
            <td valign="top"><input type="radio" name="adm_type" value="not_all" checked></td>
            <td class="main"><?php echo TEXT_SELECT; ?><br><br>
               <SELECT name="adm_pages[]" size="<?php print( count( $aADMBoxes ) ); ?>" multiple>
<?php
   foreach( $aADMBoxes as $aKey => $aValue ) {
     print( "<option value=\"$aKey\">$aValue</option>" );
   }
?>
              </SELECT></td>
          </tr>        
        </table></td>
      </tr>
      <tr>
        <td><?php echo owpTransLine('1', '10');; ?></td>
      </tr>
      <tr>
        <td align="right" class="main"><?php echo owpImageSubmit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . owpLink($owpFilename['administrators'], 'page=' . $_GET['page'] . '&aID=' . $aInfo->admin_id . '') . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
      </tr></form>
<?php
  } else {
?>
      <tr>
        <td class="owp-title"><?php echo HEADING_TITLE; ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_LASTNAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_FIRSTNAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_ADMIN_HAS_ACCESS_TO; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACCOUNT_CREATED; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACCOUNT_LOGIN; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
    $admin_query_raw = "select admin_id, admin_gender, admin_firstname, admin_lastname, admin_email_address, admin_password, admin_allowed_pages, admin_login from " . $owpDBTable['administrators'] . "  order by admin_lastname, admin_firstname";
    $admin_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $admin_query_raw, $admin_query_numrows);
    $admin_query = $db->Execute($admin_query_raw);
    while ($admin = $admin_query->fields) { 
      $sql = "SELECT admin_info_date_account_created as date_account_created, 
                     admin_info_date_account_last_modified as date_account_last_modified, 
                     admin_info_date_of_last_logon as date_last_logon, 
                     admin_info_number_of_logons as number_of_logons 
              FROM " . $owpDBTable['administrators_info'] . " 
              WHERE admin_info_id = '" . $admin['admin_id'] . "'";
      $info_query = $db->Execute($sql);
      $info = $info_query->fields;   
    
      if (((!$_GET['aID']) || (@$_GET['aID'] == $admin['admin_id'])) && (!$aInfo)) { 
        $aInfo_array = owpArrayMerge($admin, $info);
        $aInfo = new objectInfo($aInfo_array);
      }

      if ((is_object($aInfo)) && ($admin['admin_id'] == $aInfo->admin_id)) {
        echo '          <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . owpLink($owpFilename['administrators'], owpGetAllGetParameters(array('aID', 'action')) . 'aID=' . $aInfo->admin_id . '&action=edit') . '\'">' . "\n";
      } else {
        echo '          <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . owpLink($owpFilename['administrators'], owpGetAllGetParameters(array('aID')) . 'aID=' . $admin['admin_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo $admin['admin_lastname']; ?></td>
                <td class="dataTableContent"><?php echo $admin['admin_firstname']; ?></td>
                <td class="dataTableContent">
<?php
      $aAccessTo = $admin['admin_allowed_pages'];
                                      
      if ( trim( $aAccessTo ) == '*' ) {
        $aTextAccessTo = TEXT_FULL_ACCESS;
      } else {
        $aTextAccessTo = '';
        $aAccessPages = explode( '|', $aAccessTo );
        foreach( $aAccessPages as $aPage ) {
          $aTextAccessTo .= $aADMBoxes[$aPage] . ', ';
        }
        $aTextAccessTo = substr( $aTextAccessTo, 0, strlen( $aTextAccessTo ) - 2 );
      }  
      print( $aTextAccessTo );
?>
                <td class="dataTableContent" align="right"><?php echo owpDateShort($info['date_account_created']); ?></td>
                <td class="dataTableContent" align="right">
<?php
      if ($admin['admin_login'] == '1') {
        echo '<a href="' . owpLink($owpFilename['administrators'], 'page=' . $_GET['page'] . '&action=loginflag&flag=0&aID=' . $admin['admin_id']) . '">' . owpImage(OWP_ICONS_DIR . 'icon_status_green.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
      } else {
        echo '<a href="' . owpLink($owpFilename['administrators'], 'page=' . $_GET['page'] . '&action=loginflag&flag=1&aID=' . $admin['admin_id']) . '">' . owpImage(OWP_ICONS_DIR . 'icon_status_red.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>';
      }
?></td>                
                <td class="dataTableContent" align="right"><?php if ((is_object($aInfo)) && ($admin['admin_id'] == $aInfo->admin_id)) { echo owpImage(OWP_ICONS_DIR . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . owpLink($owpFilename['administrators'], owpGetAllGetParameters(array('aID')) . 'aID=' . $admin['admin_id']) . '">' . owpImage(OWP_ICONS_DIR . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
      $admin_query->MoveNext();
    }
?>
              <tr>
                <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $admin_split->display_count($admin_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_USER); ?></td>
                    <td class="smallText" align="right"><?php echo $admin_split->display_links($admin_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], owpGetAllGetParameters(array('page', 'info', 'x', 'y', 'aID'))); ?></td>
                  </tr>
<?php
  if (!$_GET['action']) {
?>
              <tr>
              <td align="right"><?php if (OWP_CSV_EXCEL == 'true') { echo '<a href="' . owpLink($owpFilename['administrators'], 'page=' . $_GET['page'] . '&action=download') . '">' . owpImageButton('excel_now.gif', IMAGE_CSV_DOWNLOAD) . '</a>'; } ?></td>
              <td align="right"><?php echo '<a href="' . owpLink($owpFilename['create_account']) . '">' . owpImageButton('button_new_user.gif', IMAGE_NEW_USER) . '</a>'; ?></td>
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
    case 'delete':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_USER . '</b>');
  
        $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
        $contents[] = array('text' => '<br><b>' . $aInfo->admin_firstname . ' ' . $aInfo->admin_lastname . '</b>');
        $contents[] = array('align' => 'center', 'text' => '<br><a href="' . owpLink($owpFilename['administrators'], 'page=' . $_GET['page'] . '&aID=' . $aInfo->admin_id . '&action=deleteconfirm') . '">' . owpImageButton('button_delete.gif', IMAGE_DELETE) . '</a> <a href="' . owpLink($owpFilename['administrators'], 'page=' . $_GET['page'] . '&aID=' . $aInfo->admin_id) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:   
      if (is_object($aInfo)) {
        $heading[] = array('text' => '<b>' . $aInfo->admin_firstname . ' ' . $aInfo->admin_lastname . '</b>');
          
        $contents[] = array('align' => 'center', 'text' => '<a href="' . owpLink($owpFilename['administrators'], 'page=' . $_GET['page'] . '&aID=' . $aInfo->admin_id . '&action=edit') . '">' . owpImageButton('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . owpLink($owpFilename['administrators'], 'page=' . $_GET['page'] . '&aID=' . $aInfo->admin_id . '&action=delete') . '">' . owpImageButton('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('align' => 'center', 'text' => '<a href="' . owpLink($owpFilename['mail'], 'selected_box=tools&admin=' . $aInfo->admin_email_address) . '">' . owpImageButton('button_email.gif', IMAGE_EMAIL) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_DATE_ACCOUNT_CREATED . ' ' . owpDateShort($aInfo->date_account_created));
        $contents[] = array('text' => '<br>' . TEXT_DATE_ACCOUNT_LAST_MODIFIED . ' ' . owpDateShort($aInfo->date_account_last_modified));
        $contents[] = array('text' => '<br>' . TEXT_INFO_DATE_LAST_LOGON . ' '  . owpDateShort($aInfo->date_last_logon));
        $contents[] = array('text' => '<br>' . TEXT_INFO_NUMBER_OF_LOGONS . ' ' . $aInfo->number_of_logons);
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