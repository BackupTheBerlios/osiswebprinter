<?php
/* ----------------------------------------------------------------------
   $Id: config.php,v 1.3 2003/04/20 06:45:10 r23 Exp $

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
  
  define('OWP_IMAGES_DIR', 'images/');
  define('OWP_ICONS_DIR', OWP_IMAGES_DIR . 'icons/');
  
  define('OWP_INCLUDES_DIR', 'includes/'); 
  define('OWP_BOXES_DIR', OWP_INCLUDES_DIR . 'boxes/');
  define('OWP_CLASSES_DIR', OWP_INCLUDES_DIR . 'classes/');
  define('OWP_FUNCTIONS_DIR', OWP_INCLUDES_DIR . 'functions/');
  define('OWP_LANGUAGES_DIR', OWP_INCLUDES_DIR . 'language/');
  define('OWP_MODULES_DIR', OWP_INCLUDES_DIR . 'modules/');

  define('OWP_ADODB_DIR', OWP_INCLUDES_DIR . 'adodb/');
  define('OWP_MAILER_DIR', OWP_INCLUDES_DIR . 'phpmailer/');
  define('OWP_PDF_DIR', OWP_INCLUDES_DIR . 'pfd/');

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