<?php
/* ----------------------------------------------------------------------
   $Id: system.php,v 1.4 2003/04/20 06:46:43 r23 Exp $

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
  error_reporting(E_ALL & ~E_NOTICE);

// Disable use_trans_sid as tep_href_link() does this manually
  if (function_exists('ini_set')) {
    ini_set('session.use_trans_sid', 0);
  }

// include server parameters
  require('includes/config.php');

// Start the clock
  require(OWP_CLASSES_DIR . 'owp_parse_time.php');
  $owpTimeUtil = new owpParseTime();
  $owpTimeUtil->start();

// define the filenames used in the project
  define('FILENAME_INFO_SHOPPING_CART', 'info_shopping_cart.php');


// define the database table names used in the project
  define('TABLE_ADDRESS_BOOK', 'address_book');


// customization for the design layout
  define('BOX_WIDTH', 125); // how wide the boxes should be in pixels (default: 125)

// define how the session functions will be used
#  require(OWP_FUNCTIONS_DIR . 'sessions.php');
#  tep_session_name('osCsid');


// make a connection to the database... now
// include the database functions
  include(OWP_FUNCTIONS_DIR . 'owp_api.php');
  include(OWP_ADODB_DIR . 'adodb.inc.php');

  if (!owpDBInit()) {
    die('Unable to connect to database server!');
  }

// set the application parameters (can be modified through the administration tool)
  $configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION . '');
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
  }


// include navigation history class
  require(OWP_CLASSES_DIR . 'navigation_history.php');

// some code to solve compatibility issues
  require(OWP_FUNCTIONS_DIR . 'compatibility.php');

// lets start our session
   if ($HTTP_POST_VARS[tep_session_name()]) {   
     tep_session_id($HTTP_POST_VARS[tep_session_name()]);   
   }   
   if ( (getenv('HTTPS') == 'on') && ($HTTP_GET_VARS[tep_session_name()]) ) {   
     tep_session_id($HTTP_GET_VARS[tep_session_name()]);   
   } 
   if (function_exists('session_set_cookie_params')) {
    session_set_cookie_params(0, substr(DIR_WS_CATALOG, 0, -1));
  }

  tep_session_start();


// include currencies class and create an instance
  require(OWP_CLASSES_DIR . 'currencies.php');
  $currencies = new currencies();


// language
  if ( (!$language) || ($HTTP_GET_VARS['language']) ) {
    if (!$language) {
      tep_session_register('language');
      tep_session_register('languages_id');
    }

    include(OWP_CLASSES_DIR . 'language.php');
    $lng = new language($HTTP_GET_VARS['language']);

    if (!$HTTP_GET_VARS['language']) $lng->get_browser_language();

    $language = $lng->language['directory'];
    $languages_id = $lng->language['id'];
  }

// include the language translations
  require(OWP_LANGUAGES_DIR . $language . '.php');

// define our general functions used application-wide
  require(OWP_FUNCTIONS_DIR . 'general.php');
  require(OWP_FUNCTIONS_DIR . 'html_output.php');
  
  if (EMAIL_TRANSPORT == 'sendmail') include(OWP_MAILER_DIR . 'class.phpmailer.php');
  if (EMAIL_TRANSPORT == 'smtp') include(OWP_MAILER_DIR . 'class.smtp.php');

  
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
  require(OWP_FUNCTIONS_DIR . 'whos_online.php');
  tep_update_whos_online();

// Include the password crypto functions
  require(OWP_FUNCTIONS_DIR . FILENAME_PASSWORD_CRYPT);

// Include validation functions (right now only email address)
  require(OWP_FUNCTIONS_DIR . 'validations.php');

// split-page-results
  require(OWP_CLASSES_DIR . 'split_page_results.php');

// infobox
// setup our boxes
  require(OWP_CLASSES_DIR . 'owp_table_block.php');
  require(OWP_CLASSES_DIR . 'owp_box.php');

  require(OWP_CLASSES_DIR . 'breadcrumb.php');
  $breadcrumb = new breadcrumb;

  $breadcrumb->add(HEADER_TITLE_TOP, HTTP_SERVER);
  $breadcrumb->add(HEADER_TITLE_CATALOG, tep_href_link(FILENAME_DEFAULT));

// set which precautions should be checked
  define('WARN_INSTALL_EXISTENCE', 'true');
  define('WARN_CONFIG_WRITEABLE', 'true');
  define('WARN_SESSION_DIRECTORY_NOT_WRITEABLE', 'true');
  define('WARN_SESSION_AUTO_START', 'true');
?>