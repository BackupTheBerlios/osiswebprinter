<?php
/* ----------------------------------------------------------------------
   $Id: gui.php,v 1.10 2003/04/01 02:30:23 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:

   File: gui.php,v 1.18.2.1 2002/04/03 21:03:19 jgm 
   ----------------------------------------------------------------------
   POST-NUKE Content Management System
   Copyright (C) 2001 by the Post-Nuke Development Team.
   http://www.postnuke.com/
   ----------------------------------------------------------------------
   Based on:
   PHP-NUKE Web Portal System - http://phpnuke.org/
   Thatware - http://thatware.org/
   ----------------------------------------------------------------------
   LICENSE

   This program is free software; you can redistribute it and/or
   modify it under the terms of the GNU General Public License (GPL)
   as published by the Free Software Foundation; either version 2
   of the License, or (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.
 
   To read the license please visit http://www.gnu.org/copyleft/gpl.html
   ----------------------------------------------------------------------
   Original Author of file:  Gregor J. Rothfuss
   Purpose of file: Provide gui rendering functions for the installer.
   ---------------------------------------------------------------------- */
   
function owp_prepare_input($string) {
   return trim(stripslashes($string));
}

/*** This function prints the "This is your setting" area ***/
function owp_form_text($border=0) {
   global $_POST;

   $formText = '<table border="' . $border . '">' . "\n" .
               ' <tr>' . "\n" .
               '   <td align="left"><font class="owp-normal">' . DBHOST . '</font></td>' . "\n" .
               '   <td><font class="owp-normal">' . $_POST['dbhost'] . '</font></td>' . "\n" .
               ' </tr>' . "\n" .
               ' <tr>' . "\n" .
               '   <td align="left"><font class="owp-normal">' . DBUNAME . '</font></td>' . "\n" .
               '   <td><font class="owp-normal">' . $_POST['dbuname'] . '</font></td>' . "\n" .
               ' </tr>' . "\n" .
               ' <tr>' . "\n" .
               '  <td align="left"><font class="owp-normal">' . DBPASS . '</font></td>' . "\n" .
               '  <td><font class="owp-normal">' . $_POST['dbpass'] . '</font></td>' . "\n" .
               ' </tr>' . "\n" .
               ' <tr>' . "\n" .
               '   <td align="left"><font class="owp-normal">' . DBNAME . '</font></td>' . "\n" .
               '   <td><font class="owp-normal">' . $_POST['dbname'] . '</font></td>' . "\n" .
               ' </tr>' . "\n" .
               ' <tr>' . "\n" .
               '   <td align="left"><font class="owp-normal">' . DBPREFIX . '</font></td>' . "\n" .
               '   <td><font class="owp-normal">' . $_POST['prefix'] . '</font></td>' . "\n" .
               ' </tr>' . "\n" .
               ' <tr>' . "\n" .
               '   <td align="left"><font class="owp-normal">' . DBTYPE . '</font></td>' . "\n" .
               '   <td><font class="owp-normal">' . $_POST['dbtype'] . '</font></td>' . "\n" .
               ' </tr>' . "\n" .
               '</table>' . "\n";
   return $formText;
}


function owp_form_editabletext($border = '0') {
   global $dbhost, $dbuname, $dbpass, $dbname, $prefix;

   $ediTable = '<table border="' . $border . '">' . "\n" .
               ' <tr>' . "\n" .
               '   <td align="left"><font class="owp-normal">' . DBHOST . '</font></td>' . "\n" .
               '   <td><input type="text" name="dbhost" SIZE=30 maxlength=80 value="' . $dbhost . '"></td>' . "\n" .
               ' </tr>' . "\n" .
               ' <tr>' . "\n" .
               '   <td align="left"><font class="owp-normal">' . DBUNAME . '</font></td>' . "\n" .
               '   <td><input type="text" name="dbuname" SIZE=30 maxlength=80 value="' . $dbuname . '"></td>' . "\n" .
               ' </tr>' . "\n" .
               ' <tr>' . "\n" .
               '  <td align="left"><font class="owp-normal">' . DBPASS . '</font></td>' . "\n" .
               '  <td><input type="text" name="dbpass" SIZE=30 maxlength=80 value="' . $dbpass . '"></td>' . "\n" .
               ' </tr>' . "\n" .
               ' <tr>' . "\n" .
               '   <td align="left"><font class="owp-normal">' . DBNAME . '</font></td>' . "\n" .
               '   <td><input type="text" name="dbname" SIZE=30 maxlength=80 value="' . $dbname . '"></td>' . "\n" .
               ' </tr>' . "\n" .
               ' <tr>' . "\n" .
               '   <td align="left"><font class="owp-normal">' . DBPREFIX . '</font></td>' . "\n" .
               '   <td><input type="text" name="prefix" SIZE=30 maxlength=80 value="' . $prefix .'"></td>' . "\n" .
               ' </tr>' . "\n" .
               ' <tr>' . "\n" .
               '   <td align="left"><font class="owp-normal">' . DBTYPE . '</font></td>' . "\n" .
               '   <td><select name="dbtype"><option value="mysql" selected>&nbsp;MySQL&nbsp;</option></select></td>' . "\n" .
               ' </tr>' . "\n" .
               '</table>' . "\n";
   return $ediTable;
}


