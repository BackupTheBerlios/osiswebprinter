<?php
/* ----------------------------------------------------------------------
   $Id: account_edit_process.php,v 1.4 2003/05/05 16:47:38 r23 Exp $

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

  require_once(OWP_FUNCTIONS_DIR . 'owp_validations.php');

/*
  $gender = tep_db_prepare_input($HTTP_POST_VARS['gender']);
  $firstname = tep_db_prepare_input($HTTP_POST_VARS['firstname']);
  $lastname = tep_db_prepare_input($HTTP_POST_VARS['lastname']);
  $email_address = tep_db_prepare_input($HTTP_POST_VARS['email_address']);
  $telephone = tep_db_prepare_input($HTTP_POST_VARS['telephone']);
  $fax = tep_db_prepare_input($HTTP_POST_VARS['fax']);
  $newsletter = tep_db_prepare_input($HTTP_POST_VARS['newsletter']);
  $password = tep_db_prepare_input($HTTP_POST_VARS['password']);
  $confirmation = tep_db_prepare_input($HTTP_POST_VARS['confirmation']);
*/
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

  if (!owpValidateEmail($email_address)) {
    $error = true;
    $entry_email_address_check_error = true;
  } else {
    $entry_email_address_check_error = false;
  }


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

  $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "' and customers_id != '" . tep_db_input($customer_id) . "'");
  $check_email = tep_db_fetch_array($check_email_query);
  if ($check_email['total'] > 0) {
    $error = true;
    $entry_email_address_exists = true;
  } else {
    $entry_email_address_exists = false;
  }

  if ($error == true) {
    $processed = true;

    include(DIR_WS_LANGUAGES . $language . '/' . $owpFilename['account_edit_process']);

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
    $sql_data_array = array('customers_firstname' => $firstname,
                            'customers_lastname' => $lastname,
                            'customers_email_address' => $email_address,
                            'customers_telephone' => $telephone,
                            'customers_fax' => $fax,
                            'customers_newsletter' => $newsletter,
                            'customers_password' => crypt_password($password));

    if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
    if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = tep_date_raw($dob);

    tep_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . tep_db_input($customer_id) . "'");

    $sql_data_array = array('entry_street_address' => $street_address,
                            'entry_firstname' => $firstname,
                            'entry_lastname' => $lastname,
                            'entry_postcode' => $postcode,
                            'entry_city' => $city,
                            'entry_country_id' => $country);

    if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
    if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
    if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
    if (ACCOUNT_STATE == 'true') {
      if ($zone_id > 0) {
        $sql_data_array['entry_zone_id'] = $zone_id;
        $sql_data_array['entry_state'] = '';
      } else {
        $sql_data_array['entry_zone_id'] = '0';
        $sql_data_array['entry_state'] = $state;
      }
    }

    tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', "customers_id = '" . tep_db_input($customer_id) . "' and address_book_id = '" . tep_db_input($customer_default_address_id) . "'");

    tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_account_last_modified = now() where customers_info_id = '" . tep_db_input($customer_id) . "'");

    $customer_first_name = $firstname;
    if ($HTTP_COOKIE_VARS['first_name']) setcookie('first_name', $customer_first_name, time()+2592000, substr(DIR_WS_CATALOG, 0, -1));
    $customer_country_id = $country;
    $customer_zone_id = $zone_id;

    owpRedirect(owpLink($owpFilename['account'], '', 'SSL'));
  }

  require(OWP_INCLUDES_DIR . 'nice_exit.php');
?>
