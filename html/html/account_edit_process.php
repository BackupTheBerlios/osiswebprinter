<?php
/* ----------------------------------------------------------------------
   $Id: account_edit_process.php,v 1.5 2003/05/06 13:48:11 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: account_edit_process.php,v 1.72 2002/08/06 12:11:57 dgw_
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

  if ($_POST['action'] != 'process') {
    owpRedirect(owpLink($owpFilename['account_edit'], '', 'SSL'));
  }
  require(OWP_LANGUAGES_DIR . $language . '/' . $owpFilename['account_edit_process']);
  require_once(OWP_FUNCTIONS_DIR . 'owp_validations.php');

  $error = false; // reset error flag

  if (($gender == 'm') || ($gender == 'f')) {
    $entry_gender_error = false;
  } else {
    $error = true;
    $entry_gender_error = true;
  }

  if (strlen($firstname) < FIRST_NAME_MIN_LENGTH) {
    $error = true;
    $entry_firstname_error = true;
  } else {
    $entry_firstname_error = false;
  }

  if (strlen($lastname) < LAST_NAME_MIN_LENGTH) {
    $error = true;
    $entry_lastname_error = true;
  } else {
    $entry_lastname_error = false;
  }

  if (strlen($email_address) < EMAIL_ADDRESS_MIN_LENGTH) {
    $error = true;
    $entry_email_address_error = true;
  } else {
    $entry_email_address_error = false;
  }
/*
  if (!owpValidateEmail($email_address)) {
    $error = true;
    $entry_email_address_check_error = true;
  } else {
    $entry_email_address_check_error = false;
  }
*/

  if (strlen($telephone) < TELEPHONE_MIN_LENGTH) {
    $error = true;
    $entry_telephone_error = true;
  } else {
    $entry_telephone_error = false;
  }

  if (strlen($password) < PASSWORD_MIN_LENGTH) {
    $error = true;
    $entry_password_error = true;
  } else {
    $entry_password_error = false;
  }

  if ($password != $confirmation) {
    $error = true;
    $entry_password_error = true;
  }

  $check_email_query = $db->Execute("SELECT count(*) as total 
                                     FROM " . $owpDBTable['administrators'] . " 
                                     WHERE admin_email_address = '" . owpDBInput($email_address) . "'
                                       AND admin_id != '" . $_SESSION['user_id'] . "'");                            
  $check_email = $check_email_query->fields;
  if ($check_email['total'] > 0) {
    $error = true;
    $entry_email_address_exists = true;
  } else {
    $entry_email_address_exists = false;
  }

  if ($error == true) {
    $processed = true;

    define('JS_PASSWORD_CHECK', 'true');
    $breadcrumb->add(NAVBAR_TITLE_1, owpLink($owpFilename['account'], '', 'SSL'));
    $breadcrumb->add(NAVBAR_TITLE_2, owpLink($owpFilename['account_edit'], '', 'SSL'));
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
<?php require('javascript/form_check.php'); ?>
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
    <td width="100%" valign="top"><?php echo owpDrawForm('account_edit', $owpFilename['account_edit_process'], '',  'post', 'onSubmit="return check_form();"') . owpDrawHiddenField('action', 'process'); ?><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td class="owp-title"><?php echo HEADING_TITLE; ?></td>
      </tr>
      <tr>
        <td><?php echo owpTransLine('1', '10'); ?></td>
      </tr>
      <tr>
        <td><?php include(OWP_ACCOUNT_DIR . 'account_details.php'); ?></td>
      </tr>
      <tr>
        <td><?php echo owpTransLine('1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo '<a href="' . owpLink(FILENAME_ACCOUNT, '', 'SSL') . '">' . owpImageButton('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
            <td class="main" align="right"><?php echo owpImageSubmit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
          </tr>
        </table></td>
      </tr>
    </table></form></td>
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
<?php
  } else {
    include_once(OWP_FUNCTIONS_DIR . $owpFilename['password_crypt']);
    $owp_pwd = owpCryptPassword($password);
    $login = DEFAULT_ADMIN_LOGIN;
    $db->Execute("UPDATE " . $owpDBTable['administrators'] . " 
	             SET admin_gender = " . $db->qstr($gender) . ",
                         admin_firstname = " . $db->qstr($firstname) . ",
                         admin_lastname = " . $db->qstr($lastname) . ",
                         admin_email_address = " . $db->qstr($email_address) . ",
                         admin_telephone = " . $db->qstr($telephone) . ",
                         admin_fax = " . $db->qstr($fax) . ",
                         admin_password = " . $db->qstr($owp_pwd) . ",
                         admin_login = " . $db->qstr(login) . "
                   WHERE admin_id = '" . $_SESSION['user_id'] . "'");         
    $today = date("Y-m-d H:i:s");
    $db->Execute("UPDATE " . $owpDBTable['administrators_info'] . " 
	             SET admin_info_date_account_last_modified = " . $db->DBTimeStamp($today) . "
                   WHERE admin_info_id = '" . $_SESSION['user_id'] . "'");
    // build the message content
    $name = $firstname . " " . $lastname;

    if ($_POST['gender'] == 'm') {
      $email_text = EMAIL_GREET_MR . $_POST['lastname'] . ',' . "\n\n";
    } else {
      $email_text = EMAIL_GREET_MS . $_POST['lastname'] . ',' . "\n\n";
    }

    $email_text .= EMAIL_UPDATE . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_FOOT;

    owpMail($name, $email_address, EMAIL_SUBJECT, nl2br($email_text), OWP_OWNER, OWP_OWNER_EMAIL_ADDRESS);
   
    $email_owner = OWNER_EMAIL_SUBJECT . "\n" . 
                   EMAIL_SEPARATOR . "\n" . 
                   OWNER_EMAIL_NUMBER . ' ' . $admin_id . "\n" .
                   OWNER_EMAIL_URL .  "\n" . OWP_HTTP_SERVER . '/' . $owpFilename['administrators'] . '?selected_box=administrators&page=1&aID=' . $admin_id . '&action=edit' . "\n" . 
                   OWNER_EMAIL_DATE . ' ' . strftime(DATE_FORMAT_LONG) . "\n\n" .
                   EMAIL_SEPARATOR . "\n";

              
    $email_owner .= OWNER_EMAIL_FIRST_NAME . ' ' . $firstname . "\n" .
                    OWNER_EMAIL_LAST_NAME . ' ' . $lastname . "\n\n" .      
                    OWNER_EMAIL_CONTACT. "\n" . 
                    OWNER_EMAIL_TELEPHONE_NUMBER . ' ' . $telephone . "\n" .
                    OWNER_EMAIL_FAX_NUMBER . ' ' . $fax . "\n" .
                    OWNER_EMAIL_ADDRESS . ' ' . $email_address . "\n" .
                    EMAIL_SEPARATOR . "\n\n" . 
                    OWNER_EMAIL_OPTIONS . "\n";
    if ($newsletter == '1') {
      $email_owner .= OWNER_EMAIL_NEWSLETTER . ENTRY_NEWSLETTER_YES . "\n";
    } else {
      $email_owner .= OWNER_EMAIL_NEWSLETTER . ENTRY_NEWSLETTER_NO . "\n";
    }
   
    owpMail(OWP_OWNER, OWP_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT, nl2br($email_owner),$name, $email_address );

    owpRedirect(owpLink($owpFilename['logoff'], '', 'SSL'));
  }

  require(OWP_INCLUDES_DIR . 'nice_exit.php');
?>