/*** This function prints the <input type=hidden> area ***/
function owp_form_hidden() {
   global $_POST;

   $formHidden = '<input type="hidden" name="currentlang" value="' . $_POST['currentlang'] . '">' . "\n" .
                 '<input type="hidden" name="dbhost" value="' . $_POST['dbhost'] . '">' . "\n" .
                 '<input type="hidden" name="dbuname" value="' . $_POST['dbuname'] . '">' . "\n" .
                 '<input type="hidden" name="dbpass" value="' . $_POST['dbpass'] . '">' . "\n" .
                 '<input type="hidden" name="dbname" value="' . $_POST['dbname'] . '">' . "\n" .
                 '<input type="hidden" name="prefix" value="' . $_POST['prefix'] . '">' . "\n" .
                 '<input type="hidden" name="dbtype" value="' . $_POST['dbtype'] . '">' . "\n";
   return $formHidden;
}


function owp_CHM_check() {
   global $currentlang;

   $chmCheck = '<font class="owp-title">' . DBINFO. '&nbsp;</font>' . 
               '<font class="owp-normal">' . CHM_CHECK_1 . '</font><br /><br />' . "\n" .
               '<form action="index.php" method="post"><center>' . "\n";
   $chmCheck .= owp_form_editabletext(0);
   $chmCheck .= '<input type="hidden" name="currentlang" value="' . $currentlang .'">' . "\n" .
                '<input type="hidden" name="op" value="Submit"><br /><br />' . "\n" .
                '<input type="submit" value="' . BTN_SUBMIT . '"></center></form>' . "\n";
   return $chmCheck;
}


function owp_submit() {
  $submit = '<font class="owp-title">' . DBINFO . '</font>' .
            '<font class="owp-normal"> ' . SUBMIT_1 . '</font><br /><br />' . "\n" .
            '<br /><font class="owp-normal">' . SUBMIT_2 . '</font><br /><br />' . "\n" .
            '<center>';               
  $submit .= owp_form_text();
  $submit .= '<form action="index.php" method="post">' . "\n" .
             '<input type="submit" name="op" value="Change Info"><br />' . "\n" .
             '</center>' . "\n" .
             '<br /><br />' . "\n" .
             '<font class="owp-normal">' . SUBMIT_3 . '</font><br />' . "\n" .
             '<table width="50%" align="center">' . "\n" .
             ' <tr align="right">' . "\n" .
             '  <td>' . "\n";
  $submit .= owp_form_hidden();
  $submit .= '<input type="submit" name="op" value="New Install"></td>' . "\n" .
#            '  <td><input type="submit" name="op" value="Upgrade"></td>' . "\n" .
             ' </tr>' . "\n" .
             '</table></form>' . "\n";
   return $submit;
}


