<?php
/* ----------------------------------------------------------------------
   $Id: global.php,v 1.8 2003/05/05 16:50:29 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: german.php,v 1.93 2002/09/29 14:14:29 project3000 
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com
   
   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- 
   and Based on:   

   File: global.php,v 1.104.2.1 2002/04/03 21:11:45 jgm 
   ----------------------------------------------------------------------
   POST-NUKE Content Management System
   Copyright (C) 2001 by the Post-Nuke Development Team.
   http://www.postnuke.com/
   ----------------------------------------------------------------------
   Based on:
   Thatware - http://thatware.org/
   PHP-NUKE Web Portal System - http://phpnuke.org/
   ----------------------------------------------------------------------
   LICENSE
  
   This program is free software; you can redistribute it and/or
   modify it under the terms of the GNU General Public License (GPL)
   as published by the Free Software Foundation; either version 2
   of the License, or (at your option) any later version.
  
   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.
  
   To read the license please visit http://www.gnu.org/copyleft/gpl.html
   ----------------------------------------------------------------------
   Original Author of this file:
   Purpose of this file: core language define file - DO NOT add to this
                         file if you're module writer, etc.
   ---------------------------------------------------------------------- */
   
// on RedHat try 'de_DE'
// on FreeBSD try 'de_DE.ISO_8859-1'
// on Windows try 'de' or 'German'
setlocale(LC_TIME, 'ge');
define('DATE_SHORT', '%d.%m.%Y');  // this is used for strftime()
define('DATE_LONG', '%A, %d. %B %Y'); // this is used for strftime()

define('HTML_PARAMS','dir="LTR" lang="de"');
define('CHARSET', 'iso-8859-1');

define('DATE_FORMAT_LONG', '%A, %d. %B %Y'); 
define('DATE_FORMAT', 'd.m.Y');  // this is used for strftime()
define('PHP_DATE_TIME_FORMAT', 'd.m.Y H:i:s'); 
define('DATE_TIME_FORMAT', DATE_SHORT . ' %H:%M:%S');

define('DEVELOPER_SITE', 'Homepage');
define('SUPPORT_FORUMS', 'Foren');
define('MAILING_LISTS', 'Mailingliste');
define('FEEDBACK', 'Feedback');
define('SUPPOORT', 'Support-Zentren');
define('BUGS', 'Bug?');

define('BOX_HEADING_LOGIN', 'Login');
define('TEXT_INFO_USER_EMAIL', 'eMail Adresse:');
define('TEXT_INFO_PASSWORD', 'Passwort:');
define('BOX_CREATE_ACCOUNT', 'Neuer Anwender?');
define('BOX_PASSWORD_FORGOTTEN', 'Passwort vergessen?');

define('BOX_HEADING_ACCOUNT', 'Mein Konto');
define('BOX_ACCOUNT_LOGOFF', 'Abmelden');
define('BOX_ACCOUNT_INFO', 'Meine Daten');

define('BOX_HEADING_CONFIGURATION', 'Konfiguration');

define('BOX_HEADING_LOCALIZATION', 'L&auml;nder');
define('BOX_TAXES_COUNTRIES', 'Land');
define('BOX_TAXES_ZONES', 'Bundesl&auml;nder');

define('BOX_HEADING_LANGUAGES', 'Sprachen');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Sprachen definieren');
define('BOX_LOCALIZATION_LANGUAGES', 'Sprachen');

define('BOX_HEADING_TOOLS', 'Programme');
define('BOX_TOOLS_BACKUP', 'Datenbanksicherung');
define('BOX_TOOLS_FILE_MANAGER', 'Datei-Manager');
define('BOX_TOOLS_MAIL', 'eMail versenden');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Rundschreiben Manager');
define('BOX_TOOLS_SERVER_INFO', 'Server Info');
define('BOX_TOOLS_WHOS_ONLINE', 'Wer ist Online');

define('BOX_HEADING_ADMINISTRATORS', 'Anwender');
define('BOX_ADMINISTRATORS_SETUP', 'Zugriffsrechte');

