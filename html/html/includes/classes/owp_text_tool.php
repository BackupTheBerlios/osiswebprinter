<?php
/* ----------------------------------------------------------------------
   $Id: owp_text_tool.php,v 1.1 2003/04/22 07:14:52 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  class owTextTool {
    function &nrFormat($number) {
      if (($number < 10) && (substr($number, 0, 1) != '0')) $number = '0' . $number;

      return $number;
    }

    function &nl2br($string, $xhtml = false) {
      if ($xhtml == true) {
        return ereg_replace("\n","<br />\n",$string);
      } else {
        return ereg_replace("\n","<br>\n",$string);
      }
    }

    function &wrap($string, $len = '60') {
      $string = wordwrap($string, $len, "\n");
      $string = xtcTextTool::nl2br($string);
      return $string;
    }

    function &htmlchars($string) {
      return stripslashes(htmlspecialchars($string));
    }

    function &heading($string, $big = "owp-bigTitle") {
      $string = str_replace("&szlig;", 'ß', $string );     
      $string = str_replace("&ouml;", 'ö', $string);
      $string = str_replace("&auml;", 'ä', $string);
      $string = str_replace("&uuml;", 'ü', $string);
      $string = str_replace("&Ouml;", 'Ö', $string);
      $string = str_replace("&Auml;", 'Ä', $string);
      $string = str_replace("&Uuml;", 'Ü', $string);

      $string = strtoupper($string);

      for ($i=0; $i<strlen($string); $i++) {
         $string2 .= $string[$i] . " ";
      }
      $string = trim($string2);
           
      $string = preg_replace("#(  |^)([^ ])#", "\\1<span class=\"$big\">\\2</span>", $string);
      $string = str_replace ("  ", "&nbsp;&nbsp;", $string);

      return  $string;
    }
  }
?>