function owp_change_info() {
   global $_POST;
 
   $dbhost = owp_prepare_input($_POST['dbhost']);
   $dbuname = owp_prepare_input($_POST['dbuname']);
   $dbpass = owp_prepare_input($_POST['dbpass']);
   $dbname = owp_prepare_input($_POST['dbname']);
   $prefix = owp_prepare_input($_POST['prefix']);
   
   $changeInfo = '<font class="owp-title">' . CHANGE_INFO_1 . '</font>' . 
                 '&nbsp;<font class="owp-normal">' . CHANGE_INFO_2 . '<br /><br />' . "\n" .
                 '<form action="index.php" method="post"><center>' . "\n" .
                 '<table border="0">' . "\n" .
                 ' <tr>' . "\n" .
                 '   <td align="left"><font class="owp-normal">' . DBHOST . '</font></td>' . "\n" .
                 '   <td><input type="text" name="dbhost" SIZE=30 maxlength=80 value="' . $dbhost . '"></td>' . "\n" .
                 ' </tr>' . "\n" .
                 ' <tr>' . "\n" .
                 '   <td align="left"><font class="owp-normal">' . DBUNAME . '</font></td>' . "\n" .
                 '   <td><input type="text" name="dbuname" SIZE=30 maxlength=80 value="' . $dbuname . '"></td>' . "\n" .
                 ' </tr>' . "\n" .
                 ' <tr>' . "\n" .
                 '  <td align="left"><font class="owp-normal">' . DBPASS . '</font></td>' . "\n" .
                 '  <td><input type="text" name="dbpass" SIZE=30 maxlength=80 value="' . $dbpass . '"></td>' . "\n" .
                 ' </tr>' . "\n" .
                 ' <tr>' . "\n" .
                 '   <td align="left"><font class="owp-normal">' . DBNAME . '</font></td>' . "\n" .
                 '   <td><input type="text" name="dbname" SIZE=30 maxlength=80 value="' . $dbname . '"></td>' . "\n" .
                 ' </tr>' . "\n" .
                 ' <tr>' . "\n" .
                 '   <td align="left"><font class="owp-normal">' . DBPREFIX . '</font></td>' . "\n" .
                 '   <td><input type="text" name="prefix" SIZE=30 maxlength=80 value="' . $prefix .'"></td>' . "\n" .
                 ' </tr>' . "\n" .
                 ' <tr>' . "\n" .
                 '   <td align="left"><font class="owp-normal">' . DBTYPE . '</font></td>' . "\n" .
                 '   <td><select name="dbtype"><option value="mysql" selected>&nbsp;MySQL&nbsp;</option></select></td>' . "\n" .
                 ' </tr>' . "\n" .
                 '</table>' . "\n" .
                 '<br /><br />' . "\n" .
                 '<input type="hidden" name="currentlang" value="' . $_POST['currentlang'] . '">' . "\n" .
                 '<input type="hidden" name="op" value="Submit">' . "\n" .
                 '<input type="submit" value="' . BTN_SUBMIT . '">' . "\n" .
                 '</center></form></font>' . "\n";
   return $changeInfo;
}


function owp_new_install() {
   $newInstall = '<font class="owp-title">New Install</font>' . 
                 '<font class="owp-normal"> ' . NEW_INSTALL_1 . '</font>' . "\n" .
                 '<br /><br /><center>' . "\n";
   $newInstall .= owp_form_text(0);  
   $newInstall .= '<br /><br /><font class="owp-normal">' . NEW_INSTALL_2 . '</font>' . "\n" .
                  '<form action="index.php" method="post"><table width="50%">' . "\n" .
                  ' <tr>' . "\n" .
                  '   <td align=center><font class="owp-normal">' . NEW_INSTALL_3 . '</font>' . "\n" .
                  '     <br /><input type=checkbox name="dbmake"><br /></td>' . "\n" .
                  '   <td>';
   $newInstall .= owp_form_hidden();
   $newInstall .= '  <input type="hidden" name="op" value="Start">' . "\n" .
                  '  <input type="submit" value="' . BTN_START . '">' . "\n" .
                  '  </td>' . "\n" .
                  ' </tr>' . "\n" .
                  '</table>' . "\n" .
                  '</form></font></center>' . "\n";
   return $newInstall;  
}


function owp_start() {
   $bodyStart = '<form action="index.php" method="post"><table width="50%" align=center>' . "\n" .
                ' <tr>' . "\n" .
                '   <td align=center>' . "\n";
   $bodyStart .= owp_form_hidden();
   $bodyStart .= '<input type="hidden" name="op" value="Continue">' . "\n" .
                 '<input type="submit" value="' . BTN_CONTINUE . '"></td>' . "\n" .
                 ' </tr>' . "\n" .
                 '</table></form>' . "\n";
   return $bodyStart;             
}


function owp_continue() {
 $continue = '<font class="owp-title">' . CONTINUE_1 . '</font>' . "\n" .
             '<font class="owp-normal">' . CONTINUE_2 . '</font>' . "\n" .
             '<br /><br />' . "\n" .
             '<center><form action="index.php" method="post"><table width="50%" border=1>' . "\n" .
             ' <tr>' . "\n" .
             '  <td align="left"><font class="owp-normal">' . ADMIN_LOGIN . '</font></td>' . "\n" .
             '  <td><input type="text" name="aid" SIZE=30 maxlength=80 value="Admin"></td>' . "\n" .
             ' </tr>' . "\n" .
             ' <tr>' . "\n" .
             '  <td align="left"><font class="owp-normal">' . ADMIN_NAME . '</font></td>' . "\n" .
             '  <td><input type="text" name="name" SIZE=30 maxlength=80 value="Admin"></td>' . "\n" .
             ' </tr>' . "\n" .
             ' <tr>' . "\n" .
             '  <td align="left"><font class="owp-normal">' . ADMIN_PASS . '</font></td>' . "\n" .
             '  <td><input type="password" name="pwd" SIZE=30 maxlength=80 value=""></td>' . "\n" .
             ' </tr>' . "\n" .
             ' <tr>' . "\n" .
             '  <td align="left"><font class="owp-normal">' . ADMIN_REPEATPASS . '</font></td>' . "\n" .
             '  <td><input type="password" name="repeatpwd" SIZE=30 maxlength=80 value=""></td>' . "\n" .
             ' </tr>' . "\n" .
             ' <tr>' . "\n" .
             '  <td align="left"><font class="owp-normal">' . ADMIN_EMAIL . '</font></td>' . "\n" .
             '  <td><input type="text" name="email" SIZE=30 maxlength=80 value="none@none.com"></td>' . "\n" .
             ' </tr>' . "\n" .
             ' <tr>' . "\n" .
             '  <td align="left"><font class="owp-normal">' . ADMIN_URL . '</font></td>' . "\n" .
             '  <td><input type="text" name="url" SIZE=30 maxlength=80 value="http://www.osisnet.de"></td>' . "\n" .
             ' </tr>' . "\n" .
             '</table>' . "\n";
   $continue .= owp_form_hidden();
   $continue .= '<input type="hidden" name="op" value="Set Login">' . "\n" .
                '<input type="submit" value="' . BTN_SET_LOGIN . '">' . "\n" .
                '</form></center>' . "\n";
   return $continue;

}


