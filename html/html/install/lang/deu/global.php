<?php 
/* ----------------------------------------------------------------------
   $Id: global.php,v 1.13 2003/04/25 16:00:04 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:

   File: global.php,v 1.17.2.1 2002/04/03 21:03:19 jgm 
   ----------------------------------------------------------------------
   POST-NUKE Content Management System
   Copyright (C) 2001 by the Post-Nuke Development Team.
   http://www.postnuke.com/
   ----------------------------------------------------------------------
   Original Author of file: Gregor J. Rothfuss
   Purpose of file: Installer language defines.
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */
  
define('HTML_PARAMS','dir="LTR" lang="de"');
define('CHARSET', 'iso-8859-1');
define('INSTALLATION', 'OSIS Web Printer Installation');

define('BTN_CONTINUE', 'Weiter');
define('BTN_NEXT' ,'Weiter');
define('BTN_RECHECK', 'wiederholen');
define('BTN_SET_LANGUAGE', 'Sprache festlegen');
define('BTN_START','Start');
define('BTN_SUBMIT','best&auml;tigen');
define('BTN_NEW_INSTALL', 'Installation');
define('BTN_CHANGE_INFO', 'Daten &auml;ndern');
define('BTN_LOGIN_SUBMIT','Admin installieren');
define('BTN_SET_LOGIN', 'Weiter');
define('BTN_FINISH', 'Beenden');

define('GREAT', 'Willkommen bei OSIS Web Printer.');
define('GREAT_1', 'Die Komplettlösung zur schnellen Anbindung von Webanwendungen an Toshiba Tec Web Printer.'); 
define('SELECT_LANGUAGE_1', 'Auswahl Ihrer Sprache.');
define('SELECT_LANGUAGE_2', 'Sprachen: ');

define('DEFAULT_1', 'OSIS Web Printer ist eine allumfassende L&ouml;sung f&uuml;r das Drucken aus Ihrer Web-Anwendung per e-Mail, FTP und XML. Mit der F&uuml;lle von Werkzeugen,  die Ihnen zur Verf&uuml;gung stehen, k&ouml;nnen Sie praktisch &uuml;ber das  Internet drucken. Diese Anwendung installiert die OSIS Web Printer Datenbank  und hilft Ihnen bei der Konfiguration.');
define('DEFAULT_2', 'Dieses Programm ist freie Software. Sie k&ouml;nnen es unter den Bedingungen der GNU General Public License, wie von der Free Software Foundation ver&ouml;ffentlicht, weitergeben und/oder modifizieren, entweder gem&auml;&szlig; Version 2 der Lizenz  oder (nach Ihrer Option) jeder sp&auml;teren Version.');
define('DEFAULT_3', 'Die Ver&ouml;ffentlichung dieses Programms erfolgt in der Hoffnung, da&szlig; es Ihnen von Nutzen sein wird, aber ohne irgendeine Garantie, sogar ohne die implizite Garantie der Marktreife oder der Verwendbarkeit f&uuml;r einen bestimmten Zweck.');
define('DEFAULT_4', 'Bitte lesen ');
define('DEFAULT_5', 'Sie die GNU General Public License.');

define('PHP_CHECK_1', 'PHP Diagnose');
define('PHP_CHECK_2', 'Hier pr&uuml;fen wir die Konfigurationseinstellungen Ihrer PHP Installation. <a href=\'phpinfo.php\' target=\'_blank\'>PHP Info</a>');
define('PHP_CHECK_3', 'Ihre PHP Version ist ');
define('PHP_CHECK_4', 'Bitte installieren Sie eine aktuelle PHP Version - <a href=\'http://www.php.net\' target=\'_blank\'>http://www.php.net</a>');
define('PHP_CHECK_OK', 'Es sind uns keine Probelme mit Ihrer PHP Version in Verbindung mit OSIS Web Printer bekannt.');
define('PHP_CHECK_6', 'magic_quotes_gpc is Off.');
define('PHP_CHECK_7', 'Tragen Sie in Ihre .htaccess Datei folgende Zeile ein:<br />php_flag magic_quotes_gpc On');
define('PHP_CHECK_8', 'magic_quotes_gpc is ON.');
define('PHP_CHECK_9', 'magic_quotes_runtime is On.');
define('PHP_CHECK_10', 'Tragen Sie in Ihre .htaccess Datei folgende Zeile ein:<br />php_flag magic_quotes_runtime Off');
define('PHP_CHECK_11', 'magic_quotes_runtime is Off.');

