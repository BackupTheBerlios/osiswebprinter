<?php
/* ----------------------------------------------------------------------
   $Id: newinstall.php,v 1.7 2003/04/09 22:50:24 r23 Exp $

   OSIS GMBH
   http://www.osisnet.de/
   
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
    global $db;
    
    echo '<center><br /><br />';
    if ($dbmake) {
      mysql_pconnect($dbhost, $dbuname, $dbpass);
      $result = mysql_query("CREATE DATABASE $dbname") or die (_MAKE_DB_1);
      echo '<font class="owp-error">' . $dbname . ' ' . MAKE_DB_2. '</font>'; 
    } else {
      echo '<font class="owp-error">'. MAKE_DB_3 . '</font>';
    }
    include('newtables.php');
}

/*** This function inserts the default data on new installs ***/
function input_data($gender, $firstname, $name, $pwd, $repeatpwd, $email, $phone, $fax, $prefix) {
    global $db; 
    
    echo '<font class="owp-title">' . INPUT_DATA . '</font>';
    echo "<center>";
 
    // Put basic information in first
    #include('newdata.php');
    include ('../includes/functions/password_funcs.php');
    $owp_pwd = crypt_password($pwd);
    $today = date("Y-m-d H:i:s");

    $sql = "INSERT INTO ".$prefix."_administrators
            (owp_admin_gender,
             owp_admin_firstname,
             owp_admin_lastname,
             owp_admin_email_address,
             owp_admin_telephone,
             owp_admin_fax,
             owp_admin_password,
             owp_date_added)
             VALUES ("
             . $db->qstr($gender) . ','
             . $db->qstr($firstname) . ','
             . $db->qstr($name) . ','
             . $db->qstr($email) . ','
             . $db->qstr($phone) . ','
             . $db->qstr($fax) . ','
             . $db->qstr($owp_pwd) . ','
             . $db->DBTimeStamp($today) . ")";
    $result = $db->Execute($sql);
    if ($result === false) {
      echo '<br /><font class="owp-error">' .  $db->ErrorMsg() . NOTMADE . '</font>';
    } else {
      echo '<br /><font class="owp-title">' . $prefix . '_administrators&nbsp;'. UPDATED . '</font>';
    }
}
?>