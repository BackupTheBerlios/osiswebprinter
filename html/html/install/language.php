<?php
/* ----------------------------------------------------------------------
   $Id: language.php,v 1.2 2003/03/28 02:06:47 r23 Exp $

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
      $currentlang = 'eng'; // english is the fallback
   }
   if (file_exists($file="install/lang/$currentlang/global.php"))
       @include $file;
   elseif (file_exists($file="install/lang/$language/global.php"))
       @include $file;
   if (file_exists($file="language/$currentlang/global.php"))
       @include $file;
   elseif (file_exists($file="language/$language/global.php"))
       @include $file;
}

// Make common language selection dropdown (from Tim Litwiller)
// =======================================
   function lang_dropdown()
   {
      global $currentlang;
      echo "<select name=\"alanguage\" class=\"pn-text\">";
      $lang = languagelist();
      $handle = opendir('install/lang');
      while ($f = readdir($handle))
      {
         if (is_dir("install/lang/$f") && @$lang[$f])
         {
            $langlist[$f] = $lang[$f];
         }
      }
      asort($langlist);
      foreach ($langlist as $k=>$v)
      {
         echo '<option value="'.$k.'"';
         if ( $currentlang == $k)
         {
            echo ' selected';
         }
         echo '>'. $v . '</option> ';
      }
      echo "</select>";
   }
// list of all availabe languages (from Patrick Kellum <webmaster@ctarl-ctarl.com>)
// ==============================
   function languagelist()
   {
//    All entries use ISO 639-2/T
      $lang['ara'] = _LANGUAGE_ARA; // Arabic
      $lang['bul'] = _LANGUAGE_BUL; // Bulgarian
      $lang['zho'] = _LANGUAGE_ZHO; // Chinese
      $lang['ces'] = _LANGUAGE_CES; // Czech
      $lang['cro'] = _LANGUAGE_CRO; // Croatian
      $lang['dan'] = _LANGUAGE_DAN; // Danish
      $lang['nld'] = _LANGUAGE_NLD; // Dutch
      $lang['eng'] = _LANGUAGE_ENG; // English
      $lang['epo'] = _LANGUAGE_EPO; // Esperanto
      $lang['est'] = _LANGUAGE_EST; // Estonian
      $lang['fin'] = _LANGUAGE_FIN; // Finnish
      $lang['fra'] = _LANGUAGE_FRA; // French
      $lang['deu'] = _LANGUAGE_DEU; // German
      $lang['ell'] = _LANGUAGE_ELL; // Greek, Modern (1453-)
      $lang['heb'] = _LANGUAGE_HEB; // Hebrew
      $lang['hun'] = _LANGUAGE_HUN; // Hungarian
      $lang['isl'] = _LANGUAGE_ISL; // Icelandic
      $lang['ind'] = _LANGUAGE_IND; // Indonesian
      $lang['ita'] = _LANGUAGE_ITA; // Italian
      $lang['jpn'] = _LANGUAGE_JPN; // Japanese
      $lang['kor'] = _LANGUAGE_KOR; // Korean
      $lang['lav'] = _LANGUAGE_LAV; // Latvian
      $lang['lit'] = _LANGUAGE_LIT; // Lithuanian
      $lang['mas'] = _LANGUAGE_MAS; // Malay
      $lang['nor'] = _LANGUAGE_NOR; // Norwegian
      $lang['pol'] = _LANGUAGE_POL; // Polish
      $lang['por'] = _LANGUAGE_POR; // Portuguese
      $lang['ron'] = _LANGUAGE_RON; // Romanian
      $lang['rus'] = _LANGUAGE_RUS; // Russian
      $lang['slv'] = _LANGUAGE_SLV; // Slovenian
      $lang['spa'] = _LANGUAGE_SPA; // Spanish
      $lang['swe'] = _LANGUAGE_SWE; // Swedish
      $lang['tha'] = _LANGUAGE_THA; // Thai
      $lang['tur'] = _LANGUAGE_TUR; // Turkish
      $lang['ukr'] = _LANGUAGE_UKR; // Ukrainian
      $lang['yid'] = _LANGUAGE_YID; // Yiddish
//    Non-ISO entries are written as x_[language name]
      $lang['x_brazilian_portuguese'] = _LANGUAGE_X_BRAZILIAN_PORTUGUESE; // Brazilian Portuguese
      $lang['x_klingon'] = _LANGUAGE_X_KLINGON; // Klingon
      $lang['x_rus_koi8r'] = _LANGUAGE_X_RUS_KOI8R; // Russian KOI8-R
//    end of list
      return $lang;
}

?>
