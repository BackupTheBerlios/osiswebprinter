<?php
/* ----------------------------------------------------------------------
   $Id: newdata.php,v 1.3 2003/04/04 07:50:45 r23 Exp $

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

?>
