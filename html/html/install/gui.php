<?php
/* ----------------------------------------------------------------------
   $Id: gui.php,v 1.5 2003/03/29 00:03:48 r23 Exp $

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
    global $dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype, $intranet;

   echo "
<table border=$border>
<tr><td align=\"left\"><font class=\"ow-normal\">"._DBHOST."</font></td>
<td><font class=\"ow-normal\">$dbhost</font></td></tr>
<tr><td align=\"left\"><font class=\"ow-normal\">"._DBUNAME."</font></td>
<td><font class=\"ow-normal\">$dbuname</font></td></tr>
<tr><td align=\"left\"><font class=\"ow-normal\">"._DBPASS."</font></td>
<td><font class=\"ow-normal\">$dbpass</font></td></tr>
<tr><td align=\"left\"><font class=\"ow-normal\">"._DBNAME."</font></td>
<td><font class=\"ow-normal\">$dbname</font></td></tr>
<tr><td align=\"left\"><font class=\"ow-normal\">"._DBPREFIX."</font></td>
<td><font class=\"ow-normal\">$prefix</font></td></tr>
<tr><td align=\"left\"><font class=\"ow-normal\">"._DBTYPE."</font></td>
<td><font class=\"ow-normal\">$dbtype</font></td></tr>
<tr><td align=\"left\"><font class=\"ow-normal\">"._ISINTRANET."</font></td>
<td><font class=\"ow-normal\">";
if (!empty($intranet)) {
    echo _YES;
} else {
    $intranet = 0;
    echo _NO;
}
echo "</font></td></tr>
</table>";
}

function print_form_editabletext($border=0) {
    global $dbhost, $dbuname, $dbpass, $dbname, $intranet, $prefix;

   echo "
<table border=$border>
<tr><td align=\"left\"><font class=\"ow-normal\">"._DBHOST."</font></td>
<td><input type=\"text\" NAME=\"dbhost\" SIZE=30 maxlength=80 value=\"$dbhost\"></td></tr>
<tr><td align=\"left\"><font class=\"ow-normal\">"._DBUNAME."</font></td>
<td><input type=\"text\" NAME=\"dbuname\" SIZE=30 maxlength=80 value=\"$dbuname\"></td></tr>
<tr><td align=\"left\"><font class=\"ow-normal\">"._DBPASS."</font></td>
<td><input type=\"text\" NAME=\"dbpass\" SIZE=30 maxlength=80 value=\"$dbpass\"></td></tr>
<tr><td align=\"left\"><font class=\"ow-normal\">"._DBNAME."</font></td>
<td><input type=\"text\" NAME=\"dbname\" SIZE=30 maxlength=80 value=\"$dbname\"></td></tr>
<tr><td align=\"left\"><font class=\"ow-normal\">"._DBPREFIX."</font></td>
<td><input type=\"text\" NAME=\"prefix\" SIZE=30 maxlength=80 value=\"$prefix\"></td></tr>
<tr><td align=\"left\"><font class=\"ow-normal\">"._DBTYPE."</font></td>
<td><select name=\"dbtype\"><option value=\"mysql\" selected>&nbsp;MySQL&nbsp;</option>
<option value=\"access\">&nbsp;Access&nbsp;</option>
</select></td></tr>
<tr><td align=\"left\"><font class=\"ow-normal\">"._ISINTRANET."</font></td>
<td><input type=\"checkbox\" NAME=\"intranet\" VALUE=\"1\"></td></tr>
<tr><td colspan=\"2\" align=\"left\"><font class=\"ow-normal\">"._INTRANETINFO."</font></td></tr>
</table>";
}

/*** This function prints the <input type=hidden> area ***/
function print_form_hidden() {
    global $currentlang;
    global $dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype, $intranet;

    if (empty($intranet)) {
        $intranet = 0;
    }

   echo  "
<input type=\"hidden\" NAME=\"currentlang\" value=\"$currentlang\">
<input type=\"hidden\" NAME=\"dbhost\" value=\"$dbhost\">
<input type=\"hidden\" NAME=\"dbuname\" value=\"$dbuname\">
<input type=\"hidden\" NAME=\"dbpass\" value=\"$dbpass\">
<input type=\"hidden\" NAME=\"dbname\" value=\"$dbname\">
<input type=\"hidden\" NAME=\"prefix\" value=\"$prefix\">
<input type=\"hidden\" NAME=\"dbtype\" value=\"$dbtype\">
<input type=\"hidden\" NAME=\"intranet\" value=\"$intranet\">";
}

