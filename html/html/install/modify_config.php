<?php
/* ----------------------------------------------------------------------
   $Id: modify_config.php,v 1.4 2003/04/02 02:03:32 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: modify_config.php,v 1.13 2002/03/16 15:24:37 johnnyrocket  
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
   Original Author of file: Scott Kirkwood (scott_kirkwood@bigfoot.com)
   Purpose of file: Routines to modify the config.php file.
   General routine modify_file() is useful in it's own right.
   ---------------------------------------------------------------------- */

// mod_file is general, give it a source file a destination.
// an array of search patterns (Perl style) and replacement patterns
// Returns a string which starts with "Err" if there's an error
function modify_file($src, $dest, $reg_src, $reg_rep) {
    $in = @fopen($src, "r");
    if (!$in) {
      return MODIFY_FILE_1. " $src";
    }
    $i = 0;
    while (!feof($in)) {
      $file_buff1[$i++] = fgets($in, 4096);
    }
    fclose($in);

    $lines = 0; // Keep track of the number of lines changed

    while (list ($bline_num, $buffer) = each ($file_buff1)) {
      $new = preg_replace($reg_src, $reg_rep, $buffer);
      if ($new != $buffer) {
        $lines++;
      }
      $file_buff2[$bline_num] = $new;
    }

    if ($lines == 0) {
      // Skip the rest - no lines changed
      return MODIFY_FILE_3;
    }

    reset($file_buff1);
    $out_backup = @fopen($dest, "w");

    if (! $out_backup) {
      return MODIFY_FILE_2. " $dest";
    }

    while (list ($bline_num, $buffer) = each ($file_buff1)) {
      fputs($out_backup,$buffer);
    }

    fclose($out_backup);

    reset($file_buff2);
    $out_original = fopen($src, "w");
    if (! $out_original) {
      return MODIFY_FILE_2. " $src";
    }

    while (list ($bline_num, $buffer) = each ($file_buff2)) {
      fputs($out_original,$buffer);
    }

    fclose($out_original);

    // Success!
    return "$src updated with $lines lines of changes, backup is called $dest";
}

// Two global arrays
$reg_src = array();
$reg_rep = array();

// Setup various searches and replaces
// Scott Kirkwood
function add_src_rep($key, $rep) {
    global $reg_src, $reg_rep;
    
    $reg_src[] = "/(define\()([\"'])(".$key.")\\2,\s*([\"'])(.*?)\\4\s*\)/";
    $reg_rep[] = "define('".$key."', '".$rep."')";
}


function show_error_info() {
    global $dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype;

    echo "<br/><br/><b>"._SHOW_ERROR_INFO_1. "<br/>";
echo <<< EOT
        <tt>
        \define('OWP_DB_TYPE', '$dbtype');<br />
        \define('OWP_DB_SERVER', '$dbhost');<br />
        \define('OWP_DB_USERNAME', '$dbuname');<br />
        \define('OWP_DB_PASSWORD', '$dbpass');<br />
        \define('OWP_DB_DATABASE', '$dbname');<br />
        \define('OWP_DB_PREFIX', '$prefix');<br />
        \define('OWP_ENCODED', '1');<br />
        </tt>
EOT;

}

// Update the config.php file with the database information.
function update_config_php($db_prefs = false) {
    global $reg_src, $reg_rep;
    global $dbhost, $dbuname, $dbpass, $dbname, $prefix, $dbtype;
    global $url, $HTTP_ENV_VARS;

    add_src_rep("OWP_DB_SERVER", $dbhost);
    add_src_rep("OWP_DB_USERNAME", base64_encode($dbuname));
    add_src_rep("OWP_DB_PASSWORD", base64_encode($dbpass));
    add_src_rep("OWP_DB_DATABASE", $dbname);
    add_src_rep("OWP_DB_PREFIX", $prefix);
    add_src_rep("OWP_DB_TYPE", $dbtype);
    if (strstr($HTTP_ENV_VARS["OS"],"Win")) {
        add_src_rep("OWP_SYSTEM" , '1');
    } else {
        add_src_rep("OWP_SYSTEM", '0');
    }
    add_src_rep("OWP_ENCODED", '1');

    $ret = modify_file("../includes/config.php", "../includes/config-old.php", $reg_src, $reg_rep);

    if (preg_match("/Error/", $ret)) {
        show_error_info();
    }
}

?>
