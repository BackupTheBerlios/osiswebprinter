<?php
/* ----------------------------------------------------------------------
   $Id: owp_language.php,v 1.3 2003/04/20 16:05:18 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: language.php,v 1.1 2002/04/24 16:48:13 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce

   browser language detection logic:
   Copyright phpMyAdmin (select_lang.lib.php3 v1.24 04/19/2002)
   Copyright Stephane Garin <sgarin@sgarin.com> (detect_language.php v0.1 04/02/2002)
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  class owpLanguage {
    var $languages, $owp_languages, $browser_languages, $language;

    function owpLanguage($lng = '') {
      GLOBAL $db; 
      
      $this->languages = array('ar' => array('ar([-_][[:alpha:]]{2})?|arabic', 'arabic', 'ar'),
                               'bg-win1251' => array('bg|bulgarian', 'bulgarian-win1251', 'bg'),
                               'bg-koi8r' => array('bg|bulgarian', 'bulgarian-koi8', 'bg'),
                               'ca' => array('ca|catalan', 'catala', 'ca'),
                               'cs-iso' => array('cs|czech', 'czech-iso', 'cs'),
                               'cs-win1250' => array('cs|czech', 'czech-win1250', 'cs'),
                               'da' => array('da|danish', 'danish', 'da'),
                               'de' => array('de([-_][[:alpha:]]{2})?|deu', 'deu', 'de'),
                               'el' => array('el|greek',  'greek', 'el'),
                               'en' => array('en([-_][[:alpha:]]{2})?|english', 'english', 'en'),
                               'es' => array('es([-_][[:alpha:]]{2})?|spanish', 'spanish', 'es'),
                               'et' => array('et|estonian', 'estonian', 'et'),
                               'fi' => array('fi|finnish', 'finnish', 'fi'),
                               'fr' => array('fr([-_][[:alpha:]]{2})?|french', 'french', 'fr'),
                               'gl' => array('gl|galician', 'galician', 'gl'),
                               'he' => array('he|hebrew', 'hebrew', 'he'),
                               'hu' => array('hu|hungarian', 'hungarian', 'hu'),
                               'id' => array('id|indonesian', 'indonesian', 'id'),
                               'it' => array('it|italian', 'italian', 'it'),
                               'ja-euc' => array('ja|japanese', 'japanese-euc', 'ja'),
                               'ja-sjis' => array('ja|japanese', 'japanese-sjis', 'ja'),
                               'ko' => array('ko|korean', 'korean', 'ko'),
                               'ka' => array('ka|georgian', 'georgian', 'ka'),
                               'lt' => array('lt|lithuanian', 'lithuanian', 'lt'),
                               'lv' => array('lv|latvian', 'latvian', 'lv'),
                               'nl' => array('nl([-_][[:alpha:]]{2})?|dutch', 'dutch', 'nl'),
                               'no' => array('no|norwegian', 'norwegian', 'no'),
                               'pl' => array('pl|polish', 'polish', 'pl'),
                               'pt-br' => array('pt[-_]br|brazilian portuguese', 'brazilian_portuguese', 'pt-BR'),
                               'pt' => array('pt([-_][[:alpha:]]{2})?|portuguese', 'portuguese', 'pt'),
                               'ro' => array('ro|romanian', 'romanian', 'ro'),
                               'ru-koi8r' => array('ru|russian', 'russian-koi8', 'ru'),
                               'ru-win1251' => array('ru|russian', 'russian-win1251', 'ru'),
                               'sk' => array('sk|slovak', 'slovak-iso', 'sk'),
                               'sk-win1250' => array('sk|slovak', 'slovak-win1250', 'sk'),
                               'sr-win1250' => array('sr|serbian', 'serbian-win1250', 'sr'),
                               'sv' => array('sv|swedish', 'swedish', 'sv'),
                               'th' => array('th|thai', 'thai', 'th'),
                               'tr' => array('tr|turkish', 'turkish', 'tr'),
                               'uk-win1251' => array('uk|ukrainian', 'ukrainian-win1251', 'uk'),
                               'zh-tw' => array('zh[-_]tw|chinese traditional', 'chinese_big5', 'zh-TW'),
                               'zh' => array('zh|chinese simplified', 'chinese_gb', 'zh'));

      $this->owp_languages = array();
      
      $owpDBTable = owpDBGetTables();
      
      $sql = "SELECT languages_id, name, code, image, directory 
              FROM " . $owpDBTable['languages'] . " 
              ODER BY sort_order";
      $languages_query = $db->Execute($sql);
      while ($languages = $languages_query->fields) {
        $this->owp_languages[$languages['code']] = array('id' => $languages['languages_id'],
                                                             'name' => $languages['name'],
                                                             'image' => $languages['image'],
                                                             'directory' => $languages['directory']);
      	$languages_query->MoveNext();
      }

      $this->browser_languages = '';
      $this->language = '';

      if ( ($lng != '') && ($this->owp_languages[$lng]) ) {
        $this->language = $this->owp_languages[$lng];
      } else {
        $this->language = $this->owp_languages[DEFAULT_LANGUAGE];
      }
    }

    function get_browser_language() {
      $this->browser_languages = explode(',', getenv('HTTP_ACCEPT_LANGUAGE'));

      for ($i=0; $i<sizeof($this->browser_languages); $i++) {
        reset($this->languages);
        while (list($key, $value) = each($this->languages)) {
          if ( (eregi('^(' . $value[0] . ')(;q=[0-9]\\.[0-9])?$', $this->browser_languages[$i])) && ($this->owp_languages[$key]) ) {
            $this->language = $this->owp_languages[$key];
            break 2;
          }
        }
      }
    }
  }
?>