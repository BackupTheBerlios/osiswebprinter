<?php
/* ----------------------------------------------------------------------
   $Id: gui.php,v 1.8 2003/03/31 16:40:09 r23 Exp $

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

/*** This function prints the "This is your setting" area ***/
function print_form_text($border=0) {
   global $dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype;

   $body_main = '<table border="' . $border . '">' . "\n" .
                ' <tr>' . "\n" .
                '   <td align="left"><font class="ow-normal">' . DBHOST . '</font></td>' . "\n" .
                '   <td><font class="ow-normal">' . $dbhost . '</font></td>' . "\n" .
                ' </tr>' . "\n" .
                ' <tr>' . "\n" .
                '   <td align="left"><font class="ow-normal">' . DBUNAME . '</font></td>' . "\n" .
                '   <td><font class="ow-normal">' . $dbuname . '</font></td>' . "\n" .
                ' </tr>' . "\n" .
                ' <tr>' . "\n" .
                '  <td align="left"><font class="ow-normal">' . DBPASS . '</font></td>' . "\n" .
                '  <td><font class="ow-normal">' . $dbpass . '</font></td>' . "\n" .
                ' </tr>' . "\n" .
                ' <tr>' . "\n" .
                '   <td align="left"><font class="ow-normal">' . DBNAME . '</font></td>' . "\n" .
                '   <td><font class="ow-normal">' . $dbname . '</font></td>' . "\n" .
                ' </tr>' . "\n" .
                ' <tr>' . "\n" .
                '   <td align="left"><font class="ow-normal">' . DBPREFIX . '</font></td>' . "\n" .
                '   <td><font class="ow-normal">' . $prefix . '</font></td>' . "\n" .
                ' </tr>' . "\n" .
                ' <tr>' . "\n" .
                '   <td align="left"><font class="ow-normal">' . DBTYPE . '</font></td>' . "\n" .
                '   <td><font class="ow-normal">' . $dbtype . '</font></td>' . "\n" .
                ' </tr>' . "\n" .
                '</table>' . "\n";
   return $body_main;
}


function print_form_editabletext($border = '0') {
   global $dbhost, $dbuname, $dbpass, $dbname, $prefix;

   $body_main = '<table border="' . $border . '">' . "\n" .
                ' <tr>' . "\n" .
                '   <td align="left"><font class="ow-normal">' . DBHOST . '</font></td>' . "\n" .
                '   <td><input type="text" NAME="dbhost" SIZE=30 maxlength=80 value="' . $dbhost . '"></td>' . "\n" .
                ' </tr>' . "\n" .
                ' <tr>' . "\n" .
                '   <td align="left"><font class="ow-normal">' . DBUNAME . '</font></td>' . "\n" .
                '   <td><input type="text" NAME="dbuname" SIZE=30 maxlength=80 value="' . $dbuname . '"></td>' . "\n" .
                ' </tr>' . "\n" .
                ' <tr>' . "\n" .
                '  <td align="left"><font class="ow-normal">' . DBPASS . '</font></td>' . "\n" .
                '  <td><input type="text" NAME="dbpass" SIZE=30 maxlength=80 value="' . $dbpass . '"></td>' . "\n" .
                ' </tr>' . "\n" .
                ' <tr>' . "\n" .
                '   <td align="left"><font class="ow-normal">' . DBNAME . '</font></td>' . "\n" .
                '   <td><input type="text" NAME="dbname" SIZE=30 maxlength=80 value="' . $dbname . '"></td>' . "\n" .
                ' </tr>' . "\n" .
                ' <tr>' . "\n" .
                '   <td align="left"><font class="ow-normal">' . DBPREFIX . '</font></td>' . "\n" .
                '   <td><input type="text" NAME="prefix" SIZE=30 maxlength=80 value="' . $prefix .'"></td>' . "\n" .
                ' </tr>' . "\n" .
                ' <tr>' . "\n" .
                '   <td align="left"><font class="ow-normal">' . DBTYPE . '</font></td>' . "\n" .
                '   <td><select name="dbtype"><option value="mysql" selected>&nbsp;MySQL&nbsp;</option></select></td>' . "\n" .
                ' </tr>' . "\n" .
                '</table>' . "\n";
   return $body_main;
}


/*** This function prints the <input type=hidden> area ***/
function print_form_hidden() {
   global $currentlang, $dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype;

   $body_hidden = '<input type="hidden" NAME="currentlang" value="' . $currentlang . '">' . "\n" .
                  '<input type="hidden" NAME="dbhost" value="' . $dbhost . '">' . "\n" .
                  '<input type="hidden" NAME="dbuname" value="' . $dbuname . '">' . "\n" .
                  '<input type="hidden" NAME="dbpass" value="' . $dbpass . '">' . "\n" .
                  '<input type="hidden" NAME="dbname" value="' . $dbname . '">' . "\n" .
                  '<input type="hidden" NAME="prefix" value="' . $prefix . '">' . "\n" .
                  '<input type="hidden" NAME="dbtype" value="' . $dbtype . '">' . "\n";
   return $body_hidden;
}


