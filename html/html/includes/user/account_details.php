<?php
/* ----------------------------------------------------------------------
   $Id: account_details.php,v 1.3 2003/05/05 08:52:34 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File:  account_details.php,v 1.23 2002/10/27 17:32:12 dgw_
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  $newsletter_array = array(array('id' => '1',
                                  'text' => NEWSLETTER_YES),
                            array('id' => '0',
                                  'text' => NEWSLETTER_NO));
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="formAreaTitle"><?php echo CATEGORY_PERSONAL; ?></td>
  </tr>
  <tr>
    <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="2">
<?php
  $male = ($account['customers_gender'] == 'm') ? true : false;
  $female = ($account['customers_gender'] == 'f') ? true : false;
?>
          <tr>
            <td class="main">&nbsp;<?php echo GENDER; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo ($account['customers_gender'] == 'm') ? MALE : FEMALE;
  } elseif ($error) {
    if ($entry_gender_error) {
      echo owpRadioField('gender', 'm', $male) . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . owpRadioField('gender', 'f', $female) . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . GENDER_ERROR;
    } else {
      echo ($gender == 'm') ? MALE : FEMALE;
      echo owpDrawHiddenField('gender');
    }
  } else {
    echo owpRadioField('gender', 'm', $male) . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . owpRadioField('gender', 'f', $female) . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . TEXT_FIELD_REQUIRED;
  }
?></td>
          </tr>
          <tr>
            <td class="main">&nbsp;<?php echo FIRST_NAME; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo $account['customers_firstname'];
  } elseif ($error) {
    if ($entry_firstname_error) {
      echo owpInputField('firstname') . '&nbsp;' . FIRST_NAME_ERROR;
    } else {
      echo $firstname . owpDrawHiddenField('firstname');
    }
  } else {
    echo owpInputField('firstname', $account['customers_firstname']) . '&nbsp;' . TEXT_FIELD_REQUIRED;
  }
?></td>
          </tr>
          <tr>
            <td class="main">&nbsp;<?php echo LAST_NAME; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo $account['customers_lastname'];
  } elseif ($error) {
    if ($entry_lastname_error) {
      echo owpInputField('lastname') . '&nbsp;' . LAST_NAME_ERROR;
    } else {
      echo $lastname . owpDrawHiddenField('lastname');
    }
  } else {
    echo owpInputField('lastname', $account['customers_lastname']) . '&nbsp;' . TEXT_FIELD_REQUIRED;
  }
?></td>
          </tr>
          <tr>
            <td class="main">&nbsp;<?php echo EMAIL_ADDRESS; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo $account['customers_email_address'];
  } elseif ($error) {
    if ($entry_email_address_error) {
      echo owpInputField('email_address') . '&nbsp;' . EMAIL_ADDRESS_ERROR;
    } elseif ($entry_email_address_check_error) {
      echo owpInputField('email_address') . '&nbsp;' . EMAIL_ADDRESS_CHECK_ERROR;
    } elseif ($entry_email_address_exists) {
      echo owpInputField('email_address') . '&nbsp;' . EMAIL_ADDRESS_ERROR_EXISTS;
    } else {
      echo $email_address . owpDrawHiddenField('email_address');
    }
  } else {
    echo owpInputField('email_address', $account['customers_email_address']) . '&nbsp;' . TEXT_FIELD_REQUIRED;
  }
?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>

  <tr>
    <td class="formAreaTitle"><br><?php echo CATEGORY_CONTACT; ?></td>
  </tr>
  <tr>
    <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main">&nbsp;<?php echo TELEPHONE_NUMBER; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo $account['customers_telephone'];
  } elseif ($error) {
    if ($entry_telephone_error) {
      echo owpInputField('telephone') . '&nbsp;' . TELEPHONE_NUMBER_ERROR;
    } else {
      echo $telephone . owpDrawHiddenField('telephone');
    }
  } else {
    echo owpInputField('telephone', $account['customers_telephone']) . '&nbsp;' . TEXT_FIELD_REQUIRED;
  }
?></td>
          </tr>
          <tr>
            <td class="main">&nbsp;<?php echo FAX_NUMBER; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    echo $account['customers_fax'];
  } elseif ($processed) {
    echo $fax . owpDrawHiddenField('fax');
  } else {
    echo owpInputField('fax', $account['customers_fax']) . '&nbsp;' . FAX_NUMBER_TEXT;
  }
?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="formAreaTitle"><br><?php echo CATEGORY_OPTIONS; ?></td>
  </tr>
  <tr>
    <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main">&nbsp;<?php echo NEWSLETTER; ?></td>
            <td class="main">&nbsp;
<?php
  if ($is_read_only) {
    if ($account['customers_newsletter'] == '1') {
      echo NEWSLETTER_YES;
    } else {
      echo NEWSLETTER_NO;
    }
  } elseif ($processed) {
    if ($newsletter == '1') {
      echo NEWSLETTER_YES;
    } else {
      echo NEWSLETTER_NO;
    }
    echo owpDrawHiddenField('newsletter');  
  } else {
    echo owpPullDownMenu('newsletter', $newsletter_array, $account['customers_newsletter']) . '&nbsp;' . TEXT_FIELD_REQUIRED;
  }
?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
<?php
  if (!$new_account) {
?>
  <tr>
    <td class="formAreaTitle"><br><?php echo CATEGORY_PASSWORD; ?></td>
  </tr>
  <tr>
    <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main">&nbsp;<?php echo PASSWORD; ?></td>
            <td class="main">&nbsp;
<?php
    if ($error) {
      if ($entry_password_error) {
        echo tep_draw_password_field('password') . '&nbsp;' . PASSWORD_ERROR;
      } else {
        echo PASSWORD_HIDDEN . owpDrawHiddenField('password') . owpDrawHiddenField('confirmation');
      }
    } else {
      echo tep_draw_password_field('password') . '&nbsp;' . PASSWORD_TEXT;
    }
?></td>
          </tr>
<?php
    if ( (!$error) || ($entry_password_error) ) {
?>
          <tr>
            <td class="main">&nbsp;<?php echo PASSWORD_CONFIRMATION; ?></td>
            <td class="main">&nbsp;
<?php
      echo tep_draw_password_field('confirmation') . '&nbsp;' . PASSWORD_CONFIRMATION_TEXT;
?></td>
          </tr>
<?php
    }
?>
        </table></td>
      </tr>
    </table></td>
  </tr>
<?php
  }
?>
</table>
