<?php
// File: $Id: index.php,v 1.1 2003/03/28 00:49:57 r23 Exp $ $Name:  $
// ----------------------------------------------------------------------
// POST-NUKE Content Management System
// Copyright (C) 2001 by the Post-Nuke Development Team.
// http://www.postnuke.com/
// ----------------------------------------------------------------------
// Based on:
// PHP-NUKE Web Portal System - http://phpnuke.org/
// Thatware - http://thatware.org/
// ----------------------------------------------------------------------
// LICENSE
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
// Original Author of file:
// Purpose of file:
// ----------------------------------------------------------------------

/**
 * PostNuke Install Script.
 *
 * This script will set the database up, and do the basic configurations of the script.  
 * Once this script has run, please delete this file from your root directory.  
 * There is a security risk if you keep this file around.
 *
 * This module of the PostNuke project was inspired by the myPHPNuke project.
 *
 * The PostNuke project is free software released under the GNU License.  
 * Please read the credits file for more information on who has made this project possible.
 */

/** initialize vars, and include all necessary files **/

set_time_limit(0);

define('ADODB_DIR', 'pnadodb');
require_once ("pnadodb/adodb.inc.php");

if (isset($alanguage)) {
   $currentlang = $alanguage;
}


if(!isset($prefix))
{
    include_once 'config.php';
    $prefix = $pnconfig['prefix'];
    $dbtype = $pnconfig['dbtype'];
    $dbhost = $pnconfig['dbhost'];
    $dbuname = $pnconfig['dbuname'];
    $dbpass = $pnconfig['dbpass'];
    $dbname = $pnconfig['dbname'];
    $system = $pnconfig['system'];
    $encoded = $pnconfig['encoded'];   
}

if (!empty($encoded)) {
    // Decode username and password
    $dbuname = base64_decode($dbuname);
    $dbpass = base64_decode($dbpass);
}

$pnconfig['prefix'] = $prefix;

include_once 'pntables.php';
include_once 'install/language.php'; // functions for multilanguage support

installer_get_language();

include_once 'install/modify_config.php'; // functions to modify config.php
include_once 'install/upgrade.php';  // functions for upgrades
include_once 'install/newinstall.php'; // functions for new installs
include_once 'install/gui.php'; // functions for rendering the gui
include_once 'install/db.php'; // functions for accessing the db
include_once 'install/check.php'; // functions for various checks

/** print the page header, include style sheets **/
print_header();

/*  This starts the switch statement that filters through the form options.

* the @ is in front of $op to suppress error messages if $op is unset and E_ALL

* is on

*/
switch(@$op) {

    case "CHM_check":
         print_CHM_check();
         break;

    case "Submit":
         print_submit();
         break;

    case "Change Info":
         print_change_info();
         break;

    case "New Install":
         print_new_install();
         break;
    
    case "Start":
         if(!isset($dbmake)) {
            $dbmake = false;
         }
         make_db($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype, $dbmake);
         print_start();
         break;

    case "Continue":
         print_continue();
         break;

    Case "Set Login":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         input_data($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype, $aid, $name, $pwd, $repeatpwd, $email, $url);
         update_config_php(true); // Scott - added
         print_set_login();
         break;

    Case "Select Language":
         print_select_language();
         break;

    Case "Set Language":
         $currentlang = $alanguage;
         print_default();
         break;

    Case "Finish":
         print_finish();
         break;

    Case "Upgrade":
         print_upgrade();
         break;

    Case "PHP-Nuke":
         print_select_phpnuke();
         break;

    Case "PostNuke":
         print_select_postnuke();
         break;

    Case "MyPHPNuke":
         print_select_myphpnuke();
         break;
         
/* Removed for release.  Needs to be updated

    Case "Validate Language":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         language_update($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         break;

    Case "Validate Tables":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         tables_update($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         break;

    Case "Validate Sequence Tables":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         sequence_update($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         break; */

    Case "MyPHPNuke 1.8.7":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         do_upgrade187($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade64($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade7($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         print_success();
         break;

    Case "MyPHPNuke 1.8.8":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         do_upgrade188($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade64($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade7($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         print_success();
         break;

    Case "PHP-Nuke 4.4":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         do_upgrade4($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade5($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade6($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade62($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade63($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade64($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade7($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         print_forum_info();
         print_success();
         break;
         
    Case "PHP-Nuke 5":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         do_upgrade5($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade6($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade62($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade63($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade64($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade7($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         print_success();
         break;

    Case "PHP-Nuke 5.2":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         do_upgrade52($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade5($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade6($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade62($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade63($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade64($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade7($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         print_success();
         break;

    Case "PHP-Nuke 5.3":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         do_upgrade53($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade52($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade5($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade6($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade62($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade63($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade64($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade7($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         print_success();
         break;

       Case "PHP-Nuke 5.3.1":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         do_upgrade531($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade53($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade52($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade5($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade6($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade62($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade63($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade64($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade7($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         print_success();
         break;
         
        Case "PHP-Nuke 5.4":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         do_upgrade54($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);   
         do_upgrade531($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade53($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade52($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade5($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade6($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade62($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade63($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade64($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade7($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         print_success();
         break; 

    Case "PostNuke .5":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         do_upgrade5($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade6($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade62($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade63($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade64($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade7($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         print_success();
         break;

    Case "PostNuke .6":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         do_upgrade6($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade62($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade63($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade64($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade7($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         print_success();
         break;

    Case "PostNuke .62":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         do_upgrade62($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade63($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade64($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade7($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         print_success();
         break;

    Case "PostNuke .63":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         do_upgrade63($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade64($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade7($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         print_success();
         break;

    Case "PostNuke .64":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         do_upgrade64($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         do_upgrade7($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         print_success();
         break;

    Case "PostNuke .7":
         $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
         do_upgrade7($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype);
         print_success();
         break;

    case "Check":
        do_check_php();
        do_check_chmod();
        break;

    default:
         print_select_language();
         break;
}

/** print the footer, and closing tags **/
print_footer();
?>