define('CHMOD_CHECK_1', 'CHMOD Check');
define('CHMOD_CHECK_2', 'Wir &uuml;berpr&uuml;fen hier ob die Zugriffsrechte (CHMOD) f&uuml;r das Schreiben in die Konfiguration-Dateien richtig ist. Die OSIS Web  Printer Installation schreibt in Ihre Konfigurationsdateien Ihre Zugangsdaten  verschl&uuml;sselt.');
define('CHMOD_CHECK_3', 'CHMOD ~/includes/config.php ist 666 -- RICHTIG');
define('CHMOD_CHECK_4', 'Bitte &auml;ndern Sie die Zugriffsrechte (CHMOD 666) der Datei ~/includes/config.php ');
define('CHMOD_CHECK_5', 'CHMOD ~/includes/config-old.php ist 666 -- RICHTIG');
define('CHMOD_CHECK_6', 'Bitte &auml;ndern Sie die Zugriffsrechte (CHMOD 666) der Datei ~/includes/config-old.php ');

define('CHM_CHECK_1', 'Bitte geben Sie die Zugangsdaten Ihrer Datenbank ein. Sollten Sie keine Root-Rechte bei Ihrer Datenbank haben (z.b. virtual Hosting) erstellen Sie die Datenbank vorher. Zur Erstellung einer Datenbank empfehlen wir Ihnen phpMyAdmin. OSIS Web Printer Installation wird in Ihre Datenbank die notwendigen Tabelle anlegen.');
define('DBHOST', 'Datenbank Server');
define('DBINFO', 'Datenbank Information');
define('DBNAME', 'Datenbank Name');
define('DBPASS', 'Datenbank Passwort');
define('DBPREFIX', 'Tabellen Pr&auml;fix (f&uuml;r Tabellen Sharing)');
define('DBTYPE', 'Datenbank Type');
define('DBUNAME', 'Datenbank Anwendername');

define('SUBMIT_1', 'Bitte kontrollieren Sie Zugangsdaten Ihrer Datenbank.');
define('SUBMIT_2', 'Sie haben folgende Zugangsdaten angegeben:');
#define('SUBMIT_3', 'Select <b>New Install</b> or <b>Upgrade</b> to continue.');
define('SUBMIT_3', 'Sind die Angaben korrekt, klicken Sie bitte auf <code>Installation</code>');

define('CHANGE_INFO_1', 'DB Zugangsdaten &auml;ndern');
define('CHANGE_INFO_2', 'Bitte korrigieren Sie Ihre Datenbank Zugangsdaten');

define('NEW_INSTALL_1', 'Neue Installation.');
define('NEW_INSTALL_2', 'Die OSIS WebPrinter Datenbank wird mit folgenden Zugangsdaten erstellt:');
define('NEW_INSTALL_3', 'Soll die Datenbank erstellt werden <samp>(root)</samp>, aktivieren Sie <b>Datenbank anlegen</b>.<br />Ist die Datenbank bereits angelegt, klicken Sie bitte auf Start. Es werden die Tabellen angelegt.');
define('NEW_INSTALL_4', 'Datenbank anlegen');

define('MADE', ' erstellt.');
define('MAKE_DB_1', 'Datenbank konnte nicht erstellt werden');
define('MAKE_DB_2', 'wurde angelegt.');
define('MAKE_DB_3', 'Keine Datenbank erstellt.');
define('MODIFY_FILE_1', 'Error: unable to open for read:');
define('MODIFY_FILE_2', 'Error: unable to open for write:');
define('MODIFY_FILE_3', 'Error: lines changed, did nothing');
define('SHOW_ERROR_INFO', 'Fehler:</b> OSIS Web Printer Installation konnte nicht in die \'config.php\' Datei  schreiben. <br /> Sie k&ouml;nnen mit einem Editor diese Datei selbst &auml;ndern. <br />Hier die Informationen  die Sie eintragen sollten:');

define('CONTINUE_1', 'Datenbank Administrator');
define('CONTINUE_2', 'Legen Sie nun den Administrator f&uuml;r OSIS Web Printer fest. Sie k&ouml;nnen sp&auml;ter mit der Email - Adresse und dem Passwort OSIS Web Printer konfigurieren.');
define('CONTINUE_3', 'Bitte kontrollieren Sie Ihre Angaben. Eine &Auml;nderung ist sp&auml;ter nicht mehr m&ouml;glich!');

