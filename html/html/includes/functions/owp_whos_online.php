<?php
/* ----------------------------------------------------------------------
   $Id: owp_whos_online.php,v 1.3 2003/04/29 16:59:21 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: whos_online.php,v 1.5 2001/10/25 09:45:22 dgw_ 
   ----------------------------------------------------------------------
   The Exchange Project - Community Made Shopping!
   http://www.theexchangeproject.org

   Copyright (c) 2000,2001 The Exchange Project
  
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  function opwUpdateWhosOnline() {
    global $db;
    
    if (isset($_SESSION['user_id'])) {
      $wo_user_id =& $_SESSION['user_id'];
      $wo_full_name = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];     
    } else {
      $wo_user_id = '';
      $wo_full_name = 'Guest';
    }

    $wo_session_id = owpSessionID();
    $wo_ip_address = $_SERVER['REMOTE_ADDR'];
    $wo_last_page_url = addslashes($_SERVER['REQUEST_URI']);

    $current_time = time();
    $xx_mins_ago = ($current_time - 900);

    $owpDBTable = owpDBGetTables();
    // remove entries that have expired
    $db->Execute("DELETE FROM " . $owpDBTable['whos_online'] . " WHERE time_last_click < '" . $xx_mins_ago . "'");

    $sql = "SELECT count(*) as total 
            FROM " . $owpDBTable['whos_online'] . " 
            WHERE session_id = '" . $wo_session_id . "'";
    $owp_user_query = $db->Execute($sql);
    $owp_user = $owp_user_query->fields;
    
    if ($owp_user['total'] > 0) {
      $db->Execute("UPDATE " . $owpDBTable['whos_online'] . " 
      	                 SET user_id = " . $db->qstr($wo_user_id) . ",
      	                     full_name = " . $db->qstr($wo_full_name) . ",
      	                     ip_address = " . $db->qstr($wo_ip_address) . ",    	                     
      	                     time_last_click = " . $db->qstr($current_time) . ",
      	                     last_page_url = " . $db->qstr($wo_last_page_url) . "
                       WHERE session_id = '" . $wo_session_id . "'");
    } else {
      $sql = "INSERT INTO " . $owpDBTable['whos_online'] . " 
             (user_id,
              full_name, 
              session_id, 
              ip_address,
              time_entry,
              time_last_click,
              last_page_url) 
              VALUES (" . $db->qstr($wo_user_id) . ','
                        . $db->qstr($wo_full_name) . ','
                        . $db->qstr($wo_session_id) . ','
                        . $db->qstr($wo_ip_address) . ','
                        . $db->qstr($current_time) . ','
                        . $db->qstr($current_time) . ','
                        . $db->qstr($wo_last_page_url) . ")";
      $db->Execute($sql);    
    }
  }
?>