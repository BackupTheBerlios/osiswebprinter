<?php
/* ----------------------------------------------------------------------
   $Id: languages.php,v 1.4 2003/04/26 06:39:31 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: languages.php,v 1.10 2002/01/19 22:58:16 harley_vb
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

define('TITLE', 'Sprachen');
define('NAVBAR_TITLE', 'Sprachen');
define('HEADING_TITLE', 'Sprachen');

define('TABLE_HEADING_LANGUAGE_NAME', 'Name');
define('TABLE_HEADING_LANGUAGE_ISO_639_2', 'ISO 639-2');
define('TABLE_HEADING_LANGUAGE_ISO_639_1', 'ISO 639-1');
define('TABLE_HEADING_LANGUAGE_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_INFO_EDIT_INTRO', 'Bitte f&uuml;hren Sie alle notwendigen &Auml;nderungen durch');
define('TEXT_INFO_LANGUAGE_NAME', 'Name:');
define('TEXT_INFO_LANGUAGE_ISO_639_2', 'ISO 639-2:');
define('TEXT_INFO_LANGUAGE_ISO_639_1', 'ISO 639-1:');
define('TEXT_INFO_LANGUAGE_DIRECTORY', 'Verzeichnis:');
define('TEXT_INFO_LANGUAGE_SORT_ORDER', 'Sortierreihenfolge:');
define('TEXT_INFO_INSERT_INTRO', 'Bitte geben Sie die neue Sprache mit allen relevanten Daten ein');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie die Sprache l&ouml;schen m&ouml;chten?');
define('TEXT_INFO_HEADING_NEW_LANGUAGE', 'Neue Sprache');
define('TEXT_INFO_HEADING_EDIT_LANGUAGE', 'Sprache bearbeiten');
define('TEXT_INFO_HEADING_DELETE_LANGUAGE', 'Sprache l&ouml;schen');
define('TEXT_DEFAULT', 'Standardsprache');
define('TEXT_SET_DEFAULT', 'Standardsprache');
define('ERROR_REMOVE_DEFAULT_LANGUAGE', 'Fehler: Die Standardsprache darf nicht gel&ouml;scht werden. Bitte definieren Sie eine neue Standardsprache und wiederholen Sie den Vorgang.');

define('ERROR_CSV_TEMP_DIRECTORY_NOT_WRITEABLE', 'Fehler: Das CSV-Dateiverzeichnis ist schreibgesch&uuml;tzt.');
define('ERROR_CSV_TEMP_DIRECTORY_DOES_NOT_EXIST', 'Fehler: Das CSV-Dateiverzeichnis ist nicht vorhanden.');

define('IMAGE_CSV_DOWNLOAD', 'Download');
?>
