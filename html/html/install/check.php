<?php
/* ----------------------------------------------------------------------
   $Id: check.php,v 1.3 2003/03/28 02:54:52 r23 Exp $

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

   if (phpversion() < "4.0.1") {
      $phpver = phpversion();
      echo "<br /><font class=\"ow-title\">"._PHP_CHECK_1.$phpver."<br />
      "._PHP_CHECK_2."</font><br />";
   }

   if (get_magic_quotes_gpc() == 0) {
      echo "<br /><font class=\"ow-title\">"._PHP_CHECK_3."</font><br />";
   }

   if (get_magic_quotes_runtime() == 1) {
      echo "<br /><font class=\"ow-title\">"._PHP_CHECK_4."</font><br />";
   }
}

/** Checks if config.php has the correct permissions set **/
function do_check_chmod() {
   global $currentlang;

   echo "<font class=\"ow-title\">"._CHMOD_CHECK_1."</font><br /><br />
   <font class=\"ow-normal\">"._CHMOD_CHECK_2."</font>";
   $file='../includes/config.php';

//   $mode = fileperms($file);
//   $mode &= 0x1ff; # Remove the bits we don't need
//   $chmod = sprintf("%o", $mode);
//   if ($chmod == '666'){

   if (is_writable($file)){
      echo "<br /><br /><font class=\"ow-title\">"._CHMOD_CHECK_3."</font><br />";
   } else {
     echo "<br /><br /><font class=\"ow-title\">"._CHMOD_CHECK_4."</font><br />";
   }

   $file='../includes/config-old.php';

//   $mode = fileperms($file);
//   $mode &= 0x1ff; # Remove the bits we don't need
//   $chmod = sprintf("%o", $mode);
//   if ($chmod == '666'){

   if (is_writable($file)){
     echo "<p><font class=\"ow-title\">"._CHMOD_CHECK_5."</font></p>
     <p><form action=\"index.php\" method=\"post\">
     <input type=\"hidden\" name=\"currentlang\" value=\"$currentlang\">
     <center><input type=\"hidden\" name=\"op\" value=\"CHM_check\">
     <input type=\"submit\" value=\""._BTN_CONTINUE."\"></center></form></p>";
   } else {
     echo "<font class=\"ow-title\">"._CHMOD_CHECK_6."</font>
     <p><form action=\"index.php\" method=\"post\">
     <input type=\"hidden\" name=\"currentlang\" value=\"$currentlang\">
     <center><input type=\"hidden\" name=\"op\" value=\"Check\">
     <input type=\"submit\" value=\""._BTN_RECHECK."\"></center></form></p>";
   }
}
?>
