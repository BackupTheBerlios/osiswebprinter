<?php
/* ----------------------------------------------------------------------
   $Id: system.php,v 1.7 2003/04/21 21:52:11 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: application_top.php,v 1.251 2002/11/03 23:38:42 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

// Set the level of error reporting
 # error_reporting(E_ALL & ~E_NOTICE);
  error_reporting(E_ALL);

// Disable use_trans_sid as owpLink() does this manually
  if (function_exists('ini_set')) {
    ini_set('session.use_trans_sid', 0);
  }

// include server parameters
  require_once('includes/config.php');

// Start the clock
  require_once(OWP_CLASSES_DIR . 'owp_parse_time.php');
  $owpTimeUtil = new owpParseTime();
  $owpTimeUtil->start();

// define the filenames used in the project
  $prefix_filename = '';

  if (!$prefix_filename == '') $prefix_filename = '_' . $prefix_filename;

  $owpFilename = array();

  $owpFilename['backup'] = $prefix_filename . 'backup.php';
  $owpFilename['configuration'] = $prefix_filename . 'configuration.php';
  $owpFilename['index'] = $prefix_filename . 'index.php';
  $owpFilename['define_language'] = $prefix_filename . 'define_language.php';
  $owpFilename['file_manager'] = $prefix_filename . 'file_manager.php';
  $owpFilename['languages'] = $prefix_filename . 'languages.php';
  $owpFilename['mail'] = $prefix_filename . 'mail.php';
  $owpFilename['newsletters'] = $prefix_filename . 'newsletters.php';
  $owpFilename['server_info'] = $prefix_filename . 'server_info.php';
  $owpFilename['whos_online'] = $prefix_filename . 'whos_online.php';


// define the database table names used in the project
  $prefix_table = OWP_DB_PREFIX;;

  if (!$prefix_table == '') $prefix_table = $prefix_table . '_';

  $owpDBTable = array();

  $owpDBTable['languages'] = $prefix_table . 'languages';
  $owpDBTable['session'] = $prefix_table . 'sessions';

//session
  require_once(OWP_FUNCTIONS_DIR . 'owp_session.php');


// include the database functions
  include(OWP_FUNCTIONS_DIR . 'owp_api.php');
  include(OWP_ADODB_DIR . 'adodb.inc.php');
	
// make a connection to the database... now
  if (!owpDBInit()) {
    die('Unable to connect to database server!');
  }

  
define('DEFAULT_LANGUAGE', 'deu');

define('OWP_IMAGE_REQUIRE_ONED', 'false');
define('CONFIG_CALCULATE_IMAGE_SIZE', 'true');

define('LAYOUT_XHTML', 'true');
define('BOX_WIDTH', 125); // how wide the boxes should be in pixels (default: 125)

define('EMAIL_TRANSPORT', 'sendmail');

/*!
// set the application parameters (can be modified through the administration tool)
  $configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION . '');
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
  }

// include navigation history class
  require_once(OWP_CLASSES_DIR . 'navigation_history.php');

// some code to solve compatibility issues
  require_once(OWP_FUNCTIONS_DIR . 'compatibility.php');

*/
// lets start our session

  if (isset($HTTP_COOKIE_VARS[owpSessionName()])) {
    session_id($HTTP_COOKIE_VARS[owpSessionName()]);
  } else if ($_POST[owpSessionName()]) {   
    session_id($HTTP_POST_VARS[owpSessionName()]);   
  } else {
    $_SESSION = array();
    session_destroy();
  }
  if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $HTTP_ACCEPT_LANGUAGE = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
  } 
  if (!empty($_SERVER['HTTP_USER_AGENT'])) {
    $HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
  } 

