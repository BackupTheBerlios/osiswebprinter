<?php
/* ----------------------------------------------------------------------
   $Id: administrators.php,v 1.4 2003/05/02 09:48:04 r23 Exp $

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

define('TABLE_HEADING_LASTNAME', 'Nachname');
define('TABLE_HEADING_FIRSTNAME', 'Vorname');
define('TABLE_ADMIN_HAS_ACCESS_TO', 'Zugriffsrechte');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Datum');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_DATE_ACCOUNT_CREATED', 'Zugang erstellt am:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'letzte &Auml;nderung:');
define('TEXT_INFO_DATE_LAST_LOGON', 'letzte Anmeldung:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Anzahl der Anmeldungen:');


define('TEXT_ADMINISTRATOR_PASSWORD', 'Password:');
define('TEXT_ADMINISTRATOR_CONFPWD', 'Confirm Password:');
define('TEXT_CURRENT_ADMINISTRATORS', 'Current Administrators' );
define('TEXT_ADD_ADMINISTRATOR', 'Add New Administrator' );
define('TEXT_NO_CURRENT_ADMINS', 'There are currently no defined administrators.' );
define('TEXT_ADMIN_DELETE', 'Delete' );
define('TEXT_ADMIN_SAVE', 'Add New' );
define('TEXT_PWD_ERROR', '<br><p class="main">The password did not match the confirmation password or the password was empty.  New administrator <b>not added</b>.</p>' );
define('TEXT_UNAME_ERROR', '<br><p class="main">The username cannot be empty.  New administrator <b>not added</b>.</p>' );
define('TEXT_FULL_ACCESS', 'This administrator has <b>full</b> access.' );
define('TEXT_PARTIAL_ACCESS', 'This administrator has access to the following areas.  CTRL+Click to select multiple.' );
define('TABLE_ADMIN_HAS_ACCESS_TO', 'Administrator Rights' );

define('TEXT_DISPLAY_NUMBER_OF_USER', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Anwendern)');
?>
