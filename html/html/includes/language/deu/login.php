<?php
/* ----------------------------------------------------------------------
   $Id: login.php,v 1.5 2003/04/29 06:27:17 r23 Exp $

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

define('TITLE', 'Melden Sie sich an.');
define('NAVBAR_TITLE', 'Anmelden');
define('HEADING_TITLE', 'Melden Sie sich an');

define('TEXT_INFO_USER_EMAIL', 'eMail Adresse:');
define('TEXT_INFO_PASSWORD', 'Passwort:');
define('TEXT_PASSWORD_FORGOTTEN', 'Sie haben Ihr Passwort vergessen? Dann klicken Sie <u>hier</u>');

define('ERROR_LOGIN_ERROR', 'Fehler: Keine &Uuml;bereinstimmung der eingebenen \'eMail-Adresse\' und/oder dem \'Passwort\'.');
define('ERROR_LOGIN_NO_USER', 'Fehler: Sie sind dem System unter der eingebenen \'eMail-Adresse\' nicht bekannt.');
?>