function owp_set_login() {
   $setLogin .= '<form action="index.php" method="post"><center><table width="50%">' . "\n";
   $setLogin .= owp_form_hidden();
   $setLogin .= '<tr><td align=center><input type="hidden" name="op" value="Finish">' . "\n" .
                '<input type="submit" value="' . BTN_FINISH . '"></td></tr></table></center></form>' . "\n";
   return $setLogin;               
}


function owp_finish() {
   global $currentlang;
   
   echo '<font class="owp-title">' . FINISH_1 . '</font>';
   echo '<font class="owp-normal">' . FINISH_2 . '<br /><br />';
   echo '<form action="index.php" method="post">';
   echo '<center><textarea name="license" cols=50 rows=8>';

   include("lang/" . $currentlang . "/CREDITS.txt");

   echo '</textarea><br /><br />' . FINISH_3 . '</center></form></font>';
   echo '<br /><br /><center><b><a href="index.php">' . FINISH_4 . '</a></b>';
   echo '</center><br /><br />';
}


function owp_success() {
   $success = '<font class="owp-title">' . SUCCESS_1 . '</font>' . "\n" .
              '<font class="owp-normal">' . SUCCESS_2 . '<br /><br />' . "\n" .
              '<form action="index.php" method="post"><center><table width="50%">' . "\n";
   $success .= owp_form_hidden();
   $success .= '<tr><td align=center><input type="hidden" name="op" value="Finish">' . "\n" .
               '<input type="submit" value="' . BTN_FINISH . '"></td>' . "\n" .
               '</tr></table></center></form></font><br /><br />' . "\n";
   return $success;
}


function owp_default() {
   global $currentlang;
  
   echo '<font class="owp-normal">' . DEFAULT_1  . '</font><br /><br />';
   echo '<font class="owp-normal">' . DEFAULT_2  . '</font><br /><br />';
   echo '<font class="owp-normal">' . DEFAULT_3  . '</font><br /><br />';
   echo '<font class="owp-title">' . DEFAULT_4 . '</font>';
   echo '<font class="owp-normal">' . DEFAULT_5 . '<br /><br />';
   echo '<form name="license"><center>';
   echo '<textarea name="license" cols=60 rows=10>';

   include("../docs/LICENSE.txt");

   echo  '</textarea></form><br /><br />';  
   echo '<form name="next" action="index.php" method="post"><center>';
   echo '<input type="hidden" name="currentlang" value="' . $currentlang . '">';
   echo '<input type="hidden" name="op" value="PHP_Check">';
   echo '<input type="submit" value="' . BTN_NEXT . '"></center>';
   echo '</form>';
}


function owp_select_language() {
   $selectLanguage = '<br />' . "\n" .
                     '<p><font class="owp-pageGreat">' . GREAT . '</font></p>' . "\n" .
                     '<p><font class="owp-main">' . GREAT_1 . '</font></p>' . "\n" .
                     '<p><img src="images/trans.gif" width="1%" height="40" border="0" alt=" "></p>' . "\n" .
                     '<p><font class="owp-title">' . SELECT_LANGUAGE_1 . '</font></p>' . "\n" .
                     '<form action="index.php" method="post"><table width="400" align="center" border="0"><tr>' . "\n" .
                     '<td align="center"><font class="owp-normal">' . SELECT_LANGUAGE_2;
   $selectLanguage .= lang_dropdown();
   $selectLanguage .= '<input type="hidden" name="op" value="Set Language">' . "\n" .
                      '<input type="submit" value="' . BTN_SET_LANGUAGE . '"></td></tr>' . "\n" .
                      '</table></form></font>' . "\n";
   return $selectLanguage;
}

?>
