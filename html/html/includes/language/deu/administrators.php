<?php
/* ----------------------------------------------------------------------
   $Id: administrators.php,v 1.3 2003/04/23 07:07:22 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:

   Login and Logoff for osCommerce Administrators.

   Original Version by Blake Schwendiman
   blake@intechra.net

   Updated Version 1.1.0 (03/01/2002) by Christopher Conkie
   chris@conkiec.freeserve.co.uk

   This is a new admin module for osCommerce pr2.2 that allows 
   for login/logoff from the admin section of TEP.
   This way only valid administrators can access your site and in 
   varying degrees.

   This module is built around osCommerce CVS pr2.2 snapshot 02/01/2002
   ----------------------------------------------------------------------
   The Exchange Project - Community Made Shopping!
   http://www.theexchangeproject.org

   Implemented by Blake Schwendiman (blake@intechra.net)

   Copyright (c) 2000,2001 The Exchange Project
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

define('TOP_BAR_TITLE', 'Administrators');
define('HEADING_TITLE', 'Set up Administrators');
define('SUB_BAR_TITLE', 'Add, edit or remove login information for Administrators.');

define('TEXT_ADMINISTRATOR_USERNAME', 'UserName:');
define('TEXT_ADMINISTRATOR_PASSWORD', 'Password:');
define('TEXT_ADMINISTRATOR_CONFPWD', 'Confirm Password:');
define( 'TEXT_CURRENT_ADMINISTRATORS', 'Current Administrators' );
define( 'TEXT_ADD_ADMINISTRATOR', 'Add New Administrator' );
define( 'TEXT_NO_CURRENT_ADMINS', 'There are currently no defined administrators.' );
define( 'TEXT_ADMIN_DELETE', 'Delete' );
define( 'TEXT_ADMIN_SAVE', 'Add New' );
define( 'TEXT_PWD_ERROR', '<br><p class="main">The password did not match the confirmation password or the password was empty.  New administrator <b>not added</b>.</p>' );
define( 'TEXT_UNAME_ERROR', '<br><p class="main">The username cannot be empty.  New administrator <b>not added</b>.</p>' );
define( 'TEXT_FULL_ACCESS', 'This administrator has <b>full</b> access.' );
define( 'TEXT_PARTIAL_ACCESS', 'This administrator has access to the following areas.  CTRL+Click to select multiple.' );
define( 'TEXT_ADMIN_HAS_ACCESS_TO', 'Administrator Rights' );
?>
