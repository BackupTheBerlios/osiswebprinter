<?php
/* ----------------------------------------------------------------------
   $Id: index.php,v 1.5 2003/03/30 16:11:31 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:

   File: install.php,v 1.91 2002/02/05 11:09:04 jgm 
   ----------------------------------------------------------------------
   POST-NUKE Content Management System
   Copyright (C) 2001 by the Post-Nuke Development Team.
   http://www.postnuke.com/
   ----------------------------------------------------------------------
   Based on:
   PHP-NUKE Web Portal System - http://phowuke.org/
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
   Original Author of file:
   Purpose of file:
   ---------------------------------------------------------------------- */

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

 define('ADODB_DIR', '../includes/adodb');
 require_once ('../includes/adodb/adodb.inc.php');
 require_once ('../includes/classes/osis_text_tool.php');

 if (isset($alanguage)) {
   $currentlang = $alanguage;
 }

 if (!isset($prefix)) {
    include_once '../includes/config.php';
    $prefix = $owconfig['prefix'];
    $dbtype = $owconfig['dbtype'];
    $dbhost = $owconfig['dbhost'];
    $dbuname = $owconfig['dbuname'];
    $dbpass = $owconfig['dbpass'];
    $dbname = $owconfig['dbname'];
    $system = $owconfig['system'];
    $encoded = $owconfig['encoded'];   
  }

  if (!empty($encoded)) {
    $dbuname = base64_decode($dbuname);
    $dbpass = base64_decode($dbpass);
  }

  $owconfig['prefix'] = $prefix;

  include_once 'language.php'; 

  installer_get_language();

  include_once 'modify_config.php'; 
  include_once 'newinstall.php'; 
  include_once 'gui.php'; 
  include_once 'db.php'; 
  include_once 'check.php'; 

// header
  include_once 'header.php';

/*  This starts the switch statement that filters through the form options.
 * the @ is in front of $op to suppress error messages if $op is unset and E_ALL
 * is on
 */
 switch ($_POST['op']) {
    case 'Finish':
      print_finish();
      break;
    case 'Set Login':
      $dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);
      input_data($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype, $aid, $name, $pwd, $repeatpwd, $email, $url);
      update_config_php(true); // Scott - added
      print_set_login();
      break;
    case 'Continue':
      print_continue();
      break;
    case 'Start':
      if (!isset($dbmake)) {
        $dbmake = false;
      }
      make_db($dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype, $dbmake);
      print_start();
      break;
    case 'New Install':
      print_new_install();
      break;
    case 'Change Info':
      print_change_info();
      break;
    case 'Submit':
      print_submit();
      break;
    case 'CHM_check':
      print_CHM_check();
      break;
    case 'Check':
      do_check_chmod();
      break;
    case 'PHP_Check':
      do_check_php();
      break;
    case 'Set Language':
      $currentlang = $alanguage;
      print_default();
      break;       
    default:
      print_select_language();
      break;
  }
  include_once 'footer.php';
?>
