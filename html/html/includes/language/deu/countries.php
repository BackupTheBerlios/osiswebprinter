<?php
/* ----------------------------------------------------------------------
   $Id: countries.php,v 1.3 2003/04/30 15:29:12 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: countries.php,v 1.8 2002/01/19 23:00:00 harley_vb
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

define('TITLE', 'L&auml;nder');
define('NAVBAR_TITLE', 'L&auml;nder');
define('HEADING_TITLE', 'L&auml;nder');

define('TABLE_HEADING_COUNTRY_NAME', 'Land');
define('TABLE_HEADING_COUNTRY_CODES', 'ISO Codes');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_INFO_EDIT_INTRO', 'Bitte f&uuml;hren Sie alle notwendigen &Auml;nderungen durch');
define('TEXT_INFO_COUNTRY_NAME', 'Name:');
define('TEXT_INFO_COUNTRY_CODE_2', 'ISO Code (2):');
define('TEXT_INFO_COUNTRY_CODE_3', 'ISO Code (3):');
define('TEXT_INFO_ADDRESS_FORMAT', 'Adressformat:');
define('TEXT_INFO_INSERT_INTRO', 'Bitte geben Sie das neue Land mit allen relevanten Daten ein');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie das Land l&ouml;schen m&ouml;chten?');
define('TEXT_INFO_HEADING_NEW_COUNTRY', 'neues Land');
define('TEXT_INFO_HEADING_EDIT_COUNTRY', 'Land bearbeiten');
define('TEXT_INFO_HEADING_DELETE_COUNTRY', 'Land l&ouml;schen');

define('EMAIL_COUNTRIES_CVS', 'Länder im CSV-Format: ');
define('EMAIL_GREET_MR', 'Sehr geehrter Herr ');
define('EMAIL_GREET_MS', 'Sehr geehrte Frau ');

define('EMAIL_CVS_INTRO', 'In der Anlage erhalten Sie die Länder in einer CSV Datei:');
define('EMAIL_FTP_INFO', 'Name der Datei auf dem Server:');
define('EMAIL_FOOT', 'Mit den besten Grüssen,' . "\n" .  OWP_NAME . "\n\n\n" . OWP_HTTP_SERVER . '/' . "\n\n");

define('SUCCESS_CVS_COUNTRIES_SENT', 'Hinweis: eMail mit der CSV-Datei wurde versendet an: %s');

define('ERROR_CSV_TEMP_DIRECTORY_NOT_WRITEABLE', 'Fehler: Das CSV-Dateiverzeichnis ist schreibgesch&uuml;tzt.');
define('ERROR_CSV_TEMP_DIRECTORY_DOES_NOT_EXIST', 'Fehler: Das CSV-Dateiverzeichnis ist nicht vorhanden.');

define('IMAGE_CSV_DOWNLOAD', 'Download');
?>