<?php
/* ----------------------------------------------------------------------
   $Id: check.php,v 1.7 2003/04/25 16:00:04 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: check.php,v 1.6 2002/02/04 18:51:32 voll 
   ----------------------------------------------------------------------
   POST-NUKE Content Management System
   Copyright (C) 2001 by the Post-Nuke Development Team.
   http://www.postnuke.com/
   ----------------------------------------------------------------------   
   Original Author of file: Gregor J. Rothfuss
   Purpose of file: Provide checks for the installer.
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */


/** Checks various php settings **/
/** by Bob Herald **/
function do_check_php() {
   global $currentlang;

   echo '<font class="owp-title">' . PHP_CHECK_1 . '</font><br /><br />';
   echo '<font class="owp-normal">' . PHP_CHECK_2. '</font><br />';
   
   $check_php = true;
   $phpver = phpversion();
   echo '<br /><font class="owp-title">' . PHP_CHECK_3 . $phpver. '</font><br />';

   if (phpversion() < '4.1.0') {
     echo '<font class="owp-error">' . PHP_CHECK_4 . '</font><br />';
     $check_php = false;
   } else {
     echo '<font class="owp-normal">' . PHP_CHECK_OK . '</font><br />';
   }

   if (get_magic_quotes_gpc() == 0) {
     echo '<br /><font class="owp-error">' . PHP_CHECK_6 . '</font><br />';
     echo '<font class="owp-title">' . PHP_CHECK_7 . '</font><br />';
     $check_php = false;
   } else {
     echo '<br /><font class="owp-title">' . PHP_CHECK_8 . '</font><br />';
   } 
   
   if (get_magic_quotes_runtime() == 1) {
     echo '<br /><font class="owp-error">' . PHP_CHECK_9. '</font><br />';
     echo '<font class="owp-title">' . PHP_CHECK_10 . '</font><br />';
     $check_php = false;
   } else {
     echo '<br /><font class="owp-title">' . PHP_CHECK_11 . '</font><br />';
   }
   
   if ($check_php == 'true') {
     echo '<p><form action="index.php" method="post">';
     echo '<input type="hidden" name="currentlang" value="' . $currentlang . '">';
     echo '<input type="hidden" name="op" value="Check">';
     echo '<center><input type="submit" value="' . BTN_CONTINUE . '"></center></form></p>';
   } else {
     echo '<p><form action="index.php" method="post">';
     echo '<input type="hidden" name="currentlang" value="' . $currentlang . '">';
     echo '<input type="hidden" name="op" value="PHP_Check">';
     echo '<center><input type="submit" value="' . BTN_RECHECK . '"></center></form></p>';
   }
   
   
   
}

/** Checks if config.php has the correct permissions set **/
function do_check_chmod() {
   global $currentlang;

   echo '<font class="owp-title">' . CHMOD_CHECK_1 . '</font><br /><br />';
   echo '<font class="owp-normal">' . CHMOD_CHECK_2. '</font>';
   
   $check_chmod = true;
   $file='../includes/config.php';
   if (is_writable($file)){
     echo '<br /><br /><font class="owp-title">' . CHMOD_CHECK_3 . '</font><br />';
   } else {
     echo '<br /><br /><font class="owp-error">' . CHMOD_CHECK_4 . '</font><br />';
     $check_chmod = false;
   }
   
   $file='../includes/config-old.php';
   if (is_writable($file)){
     echo '<p><font class="owp-title">' . CHMOD_CHECK_5 . '</font></p>';
   } else {
     echo '<p><font class="owp-error">' . CHMOD_CHECK_6 . '</font></p>';
     $check_chmod = false;
   }
   
   if ($check_chmod == 'true') {
     echo '<p><form action="index.php" method="post">';
     echo '<input type="hidden" name="currentlang" value="' . $currentlang . '">';
     echo '<input type="hidden" name="op" value="CHM_check">';
     echo '<center><input type="submit" value="' . BTN_CONTINUE . '"></center></form></p>';
   } else {
     echo '<p><form action="index.php" method="post">';
     echo '<input type="hidden" name="currentlang" value="' . $currentlang . '">';
     echo '<input type="hidden" name="op" value="Check">';
     echo '<center><input type="submit" value="' . BTN_RECHECK . '"></center></form></p>';
   }
}
?>