define('CATEGORY_PERSONAL', 'Pers&ouml;nliche Daten');
define('CATEGORY_ADDRESS', 'Adresse');
define('CATEGORY_CONTACT', 'Kontakt');

define('GENDER', 'Anrede:');
define('FIRST_NAME', 'Vorname:');
define('LAST_NAME', 'Nachname:');
define('EMAIL_ADDRESS', 'E-Mail Adresse:');

define('TELEPHONE_NUMBER', 'Telefonnummer:');
define('FAX_NUMBER', 'Faxnummer:');
define('NEWSLETTER', 'Rundschreiben:');
define('NEWSLETTER_YES', 'abonniert');
define('NEWSLETTER_NO', 'nicht abonniert');
define('TEXT_SELECT', 'CTRL+Click to select multiple.');
define('PASSWORD', 'Passwort:');
define('PASSWORD_CONFIRMATION', 'Passwortbest&auml;tigung:');
define('PASSWORD_HIDDEN', '--VERSTECKT--');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administration');
define('HEADER_TITLE_SUPPORT_SITE', 'Supportseite');
define('HEADER_TITLE_ONLINE_CATALOG', 'Online Katalog');
define('HEADER_TITLE_ADMINISTRATION', 'Administration');

// text for gender
define('MALE', 'Herr');
define('FEMALE', 'Frau');


// configuration box text in includes/boxes/configuration.php

define('BOX_CONFIGURATION_MYSTORE', 'My Store');
define('BOX_CONFIGURATION_LOGGING', 'Logging');
define('BOX_CONFIGURATION_CACHE', 'Cache');

// javascript messages
define('JS_ERROR', 'Notwendige Angaben fehlen!\nBitte richtig ausfüllen.\n\n');

define('JS_REVIEW_TEXT', '* Der Text muss mindestens aus ' . REVIEW_TEXT_MIN_LENGTH . ' Buchstaben bestehen.\n');
define('JS_REVIEW_RATING', '* Geben Sie Ihre Bewertung ein.\n');

define('JS_GENDER', '* Anredeform festlegen.\n');
define('JS_FIRST_NAME', '* Der \'Vornname\' muss mindestens aus ' . FIRST_NAME_MIN_LENGTH . ' Buchstaben bestehen.\n');
define('JS_LAST_NAME', '* Der \'Nachname\' muss mindestens aus ' . LAST_NAME_MIN_LENGTH . ' Buchstaben bestehen.\n');
define('JS_DOB', '* Die \'Geburtsdaten\' im Format xx.xx.xxxx (Tag.Monat.Jahr) eingeben.\n');
define('JS_EMAIL_ADDRESS', '* Die \'eMail-Adresse\' muss mindestens aus ' . EMAIL_ADDRESS_MIN_LENGTH . ' Buchstaben bestehen.\n');
define('JS_ADDRESS', '* Die \'Strasse/Nr.\' muss mindestens aus ' . STREET_ADDRESS_MIN_LENGTH . ' Buchstaben bestehen.\n');
define('JS_POST_CODE', '* Die \'Postleitzahl\' muss mindestens aus ' . POSTCODE_MIN_LENGTH . ' Buchstaben bestehen.\n');
define('JS_CITY', '* Die \'Stadt\' muss mindestens aus ' . CITY_MIN_LENGTH . ' Buchstaben bestehen.\n');
define('JS_STATE', '* Das \'Bundesland\' muss ausgewählt werden.\n');
define('JS_STATE_SELECT', '-wählen sie oberhalb-');
define('JS_ZONE', ' * Das Bundesland muss aus der Liste für dieses Land ausgewählt werden.\n');
define('JS_COUNTRY', '* Das \'Land\' muss ausgewählt werden.\n');
define('JS_TELEPHONE', '* Die \'Telefonnummer\' muss mindestens aus ' . TELEPHONE_MIN_LENGTH . ' Zahlen bestehen.\n');
define('JS_PASSWORD', '* Das \'Passwort\' und die \'Bestätigung\' müssen übereinstimmen und mindestens ' . PASSWORD_MIN_LENGTH . ' Buchstaben enthalten.\n');


