<?php
/* ----------------------------------------------------------------------
   $Id: mail.php,v 1.6 2003/05/02 09:49:24 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: mail.php,v 1.9 2002/01/19 22:44:34 harley_vb
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

define('TITLE', 'eMail versenden.');
define('NAVBAR_TITLE', 'eMail versenden');
define('NAVBAR_TITLE_2', 'Ihre eMail');
define('HEADING_TITLE', 'eMail an '.  OWP_NAME .' - Anwender versenden.');

define('TEXT_USER', 'Anwender:');
define('TEXT_SUBJECT', 'Betreff:');
define('TEXT_FROM_NAME', 'Absender Name:');
define('TEXT_FROM_MAIL', 'Absender eMail:');

define('TEXT_MESSAGE', 'Nachricht:');
define('TEXT_SELECT_USER', 'Anwender ausw&auml;hlen');
define('TEXT_ALL_USER', 'Alle Anwender');
define('TEXT_NEWSLETTER_USER', 'An alle Newsletter-Abonnenten');

define('EMAIL_GREET_MR', 'Sehr geehrter Herr ');
define('EMAIL_GREET_MS', 'Sehr geehrte Frau ');
define('EMAIL_GREET_ALL', 'Sehr geehrte ... ');
define('EMAIL_FOOT', 'Mit den besten Grüssen,' . "\n" .  OWP_NAME . "\n\n\n" . OWP_HTTP_SERVER . '/' . "\n\n");

define('NOTICE_EMAIL_SENT_TO', 'Hinweis: eMail wurde versendet an: %s');
define('ERROR_NO_USER_SELECTED', 'Fehler: Es wurde kein Anwender ausgew&auml;hlt.');
define('ERROR_NO_FROM_NAME', 'Fehler: Bitte geben Sie Ihren Namen als Absender ein.');
define('ERROR_NO_FROM_MAIL', 'Fehler: Bitte geben Sie Ihre eMail Adresse als Absender ein.');
define('ERROR_NO_SUBJECT', 'Fehler: Bitte geben Sie ein Betreff ein.');
define('ERROR_NO_BODY', 'Fehler: Bitte geben Sie eine Nachricht ein.');
?>