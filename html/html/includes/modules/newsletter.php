<?php
/* ----------------------------------------------------------------------
   $Id: newsletter.php,v 1.6 2003/04/29 17:02:07 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: newsletter.php,v 1.1 2002/03/08 18:38:18 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */
   
  class newsletter {
    var $show_choose_audience, $title, $content;

    function newsletter($title, $content) {
      $this->show_choose_audience = false;
      $this->title = $title;
      $this->content = $content;
    }

    function choose_audience() {
      return false;
    }

    function confirm() {
      GLOBAL $db, $_GET, $owpFilename;

      $owpDBTable = owpDBGetTables();
      $sql = "SELECT count(*) as count 
              FROM " . $owpDBTable['administrators'] . " 
              WHERE admin_newsletter = '1'";
      $mail = $db->Execute($sql);

      $confirm_string = '<table border="0" cellspacing="0" cellpadding="2">' . "\n" .
                        '  <tr>' . "\n" .
                        '    <td class="main"><font color="#ff0000"><b>' . sprintf(TEXT_COUNT_CUSTOMERS, $mail['count']) . '</b></font></td>' . "\n" .
                        '  </tr>' . "\n" .
                        '  <tr>' . "\n" .
                        '    <td>' . owpTransLine('1', '10') . '</td>' . "\n" .
                        '  </tr>' . "\n" .
                        '  <tr>' . "\n" .
                        '    <td class="main"><b>' . $this->title . '</b></td>' . "\n" .
                        '  </tr>' . "\n" .
                        '  <tr>' . "\n" .
                        '    <td>' . owpTransLine('1', '10') . '</td>' . "\n" .
                        '  </tr>' . "\n" .
                        '  <tr>' . "\n" .
                        '    <td class="main"><tt>' . nl2br($this->content) . '</tt></td>' . "\n" .
                        '  </tr>' . "\n" .
                        '  <tr>' . "\n" .
                        '    <td>' . owpTransLine('1', '10') . '</td>' . "\n" .
                        '  </tr>' . "\n" .
                        '  <tr>' . "\n" .
                        '    <td align="right"><a href="' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $_GET['nID'] . '&action=confirm_send') . '">' . owpImageButton('button_send.gif', IMAGE_SEND) . '</a> <a href="' . owpLink($owpFilename['newsletters'], 'page=' . $_GET['page'] . '&nID=' . $_GET['nID']) . '">' . owpImageButton('button_cancel.gif', IMAGE_CANCEL) . '</a></td>' . "\n" .
                        '  </tr>' . "\n" .
                        '</table>';

      return $confirm_string;
    }

    function send($newsletter_id) {
      GLOBAL $db;

      $owpDBTable = owpDBGetTables();

      $send_mail = new phpmailer();

      $send_mail->From = EMAIL_FROM;
      $send_mail->FromName = '';
      $send_mail->Subject = $this->title;

      $mail_values = $db->Execute("select customers_firstname, customers_lastname, customers_email_address from " . $owpDBTable['administrators'] . " where customers_newsletter = '1'");
      while ($mail = $mail_values->fields) {
      	$send_mail->Body = $this->content;
      	$send_mail->AddAdress($mail['customers_email_address'], $mail['customers_firstname'] . ' ' . $mail['customers_lastname']);
        $send_mail->Send();
        // Clear all addresses and attachments for next loop
        $send_mail->ClearAddresses();
        $send_mail->ClearAttachments();
        $mail->MoveNext();
      }

      $newsletter_id = owp_db_prepare_input($newsletter_id);
      $db->Execute("update " . $owpDBTable['newsletters'] . " set date_sent = now(), status = '1' where newsletters_id = '" . owpDBInput($newsletter_id) . "'");
    }
  }
?>