define('ADMIN_GENDER', 'Admin Anrede');
define('MALE', 'Herr');
define('FEMALE', 'Frau');
define('ADMIN_FIRSTNAME', 'Admin Vorname');
define('ADMIN_NAME', 'Admin Name');
define('ADMIN_EMAIL','Admin Email');
define('ADMIN_FIRSTNAME', 'Vorname');
define('ADMIN_NAME', 'Admin Name');
define('ADMIN_PHONE', 'Admin Telefon');
define('ADMIN_FAX', 'Admin Fax');
define('ADMIN_PASS','Admin Passwort');
define('ADMIN_REPEATPASS','Passwort best&auml;tigen');
define('PASSWORD_HIDDEN', '--VERSTECKT--');
define('OWP_URL', 'Virtual Path (URL)');
define('ROOT_DIR', 'Webserver Root Directory');
define('ADMIN_INSTALL', 'Sind die Angaben korrekt, klicken Sie bitte auf <code>Admin installieren</code>');
define('PASSWORD_ERROR', 'Das \'Passwort\' und die \'Best&auml;tigung\' müssen übereinstimmen!');
define('ADMIN_ERROR', 'Fehler:');
define('ADMIN_PASSWORD_ERROR', 'Bitte geben Sie ein \'Passwort\' ein!');
define('ADMIN_EMAIL_ERROR', 'Bitte geben Sie Ihre \'E-Mail Adresse\' ein!');

define('INPUT_DATA', 'Daten f&uuml;r OSIS Web Printer ');

define('FINISH_1', 'Danksagung');
define('FINISH_2', 'Bei dieser Gelegenheit m&ouml;chten wir allen danken, die zur Entwicklung von OSIS Web Printer beigetragen haben. Unser spezieller Dank geb&uuml;hrt den Entwicklern  von PHP. ');
define('FINISH_3', 'Sie haben OSIS Web Printer erfolgreich installiert. Bitte l&ouml;schen Sie nun das Installations Verzeichnis');
define('FINISH_4', 'OSIS Web Printer Homepage');
define('NOTUPDATED', 'nicht Installiert:');
// All entries use ISO 639-2/T
// http://www.loc.gov/standards/iso639-2/langcodes.html
define('LANGUAGE_DEU', 'Deutsch');
define('LANGUAGE_ENG', 'English');

define('LANGUAGE_ARA', 'Arabic');
define('LANGUAGE_BUL', 'Bulgarian');
define('LANGUAGE_CES', 'Czech');
define('LANGUAGE_CRO','Croatian');
define('LANGUAGE_DAN', 'Danish');
define('LANGUAGE_ELL', 'Greek');
define('LANGUAGE_EPO', 'Esperanto');
define('LANGUAGE_EST', 'Estonian');
define('LANGUAGE_FIN', 'Finnish');
define('LANGUAGE_FRA', 'French');
define('LANGUAGE_HEB', 'Hebrew');
define('LANGUAGE_HUN', 'Hungarian');
define('LANGUAGE_IND', 'Indonesian');
define('LANGUAGE_ISL', 'Icelandic');
define('LANGUAGE_ITA', 'Italian');
define('LANGUAGE_JPN', 'Japanese');
define('LANGUAGE_KOR', 'Korean');
define('LANGUAGE_LAV', 'Latvian');
define('LANGUAGE_LIT', 'Lithuanian');
define('LANGUAGE_MAS', 'Malay');
define('LANGUAGE_NLD', 'Dutch');
define('LANGUAGE_NOR', 'Norwegian');
define('LANGUAGE_POL', 'Polish');
define('LANGUAGE_POR', 'Portuguese');
define('LANGUAGE_RON', 'Romanian');
define('LANGUAGE_RUS', 'Russian');
define('LANGUAGE_SLV', 'Slovenian');
define('LANGUAGE_SPA', 'Spanish');
define('LANGUAGE_SWE', 'Swedish');
define('LANGUAGE_THA', 'Thai');
define('LANGUAGE_TUR', 'Turkish');
define('LANGUAGE_UKR', 'Ukrainian');
define('LANGUAGE_X_RUS_KOI8R', 'Russian KOI8-R');
define('LANGUAGE_YID', 'Yiddish');
define('LANGUAGE_ZHO', 'Chinese');
define('LANGUAGE_CAT', 'Catalan');

// Non-ISO entries are written as x_[language name]

define('LANGUAGE_X_BRAZILIAN_PORTUGUESE', 'Brazilian Portuguese');
define('LANGUAGE_X_KLINGON', 'Klingon');
?>
