<?php
/* ----------------------------------------------------------------------
   $Id: password_forgotten.php,v 1.4 2003/04/25 16:01:18 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: password_forgotten.php,v 1.45 2002/10/08 10:42:32 project3000
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  require('includes/system.php');

  require(DIR_WS_LANGUAGES . $language . '/' . $owpFilename['password_forgotten']);

  if ($_GET['action'] == 'process') {
    $check_customer = tep_db_query("select customers_firstname, customers_lastname, customers_password, customers_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . $HTTP_POST_VARS['email_address'] . "'");
    if (tep_db_num_rows($check_customer)) {
      $check_customer_values = tep_db_fetch_array($check_customer);
      // Crypted password mods - create a new password, update the database and mail it to them
      $newpass = tep_create_random_value(ENTRY_PASSWORD_MIN_LENGTH);
      $crpted_password = crypt_password($newpass);
      $sql = sprintf("UPDATE " . TABLE_CUSTOMERS . " SET customers_password = '%s' WHERE customers_id = %d", $crpted_password, $check_customer_values['customers_id']);
      tep_db_query($sql);
      
      tep_mail($check_customer_values['customers_firstname'] . " " . $check_customer_values['customers_lastname'], $HTTP_POST_VARS['email_address'], EMAIL_PASSWORD_REMINDER_SUBJECT, nl2br(sprintf(EMAIL_PASSWORD_REMINDER_BODY, $newpass)), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
      owpRedirect(owpLink(FILENAME_LOGIN, 'info_message=' . urlencode(TEXT_PASSWORD_SENT), 'SSL', true, false));
    } else {
      owpRedirect(owpLink($owpFilename['password_forgotten'], 'email=nonexistent', 'SSL'));
    }
  } else {

  $breadcrumb->add(NAVBAR_TITLE_1, owpLink(FILENAME_LOGIN, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, owpLink($owpFilename['password_forgotten'], '', 'SSL'));
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
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><form name="password_forgotten" method="post" action="<?php echo tep_href_link(FILENAME_PASSWORD_FORGOTTEN, 'action=process', 'SSL'); ?>"><br><table border="0" width="100%" cellspacing="0" cellpadding="3">
      <tr>
        <td align="right" class="main"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
        <td class="main"><input type="text" name="email_address" maxlength="96" value="<?php echo $HTTP_COOKIE_VARS['email_address']; ?>"></td>
      </tr>
      <tr>
       <td colspan="2"><br><table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td valign="top"><a href="<?php echo tep_href_link(FILENAME_LOGIN, '', 'SSL') . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
        <td align="right" valign="top"><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
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
