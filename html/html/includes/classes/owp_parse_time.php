<?php
/* ----------------------------------------------------------------------
   $Id: owp_parse_time.php,v 1.1 2003/04/19 21:32:40 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */
   
  class owpParseTime {
    var $StartTime;
    var $StopTime;  
 
    function owpParseTime() {
    }

    function start() {
      $this->StartTime = microtime();
    }

    function stop() {
      $this->StopTime = microtime();
    }

    function parseTime() {
      $timeStart = explode(" ", $this->StartTime);
      $timeStop = explode(" ", $this->StopTime);

      $Start = $timeStart[1] + $timeStart[0];
      $Stop = $timeStop[1] + $timeStop[0];
        
      $parseTime = $Stop - $Start;
      $parseTime = number_format(($parseTime), 3);      
      
      return $parseTime;
    }
    
    function echoParseTime($log = false) {
      $parseTime = $this->parseTime();
      if ($log == false){
        print("\n<!-- Parse Time: " .  $parseTime . " sec. -->\n");
        #echo 'Parse Time :' . $parseTime . ' sec.';
      } else {
        error_log(strftime(STORE_PARSE_DATE_TIME_FORMAT) . ' - ' . getenv('REQUEST_URI') . ' (' . $parse_time . ' sec)' . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
      }
    }
  }
?>