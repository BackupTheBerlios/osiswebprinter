<?php
/* ----------------------------------------------------------------------
   $Id: global.php,v 1.7 2003/05/03 15:58:30 r23 Exp $

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
define('BOX_PASSWORD_FORGOTTEN', 'Passwort vergessen?');

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

define('_ABOUTPOSTING','About posting');
define('_ACCESS_ADD','Add');
define('_ACCESS_ADMIN','Admin');
define('_ACCESS_COMMENT','Comment');
define('_ACCESS_DELETE','Delete');
define('_ACCESS_EDIT','Edit');
define('_ACCESS_MODERATE','Moderate');
define('_ACCESS_NONE','None');
define('_ACCESS_OVERVIEW','Overview');
define('_ACCESS_READ','Read');
define('_ADMIN_MESSAGES','Admin Messages');
define('_AIM','AIM number');
define('_ALL','All');
define('_ALLAUTHORS','All authors');
define('_ALLOWEDHTML','Allowed HTML:');
define('_ALLOWEMAILVIEW','Allow other users to view my e-mail address');
define('_ALLREGCANPOST','');
define('_ALLTOPICS','All topics');
define('_ARTICLES','Articles');
define('_AT','at');
define('_ATTACHART','Attached to article');
define('_AUTOMATEDARTICLES','Programmed articles');
define('_AVAILABLEAVATARS','Available avatar\'s list');
define('_AVATAR','Avatar');
define('_BADAUTHKEY','No authorisation to carry out operation');
define('_BANNERS','Banners');
define('_BY','by');
define('_CANCEL','Cancel');
define('_CANCELREPLY','Cancel reply');
define('_CANCELSEND','Cancel send');
define('_CHARLONG','characters long');
define('_CHARSET','ISO-8859-1');
define('_CHECKALL','Check all');
define('_CHECKTHISOPTION','(Check this option and the following text will appear on the homepage)');
define('_CLEAR','Clear');
define('_CLICK','Please click ');
define('_COMESFROM','This article comes from');
define('_COMMENT','Comment');
define('_COMMENTS','Comments');
define('_COMMENTSWARNING','Comments are owned by the poster. We aren\'t responsible for their content.');
define('_CONFIGURE','Configure');
define('_CONTRIBUTEDBY','Contributed by');
define('_COOKIEWARNING','NOTICE: Account preferences are cookie based.');
define('_CURRENTPOLL','Current Poll');
define('_DATE','Date');
define('_DELETE','Delete');
define('_DISPLAYMODE','Display mode');
define('_DUPLICATE','Duplicate. Did you submit twice?');
define('_EDIT','Edit');
define('_EDITARTICLE','Edit Article');
define('_EMAIL','E-mail');
define('_EMAILNOTPUBLIC','(This e-mail will not be public but is required.  It will be used to send your password if you lose it)');
define('_EMAILPUBLIC','(This e-mail will be public. Type what you\'d like. Spam proof)');
define('_EMAILREGISTERED','ERROR: E-mail address already registered');
define('_EXPIREIN','Expiration in');
define('_EXPIRELESSHOUR','EXPIRATION: Less than 1 hour');
define('_EXTRANS','Extrans (html tags to text)');
define('_FLAT','Flat');
define('_FOLLOWINGMEM','The following is the member information:');
define('_FRIEND','Send this story to a friend');
define('_FROM','From');
define('_GOBACK','[ <a href=\'javascript:history.go(-1)\'>Back</a> ]');
define('_GROUPS','Groups');
define('_HASREQUESTED','has just requested that a password be sent.');
define('_HASTHISEMAIL','has this e-mail associated with it.');
define('_HELLO','Hello');
define('_HERE','here');
define('_HIDDESCORES','(Hide scores: They still apply, you just don\'t see them.)');
define('_HIGHEST','Highest scores first');
define('_HOMECONFIG','Homepage configuration');
define('_HOURS','Hours');
define('_HTML','HTML');
define('_HTMLDISSABLE','Disable HTML on this post');
define('_HTMLFORMATED','HTML formated');
define('_ICQ','ICQ number');
define('_INDEX','Index');
define('_INSECTION','Article in the section');
define('_INTERESTS','Interests');
define('_LAST','Last');
define('_LIST','List');
define('_LOCATION','Location');
define('_LOGIN','Login');
define('_LOGINCREATE','Login/Create an account');
define('_LOGININCOR','Incorrect login. Please try again...');
define('_LOGINSITE','Login.');
define('_LOGOUT','Logout');
define('_LOGOUTEXIT','Logout/Exit');
define('_MAILED','mailed.');
define('_MAX127','(max. 127):');
define('_MODARGSERROR','Bad arguments for API function');
define('_DBSELECTERROR','Database select error');
define('_DBUPDATEERROR','Database update error');
define('_DBINSERTERROR','Database insert error');
define('_DBDELETEERROR','Database delete error');
define('_DBCREATETABLEERROR','Database create table error');
define('_MONTH','Month');
define('_MONTHS','Months');
define('_MOREABOUT','More about');
define('_MOSTREAD','Most read story in');
define('_MPROBLEM','A Problem occurred!');
define('_MSNM','MSNM number');
define('_MVIEWADMIN','VIEW: Administrators only');
define('_MVIEWALL','VIEW: All visitors');
define('_MVIEWANON','VIEW: Anonymous users only');
define('_MVIEWUSERS','VIEW: Registered users only');
define('_MYEMAIL','My e-mail:');
define('_MYHOMEPAGE','My homepage:');
define('_NAME','Name');
define('_NAMERESERVED','ERROR: This username is reserved');
define('_NESTED','Nested');
define('_NEWEST','Newest first');
define('_NEWSBY','News by');
define('_NEWSINHOME','Number of stories on homepage');
define('_NEXTMATCHES','next matches');
define('_NICKNAME','Username');
define('_NO','No');
define('_NOAUTOARTICLES','There are no programmed articles');
define('_NOCOMMENTS','No comments');
define('_NOFUNCTIONS','---------');
define('_NOMATCHES','No matches found to your query');
define('_NONAME','No name entered');
define('_NOSCORES','Do not display scores');
define('_NOSUBJECT','No subject');
define('_NOTE','Note:');
define('_NOTREAD','Not read');
define('_NOTRIGHT','Something is not right with passing a variable to this function. This message is just to keep things from messing up down the road');
define('_OCCUPATION','Occupation');
define('_OFF','off');
define('_OK','OK');
define('_OLDEST','Oldest first');
define('_ON','on');
define('_ONN','on...');
define('_OPTION','Option');
define('_OPTIONAL','(optional)');
define('_OPTIONS','Options');
define('_PAGE','Page');
define('_PAGES','Pages');
define('_PARENT','Parent');
define('_PASSWORD','Password');
define('_PERMISSIONS','Permissions');
define('_PLAINTEXT','Plain Old Text');
define('_POSTANON','Post anonymously');
define('_POSTEDBY','Posted by');
if (!defined('_POSTEDON')) {
    define('_POSTEDON','Posted on');
}
define('_PREVIEW','Preview');
define('_PREVMATCHES','previous matches');
define('_PRINTER','Printer friendly page');
define('_PROFILE','Profile');
define('_QOTDNQ','No quotes found');
define('_RE','Re');
define('_READREST','Read the rest of this comment...');
define('_READS','Reads');
define('_READSTORIES','most read stories');
define('_REFERERS','Site Popularity');
define('_REFRESH','Refresh');
define('_REGISTER','Register.');
define('_REGISTERNOW','Register now! It\'s free!');
define('_REGISTRATION','registration area.');
define('_RELATED','Related links');
define('_REMOVECOMMENTS','Delete comments');
define('_REPLIES','Replies to this');
define('_REPLY','Reply to this');
define('_REPLYMAIN','Post comment');
define('_REQUIRED','(required)');
define('_RETURN','to return to the main page.');
define('_REVIEWS','Reviews');
define('_REVIEWSCORE','Score for this review');
define('_ROOT','Root');
define('_SAVECHANGES','Save Changes');
define('_SCORE','Score:');
define('_SCORENOTE','Anonymous posts start at 0, logged in posts start at 1. Moderators add and subtract points.');
define('_SEARCH','Search');
define('_SECTIONS','Sections');
define('_SELECTOPTION','Please select an option from the menu below:');
define('_SELECTTOPIC','Select topic');
define('_SENDAMSG','Send a Message');
define('_SENT','Sent');
define('_SETTINGS','Site Settings');
define('_SIGNATURE','Signature');
define('_SOMETHINGWRONG','Something screwed up... don\'t you hate that?');
define('_SORRY','Sorry.');
define('_SORTORDER','Sort order');
define('_STORIES','Stories');
define('_STORYID','Story ID');
define('_SUBJECT','Subject');
define('_SUBMIT','Submit');
define('_SURETODELCOMMENTS','Are you sure you want to delete the selected comment and all its replies?');
define('_THEURL','The URL for this story is:');
define('_THREAD','Thread');
define('_THRESHOLD','Threshold');
define('_TO','To');
define('_TOPIC','Topic');
define('_TRUNCATES','(Truncates long comments, and adds a \'Read More\' link. Set really big to disable)');
define('_UNLIMITED','Unlimited');
define('_URL','URL');
define('_USERINFO','User info');
define('_USERS','Users');
define('_WEBSITE','Website');
define('_WEB_LINKS','Web Links');
define('_WEEK','Week');
define('_WEEKS','Weeks');
define('_WELCOMETO','Welcome to');
define('_WITHTHISCODE','With this code you can now create a new password at');
define('_WRITES','writes');
define('_WROTE','wrote');
define('_YES','Yes');
define('_YOUARELOGGEDOUT','You are now logged out!');
define('_YOUCANUSEHTML','(You can use HTML code for links as an example)');



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

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Kunden');
define('BOX_CUSTOMERS_CUSTOMERS', 'Kunden');
define('BOX_CUSTOMERS_ORDERS', 'Bestellungen');




// localizaion box text in includes/boxes/localization.php


// javascript messages
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
