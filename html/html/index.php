<?php
/* ----------------------------------------------------------------------
   $Id: index.php,v 1.14 2003/04/29 06:27:17 r23 Exp $

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
  
  if (!isset($_SESSION['user_id'])) {
    $_SESSION['navigation']->set_snapshot();
    owpRedirect(owpLink($owpFilename['login'], '', 'SSL'));
  } 
   
  require(OWP_LANGUAGES_DIR . $language . '/' . $owpFilename['index']);

  $cat = array(array('title' => BOX_HEADING_CONFIGURATION,
                     'image' => 'configuration.gif',
                     'href' => owpLink(FILENAME_CONFIGURATION, 'SELECTed_box=configuration&gID=1'),
                     'children' => array(array('title' => BOX_CONFIGURATION_MYSTORE, 'link' => owpLink(FILENAME_CONFIGURATION, 'SELECTed_box=configuration&gID=1')),
                                         array('title' => BOX_CONFIGURATION_LOGGING, 'link' => owpLink(FILENAME_CONFIGURATION, 'SELECTed_box=configuration&gID=10')),
                                         array('title' => BOX_CONFIGURATION_CACHE, 'link' => owpLink(FILENAME_CONFIGURATION, 'SELECTed_box=configuration&gID=11')))),
               array('title' => BOX_HEADING_MODULES,
                     'image' => 'modules.gif',
                     'href' => owpLink(FILENAME_MODULES, 'SELECTed_box=modules&set=payment'),
                     'children' => array(array('title' => BOX_MODULES_PAYMENT, 'link' => owpLink(FILENAME_MODULES, 'SELECTed_box=modules&set=payment')),
                                         array('title' => BOX_MODULES_SHIPPING, 'link' => owpLink(FILENAME_MODULES, 'SELECTed_box=modules&set=shipping')))),
               array('title' => BOX_HEADING_CATALOG,
                     'image' => 'catalog.gif',
                     'href' => owpLink(FILENAME_CATEGORIES, 'SELECTed_box=catalog'),
                     'children' => array(array('title' => CATALOG_CONTENTS, 'link' => owpLink(FILENAME_CATEGORIES, 'SELECTed_box=catalog')),
                                         array('title' => BOX_CATALOG_MANUFACTURERS, 'link' => owpLink(FILENAME_MANUFACTURERS, 'SELECTed_box=catalog')))),
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
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">

<table border="0" width="600" height="100%" cellspacing="0" cellpadding="0" align="center" valign="middle">
  <tr>
    <td><table border="0" width="600" height="440" cellspacing="0" cellpadding="1" align="center" valign="middle">
      <tr bgcolor="#000000">
        <td><table border="0" width="600" height="440" cellspacing="0" cellpadding="0">
          <tr bgcolor="#ffffff" height="50">
            <td height="50"><?php echo owpImage(OWP_INCLUDES_DIR . 'oscommerce.gif', 'osCommerce', '204', '50'); ?></td>
            <td align="right" class="text" nowrap><?php echo '<a href="' . owpLink($owpFilename['index']) . '">' . HEADER_TITLE_ADMINISTRATION . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . tep_catalog_href_link() . '">' . HEADER_TITLE_ONLINE_CATALOG . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://www.oscommerce.com" target="_blank">' . HEADER_TITLE_SUPPORT_SITE . '</a>'; ?>&nbsp;&nbsp;</td>
          </tr>
          <tr bgcolor="#080381">
            <td colspan="2"><table border="0" width="460" height="390" cellspacing="0" cellpadding="2">
              <tr>
                <td width="140" valign="top"><table border="0" width="140" height="390" cellspacing="0" cellpadding="2">
                  <tr>
                    <td valign="top"><br>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('params' => 'class="menuBoxHeading"',
                     'text'  => 'osCommerce');

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

  $orders_contents = '';
  $orders_status_query = tep_db_query("SELECT orders_status_name, orders_status_id FROM " . TABLE_ORDERS_STATUS . " WHERE language_id = '" . $languages_id . "'");
  while ($orders_status = tep_db_fetch_array($orders_status_query)) {
    $orders_pending_query = tep_db_query("SELECT count(*) as count FROM " . TABLE_ORDERS . " WHERE orders_status = '" . $orders_status['orders_status_id'] . "'");
    $orders_pending = tep_db_fetch_array($orders_pending_query);
    $orders_contents .= '<a href="' . owpLink(FILENAME_ORDERS, 'SELECTed_box=customers&status=' . $orders_status['orders_status_id']) . '">' . $orders_status['orders_status_name'] . '</a>: ' . $orders_pending['count'] . '<br>';
  }
  $orders_contents = substr($orders_contents, 0, -4);

  $heading = array();
  $contents = array();

  $heading[] = array('params' => 'class="menuBoxHeading"',
                     'text'  => BOX_TITLE_ORDERS);

  $contents[] = array('params' => 'class="infoBox"',
                      'text'  => $orders_contents);

  $box = new box;
  echo $box->menuBox($heading, $contents);

  echo '<br>';

  $customers_query = tep_db_query("SELECT count(*) as count FROM " . TABLE_CUSTOMERS);
  $customers = tep_db_fetch_array($customers_query);
  $products_query = tep_db_query("SELECT count(*) as count FROM " . TABLE_PRODUCTS . " WHERE products_status = '1'");
  $products = tep_db_fetch_array($products_query);
  $reviews_query = tep_db_query("SELECT count(*) as count FROM " . TABLE_REVIEWS);
  $reviews = tep_db_fetch_array($reviews_query);

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
                      <tr><?php # echo# owpDrawForm('languages', 'index.php', '', 'get'); ?>
                        <td class="heading"><?php echo HEADING_TITLE; ?></td>
                        <td align="right"><?php #echo owpPullDownMenu('language', $languages_array, ($_GET['language'] ? $_GET['language'] : DEFAULT_LANGUAGE), 'onChange="this.form.submit();"'); ?></td>
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
        </table></td>
      </tr>
      <tr>
        <td><?php require(OWP_INCLUDES_DIR . 'footer.php'); ?></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php require(OWP_INCLUDES_DIR . 'nice_exit.php'); ?>
