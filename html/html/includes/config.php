<?php
/* ----------------------------------------------------------------------
   $Id: config.php,v 1.1 2003/03/28 03:25:28 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:

   POST-NUKE Content Management System
   Copyright (C) 2001 by the Post-Nuke Development Team.
   http://www.postnuke.com/
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  define('HTTP_SERVER', 'http://localhost'); // eg, http://localhost - should not be NULL for productive servers

  define('DIR_WS_ADODB', DIR_WS_INCLUDES . 'adodb/');
  define('ADODB_DIR', DIR_WS_ADODB);

  $owconfig['dbtype'] = 'mysql';
  $owconfig['dbhost'] = 'localhost';
  $owconfig['dbuname'] = '';
  $owconfig['dbpass'] = '';
  $owconfig['dbname'] = '';
  $owconfig['system'] = '';
  $owconfig['prefix'] = '';
  $owconfig['encoded'] = '';
?>