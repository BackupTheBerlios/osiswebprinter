<?php
/* ----------------------------------------------------------------------
   $Id: administrators.php,v 1.2 2003/04/22 07:16:46 r23 Exp $

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
  
   Implemented by Blake Schwendiman (blake@intechra.net)

   Copyright (c) 2000,2001 The Exchange Project
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  require('includes/application_top.php');

  $aErrors = '';
  if ( $REQUEST_METHOD == 'POST' ) 
  {
      if ( !empty( $username ) )
      {
        if ( ( $password == $confpwd ) && ( trim( $password ) != '' ) )
        {
            //var_dump( $HTTP_POST_VARS );
            
            if ( $adm_type == 'all' )
            {
                $aSQL = "insert into " . TABLE_ADMINISTRATORS . " ( username, password, allowed_pages ) values ( '$username', '$password', '*' )";
            }
            else
            {
                $aPages = implode( '|', $adm_pages ); 
                $aSQL = "insert into " . TABLE_ADMINISTRATORS . " ( username, password, allowed_pages ) values ( '$username', '$password', '$aPages' )";
            }
            tep_db_query( $aSQL );
        }
        else
        {
            $aErrors = TEXT_PWD_ERROR;
        }
      }
      else
      {
        $aErrors = TEXT_UNAME_ERROR;
      }
  } 
  
  if ( $action == 'delete' )
  {
    $aSQL = "delete from " . TABLE_ADMINISTRATORS . " where ( administrator_id = '$admin_id' )";
    tep_db_query( $aSQL );
  }
?>
<html>
<head>
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body>
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
            <td align="right">&nbsp;<?php echo tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td><?php echo tep_black_line(); ?></td>
          </tr>
          <tr class="subBar">
            <td class="subBar">&nbsp;<?php echo SUB_BAR_TITLE; ?>&nbsp;</td>
          </tr>
          <tr>
            <td><?php echo tep_black_line(); ?></td>
          </tr>
          <tr>
            <td>
                <?php print( $aErrors ); ?>
                <table>
                    <tr>
                        <td width="10">
                            &nbsp;
                        </td>
                        <td colspan="2" class="infoBoxHeading">
                            <?php print( TEXT_CURRENT_ADMINISTRATORS ); ?>
                        </td>
                        <td class="infoBoxHeading">
                            <?php print( TEXT_ADMIN_HAS_ACCESS_TO ); ?>
                        </td>
                    </tr>
                    <?php
                        $aResult  = tep_db_query( 'select * from ' . TABLE_ADMINISTRATORS );
                        $aNumRows = tep_db_num_rows( $aResult );
                        
                        if ( $aNumRows > 0 )
                        {
                            while( $aData = tep_db_fetch_array( $aResult ) )
                            {
                                $aUserID   = $aData['username'];
                                $aAdminID  = $aData['administrator_id'];
                                $aAccessTo = $aData['allowed_pages'];
                                
                                if ( trim( $aAccessTo ) == '*' )
                                {
                                    $aTextAccessTo = TEXT_FULL_ACCESS;
                                }
                                else
                                {
                                    $aTextAccessTo = '';
                                    $aAccessPages = explode( '|', $aAccessTo );
                                    foreach( $aAccessPages as $aPage )
                                    {
                                        $aTextAccessTo .= $aADMBoxes[$aPage] . ', ';
                                    }
                                    $aTextAccessTo = substr( $aTextAccessTo, 0, strlen( $aTextAccessTo ) - 2 );
                                }
                                ?>
                                    <tr>
                                        <td>
                                            &nbsp;
                                        </td>
                                        <td class="main">
                                            <a href="<?php print( $PHP_SELF ); ?>?action=delete&admin_id=<?php print( $aAdminID ); ?>" class="bluelink"><?php print( TEXT_ADMIN_DELETE ); ?></a>
                                        </td>
                                        <td class="main">
                                            <?php echo $aUserID; ?>
                                        </td>
                                        <td class="main">
                                            <?php print( $aTextAccessTo ); ?>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                        else
                        {
                        ?>
                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                                <td colspan="2" class="main">
                                    <?php print( TEXT_NO_CURRENT_ADMINS ); ?>
                                </td>
                            </tr>
                        <?php
                        }
                    ?>
                </table>
            </td>
          </tr>
          <tr>
            <td>
                <?php echo tep_black_line(); ?>
            </td>
          </tr>
          <tr>
            <td>
                <table>
                    <form action="<?php print( $PHP_SELF ); ?>" method="post">
                    <tr>
                        <td width="10">
                            &nbsp;
                        </td>
                        <td colspan="2" class="infoBoxHeading">
                            <?php print( TEXT_ADD_ADMINISTRATOR ); ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="10">
                            &nbsp;
                        </td>
                        <td class="infoBoxHeading" valign="top">
                            <table>
                                <tr>
                                    <td class="main">
                                        <?php print( TEXT_ADMINISTRATOR_USERNAME ); ?>
                                    </td>
                                    <td>
                                        <input type="text" name="username" maxlength="20">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="main">
                                        <?php print( TEXT_ADMINISTRATOR_PASSWORD ); ?>
                                    </td>
                                    <td>
                                        <input type="password" name="password" maxlength="20">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="main">
                                        <?php print( TEXT_ADMINISTRATOR_CONFPWD ); ?>
                                    </td>
                                    <td>
                                        <input type="password" name="confpwd" maxlength="20">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td valign="top">
                            <table>
                                <tr>
                                    <td>
                                        <input type="radio" name="adm_type" value="all">
                                    </td>
                                    <td class="main">
                                        <?php print( TEXT_FULL_ACCESS ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <input type="radio" name="adm_type" value="not_all" checked>
                                    </td>
                                    <td class="main">
                                        <?php print( TEXT_PARTIAL_ACCESS ); ?><br><br>
                                        <select name="adm_pages[]" size="<?php print( count( $aADMBoxes ) ); ?>" multiple>
                                        <?php
                                            foreach( $aADMBoxes as $aKey => $aValue )
                                            {
                                                print( "<option value=\"$aKey\">$aValue</option>" );
                                            }
                                        ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td width="10">
                            &nbsp;
                        </td>
                        <td colspan="2" class="infoBoxHeading">
                            <input type="submit" name="Submit" value="<?php print( TEXT_ADMIN_SAVE ); ?>">
                        </td>
                    </tr>
                    </form>
                </table>
            </td>
          </tr>
<!-- body_text_eof //-->
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<!-- body_eof //-->
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>