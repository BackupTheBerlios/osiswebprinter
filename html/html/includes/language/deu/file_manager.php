<?php
/* ----------------------------------------------------------------------
   $Id: file_manager.php,v 1.3 2003/04/26 06:35:58 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: file_manager.php,v 1.16 2002/08/19 01:45:58 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

define('TITLE', 'Datei-Manager');
define('NAVBAR_TITLE', 'Datei-Manager');
define('HEADING_TITLE', 'Datei-Manager');

define('TABLE_HEADING_FILENAME', 'Name');
define('TABLE_HEADING_SIZE', 'Gr&ouml;sse');
define('TABLE_HEADING_PERMISSIONS', 'Zugriffsrechte');
define('TABLE_HEADING_USER', 'Benutzer');
define('TABLE_HEADING_GROUP', 'Gruppe');
define('TABLE_HEADING_LAST_MODIFIED', 'letzte &Auml;nderung');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_INFO_HEADING_UPLOAD', 'Upload');
define('TEXT_FILE_NAME', 'Dateiname:');
define('TEXT_NEW_FOLDER_NAME', 'Verzeichnisname:');
define('TEXT_FILE_SIZE', 'Gr&ouml;sse:');
define('TEXT_FILE_CONTENTS', 'Inhalt:');
define('TEXT_LAST_MODIFIED', 'letzte &Auml;nderung:');
define('TEXT_NEW_FOLDER', 'Neues Verzeichnis');
define('TEXT_NEW_FOLDER_INTRO', 'Geben Sie den Namen f&uuml;r das neue Verzeichnis ein:');
define('TEXT_DELETE_INTRO', 'Sind Sie sicher, dass Sie diese Datei l&ouml;schen m&ouml;chten?');
define('TEXT_UPLOAD_INTRO', 'Bitte die Dateien ausw&auml;hlen, welche hochgeladen werden sollen.');

define('ERROR_DIRECTORY_NOT_WRITEABLE', 'Fehler: Das Verzeichnis ist schreibgesch&uuml;tzt. Bitte korrigieren Sie die Zugriffsrechte f&uuml;r: %s');
define('ERROR_FILE_NOT_WRITEABLE', 'Fehler: Die Datei ist schreibgesch&uuml;tzt. Bitte korrigieren Sie die Zugriffsrechte f&uuml;r: %s');
define('ERROR_DIRECTORY_NOT_REMOVEABLE', 'Fehler: Das Verzeichnis kann nicht gel&ouml;scht werden. Bitte korrigieren Sie die Zugriffsrechte f&uuml;r: %s');
define('ERROR_FILE_NOT_REMOVEABLE', 'Fehler: Die Datei kann nicht gel&ouml;scht werden. Bitte korrigieren Sie die Zugriffsrechte f&uuml;r: %s');
define('ERROR_DIRECTORY_DOES_NOT_EXIST', 'Error: Directory does not exist: %s');
?>