<?php
/* ----------------------------------------------------------------------
   $Id: newconfigdata.php,v 1.1 2003/04/23 16:06:27 r23 Exp $

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
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('OSIS WebPrinter Name', 'OWP_NAME', 'OSIS WebPrinter', 'Der Name der Anwendung', '1', '1', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('OWP Eigentümer', 'OWP_OWNER', 'Ralf Zschemisch', 'Der Name des Eintümers', '1', '2', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('E-Mail Adresse', 'OWP_OWNER_EMAIL_ADDRESS', 'root@localhost', 'Die E-Mail Adresse des Eingentümers.', '1', '3', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('E-Mail Absender', 'EMAIL_FROM', 'OSIS WebPrinter <root@localhost>', 'Die Absender E-Mail Adresse dieser Anwendung.', '1', '4', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Land', 'OWP_COUNTRY', '81', 'Land', '1', '6', 'owpGetCountryName', 'owpCfgPullDownCountryList(', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Bundesland', 'OWP_ZONE', '88', 'Bundesland', '1', '7', 'owpGetZoneName', 'owpCfgPullDownZoneList(', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Kopie der Printer-Emails an', 'OWP_PRINTER_COPY_EMAILS_TO', '', 'Die Kopie der Printer E-Mail senden an: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '1', '11', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");


//e-mail option
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('E-Mail Transport Method', 'EMAIL_TRANSPORT', 'sendmail', 'Defines if this server uses a local connection to sendmail or uses an SMTP connection via TCP/IP. Servers running on Windows and MacOS should change this setting to SMTP.', '4', '1', 'owpCfgSelectOption(array(\'sendmail\', \'smtp\'),', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('E-Mail Linefeeds', 'EMAIL_LINEFEED', 'LF', 'Defines the character sequence used to separate mail headers.', '4', '2', 'owpCfgSelectOption(array(\'LF\', \'CRLF\'),', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Use MIME HTML When Sending Emails', 'EMAIL_USE_HTML', 'false', 'Send e-mails in HTML format', '4', '3', 'owpCfgSelectOption(array(\'true\', \'false\'),', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Verfiy E-Mail Addresses Through DNS', 'ENTRY_EMAIL_ADDRESS_CHECK', 'false', 'Verfiy e-mail address through a DNS server', '4', '4', 'owpCfgSelectOption(array(\'true\', \'false\'), ', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send E-Mails', 'SEND_EMAILS', 'true', 'Send out e-mails', '4', '5', 'owpCfgSelectOption(array(\'true\', \'false\'), ', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");

//layout die Gestaltung ist *noch* versteckt
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Seite in XHTML', 'LAYOUT_XHTML', 'false', 'Möchten Sie die Seite in XHTML anzeigen lassen?', '5', '1', 'owpCfgSelectOption(array(\'true\', \'false\'), ', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");
$result = $db->Execute("INSERT INTO ".$prefix."_configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Breite der linken Box', 'BOX_WIDTH', '125', 'Die Breite der linken Box in Pixel', '5', '2', " . $db->DBTimeStamp($today) . ")") or die ("<b>"._NOTUPDATED.$prefix."_configuration</b>");

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
$result = $db->Execute("INSERT INTO ".$prefix."_configuration_group VALUES ('5', 'Layout', 'Gestaltung der Seite', '5', '0')") or die ("<b>"._NOTUPDATED.$prefix."_configuration_group</b>");

echo '<br /><font class="owp-title">' . $prefix."_configuration_group" . UPDATED .'</font>';


?>
