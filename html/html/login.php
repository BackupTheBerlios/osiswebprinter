<?php
/* ----------------------------------------------------------------------
   $Id: login.php,v 1.2 2003/04/22 07:17:24 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:

   Login and Logoff for osCommerce Administrators.

   Original Version by Blake Schwendiman
   blake@intechra.net

   Updated Version 1.1.0 (03/01/2002) by Christopher Conkie
   chris@conkiec.freeserve.co.uk

   This is a new admin module for osCommerce pr2.2 that allows 
   for login/logoff from the admin section of TEP.
   This way only valid administrators can access your site and in 
   varying degrees.

   This module is built around osCommerce CVS pr2.2 snapshot 02/01/2002
   ----------------------------------------------------------------------  
   The Exchange Project - Community Made Shopping!
   http://www.theexchangeproject.org

   Copyright (c) 2000,2001 The Exchange Project
  
   Login.php: Blake Schwendiman (blake@intechra.net)
   http://www.intechra.net/
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------   
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  require('includes/application_top.php');

  //print( "$Submit<br>" );
  if ( !empty( $Submit ) )
  {
    $aSQL    = "select administrator_id from " . TABLE_ADMINISTRATORS . " where ( username = '$username' ) and ( password = '$password' )";
    $aResult = tep_db_query( $aSQL );  
    $aCount  = tep_db_num_rows( $aResult );
    //print( $aCount );
    if ( $aCount > 0 )
    {
        $aResult  = tep_db_fetch_array( $aResult );
        tep_session_unregister( 'login_id' );
        tep_session_register( 'login_id' );
        $login_id = $aResult['administrator_id'];
        //print( 'here' );
        header( "Location: $retpage\n" );
        exit;
    }
    else
    {
        $login_error = TEXT_LOGIN_ERROR;
    }
  }

?>
<html>
<head>
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>

</head>
<body onload="SetFocus();">

<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="5" cellpadding="5">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
        </table></td>
      </tr>
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2" class="topBarTitle">
          <tr>
            <td class="topBarTitle">&nbsp;<?php echo TOP_BAR_TITLE; ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">&nbsp;<?php echo HEADING_TITLE; ?>&nbsp;</td>
            <td align="right">&nbsp;<?php echo tep_image(DIR_WS_CATALOG . 'images/pixel_trans.gif', '', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="5"><?php echo tep_black_line(); ?></td>
          </tr>
          <tr>
            <td colspan="5">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="5">
            <form action="<?php echo $PHP_SELF; ?>" method="post">
                <table>
                    <tr>
                        <td class="main">
                            <?php echo TEXT_INFO_USER_NAME; ?>&nbsp;
                        </td>
                        <td>    
                            <input type="text" name="username">
                        </td>
                    </tr>
                    <tr>
                        <td class="main">
                            <?php echo TEXT_INFO_PASSWORD; ?>&nbsp;
                        </td>
                        <td>    
                            <input type="password" name="password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="retpage" value="<?php echo $retpage; ?>">
                            <input type="submit" name="Submit" value="Login">
                        </td>
                    </tr>
                </table>
            </form>
            </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>