<?php
/*
  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project
  
  Login.php: Blake Schwendiman (blake@intechra.net) http://www.intechra.net/

  Released under the GNU General Public License
*/
  require('includes/application_top.php');

  tep_session_unregister( 'login_id' );
  header( "Location: default.php\n" );
