<?php
/* ----------------------------------------------------------------------
   $Id: owp_api.php,v 1.3 2003/04/19 09:13:25 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: newsletters.php,v 1.14 2002/03/29 13:04:25 dgw_
   ----------------------------------------------------------------------

   $Id: owp_api.php,v 1.3 2003/04/19 09:13:25 r23 Exp $
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
   Original Author of file: Jim McDonald
   Purpose of file: The PostNuke API
   ---------------------------------------------------------------------- */


  function owpDBInit() {
    // Get database parameters
    $dbtype = OWP_DB_TYPE;
    $dbhost = OWP_DB_SERVER;
    $dbname = OWP_DB_DATABASE;
    
    // Decode encoded DB parameters
    if (OWP_ENCODED == '1') {
      $dbuname = base64_decode(OWP_DB_USERNAME);
      $dbpass = base64_decode(OWP_DB_PASSWORD);
    } else {
      $dbuname = OWP_DB_USERNAME;
      $dbpass = OWP_DB_PASSWORD;
    }

    // Database connection is a global (for now)
    global $db;

    // Start connection
    $db = ADONewConnection($dbtype);
    $dbh = $db->Connect($dbhost, $dbuname, $dbpass, $dbname);
    if (!$dbh) {
    $dbpass = "";
        die("$dbtype://$dbuname:$dbpass@$dbhost/$dbname failed to connect" . $dbconn->ErrorMsg());
    }
    global $ADODB_FETCH_MODE;
    $ADODB_FETCH_MODE = ADODB_FETCH_NUM;

    // force oracle to a consistent date format for comparison methods later on
    if (strcmp($dbtype, 'oci8') == 0) {
        $db->Execute("alter session set NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS'");
    }

    return true;
  }

 /**
  * get a list of database connections
  * @returns array
  * @return array of database connections
  */
  function owpDBGetConn() {
    global $db;

    return array($db);
  }

 /**
  * get a list of database tables
  * @returns array
  * @return array of database tables
  */
  function owpDBGetTables() {
    global $owptable;

    return $owptable;
  }
?>