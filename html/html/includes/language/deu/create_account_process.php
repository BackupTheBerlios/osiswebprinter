<?php
/* ----------------------------------------------------------------------
   $Id: create_account_process.php,v 1.3 2003/05/05 16:49:29 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: create_account_process.php,v 1.14 2002/07/07 05:15:54 project3000
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

define('NAVBAR_TITLE_1', 'Konto erstellen');
define('NAVBAR_TITLE_2', 'Bearbeitung');
define('HEADING_TITLE', 'Meine Zugangsinformation');

define('EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<small><font color="#FF0000">Diese eMail-Adresse ist falsch und existiert nicht!</font></small>');

define('EMAIL_SUBJECT', 'Willkommen bei ' . OWP_NAME);
define('EMAIL_GREET_MR', 'Sehr geehrter Herr ');
define('EMAIL_GREET_MS', 'Sehr geehrte Frau ');

define('EMAIL_WELCOME', 'herzlich willkommen bei ' . OWP_NAME . '! Wir danken Ihnen, dass Sie' . "\n" . 'sich für ' . OWP_NAME . ' entschieden haben und freuen uns, Ihnen in' . "\n" . 'Zukunft alle Vorteile und Möglichkeiten anbieten zu können,' . "\n" . 'die ' . OWP_NAME . ' so angenhem machen. ' . "\n\n");
define('EMAIL_TEXT', 'Mit ' . OWP_NAME . ' wird das Drucken zum Vergügen.' . "\n\n");
define('EMAIL_CONTACT', 'Ihre Fragen und Meinungen sind uns wichtig. Wenn Sie also ' . "\n" . 'einen Vorschlag haben, wie wir ' . OWP_NAME . ' noch anregender,' . "\n" . 'praktischer oder persönlicher gestalten können, zögern Sie'  . "\n" . 'nicht, sich mit uns in Verbindung zu setzen:' . "\n\n" . DEVELOPER_SITE . ': http://developer.berlios.de/projects/osiswebprinter/' . "\n" . SUPPORT_FORUMS . ': http://developer.berlios.de/forum/?group_id=752' . "\n" . MAILING_LISTS . ': https://lists.berlios.de/mailman/listinfo/osiswebprinter-users' . "\n\n" . 'Ihre persönlichen Zugangsdaten senden wir Ihnen zu.' . "\n\n");

define('EMAIL_FOOT', 'Mit den besten Grüssen,' . "\n" . 'Ihr ' . OWP_NAME . ' Team' . "\n\n\n" . OWP_HTTP_SERVER . "\n\n");

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('OWNER_EMAIL_NUMBER', 'Datensatz Nr.:');
define('OWNER_EMAIL_URL', 'Zugang verwalten:');
define('OWNER_EMAIL_DATE', 'Anmeldedatum:');
define('OWNER_EMAIL_SUBJECT', 'Neuer Anwender');
define('OWNER_EMAIL_PERSONAL', 'pers&ouml;nliche Daten');
define('OWNER_EMAIL_CONTACT', 'Kontaktinformation');
define('OWNER_EMAIL_OPTIONS', 'Optionen');

define('OWNER_EMAIL_GENDER', 'Anrede ...........:');
define('OWNER_EMAIL_FIRST_NAME', 'Vorname ..........:');
define('OWNER_EMAIL_LAST_NAME','Nachname .........:');
define('OWNER_EMAIL_ADDRESS', 'eMail-Adresse ....:');

define('OWNER_EMAIL_TELEPHONE_NUMBER','Telefonnummer ....:');
define('OWNER_EMAIL_FAX_NUMBER', 'Faxnummer ........:');
define('OWNER_EMAIL_NEWSLETTER','Newsletter .......: ');
define('ENTRY_NEWSLETTER_YES', 'abonniert');
define('ENTRY_NEWSLETTER_NO', 'nicht abonniert');

?>