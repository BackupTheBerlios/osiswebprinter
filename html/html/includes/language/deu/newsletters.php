<?php
/* ----------------------------------------------------------------------
   $Id: newsletters.php,v 1.2 2003/04/19 05:51:10 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: newsletters.php,v 1.7 2002/03/11 14:13:05 harley_vb
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

define('HEADING_TITLE', 'Rundschreiben Verwaltung');

define('TABLE_HEADING_NEWSLETTERS', 'Rundschreiben');
define('TABLE_HEADING_SIZE', 'Gr&ouml;sse');
define('TABLE_HEADING_MODULE', 'Module');
define('TABLE_HEADING_SENT', 'Gesendet');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_NEWSLETTER_MODULE', 'Module:');
define('TEXT_NEWSLETTER_TITLE', 'Titel des Rundschreibens:');
define('TEXT_NEWSLETTER_CONTENT', 'Inhalt:');

define('TEXT_NEWSLETTER_DATE_ADDED', 'hinzugef&uuml;gt am:');
define('TEXT_NEWSLETTER_DATE_SENT', 'Datum gesendet:');

define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie dieses Rundschreiben l&ouml;schen m&ouml;chten?');

define('TEXT_PLEASE_WAIT', 'Bitte warten Sie .. eMails werden gesendet ..<br><br>Bitte unterbrechen Sie diesen Prozess nicht!');
define('TEXT_FINISHED_SENDING_EMAILS', 'eMails wurden versendet!');

define('ERROR_NEWSLETTER_TITLE', 'Fehler: Ein Titel f&uuml;r das Rundschreiben ist erforderlich.');
define('ERROR_NEWSLETTER_MODULE', 'Fehler: Das Newsletter Modul wird ben&ouml;tigt.');
define('ERROR_REMOVE_UNLOCKED_NEWSLETTER', 'Fehler: Bitte sperren Sie das Rundschreiben bevor Sie es l&ouml;schen.');
define('ERROR_EDIT_UNLOCKED_NEWSLETTER', 'Fehler: Bitte sperren Sie das Rundschreiben bevor Sie es bearbeiten.');
define('ERROR_SEND_UNLOCKED_NEWSLETTER', 'Fehler: Bitte sperren Sie das Rundschreiben bevor Sie es versenden.');
?>