<?php
/* ----------------------------------------------------------------------
   $Id: newconfigdata.php,v 1.5 2003/05/05 16:51:37 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: newdata.php,v 1.73.2.4 2002/05/14 18:18:05 byronmhome 
   ----------------------------------------------------------------------
   POST-NUKE Content Management System
   Copyright (C) 2001 by the Post-Nuke Development Team.
   http://www.postnuke.com/
   ----------------------------------------------------------------------
   INSERT INTO 
   Based on:
   
   File: oscommerce.sql,v 1.57 2002/11/03 23:41:42 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com
   
   Copyright (c) 2002 osCommerce  
   ---------------------------------------------------------------------- 
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */


// Mein OSIS WebPrinter
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('OSIS Web Printer Name', 'OWP_NAME', 'OSIS Web Printer', 'Der Name der Anwendung', '1', '1', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('OWP Eigentümer', 'OWP_OWNER', " . $db->qstr($admin_name) . ", 'Der Name des Eigentümers', '1', '2', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('E-Mail Adresse', 'OWP_OWNER_EMAIL_ADDRESS', " . $db->qstr($email) . ", 'Die E-Mail Adresse des Eigentümers.', '1', '3', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('E-Mail Absender', 'OWP_EMAIL_ADDRESS', 'root@localhost', 'Die Absender E-Mail Adresse dieser Anwendung.', '1', '4', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Land', 'OWP_COUNTRY', '81', 'Land', '1', '6', 'owpGetCountryName', 'owpCfgPullDownCountryList(', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Bundesland', 'OWP_ZONE', '88', 'Bundesland', '1', '7', 'owpGetZoneName', 'owpCfgPullDownZoneList(', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Kopie der Printer-Emails an', 'OWP_PRINTER_COPY_EMAILS_TO', '', 'Die Kopie der Printer E-Mail senden an: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '1', '11', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");

//e-mail option
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('E-Mail Transport Method', 'EMAIL_TRANSPORT', 'sendmail', 'Defines if this server uses a local connection to sendmail or uses an SMTP connection via TCP/IP. Servers running on Windows and MacOS should change this setting to SMTP.', '4', '1', 'owpCfgSelectOption(array(\'sendmail\', \'smtp\'),', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('E-Mail Linefeeds', 'EMAIL_LINEFEED', 'LF', 'Defines the character sequence used to separate mail headers.', '4', '2', 'owpCfgSelectOption(array(\'LF\', \'CRLF\'),', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Use MIME HTML When Sending Emails', 'EMAIL_USE_HTML', 'false', 'Send e-mails in HTML format', '4', '3', 'owpCfgSelectOption(array(\'true\', \'false\'),', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Verfiy E-Mail Addresses Through DNS', 'ENTRY_EMAIL_ADDRESS_CHECK', 'false', 'Verfiy e-mail address through a DNS server', '4', '4', 'owpCfgSelectOption(array(\'true\', \'false\'), ', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send E-Mails', 'SEND_EMAILS', 'true', 'Send out e-mails', '4', '5', 'owpCfgSelectOption(array(\'true\', \'false\'), ', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");

//5 MS-Excel
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Export von CSV-Dateien', 'OWP_CSV_EXCEL', 'false', 'Möchten Sie die Länder und Bundesländer in CSV-Dateien exportieren', '5', '1', 'owpCfgSelectOption(array(\'true\', \'false\'),', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('CSV - Verzeichnis', 'OWP_CSV_TEMP', 'd:/tmp/excel/', 'Das Verzeichnis in dem die CSV-Datei gespeichert werden soll.', '5', '2', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('CVS - Datei per E-Mail', 'CVS_SEND_MAIL', 'true', 'Möchten Sie die CVS-Datei per E-Mail erhalten?', '5', '3', 'owpCfgSelectOption(array(\'true\', \'false\'),', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Download der CSV-Datei', 'CVS_DOWNLOAD', 'false', 'Möchten Sie die CSV-Datei direkt downloaden? Funktioniert leider nicht mit jedem Browser. Header manipulationen sollten aus sein.', '5', '4', 'owpCfgSelectOption(array(\'true\', \'false\'),', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Löschen der CSV-Datei', 'CVS_DELETE_FILE', 'true', 'Soll die CSV-Datei nach dem Download gelöscht werden?', '5', '5', 'owpCfgSelectOption(array(\'true\', \'false\'),', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");

//6 layout die Gestaltung 
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Seite in XHTML', 'LAYOUT_XHTML', 'false', 'Möchten Sie die Seite in XHTML anzeigen lassen?', '6', '1', 'owpCfgSelectOption(array(\'true\', \'false\'), ', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Breite der linken Box', 'BOX_WIDTH', '125', 'Die Breite der linken Box in Pixel', '6', '2', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Anzahl der Suchergebnisse', 'MAX_DISPLAY_SEARCH_RESULTS', '15', 'Die maximale Anzahl der Suchergebnisse auf einer Seite', '6', '3', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Calculate Image Size', 'CONFIG_CALCULATE_IMAGE_SIZE', 'true', 'Calculate the size of images?', '6', '4', 'owpCfgSelectOption(array(\'true\', \'false\'), ', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Image Required', 'OWP_IMAGE_REQUIRED', 'false', 'Enable to display broken images. Good for development.', '6', '5', 'owpCfgSelectOption(array(\'true\', \'false\'), ', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");

//7 Mindestangaben 
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Vorname', 'FIRST_NAME_MIN_LENGTH', '3', 'Angaben zum Vornamen müssen mindestens diese Anzahl an Zeichen haben', '7', '1', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Nachname', 'LAST_NAME_MIN_LENGTH', '3', 'Angaben zum Nachnamen müssen mindestens diese Anzahl an Zeichen haben', '7', '2', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('E-Mail', 'EMAIL_ADDRESS_MIN_LENGTH', '4', 'Angaben zur e-Mail Adresse müssen mindestens diese Anzahl an Zeichen haben', '7', '3', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Telefonnummer', 'TELEPHONE_MIN_LENGTH', '5', 'Angaben zur Telefonnummer müssen mindestens diese Anzahl an Zeichen haben', '7', '4', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Passwort', 'PASSWORD_MIN_LENGTH', '5', 'Angaben zum Passwort müssen mindestens diese Anzahl an Zeichen haben', '7', '5', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");

//8 system einstellungen versteckt
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order ) VALUES ('Standard Sprache', 'DEFAULT_LANGUAGE', 'deu', 'Standardsprache', '8', '1')") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order ) VALUES ('Zugang', 'DEFAULT_ADMIN_LOGIN', '0', 'Neue Anmeldungen erhalten keinen Zugang', '8', '2')") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");

echo '<br /><font class="owp-title">' . $prefix."_configuration" . UPDATED .'</font>';

/*!
  eine konfiguration gruppe kann versteckt werden, wenn visible = 0 ist.
  beispiel
  $result = $db->Execute("INSERT INTO ".$prefix."_configuration_group VALUES ('99', 'Verstecken', 'Diese Gruppe verstecken', '99', '0')") or die ("<b>"._NOTUPDATED.$prefix."_configuration_group</b>");
*/
$result = $db->Execute("INSERT INTO ".$prefix."_configuration_group VALUES ('1', 'Mein OSIS WebPrinter', 'OSIS WebPrinter Einstellungen', '1', '1')") or die ("<b>"._NOTUPDATED.$prefix."_configuration_group</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration_group VALUES ('2', 'Mein WebDrucker', 'Allgemeine Toshiba WebDrucker Informatioen', '2', '1')") or die ("<b>"._NOTUPDATED.$prefix."_configuration_group</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration_group VALUES ('3', 'FTP Optionen', 'FTP-Server Konfiguration Ihres Druckers', '3', '1')") or die ("<b>"._NOTUPDATED.$prefix."_configuration_group</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration_group VALUES ('4', 'E-Mail Optionen', 'E-Mail Konfigration', '4', '1')") or die ("<b>"._NOTUPDATED.$prefix."_configuration_group</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration_group VALUES ('5', 'MS-Excel', 'CSV Export für MS-Excel', '5', '1')") or die ("<b>"._NOTUPDATED.$prefix."_configuration_group</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration_group VALUES ('6', 'Layout', 'Gestaltung der Seite', '6', '1')") or die ("<b>"._NOTUPDATED.$prefix."_configuration_group</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration_group VALUES ('7', 'Mindestangaben', 'Für einige Funktionen werden Mindestangaben benötigt', '7', '1')") or die ("<b>"._NOTUPDATED.$prefix."_configuration_group</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration_group VALUES ('8', 'OWP System', 'System Einstellung', '8', '0')") or die ("<b>"._NOTUPDATED.$prefix."_configuration_group</b>");

echo '<br /><font class="owp-title">' . $prefix."_configuration_group" . UPDATED .'</font>';


?>
