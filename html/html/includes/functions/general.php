<?php
/* ----------------------------------------------------------------------
   $Id: general.php,v 1.13 2003/05/01 14:37:29 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: general.php,v 1.143 2002/11/04 02:16:55 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

////
// Redirect to another page or site
  function owpRedirect($url) {
   # global $logger;

    header('Location: ' . $url);

 #   if (STORE_PAGE_PARSE_TIME == 'true') {
 #     if (!is_object($logger)) $logger = new logger;
 #     $logger->timer_stop();
 #   }

    exit;
  }
  
  /**
   * owpPrepareInput: formatiert user eingaben 
   *  
   * @author     r23
   * @version    1.0
   * @param      $string 
   * @return     entfernt unerlaubte zeichen im string
   */
   function owpPrepareInput($string) {
      if (get_magic_quotes_gpc()) {
        $string =& stripslashes($string);
      }
      $string =& strip_tags($string);
      $string =& trim($string);
  
      return $string;
   }

////
// Sets timeout for the current script.
// Cant be used in safe mode.
  function owpSetTimeLimit($limit) {
    if (!get_cfg_var('safe_mode')) {
      set_time_limit($limit);
    }
  }

  function owpGetAllGetParameters($exclude_array = '') {
    global $_GET;

    if ($exclude_array == '') $exclude_array = array();

    $get_url = '';

    reset($_GET);
    while (list($key, $value) = each($_GET)) {
      if (($key != owpSessionName()) && ($key != 'error') && (!owpInArray($key, $exclude_array))) $get_url .= $key . '=' . $value . '&';
    }

    return $get_url;
  }

  function owpDateLong($raw_date) {
    if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') ) return false;

    $year = (int)substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    return strftime(DATE_LONG, mktime($hour, $minute, $second, $month, $day, $year));
  }

