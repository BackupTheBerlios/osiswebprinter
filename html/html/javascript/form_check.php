<?php
/* ----------------------------------------------------------------------
   $Id: form_check.php,v 1.4 2003/05/05 16:51:37 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: form_check.js.php,v 1.7 2002/11/01 02:06:17 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */
?>
<script language="javascript"><!--

var submitted = false;

function check_form() {
  var error = 0;
  var error_message = "<?php echo JS_ERROR; ?>";

  if(submitted){ 
    alert( "<?php echo JS_ERROR_SUBMITTED; ?>"); 
    return false; 
  }
   
  var first_name = document.account_edit.firstname.value;
  var last_name = document.account_edit.lastname.value;

  var email_address = document.account_edit.email_address.value;  
  var telephone = document.account_edit.telephone.value;
<?php
  if (JS_PASSWORD == 'true') {
?>
  var password = document.account_edit.password.value;
  var confirmation = document.account_edit.confirmation.value;
<?php
  }
?>

  if (document.account_edit.elements['gender'].type != "hidden") {
    if (document.account_edit.gender[0].checked || document.account_edit.gender[1].checked) {
    } else {
      error_message = error_message + "<?php echo JS_GENDER; ?>";
      error = 1;
    }
  }

  if (document.account_edit.elements['firstname'].type != "hidden") {
    if (first_name == '' || first_name.length < <?php echo FIRST_NAME_MIN_LENGTH; ?>) {
      error_message = error_message + "<?php echo JS_FIRST_NAME; ?>";
      error = 1;
    }
  }

  if (document.account_edit.elements['lastname'].type != "hidden") {
    if (last_name == '' || last_name.length < <?php echo LAST_NAME_MIN_LENGTH; ?>) {
      error_message = error_message + "<?php echo JS_LAST_NAME; ?>";
      error = 1;
    }
  }

  if (document.account_edit.elements['email_address'].type != "hidden") {
    if (email_address == '' || email_address.length < <?php echo EMAIL_ADDRESS_MIN_LENGTH; ?>) {
      error_message = error_message + "<?php echo JS_EMAIL_ADDRESS; ?>";
      error = 1;
    }
  }

  if (document.account_edit.elements['telephone'].type != "hidden") {
    if (telephone == '' || telephone.length < <?php echo TELEPHONE_MIN_LENGTH; ?>) {
      error_message = error_message + "<?php echo JS_TELEPHONE; ?>";
      error = 1;
    }
  }
<?php
  if (JS_PASSWORD == 'true') {
?>
  if (document.account_edit.elements['password'].type != "hidden") {
    if ((password != confirmation) || (password == '' || password.length < <?php echo PASSWORD_MIN_LENGTH; ?>)) {
      error_message = error_message + "<?php echo JS_PASSWORD; ?>";
      error = 1;
    }
  }
<?php
  }
?>
  if (error == 1) { 
    alert(error_message); 
    return false; 
  } else { 
    submitted = true; 
    return true; 
  } 
}
//--></script>