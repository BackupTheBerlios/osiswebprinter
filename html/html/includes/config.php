<?php
/* ----------------------------------------------------------------------
   $Id: config.php,v 1.2 2003/04/02 02:03:32 r23 Exp $

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

// OWP Virtual Path (URL)
// Virtual path to your main OWP directory WITHOUT trailing slash
  define('OWP_HTTP_SERVER', 'http://url_to_owp_directory');

// OWP Physical Path
// Physical path to your main OWP directory WITHOUT trailing slash
  define('OWP_ROOT_PATH', '/path/to/owp/directory');

// define our database connection
  define('OWP_DB_TYPE', '');
  define('OWP_DB_SERVER', '');
  define('OWP_DB_USERNAME', '');
  define('OWP_DB_PASSWORD', '');
  define('OWP_DB_DATABASE', '');
  define('OWP_DB_PREFIX', '');
  define('OWP_ENCODED', '');
  define('OWP_SYSTEM', '');

?>