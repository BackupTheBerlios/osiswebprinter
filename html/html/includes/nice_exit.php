<?php
/* ----------------------------------------------------------------------
   $Id: nice_exit.php,v 1.2 2003/05/02 09:50:50 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  session_close;

// db close

 $owpTimeUtil->stop();
 $owpTimeUtil->echoParseTime();

?>