function print_CHM_check() {
   global $currentlang;

   $body_main = '<font class="ow-title">' . DBINFO. '&nbsp;</font>' . 
                '<font class="ow-normal">' . CHM_CHECK_1 . '</font><br /><br />' . "\n" .
                '<form action="index.php" method="post"><center>' . "\n";
   
   $body_main .= print_form_editabletext(0);
   
   $body_main .= '<input type="hidden" NAME="currentlang" value="' . $currentlang .'">' . "\n" .
                 '<input type="hidden" name="op" value="Submit"><br /><br />' . "\n" .
                 '<input type="submit" value="' . BTN_SUBMIT . '"></center></form>' . "\n";
   return $body_main;
}


function print_submit() {
  $body_main = '<font class="ow-title">' . DBINFO . '</font>' .
               '<font class="ow-normal"> ' . SUBMIT_1 . '</font><br /><br />' . "\n" .
               '<br /><font class="ow-normal">' . SUBMIT_2 . '</font><br /><br />' . "\n" .
               '<center>';
               
  $body_main .= print_form_text();
  
  $body_main .='<form action="index.php" method="post">' . "\n" .
               '<input type="submit" name="op" value="Change Info"><br />' . "\n" .
               '</center>' . "\n" .
               '<br /><br />' . "\n" .
               '<font class="ow-normal">' . SUBMIT_3 . '</font><br />' . "\n" .
               '<table width="50%" align="center">' . "\n" .
               ' <tr align="right">' . "\n" .
               '  <td>' . "\n";
  
  $body_main .= print_form_hidden();
  
  $body_main .= '<input type="submit" name="op" value="New Install"></td>' . "\n" .
#               '  <td><input type="submit" name="op" value="Upgrade"></td>' . "\n" .
                ' </tr>' . "\n" .
                '</table></form>' . "\n";
   return $body_main;
}


function print_change_info() {
   $body_main = '<font class="ow-title">' . CHANGE_INFO_1 . '</font>' . 
                '<font class="ow-normal">' . CHANGE_INFO_2 . '<br /><br />' . "\n" .
                '<form action="index.php" method="post"><center>' . "\n";

   $body_main .= print_form_editabletext(0);

   $body_main .= '<input type="hidden" name="op" value="Submit">' . "\n" .
                 '<input type="submit" value="' . BTN_SUBMIT . '">' . "\n" .
                 '</center></form></font>' . "\n";
   return $body_main;
}


function print_new_install() {
   $body_main = '<font class="ow-title">New Install</font>' . 
                '<font class="ow-normal"> ' . NEW_INSTALL_1 . '</font>' . "\n" .
                '<br /><br /><center>' . "\n";
   
   $body_main .= print_form_text(0);
   
   $body_main .= '<br /><br /><font class="ow-normal">' . NEW_INSTALL_2 . '</font>' . "\n" .
                 '<form action="index.php" method="post"><table width="50%">' . "\n" .
                 ' <tr>' . "\n" .
                 '   <td align=center><font class="ow-normal">' . NEW_INSTALL_3 . '</font>' . "\n" .
                 '     <br /><input type=checkbox name="dbmake"><br /></td>' . "\n" .
                 '   <td>';
   
   $body_main .= print_form_hidden();
   
   $body_main .= '  <input type="hidden" name="op" value="Start">' . "\n" .
                 '  <input type="submit" value="' . BTN_START . '">' . "\n" .
                 '  </td>' . "\n" .
                 ' </tr>' . "\n" .
                 '</table>' . "\n" .
                 '</form></font></center>' . "\n";
   return $body_main;  
}


function print_start() {
   $body_main = '<form action="index.php" method="post"><table width="50%" align=center>' . "\n" .
                ' <tr>' . "\n" .
                '   <td align=center>' . "\n";

   $body_main .= print_form_hidden();

   $body_main .= '<input type="hidden" name="op" value="Continue">' . "\n" .
                 '<input type="submit" value="' . BTN_CONTINUE . '"></td>' . "\n" .
                 ' </tr>' . "\n" .
                 '</table></form>' . "\n";
   return $body_main;             
}


