<?php
/* ----------------------------------------------------------------------
   $Id: newtables.php,v 1.18 2003/05/05 16:51:37 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:

   File: newtables.php,v 1.40.2.1 2002/04/03 21:02:06 jgm 
   ----------------------------------------------------------------------
   POST-NUKE Content Management System
   Copyright (C) 2001 by the Post-Nuke Development Team.
   http://www.postnuke.com/
   ----------------------------------------------------------------------
   DB Table 
   Based on:
   
   File: oscommerce.sql,v 1.57 2002/11/03 23:41:42 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com
   
   Copyright (c) 2002 osCommerce  
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
  admin_id int(11) NOT NULL,
  admin_gender char(1) NOT NULL default '',
  admin_firstname varchar(32) NOT NULL default '',
  admin_lastname varchar(32) NOT NULL default '',
  admin_email_address varchar(96) NOT NULL default '',
  admin_telephone varchar(32) NOT NULL default '',
  admin_fax varchar(32) default NULL,
  admin_password varchar(40) NOT NULL default '',
  admin_allowed_pages varchar(255) default '*' NOT NULL,
  admin_newsletter tinyint(1) NOT NULL default '1',
  admin_login tinyint(1) NOT NULL default '0',
  PRIMARY KEY (admin_id)
)
";
dosql($table,$sql);

$table = $prefix.'_administrators_info';
$sql = "
CREATE TABLE ".$prefix."_administrators_info (
  admin_info_id int NOT NULL,
  admin_info_date_of_last_logon datetime,
  admin_info_number_of_logons int(5),
  admin_info_date_account_created datetime,
  admin_info_date_account_last_modified datetime,
  PRIMARY KEY (admin_info_id)
)
";
dosql($table,$sql);

$table = $prefix.'_configuration';
$sql = "
CREATE TABLE ".$prefix."_configuration (
  configuration_id int(11) NOT NULL auto_increment,
  configuration_title varchar(64) NOT NULL default '',
  configuration_key varchar(64) NOT NULL default '',
  configuration_value varchar(255) NOT NULL default '',
  configuration_description varchar(255) NOT NULL default '',
  configuration_group_id int(11) NOT NULL default '0',
  sort_order int(5) default NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  use_function varchar(255) default NULL,
  set_function varchar(255) default NULL,
  PRIMARY KEY (configuration_id)
) 
";
dosql($table,$sql);

$table = $prefix.'_configuration_group';
$sql = "
 CREATE TABLE ".$prefix."_configuration_group (
   configuration_group_id int(11) NOT NULL auto_increment,
   configuration_group_title varchar(64) NOT NULL default '',
   configuration_group_description varchar(255) NOT NULL default '',
   sort_order int(5) default NULL,
   visible int(1) default '1',
   PRIMARY KEY (configuration_group_id)
   )
";
dosql($table,$sql);

$table = $prefix.'_countries';
$sql = "
 CREATE TABLE ".$prefix."_countries (
  countries_id int NOT NULL auto_increment,
  countries_name varchar(64) NOT NULL,
  countries_iso_code_2 char(2) NOT NULL,
  countries_iso_code_3 char(3) NOT NULL,
  address_format_id int NOT NULL,
  PRIMARY KEY (countries_id),
  KEY IDX_COUNTRIES_NAME (countries_name)
   )
";
dosql($table,$sql);

$table = $prefix.'_languages';
$sql = "
CREATE TABLE ".$prefix."_languages (
  languages_id int(11) NOT NULL,
  name varchar(32) NOT NULL default '',
  iso_639_2 char(3) NOT NULL default '',
  iso_639_1 char(2) NOT NULL default '',
  charset varchar(16) NOT NULL default '',
  text_direction char(3) NOT NULL default 'ltr',
  active int(1) default '0',
  sort_order int(3) default NULL,
  PRIMARY KEY  (languages_id)
)
";
dosql($table,$sql);

$table = $prefix.'_newsletters';
$sql = "
CREATE TABLE ".$prefix."_newsletters (
  newsletters_id int NOT NULL,
  title varchar(255) NOT NULL,
  content text NOT NULL,
  module varchar(255) NOT NULL,
  date_added datetime NOT NULL,
  date_sent datetime,
  status int(1),
  locked int(1) default '0',
  PRIMARY KEY (newsletters_id)
)
";
dosql($table,$sql);

$table = $prefix.'_sequence_languages';
$sql = "
CREATE TABLE ".$prefix."_sequence_languages (
  id int(11) NOT NULL default '0'
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

$table = $prefix.'_whos_online';
$sql = "
CREATE TABLE ".$prefix."_whos_online (
  user_id int,
  full_name varchar(64) NOT NULL,
  session_id varchar(128) NOT NULL,
  ip_address varchar(15) NOT NULL,
  time_entry varchar(14) NOT NULL,
  time_last_click varchar(14) NOT NULL,
  last_page_url varchar(64) NOT NULL
)
";
dosql($table,$sql);

$table = $prefix.'_zones';
$sql = "
CREATE TABLE ".$prefix."_zones (
  zone_id int NOT NULL auto_increment,
  zone_country_id int NOT NULL,
  zone_code varchar(32) NOT NULL,
  zone_name varchar(32) NOT NULL,
  PRIMARY KEY (zone_id)
)
";
dosql($table,$sql);

?>