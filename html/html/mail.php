<?php
/* ----------------------------------------------------------------------
   $Id: mail.php,v 1.11 2003/05/01 14:39:04 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: mail.php,v 1.30 2002/03/16 01:07:28 hpdl
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

  require(OWP_LANGUAGES_DIR . $language . '/' . $owpFilename['mail']);
  $breadcrumb->add(NAVBAR_TITLE, owpLink($owpFilename['mail']));

  if ( ($_GET['action'] == 'send_email_to_user') && ($_POST['user_email_address']) && (!$_POST['back_x']) ) {
    switch ($_POST['user_email_address']) {
      case '***':
        $sql = "SELECT admin_gender, admin_firstname, admin_lastname, admin_email_address 
                FROM " . $owpDBTable['administrators'] . " 
                ORDER BY admin_lastname";
        $mail_query = $db->Execute($sql);
        $mail_sent_to = TEXT_ALL_USER;
        break;
      case '**D':
        $sql = "SELECT admin_gender, admin_firstname, admin_lastname, admin_email_address 
                FROM " . $owpDBTable['administrators'] . " 
                WHERE admin_newsletter = '1'
                ORDER BY admin_lastname"; 
        $mail_query = $db->Execute($sql);
        $mail_sent_to = TEXT_NEWSLETTER_USER;
        break;
      default:
        $sql = "SELECT admin_gender, admin_firstname, admin_lastname, admin_email_address 
                FROM " . $owpDBTable['administrators'] . " 
                WHERE admin_email_address = '" . owpDBInput($user_email_address) . "'";
        $mail_query = $db->Execute($sql);
        $mail_sent_to = $user_email_address;
        break;
    }

    // Let's build a message object using the email class
    $send_mail = new phpmailer();
    $send_mail->From = $_POST['from_mail'];
    $send_mail->FromName = $_POST['from_name'];
    $send_mail->Subject = $subject;
    while ($mail = $mail_query->fields) {
      if ($mail['admin_gender'] == 'm') {
        $body = EMAIL_GREET_MR . $mail['admin_lastname'] . ',' . "\n\n";
      } else {
        $body = EMAIL_GREET_MS . $mail['admin_lastname'] . ',' . "\n\n";
      }    
      $body .= $message. "\n\n";
      $body .= EMAIL_FOOT; 
      
      $send_mail->Body = $body;
      $send_mail->AddAddress($mail['admin_email_address'], $mail['admin_firstname'] . ' ' . $mail['admin_lastname']);
      $send_mail->Send();
      $send_mail->ClearAddresses();
      $send_mail->ClearAttachments();
      $mail_query->MoveNext();
    }
    owpRedirect(owpLink($owpFilename['mail'], 'mail_sent_to=' . urlencode($mail_sent_to)));
  }

  if ($_GET['mail_sent_to']) {
    $messageStack->add(sprintf(NOTICE_EMAIL_SENT_TO, $_GET['mail_sent_to']), 'notice');
  }

  if ($_GET['action'] == 'preview') {
    $noerror = true;
    if (!$_POST['user_email_address']) {
      $messageStack->add(ERROR_NO_USER_SELECTED, 'error');
      $noerror = false;
    }
    if ($_POST['from_name'] == '') {
      $messageStack->add(ERROR_NO_FROM_NAME, 'error');
      $noerror = false;
    }
    if ($_POST['from_mail'] == '') {
      $messageStack->add(ERROR_NO_FROM_MAIL, 'error');
      $noerror = false;
    }
    if ($_POST['subject'] == '') {
      $messageStack->add(ERROR_NO_SUBJECT, 'error');
      $noerror = false;
    }
    if ($_POST['message'] == '') {
      $messageStack->add(ERROR_NO_BODY, 'error');
      $noerror = false;
    }
  }
  
  if ( ($_GET['action'] == 'preview') && ($_POST['user_email_address']) ) {
    $breadcrumb->add(NAVBAR_TITLE, owpLink($owpFilename['mail']));
    switch ($_POST['user_email_address']) {
       case '***':
         $mail_sent_to = TEXT_ALL_USER;
         break;
       case '**D':
         $mail_sent_to = TEXT_NEWSLETTER_USER;
         break;
       default:
         $sql = "SELECT admin_gender, admin_firstname, admin_lastname, admin_email_address 
	                FROM " . $owpDBTable['administrators'] . " 
	                WHERE admin_email_address = '" . owpDBInput($user_email_address) . "'";
	 $mail_query = $db->Execute($sql);
	 $mail = $mail_query->fields;
         $mail_sent_to = $user_email_address;
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td class="owp-title"><?php echo HEADING_TITLE; ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if ( (($_GET['action'] == 'preview') && ($_POST['user_email_address'])) && ($noerror == 'false') ) {
?>
          <tr><?php echo owpDrawForm('mail', $owpFilename['mail'], 'action=send_email_to_user'); ?>
            <td><table border="0" cellpadding="0" cellspacing="2">
              <tr>
                <td colspan="3"><?php echo owpTransLine('1', '10'); ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TEXT_USER; ?></b></td>
                <td colspan="2" class="smallText"><?php echo $mail_sent_to; ?></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo owpTransLine('1', '10'); ?></td>
              </tr>            
              <tr>
                <td class="smallText"><b><?php echo TEXT_FROM_NAME; ?></b></td>
                <td colspan="2" class="smallText"><?php echo htmlspecialchars(stripslashes($_POST['from_name'])); ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TEXT_FROM_MAIL; ?></b></td>
                <td colspan="2" class="smallText"><?php echo htmlspecialchars(stripslashes($_POST['from_mail'])); ?></td>
              </tr>                            
              <tr>
                <td colspan="3"><?php echo owpTransLine('1', '10'); ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TEXT_SUBJECT; ?></b></td>
                <td colspan="2" class="smallText"><?php echo htmlspecialchars(stripslashes($_POST['subject'])); ?></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo owpTransLine('1', '10'); ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TEXT_MESSAGE; ?></b></td>
                <td colspan="2" class="smallText">
<?php 
  if ($mail['admin_gender'] == 'm') {
    echo EMAIL_GREET_MR . $mail['admin_lastname'] . ',<br /><br />';
  } elseif ($mail['admin_gender'] == 'f') {
    echo EMAIL_GREET_MS . $mail['admin_lastname'] . ',<br /><br />';
  } else {
    echo EMAIL_GREET_ALL . ',<br /><br />';
  }
  echo owpTextTool::wrap($message);
  echo '<br ><br >';
  $body = EMAIL_FOOT; 
  $body = str_replace("\n","<br />",$body);      
  echo $body; 
?>              </td>
              </tr>
              <tr>
                <td colspan="3"><?php echo owpTransLine('1', '10'); ?></td>
              </tr>
              <tr>
                <td colspan="3">
<?php
/* Re-Post all POST'ed variables */
    reset($_POST);
    while (list($key, $value) = each($_POST)) {
      if (!is_array($_POST[$key])) {
        echo owpDrawHiddenField($key, htmlspecialchars(stripslashes($value)));
      }
    }
