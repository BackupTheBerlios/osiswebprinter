<?php
/* ----------------------------------------------------------------------
   $Id: global.php,v 1.2 2003/04/20 16:06:10 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:

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
//
// Regional Specific Date texts
//
// A little help for date manipulation, from PHP manual on function strftime():
//
// %a - abbreviated weekday name according to the current locale
// %A - full weekday name according to the current locale
// %b - abbreviated month name according to the current locale
// %B - full month name according to the current locale
// %c - preferred date and time representation for the current locale
// %C - century number (the year divided by 100 and truncated to an integer, range 00 to 99)
// %d - day of the month as a decimal number (range 01 to 31)
// %D - same as %m/%d/%y
// %e - day of the month as a decimal number, a single digit is preceded by a space
//      (range ' 1' to '31')
// %h - same as %b
// %H - hour as a decimal number using a 24-hour clock (range 00 to 23)
// %I - hour as a decimal number using a 12-hour clock (range 01 to 12)
// %j - day of the year as a decimal number (range 001 to 366)
// %m - month as a decimal number (range 01 to 12)
// %M - minute as a decimal number
// %n - newline character
// %p - either `am' or `pm' according to the given time value, or the corresponding strings for
//      the current locale
// %r - time in a.m. and p.m. notation
// %R - time in 24 hour notation
// %S - second as a decimal number
// %t - tab character
// %T - current time, equal to %H:%M:%S
// %u - weekday as a decimal number [1,7], with 1 representing Monday
// %U - week number of the current year as a decimal number, starting with the first Sunday as
//      the first day of the first week
// %V - The ISO 8601:1988 week number of the current year as a decimal number, range 01 to 53,
//      where week 1 is the first week that has at least 4 days in the current year, and with
//      Monday as the first day of the week.
// %W - week number of the current year as a decimal number, starting with the first Monday as
//      the first day of the first week
// %w - day of the week as a decimal, Sunday being 0
// %x - preferred date representation for the current locale without the time
// %X - preferred time representation for the current locale without the date
// %y - year as a decimal number without a century (range 00 to 99)
// %Y - year as a decimal number including the century
// %Z - time zone or name or abbreviation
// %% - a literal `%' character
//
// Note: _DATESTRING is used for Articles and Comments Date
//       _LINKSDATESTRING is used for Web Links creation Date
//       _DATESTRING2 is used for Older Articles box on Home
//

define('_TIMEZONES','IDLW NT HST YST PST MST CST EST AST GMT-3:30 GMT-3 AT WAT GMT CET EET BT GMT+3:30 GMT+4 GMT+4:30 GMT+5 GMT+5:30 GMT+6 WAST CCT JST ACS GST GMT+11 NZST'); 
define('_TZOFFSETS','0 1 2 3 4 5 6 7 8 8.5 9 10 11 12 13 14 15 15.5 16 16.5 17 17.5 18 19 20 21 21.5 22 23 24'); 
define('_DATEBRIEF','%b %d, %Y');
define('_DATELONG','%A, %B %d, %Y'); 
define('_DATESTRING','%A, %B %d @ %H:%M:%S %Z'); 
//define('_DATESTRING','%A, %B %d @ %H:%M:%S'); TimeZone Fix
define('_DATESTRING2','%A, %B %d');
define('_DATETIMEBRIEF','%b %d, %Y - %I:%M %p');
define('_DATETIMELONG','%A, %B %d, %Y - %I:%M %p %Z'); 
// define('_DATETIMELONG','%A, %B %d, %Y - %I:%M %p'); TimeZone Fix
define('_LINKSDATESTRING','%d-%b-%Y');
define('_TIMEBRIEF','%I:%M %p');
define('_TIMELONG','%I:%M %p %Z');
//
define('_DAY_OF_WEEK_LONG','Sunday Monday Tuesday Wednesday Thursday Friday Saturday');
define('_DAY_OF_WEEK_SHORT','Sun Mon Tue Wed Thu Fri Sat');
define('_MONTH_LONG','January February March April May June July August September October November December');
define('_MONTH_SHORT','Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec');

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