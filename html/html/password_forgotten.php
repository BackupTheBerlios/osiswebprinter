<?php
/* ----------------------------------------------------------------------
   $Id: password_forgotten.php,v 1.8 2003/05/01 14:39:04 r23 Exp $

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

  require(OWP_LANGUAGES_DIR . $language . '/' . $owpFilename['password_forgotten']);

  if ($_GET['action'] == 'process') {
    $sql = "SELECT admin_id, admin_gender, admin_firstname, admin_lastname, admin_email_address
            FROM " . $owpDBTable['administrators'] . " 
            WHERE admin_email_address = '" . owpDBInput($email_address) . "'";
    $check_admin_query = $db->Execute($sql);
    if ($check_admin_query->RecordCount()) {
      $check_admin = $check_admin_query->fields;
      // Crypted password mods - create a new password, update the database and mail it to them
      include_once(OWP_FUNCTIONS_DIR . $owpFilename['password_crypt']);
      $newpass = owpCreatePassword();
      $crpted_password = owpCryptPassword($newpass);
      $db->Execute("UPDATE " . $owpDBTable['administrators'] . " 
                       SET admin_password = " . $db->qstr($crpted_password) . "
                     WHERE admin_id = '" . owpDBInput($check_admin['admin_id']) . "'");
      $name = $check_admin['admin_firstname'] . " " . $check_admin['admin_lastname'];
      if ($check_admin['admin_gender'] == 'm') {
        $email_text = EMAIL_GREET_MR . $check_admin['admin_lastname'] . ',' . "\n\n";
      } else {
        $email_text = EMAIL_GREET_MS . $check_admin['admin_lastname'] . ',' . "\n\n";
      }
      $email_text .= EMAIL_PASSWORD_INTRO;
      $email_text .= sprintf(EMAIL_PASSWORD_BODY, $newpass);
      $email_text .= EMAIL_PASSWORD_FOOT;               
      owpMail($name, $check_admin['admin_email_address'], EMAIL_PASSWORD_SUBJECT, nl2br($email_text), OWP_NAME, OWP_EMAIL_ADDRESS);
      $messageStack->add_session(SUCCESS_PASSWORD_SENT, 'success');
      owpRedirect(owpLink($owpFilename['login'], '', 'SSL'));
    } else {
      $messageStack->add(ERROR_NO_USER, 'error');
    }
  }

  $breadcrumb->add(NAVBAR_TITLE_1, owpLink($owpFilename['login'], '', 'SSL'));
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
<script type="text/javascript" src="javascript/general.php"></script>
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
            <td colspan="3" bgcolor="#000000"><?php echo owpTransLine(); ?></td>
          </tr>
          <tr>
            <td colspan="3"><?php echo owpTransLine('1', '5'); ?></td>
          </tr>
          <tr>
            <td colspan="3"><?php echo owpDrawForm('password_forgotten', password_forgotten, 'action=process'); ?><table>
              <tr>
                <td class="main"><?php echo TEXT_INFO_USER_EMAIL; ?>&nbsp;</td>
                <td><?php echo owpInputField('email_address'); ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo owpTransLine('1', '5'); ?></td>
             </tr>
             <tr>
               <td valign="top"><a href="<?php echo owpLink($owpFilename['login'], '', 'SSL') . '">' . owpImageButton('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
               <td align="right" valign="top"><?php echo owpImageSubmit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
            </tr>
            </table></form></td>
          </tr>
          <tr>
            <td colspan="3"><?php echo owpTransLine('1', '5'); ?></td>
          </tr>
        </table></td>
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