function print_continue() {
 $body_main = '<font class="ow-title">' . CONTINUE_1 . '</font>' . "\n" .
              '<font class="ow-normal">' . CONTINUE_2 . '</font>' . "\n" .
              '<br /><br />' . "\n" .
              '<center><form action="index.php" method="post"><table width="50%" border=1>' . "\n" .
              ' <tr>' . "\n" .
              '  <td align="left"><font class="ow-normal">' . ADMIN_LOGIN . '</font></td>' . "\n" .
              '  <td><input type="text" NAME="aid" SIZE=30 maxlength=80 value="Admin"></td>' . "\n" .
              ' </tr>' . "\n" .
              ' <tr>' . "\n" .
              '  <td align="left"><font class="ow-normal">' . ADMIN_NAME . '</font></td>' . "\n" .
              '  <td><input type="text" NAME="name" SIZE=30 maxlength=80 value="Admin"></td>' . "\n" .
              ' </tr>' . "\n" .
              ' <tr>' . "\n" .
              '  <td align="left"><font class="ow-normal">' . ADMIN_PASS . '</font></td>' . "\n" .
              '  <td><input type="password" NAME="pwd" SIZE=30 maxlength=80 value=""></td>' . "\n" .
              ' </tr>' . "\n" .
              ' <tr>' . "\n" .
              '  <td align="left"><font class="ow-normal">' . ADMIN_REPEATPASS . '</font></td>' . "\n" .
              '  <td><input type="password" NAME="repeatpwd" SIZE=30 maxlength=80 value=""></td>' . "\n" .
              ' </tr>' . "\n" .
              ' <tr>' . "\n" .
              '  <td align="left"><font class="ow-normal">' . ADMIN_EMAIL . '</font></td>' . "\n" .
              '  <td><input type="text" NAME="email" SIZE=30 maxlength=80 value="none@none.com"></td>' . "\n" .
              ' </tr>' . "\n" .
              ' <tr>' . "\n" .
              '  <td align="left"><font class="ow-normal">' . ADMIN_URL . '</font></td>' . "\n" .
              '  <td><input type="text" NAME="url" SIZE=30 maxlength=80 value="http://www.osisnet.de"></td>' . "\n" .
              ' </tr>' . "\n" .
              '</table>' . "\n";

   $body_main .= print_form_hidden();
   
   $body_main .= '<input type="hidden" name="op" value="Set Login">' . "\n" .
                 '<input type="submit" value="' . BTN_SET_LOGIN . '">' . "\n" .
                 '</form></center>' . "\n";
   return $body_main;

}


function print_set_login() {
   $body_main .= '<form action="index.php" method="post"><center><table width="50%">' . "\n";

   $body_main .= print_form_hidden();

   $body_main .= '<tr><td align=center><input type="hidden" name="op" value="Finish">' . "\n" .
                 '<input type="submit" value="' . BTN_FINISH . '"></td></tr></table></center></form>' . "\n";
   return $body_main;               
}


function print_finish() {
   global $currentlang;
   
   echo '<font class="ow-title">' . FINISH_1 . '</font>';
   echo '<font class="ow-normal">' . FINISH_2 . '<br /><br />';
   echo '<form action="index.php" method="post">';
   echo '<center><textarea name="license" cols=50 rows=8>';

   include("lang/" . $currentlang . "/CREDITS.txt");

   echo '</textarea><br /><br />' . FINISH_3 . '</center></form></font>';
   echo '<br /><br /><center><b><a href="index.php">' . FINISH_4 . '</a></b>';
   echo '</center><br /><br />';
}


function print_success() {
   $body_main = '<font class="ow-title">' . SUCCESS_1 . '</font>' . "\n" .
                '<font class="ow-normal">' . SUCCESS_2 . '<br /><br />' . "\n" .
                '<form action="index.php" method="post"><center><table width="50%">' . "\n";

   $body_main .= print_form_hidden();

   $body_main .= '<tr><td align=center><input type="hidden" name="op" value="Finish">' . "\n" .
                 '<input type="submit" value="' . BTN_FINISH . '"></td>' . "\n" .
                 '</tr></table></center></form></font><br /><br />' . "\n";
   return $body_main;
}


function print_default() {
   echo '<font class="ow-normal">' . DEFAULT_1  . '</font><br /><br />';
   echo '<font class="ow-normal">' . DEFAULT_2  . '</font><br /><br />';
   echo '<font class="ow-normal">' . DEFAULT_3  . '</font><br /><br />';
   echo '<font class="ow-title">' . DEFAULT_4 . '</font>';
   echo '<font class="ow-normal">' . DEFAULT_5 . '<br /><br />';
   echo '<form action="index.php" method="post"><center>';
   echo '<textarea name="license" cols=60 rows=10>';

   include("../docs/LICENSE.txt");

   echo  '</textarea><br /><br /';

   echo print_form_hidden();

   echo '<input type="hidden" name="op" value="PHP_Check">';
   echo '<input type="submit" value="' . BTN_NEXT . '"></center>';
   echo '</form>';
}


function print_select_language() {
   $body_main = '<br />' . "\n" .
                '<p><font class="ow-pageGreat">' . GREAT . '</font></p>' . "\n" .
                '<p><font class="ow-main">' . GREAT_1 . '</font></p>' . "\n" .
                '<p><img src="images/trans.gif" width="1%" height="40" border="0" alt=" "></p>' . "\n" .
                '<p><font class="ow-title">' . SELECT_LANGUAGE_1 . '</font></p>' . "\n" .
                '<form action="index.php" method="post"><table width="400" align="center" border="0"><tr>' . "\n" .
                '<td align="center"><font class="ow-normal">' . SELECT_LANGUAGE_2;
   $body_main .= lang_dropdown();
   $body_main .= '<input type="hidden" name="op" value="Set Language">' . "\n" .
                 '<input type="submit" value="' . BTN_SET_LANGUAGE . '"></td></tr>' . "\n" .
                 '</table></form></font>' . "\n";
   return $body_main;
}

?>
