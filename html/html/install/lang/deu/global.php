<?php 
/* ----------------------------------------------------------------------
   $Id: global.php,v 1.8 2003/04/01 05:15:34 r23 Exp $

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
define('PHP_CHECK_5', 'Es sind uns keine Probelme mit Ihrer PHP Version in Verbindung mit OSIS Web Printer bekannt.');
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

define('CHM_CHECK_1', 'Bitte geben Sie die Zugangsdaten Ihrer Datenbank an. Sollten Sie keine Root-Rechte bei Ihrer Datenbank haben (z.b. virtual Hosting) erstellen Sie die Datenbank vorher. Zur Erstellung einer Datenbank empfehlen wir Ihnen phpMyAdmin. OSIS Web Printer Installtion wird in Ihrer Datenbank die notwendigen Tabelle anlegen.');
define('DBHOST', 'Datenbank Host');
define('DBINFO', 'Datenbank Information');
define('DBNAME', 'Datenbank Name');
define('DBPASS', 'Datenbank Passwort');
define('DBPREFIX', 'Tabellen Pr&auml;fix (f&uuml;r Tabellen Sharing)');
define('DBTYPE', 'Datenbank Type');
define('DBUNAME', 'Datenbank Anwendername');

define('SUBMIT_1','Bitte kontrollieren Sie Zugangsdaten Ihrer Datenbank.');
define('SUBMIT_2','Sie haben folgende Zugangsdaten angegeben:');
#define('SUBMIT_3','Select <b>New Install</b> or <b>Upgrade</b> to continue.');
define('SUBMIT_3','Sind die Angaben korrekt, klicken Sie bitte auf <code>New Install</code>');

define('CHANGE_INFO_1', 'DB Zugangsdaten &auml;ndern');
define('CHANGE_INFO_2', 'Bitte korrigieren Sie Ihre Datenbank Zugangsdaten');

define('NEW_INSTALL_1', 'You have choosen to do a new install. Below is the information that you have entered.');
define('NEW_INSTALL_2', 'If you have root access, check the <b>create the database</b> box. Otherwise, just click on start.<br>If you do not have root access you need to create the db manually and this script will then add the tables for you.');
define('NEW_INSTALL_3', 'Create the Database');



define('ADMIN_EMAIL','Admin Email');
define('ADMIN_LOGIN','Admin Login');
define('ADMIN_NAME','Admin Name');
define('ADMIN_PASS','Admin Password');
define('ADMIN_REPEATPASS','Admin Password (verify)');
define('ADMIN_URL','Admin URL');

define('FINISH_1','The Credits');
define('FINISH_2','These are the scripts and people that make PostNuke go. Take some time and let these people know how much you appreciate their work. If you would like to be listed here, contact us about being a part of the developement team. We are always looking for some help.');
define('FINISH_3','You are now done with the PostNuke installation. If you run into any problems, let us know.  Make sure that you delete this script. You will not need it again.');
define('FINISH_4','Go to your PostNuke site');



define('_BTN_CHANGEINFO','Change Info');
define('_BTN_NEWINSTALL','New install');
define('_BTN_UPGRADE','Upgrade');
define('_BTN_CONTINUE','Continue');
define('_BTN_FINISH','Finish');
define('_BTN_SET_LOGIN','Set Login');


define('_CONTINUE_1','Setting Your DB Preferences');
define('_CONTINUE_2','You can now set up your administrative account. If you pass on this set up, your login for the administrative account will be Admin / Password (case sensitive).  It is advisable to set it up now, and not wait until later.');
define('_DONE','Done.');
define('_FINISH_1','The Credits');
define('_FINISH_2','These are the scripts and people that make PostNuke go. Take some time and let these people know how much you appreciate their work. If you would like to be listed here, contact us about being a part of the developement team. We are always looking for some help.');
define('_FINISH_3','You are now done with the PostNuke installation. If you run into any problems, let us know.  Make sure that you delete this script. You will not need it again.');
define('_FINISH_4','Go to your PostNuke site');
define('_FORUM_INFO_1','Your forum tables are untouched.<br><br>FYI, those tables are:');
define('_FORUM_INFO_2','So, you can delete those tables if you don\'t want to use forums.<br> phpBB should be available as a module from http://mods.postnuke.com');
define('_INPUT_DATA_1','Uploaded Data');
define('_INSTALLATION','PostNuke Installation');
define('_ISINTRANET','Site is for intranet or other local (non-internet) use');
define('_INTRANETINFO','You must set the "intranet" option if your site does not use a fully-qualified host name for access.  Examples of fully qualified hostnames are www.postnuke.com and foo.bar.com.  Examples of hostnames that are not fully qualified are foo.com, localhost, and mysite.org  If you do not set this paramter properly you might not be able to log in to your site.');
define('_MADE',' made.');
define('_MAKE_DB_1','Unable to make database');
define('_MAKE_DB_2','has been created.');
define('_MAKE_DB_3','No database made.');
define('_MODIFY_FILE_1','Error: unable to open for read:');
define('_MODIFY_FILE_2','Error: unable to open for write:');
define('_MODIFY_FILE_3','0 lines changed, did nothing');
define('_NO','No');
define('_NOTMADE','Unable to make ');
define('_NOTSELECT','Unable to select database.');
define('_NOTUPDATED','Unable to update ');

define('_PWBADMATCH', 'The passwords supplied do not match.  Please go back and re-type the passwords to ensure they are the same.');

define('_SHOW_ERROR_INFO_1','Write error</b> unable to update your \'config.php\' file<br/> You will have to modify this file yourself using a text editor.<br/> Here are the changes required:');
define('_SKIPPED','Skipped.');

define('_SUCCESS_1','Finished');
define('_SUCCESS_2','Your upgrade to the latest version of PostNuke is finished.<br> Remember to change your config.php settings before using for the first time.');
define('_UPDATED',' updated.');
define('_UPDATING','Updating table: ');
define('_UPGRADE_1','Upgrades');
define('_UPGRADE_2','Here is where you can select which CMS your are upgrading from.<br><br><center> Select <b>PHP-Nuke</b> to upgrade an existing PHP-Nuke install.<br> Select <b>PostNuke</b> to upgrade an existing PostNuke install.<br> Select <b>MyPHPNuke</b> to upgrade an exisitng MyPHPNuke install.');
define('_UPGRADETAKESALONGTIME','Carrying out a PostNuke upgrade can take a long time, maybe a matter of minutes.  When selecting an upgrade option please select the option only once, and wait for the next screen to appear.  Clicking on upgrade options multiple times can cause the upgrade process to fail');
define('_YES', 'Yes');
?>
