<?php
/* ----------------------------------------------------------------------
   $Id: password_forgotten.php,v 1.2 2003/04/23 16:09:00 r23 Exp $

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

define('NAVBAR_TITLE_1', 'Anmelden');
define('NAVBAR_TITLE_2', 'Passwort vergessen');
define('HEADING_TITLE', 'Wie war noch mal mein Passwort?');
define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<font color="#ff0000"><b>ACHTUNG:</b></font> Die eingegebene eMail-Adresse ist nicht registriert. Bitte versuchen Sie es noch einmal.');
define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Ihr neues Passwort.');
define('EMAIL_PASSWORD_REMINDER_BODY', '&Uuml;ber die Adresse ' . $REMOTE_ADDR . ' haben wir eine Anfrage zur Passworterneuerung erhalten.' . "\n\n" . 'Ihr neues Passwort f&uuml;r \'' . STORE_NAME . '\' lautet ab sofort:' . "\n\n" . '   %s' . "\n\n");
define('TEXT_PASSWORD_SENT', 'Ein neues Passwort wurde per eMail verschickt.');
?>