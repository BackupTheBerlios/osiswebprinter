<?php
/* ----------------------------------------------------------------------
   $Id: newinstall.php,v 1.4 2003/04/01 02:30:23 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: newinstall.php,v 1.5 2002/02/09 12:50:40 jgm 
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
   Original Author of file: Gregor J. Rothfuss
   Purpose of file: Provide functions for a new install.
   ---------------------------------------------------------------------- */

/*** This function creates the DB on new installs ***/
function make_db($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype, $dbmake) {
    global $dbconn;
    
    echo '<center><br /><br />';
    if ($dbmake) {
       mysql_connect($dbhost, $dbuname, $dbpass);
       $result = mysql_query("CREATE DATABASE $dbname") or die (_MAKE_DB_1);
       echo '<br><br><font class="owp-error">' . $dbname . MAKE_DB_2. '</font>'; 
    } else {
        echo '<font class="owp-error">'. MAKE_DB_3 . '</font>';
    }
    include('newtables.php');
}

/*** This function inserts the default data on new installs ***/
function input_data($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype, $aid, $name, $pwd, $repeatpwd, $email, $url) {
    global $dbconn;
    
    if ($pwd != $repeatpwd) {
      echo _PWBADMATCH;
      exit;
    } else {
      echo '<font class="owp-title">' . INPUT_DATA_1. '</font>';
      echo "<center>";
      global $dbconn;
      mysql_connect($dbhost, $dbuname, $dbpass);
      mysql_select_db("$dbname") or die ("<br><font class=\"owp-sub\">"._NOTSELECT."</font>");

      // Put basic information in first
      include('newdata.php');

      // new installs will use md5 hashing - compatible on windows and *nix variants.
      $pwd = md5($pwd);

      $result = $dbconn->Execute("INSERT INTO $prefix"._users." VALUES ( NULL, '$name', '$aid', '$email', '', '$url', 'blank.gif', ".time().", '', '', '', '', '', '', '', '', '', '', '$pwd', 10, '', 0, 0, 0, '', 0, '', '', 4096, 0, '12.0')") or die ("<b>"._NOTUPDATED.$prefix."_users</b>");
      echo '<br><font class="owp-sub">' . $prefix . '_users' . UPDATED . '</font>';

      // We know that the above user is UID 2 and that the admin group is GID 2 from the newdata
      $result = $dbconn->Execute("INSERT INTO $prefix"._group_membership." VALUES (2, 2)") or die ("<b>"._NOTUPDATED.$prefix."_group_membership</b>");
      echo '<br><font class="owp-sub">' . $prefix . '_group_membership ' . UPDATED. '</font>';
    }
}

?>