// images
define('IMAGE_ANI_SEND_EMAIL', 'eMail versenden');
define('IMAGE_BACK', 'Zur&uuml;ck');
define('IMAGE_BACKUP', 'Datensicherung');
define('IMAGE_CANCEL', 'Abbruch');
define('IMAGE_CONFIRM', 'Best&auml;tigen');
define('IMAGE_COPY', 'Kopieren');
define('IMAGE_COPY_TO', 'Kopieren nach');
define('IMAGE_DEFINE', 'Definieren');
define('IMAGE_DELETE', 'L&ouml;schen');
define('IMAGE_EDIT', 'Bearbeiten');
define('IMAGE_EMAIL', 'eMail versenden');
define('IMAGE_FILE_MANAGER', 'Datei-Manager');
define('IMAGE_ICON_STATUS_GREEN', 'aktiv');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'aktivieren');
define('IMAGE_ICON_STATUS_RED', 'inaktiv');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'deaktivieren');
define('IMAGE_ICON_INFO', 'Information');
define('IMAGE_INSERT', 'Einf&uuml;gen');
define('IMAGE_LOCK', 'Sperren');
define('IMAGE_MOVE', 'Verschieben');
define('IMAGE_NEW_BANNER', 'neuen Banner aufnehmen');
define('IMAGE_NEW_CATEGORY', 'neue Kategorie erstellen');
define('IMAGE_NEW_COUNTRY', 'neues Land aufnehmen');
define('IMAGE_NEW_CURRENCY', 'neue W&auml;hrung einf&uuml;gen');
define('IMAGE_NEW_FILE', 'Neue Datei');
define('IMAGE_NEW_FOLDER', 'Neues Verzeichnis');
define('IMAGE_NEW_LANGUAGE', 'neue Sprache anlegen');
define('IMAGE_NEW_NEWSLETTER', 'Neues Rundschreiben');
define('IMAGE_NEW_PRODUCT', 'neuen Artikel aufnehmen');
define('IMAGE_NEW_TAX_CLASS', 'neue Steuerklasse erstellen');
define('IMAGE_NEW_TAX_RATE', 'neuen Steuersatz anlegen');
define('IMAGE_NEW_TAX_ZONE', 'neue Steuerzone erstellen');
define('IMAGE_NEW_ZONE', 'neues Bundesland einf&uuml;gen');
define('IMAGE_ORDERS', 'Bestellungen');
define('IMAGE_ORDERS_INVOICE', 'Invoice');
define('IMAGE_ORDERS_PACKINGSLIP', 'Packing Slip');
define('IMAGE_PREVIEW', 'Vorschau');
define('IMAGE_RESET', 'Zur&uuml;cksetzen');
define('IMAGE_RESTORE', 'Zur&uuml;cksichern');
define('IMAGE_SAVE', 'Speichern');
define('IMAGE_SEARCH', 'Suchen');
define('IMAGE_SELECT', 'Ausw&auml;hlen');
define('IMAGE_SEND', 'Versenden');
define('IMAGE_UNLOCK', 'Entsperren');
define('IMAGE_UPDATE', 'Aktualisieren');
define('IMAGE_UPDATE_CURRENCIES', 'Wechselkurs aktualisieren');
define('IMAGE_UPLOAD', 'Hochladen');

define('ICON_CROSS', 'Falsch');
define('ICON_CURRENT_FOLDER', 'aktueller Ordner');
define('ICON_DELETE', 'L&ouml;schen');
define('ICON_ERROR', 'Fehler');
define('ICON_FILE', 'Datei');
define('ICON_FILE_DOWNLOAD', 'Herunterladen');
define('ICON_FOLDER', 'Ordner');
define('ICON_LOCKED', 'Gesperrt');
define('ICON_PREVIOUS_LEVEL', 'Vorherige Ebene');
define('ICON_PREVIEW', 'Vorschau');
define('ICON_STATISTICS', 'Statistics');
define('ICON_SUCCESS', 'Erfolg');
define('ICON_TICK', 'Wahr');
define('ICON_UNLOCKED', 'Entsperrt');
define('ICON_WARNING', 'Warnung');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Seite %s von %d');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* erforderlich</span>');
?>