////
// Output a raw date string in the selected locale date format
// $raw_date needs to be in this format: YYYY-MM-DD HH:MM:SS
// NOTE: Includes a workaround for dates before 01/01/1970 that fail on windows servers
  function owpDateShort($raw_date) {
    if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') ) return false;

    $year = substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    if (ereg('WIN', PHP_OS) && $year <= 1970) {
      return ereg_replace('2037' . '$', $year, date(DATE_FORMAT, mktime($hour, $minute, $second, $month, $day, 2037)));
    } else {
      return date(DATE_FORMAT, mktime($hour, $minute, $second, $month, $day, $year));
    }
  }

  function owpDatetimeShort($raw_datetime) {
    if ( ($raw_datetime == '0000-00-00 00:00:00') || ($raw_datetime == '') ) return false;

    $year = (int)substr($raw_datetime, 0, 4);
    $month = (int)substr($raw_datetime, 5, 2);
    $day = (int)substr($raw_datetime, 8, 2);
    $hour = (int)substr($raw_datetime, 11, 2);
    $minute = (int)substr($raw_datetime, 14, 2);
    $second = (int)substr($raw_datetime, 17, 2);

    return strftime(DATE_TIME_FORMAT, mktime($hour, $minute, $second, $month, $day, $year));
  }

  function owpArrayMerge($array1, $array2, $array3 = '') {
    if ($array3 == '') $array3 = array();
    if (function_exists('array_merge')) {
      $array_merged = array_merge($array1, $array2, $array3);
    } else {
      while (list($key, $val) = each($array1)) $array_merged[$key] = $val;
      while (list($key, $val) = each($array2)) $array_merged[$key] = $val;
      if (sizeof($array3) > 0) while (list($key, $val) = each($array3)) $array_merged[$key] = $val;
    }

    return (array) $array_merged;
  }

  function owpInArray($lookup_value, $lookup_array) {
    if (function_exists('in_array')) {
      if (in_array($lookup_value, $lookup_array)) return true;
    } else {
      reset($lookup_array);
      while (list($key, $value) = each($lookup_array)) {
        if ($value == $lookup_value) return true;
      }
    }

    return false;
  }

  function owpArraytoString($array, $exclude = '', $equals = '=', $separator = '&') {
    if ($exclude == '') $exclude = array();

    $get_string = '';
    if (sizeof($array) > 0) {
      while (list($key, $value) = each($array)) {
        if ( (!in_array($key, $exclude)) && ($key != 'x') && ($key != 'y') ) {
          $get_string .= $key . $equals . $value . $separator;
        }
      }
      $remove_chars = strlen($separator);
      $get_string = substr($get_string, 0, -$remove_chars);
    }

    return $get_string;
  } 


  function owpBreakString($string, $len, $break_char = '-') {
    $l = 0;
    $output = '';
    for ($i = 0; $i < strlen($string); $i++) {
      $char = substr($string, $i, 1);
      if ($char != ' ') {
        $l++;
      } else {
        $l = 0;
      }
      if ($l > $len) {
        $l = 1;
        $output .= $break_char;
      }
      $output .= $char;
    }

    return $output;
  }

  function owpGetCountryName($country_id) {
    GLOBAL $db;

    $owpDBTable = owpDBGetTables();

    $country = $db->Execute("select countries_name from " . $owpDBTable['countries'] . " where countries_id = '" . $country_id . "'");

    if (!$country->RecordCount()) {
      return $country_id;
    } else {
      return $country->fields['countries_name'];
    }
  }


  function owpGetZoneName($zone_id) {
    GLOBAL $db;

    $owpDBTable = owpDBGetTables();

    $zone = $db->Execute("select zone_name from " . $owpDBTable['zones'] . " where zone_id = '" . $zone_id . "'");

    if (!$zone->RecordCount()) {
      return $zone_id;
    } else {
      return $zone->fields['zone_name'];
    }
  }


  function owpNotNull($value) {
    if (is_array($value)) {
      if (sizeof($value) > 0) {
        return true;
      } else {
        return false;
      }
    } else {
      if (($value != '') && ($value != 'NULL') && (strlen(trim($value)) > 0)) {
        return true;
      } else {
        return false;
      }
    }
  }

  function owpBrowserDetect($component) {
    global $HTTP_USER_AGENT;

    return stristr($HTTP_USER_AGENT, $component);
  }

  function owpSetLanguageStatus($languages_id, $status) {
    GLOBAL $db;

    $owpDBTable = owpDBGetTables();

    if ($status == '1') {
      return $db->Execute("update " . $owpDBTable['languages'] . " set active = '1' where languages_id = '" . $languages_id . "'");
    } elseif ($status == '0') {
      return $db->Execute("update " . $owpDBTable['languages'] . " set active = '0' where languages_id = '" . $languages_id . "'");
    } else {
      return -1;
    }
  }


  
