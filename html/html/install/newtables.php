<?php
/* ----------------------------------------------------------------------
   $Id: newtables.php,v 1.4 2003/04/01 02:30:23 r23 Exp $

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


function dosql($table,$sql) {
   GLOBAL $dbconn;
   $result = $dbconn->Execute($sql);
   if ($result === false) {
      echo '<font class="owp-error">" . NOTMADE . " " . $table . '</font>';
      exit;
   }
   echo '<br><font class="owp-sub">' . $table . " " . MADE . '</font>';
}

$dbconn = dbconnect($dbhost, $dbuname, $dbpass, $dbname, $dbtype);

$table= $prefix.'_autonews';
$sql = "
   CREATE TABLE ".$prefix."_autonews (
     pn_anid int(11) NOT NULL auto_increment,
     pn_catid int(11) NOT NULL default '0',
     pn_aid varchar(30) NOT NULL default '',
     pn_title varchar(80) NOT NULL default '',
     pn_time varchar(19) NOT NULL default '',
     pn_hometext text NOT NULL,
     pn_bodytext text NOT NULL,
     pn_topic tinyint(3) NOT NULL default '1',
     pn_informant varchar(20) NOT NULL default '',
     pn_notes text NOT NULL,
     pn_ihome tinyint(1) NOT NULL default '0',
     pn_language varchar(30) NOT NULL default '',
     pn_withcomm int(1) NOT NULL default '0',
     PRIMARY KEY  (pn_anid)
   )
";
dosql($table,$sql);

$table = $prefix.'_banner';
$sql = "
   CREATE TABLE ".$prefix."_banner (
     pn_bid int(11) NOT NULL auto_increment,
     pn_cid int(11) NOT NULL default '0',
     pn_imptotal int(11) NOT NULL default '0',
     pn_impmade int(11) NOT NULL default '0',
     pn_clicks int(11) NOT NULL default '0',
     pn_imageurl varchar(255) NOT NULL default '',
     pn_clickurl varchar(255) NOT NULL default '',
     pn_date datetime default NULL,
     PRIMARY KEY  (pn_bid)
   )
";
dosql($table,$sql);


$table = $prefix.'_bannerclient';
$sql = "
   CREATE TABLE ".$prefix."_bannerclient (
     pn_cid int(11) NOT NULL auto_increment,
     pn_name varchar(60) NOT NULL default '',
     pn_contact varchar(60) NOT NULL default '',
     pn_email varchar(60) NOT NULL default '',
     pn_login varchar(10) NOT NULL default '',
     pn_passwd varchar(10) NOT NULL default '',
     pn_extrainfo text NOT NULL,
     PRIMARY KEY  (pn_cid)
   )
";

dosql($table,$sql);

$table = $prefix.'_bannerfinish';
$sql = "
CREATE TABLE ".$prefix."_bannerfinish (
  pn_bid int(11) NOT NULL auto_increment,
  pn_cid int(11) NOT NULL default '0',
  pn_impressions int(11) NOT NULL default '0',
  pn_clicks int(11) NOT NULL default '0',
  pn_datestart datetime default NULL,
  pn_dateend datetime default NULL,
  PRIMARY KEY  (pn_bid)
)
";
dosql($table,$sql);


$table = $prefix.'_blocks';
$sql = "
CREATE TABLE ".$prefix."_blocks (
  pn_bid int(11) unsigned NOT NULL auto_increment,
  pn_bkey varchar(255) NOT NULL default '',
  pn_title varchar(255) NOT NULL default '',
  pn_content text NOT NULL,
  pn_url varchar(255) NOT NULL default '',
  pn_mid int(11) unsigned NOT NULL default '0',
  pn_position char(1) NOT NULL default 'l',
  pn_weight decimal(10,1) NOT NULL default '0.0',
  pn_active tinyint(3) unsigned NOT NULL default '1',
  pn_refresh int(11) unsigned NOT NULL default '0',
  pn_last_update timestamp(14) NOT NULL,
  pn_language varchar(30) NOT NULL default '',
  PRIMARY KEY  (pn_bid)
)
";
dosql($table,$sql);

$table = $prefix.'_blocks_buttons';
$sql = "
CREATE TABLE ".$prefix."_blocks_buttons (
  pn_id int(11) unsigned NOT NULL auto_increment,
  pn_bid int(11) unsigned NOT NULL default '0',
  pn_title varchar(255) NOT NULL default '',
  pn_url varchar(255) NOT NULL default '',
  pn_images longtext NOT NULL,
  PRIMARY KEY  (pn_id)
)
";
dosql($table,$sql);

$table = $prefix.'_comments';
$sql = "
CREATE TABLE ".$prefix."_comments (
  pn_tid int(11) NOT NULL auto_increment,
  pn_pid int(11) default '0',
  pn_sid int(11) default '0',
  pn_date datetime default NULL,
  pn_name varchar(60) NOT NULL default '',
  pn_email varchar(60) default NULL,
  pn_url varchar(60) default NULL,
  pn_host_name varchar(60) default NULL,
  pn_subject varchar(85) NOT NULL default '',
  pn_comment text NOT NULL,
  pn_score tinyint(4) NOT NULL default '0',
  pn_reason tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (pn_tid)
)
";
dosql($table,$sql);

$table = $prefix.'_counter';
$sql = "
CREATE TABLE ".$prefix."_counter (
  pn_type varchar(80) NOT NULL default '',
  pn_var varchar(80) NOT NULL default '',
  pn_count int(11) unsigned NOT NULL default '0'
)
";
dosql($table,$sql);

$table = $prefix.'_downloads_categories';
$sql = "
CREATE TABLE ".$prefix."_downloads_categories (
  pn_cid int(11) NOT NULL auto_increment,
  pn_title varchar(50) NOT NULL default '',
  pn_description text NOT NULL,
  PRIMARY KEY  (pn_cid)
)
";
dosql($table,$sql);

$table = $prefix.'_downloads_downloads';
$sql = "
CREATE TABLE ".$prefix."_downloads_downloads (
  pn_lid int(11) NOT NULL auto_increment,
  pn_cid int(11) NOT NULL default '0',
  pn_sid int(11) NOT NULL default '0',
  pn_title varchar(100) NOT NULL default '',
  pn_url varchar(100) NOT NULL default '',
  pn_description text NOT NULL,
  pn_date datetime default NULL,
  pn_name varchar(100) NOT NULL default '',
  pn_email varchar(100) NOT NULL default '',
  pn_hits int(11) NOT NULL default '0',
  pn_submitter varchar(60) NOT NULL default '',
  pn_ratingsummary double(6,4) NOT NULL default '0.0000',
  pn_totalvotes int(11) NOT NULL default '0',
  pn_totalcomments int(11) NOT NULL default '0',
  pn_filesize int(11) NOT NULL default '0',
  pn_version varchar(10) NOT NULL default '',
  pn_homepage varchar(200) NOT NULL default '',
  PRIMARY KEY  (pn_lid)
)
";
dosql($table,$sql);

$table = $prefix.'_downloads_editorials';
$sql = "
CREATE TABLE ".$prefix."_downloads_editorials (
  pn_id int(11) NOT NULL default '0',
  pn_adminid varchar(60) NOT NULL default '',
  pn_timestamp datetime NOT NULL default '0000-00-00 00:00:00',
  pn_text text NOT NULL,
  pn_title varchar(100) NOT NULL default '',
  PRIMARY KEY  (pn_id)
)
";
dosql($table,$sql);

$table = $prefix.'_downloads_modrequest';
$sql = "
CREATE TABLE ".$prefix."_downloads_modrequest (
  pn_requestid int(11) NOT NULL auto_increment,
  pn_lid int(11) NOT NULL default '0',
  pn_cid int(11) NOT NULL default '0',
  pn_sid int(11) NOT NULL default '0',
  pn_title varchar(100) NOT NULL default '',
  pn_url varchar(100) NOT NULL default '',
  pn_description text NOT NULL,
  pn_modifysubmitter varchar(60) NOT NULL default '',
  pn_brokendownload int(3) NOT NULL default '0',
  pn_name varchar(100) NOT NULL default '',
  pn_email varchar(100) NOT NULL default '',
  pn_filesize int(11) NOT NULL default '0',
  pn_version varchar(10) NOT NULL default '',
  pn_homepage varchar(200) NOT NULL default '',
  PRIMARY KEY  (pn_requestid)
)
";
dosql($table,$sql);

$table = $prefix.'_downloads_newdownload';
$sql = "
CREATE TABLE ".$prefix."_downloads_newdownload (
  pn_lid int(11) NOT NULL auto_increment,
  pn_cid int(11) NOT NULL default '0',
  pn_sid int(11) NOT NULL default '0',
  pn_title varchar(100) NOT NULL default '',
  pn_url varchar(100) NOT NULL default '',
  pn_description text NOT NULL,
  pn_name varchar(100) NOT NULL default '',
  pn_email varchar(100) NOT NULL default '',
  pn_submitter varchar(60) NOT NULL default '',
  pn_filesize int(11) NOT NULL default '0',
  pn_version varchar(10) NOT NULL default '',
  pn_homepage varchar(200) NOT NULL default '',
  PRIMARY KEY  (pn_lid)
)
";
dosql($table,$sql);

$table = $prefix.'_downloads_subcategories';
$sql = "
CREATE TABLE ".$prefix."_downloads_subcategories (
  pn_sid int(11) NOT NULL auto_increment,
  pn_cid int(11) NOT NULL default '0',
  pn_title varchar(50) NOT NULL default '',
  PRIMARY KEY  (pn_sid)
)
";
dosql($table,$sql);

$table = $prefix.'_downloads_votedata';
$sql = "
CREATE TABLE ".$prefix."_downloads_votedata (
  pn_id int(11) NOT NULL auto_increment,
  pn_lid int(11) NOT NULL default '0',
  pn_user varchar(60) NOT NULL default '',
  pn_rating int(11) NOT NULL default '0',
  pn_hostname varchar(60) NOT NULL default '',
  pn_comments text NOT NULL,
  pn_timestamp datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (pn_id)
)
";
dosql($table,$sql);

$table = $prefix.'_ephem';
$sql = "
CREATE TABLE ".$prefix."_ephem (
  pn_eid int(11) NOT NULL auto_increment,
  pn_did tinyint(2) NOT NULL default '0',
  pn_mid tinyint(2) NOT NULL default '0',
  pn_yid int(4) NOT NULL default '0',
  pn_content text NOT NULL,
  pn_language varchar(30) NOT NULL default '',
  PRIMARY KEY  (pn_eid)
)
";
dosql($table,$sql);

$table = $prefix.'_faqanswer';
$sql = "
CREATE TABLE ".$prefix."_faqanswer (
  pn_id tinyint(4) NOT NULL auto_increment,
  pn_id_cat tinyint(4) default NULL,
  pn_question varchar(255) default NULL,
  pn_answer text,
  pn_submittedby varchar(250) NOT NULL default '',
  PRIMARY KEY  (pn_id)
)
";
dosql($table,$sql);

$table = $prefix.'_faqcategories';
$sql = "
CREATE TABLE ".$prefix."_faqcategories (
  pn_id_cat tinyint(3) NOT NULL auto_increment,
  pn_categories varchar(255) default NULL,
  pn_language varchar(30) NOT NULL default '',
  pn_parent_id tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (pn_id_cat)
)
";
dosql($table,$sql);

$table = $prefix.'_group_membership';
$sql = "
CREATE TABLE ".$prefix."_group_membership (
  pn_gid int(11) NOT NULL default '0',
  pn_uid int(11) NOT NULL default '0'
)
";
dosql($table,$sql);

$table = $prefix.'_group_perms';
$sql = "
CREATE TABLE ".$prefix."_group_perms (
  pn_pid int(11) NOT NULL auto_increment,
  pn_gid int(11) NOT NULL default '0',
  pn_sequence int(11) NOT NULL default '0',
  pn_realm smallint(4) NOT NULL default '0',
  pn_component varchar(255) NOT NULL default '',
  pn_instance varchar(255) NOT NULL default '',
  pn_level smallint(4) NOT NULL default '0',
  pn_bond int(2) NOT NULL default '0',
  PRIMARY KEY  (pn_pid)
)
";
dosql($table,$sql);

$table = $prefix.'_groups';
$sql = "
CREATE TABLE ".$prefix."_groups (
  pn_gid int(11) NOT NULL auto_increment,
  pn_name varchar(255) NOT NULL default '',
  PRIMARY KEY  (pn_gid)
)
";
dosql($table,$sql);

$table = $prefix.'_headlines';
$sql = "
CREATE TABLE ".$prefix."_headlines (
  pn_id int(11) unsigned NOT NULL auto_increment,
  pn_sitename varchar(255) NOT NULL default '',
  pn_rssuser varchar(10) default NULL,
  pn_rsspasswd varchar(10) default NULL,
  pn_use_proxy tinyint(3) NOT NULL default '0',
  pn_rssurl varchar(255) NOT NULL default '',
  pn_maxrows tinyint(3) NOT NULL default '10',
  pn_siteurl varchar(255) NOT NULL default '',
  pn_options varchar(20) default '',
  PRIMARY KEY  (pn_id)
)
";
dosql($table,$sql);

$table = $prefix.'_hooks';
$sql = "
CREATE TABLE ".$prefix."_hooks (
  pn_id int(11) unsigned NOT NULL auto_increment,
  pn_object varchar(64) NOT NULL,
  pn_action varchar(64) NOT NULL,
  pn_smodule varchar(64),
  pn_stype varchar(64),
  pn_tarea varchar(64) NOT NULL,
  pn_tmodule varchar(64) NOT NULL,
  pn_ttype varchar(64) NOT NULL,
  pn_tfunc varchar(64) NOT NULL,
  PRIMARY KEY  (pn_id)
)
";
dosql($table,$sql);

$table = $prefix.'_languages_constant';
$sql = "
CREATE TABLE ".$prefix."_languages_constant (
  pn_constant varchar(32) NOT NULL default '',
  pn_file varchar(64) NOT NULL default '',
  PRIMARY KEY  (pn_constant)
)
";
dosql($table,$sql);

$table = $prefix.'_languages_file';
$sql = "
CREATE TABLE ".$prefix."_languages_file (
  pn_target varchar(64) NOT NULL default '',
  pn_source varchar(64) NOT NULL default '',
  PRIMARY KEY  (pn_target,pn_source),
  UNIQUE KEY source (pn_source)
)
";
dosql($table,$sql);

$table = $prefix.'_languages_translation';
$sql = "
CREATE TABLE ".$prefix."_languages_translation (
  pn_language varchar(32) NOT NULL default '',
  pn_constant varchar(32) NOT NULL default '',
  pn_translation longblob NOT NULL default '',
  pn_level tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (pn_constant,pn_language)
)
";
dosql($table,$sql);

$table = $prefix.'_links_categories';
$sql = "
CREATE TABLE ".$prefix."_links_categories (
  pn_cat_id int(11) NOT NULL auto_increment,
  pn_parent_id int(11) default NULL,
  pn_title varchar(50) NOT NULL default '',
  pn_description text NOT NULL,
  PRIMARY KEY  (pn_cat_id)
)
";
dosql($table,$sql);

$table = $prefix.'_links_editorials';
$sql = "
CREATE TABLE ".$prefix."_links_editorials (
  pn_linkid int(11) NOT NULL default '0',
  pn_adminid varchar(60) NOT NULL default '',
  pn_timestamp datetime NOT NULL default '0000-00-00 00:00:00',
  pn_text text NOT NULL,
  pn_title varchar(100) NOT NULL default '',
  PRIMARY KEY  (pn_linkid)
)
";
dosql($table,$sql);

$table = $prefix.'_links_links';
$sql = "
CREATE TABLE ".$prefix."_links_links (
  pn_lid int(11) NOT NULL auto_increment,
  pn_cat_id int(11) NOT NULL default '0',
  pn_title varchar(100) NOT NULL default '',
  pn_url varchar(100) NOT NULL default '',
  pn_description text NOT NULL,
  pn_date datetime default NULL,
  pn_name varchar(100) NOT NULL default '',
  pn_email varchar(100) NOT NULL default '',
  pn_hits int(11) NOT NULL default '0',
  pn_submitter varchar(60) NOT NULL default '',
  pn_ratingsummary double(6,4) NOT NULL default '0.0000',
  pn_totalvotes int(11) NOT NULL default '0',
  pn_totalcomments int(11) NOT NULL default '0',
  PRIMARY KEY  (pn_lid)
)
";
dosql($table,$sql);

$table = $prefix.'_links_modrequest';
$sql = "
CREATE TABLE ".$prefix."_links_modrequest (
  pn_requestid int(11) NOT NULL auto_increment,
  pn_lid int(11) NOT NULL default '0',
  pn_cat_id int(11) NOT NULL default '0',
  pn_sid int(11) NOT NULL default '0',
  pn_title varchar(100) NOT NULL default '',
  pn_url varchar(100) NOT NULL default '',
  pn_description text NOT NULL,
  pn_modifysubmitter varchar(60) NOT NULL default '',
  pn_brokenlink tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (pn_requestid)
)
";
dosql($table,$sql);

$table = $prefix.'_links_newlink';
$sql = "
CREATE TABLE ".$prefix."_links_newlink (
  pn_lid int(11) NOT NULL auto_increment,
  pn_cat_id int(11) NOT NULL default '0',
  pn_title varchar(100) NOT NULL default '',
  pn_url varchar(100) NOT NULL default '',
  pn_description text NOT NULL,
  pn_name varchar(100) NOT NULL default '',
  pn_email varchar(100) NOT NULL default '',
  pn_submitter varchar(60) NOT NULL default '',
  PRIMARY KEY  (pn_lid)
)
";
dosql($table,$sql);

$table = $prefix.'_links_votedata';
$sql = "
CREATE TABLE ".$prefix."_links_votedata (
  pn_id int(11) NOT NULL auto_increment,
  pn_lid int(11) NOT NULL default '0',
  pn_user varchar(60) NOT NULL default '',
  pn_rating int(11) NOT NULL default '0',
  pn_hostname varchar(60) NOT NULL default '',
  pn_comments text NOT NULL,
  pn_timestamp datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (pn_id)
)
";
dosql($table,$sql);

$table = $prefix.'_message';
$sql = "
CREATE TABLE ".$prefix."_message (
  pn_mid int(11) NOT NULL auto_increment,
  pn_title varchar(100) NOT NULL default '',
  pn_content text NOT NULL,
  pn_date varchar(14) NOT NULL default '',
  pn_expire mediumint(7) NOT NULL default '0',
  pn_active tinyint(4) NOT NULL default '1',
  pn_view tinyint(1) NOT NULL default '1',
  pn_language varchar(30) NOT NULL default '',
  PRIMARY KEY  (pn_mid)
)
";
dosql($table,$sql);

$table = $prefix.'_module_vars';
$sql = "
CREATE TABLE ".$prefix."_module_vars (
  pn_id int(11) unsigned NOT NULL auto_increment,
  pn_modname varchar(64) NOT NULL default '',
  pn_name varchar(64) NOT NULL default '',
  pn_value longtext,
  PRIMARY KEY  (pn_id),
  KEY pn_modname (pn_modname),
  KEY pn_name (pn_name)
)
";
dosql($table,$sql);

$table = $prefix.'_modules';
$sql = "
CREATE TABLE ".$prefix."_modules (
  pn_id int(11) unsigned NOT NULL auto_increment,
  pn_name varchar(64) NOT NULL default '',
  pn_type int(6) NOT NULL,
  pn_displayname varchar(64) NOT NULL default '',
  pn_description varchar(255) NOT NULL default '',
  pn_regid int(11) unsigned NOT NULL default '0',
  pn_directory varchar(64) NOT NULL default '',
  pn_version varchar(10) NOT NULL default '0',
  pn_admin_capable tinyint(1) NOT NULL default '0',
  pn_user_capable tinyint(1) NOT NULL default '0',
  pn_state tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (pn_id)
)
";
dosql($table,$sql);

$table = $prefix.'_poll_check';
$sql = "
CREATE TABLE ".$prefix."_poll_check (
  pn_ip varchar(20) NOT NULL default '',
  pn_time varchar(14) NOT NULL default ''
)
";
dosql($table,$sql);

$table = $prefix.'_poll_data';
$sql = "
CREATE TABLE ".$prefix."_poll_data (
  pn_pollid int(11) NOT NULL default '0',
  pn_optiontext char(50) NOT NULL default '',
  pn_optioncount int(11) NOT NULL default '0',
  pn_voteid int(11) NOT NULL default '0'
)
";
dosql($table,$sql);

$table = $prefix.'_poll_desc';
$sql = "
CREATE TABLE ".$prefix."_poll_desc (
  pn_pollid int(11) NOT NULL auto_increment,
  pn_title varchar(100) NOT NULL default '',
  pn_timestamp int(11) NOT NULL default '0',
  pn_voters mediumint(9) NOT NULL default '0',
  pn_language varchar(30) NOT NULL default '',
  PRIMARY KEY  (pn_pollid)
)
";
dosql($table,$sql);

$table = $prefix.'_pollcomments';
$sql = "
CREATE TABLE ".$prefix."_pollcomments (
  pn_tid int(11) NOT NULL auto_increment,
  pn_pid int(11) default '0',
  pn_pollid int(11) default '0',
  pn_date datetime default NULL,
  pn_name varchar(60) NOT NULL default '',
  pn_email varchar(60) default NULL,
  pn_url varchar(60) default NULL,
  pn_host_name varchar(60) default NULL,
  pn_subject varchar(60) NOT NULL default '',
  pn_comment text NOT NULL,
  pn_score tinyint(4) NOT NULL default '0',
  pn_reason tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (pn_tid)
)
";
dosql($table,$sql);

$table = $prefix.'_priv_msgs';
$sql = "
CREATE TABLE ".$prefix."_priv_msgs (
  pn_msg_id int(11) NOT NULL auto_increment,
  pn_msg_image varchar(100) default NULL,
  pn_subject varchar(100) default NULL,
  pn_from_userid int(11) NOT NULL default '0',
  pn_to_userid int(11) NOT NULL default '0',
  pn_msg_time varchar(20) default NULL,
  pn_msg_text text,
  pn_read_msg tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (pn_msg_id),
  KEY pn_to_userid (pn_to_userid)
)
";
dosql($table,$sql);

$table = $prefix.'_queue';
$sql = "
CREATE TABLE ".$prefix."_queue (
  pn_qid smallint(5) unsigned NOT NULL auto_increment,
  pn_uid mediumint(9) NOT NULL default '0',
  pn_arcd tinyint(1) NOT NULL default '0',
  pn_uname varchar(40) NOT NULL default '',
  pn_subject varchar(100) NOT NULL default '',
  pn_story text,
  pn_timestamp datetime NOT NULL default '0000-00-00 00:00:00',
  pn_topic varchar(20) NOT NULL default '',
  pn_language varchar(30) NOT NULL default '',
  pn_bodytext text,
  PRIMARY KEY  (pn_qid)
)
";
dosql($table,$sql);

$table = $prefix.'_quotes';
$sql = "
CREATE TABLE ".$prefix."_quotes (
  pn_qid int(11) unsigned NOT NULL auto_increment,
  pn_quote text,
  pn_author varchar(150) NOT NULL default '',
  PRIMARY KEY  (pn_qid)
)
";
dosql($table,$sql);

$table = $prefix.'_realms';
$sql = "
CREATE TABLE ".$prefix."_realms (
  pn_rid int(11) NOT NULL auto_increment,
  pn_name varchar(255) NOT NULL default '',
  PRIMARY KEY  (pn_rid)
)
";
dosql($table,$sql);

$table = $prefix.'_referer';
$sql = "
CREATE TABLE ".$prefix."_referer (
  pn_rid int(11) NOT NULL auto_increment,
  pn_url varchar(100) NOT NULL default '',
  pn_frequency int(15) default NULL,
  PRIMARY KEY  (pn_rid)
)
";
dosql($table,$sql);

$table = $prefix.'_related';
$sql = "
CREATE TABLE ".$prefix."_related (
  pn_rid int(11) NOT NULL auto_increment,
  pn_tid int(11) NOT NULL default '0',
  pn_name varchar(30) NOT NULL default '',
  pn_url varchar(200) NOT NULL default '',
  PRIMARY KEY  (pn_rid)
)
";
dosql($table,$sql);

$table = $prefix.'_reviews';
$sql = "
CREATE TABLE ".$prefix."_reviews (
  pn_id int(11) NOT NULL auto_increment,
  pn_date datetime NOT NULL default '0000-00-00 00:00:00',
  pn_title varchar(150) NOT NULL default '',
  pn_text text NOT NULL,
  pn_reviewer varchar(20) default NULL,
  pn_email varchar(60) default NULL,
  pn_score int(11) NOT NULL default '0',
  pn_cover varchar(100) NOT NULL default '',
  pn_url varchar(100) NOT NULL default '',
  pn_url_title varchar(50) NOT NULL default '',
  pn_hits int(11) NOT NULL default '0',
  pn_language varchar(30) NOT NULL default '',
  PRIMARY KEY  (pn_id)
)
";
dosql($table,$sql);

$table = $prefix.'_reviews_add';
$sql = "
CREATE TABLE ".$prefix."_reviews_add (
  pn_id int(11) NOT NULL auto_increment,
  pn_date datetime default NULL,
  pn_title varchar(150) NOT NULL default '',
  pn_text text NOT NULL,
  pn_reviewer varchar(20) NOT NULL default '',
  pn_email varchar(60) default NULL,
  pn_score int(11) NOT NULL default '0',
  pn_url varchar(100) NOT NULL default '',
  pn_url_title varchar(50) NOT NULL default '',
  pn_language varchar(30) NOT NULL default '',
  PRIMARY KEY  (pn_id)
)
";
dosql($table,$sql);

$table = $prefix.'_comments';
$sql = "
CREATE TABLE ".$prefix."_reviews_comments (
  pn_cid int(11) NOT NULL auto_increment,
  pn_rid int(11) NOT NULL default '0',
  pn_userid varchar(25) NOT NULL default '',
  pn_date datetime default NULL,
  pn_comments text,
  pn_score int(11) NOT NULL default '0',
  PRIMARY KEY  (pn_cid)
)
";
dosql($table,$sql);

$table = $prefix.'_reviews_main';
$sql = "
CREATE TABLE ".$prefix."_reviews_main (
  pn_title varchar(100) default NULL,
  pn_description text
)
";
dosql($table,$sql);

$table = $prefix.'_seccont';
$sql = "
CREATE TABLE ".$prefix."_seccont (
  pn_artid int(11) NOT NULL auto_increment,
  pn_secid int(11) NOT NULL default '0',
  pn_title text NOT NULL,
  pn_content text NOT NULL,
  pn_counter int(11) NOT NULL default '0',
  pn_language varchar(30) NOT NULL default '',
  PRIMARY KEY  (pn_artid)
)
";
dosql($table,$sql);

$table = $prefix.'_sections';
$sql = "
CREATE TABLE ".$prefix."_sections (
  pn_secid int(11) NOT NULL auto_increment,
  pn_secname varchar(40) NOT NULL default '',
  pn_image varchar(50) NOT NULL default '',
  PRIMARY KEY  (pn_secid)
)
";
dosql($table,$sql);

$table = $prefix.'_session_info';
$sql = "
CREATE TABLE ".$prefix."_session_info (
  pn_sessid varchar(32) NOT NULL default '',
  pn_ipaddr varchar(20) NOT NULL default '',
  pn_firstused int(11) NOT NULL default '0',
  pn_lastused int(11) NOT NULL default '0',
  pn_uid int(11) NOT NULL default '0',
  pn_vars blob,
  PRIMARY KEY  (pn_sessid)
)
";
dosql($table,$sql);

$table = $prefix.'_stats_date';
$sql = "
CREATE TABLE ".$prefix."_stats_date (
  pn_date varchar(80) NOT NULL default '',
  pn_hits int(11) unsigned NOT NULL default '0'
)
";
dosql($table,$sql);

$table = $prefix.'_stats_hour';
$sql = "
CREATE TABLE ".$prefix."_stats_hour (
  pn_hour tinyint(2) unsigned NOT NULL default '0',
  pn_hits int(11) unsigned NOT NULL default '0'
)
";
dosql($table,$sql);

$table = $prefix.'_stats_month';
$sql = "
CREATE TABLE ".$prefix."_stats_month (
  pn_month tinyint(2) unsigned NOT NULL default '0',
  pn_hits int(11) unsigned NOT NULL default '0'
)
";
dosql($table,$sql);

$table = $prefix.'_stats_week';
$sql = "
CREATE TABLE ".$prefix."_stats_week (
  pn_weekday tinyint(1) unsigned NOT NULL default '0',
  pn_hits int(11) unsigned NOT NULL default '0'
)
";
dosql($table,$sql);

$table = $prefix.'_stories';
$sql = "
CREATE TABLE ".$prefix."_stories (
  pn_sid int(11) NOT NULL auto_increment,
  pn_catid int(11) NOT NULL default '0',
  pn_aid varchar(30) NOT NULL default '',
  pn_title varchar(255) default NULL,
  pn_time datetime default NULL,
  pn_hometext text,
  pn_bodytext text NOT NULL,
  pn_comments int(11) default '0',
  pn_counter mediumint(8) unsigned default NULL,
  pn_topic tinyint(3) NOT NULL default '1',
  pn_informant varchar(20) NOT NULL default '',
  pn_notes text NOT NULL,
  pn_ihome tinyint(1) NOT NULL default '0',
  pn_themeoverride varchar(30) NOT NULL default '',
  pn_language varchar(30) NOT NULL default '',
  pn_withcomm tinyint(1) NOT NULL default '0',
  pn_format_type tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (pn_sid)
)
";
dosql($table,$sql);

$table = $prefix.'_stories_cat';
$sql = "
CREATE TABLE ".$prefix."_stories_cat (
  pn_catid int(11) NOT NULL auto_increment,
  pn_title varchar(40) NOT NULL default '',
  pn_counter int(11) NOT NULL default '0',
  pn_themeoverride varchar(30) NOT NULL default '',
  PRIMARY KEY  (pn_catid)
)
";
dosql($table,$sql);

$table = $prefix.'_topics';
$sql = "
CREATE TABLE ".$prefix."_topics (
  pn_topicid tinyint(3) NOT NULL auto_increment,
  pn_topicname varchar(255) default NULL,
  pn_topicimage varchar(255) default NULL,
  pn_topictext varchar(255) default NULL,
  pn_counter int(11) NOT NULL default '0',
  PRIMARY KEY  (pn_topicid)
)
";
dosql($table,$sql);

$table = $prefix.'_user_data';
$sql = "
CREATE TABLE ".$prefix."_user_data (
  pn_uda_id int(11) NOT NULL auto_increment,
  pn_uda_propid int(11) NOT NULL default '0',
  pn_uda_uid int(11) NOT NULL default '0',
  pn_uda_value mediumblob NOT NULL,
  PRIMARY KEY  (pn_uda_id)
)
";
dosql($table,$sql);

$table = $prefix.'_user_perms';
$sql = "
CREATE TABLE ".$prefix."_user_perms (
  pn_pid int(11) NOT NULL auto_increment,
  pn_uid int(11) NOT NULL default '0',
  pn_sequence int(6) NOT NULL default '0',
  pn_realm int(4) NOT NULL default '0',
  pn_component varchar(255) NOT NULL default '',
  pn_instance varchar(255) NOT NULL default '',
  pn_level int(4) NOT NULL default '0',
  pn_bond int(2) NOT NULL default '0',
  PRIMARY KEY  (pn_pid)
)
";
dosql($table,$sql);

$table = $prefix.'_user_property';
$sql = "
CREATE TABLE ".$prefix."_user_property (
  pn_prop_id int(11) NOT NULL auto_increment,
  pn_prop_label varchar(255) NOT NULL default '',
  pn_prop_dtype int(11) NOT NULL default '0',
  pn_prop_length int(11) NOT NULL default '255',
  pn_prop_weight int(11) NOT NULL default '0',
  pn_prop_validation varchar(255) default NULL,
  PRIMARY KEY  (pn_prop_id),
  UNIQUE KEY pn_prop_label (pn_prop_label)
)
";
dosql($table,$sql);

$table = $prefix.'_userblocks';
$sql = "
CREATE TABLE ".$prefix."_userblocks (
  pn_uid int(11) NOT NULL default '0',
  pn_bid int(11) NOT NULL default '0',
  pn_active tinyint(3) NOT NULL default '1',
  pn_last_update timestamp(14) NOT NULL
)
";
dosql($table,$sql);

$table = $prefix.'_users';
$sql = "
CREATE TABLE ".$prefix."_users (
  pn_uid int(11) NOT NULL auto_increment,
  pn_name varchar(60) NOT NULL default '',
  pn_uname varchar(25) NOT NULL default '',
  pn_email varchar(60) NOT NULL default '',
  pn_femail varchar(60) NOT NULL default '',
  pn_url varchar(100) NOT NULL default '',
  pn_user_avatar varchar(30) default NULL,
  pn_user_regdate varchar(20) NOT NULL default '',
  pn_user_icq varchar(15) default NULL,
  pn_user_occ varchar(100) default NULL,
  pn_user_from varchar(100) default NULL,
  pn_user_intrest varchar(150) default NULL,
  pn_user_sig varchar(255) default NULL,
  pn_user_viewemail tinyint(2) default NULL,
  pn_user_theme tinyint(3) default NULL,
  pn_user_aim varchar(18) default NULL,
  pn_user_yim varchar(25) default NULL,
  pn_user_msnm varchar(25) default NULL,
  pn_pass varchar(40) NOT NULL default '',
  pn_storynum tinyint(4) NOT NULL default '10',
  pn_umode varchar(10) NOT NULL default '',
  pn_uorder tinyint(1) NOT NULL default '0',
  pn_thold tinyint(1) NOT NULL default '0',
  pn_noscore tinyint(1) NOT NULL default '0',
  pn_bio tinytext NOT NULL,
  pn_ublockon tinyint(1) NOT NULL default '0',
  pn_ublock tinytext NOT NULL,
  pn_theme varchar(255) NOT NULL default '',
  pn_commentmax int(11) NOT NULL default '4096',
  pn_counter int(11) NOT NULL default '0',
  pn_timezone_offset float(3,1) NOT NULL default '0.0',
  PRIMARY KEY  (pn_uid)
)
";
dosql($table,$sql);
?>

