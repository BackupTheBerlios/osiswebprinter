<?php
/* ----------------------------------------------------------------------
   $Id: owp_administrators.php,v 1.3 2003/05/03 15:58:30 r23 Exp $

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
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */
    
    $aADMBoxes = array ( 'owp_administrators.php'   => BOX_HEADING_ADMINISTRATORS, 
                         'owp_configuration.php'    => BOX_HEADING_CONFIGURATION,
                         'owp_countries.php'        => BOX_HEADING_LOCALIZATION,
			 'owp_localization.php'     => BOX_HEADING_LANGUAGES, 
                         'owp_tools.php'            => BOX_HEADING_TOOLS,
                         );
                     
    // associate all the admin pages with the box class that includes it                      
    $aADMPages = array( $owpFilename['configuration']   => 'owp_configuration.php',
                        $owpFilename['countries']       => 'owp_countries.php',
                        $owpFilename['zones']           => 'owp_countries.php',
                        $owpFilename['define_language'] => 'owp_localization.php',
                        $owpFilename['languages']       => 'owp_localization.php',
                        $owpFilename['backup']          => 'owp_tools.php',
                        $owpFilename['file_manager']    => 'owp_tools.php',
                        $owpFilename['mail']            => 'owp_tools.php',
                        $owpFilename['newsletters']     => 'owp_tools.php',
                        $owpFilename['server_info']     => 'owp_tools.php',
                        $owpFilename['whos_online']     => 'owp_tools.php',
                        $owpFilename['administrators']  => 'owp_administrators.php',
                     );                    
    

    function RequireLoginValidForPage( $aRetPage ) {
        global $PHP_SELF, $in_login, $login_id, $aADMPages;
        
        $aThisPage = basename( $PHP_SELF );
        //print( "$login_id<br>" );
        $aRetPage  = str_replace( $aThisPage, 'default.php', $aRetPage );
        
        if ( empty( $in_login ) ) {
            if ( !tep_session_is_registered( 'login_id' ) ) {
                header( 'Location: login.php?in_login=yes&retpage=' . urlencode( $aRetPage ) . "\n" );
            } else {
                $aSQL = "select allowed_pages from administrators where ( administrator_id = '$login_id' )";
                $aRes = tep_db_query( $aSQL );
                if ( $aVal = tep_db_fetch_array( $aRes ) )  {
                    $aPages = $aVal['allowed_pages'];
                    if ( trim( $aPages != '*' ) ) {
                        $aAllowedPages   = explode( '|', $aPages );
                        $aCurrentPageBox = $aADMPages[$aThisPage];
                        //print( "$aThisPage, $aCurrentPageBox<br>" ); 
                        if ( $aCurrentPageBox != '*' ) {
                            if ( !in_array( $aCurrentPageBox, $aAllowedPages ) )  {
                                header( 'Location: login.php?' . urlencode( $aRetPage ) . "\n" );
                            }
                        }
                    }
                }
            }
        }
    }
    
    function CanShowBox( $aBoxName )  {
        global $login_id;
        //print( "CanShowBox( $aBoxName )<br>" );
        $aSQL = "select allowed_pages from administrators where ( administrator_id = '$login_id' )";
        $aRes = tep_db_query( $aSQL );
        if ( $aVal = tep_db_fetch_array( $aRes ) ) {
            $aPages = $aVal['allowed_pages'];
            if ( trim( $aPages != '*' ) )  {
                $aAllowedPages   = explode( '|', $aPages );
                $aCurrentPageBox = $aBoxName;
                if ( in_array( $aCurrentPageBox, $aAllowedPages ) ) {
                    return true;
                }
            } else {
                return true;
            }
        }
        
        return false;
    }
?>