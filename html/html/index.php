<?php
/* ----------------------------------------------------------------------
   $Id: index.php,v 1.15 2003/05/06 13:28:28 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: index.php,v 1.15 2002/10/29 22:31:25 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  require('includes/system.php');
  
  require(OWP_LANGUAGES_DIR . $language . '/' . $owpFilename['index']);

  $cat = array(array('title' => BOX_HEADING_CONFIGURATION,
                     'image' => 'configuration.gif',
                     'href' => owpLink(FILENAME_CONFIGURATION, 'SELECTed_box=configuration&gID=1'),
                     'children' => array(array('title' => BOX_CONFIGURATION_MYSTORE, 'link' => owpLink(FILENAME_CONFIGURATION, 'SELECTed_box=configuration&gID=1')),
                                         array('title' => BOX_CONFIGURATION_LOGGING, 'link' => owpLink(FILENAME_CONFIGURATION, 'SELECTed_box=configuration&gID=10')),
                                         array('title' => BOX_CONFIGURATION_CACHE, 'link' => owpLink(FILENAME_CONFIGURATION, 'SELECTed_box=configuration&gID=11')))),
               array('title' => BOX_HEADING_LOCALIZATION,
                     'image' => 'localization.gif',
                     'href' => owpLink(FILENAME_CURRENCIES, 'SELECTed_box=localization'),
                     'children' => array(array('title' => BOX_LOCALIZATION_CURRENCIES, 'link' => owpLink(FILENAME_CURRENCIES, 'SELECTed_box=localization')),
                                         array('title' => BOX_LOCALIZATION_LANGUAGES, 'link' => owpLink($owpFilename['languages'], 'SELECTed_box=localization')))),
               array('title' => BOX_HEADING_REPORTS,
                     'image' => 'reports.gif',
                     'href' => owpLink(FILENAME_STATS_PRODUCTS_PURCHASED, 'SELECTed_box=reports'),
                     'children' => array(array('title' => REPORTS_PRODUCTS, 'link' => owpLink(FILENAME_STATS_PRODUCTS_PURCHASED, 'SELECTed_box=reports')),
                                         array('title' => REPORTS_ORDERS, 'link' => owpLink(FILENAME_STATS_CUSTOMERS, 'SELECTed_box=reports')))),
               array('title' => BOX_HEADING_TOOLS,
                     'image' => 'tools.gif',
                     'href' => owpLink($owpFilename['backup'], 'SELECTed_box=tools'),
                     'children' => array(array('title' => TOOLS_BACKUP, 'link' => owpLink($owpFilename['backup'], 'SELECTed_box=tools')),
                                         array('title' => TOOLS_BANNERS, 'link' => owpLink(FILENAME_BANNER_MANAGER, 'SELECTed_box=tools')),
                                         array('title' => TOOLS_FILES, 'link' => owpLink($owpFilename['file_manager'], 'SELECTed_box=tools')))));

  $languages = owpGetLanguages();
  $languages_array = array();
  for ($i=0; $i<sizeof($languages); $i++) {
    $languages_array[] = array('id' => $languages[$i]['code'],
                               'text' => $languages[$i]['name']);
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
<style type="text/css"><!--
a { color:#080381; text-decoration:none; }
a:hover { color:#aabbdd; text-decoration:underline; }
a.text:link, a.text:visited { color: #000000; text-decoration: none; }
a:text:hover { color: #000000; text-decoration: underline; }
a.main:link, a.main:visited { color: #ffffff; text-decoration: none; }
A.main:hover { color: #ffffff; text-decoration: underline; }
a.sub:link, a.sub:visited { color: #dddddd; text-decoration: none; }
A.sub:hover { color: #dddddd; text-decoration: underline; }
.heading { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px; font-weight: bold; line-height: 1.5; color: #D3DBFF; }
.main { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 17px; font-weight: bold; line-height: 1.5; color: #ffffff; }
.sub { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; line-height: 1.5; color: #dddddd; }
.text { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; line-height: 1.5; color: #000000; }
.menuBoxHeading { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #ffffff; font-weight: bold; background-color: #7187bb; border-color: #7187bb; border-style: solid; border-width: 1px; }
.infoBox { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #080381; background-color: #f2f4ff; border-color: #7187bb; border-style: solid; border-width: 1px; }
.smallText { font-family: Verdana, Arial, sans-serif; font-size: 10px; }
//--></style>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#F6F7EB">
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#F6F7EB" width="100%">
  <tr>
    <td align="left" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td valign="top" align="left"><a href="index.php"><?php echo owpTextTool::heading(OWP_NAME); ?></a></td>
        <td width="50%" valign="top" align="right"><br />&nbsp;&nbsp;<font class="owp-date"><?php echo strftime(DATE_FORMAT_LONG); ?></font>&nbsp;&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#000000"><?php echo owpTransLine(); ?></td>
  </tr>
  <tr>
    <td bgcolor="#E1E4CE" align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td align="right" valign="middle"><span class="owp-sub">
         <a href="http://developer.berlios.de/projects/osiswebprinter/" target="_blank"><?php echo DEVELOPER_SITE; ?></a>&nbsp;::&nbsp;
	 <a href="http://developer.berlios.de/forum/?group_id=752" target="_blank"><?php echo SUPPORT_FORUMS; ?></a>&nbsp;::&nbsp;
	 <a href="https://lists.berlios.de/mailman/listinfo/osiswebprinter-users" target="_blank"><?php echo MAILING_LISTS; ?></a>&nbsp;
	 </span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#000000"><?php echo owpTransLine(); ?></td>
  </tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#F6F7EB" width="100%">
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="0" bgcolor="#F6F7EB" width="80%">
  <tr>
    <td><?php echo owpTransLine('1', '390'); ?></td> 
    <td align="left" valign="top"><table border="0" width="140" height="390" cellspacing="0" cellpadding="2">
          <tr>
            <td valign="top"><br>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('params' => 'class="menuBoxHeading"',
                     'text'  => 'OSIS Web Printer');

  $contents[] = array('params' => 'class="infoBox"',
                      'text'  => '<a href="http://www.oscommerce.com" target="_blank">' . BOX_ENTRY_SUPPORT_SITE . '</a><br>' .
                                 '<a href="http://www.oscommerce.com/community.php/forum" target="_blank">' . BOX_ENTRY_SUPPORT_FORUMS . '</a><br>' .
                                 '<a href="http://www.oscommerce.com/community.php/mlists" target="_blank">' . BOX_ENTRY_MAILING_LISTS . '</a><br>' .
                                 '<a href="http://www.oscommerce.com/community.php/bugs" target="_blank">' . BOX_ENTRY_BUG_REPORTS . '</a><br>' .
                                 '<a href="http://www.oscommerce.com/community.php/faq" target="_blank">' . BOX_ENTRY_FAQ . '</a><br>' .
                                 '<a href="http://www.oscommerce.com/community.php/irc" target="_blank">' . BOX_ENTRY_LIVE_DISCUSSIONS . '</a><br>' .
                                 '<a href="http://www.oscommerce.com/community.php/cvs" target="_blank">' . BOX_ENTRY_CVS_REPOSITORY . '</a><br>' .
                                 '<a href="http://www.oscommerce.com/about.php/portal" target="_blank">' . BOX_ENTRY_INFORMATION_PORTAL . '</a>');

  $box = new box;
  echo $box->menuBox($heading, $contents);


  echo '<br>';

 # $customers_query = tep_db_query("SELECT count(*) as count FROM " . $owpDBTable['administrators']);
 # $customers = tep_db_fetch_array($customers_query);
 # $products_query = tep_db_query("SELECT count(*) as count FROM " . $owpDBTable['administrators'] . " WHERE products_status = '1'");
 # $products = tep_db_fetch_array($products_query);
 # $reviews_query = tep_db_query("SELECT count(*) as count FROM " . $owpDBTable['administrators']);
 # $reviews = tep_db_fetch_array($reviews_query);

  $heading = array();
  $contents = array();

  $heading[] = array('params' => 'class="menuBoxHeading"',
                     'text'  => BOX_TITLE_STATISTICS);

  $contents[] = array('params' => 'class="infoBox"',
                      'text'  => BOX_ENTRY_CUSTOMERS . ' ' . $customers['count'] . '<br>' .
                                 BOX_ENTRY_PRODUCTS . ' ' . $products['count'] . '<br>' .
                                 BOX_ENTRY_REVIEWS . ' ' . $reviews['count']);

  $box = new box;
  echo $box->menuBox($heading, $contents);

  echo '<br>';

  $contents = array();

  if (getenv('HTTPS') == 'on') {
    $size = ((getenv('SSL_CIPHER_ALGKEYSIZE')) ? getenv('SSL_CIPHER_ALGKEYSIZE') . '-bit' : '<i>' . BOX_CONNECTION_UNKNOWN . '</i>');
    $contents[] = array('params' => 'class="infoBox"',
                        'text' => owpImage(OWP_ICONS_DIR . 'locked.gif', ICON_LOCKED, '', '', 'align="right"') . sprintf(BOX_CONNECTION_PROTECTED, $size));
  } else {
    $contents[] = array('params' => 'class="infoBox"',
                        'text' => owpImage(OWP_ICONS_DIR . 'unlocked.gif', ICON_UNLOCKED, '', '', 'align="right"') . BOX_CONNECTION_UNPROTECTED);
  }

  $box = new box;
  echo $box->tableBlock($contents);
?>
                    </td>
                  </tr>
                </table></td>
                <td width="460"><table border="0" width="460" height="390" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                      <tr><?php echo owpDrawForm('languages', 'index.php', '', 'get'); ?>
                        <td class="heading"><?php echo HEADING_TITLE; ?></td>
                        <td align="right"><?php echo owpPullDownMenu('language', $languages_array, ($_GET['language'] ? $_GET['language'] : DEFAULT_LANGUAGE), 'onChange="this.form.submit();"'); ?></td>
                      </form></tr>
                    </table></td>
                  </tr>
<?php
  $col = 2;
  $counter = 0;
  for ($i=0; $i<sizeof($cat); $i++) {
    $counter++;
    if ($counter < $col) {
      echo '                  <tr>' . "\n";
    }

    echo '                    <td><table border="0" cellspacing="0" cellpadding="2">' . "\n" .
         '                      <tr>' . "\n" .
         '                        <td><a href="' . $cat[$i]['href'] . '">' . owpImage(OWP_INCLUDES_DIR . 'categories/' . $cat[$i]['image'], $cat[$i]['title'], '32', '32') . '</a></td>' . "\n" .
         '                        <td><table border="0" cellspacing="0" cellpadding="2">' . "\n" .
         '                          <tr>' . "\n" .
         '                            <td class="main"><a href="' . $cat[$i]['href'] . '" class="main">' . $cat[$i]['title'] . '</a></td>' . "\n" .
         '                          </tr>' . "\n" .
         '                          <tr>' . "\n" .
         '                            <td class="sub">';

    $children = '';
    for ($j=0; $j<sizeof($cat[$i]['children']); $j++) {
      $children .= '<a href="' . $cat[$i]['children'][$j]['link'] . '" class="sub">' . $cat[$i]['children'][$j]['title'] . '</a>, ';
    }
    echo substr($children, 0, -2);

    echo '</td> ' . "\n" .
         '                          </tr>' . "\n" .
         '                        </table></td>' . "\n" .
         '                      </tr>' . "\n" .
         '                    </table></td>' . "\n";

    if ($counter >= $col) {
      echo '                  </tr>' . "\n";
      $counter = 0;
    }
  }
?>
                </table></td>
              </tr>
            </table></td>
           </tr>
          </table>
<!-- footer //-->
<?php require(OWP_INCLUDES_DIR . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(OWP_INCLUDES_DIR . 'nice_exit.php'); ?>