//////////////////////////////////////////////////////////////////////////////////////////
//
// Function	: tep_format_address
//
// Arguments	: customers_id, address_id, html
//
// Return	: properly formatted address
//
// Description	: This function will lookup the Addres format from the countries database
//		  and properly format the address label.
//
//////////////////////////////////////////////////////////////////////////////////////////

  function tep_address_format($address_format_id, $address, $html, $boln, $eoln) {
    $address_format_query = tep_db_query("select address_format as format from " . TABLE_ADDRESS_FORMAT . " where address_format_id = '" . $address_format_id . "'");
    $address_format = tep_db_fetch_array($address_format_query);

    $company = addslashes($address['company']);
    $firstname = addslashes($address['firstname']);
    $lastname = addslashes($address['lastname']);
    $street = addslashes($address['street_address']);
    $suburb = addslashes($address['suburb']);
    $city = addslashes($address['city']);
    $state = addslashes($address['state']);
    $country_id = $address['country_id'];
    $zone_id = $address['zone_id'];
    $postcode = addslashes($address['postcode']);
    $zip = $postcode;
    $country = owpGetCountryName($country_id);
    $state = tep_get_zone_code($country_id, $zone_id, $state);

    if ($html) {
// HTML Mode
      $HR = '<hr>';
      $hr = '<hr>';
      if ( ($boln == '') && ($eoln == "\n") ) { // Values not specified, use rational defaults
        $CR = '<br>';
        $cr = '<br>';
        $eoln = $cr;
      } else { // Use values supplied
        $CR = $eoln . $boln;
        $cr = $CR;
      }
    } else {
// Text Mode
      $CR = $eoln;
      $cr = $CR;
      $HR = '----------------------------------------';
      $hr = '----------------------------------------';
    }

    $statecomma = '';
    $streets = $street;
    if ($suburb != '') $streets = $street . $cr . $suburb;
    if ($firstname == '') $firstname = addslashes($address['name']);
    if ($country == '') $country = addslashes($address['country']);
    if ($state != '') $statecomma = $state . ', ';

    $fmt = $address_format['format'];
    eval("\$address = \"$fmt\";");
    $address = stripslashes($address);

    if ( (ACCOUNT_COMPANY == 'true') && (owpNotNull($company)) ) {
      $address = $company . $cr . $address;
    }

    return $boln . $address . $eoln;
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_get_zone_code
  //
  // Arguments   : country           country code string
  //               zone              state/province zone_id
  //               def_state         default string if zone==0
  //
  // Return      : state_prov_code   state/province code
  //
  // Description : Function to retrieve the state/province code (as in FL for Florida etc)
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_get_zone_code($country, $zone, $def_state) {

    $state_prov_query = tep_db_query("select zone_code from " . TABLE_ZONES . " where zone_country_id = '" . $country . "' and zone_id = '" . $zone . "'");

    if (!tep_db_num_rows($state_prov_query)) {
      $state_prov_code = $def_state;
    }
    else {
      $state_prov_values = tep_db_fetch_array($state_prov_query);
      $state_prov_code = $state_prov_values['zone_code'];
    }
    
    return $state_prov_code;
  }


////
// 
  function owpGetLanguages() {
    GLOBAL $db;

    $owpDBTable = owpDBGetTables();
    $sql = "SELECT languages_id, name, iso_639_2, iso_639_1 
            FROM " . $owpDBTable['languages'] . " 
            WHERE active = '1' ORDER BY sort_order";
    $languages_query = $db->Execute($sql);
    while ($languages = $languages_query->fields) {
      $languages_array[] = array('name' => $languages['name'],
                                 'iso_639_2' => $languages['iso_639_2'],
                                 'iso_639_1' => $languages['iso_639_1']
                                );
      $languages_query->MoveNext();
    }

    return $languages_array;
  }


////
// Wrapper for class_exists() function
// This function is not available in all PHP versions so we test it before using it.
  function tep_class_exists($class_name) {
    if (function_exists('class_exists')) {
      return class_exists($class_name);
    } else {
      return true;
    }
  }



////
// Returns an array with countries
  function owpGetCountries($default = '') {
    GLOBAL $db;

    $owpDBTable = owpDBGetTables();

    $countries_array = array();
    if ($default) $countries_array[] = array('id' => '', 'text' => $default);
    $countries_query = $db->Execute("select countries_id, countries_name from " . $owpDBTable['countries'] . " order by countries_name");
    while ($countries = $countries_query->fields) {
      $countries_array[] = array('id' => $countries['countries_id'], 'text' => $countries['countries_name']);
      $countries_query->MoveNext();
    }

    return $countries_array;
  }

////
// return an array with country zones
  function owpGetCountryZones($country_id) {
    GLOBAL $db;

    $owpDBTable = owpDBGetTables();

    $zones_array = array();
    $zones_query = $db->Execute("select zone_id, zone_name from " . $owpDBTable['zones'] . " where zone_country_id = '" . $country_id . "' order by zone_name");
    while ($zones = $zones_query->fields) {
      $zones_array[] = array('id' => $zones['zone_id'], 'text' => $zones['zone_name']);
      $zones_query->MoveNext();
    }

    return $zones_array;
  }
  
  function tep_prepare_country_zones_pull_down($country_id = '') {
// preset the width of the drop-down for Netscape
    $pre = '';
    if ( (!owpBrowserDetect('MSIE')) && (owpBrowserDetect('Mozilla/4')) ) {
      for ($i=0; $i<45; $i++) $pre .= '&nbsp;';
    }

    $zones = owpGetCountryZones($country_id);

    if (sizeof($zones) > 0) {
      $zones_select = array(array('id' => '', 'text' => PLEASE_SELECT));
      $zones = owpArrayMerge($zones_select, $zones);
    } else {
      $zones = array(array('id' => '', 'text' => TYPE_BELOW));
// create dummy options for Netscape to preset the height of the drop-down
      if ( (!owpBrowserDetect('MSIE')) && (owpBrowserDetect('Mozilla/4')) ) {
        for ($i=0; $i<9; $i++) {
          $zones[] = array('id' => '', 'text' => $pre);
        }
      }
    }

    return $zones;
  }

////
// Alias function for Store configuration values in the Administration Tool
  function owpCfgPullDownCountryList($country_id) {
    return owpPullDownMenu('configuration_value', owpGetCountries(), $country_id);
  }

  function owpCfgPullDownZoneList($zone_id) {
    return owpPullDownMenu('configuration_value', owpGetCountryZones(OWP_COUNTRY), $zone_id);
  }


////
// Function to read in text area in admin
 function tep_cfg_textarea($text) {
    return owpTextareaField('configuration_value', false, 35, 5, $text);
  }

////
// Alias function for OSIS WEbPrinter configuration values in the Administration Tool
  function owpCfgSelectOption($select_array, $key_value, $key = '') {
    for ($i=0; $i<sizeof($select_array); $i++) {
      $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');
      $string .= '<br><input type="radio" name="' . $name . '" value="' . $select_array[$i] . '"';
      if ($key_value == $select_array[$i]) $string .= ' CHECKED';
      $string .= '> ' . $select_array[$i];
    }

    return $string;
  }

////
// Alias function for module configuration keys
  function tep_mod_select_option($select_array, $key_name, $key_value) {
    reset($select_array);
    while (list($key, $value) = each($select_array)) {
      if (is_int($key)) $key = $value;
      $string .= '<br><input type="radio" name="configuration[' . $key_name . ']" value="' . $key . '"';
      if ($key_value == $key) $string .= ' CHECKED';
      $string .= '> ' . $value;
    }

    return $string;
  }

////

  function owpGetUploadedFile($filename) {
    if (isset($_FILES[$filename])) {
      $uploaded_file = array('name' => $_FILES[$filename]['name'],
                             'type' => $_FILES[$filename]['type'],
                             'size' => $_FILES[$filename]['size'],
                             'tmp_name' => $_FILES[$filename]['tmp_name']);
    } elseif (isset($GLOBALS['HTTP_POST_FILES'][$filename])) {
      global $HTTP_POST_FILES;

      $uploaded_file = array('name' => $HTTP_POST_FILES[$filename]['name'],
                             'type' => $HTTP_POST_FILES[$filename]['type'],
                             'size' => $HTTP_POST_FILES[$filename]['size'],
                             'tmp_name' => $HTTP_POST_FILES[$filename]['tmp_name']);
    } else {
      $uploaded_file = array('name' => $GLOBALS[$filename . '_name'],
                             'type' => $GLOBALS[$filename . '_type'],
                             'size' => $GLOBALS[$filename . '_size'],
                             'tmp_name' => $GLOBALS[$filename]);
    }

    return $uploaded_file;
  }

// the $filename parameter is an array with the following elements:
// name, type, size, tmp_name
  function owpCopyUploadedFile($filename, $target) {
    if (substr($target, -1) != '/') $target .= '/';

    $target .= $filename['name'];

    move_uploaded_file($filename['tmp_name'], $target);
  }

// return a local directory path (without trailing slash)
  function owpGetLocalPath($path) {
    if (substr($path, -1) == '/') $path = substr($path, 0, -1);

    return $path;
  }

  function tep_array_shift(&$array) {
    if (function_exists('array_shift')) {
      return array_shift($array);
    } else {
      $i = 0;
      $shifted_array = array();
      reset($array);
      while (list($key, $value) = each($array)) {
        if ($i > 0) {
          $shifted_array[$key] = $value;
        } else {
          $return = $array[$key];
        }
        $i++;
      }
      $array = $shifted_array;

      return $return;
    }
  }

  function tep_array_reverse($array) {
    if (function_exists('array_reverse')) {
      return array_reverse($array);
    } else {
      $reversed_array = array();
      for ($i=sizeof($array)-1; $i>=0; $i--) {
        $reversed_array[] = $array[$i];
      }
      return $reversed_array;
    }
  }


  function tep_output_generated_category_path($id, $from = 'category') {
    $calculated_category_path_string = '';
    $calculated_category_path = tep_generate_category_path($id, $from);
    for ($i=0; $i<sizeof($calculated_category_path); $i++) {
      for ($j=0; $j<sizeof($calculated_category_path[$i]); $j++) {
        $calculated_category_path_string .= $calculated_category_path[$i][$j]['text'] . '&nbsp;&gt;&nbsp;';
      }
      $calculated_category_path_string = substr($calculated_category_path_string, 0, -16) . '<br>';
    }
    $calculated_category_path_string = substr($calculated_category_path_string, 0, -4);

    if (strlen($calculated_category_path_string) < 1) $calculated_category_path_string = TEXT_TOP;

    return $calculated_category_path_string;
  }

 
  function tep_reset_cache_block($cache_block) {
    global $cache_blocks;

    for ($i=0; $i<sizeof($cache_blocks); $i++) {
      if ($cache_blocks[$i]['code'] == $cache_block) {
        if ($cache_blocks[$i]['multiple']) {
          if ($dir = @opendir(DIR_FS_CACHE)) {
            while ($cache_file = readdir($dir)) {
              $cached_file = $cache_blocks[$i]['file'];
              $languages = owpGetLanguages();
              for ($j=0; $j<sizeof($languages); $j++) {
                $cached_file_unlink = ereg_replace('-language', '-' . $languages[$j]['directory'], $cached_file);
                if (ereg('^' . $cached_file_unlink, $cache_file)) {
                  @unlink(DIR_FS_CACHE . $cache_file);
                }
              }
            }
            closedir($dir);
          }
        } else {
          $cached_file = $cache_blocks[$i]['file'];
          $languages = owpGetLanguages();
          for ($i=0; $i<sizeof($languages); $i++) {
            $cached_file = ereg_replace('-language', '-' . $languages[$i]['directory'], $cached_file);
            @unlink(DIR_FS_CACHE . $cached_file);
          }
        }
        break;
      }
    }
  }

  function owpGetFilePermissions($mode) {
// determine type
    if ( ($mode & 0xC000) == 0xC000) { // unix domain socket
      $type = 's';
    } elseif ( ($mode & 0x4000) == 0x4000) { // directory
      $type = 'd';
    } elseif ( ($mode & 0xA000) == 0xA000) { // symbolic link
      $type = 'l';
    } elseif ( ($mode & 0x8000) == 0x8000) { // regular file
      $type = '-';
    } elseif ( ($mode & 0x6000) == 0x6000) { //bBlock special file
      $type = 'b';
    } elseif ( ($mode & 0x2000) == 0x2000) { // character special file
      $type = 'c';
    } elseif ( ($mode & 0x1000) == 0x1000) { // named pipe
      $type = 'p';
    } else { // unknown
      $type = '?';
    }

// determine permissions
    $owner['read']    = ($mode & 00400) ? 'r' : '-';
    $owner['write']   = ($mode & 00200) ? 'w' : '-';
    $owner['execute'] = ($mode & 00100) ? 'x' : '-';
    $group['read']    = ($mode & 00040) ? 'r' : '-';
    $group['write']   = ($mode & 00020) ? 'w' : '-';
    $group['execute'] = ($mode & 00010) ? 'x' : '-';
    $world['read']    = ($mode & 00004) ? 'r' : '-';
    $world['write']   = ($mode & 00002) ? 'w' : '-';
    $world['execute'] = ($mode & 00001) ? 'x' : '-';

// adjust for SUID, SGID and sticky bit
    if ($mode & 0x800 ) $owner['execute'] = ($owner['execute'] == 'x') ? 's' : 'S';
    if ($mode & 0x400 ) $group['execute'] = ($group['execute'] == 'x') ? 's' : 'S';
    if ($mode & 0x200 ) $world['execute'] = ($world['execute'] == 'x') ? 't' : 'T';

    return $type .
           $owner['read'] . $owner['write'] . $owner['execute'] .
           $group['read'] . $group['write'] . $group['execute'] .
           $world['read'] . $world['write'] . $world['execute'];
  }

  function owpArraySlice($array, $offset, $length = '0') {
    if (function_exists('array_slice')) {
      return array_slice($array, $offset, $length);
    } else {
      $length = abs($length);
      if ($length == 0) {
        $high = sizeof($array);
      } else {
        $high = $offset+$length;
      }

      for ($i=$offset; $i<$high; $i++) {
        $new_array[$i-$offset] = $array[$i];
      }

      return $new_array;
    }
  }

  function owpRemove($source) {
    global $messageStack, $owpRemoveError;

    if (isset($owpRemoveError)) $owpRemoveError = false;

    if (is_dir($source)) {
      $dir = dir($source);
      while ($file = $dir->read()) {
        if ( ($file != '.') && ($file != '..') ) {
          if (is_writeable($source . '/' . $file)) {
            owpRemove($source . '/' . $file);
          } else {
            $messageStack->add(sprintf(ERROR_FILE_NOT_REMOVEABLE, $source . '/' . $file), 'error');
            $owpRemoveError = true;
          }
        }
      }
      $dir->close();

      if (is_writeable($source)) {
        rmdir($source);
      } else {
        $messageStack->add(sprintf(ERROR_DIRECTORY_NOT_REMOVEABLE, $source), 'error');
        $owpRemoveError = true;
      }
    } else {
      if (is_writeable($source)) {
        unlink($source);
      } else {
        $messageStack->add(sprintf(ERROR_FILE_NOT_REMOVEABLE, $source), 'error');
        $owpRemoveError = true;
      }
    }
  }

////
// Wrapper for constant() function
// Needed because its only available in PHP 4.0.4 and higher.
  function tep_constant($constant) {
    if (function_exists('constant')) {
      $temp = constant($constant);
    } else {
      eval("\$temp=$constant;");
    }
    return $temp;
  }



  function owpMail($to_name, $to_email_address, $email_subject, $email_text, $from_email_name, $from_email_address) {
    if (SEND_EMAILS != 'true') return false;

    // Instantiate a new mail object
    $mail = new phpmailer;

    $mail->AddAddress($to_email_address, $to_name);
    $mail->Subject = $email_subject;
    $mail->From = $from_email_address;
    $mail->FromName = $from_email_name;
    // Build the text version
    $text = strip_tags($email_text);
    if (EMAIL_USE_HTML == 'true') {
      $mail->Body = $email_text;
      $mail->AltBody = $text;
    } else {
      $mail->Body = $text;
    }
    
    // $mail->AddAttachment("c:/temp/11-10-00.zip", "new_name.zip");  // optional name
    
    // Send message
    $mail->Send();
  }


////
// Wrapper function for round() for php3 compatibility
  function tep_round($value, $precision) {
    if (PHP_VERSION < 4) {
      $exp = pow(10, $precision);
      return round($value * $exp) / $exp;
    } else {
      return round($value, $precision);
    }
  }


  function owpCallFunction($function, $parameter, $object = '') {
    if ($object == '') {
      return call_user_func($function, $parameter);
    } elseif (PHP_VERSION < 4) {
      return call_user_method($function, $object, $parameter);
    } else {
      return call_user_func(array($object, $function), $parameter);
    }
  }
  
// Retreive server information
  function owpGetSystemInformation() {
    GLOBAL $db;

    $db_time = $db->Execute("select now() as datetime");

    list($system, $host, $kernel) = preg_split('/[\s,]+/', @exec('uname -a'), 5);

    return array('date' => owpDatetimeShort(date('Y-m-d H:i:s')),
                 'system' => $system,
                 'kernel' => $kernel,
                 'host' => $host,
                 'ip' => gethostbyname($host),
                 'uptime' => @exec('uptime'),
                 'http_server' => $_SERVER['SERVER_SOFTWARE'],
                 'php' => PHP_VERSION,
                 'zend' => (function_exists('zend_version') ? zend_version() : ''),
                 'db_server' => OWP_DB_SERVER,
                 'db_ip' => gethostbyname(OWP_DB_SERVER),
                 'db_version' => 'MySQL ' . (function_exists('mysql_get_server_info') ? mysql_get_server_info() : ''),
                 'db_date' => owpDatetimeShort($db['datetime']));
  }
  
?>