?>
                <table border="0" width="100%" cellpadding="0" cellspacing="2">
                  <tr>
                    <td valign="top" align="left"><?php echo owpImageSubmit('button_back.gif', IMAGE_BACK, 'name="back"'); ?></td>
                    <td><?php echo owpTransLine('20', '1'); ?></td>
                    <td align="right"><?php echo '<a href="' . owpLink($owpFilename['mail']) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a> ' . owpImageSubmit('button_send_mail.gif', IMAGE_SEND_EMAIL); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </form></tr>
<?php
  } else {
    $sql = "SELECT admin_firstname, admin_lastname, admin_email_address 
            FROM " . $owpDBTable['administrators'] . " 
            WHERE admin_id = '" . owpDBInput($_SESSION['user_id']) . "'";
    $db->cacheSecs = 900; 
    $admin_send_query = $db->CacheExecute($sql);
    $admin_send = $admin_send_query->fields;
?>
          <tr><?php echo owpDrawForm('mail', $owpFilename['mail'], 'action=preview'); ?>
            <td><table border="0" cellpadding="0" cellspacing="2">
              <tr>
                <td colspan="3"><?php echo owpTransLine('1', '10'); ?></td>
              </tr>
<?php
    $user = array();
    $user[] = array('id' => '', 'text' => TEXT_SELECT_USER);
    $user[] = array('id' => '***', 'text' => TEXT_ALL_USER);
    $user[] = array('id' => '**D', 'text' => TEXT_NEWSLETTER_USER);
    $sql = "SELECT admin_gender, admin_firstname, admin_lastname, admin_email_address 
            FROM " . $owpDBTable['administrators'] . " 
            ORDER BY admin_lastname";
    $mail_query = $db->Execute($sql);
    while($user_values = $mail_query->fields) {
      $user[] = array('id' => $user_values['admin_email_address'], 'text' => $user_values['admin_lastname'] . ', ' . $user_values['admin_firstname'] . ' (' . $user_values['admin_email_address'] . ')');
      $mail_query->MoveNext();
    }
?>
              <tr>
                <td class="main"><?php echo TEXT_USER; ?></td>
                <td><?php echo owpPullDownMenu('user_email_address', $user);?></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo owpTransLine('1', '10'); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo TEXT_FROM_NAME; ?></td>
                <td><?php echo owpInputField('from_name', $admin_send['admin_firstname'] .' '. $admin_send['admin_lastname'] ); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo TEXT_FROM_MAIL; ?></td>
                <td><?php echo owpInputField('from_mail', $admin_send['admin_email_address']); ?></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo owpTransLine('1', '10'); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo TEXT_SUBJECT; ?></td>
                <td><?php echo owpInputField('subject'); ?></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo owpTransLine('1', '10'); ?></td>
              </tr>
              <tr>
                <td valign="top" class="main"><?php echo TEXT_MESSAGE; ?></td>
                <td><?php echo owpTextareaField('message', 'soft', '60', '15'); ?></td>
              </tr>
              <tr>
                <td colspan="3"><?php echo owpTransLine('1', '10'); ?></td>
              </tr>
              <tr>
                <td colspan="3" align="right"><?php echo owpImageSubmit('button_send_mail.gif', IMAGE_SEND_EMAIL); ?></td>
              </tr>
            </table></td>
          </form></tr>
<?php
  }
?>
<!-- body_text_eof //-->
        </table></td>
      </tr>
    </table></td>
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