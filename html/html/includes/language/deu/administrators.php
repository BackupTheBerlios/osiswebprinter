<?php
/* ----------------------------------------------------------------------
   $Id: administrators.php,v 1.6 2003/05/06 13:28:28 r23 Exp $

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
define('TABLE_HEADING_ACCOUNT_LOGIN', 'Zugang');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_DATE_ACCOUNT_CREATED', 'Zugang erstellt am:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'letzte &Auml;nderung:');
define('TEXT_INFO_DATE_LAST_LOGON', 'letzte Anmeldung:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Anzahl der Anmeldungen:');
define('TEXT_INFO_HEADING_DELETE_USER', 'Anwender l&ouml;schen');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie diesen Anwender l&ouml;schen m&ouml;chten?');

define('EMAIL_SUBJECT', 'Zugangsberechtigung für ' . OWP_NAME);
define('EMAIL_GREET_MR', 'Sehr geehrter Herr ');
define('EMAIL_GREET_MS', 'Sehr geehrte Frau ');

define('EMAIL_WELCOME', 'willkommen bei ' . OWP_NAME . '. ' . "\n\n");
define('EMAIL_TEXT', 'Sie können jetzt unser ' . OWP_NAME . '-Service nutzen.' . "\n\n");
define('EMAIL_CONTACT', 'Ihre Fragen und Meinungen sind uns wichtig. Wenn Sie also ' . "\n" . 'einen Vorschlag haben, wie wir ' . OWP_NAME . ' noch anregender,' . "\n" . 'praktischer oder persönlicher gestalten können, zögern Sie'  . "\n" . 'nicht, sich mit uns in Verbindung zu setzen:' . "\n\n" . DEVELOPER_SITE . ': http://developer.berlios.de/projects/osiswebprinter/' . "\n" . SUPPORT_FORUMS . ': http://developer.berlios.de/forum/?group_id=752' . "\n" . MAILING_LISTS . ': https://lists.berlios.de/mailman/listinfo/osiswebprinter-users' . "\n\n\n");
define('EMAIL_PASSWORD_REMINDER_BODY', 'Ihr Passwort lautet:' . "\n\n" . '   %s' . "\n\n");
define('EMAIL_FOOT', 'Mit den besten Grüssen,' . "\n" . 'Ihr ' . OWP_NAME . ' Team' . "\n\n\n" . OWP_HTTP_SERVER . "\n\n");


define('TEXT_ADMINISTRATOR_PASSWORD', 'Passwort:');
define('TEXT_ADMINISTRATOR_CONFPWD', 'Passwortbest&auml;tigung:');
define('TEXT_CURRENT_ADMINISTRATORS', 'Current Administrators' );
define('TEXT_ADD_ADMINISTRATOR', 'Add New Administrator' );
define('TEXT_NO_CURRENT_ADMINS', 'There are currently no defined administrators.' );
define('TEXT_ADMIN_DELETE', 'Delete' );
define('TEXT_ADMIN_SAVE', 'Add New' );
define('TEXT_PWD_ERROR', '<br><p class="main">The password did not match the confirmation password or the password was empty.  New administrator <b>not added</b>.</p>' );
define('TEXT_UNAME_ERROR', '<br><p class="main">The username cannot be empty.  New administrator <b>not added</b>.</p>' );
define('TEXT_FULL_ACCESS', 'This administrator has <b>full</b> access.' );
define('TEXT_PARTIAL_ACCESS', 'This administrator has access to the following areas.');
define('TABLE_ADMIN_HAS_ACCESS_TO', 'Administrator Rights' );

define('IMAGE_NEW_USER', 'Neuer Anwender');

define('SUCCESS_DELETE_USER', 'Erfolg: Der Anwender wurde gel&ouml;scht.');

define('TEXT_DISPLAY_NUMBER_OF_USER', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Anwendern)');
?>