// language
  if ( (!isset($_SESSION['language'])) || (!empty($_GET['language'])) ) {
    if ($_GET['language']) {
      $_SESSION['language'] = $_GET['language'];
      $languages_query = $db->Execute("SELECT iso_639_2, iso_639_1, text_direction FROM " . $owpDBTable['languages'] . " WHERE iso_639_2 = '" . $_SESSION['language'] . "'");
            if ($languages_query === false) {
              echo '<br /><font class="owp-error">' .  $db->ErrorMsg() . $sql . '</font>';
      }
      
      $language_browser = $languages_query->fields['iso_639_1'];
      $language_text_direction = $languages_query->fields['text_direction'];  
    } else {
      $language_browser = strtok($HTTP_ACCEPT_LANGUAGE, ',');
      $languages_query = $db->Execute("SELECT iso_639_2, iso_639_1, text_direction FROM " . $owpDBTable['languages'] . " WHERE active = '1' ORDER BY sort_order");
            if ($languages_query === false) {
              echo '<br /><font class="owp-error">' .  $db->ErrorMsg() . $sql . '</font>';
      }

      while ($languages = $languages_query->fields) {
        if ($language_browser == $languages['iso_639_1']) {
          $_SESSION['language'] = $languages['iso_639_2'];
          $language_browser = $languages['iso_639_2'];
          $language_text_direction = $languages['text_direction'];
          break;
        }
        $languages_query->MoveNext();
      }
    }
    if (!isset($_SESSION['language'])) {
      $_SESSION['language'] = DEFAULT_LANGUAGE;
      $languages_query = $db->Execute("SELECT iso_639_2, iso_639_1, text_direction FROM " . $owpDBTable['languages'] . " WHERE iso_639_2 = '" . $language . "'");
      $language_browser = $languages_query->fields['iso_639_1'];
      $language_text_direction = $languages_query->fields['text_direction'];   
    }
  }
  
  if (isset($_SESSION['language'])) {
    $language =& $_SESSION['language'];
  } else {
    $language = DEFAULT_LANGUAGE;
  }

// include the language translations
  require_once(OWP_LANGUAGES_DIR . $language . '/global.php');


// define our general functions used application-wide
  require_once(OWP_FUNCTIONS_DIR . 'html_output.php');
  require_once(OWP_FUNCTIONS_DIR . 'general.php');
  
  if (EMAIL_TRANSPORT == 'sendmail') include(OWP_MAILER_DIR . 'class.phpmailer.php');
  if (EMAIL_TRANSPORT == 'smtp') include(OWP_MAILER_DIR . 'class.smtp.php');

// user input  
  if ( isset($_POST) ) {
    foreach ($_POST as $k=>$v) {
      $$k = owpPrepareInput($v);
    }
  }
/*!  
// navigation history
  if (tep_session_is_registered('navigation')) {
    if (PHP_VERSION < 4) {
      $broken_navigation = $navigation;
      $navigation = new navigationHistory;
      $navigation->unserialize($broken_navigation);
    }
  } else {
    tep_session_register('navigation');
    $navigation = new navigationHistory;
  }
  $navigation->add_current_page();


// include the who's online functions
  require_once(OWP_FUNCTIONS_DIR . 'whos_online.php');
  tep_update_whos_online();

// Include the password crypto functions
  require_once(OWP_FUNCTIONS_DIR . FILENAME_PASSWORD_CRYPT);

// Include validation functions (right now only email address)
  require_once(OWP_FUNCTIONS_DIR . 'validations.php');
*/
// split-page-results
  require_once(OWP_CLASSES_DIR . 'owp_split_page_results.php');

// infobox
// setup our boxes
  require_once(OWP_CLASSES_DIR . 'owp_table_block.php');
  require_once(OWP_CLASSES_DIR . 'owp_box.php');
  

  
/*!
  require_once(OWP_CLASSES_DIR . 'breadcrumb.php');
  $breadcrumb = new breadcrumb;

  $breadcrumb->add(HEADER_TITLE_TOP, HTTP_SERVER);
  $breadcrumb->add(HEADER_TITLE_CATALOG, owpLink(FILENAME_DEFAULT));
*/
// set which precautions should be checked
  define('WARN_INSTALL_EXISTENCE', 'true');
  define('WARN_CONFIG_WRITEABLE', 'true');
  define('WARN_SESSION_DIRECTORY_NOT_WRITEABLE', 'true');
  define('WARN_SESSION_AUTO_START', 'true');
?>
