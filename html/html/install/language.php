<?php
/* ----------------------------------------------------------------------
   $Id: language.php,v 1.4 2003/03/31 16:40:09 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: language.php,v 1.4 2002/03/06 09:17:10 voll 
   ----------------------------------------------------------------------
   POST-NUKE Content Management System
   Copyright (C) 2001 by the Post-Nuke Development Team.
   http://www.postnuke.com/
   ----------------------------------------------------------------------
   Based on:
   PHP-NUKE Web Portal System - http://phpnuke.org/
   Thatware - http://thatware.org/
   ----------------------------------------------------------------------
   LICENSE
  
   This program is free software; you can redistribute it and/or
   modify it under the terms of the GNU General Public License (GPL)
   as published by the Free Software Foundation; either version 2
   of the License, or (at your option) any later version.
  
   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.
  
   To read the license please visit http://www.gnu.org/copyleft/gpl.html
   ----------------------------------------------------------------------
   Original Author of file: Gregor J. Rothfuss
   Purpose of file: Provide ML functionality for the installer.
   ---------------------------------------------------------------------- */

/** Loads the required language file for the installer **/
  function installer_get_language() {
     global $currentlang;
     if (!isset($currentlang)) {
        $currentlang = 'deu'; 
     }
     if (file_exists($file="lang/$currentlang/global.php"))
       include $file;
     elseif (file_exists($file="lang/$language/global.php"))
       @include $file;
     if (file_exists($file="../includes/language/$currentlang/global.php"))
       @include $file;
     elseif (file_exists($file="../includes/language/$language/global.php"))
       @include $file;
  }

// Make common language selection dropdown (from Tim Litwiller)
   function lang_dropdown() {
      global $currentlang;

      $selection = '<select name="alanguage" class="ow-text">';
      $lang = languagelist();
      $handle = opendir('lang');
      while ($f = readdir($handle)) {
        if (is_dir("lang/$f") && @$lang[$f]) {
          $langlist[$f] = $lang[$f];
        }
      }
      asort($langlist);
      foreach ($langlist as $k=>$v) {
        $selection .= '<option value="' . $k . '"';
        if ( $currentlang == $k) {
          $selection .= ' selected';
        }
        $selection .= '>'. $v . '</option> ';
      }
      $selection .= '</select>';
      
      return $selection;
   }
// list of all availabe languages (from Patrick Kellum <webmaster@ctarl-ctarl.com>)
   function languagelist() {
      $lang['ara'] = LANGUAGE_ARA; // Arabic
      $lang['bul'] = LANGUAGE_BUL; // Bulgarian
      $lang['zho'] = LANGUAGE_ZHO; // Chinese
      $lang['ces'] = LANGUAGE_CES; // Czech
      $lang['cro'] = LANGUAGE_CRO; // Croatian
      $lang['dan'] = LANGUAGE_DAN; // Danish
      $lang['nld'] = LANGUAGE_NLD; // Dutch
      $lang['eng'] = LANGUAGE_ENG; // English
      $lang['epo'] = LANGUAGE_EPO; // Esperanto
      $lang['est'] = LANGUAGE_EST; // Estonian
      $lang['fin'] = LANGUAGE_FIN; // Finnish
      $lang['fra'] = LANGUAGE_FRA; // French
      $lang['deu'] = LANGUAGE_DEU; // German
      $lang['ell'] = LANGUAGE_ELL; // Greek, Modern (1453-)
      $lang['heb'] = LANGUAGE_HEB; // Hebrew
      $lang['hun'] = LANGUAGE_HUN; // Hungarian
      $lang['isl'] = LANGUAGE_ISL; // Icelandic
      $lang['ind'] = LANGUAGE_IND; // Indonesian
      $lang['ita'] = LANGUAGE_ITA; // Italian
      $lang['jpn'] = LANGUAGE_JPN; // Japanese
      $lang['kor'] = LANGUAGE_KOR; // Korean
      $lang['lav'] = LANGUAGE_LAV; // Latvian
      $lang['lit'] = LANGUAGE_LIT; // Lithuanian
      $lang['mas'] = LANGUAGE_MAS; // Malay
      $lang['nor'] = LANGUAGE_NOR; // Norwegian
      $lang['pol'] = LANGUAGE_POL; // Polish
      $lang['por'] = LANGUAGE_POR; // Portuguese
      $lang['ron'] = LANGUAGE_RON; // Romanian
      $lang['rus'] = LANGUAGE_RUS; // Russian
      $lang['slv'] = LANGUAGE_SLV; // Slovenian
      $lang['spa'] = LANGUAGE_SPA; // Spanish
      $lang['swe'] = LANGUAGE_SWE; // Swedish
      $lang['tha'] = LANGUAGE_THA; // Thai
      $lang['tur'] = LANGUAGE_TUR; // Turkish
      $lang['ukr'] = LANGUAGE_UKR; // Ukrainian
      $lang['yid'] = LANGUAGE_YID; // Yiddish
//    Non-ISO entries are written as x_[language name]
      $lang['x_brazilian_portuguese'] = LANGUAGE_X_BRAZILIAN_PORTUGUESE; // Brazilian Portuguese
      $lang['x_klingon'] = LANGUAGE_X_KLINGON; // Klingon
      $lang['x_rus_koi8r'] = LANGUAGE_X_RUS_KOI8R; // Russian KOI8-R
//    end of list
      return $lang;
}

?>