function print_CHM_check() {
    global $currentlang;

   echo "
<font class=\"ow-title\">"._DBINFO."</font><font class=\"ow-normal\"> "._CHM_CHECK_1."<br /><br />
<form action=\"index.php\" method=\"post\"><center>";

    print_form_editabletext(0);

   echo   "<input type=\"hidden\" NAME=\"currentlang\" value=\"$currentlang\">
<input type=\"hidden\" name=\"op\" value=\"Submit\">
<input type=\"submit\" value=\""._BTN_SUBMIT."\"></center></form></font>";

}

function print_submit() {

   echo    "
<font class=\"ow-title\">"._DBINFO."</font><font class=\"ow-normal\"> "._SUBMIT_1."</font><br /><br /><center>
<font class=\"ow-normal\">"._SUBMIT_2."</font><br />";

   print_form_text();

   echo    "
</font>
<form action=\"index.php\" method=\"post\">
<input type=\"submit\" name=\"op\" value=\"Change Info\"><br />
<font class=\"ow-normal\">"._SUBMIT_3."</font><br /><br />
<table width=\"50%\"><tr align=\"center\"><td>";

   print_form_hidden();

   echo    "
<input type=\"submit\" name=\"op\" value=\"New Install\">
</td><td><input type=\"submit\" name=\"op\" value=\"Upgrade\">
</td></tr></table></form></center>";
}

function print_change_info() {

   echo    "
<font class=\"ow-title\">Change Info</font><font class=\"ow-normal\">"._CHANGE_INFO_1."<br /><br />
<form action=\"index.php\" method=\"post\"><center>";

   print_form_editabletext(0);

   echo    "
<input type=\"hidden\" name=\"op\" value=\"Submit\">
<input type=\"submit\" value=\""._BTN_SUBMIT."\"></center></form></font>";
}

function print_new_install() {

   echo   "<font class=\"ow-title\">New Install</font><font class=\"ow-normal\"> "._NEW_INSTALL_1."</font><br /><br /><center>";

   print_form_text(0);

   echo   "
<br /><br /><font class=\"ow-normal\">"._NEW_INSTALL_2."</font>
<form action=\"index.php\" method=\"post\"><table width=\"50%\"><tr>
<td align=center><font class=\"ow-normal\">"._NEW_INSTALL_3."</font><br /><input type=checkbox name=\"dbmake\"><br /></td><td>";

   print_form_hidden();

   echo   "
<input type=\"hidden\" name=\"op\" value=\"Start\">
<input type=\"submit\" value=\""._BTN_START."\"></td></tr></table></form></font></center>";
}

function print_start() {

   echo   "
<form action=\"index.php\" method=\"post\"><center><table width=\"50%\" align=center>
<tr><td align=center>";

   print_form_hidden();

   echo   "
<input type=\"hidden\" name=\"op\" value=\"Continue\">
<input type=\"submit\" value=\""._BTN_CONTINUE."\"></td></tr></table></center></form>";
}

function print_continue() {

   echo   "
<font class=\"ow-title\">"._CONTINUE_1."</font>
<font class=\"ow-normal\">"._CONTINUE_2."</font><br /><br />
<center><form action=\"index.php\" method=\"post\"><table width=\"50%\" border=1>
<tr><td align=\"left\"><font class=\"ow-normal\">"._ADMIN_LOGIN."</font></td>
<td><input type=\"text\" NAME=\"aid\" SIZE=30 maxlength=80 value=\"Admin\"></td></tr>
<tr><td align=\"left\"><font class=\"ow-normal\">"._ADMIN_NAME."</font></td>
<td><input type=\"text\" NAME=\"name\" SIZE=30 maxlength=80 value=\"Admin\"></td></tr>
<tr><td align=\"left\"><font class=\"ow-normal\">"._ADMIN_PASS."</font></td>
<td><input type=\"password\" NAME=\"pwd\" SIZE=30 maxlength=80 value=\"\"></td></tr>
<tr><td align=\"left\"><font class=\"ow-normal\">"._ADMIN_REPEATPASS."</font></td>
<td><input type=\"password\" NAME=\"repeatpwd\" SIZE=30 maxlength=80 value=\"\"></td></tr>
<tr><td align=\"left\"><font class=\"ow-normal\">"._ADMIN_EMAIL."</font></td>
<td><input type=\"text\" NAME=\"email\" SIZE=30 maxlength=80 value=\"none@none.com\"></td></tr>
<tr><td align=\"left\"><font class=\"ow-normal\">"._ADMIN_URL."</font></td>
<td><input type=\"text\" NAME=\"url\" SIZE=30 maxlength=80 value=\"http://www.postnuke.com\"></td></tr>";

   print_form_hidden();

   echo   "
</td></tr></table><br /><br /><input type=\"hidden\" name=\"op\" value=\"Set Login\">
<input type=\"submit\" value=\""._BTN_SET_LOGIN."\"></form></font></center>";
}

