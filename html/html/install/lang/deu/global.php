<?php 
/* ----------------------------------------------------------------------
   $Id: global.php,v 1.3 2003/03/28 03:03:36 r23 Exp $

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
define('GREAT', 'Willkommen bei OSIS Web Printer.');
define('GREAT_1', 'Die Komplettl�sung zur schnellen Anbindung von Webanwendungen an Toshiba Tec Web Printer.'); 
define('SELECT_LANGUAGE_1', 'Auswahl Ihrer Sprache.');
define('SELECT_LANGUAGE_2', 'Sprachen: ');
define('BTN_SET_LANGUAGE', 'Sprache festlegen');
define('FOOTER', 'Copyright (c) 2003 OSIS GmbH : <a href="http://www.r23.de/" target="_blank">Ralf Zschemisch</a><br>Powered by <a href="http://www.osisnet.de/shop.php" target="_blank">OSIS GmbH</a>');
define('DEFAULT_1', 'OSIS Web Printer ist eine allumfassende L&ouml;sung f&uuml;r das Drucken aus Ihrer Web-Anwendung per e-Mail, FTP und XML. Mit der F&uuml;lle von Werkzeugen,  die Ihnen zur Verf&uuml;gung stehen, k&ouml;nnen Sie praktisch &uuml;ber das  Internet drucken. Diese Anwendung installiert die OSIS Web Printer Datenbank  und hilft Ihnen bei der Konfiguration.');
define('DEFAULT_2', 'Dieses Programm ist freie Software. Sie k&ouml;nnen es unter den Bedingungen der GNU General Public License, wie von der Free Software Foundation ver&ouml;ffentlicht, weitergeben und/oder modifizieren, entweder gem&auml;&szlig; Version 2 der Lizenz  oder (nach Ihrer Option) jeder sp&auml;teren Version.');
define('DEFAULT_3', 'Die Ver&ouml;ffentlichung dieses Programms erfolgt in der Hoffnung, da&szlig; es Ihnen von Nutzen sein wird, aber ohne irgendeine Garantie, sogar ohne die implizite Garantie der Marktreife oder der Verwendbarkeit f&uuml;r einen bestimmten Zweck.');
define('DEFAULT_4', 'Bitte lesen ');
define('DEFAULT_5', 'Sie die GNU General Public License.');
define('NEXT','Weiter');

define('_DEFAULT_2','Our License');
define('_DEFAULT_3','Please read through the GNU General Public License. PostNuke is developed as free software, but there are certain requirements for distributing and editing.');

define('_ADMIN_EMAIL','Admin Email');
define('_ADMIN_LOGIN','Admin Login');
define('_ADMIN_NAME','Admin Name');
define('_ADMIN_PASS','Admin Password');
define('_ADMIN_REPEATPASS','Admin Password (verify)');
define('_ADMIN_URL','Admin URL');
define('_BTN_CHANGEINFO','Change Info');
define('_BTN_NEWINSTALL','New install');
define('_BTN_UPGRADE','Upgrade');
define('_BTN_CONTINUE','Continue');
define('_BTN_FINISH','Finish');
define('_BTN_NEXT','Next');
define('_BTN_RECHECK','Re-check');
define('_BTN_SET_LANGUAGE','Set Language');
define('_BTN_SET_LOGIN','Set Login');
define('_BTN_START','Start');
define('_BTN_SUBMIT','Submit');
define('_CHANGE_INFO_1','Please correct your database information.');
define('_CHMOD_CHECK_1','CHMOD Check');
define('_CHMOD_CHECK_2','We will first check to see that your CHMOD settings are correct in order for the script to write to the file. If your settings are not correct, this script will not be able to encrypt your data in your config file. Encrypting the SQL data is added security, and is set by this script. You will also not be able to update your preferences from your admin once your site is up and running.');
define('_CHMOD_CHECK_3','CHMOD setting for config.php is 666 -- correct, this script can write to the file');
define('_CHMOD_CHECK_4','Please set your CHMOD on config.php to 666 so this script can write and encrypt the DB data');
define('_CHMOD_CHECK_5','CHMOD setting for config-old.php is 666 -- correct, this script can write to the file');
define('_CHMOD_CHECK_6','Please set your CHMOD on config-old.php to 666 so this script can write and encrypt the DB data');
define('_CHM_CHECK_1', 'Please enter your DB info. If you do not have root access to your DB (virtual hosting, etc), you will need to make your database before you proceed. A good rule of thumb, if you cannot create databases through phpMyAdmin because of virtual hosting, or security on mySQL, then this script will not be able to create the db for you. This script will still be able to fill the database, and will still need to be run.');
define('_CONTINUE_1','Setting Your DB Preferences');
define('_CONTINUE_2','You can now set up your administrative account. If you pass on this set up, your login for the administrative account will be Admin / Password (case sensitive).  It is advisable to set it up now, and not wait until later.');
define('_DBHOST','Database Host');
define('_DBINFO','Database Information');
define('_DBNAME','Database Name');
define('_DBPASS','Database Password');
define('_DBPREFIX','Table Prefix (for Table Sharing)');
define('_DBTYPE','Database Type');
define('_DBUNAME','Database Username');
define('_DONE','Done.');
define('_FINISH_1','The Credits');
define('_FINISH_2','These are the scripts and people that make PostNuke go. Take some time and let these people know how much you appreciate their work. If you would like to be listed here, contact us about being a part of the developement team. We are always looking for some help.');
define('_FINISH_3','You are now done with the PostNuke installation. If you run into any problems, let us know.  Make sure that you delete this script. You will not need it again.');
define('_FINISH_4','Go to your PostNuke site');
define('_FOOTER_1','Thank you for trying PostNuke and welcome to our community.');
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
define('_MYPHPNUKE_1','Upgrading from MyPHPNuke 1.8.7?');
define('_MYPHPNUKE_2','Just press the <b>MyPHPNuke 1.8.7</b> button');
define('_MYPHPNUKE_3','Upgrading from MyPHPNuke 1.8.8b2?');
define('_MYPHPNUKE_4','Just press the <b>MyPHPNuke 1.8.8</b> button');
define('_NEWTABLES_1','Unable to select database. You must either create your database manually or if you have root access let the install script do it for you.');
define('_NEW_INSTALL_1','You have choosen to do a new install. Below is the information that you have entered.');
define('_NEW_INSTALL_2','If you have root access, check the <b>create the database</b> box. Otherwise, just click on start.<br>If you do not have root access you need to create the db manually and this script will then add the tables for you.');
define('_NEW_INSTALL_3','Create the Database');
define('_NO','No');
define('_NOTMADE','Unable to make ');
define('_NOTSELECT','Unable to select database.');
define('_NOTUPDATED','Unable to update ');
define('_PHPNUKE_1','Upgrading from PHP-Nuke 4.4?');
define('_PHPNUKE_2','Please read the following note, and press the <b>PHP-Nuke 4.4</b> button when ready.<br><br> This script will leave intact your forums DB but this version will not manage the data.<i> There is an upgrade script for this forum data that is being tested. It is currently held in the pn-modules CVS</i><br><br> We do not have PHPBB included into the release, but the upgrade script is the same. It will not destroy any of your data.');
define('_PHPNUKE_3','Upgrading from PHP-Nuke 5?');
define('_PHPNUKE_4','Just press the <b>PHP-Nuke 5</b> button');
define('_PHPNUKE_5','Upgrading from PHP-Nuke 5.2?');
define('_PHPNUKE_6','Just press the <b>PHP-Nuke 5.2</b> button');
define('_PHPNUKE_7','Upgrading from PHP-Nuke 5.3?');
define('_PHPNUKE_8','Just press the <b>PHP-Nuke 5.3</b> button');
define('_PHPNUKE_9','Upgrading from PHP-Nuke 5.3.1?');
define('_PHPNUKE_10','Just press the <b>PHP-Nuke 5.3.1</b> button');
define('_PHPNUKE_11','Upgrading from PHP-Nuke 5.4?');
define('_PHPNUKE_12','Just press the <b>PHP-Nuke 5.4</b> button');
define('_PHP_CHECK_1','Your PHP version is ');
define('_PHP_CHECK_2','You need to upgrade PHP to at least 4.0.1 - <a href=\'http://www.php.net\'>http://www.php.net</a>');
define('_PHP_CHECK_3','Not Good! magic_quotes_gpc is Off.<br>This can often be fixed using a .htaccess file with the following line:<br>php_flag magic_quotes_gpc On');
define('_PHP_CHECK_4','Not Good! magic_quotes_runtime is On.<br>This can often be fixed using a .htaccess file with the following line:<br>php_flag magic_quotes_runtime Off');
define('_PN6_1','Admin: You Will Need To Re-Save Your Website Settings In The Admin Page ASAP!');
define('_PN6_2','(We Are Sorry For This Inconvience)');
define('_PN6_3','ERROR: File not found: ');
define('_PN6_4','Done converting old-style button blocks.');
define('_POSTNUKE_1','Upgrading from PostNuke .5x?');
define('_POSTNUKE_10','Just press the <b>PostNuke .64</b> button');
define('_POSTNUKE_11','Upgrading from PostNuke .7?');
define('_POSTNUKE_12','Just press the <b>PostNuke 7</b> button');
define('_POSTNUKE_13','Validate Tables');
define('_POSTNUKE_14','This script will double check the table structure of your PostNuke Database.  Just run all portions of the script to ensure that your DB is installed correctly.  This is mainly used to keep CVS installs up to date. <b>WARNING</b> This is experimental in nature, and should only be used in either debugging situations or for developers working on CVS.');
define('_POSTNUKE_15','Validate your language system?');
define('_POSTNUKE_16','Just press the <b>Validate</b> button');
define('_POSTNUKE_17','Validate your table structure?');
define('_POSTNUKE_18','Just press the <b>Validate</b> button');
define('_POSTNUKE_2','Just press the <b>PostNuke .5</b> button');
define('_POSTNUKE_3','Upgrading from PostNuke .6 / .61?');
define('_POSTNUKE_4','Just press the <b>PostNuke .6</b> button');
define('_POSTNUKE_5','Upgrading from PostNuke .62?');
define('_POSTNUKE_6','Just press the <b>PostNuke .62</b> button');
define('_POSTNUKE_7','Upgrading from PostNuke .63?');
define('_POSTNUKE_8','Just press the <b>PostNuke .63</b> button<br>');
define('_POSTNUKE_9','Upgrading from PostNuke .64?');
define('_PWBADMATCH', 'The passwords supplied do not match.  Please go back and re-type the passwords to ensure they are the same.');
define('_SELECT_LANGUAGE_1','Select your language.');
define('_SELECT_LANGUAGE_2','Language: ');
define('_SHOW_ERROR_INFO_1','Write error</b> unable to update your \'config.php\' file<br/> You will have to modify this file yourself using a text editor.<br/> Here are the changes required:');
define('_SKIPPED','Skipped.');
define('_SUBMIT_1','Please, look over the information and make sure that it is correct.');
define('_SUBMIT_2','You have entered the following information:');
define('_SUBMIT_3','Select <b>New Install</b> or <b>Upgrade</b> to continue.');
define('_SUCCESS_1','Finished');
define('_SUCCESS_2','Your upgrade to the latest version of PostNuke is finished.<br> Remember to change your config.php settings before using for the first time.');
define('_UPDATED',' updated.');
define('_UPDATING','Updating table: ');
define('_UPGRADE_1','Upgrades');
define('_UPGRADE_2','Here is where you can select which CMS your are upgrading from.<br><br><center> Select <b>PHP-Nuke</b> to upgrade an existing PHP-Nuke install.<br> Select <b>PostNuke</b> to upgrade an existing PostNuke install.<br> Select <b>MyPHPNuke</b> to upgrade an exisitng MyPHPNuke install.');
define('_UPGRADETAKESALONGTIME','Carrying out a PostNuke upgrade can take a long time, maybe a matter of minutes.  When selecting an upgrade option please select the option only once, and wait for the next screen to appear.  Clicking on upgrade options multiple times can cause the upgrade process to fail');
define('_YES', 'Yes');
?>