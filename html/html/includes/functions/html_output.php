<?php
/* ----------------------------------------------------------------------
   $Id: html_output.php,v 1.9 2003/04/29 17:02:07 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: html_output.php,v 1.26 2002/08/06 14:48:54 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

////
// The HTML href link wrapper function
  function owpLink($page = '', $parameters = '', $connection = 'NONSSL') {
    if ($page == '') {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine the page link!<br><br>Function used:<br><br>owpLink(\'' . $page . '\', \'' . $parameters . '\', \'' . $connection . '\')</b>');
    }
    if ($connection == 'NONSSL') {
      $link = OWP_HTTP_SERVER . '/';
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL == 'true') {
        $link = OWP_HTTP_SERVER . '/';
      } else {
        $link = OWP_HTTP_SERVER . '/';
      }
    } else {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine connection method on a link!<br><br>Known methods: NONSSL SSL<br><br>Function used:<br><br>owpLink(\'' . $page . '\', \'' . $parameters . '\', \'' . $connection . '\')</b>');
    }
    if ($parameters == '') {
      $link = $link . $page . '?' . SID;
    } else {
      $link = $link . $page . '?' . $parameters . '&' . SID;
    }  

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);

    return $link;
  }

////
// Output a function button in the selected language
  function owpImageButton($image, $alt = '', $params = '') {
    global $language;

    return owpImage(OWP_LANGUAGES_DIR . $language . '/buttons/' . $image, $alt, '', '', $params);
  }
 
 ////
 // Outputs a button in the selected language
   function owpImageSubmit($image, $alt, $params = '') {
     global $language;
 
     return '<input type="image" src="' . OWP_LANGUAGES_DIR . $language . '/buttons/' . $image . '" border="0" alt="' . $alt . '"' . (($params) ? ' ' . $params : '') . '>';
  }
 
////
// Output a form
  function owpDrawForm($name, $action, $parameters = '', $method = 'post', $params = '') {
    $form = '<form name="' . $name . '" action="';
    if ($parameters) {
      $form .= owpLink($action, $parameters);
    } else {
      $form .= owpLink($action);
    }
    $form .= '" method="' . $method . '"';
    if ($params) {
      $form .= ' ' . $params;
    }
    $form .= '>';

    return $form;
  }

////
// Output a form input field
  function owpInputField($name, $value = '', $parameters = '', $required = false, $type = 'text', $reinsert_value = true) {
    $field = '<input type="' . $type . '" name="' . $name . '"';
    if ( ($GLOBALS[$name]) && ($reinsert_value) ) {
      $field .= ' value="' . htmlspecialchars(trim($GLOBALS[$name])) . '"';
    } elseif ($value != '') {
      $field .= ' value="' . htmlspecialchars(trim($value)) . '"';
    }
    if ($parameters != '') {
      $field .= ' ' . $parameters;
    }
    $field .= '>';

    if ($required) $field .= TEXT_FIELD_REQUIRED;

    return $field;
  }

////
// Output a form filefield
  function owpFileField($name, $required = false) {
    $field = owpInputField($name, '', '', $required, 'file');

    return $field;
  }

////
// Output a selection field - alias function for owpCheckboxField() and owpRadioField()
  function owpSelectionField($name, $type, $value = '', $checked = false, $compare = '') {
    $selection = '<input type="' . $type . '" name="' . $name . '"';
    if ($value != '') {
      $selection .= ' value="' . $value . '"';
    }
    if ( ($checked == true) || ($GLOBALS[$name] == 'on') || ($value && ($GLOBALS[$name] == $value)) || ($value && ($value == $compare)) ) {
      $selection .= ' CHECKED';
    }
    $selection .= '>';

    return $selection;
  }

////
// Output a form checkbox field
  function owpCheckboxField($name, $value = '', $checked = false, $compare = '') {
    return owpSelectionField($name, 'checkbox', $value, $checked, $compare);
  }

////
// Output a form radio field
  function owpRadioField($name, $value = '', $checked = false, $compare = '') {
    return owpSelectionField($name, 'radio', $value, $checked, $compare);
  }

////
// Output a form textarea field
  function owpTextareaField($name, $wrap, $width, $height, $text = '', $params = '', $reinsert_value = true) {
    $field = '<textarea name="' . $name . '" wrap="' . $wrap . '" cols="' . $width . '" rows="' . $height . '"';
    if ($params) $field .= ' ' . $params;
    $field .= '>';
    if ( ($GLOBALS[$name]) && ($reinsert_value) ) {
      $field .= $GLOBALS[$name];
    } elseif ($text != '') {
      $field .= $text;
    }
    $field .= '</textarea>';

    return $field;
  }

////
// Output a form hidden field
  function owpDrawHiddenField($name, $value = '') {
    $field = '<input type="hidden" name="' . $name . '" value="';
    if ($value != '') {
      $field .= trim($value);
    } else {
      $field .= trim($GLOBALS[$name]);
    }
    $field .= '">';

    return $field;
  }

////
// Output a form pull down menu
  function owpPullDownMenu($name, $values, $default = '', $params = '', $required = false) {
    $field = '<select name="' . $name . '"';
    if ($params) $field .= ' ' . $params;
    $field .= '>';
    for ($i=0; $i<sizeof($values); $i++) {
      $field .= '<option value="' . $values[$i]['id'] . '"';
      if ( ((strlen($values[$i]['id']) > 0) && ($GLOBALS[$name] == $values[$i]['id'])) || ($default == $values[$i]['id']) ) {
        $field .= ' SELECTED';
      }
      $field .= '>' . $values[$i]['text'] . '</option>';
    }
    $field .= '</select>';

    if ($required) $field .= TEXT_FIELD_REQUIRED;

    return $field;
  }
  
  /**
   * owpImage : liefert image mit tags zurück
   *  
   * @author     r23
   * @version    1.0
   * @param      $src   	Bildname
   * @param      $alt   	Bild Tag
   * @param      width  	Breite des Bildes, wenn nicht vergeben
   *		      	wird die Breite errechnet
   * @param      $height 	Höhe des Bildes, wenn nicht vergeben
   *		      	wird die Höhe errechnet
   * @param      $parameters 	für sonstige html parameter 
   * @return     <img src=bildname width height border=0 alt=[text] />
   */
   function owpImage($src, $alt = '', $width = '', $height = '', $parameters = '') {    
     if ( (($src == '') || ($src == OWP_IMAGES_DIR)) && (OWP_IMAGE_REQUIRED == 'false') ) {
       return '';
     }  
     $image = '<img src="' . $src . '"';   
     if ( (CONFIG_CALCULATE_IMAGE_SIZE == 'true') && ((!$width) || (!$height)) ) {
       if ($image_size = @getimagesize($src)) {
         if ( (!$width) && ($height) ) {
           $ratio = $height / $image_size[1];
           $width = $image_size[0] * $ratio;
         } elseif ( ($width) && (!$height) ) {
           $ratio = $width / $image_size[0];
           $height = $image_size[1] * $ratio;
         } elseif ( (!$width) && (!$height) ) {
           $width = $image_size[0];
           $height = $image_size[1];
         }
       } elseif (OWP_IMAGE_REQUIRED == 'false') {
         return false;
       }
     }
  
     if ( ($width) && ($height) ) {
       $image .= ' width="' . $width . '" height="' . $height . '"';
     }
  
     if ($parameters != '') {
       $image .= ' ' . $parameters;
     }
  
     if ($alt == '') {
       $image .= ' border="0" alt=" "';
     } else {
       $image .= ' border="0" alt="[ ' . htmlspecialchars($alt) . ' ]" title=" ' . htmlspecialchars($alt) . ' "';
     }
     
     if (LAYOUT_XHTML == 'true') {
       $image .= ' /';
     }
       $image .= '>';
  
     return $image;
   }

  /**
   *  owpTransLine : liefert eine transparente grafik bei aufruf
   *                 ohne parameter mit width = 100% und height= 1 zurück
   *  
   * @author     r23
   * @version    1.0
   * @param      $width, $height, $image
   * @return     ruft die funktion owpImage auf 
   * @return     <img src="images/trans.gif" width="1" height="1" alt=" " />
   */
   function owpTransLine($width = '1', $height = '1', $image = 'trans.gif') {
     return owpImage(OWP_IMAGES_DIR . $image, '', $width, $height);
   }
?>
