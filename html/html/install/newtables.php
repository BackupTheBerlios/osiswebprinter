<?php
/* ----------------------------------------------------------------------
   $Id: newtables.php,v 1.11 2003/04/21 21:52:11 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:

   File: $Id: newtables.php,v 1.40.2.1 2002/04/03 21:02:06 jgm 
   ----------------------------------------------------------------------
   POST-NUKE Content Management System
   Copyright (C) 2001 by the Post-Nuke Development Team.
   http://www.postnuke.com/
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */


function dosql($table, $sql) {
   GLOBAL $db;

   $result = $db->Execute($sql);
   if ($result === false) {
      echo '<font class="owp-error">' . NOTMADE . " " . $table . '</font>';
      exit;
   }
   echo '<br><font class="owp-title">' . $table . " " . MADE . '</font>';     
}

owp_DBInit($dbhost, $dbuname, $dbpass, $dbname, $dbtype);

$table = $prefix.'_administrators';
$sql = "
CREATE TABLE ".$prefix."_administrators (
  owp_admin_id int(11) NOT NULL auto_increment,
  owp_admin_gender char(1) NOT NULL default '',
  owp_admin_firstname varchar(32) NOT NULL default '',
  owp_admin_lastname varchar(32) NOT NULL default '',
  owp_admin_email_address varchar(96) NOT NULL default '                                                                                                ',
  owp_admin_telephone varchar(32) NOT NULL default '                                                                                                         ',
  owp_admin_fax varchar(32) default NULL,
  owp_admin_password varchar(40) NOT NULL default '',
  owp_last_modified datetime default NULL,
  owp_date_added datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (owp_admin_id)
)
";
dosql($table,$sql);

$table = $prefix.'_configuration';
$sql = "
CREATE TABLE ".$prefix."_configuration (
  owp_configuration_id int(11) NOT NULL auto_increment,
  owp_configuration_title varchar(64) NOT NULL default '',
  owp_configuration_key varchar(64) NOT NULL default '',
  owp_configuration_value varchar(255) NOT NULL default '',
  owp_configuration_description varchar(255) NOT NULL default '',
  owp_configuration_group_id int(11) NOT NULL default '0',
  owp_sort_order int(5) default NULL,
  owp_last_modified datetime default NULL,
  owp_date_added datetime NOT NULL default '0000-00-00 00:00:00',
  owp_use_function varchar(255) default NULL,
  owp_set_function varchar(255) default NULL,
  PRIMARY KEY (owp_configuration_id)
) 
";
dosql($table,$sql);


$table = $prefix.'_configuration_group';
$sql = "
 CREATE TABLE ".$prefix."_configuration_group (
   owp_configuration_group_id int(11) NOT NULL auto_increment,
   owp_configuration_group_title varchar(64) NOT NULL default '',
   owp_configuration_group_description varchar(255) NOT NULL default '',
   owp_sort_order int(5) default NULL,
   owp_visible int(1) default '1',
   PRIMARY KEY (owp_configuration_group_id)
   )
";
dosql($table,$sql);


$table = $prefix.'_languages';
$sql = "
CREATE TABLE ".$prefix."_languages (
  languages_id int(11) NOT NULL auto_increment,
  name varchar(32) NOT NULL default '',
  iso_639_2 char(3) NOT NULL default '',
  iso_639_1 char(2) NOT NULL default '',
  charset varchar(16) NOT NULL default '',
  text_direction char(3) NOT NULL default 'ltr',
  active int(1) default NULL,
  sort_order int(3) default NULL,
  PRIMARY KEY  (languages_id)
)
";
dosql($table,$sql);

$table = $prefix.'_sessions';
$sql = "
CREATE TABLE ".$prefix."_sessions (
  SESSKEY char(32) not null,
  EXPIRY int(11) unsigned not null,
  DATA text not null,
  PRIMARY KEY (sesskey)
)
";
dosql($table,$sql);

?>