function print_set_login() {

   echo   "
<form action=\"index.php\" method=\"post\"><center><table width=\"50%\">";

   print_form_hidden();

   echo "
<tr><td align=center><input type=\"hidden\" name=\"op\" value=\"Finish\">
<input type=\"submit\" value=\""._BTN_FINISH."\"></td></tr></table></center></form>";
}

function print_finish() {
   global $currentlang;
   
   echo   "
<font class=\"ow-title\">"._FINISH_1."</font>
<font class=\"ow-normal\">"._FINISH_2."<br /><br /><form action=\"index.php\" method=\"post\">
<center><textarea name=\"license\" cols=50 rows=8>";

   include("lang/" . $currentlang . "/CREDITS.txt");

   echo   "
</textarea><br /><br />"._FINISH_3."</center></form></font>
<br /><br /><center><b><a href=\"index.php\">"._FINISH_4."</a></b></center><br /><br />";
}


function print_success() {

   echo  "
<font class=\"ow-title\">"._SUCCESS_1."</font>
<font class=\"ow-normal\">"._SUCCESS_2."<br /><br />
<form action=\"index.php\" method=\"post\"><center><table width=\"50%\">";

   print_form_hidden();

   echo "
<tr><td align=center><input type=\"hidden\" name=\"op\" value=\"Finish\">
<input type=\"submit\" value=\""._BTN_FINISH."\"></td>
</tr></table></center></form></font><br /><br />";
}

function print_forum_info() {

   echo
_FORUM_INFO_1."<br /><br /><ul>
<strong><big>·</big></strong>access<br />
<strong><big>·</big></strong>catagories<br />
<strong><big>·</big></strong>config<br />
<strong><big>·</big></strong>forums<br />
<strong><big>·</big></strong>forumstopics<br />
<strong><big>·</big></strong>posts<br />
<strong><big>·</big></strong>ranks<br />
<strong><big>·</big></strong>user_status
</ul>"._FORUM_INFO_2."<br /><br />";
}


function print_default() {

   echo  "
<font class=\"ow-normal\">" . DEFAULT_1 ."</font><br /><br />
<font class=\"ow-normal\">" . DEFAULT_2 ."</font><br /><br />
<font class=\"ow-normal\">" . DEFAULT_3 ."</font><br /><br />
<font class=\"ow-title\">" . DEFAULT_4 . "</font>
<font class=\"ow-normal\">" . DEFAULT_5 . "<br /><br />
<form action=\"index.php\" method=\"post\"><center>
<textarea name=\"license\" cols=60 rows=10>";

   include("../docs/LICENSE.txt");

   echo  "</textarea><br /><br />";

   print_form_hidden();

   echo "
<input type=\"hidden\" name=\"op\" value=\"Check\">
<input type=\"submit\" value=\"" . NEXT . "\"></center>
</form>";
}


function print_select_language() {

   echo "<br /><p><font class=\"ow-pageGreat\">" . GREAT . "</font></p><p><font class=\"ow-main\">" . GREAT_1 . "</font></p>
<p><img src=\"images/trans.gif\" width=\"1%\" height=\"40\" border=\"0\" alt=\" \"></p>
<p><font class=\"ow-title\">" . SELECT_LANGUAGE_1 . "</font></p>
<form action=\"index.php\" method=\"post\"><table width=\"400\" align=\"center\" border=\"0\"><tr>
<td align=\"center\"><font class=\"ow-normal\">". SELECT_LANGUAGE_2;

   lang_dropdown();

   echo  "
<input type=\"hidden\" name=\"op\" value=\"Set Language\">
<input type=\"submit\" value=\"" . BTN_SET_LANGUAGE . "\"></td></tr>
</table></form></font><p><img src=\"images/trans.gif\" width=\"1%\" height=\"160\" border=\"0\" alt=\" \"></p>";
}

?>
