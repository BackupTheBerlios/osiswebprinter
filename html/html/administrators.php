<?php
/* ----------------------------------------------------------------------
   $Id: administrators.php,v 1.6 2003/05/02 09:48:04 r23 Exp $

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

  require('includes/system.php');

/*  
  if (!isset($_SESSION['user_id'])) {
    $_SESSION['navigation']->set_snapshot();
    owpRedirect(owpLink($owpFilename['login'], '', 'SSL'));
  } 
*/
  require(OWP_LANGUAGES_DIR . $language . '/' . $owpFilename['administrators']);


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
    $aSQL = "delete FROM " . TABLE_ADMINISTRATORS . " WHERE ( administrator_id = '$admin_id' )";
    tep_db_query( $aSQL );
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo OWP_NAME . ' :: ' . TITLE; ?></title>
<META NAME="AUTHOR" CONTENT="OSIS GmbH">
<META NAME="GENERATOR" CONTENT="OSIS GmbH -- http://www.osisnet.de">
<META NAME="ROBOTS" content="NOFOLLOW">
<link rel="StyleSheet" href="style/style.css" type="text/css" />
<script type="text/javascript" src="javascript/general.php"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onload="SetFocus();">
<!-- header //-->
<?php require(OWP_INCLUDES_DIR . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(OWP_INCLUDES_DIR . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td class="owp-title"><?php echo HEADING_TITLE; ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_LASTNAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_FIRSTNAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_ADMIN_HAS_ACCESS_TO; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACCOUNT_CREATED; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
    $admin_query_raw = "select admin_id, admin_gender, admin_firstname, admin_lastname, admin_email_address, admin_password, admin_allowed_pages from " . $owpDBTable['administrators'] . "  order by admin_lastname, admin_firstname";
    $admin_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $admin_query_raw, $admin_query_numrows);
    $admin_query = $db->Execute($admin_query_raw);
    while ($admin = $admin_query->fields) { 
      $sql = "SELECT admin_info_date_account_created as date_account_created, 
                     admin_info_date_account_last_modified as date_account_last_modified, 
                     admin_info_date_of_last_logon as date_last_logon, 
                     admin_info_number_of_logons as number_of_logons 
              FROM " . $owpDBTable['administrators_info'] . " 
              WHERE admin_info_id = '" . $admin['admin_id'] . "'";
      $info_query = $db->Execute($sql);
      $info = $info_query->fields;   
    
      if (((!$_GET['aID']) || (@$_GET['aID'] == $admin['admin_id'])) && (!$aInfo)) { 
        $aInfo_array = owpArrayMerge($admin, $info);
        $aInfo = new objectInfo($aInfo_array);
      }

      if ((is_object($aInfo)) && ($admin['admin_id'] == $aInfo->admin_id)) {
        echo '          <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . owpLink($owpFilename['administrators'], owpGetAllGetParameters(array('aID', 'action')) . 'aID=' . $aInfo->admin_id . '&action=edit') . '\'">' . "\n";
      } else {
        echo '          <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . owpLink($owpFilename['administrators'], owpGetAllGetParameters(array('aID')) . 'aID=' . $admin['admin_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo $admin['admin_lastname']; ?></td>
                <td class="dataTableContent"><?php echo $admin['admin_firstname']; ?></td>
                <td class="dataTableContent">
<?php
      $aAccessTo = $admin['admin_allowed_pages'];
                                      
      if ( trim( $aAccessTo ) == '*' ) {
        $aTextAccessTo = TEXT_FULL_ACCESS;
      } else {
        $aTextAccessTo = '';
        $aAccessPages = explode( '|', $aAccessTo );
        foreach( $aAccessPages as $aPage ) {
          $aTextAccessTo .= $aADMBoxes[$aPage] . ', ';
        }
        $aTextAccessTo = substr( $aTextAccessTo, 0, strlen( $aTextAccessTo ) - 2 );
      }  
      print( $aTextAccessTo );
?>
                <td class="dataTableContent" align="right"><?php echo owpDateShort($info['date_account_created']); ?></td>
                <td class="dataTableContent" align="right"><?php if ((is_object($aInfo)) && ($admin['admin_id'] == $aInfo->admin_id)) { echo owpImage(OWP_ICONS_DIR . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . owpLink($owpFilename['administrators'], owpGetAllGetParameters(array('aID')) . 'aID=' . $admin['admin_id']) . '">' . owpImage(OWP_ICONS_DIR . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
      $admin_query->MoveNext();
    }
?>
              <tr>
                <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $admin_split->display_count($admin_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_USER); ?></td>
                    <td class="smallText" align="right"><?php echo $admin_split->display_links($admin_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], owpGetAllGetParameters(array('page', 'info', 'x', 'y', 'aID'))); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();
  switch ($_GET['action']) {
    default:   
      if (is_object($aInfo)) {
        $heading[] = array('text' => '<b>' . $aInfo->admin_firstname . ' ' . $aInfo->admin_lastname . '</b>');
          
        $contents[] = array('align' => 'center', 'text' => '<a href="' . owpLink($owpFilename['administrators'], 'page=' . $_GET['page'] . '&aID=' . $aInfo->admin_id . '&action=edit') . '">' . owpImageButton('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . owpLink($owpFilename['administrators'], 'page=' . $_GET['page'] . '&aID=' . $cInfo->admin_id . '&action=delete') . '">' . owpImageButton('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('align' => 'center', 'text' => '<a href="' . owpLink($owpFilename['mail'], 'selected_box=tools&admin=' . $aInfo->admin_email_address) . '">' . owpImageButton('button_email.gif', IMAGE_EMAIL) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_DATE_ACCOUNT_CREATED . ' ' . owpDateShort($aInfo->date_account_created));
        $contents[] = array('text' => '<br>' . TEXT_DATE_ACCOUNT_LAST_MODIFIED . ' ' . owpDateShort($aInfo->date_account_last_modified));
        $contents[] = array('text' => '<br>' . TEXT_INFO_DATE_LAST_LOGON . ' '  . owpDateShort($aInfo->date_last_logon));
        $contents[] = array('text' => '<br>' . TEXT_INFO_NUMBER_OF_LOGONS . ' ' . $aInfo->number_of_logons);
      }
      break; 
  }

  if ( (owpNotNull($heading)) && (owpNotNull($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(OWP_INCLUDES_DIR . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(OWP_INCLUDES_DIR . 'nice_exit.php'); ?>
              <table>
                    <form action="<?php print( $owpSelf ); ?>" method="post">
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
                                        <SELECT name="adm_pages[]" size="<?php print( count( $aADMBoxes ) ); ?>" multiple>
                                        <?php
                                            foreach( $aADMBoxes as $aKey => $aValue )
                                            {
                                                print( "<option value=\"$aKey\">$aValue</option>" );
                                            }
                                        ?>
                                        </SELECT>
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