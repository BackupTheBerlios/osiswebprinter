<?php
/* ----------------------------------------------------------------------
   $Id: zones.php,v 1.6 2003/05/02 09:50:50 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: zones.php,v 1.6 2002/01/28 00:22:42 harley_vb
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

define('HEADING_TITLE', 'Bundesl&auml;nder');
define('TITLE', 'Bundesl&auml;nder');
define('NAVBAR_TITLE', 'Bundesl&auml;nder');
define('HEADING_TITLE', 'Bundesl&auml;nder');

define('TABLE_HEADING_COUNTRY_NAME', 'Land');
define('TABLE_HEADING_ZONE_NAME', 'Bundesland');
define('TABLE_HEADING_ZONE_CODE', 'Code');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_INFO_EDIT_INTRO', 'Bitte f&uuml;hren Sie alle notwendigen &Auml;nderungen durch');
define('TEXT_INFO_ZONES_NAME', 'Name des Bundeslandes:');
define('TEXT_INFO_ZONES_CODE', 'Code des Bundeslandes:');
define('TEXT_INFO_COUNTRY_NAME', 'Land:');
define('TEXT_INFO_INSERT_INTRO', 'Bitte geben Sie das neue Bundesland mit allen relevanten Daten ein');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie dieses Bundesland l&ouml;schen wollen?');
define('TEXT_INFO_HEADING_NEW_ZONE', 'neues Bundesland');
define('TEXT_INFO_HEADING_EDIT_ZONE', 'Bundesland bearbeiten');
define('TEXT_INFO_HEADING_DELETE_ZONE', 'Bundesland l&ouml;schen');

define('EMAIL_ZONES_CVS', 'Bundesländer im CSV-Format: ');
define('EMAIL_GREET_MR', 'Sehr geehrter Herr ');
define('EMAIL_GREET_MS', 'Sehr geehrte Frau ');

define('EMAIL_CVS_INTRO', 'In der Anlage erhalten Sie die Bundesländer in einer CSV Datei: ');
define('EMAIL_FTP_INFO', 'Name der Datei auf dem Server:');
define('EMAIL_FOOT', 'Mit den besten Grüssen,' . "\n" .  OWP_NAME . "\n\n\n" . OWP_HTTP_SERVER . '/' . "\n\n");

define('SUCCESS_CVS_ZONES_SENT', 'Hinweis: eMail mit der CSV-Datei wurde versendet an: %s');
define('ERROR_CSV_TEMP_DIRECTORY_NOT_WRITEABLE', 'Fehler: Das CSV-Dateiverzeichnis ist schreibgesch&uuml;tzt.');
define('ERROR_CSV_TEMP_DIRECTORY_DOES_NOT_EXIST', 'Fehler: Das CSV-Dateiverzeichnis ist nicht vorhanden.');

define('IMAGE_CSV_DOWNLOAD', 'Download');

define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bundesl&auml;ndern)');

?>