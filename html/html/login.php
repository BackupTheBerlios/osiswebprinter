<?php
/* ----------------------------------------------------------------------
   $Id: login.php,v 1.9 2003/05/06 13:28:28 r23 Exp $

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

   Copyright (c) 2000,2001 The Exchange Project
  
   Login.php: Blake Schwendiman (blake@intechra.net)
   http://www.intechra.net/
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------   
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  require('includes/system.php');  

  require(OWP_LANGUAGES_DIR . $language . '/' . $owpFilename['login']);
  $breadcrumb->add(NAVBAR_TITLE, owpLink($owpFilename['login'], '', 'SSL'));
  
  if ($_GET['action'] == 'process') {
    include_once(OWP_FUNCTIONS_DIR . $owpFilename['password_crypt']);
    $sql = "SELECT admin_id, admin_gender, admin_firstname, admin_lastname,
                   admin_email_address, admin_password, admin_allowed_pages, admin_login 
            FROM " . $owpDBTable['administrators'] . " 
            WHERE admin_email_address = '" . owpDBInput($email_address) . "'";
    $check_admin_query = $db->Execute($sql);
    if ($check_admin_query->RecordCount()) {
      $check_admin = $check_admin_query->fields;
      if (!owpValidatePasword($password, $check_admin['admin_password'])) {
        $messageStack->add(ERROR_LOGIN_ERROR, 'error');
      } else {
        if ($check_admin['admin_login'] == '1') {
          $_SESSION['user_id'] = $check_admin['admin_id'];
          $_SESSION['gender'] = $check_admin['admin_gender'];
          $_SESSION['firstname'] = $check_admin['admin_firstname'];
          $_SESSION['lastname'] = $check_admin['admin_lastname'];
          $_SESSION['allowed_pages'] = $check_admin['admin_allowed_pages'];
        
          $today = date("Y-m-d H:i:s");
          $db->Execute("UPDATE " . $owpDBTable['administrators_info'] . " 
	                   SET admin_info_date_of_last_logon = " . $db->DBTimeStamp($today) . ",
	                       admin_info_number_of_logons = admin_info_number_of_logons+1 
                         WHERE admin_info_id = '" . owpDBInput($check_admin['admin_id']) . "'");        
          if (sizeof($navigation->snapshot) > 0) {
            $origin_href = owpLink($navigation->snapshot['page'], owpArraytoString($_SESSION['navigation']->snapshot['get'], array(owpSessionName())), $_SESSION['navigation']->snapshot['mode']);
            $navigation->clear_snapshot();
            owpRedirect($origin_href);
          } else {
            owpRedirect(owpLink($owpFilename['index'], '', 'NONSSL'));
          }
        } else {
          $messageStack->add(ERROR_NO_USER_LOGIN, 'error');
        }
      }
    } else {
      $messageStack->add(ERROR_LOGIN_NO_USER, 'error');
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
            <td colspan="3"><?php echo owpDrawForm('login', $owpFilename['login'], 'action=process'); ?><table>
              <tr>
                <td class="main"><?php echo TEXT_INFO_USER_EMAIL; ?>&nbsp;</td>
                <td><?php echo owpInputField('email_address'); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo TEXT_INFO_PASSWORD; ?>&nbsp;</td>
                <td><input type="password" name="password"></td>
              </tr>
              <tr>
                <td colspan="2"><input type="submit" name="Submit" value="Login"></td>
              </tr>
            </table></form></td>
          </tr>
          <tr>
            <td colspan="3"><?php echo owpTransLine('1', '5'); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo '<a href="' . owpLink($owpFilename['password_forgotten'], '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?></td>
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
