<?php
/* ----------------------------------------------------------------------
   $Id: owp_session.php,v 1.1 2003/04/21 21:52:11 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */
   
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

  owpSessionName('owpSid');
  session_start();

  function owpSessionName($name = '') {
    if ($name != '') {
      return session_name($name);
    } else {
      return session_name();
    }
  }
?>