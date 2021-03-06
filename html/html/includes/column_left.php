<?php
/* ----------------------------------------------------------------------
   $Id: column_left.php,v 1.10 2003/05/08 16:53:12 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: column_left.php,v 1.15 2002/01/11 05:03:25 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  if (isset($_SESSION['user_id'])) {
    require(OWP_BOXES_DIR . 'owp_userbox.php');
  } else {   
    require(OWP_BOXES_DIR . 'owp_loginbox.php');
  }
  require(OWP_BOXES_DIR . 'owp_configuration.php');
  require(OWP_BOXES_DIR . 'owp_countries.php');
  require(OWP_BOXES_DIR . 'owp_tools.php');
  require(OWP_BOXES_DIR . 'owp_administrators.php');
  require(OWP_BOXES_DIR . 'owp_languages.php');
?>
