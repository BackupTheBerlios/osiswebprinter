<?php
/* ----------------------------------------------------------------------
   $Id: newdata.php,v 1.2 2003/03/28 02:06:47 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: newdata.php,v 1.73.2.4 2002/05/14 18:18:05 byronmhome 
   ----------------------------------------------------------------------
   POST-NUKE Content Management System
   Copyright (C) 2001 by the Post-Nuke Development Team.
   http://www.postnuke.com/
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

$result = $dbconn->Execute("INSERT INTO ".$prefix."_blocks VALUES (1,'menu','Main Menu',
'style:=1\ndisplaymodules:=0\ndisplaywaiting:=0\ncontent:=index.php|Home|Back to the home page.LINESPLITuser.php|My Account|Administer your personal account.LINESPLITadmin.php|Administration|Administer your PostNuked site.LINESPLITuser.php?module=NS-User&op=logout|Logout|Logout of your account.LINESPLIT|Modules|LINESPLIT[AvantGo]|AvantGo|Stories formatted for PDAs.LINESPLIT[Downloads]|Downloads|Find downloads listed on this website.LINESPLIT[FAQ]|FAQ|Frequently Asked QuestionsLINESPLIT[Members_List]|Members List|Listing of registered users on this site.LINESPLIT[News]|News|Latest News on this site.LINESPLIT[Recommend_Us]|Recommend Us|Recommend this website to a friend.LINESPLIT[Reviews]|Reviews|Reviews Section on this website.LINESPLIT[Search]|Search|Search our website.LINESPLIT[Sections]|Sections|Other content on this website.LINESPLIT[Stats]|Stats|Detailed traffic statistics.LINESPLIT[Submit_News]|Submit News|Submit an article.LINESPLIT[Topics]|Topics|Listing of news topics on this website.LINESPLIT[Top_List]|Top List|Top 10list.LINESPLIT[Web_Links]|Web Links|Links to other sites.','',0, 'l','1.0',1,'',20011122090726,'')")
or die ("<b>"._NOTUPDATED.$prefix."_blocks</font>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_blocks VALUES ( '2', 'menu', 'Incoming', 'style:=1\ndisplaymodules:=0\ndisplaywaiting:=1\ncontent:=', '', 0, 'l', '2.0', '1', '0', '00000000000000', '')") or die ("<b>"._NOTUPDATED.$prefix."_blocks</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_blocks VALUES ( '3', 'online', 'Who\'s Online', '', '', 0, 'l', '3.0', '1', '0', '00000000000000', '')") or die ("<b>Unable to update ".$prefix."_blocks</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_blocks VALUES ( '4', 'stories', 'Other Stories', 'type:=1
topic:=-1
category:=-1
limit:=10', '', 0, 'r', '1.0', '1', '0', '00000000000000', '')") or die ("<b>"._NOTUPDATED.$prefix."_blocks</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_blocks VALUES ( '5', 'user', 'Users Block', 'Put anything you want here', '', 0, 'l', '3.5', '1', '0', '00000000000000', '')") or die ("<b>"._NOTUPDATED.$prefix."_blocks</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_blocks VALUES ( '6', 'search', 'Search Box', '', '', 0, 'l', '4.0', '0', '0', '00000000000000', '')") or die ("<b>"._NOTUPDATED.$prefix."_blocks</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_blocks VALUES ( '7', 'ephem', 'Ephemerids', '', '', 0, 'l', '5.0', '0', '0', '00000000000000', '')") or die ("<b>"._NOTUPDATED.$prefix."_blocks</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_blocks VALUES ( '8', 'thelang', 'Languages', '', '', 0, 'l', '6.0', '1', '0', '00000000000000', '')") or die ("<b>"._NOTUPDATED.$prefix."_blocks</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_blocks VALUES ( '9', 'category', 'Categories Menu', '', '', 0, 'r', '1.5', '1', '0', '00000000000000', '')") or die ("<b>"._NOTUPDATED.$prefix."_blocks</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_blocks VALUES ( '10', 'random', 'Random Headlines', '', '', 0, 'r', '2.0', '0', '0', '00000000000000', '')") or die ("<b>"._NOTUPDATED.$prefix."_blocks</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_blocks VALUES ( '11', 'poll', 'Poll', '', '', 0, 'r', '3.0', '1', '0', '00000000000000', '')") or die ("<b>"._NOTUPDATED.$prefix."_blocks</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_blocks VALUES ( '12', 'big', 'Today\'s Big Story', '', '', 0, 'r', '4.0', '1', '0', '00000000000000', '')") or die ("<b>"._NOTUPDATED.$prefix."_blocks</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_blocks VALUES ( '13', 'login', 'User\'s Login', '', '', 0, 'r', '5.0', '1', '0', '00000000000000', '')") or die ("<b>"._NOTUPDATED.$prefix."_blocks</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_blocks VALUES ( '14', 'past', 'Past Articles', '', '', 0, 'r', '6.0', '1', '0', '00000000000000', '')") or die ("<b>"._NOTUPDATED.$prefix."_blocks</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_blocks VALUES ( '15', 'messages', 'Administration Messages', '', '', 8, 'c', '1.0', '1', '0', '00000000000000', '')") or die ("<b>"._NOTUPDATED.$prefix."_blocks</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_blocks VALUES ( '16', 'html', 'Reminder', 'Please remember to remove the following files from your PostNuke directory
<p>
&middot;<b>install.php</b> file
<p>
&middot;<b>install</b> directory
<p>
If you do not remove these files then users can obtain the password to your database!', '', 0, 'l', '0.5', '1', '0', '00000000000000', '')") or die ("<b>"._NOTUPDATED.$prefix."_blocks</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_blocks VALUES ( '17', 'phplive', 'Live support', 'company:=Demo
id:=3', '', 0, 'l', '6.0', '0', '0', '00000000000000', '')") or die ("<b>"._NOTUPDATED.$prefix."_blocks</b>");
echo "<br><font class=\"pn-sub\">".$prefix."_blocks"._UPDATED."</font>";

$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('total','hits',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('browser','Lynx',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('browser','MSIE',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('browser','Opera',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('browser','Konqueror',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('browser','Netscape',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('browser','Bot',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('browser','Other',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('os','Windows',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('os','Linux',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('os','Mac',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('os','FreeBSD',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('os','SunOS',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('os','IRIX',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('os','BeOS',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('os','OS/2',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('os','AIX',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_counter VALUES ('os','Other',0)") or die ("<b>"._NOTUPDATED.$prefix."_counter</b>");

echo "<br><font class=\"pn-sub\">".$prefix."_counter"._UPDATED."</font>";


$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (1,'PostNuke',NULL,NULL,'','http://postnuke.com/backend.php',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (2,'LinuxCentral',NULL,NULL,'','http://linuxcentral.com/backend/lcnew.rdf',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (3,'Slashdot',NULL,NULL,'','http://slashdot.org/slashdot.rdf',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (4,'NewsForge',NULL,NULL,'','http://www.newsforge.com/newsforge.rdf',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (5,'PHPBuilder',NULL,NULL,'','http://phpbuilder.com/rss_feed.php',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (6,'Linux.com',NULL,NULL,'','http://linux.com/mrn/front_page.rss',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (7,'Freshmeat',NULL,NULL,'','http://freshmeat.net/backend/fm.rdf',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (9,'LinuxWeeklyNews',NULL,NULL,'','http://lwn.net/headlines/rss',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (11,'Segfault',NULL,NULL,'','http://segfault.org/stories.xml',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (13,'KDE',NULL,NULL,'','http://www.kde.org/news/kdenews.rdf',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (14,'Perl.com',NULL,NULL,'','http://www.perl.com/pace/perlnews.rdf',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (17,'MozillaNewsBot',NULL,NULL,'','http://www.mozilla.org/newsbot/newsbot.rdf',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (21,'SciFi-News',NULL,NULL,'','http://www.technopagan.org/sf-news/rdf.php',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (26,'DrDobbsTechNetCast',NULL,NULL,'','http://www.technetcast.com/tnc_headlines.rdf',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (27,'RivaExtreme',NULL,NULL,'','http://rivaextreme.com/ssi/rivaextreme.rdf.cdf',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (29,'PBSOnline',NULL,NULL,'','http://cgi.pbs.org/cgi-registry/featuresrdf.pl',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (30,'Listology',NULL,NULL,'','http://listology.com/recent.rdf',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (33,'exoScience',NULL,NULL,'','http://www.exosci.com/exosci.rdf',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (39,'DailyDaemonNews',NULL,NULL,'','http://daily.daemonnews.org/ddn.rdf.php3',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (40,'PerlMonks',NULL,NULL,'','http://www.perlmonks.org/headlines.rdf',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (42,'BSDToday',NULL,NULL,'','http://www.bsdtoday.com/backend/bt.rdf',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (45,'HotWired',NULL,NULL,'','http://www.hotwired.com/webmonkey/meta/headlines.rdf',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_headlines VALUES (52,'SolarisCentral',NULL,NULL,'','http://www.SolarisCentral.org/news/SolarisCentral.rdf',10,'','')") or die ("<b>"._NOTUPDATED.$prefix."_headlines</b>");

echo "<br><font class=\"pn-sub\">".$prefix."_headlines"._UPDATED."</font>";

$result = $dbconn->Execute("INSERT INTO ".$prefix."_message VALUES ( '1', 'Welcome to PostNuke, the =-Rogue-= release (0.71)', '<a target=\"_blank\" href=\"http://www.postnuke.com\">PostNuke</a> is a weblog/Content Management System (CMS).  Whilst <a target=\"_blank\" href=\"http://www.postnuke.com\"> PostNuke</a> is a fork of <a target=\"_blank\" href=\"http://www.phpnuke.org\">PHP-Nuke</a>, the entire core of the product has been replaced, making it far more secure and stable, and able to work in  high-volume environments with ease.
<br />
<br />
 Some of the highlights of PostNuke are
 <ul />
 <li /> customisation of all aspects of the website\'s appearance through themes, including CSS support
 <li /> the ability to specify items as being suitable for either a single or all languages
 <li /> the best guarantee of displaying your webpages on all browsers due to HTML 4.01 transitional compliance
 <li /> a standard API and extensive documentation to allow for easy creation of extended functionality through modules and blocks
 </ul>
 <br />
 <br />
 Please look at the <a target=\"_blank\" href=\"http://docs.postnuke.com/modules.php?op=modload&name=Wiki&file=index&pagename=0.71FAQ\">PostNuke 0.71 support page</a> if you have any problems with this version, most common support issues will be listed here, complete with solutions.
 <br />
 <br />
 <a target=\"_blank\" href=\"http://www.postnuke.com\">PostNuke</a> has a very active developer and support community at <a target=\"_blank\" href=\"http://www.postnuke.com\">www.postnuke.com</a>.<br><br>We hope you will enjoy
 using PostNuke.<br /><br /><i>The PostNuke development team</i>', '993373194', '0', '1', '1', '')") or die ("<b>"._NOTUPDATED.$prefix."_message</font>");

echo "<br><font class=\"pn-sub\">".$prefix."_message"._UPDATED."</font>";

// Default theme selection

    $themesel = rand(1 , 4);
    if ($themesel == 1){
        $truetheme = 's:8:\"PostNuke\";';
    }
    if ($themesel == 2){
        $truetheme = 's:12:\"PostNukeBlue\";';
    }
    if ($themesel == 3){
        $truetheme = 's:14:\"PostNukeSilver\";';
    }
    if ($themesel == 4){
        $truetheme = 's:9:\"SeaBreeze\";';
    }

$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('1', '/PNConfig','debug','i:0;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('2', '/PNConfig','sitename','s:14:\"Your Site Name\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('3', '/PNConfig','site_logo','s:8:\"logo.gif\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('4', '/PNConfig','slogan','s:16:\"Your slogan here\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('5', '/PNConfig','metakeywords','s:218:\"nuke, postnuke, postnuke, free, community, php, portal, opensource, open source, gpl, mysql, sql, database, web site, website, weblog, content management, contentmanagement, web content management, webcontentmanagement\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('6', '/PNConfig','dyn_keywords','i:0;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('7', '/PNConfig','startdate','s:9:\"June 2001\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('8', '/PNConfig','adminmail','s:13:\"none@none.com\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('9', '/PNConfig','Default_Theme','$truetheme')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('10', '/PNConfig','foot1','s:1116:\"<br /><a href=\"http://www.postnuke.com\" target=\"_blank\"><img src=\"images/powered/postnuke.butn.gif\" border=\"0\" alt=\"Web site powered by PostNuke\" hspace=\"10\" /></a> <a href=\"http://php.weblogs.com/ADODB\" target=\"_blank\"><img src=\"images/powered/adodb2.gif\" alt=\"ADODB database library\" border=\"0\" hspace=\"10\" /></a><a href=\"http://www.phplivesupport.com/\" target=\"_blank\"><img src=\"images/powered/phplive.gif\" alt=\"PHP Live!, brought to you by LivePeople.info\" border=\"0\" hspace=\"10\" /></a><a href=\"http://www.php.net\" target=\"_blank\"><img src=\"images/powered/php2.gif\" alt=\"PHP Scripting Language\" border=\"0\" hspace=\"10\" /></a><br /><br />All logos and trademarks in this site are property of their respective owner. The comments are property of their posters, all the rest © 2002 by me<br />This web site was made with <a href=\"http://www.postnuke.com\" target=\"_blank\">PostNuke</a>, a web portal system written in PHP. PostNuke is Free Software released under the <a href=\"http://www.gnu.org\" target=\"_blank\">GNU/GPL license</a>.<br />You can syndicate our news using the file <a href=\"backend.php\">backend.php</a>\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('11', '/PNConfig','commentlimit','i:4096;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('12', '/PNConfig','anonymous','s:9:\"Anonymous\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('13', '/PNConfig','defaultgroup','s:5:\"Users\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('14', '/PNConfig','timezone_offset','i:12;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('15', '/PNConfig','nobox','i:0;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('16', '/PNConfig','funtext','i:1;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('17', '/PNConfig','reportlevel','i:0;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('18', '/PNConfig','startpage','s:4:\"News\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('19', '/PNConfig','admingraphic','i:0;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('20', '/PNConfig','admart','i:20;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('21', '/PNConfig','backend_title','s:21:\"PostNuke Powered Site\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('22', '/PNConfig','backend_language','s:5:\"en-us\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('23', '/PNConfig','seclevel','s:6:\"Medium\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('24', '/PNConfig','secmeddays','i:7;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('25', '/PNConfig','secinactivemins','i:10;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('26', '/PNConfig','Version_Num','s:5:\"0.7.1\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('27', '/PNConfig','Version_ID','s:8:\"PostNuke\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('28', '/PNConfig','Version_Sub','s:5:\"Rogue\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('29', '/PNConfig','debug_sql','i:0;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('30', '/PNConfig','anonpost','i:1;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('31', '/PNConfig','minpass','i:5;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('32', '/PNConfig','pollcomm','i:1;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('33', '/PNConfig','minage','i:13;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('34', '/PNConfig','top','i:10;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('35', '/PNConfig','storyhome','i:10;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('36', '/PNConfig','banners','i:0;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('37', '/PNConfig','myIP','s:12:\"150.10.10.10\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('38', '/PNConfig','language','s:3:\"eng\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('39', '/PNConfig','locale','s:5:\"en_US\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('40', '/PNConfig','multilingual','i:1;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('41', '/PNConfig','useflags','i:0;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('42', '/PNConfig','perpage','i:10;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('43', '/PNConfig','popular','i:500;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('44', '/PNConfig','newlinks','i:10;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('45', '/PNConfig','toplinks','i:25;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('46', '/PNConfig','linksresults','i:10;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('47', '/PNConfig','links_anonaddlinklock','i:1;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('48', '/PNConfig','anonwaitdays','i:1;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('49', '/PNConfig','outsidewaitdays','i:1;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('50', '/PNConfig','useoutsidevoting','i:1;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('51', '/PNConfig','anonweight','i:10;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('52', '/PNConfig','outsideweight','i:20;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('53', '/PNConfig','detailvotedecimal','i:2;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('54', '/PNConfig','mainvotedecimal','i:1;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('55', '/PNConfig','toplinkspercentrigger','i:0;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('56', '/PNConfig','mostpoplinkspercentrigger','i:0;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('57', '/PNConfig','mostpoplinks','i:25;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('58', '/PNConfig','featurebox','i:1;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('59', '/PNConfig','linkvotemin','i:5;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('60', '/PNConfig','blockunregmodify','i:0;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('61', '/PNConfig','newdownloads','i:10;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('62', '/PNConfig','topdownloads','i:25;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('63', '/PNConfig','downloadsresults','i:10;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('64', '/PNConfig','downloads_anonadddownloadlock','i:0;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('65', '/PNConfig','topdownloadspercentrigger','i:0;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('66', '/PNConfig','mostpopdownloadspercentrigger','i:0;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('67', '/PNConfig','mostpopdownloads','i:25;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('68', '/PNConfig','downloadvotemin','i:5;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('69', '/PNConfig','notify','i:0;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('70', '/PNConfig','notify_email','s:15:\"me@yoursite.com\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('71', '/PNConfig','notify_subject','s:16:\"NEWS for my site\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('72', '/PNConfig','notify_message','s:44:\"Hey! You got a new submission for your site.\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('73', '/PNConfig','notify_from','s:9:\"webmaster\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('74', '/PNConfig','moderate','i:1;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('75', '/PNConfig','BarScale','i:1;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('76', '/PNConfig','tipath','s:14:\"images/topics/\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('77', '/PNConfig','userimg','s:11:\"images/menu\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('78', '/PNConfig','usergraphic','i:1;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('79', '/PNConfig','topicsinrow','i:5;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('80', '/PNConfig','httpref','i:1;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('81', '/PNConfig','httprefmax','i:1000;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('83', '/PNConfig','reasons','a:11:{i:0;s:5:\"As Is\";i:1;s:8:\"Offtopic\";i:2;s:9:\"Flamebait\";i:3;s:5:\"Troll\";i:4;s:9:\"Redundant\";i:5;s:10:\"Insightful\";i:6;s:11:\"Interesting\";i:7;s:11:\"Informative\";i:8;s:5:\"Funny\";i:9;s:9:\"Overrated\";i:10;s:10:\"Underrated\";}')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('84', '/PNConfig','AllowableHTML','a:25:{s:3:\"!--\";s:1:\"2\";s:1:\"a\";s:1:\"2\";s:1:\"b\";s:1:\"2\";s:10:\"blockquote\";s:1:\"2\";s:2:\"br\";s:1:\"2\";s:6:\"center\";s:1:\"2\";s:3:\"div\";s:1:\"2\";s:2:\"em\";s:1:\"2\";s:4:\"font\";i:0;s:2:\"hr\";s:1:\"2\";s:1:\"i\";s:1:\"2\";s:3:\"img\";i:0;s:2:\"li\";s:1:\"2\";s:7:\"marquee\";i:0;s:2:\"ol\";s:1:\"2\";s:1:\"p\";s:1:\"2\";s:3:\"pre\";s:1:\"2\";s:4:\"span\";i:0;s:6:\"strong\";s:1:\"2\";s:2:\"tt\";s:1:\"2\";s:2:\"ul\";s:1:\"2\";s:5:\"table\";s:1:\"2\";s:2:\"td\";s:1:\"2\";s:2:\"th\";s:1:\"2\";s:2:\"tr\";s:1:\"2\";}')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('85', '/PNConfig','CensorList','a:14:{i:0;s:4:\"fuck\";i:1;s:4:\"cunt\";i:2;s:6:\"fucker\";i:3;s:7:\"fucking\";i:4;s:5:\"pussy\";i:5;s:4:\"cock\";i:6;s:4:\"c0ck\";i:7;s:3:\"cum\";i:8;s:4:\"twat\";i:9;s:4:\"clit\";i:10;s:5:\"bitch\";i:11;s:3:\"fuk\";i:12;s:6:\"fuking\";i:13;s:12:\"motherfucker\";}')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('86', '/PNConfig','CensorMode','i:1;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('87', '/PNConfig','CensorReplace','s:5:\"*****\";')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('90', '/PNConfig','theme_change','i:0;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('91', 'Ratings','defaultstyle','outoffivestars')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('92', 'Ratings','seclevel','medium')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
global $intranet;
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('93', '/PNConfig','intranet','i:$intranet;')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('94', 'Wiki','AllowedProtocols','http|https|mailto|ftp|news|gopher')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('95', 'Wiki','ExtlinkNewWindow','0')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('97', 'Wiki','IntlinkNewWindow','0')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('98', 'Wiki','FieldSeparator','\263')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('99', 'Wiki','InlineImages','png|jpg|gif')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('100', 'Blocks','collapseable','1')") or die ("<b>"._NOTUPDATED.$prefix."_module_vars</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_module_vars VALUES ('101', '/PNConfig','htmlentities','s:1:\"1\";')") or die ("<b>" ._NOTUPDATED.$prefix."_module_vars</b>");
echo "<br><font class=\"pn-sub\">".$prefix."_module_vars"._UPDATED."</font>";

$result = $dbconn->Execute("INSERT INTO ".$prefix."_poll_data VALUES ( '2', '', '0', '12')") or die ("<b>"._NOTUPDATED.$prefix."_poll_data</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_poll_data VALUES ( '2', '', '0', '11')") or die ("<b>"._NOTUPDATED.$prefix."_poll_data</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_poll_data VALUES ( '2', '', '0', '10')") or die ("<b>"._NOTUPDATED.$prefix."_poll_data</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_poll_data VALUES ( '2', '', '0', '9')") or die ("<b>"._NOTUPDATED.$prefix."_poll_data</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_poll_data VALUES ( '2', '', '0', '8')") or die ("<b>"._NOTUPDATED.$prefix."_poll_data</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_poll_data VALUES ( '2', '', '0', '7')") or die ("<b>"._NOTUPDATED.$prefix."_poll_data</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_poll_data VALUES ( '2', '', '0', '6')") or die ("<b>"._NOTUPDATED.$prefix."_poll_data</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_poll_data VALUES ( '2', '', '0', '5')") or die ("<b>"._NOTUPDATED.$prefix."_poll_data</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_poll_data VALUES ( '2', '', '0', '4')") or die ("<b>"._NOTUPDATED.$prefix."_poll_data</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_poll_data VALUES ( '2', 'What is PostNuke?', '0', '3')") or die ("<b>"._NOTUPDATED.$prefix."_poll_data</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_poll_data VALUES ( '2', 'It is what was needed.', '0', '2')") or die ("<b>"._NOTUPDATED.$prefix."_poll_data</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_poll_data VALUES ( '2', 'Think? I use it!', '0', '1')") or die ("<b>"._NOTUPDATED.$prefix."_poll_data</b>");

echo "<br><font class=\"pn-sub\">".$prefix."_poll_data"._UPDATED."</font>";

$result = $dbconn->Execute("INSERT INTO ".$prefix."_poll_desc VALUES ( '2', 'What do you think of PostNuke?', '995385085', '0', '')") or die ("<b>"._NOTUPDATED.$prefix."_poll_desc</b>");

echo "<br><font class=\"pn-sub\">".$prefix."_poll_desc"._UPDATED."</font>";

$result = $dbconn->Execute("INSERT INTO ".$prefix."_reviews_main VALUES ( 'Reviews Section Title', 'Reviews Section Long Description')") or die ("<b>"._NOTUPDATED.$prefix."_reviews_main</b>");

echo "<br><font class=\"pn-sub\">".$prefix."_reviews_main"._UPDATED."</font>";

$result = $dbconn->Execute("INSERT INTO ".$prefix."_topics VALUES ( '2', 'Linux', 'linux.gif', 'Linux', '0')") or die ("<b>"._NOTUPDATED.$prefix."_topics</b>");
// removed PHP-Nuke topic on default install.
//$result = $dbconn->Execute("INSERT INTO ".$prefix."_topics VALUES ( '2', 'PHP-Nuke', 'phpnuke.gif', 'PHP-Nuke', '0')") or die ("<b>"._NOTUPDATED.$prefix."_topics</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_topics VALUES ( '1', 'PostNuke', 'PostNuke.gif', 'PostNuke', '0')") or die ("<b>"._NOTUPDATED.$prefix."_topics</b>");

echo "<br><font class=\"pn-sub\">".$prefix."_topics"._UPDATED."</font>";

$result = $dbconn->Execute("INSERT INTO ".$prefix."_users VALUES ( '1', '', 'Anonymous', '', '', '', 'blank.gif', ".time().", '', '', '', '', '', '0', '0', '', '', '', '', '10', '', '0', '0', '0', '', '0', '', '', '4096', '0', '12.0')") or die ("<b>"._NOTUPDATED.$prefix."_users</b>");

echo "<br><font class=\"pn-sub\">".$prefix."_users"._UPDATED."</font>";

// Initial groups
$result = $dbconn->Execute("INSERT INTO ".$prefix."_groups VALUES (0,'Users')") || die("<b>"._NOTUPDATED.$prefix."_groups</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_groups VALUES (0,'Admins')") || die("<b>"._NOTUPDATED.$prefix."_groups</b>");

echo "<br><font class=\"pn-sub\">".$prefix."_groups"._UPDATED."</font>";

// Populate group membership
$result = $dbconn->Execute("INSERT INTO ".$prefix."_group_membership VALUES (1, 1)") || die("<b>"._NOTUPDATED.$prefix."_group_membership</b>");

echo "<br><font class=\"pn-sub\">".$prefix."_group_membership"._UPDATED."</font>";

// Initial group permissions
$result = $dbconn->Execute("INSERT INTO ".$prefix."_group_perms VALUES (0, 2, 1, 0, '.*', '.*', 800, 0)") || die("<b>"._NOTUPDATED.$prefix."_group_perms</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_group_perms VALUES (0, -1, 2, 0, 'Menublock::', 'Main Menu:Administration:', 0, 0)") || die("<b>"._NOTUPDATED.$prefix."_group_perms</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_group_perms VALUES (0, 1, 3, 0, '.*', '.*', 300, 0)") || die("<b>"._NOTUPDATED.$prefix."_group_perms</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_group_perms VALUES (0, 0, 4, 0, 'Menublock::', 'Main Menu:(My Account|Logout|Submit News):', 0, 0)") || die("<b>"._NOTUPDATED.$prefix."_group_perms</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_group_perms VALUES (0, 0, 5, 0, '.*', '.*', 200, 0)") || die("<b>"._NOTUPDATED.$prefix."_group_perms</b>");

echo "<br><font class=\"pn-sub\">".$prefix."_group_perms"._UPDATED."</font>";
// Initial user permissions

// Modules supplied with system
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (1,'AvantGo',1,'AvantGo','News for your PDA',2,'AvantGo','1.3',0,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (2,'Downloads',1,'Downloads','Files to download',3,'Downloads','1.3',1,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (3,'FAQ',1,'FAQ','Frequently Asked Questions',4,'FAQ','1.11',1,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (4,'Members_List',1,'Members List','Information on users of this site',5,'Members_List','1.0',0,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (5,'Messages',1,'Messages','Private messages to users of this site',6,'Messages','1.0',0,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (6,'AddStory',1,'AddStory','Add a story',8,'NS-AddStory','1.0',1,0,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (7,'Admin',1,'Admin','Administration',9,'NS-Admin','0.1',1,0,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (8,'Admin_Messages',1,'Admin Messages','Banner messages',10,'NS-Admin_Messages','1.2',1,0,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (9,'Autolinks',1,'Autolinks','Automatically add links to text',11,'Autolinks','1.0',1,0,1)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (10,'Banners',1,'Banners','Banners',12,'NS-Banners','1.0',1,0,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (11,'Blocks',2,'Blocks','Side blocks',13,'Blocks','2.0',1,0,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (12,'Comments',1,'Comments','Comment on articles',14,'NS-Comments','1.1',1,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (13,'Ephemerids',1,'Ephemerids','Daily events',15,'NS-Ephemerids','1.2',1,0,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (14,'Groups',1,'Groups','Set up administrative groups',16,'NS-Groups','0.1',1,0,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (15,'Languages',1,'Languages','Multi-language functions',17,'NS-Languages','1.2',1,0,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (16,'MailUsers',1,'MailUsers','Mail your users',19,'NS-MailUsers','1.3',1,0,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (17,'Modules',2,'Modules','Module configuration',1,'Modules','2.0',1,0,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (18,'Permissions',2,'Permissions','Configure permissions',22,'Permissions','0.1',1,0,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (19,'Polls',1,'Polls','Polls and surveys',23,'NS-Polls','1.1',1,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (20,'Quotes',2,'Quotes','Quotes and sayings',24,'Quotes','1.3',1,0,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (21,'Referers',1,'Referers','Referers',25,'NS-Referers','1.2',1,0,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (22,'Settings',1,'Settings','Settings',26,'NS-Settings','1.2',1,0,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (23,'News',1,'News','News items',7,'News','1.3',0,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (24,'Recommend_Us',1,'Recommend Us','Recommend us to a friend',30,'Recommend_Us','1.0',0,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (25,'Reviews',1,'Reviews','Reviews',31,'Reviews','1.0',1,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (26,'Search',1,'Search','Search this site',32,'Search','1.0',0,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (27,'Sections',1,'Sections','Sections',33,'Sections','1.0',1,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (28,'Stats',1,'Stats','Site statistics',34,'Stats','1.12',0,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (29,'Submit_News',1,'Submit News','Contribute a story',35,'Submit_News','1.13',1,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (30,'Top_List',1,'Top List','Top 10 listings',38,'Top_List','1.0',1,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (31,'Topics',1,'Topics','Article topics',37,'Topics','1.0',1,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (32,'User',1,'Users','User Administration',27,'NS-User','0.1',1,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (33,'Web_Links',1,'Web Links','Links to other sites',39,'Web_Links','1.0',1,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (34,'Ratings',2,'Ratings','Ratings utility',41,'Ratings','1.1',0,0,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (35,'Wiki',2,'Wiki','Wiki encoding',28,'Wiki','1.0',0,0,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (36,'xmlrpc',2,'xmlrpc','XML-RPC utility module',42,'xmlrpc','1.0',0,0,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");
$result = $dbconn->Execute("INSERT INTO ".$prefix."_modules VALUES (37,'legal',1,'Legal Documents','Generic Privacy Statement and Terms of Use',43,'legal','1.0',0,1,3)") || die("<b>"._NOTUPDATED.$prefix."_modules</b>");

// commented by proca
// karateka's advanced stats
//$dbconn->Execute("CREATE TABLE ".$prefix."_stats_date (date varchar(80) NOT NULL default '', hits int(11) unsigned NOT NULL default '0')");
//$dbconn->Execute("CREATE TABLE ".$prefix."_stats_hour (hour tinyint(2) unsigned NOT NULL default '0', hits int(10) unsigned NOT NULL default '0')");
//$dbconn->Execute("CREATE TABLE ".$prefix."_stats_month (month tinyint(2) unsigned NOT NULL default '0', hits int(10) unsigned NOT NULL default '0')");
//$dbconn->Execute("CREATE TABLE ".$prefix."_stats_week (weekday tinyint(1) unsigned NOT NULL default '0', hits int(10) unsigned NOT NULL default '0')");

$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '0', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '1', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '2', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '3', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '4', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '5', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '6', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '7', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '8', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '9', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '10', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '11', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '12', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '13', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '14', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '15', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '16', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '17', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '18', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '19', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '20', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '21', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '22', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_hour VALUES ( '23', '0')");

$dbconn->Execute("INSERT INTO ".$prefix."_stats_month VALUES ( '1', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_month VALUES ( '2', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_month VALUES ( '3', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_month VALUES ( '4', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_month VALUES ( '5', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_month VALUES ( '6', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_month VALUES ( '7', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_month VALUES ( '8', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_month VALUES ( '9', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_month VALUES ( '10', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_month VALUES ( '11', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_month VALUES ( '12', '0')");

$dbconn->Execute("INSERT INTO ".$prefix."_stats_week VALUES ( '0', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_week VALUES ( '1', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_week VALUES ( '2', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_week VALUES ( '3', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_week VALUES ( '4', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_week VALUES ( '5', '0')");
$dbconn->Execute("INSERT INTO ".$prefix."_stats_week VALUES ( '6', '0')");

// Standard Fields included in PostNuke
$dbconn->Execute("INSERT INTO ".$prefix."_user_property VALUES (1, '_UREALNAME', 0, 255, 1, NULL)") || die("<b>"._NOTUPDATED.$prefix."_user_property</b>");
$dbconn->Execute("INSERT INTO ".$prefix."_user_property VALUES (2, '_UREALEMAIL', -1, 255, 2, NULL)") || die("<b>"._NOTUPDATED.$prefix."_user_property</b>");
$dbconn->Execute("INSERT INTO ".$prefix."_user_property VALUES (3, '_UFAKEMAIL', 0, 255, 3, NULL)") || die("<b>"._NOTUPDATED.$prefix."_user_property</b>");
$dbconn->Execute("INSERT INTO ".$prefix."_user_property VALUES (4, '_YOURHOMEPAGE', 0, 255, 4, NULL)") || die("<b>"._NOTUPDATED.$prefix."_user_property</b>");
$dbconn->Execute("INSERT INTO ".$prefix."_user_property VALUES (5, '_TIMEZONEOFFSET', 0, 255, 5, NULL)") || die("<b>"._NOTUPDATED.$prefix."_user_property</b>");
$dbconn->Execute("INSERT INTO ".$prefix."_user_property VALUES (6, '_YOURAVATAR', 0, 255, 6, NULL)") || die("<b>"._NOTUPDATED.$prefix."_user_property</b>");
$dbconn->Execute("INSERT INTO ".$prefix."_user_property VALUES (7, '_YICQ', 0, 255, 7, NULL)") || die("<b>"._NOTUPDATED.$prefix."_user_property</b>");
$dbconn->Execute("INSERT INTO ".$prefix."_user_property VALUES (8, '_YAIM', 0, 255, 8, NULL)") || die("<b>"._NOTUPDATED.$prefix."_user_property</b>");
$dbconn->Execute("INSERT INTO ".$prefix."_user_property VALUES (9, '_YYIM', 0, 255, 9, NULL)") || die("<b>"._NOTUPDATED.$prefix."_user_property</b>");
$dbconn->Execute("INSERT INTO ".$prefix."_user_property VALUES (10, '_YMSNM', 0, 255, 10, NULL)") || die("<b>"._NOTUPDATED.$prefix."_user_property</b>");
$dbconn->Execute("INSERT INTO ".$prefix."_user_property VALUES (11, '_YLOCATION', 0, 255, 11, NULL)") || die("<b>"._NOTUPDATED.$prefix."_user_property</b>");
$dbconn->Execute("INSERT INTO ".$prefix."_user_property VALUES (12, '_YOCCUPATION', 0, 255, 12, NULL)") || die("<b>"._NOTUPDATED.$prefix."_user_property</b>");
$dbconn->Execute("INSERT INTO ".$prefix."_user_property VALUES (13, '_YINTERESTS', 0, 255, 13, NULL)") || die("<b>"._NOTUPDATED.$prefix."_user_property</b>");
$dbconn->Execute("INSERT INTO ".$prefix."_user_property VALUES (14, '_SIGNATURE', 0, 255, 14, NULL)") || die("<b>"._NOTUPDATED.$prefix."_user_property</b>");
$dbconn->Execute("INSERT INTO ".$prefix."_user_property VALUES (15, '_EXTRAINFO', 0, 255, 15, NULL)") || die("<b>"._NOTUPDATED.$prefix."_user_property</b>");
$dbconn->Execute("INSERT INTO ".$prefix."_user_property VALUES (16, '_PASSWORD', -1, 255, 16, NULL)") || die("<b>"._NOTUPDATED.$prefix."_user_property</b>");

// Hooks
$dbconn->Execute("INSERT INTO ".$prefix."_hooks VALUES (1, 'item', 'display', NULL, NULL, 'GUI', 'Ratings', 'user', 'display')") || die("<b>"._NOTUPDATED.$prefix."_hooks</b>");
$dbconn->Execute("INSERT INTO ".$prefix."_hooks VALUES (2, 'item', 'transform', NULL, NULL, 'API', 'Wiki', 'user', 'transform')") || die("<b>"._NOTUPDATED.$prefix."_hooks</b>");

?>
