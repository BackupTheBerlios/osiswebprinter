<?php
/* ----------------------------------------------------------------------
   $Id: owp_session.php,v 1.2 2003/04/29 06:24:52 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */
 
 /*
 GLOBAL $_SESSION, 
        $ADODB_SESSION_CONNECT, 
        $ADODB_SESSION_DRIVER,
        $ADODB_SESSION_USER,
        $ADODB_SESSION_PWD,
        $ADODB_SESSION_DB,
        $ADODB_SESSION_TBL;

  $ADODB_SESSION_DRIVER = OWP_DB_TYPE;
  $ADODB_SESSION_DB = OWP_DB_DATABASE;
         
  // Decode encoded DB parameters
  if (OWP_ENCODED == '1') {
    $ADODB_SESSION_USER = base64_decode(OWP_DB_USERNAME);
    $ADODB_SESSION_PWD = base64_decode(OWP_DB_PASSWORD);
  } else {
    $ADODB_SESSION_USER = OWP_DB_USERNAME;
    $ADODB_SESSION_PWD = OWP_DB_PASSWORD;
  }       
  $ADODB_SESSION_TBL = $owpDBTable['session'];  
  
  include(OWP_ADODB_DIR . 'adodb.inc.php');
  include(OWP_ADODB_DIR . 'adodb-cryptsession.php');
*/
  function owpSessIni($session_name = "owpSid", $session_serialize_handler = 'php', $session_gc_probability = 50, $session_gc_maxlifetime = 1440, $session_referer_check  ='', $session_entropy_file = '', $session_entropy_length = 0, $session_cache_limiter = 'nocache', $session_cache_expire = 180, $session_use_trans_sid = 0, $sesssion_url_rewriter_tags = 'a=href,area=href,frame=src,input=src,form=fakeentry') {
    session_name($session_name);
    if (function_exists('ini_set')) {
      ini_set("session.serialize_handler", $session_serialize_handler);
      ini_set("session.gc_probability", $session_gc_probability);
      ini_set("session.gc_maxlifetime", $session_gc_maxlifetime);
      ini_set("session.referer_check", $session_referer_check);
      ini_set("session.entropy_file", $session_entropy_file);
      ini_set("session.entropy_length", $session_entropy_length);
      ini_set("session.use_trans_sid", $session_use_trans_sid);
      ini_set("session.url_rewriter.tags ", $sesssion_url_rewriter_tags);
    }
    session_start();
  }

  function owpSessionID($sessid = '') {
    if ($sessid != '') {
      return session_id($sessid);
    } else {
      return session_id();
    }
  }

  function owpSessionName($name = '') {
    if ($name != '') {
      return session_name($name);
    } else {
      return session_name();
    }
  }
?>
