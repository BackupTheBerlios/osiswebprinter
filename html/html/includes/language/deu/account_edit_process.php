<?php
/* ----------------------------------------------------------------------
   $Id: account_edit_process.php,v 1.3 2003/05/06 13:48:11 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: account_edit_process.php,v 1.9 2002/04/17 15:57:07 harley_vb
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

define('NAVBAR_TITLE_1', 'Mein Konto');
define('NAVBAR_TITLE_2', 'pers&ouml;nliche Daten &auml;ndern');
define('HEADING_TITLE', 'pers&ouml;nliche Daten &aumlndern:');

define('EMAIL_SUBJECT', 'Update bei ' . OWP_NAME);
define('EMAIL_GREET_MR', 'Sehr geehrter Herr ');
define('EMAIL_GREET_MS', 'Sehr geehrte Frau ');

define('EMAIL_UPDATE', 'Wir haben die Änderungen Ihrer persönlichen Daten erhalten.' . "\n\n" . 'Ihre neue Zugangsbestättigung senden wir Ihnen per eMail.' . "\n\n");
define('EMAIL_TEXT', 'Mit ' . OWP_NAME . ' wird das Drucken zum Vergügen.' . "\n\n");
define('EMAIL_CONTACT', 'Ihre Fragen und Meinungen sind uns wichtig. Wenn Sie also ' . "\n" . 'einen Vorschlag haben, wie wir ' . OWP_NAME . ' noch anregender,' . "\n" . 'praktischer oder persönlicher gestalten können, zögern Sie'  . "\n" . 'nicht, sich mit uns in Verbindung zu setzen:' . "\n\n" . DEVELOPER_SITE . ': http://developer.berlios.de/projects/osiswebprinter/' . "\n" . SUPPORT_FORUMS . ': http://developer.berlios.de/forum/?group_id=752' . "\n" . MAILING_LISTS . ': https://lists.berlios.de/mailman/listinfo/osiswebprinter-users' . "\n\n" . 'Ihre persönlichen Zugangsdaten senden wir Ihnen zu.' . "\n\n");

define('EMAIL_FOOT', 'Mit den besten Grüssen,' . "\n" . 'Ihr ' . OWP_NAME . ' Team' . "\n\n\n" . OWP_HTTP_SERVER . "\n\n");

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('OWNER_EMAIL_NUMBER', 'Datensatz Nr.:');
define('OWNER_EMAIL_URL', 'Zugang verwalten:');
define('OWNER_EMAIL_DATE', 'Änderungsdatum:');
define('OWNER_EMAIL_SUBJECT', 'Änderung der Anwender Daten');
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