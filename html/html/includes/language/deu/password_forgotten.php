<?php
/* ----------------------------------------------------------------------
   $Id: password_forgotten.php,v 1.3 2003/04/29 06:27:17 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: password_forgotten.php,v 1.7 2002/04/17 15:57:07 harley_vb
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */
   
define('TITLE', 'Passwort vergessen');
define('NAVBAR_TITLE_1', 'Anmelden');
define('NAVBAR_TITLE_2', 'Passwort vergessen');
define('HEADING_TITLE', 'Wie war noch mal mein Passwort?');

define('TEXT_INFO_USER_EMAIL', 'eMail Adresse:');

define('EMAIL_PASSWORD_SUBJECT', OWP_NAME . ' - Ihr neues Passwort.');
define('EMAIL_GREET_MR', 'Sehr geehrter Herr ');
define('EMAIL_GREET_MS', 'Sehr geehrte Frau ');
define('EMAIL_PASSWORD_INTRO', 'über die Adresse ' . $_SERVER['REMOTE_ADDR'] . ' haben wir eine' . "\n" . 'Anfrage zur Passworterneuerung erhalten.' . "\n\n");
define('EMAIL_PASSWORD_BODY', 'Ihr Passwort lautet:' . "\n\n" . '   %s' . "\n\n");

define('EMAIL_PASSWORD_FOOT', 'Mit den besten Grüssen,' . "\n" .  OWP_NAME . "\n\n\n" . OWP_HTTP_SERVER . '/' . "\n\n");

define('SUCCESS_PASSWORD_SENT', 'Ein neues Passwort wurde per eMail verschickt.');
define('ERROR_NO_USER', 'Fehler: Sie sind dem System unter der eingebenen \'eMail-Adresse\' nicht bekannt.');

?>