<?php
    include_once( DIR_WS_FUNCTIONS . 'database.php' );
    include_once( DIR_WS_FUNCTIONS . 'languages.php' );
    if ( ( !$language ) || ( $HTTP_GET_VARS['language'] ) ) 
    {
        if ( !$language ) 
        {
          tep_session_register('language');
          tep_session_register('languages_id');
        }
    
        $language = tep_get_languages_directory( $HTTP_GET_VARS['language'] );
        if ( !$language ) $language = tep_get_languages_directory( DEFAULT_LANGUAGE );
    }
    
    // include the language translations
    include_once( DIR_WS_LANGUAGES . $language . '.php' );
    
    $aADMBoxes = array ( 'administrators.php'   => BOX_HEADING_ADMINISTRATORS, 
                         'banners.php'          => BOX_HEADING_BANNERS, 
                         'catalog.php'          => BOX_HEADING_CATALOG, 
                         'configuration.php'    => BOX_HEADING_CONFIGURATION,
                         'customers.php'        => BOX_HEADING_CUSTOMERS, 
                         'localization.php'     => BOX_HEADING_LOCALIZATION,
												 'taxes.php'            => BOX_HEADING_LOCATION_AND_TAXES, 
                         'modules.php'          => BOX_HEADING_MODULES, 
                         'reports.php'          => BOX_HEADING_REPORTS,
                         'tools.php'            => BOX_HEADING_TOOLS,
                         );
                      
    // associate all the admin pages with the box class that includes it                      
    $aADMPages = array( 'configuration.php'            => 'configuration.php',
                        'default.php'                  => '*',
                        'categories.php'               => '*',
                        'modules.php'                  => 'modules.php',
                        'products_attributes.php'      => 'catalog.php',
                        'manufacturers.php'            => 'catalog.php',
                        'reviews.php'                  => 'catalog.php',
                        'specials.php'                 => 'catalog.php', 
                        'products_expected.php'        => 'catalog.php',
                        'customers.php'                => 'customers.php',
                        'orders.php'                   => 'customers.php',
                        'countries.php'                => 'taxes.php',
                        'zones.php'                    => 'taxes.php',
                        'geo_zones.php'                => 'taxes.php',
                        'tax_classes.php'              => 'taxes.php',
                        'tax_rates.php'                => 'taxes.php',
                        'banner_manager.php'           => 'banners.php',
                        'currencies.php'               => 'localization.php',
                        'languages.php'                => 'localization.php',
                        'orders_status.php'            => 'localization.php',
                        'stats_products_viewed.php'    => 'reports.php',
                        'stats_products_purchased.php' => 'reports.php',
                        'stats_customers.php'          => 'reports.php',
                        'file_manager.php'             => 'tools.php',
                        'backup.php'                   => 'tools.php',
                        'whos_online.php'              => 'tools.php',
                        'cache.php'                    => 'tools.php',
                        'mail.php'                     => 'mail.php',
                        'administrators.php'           => 'administrators.php',
                     );                    
    
    // check to see if php implemented session management functions - if not, include php3/php4 compatible session class
    if ( !function_exists( 'session_start' ) ) 
    {
        include_once( DIR_WS_CLASSES . 'sessions.php' );
    }

    // include mysql session storage handler
    if ( STORE_SESSIONS == 'mysql' ) 
    {
        include( DIR_WS_FUNCTIONS . 'sessions_mysql.php' );
    }
    
    function RequireLoginValidForPage( $aRetPage )
    {
        global $PHP_SELF, $in_login, $login_id, $aADMPages;
        
        $aThisPage = basename( $PHP_SELF );
        //print( "$login_id<br>" );
        $aRetPage  = str_replace( $aThisPage, 'default.php', $aRetPage );
        
        if ( empty( $in_login ) )
        {
            if ( !tep_session_is_registered( 'login_id' ) ) 
            {
                header( 'Location: login.php?in_login=yes&retpage=' . urlencode( $aRetPage ) . "\n" );
            }
            else
            {
                $aSQL = "select allowed_pages from administrators where ( administrator_id = '$login_id' )";
                $aRes = tep_db_query( $aSQL );
                if ( $aVal = tep_db_fetch_array( $aRes ) )
                {
                    $aPages = $aVal['allowed_pages'];
                    if ( trim( $aPages != '*' ) )
                    {
                        $aAllowedPages   = explode( '|', $aPages );
                        $aCurrentPageBox = $aADMPages[$aThisPage];
                        //print( "$aThisPage, $aCurrentPageBox<br>" ); 
                        if ( $aCurrentPageBox != '*' )
                        {
                            if ( !in_array( $aCurrentPageBox, $aAllowedPages ) )
                            {
                                header( 'Location: login.php?' . urlencode( $aRetPage ) . "\n" );
                            }
                        }
                    }
                }
            }
        }
    }
    
    function CanShowBox( $aBoxName )
    {
        global $login_id;
        //print( "CanShowBox( $aBoxName )<br>" );
        $aSQL = "select allowed_pages from administrators where ( administrator_id = '$login_id' )";
        $aRes = tep_db_query( $aSQL );
        if ( $aVal = tep_db_fetch_array( $aRes ) )
        {
            $aPages = $aVal['allowed_pages'];
            if ( trim( $aPages != '*' ) )
            {
                $aAllowedPages   = explode( '|', $aPages );
                $aCurrentPageBox = $aBoxName;
                if ( in_array( $aCurrentPageBox, $aAllowedPages ) )
                {
                    return true;
                }
            }
            else
            {
                return true;
            }
        }
        
        return false;
    }
?>