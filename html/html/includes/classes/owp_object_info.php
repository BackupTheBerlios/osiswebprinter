<?php
/* ----------------------------------------------------------------------
   $Id: owp_object_info.php,v 1.2 2003/04/23 06:32:13 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: object_info.php,v 1.5 2002/01/30 01:14:20 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2001 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */
   
  class objectInfo {

// class constructor
    function objectInfo($object_array) {
      reset($object_array);
      while (list($key, $value) = each($object_array)) {
        $this->$key = tep_db_prepare_input($value);
      }
    }
  }
?>