<?php
/* ----------------------------------------------------------------------
   $Id: index.php,v 1.16 2003/05/07 17:51:03 r23 Exp $

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
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
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
         '                        <td><a href="' . $cat[$i]['href'] . '">' . owpImage(OWP_IMAGES_DIR . 'categories/' . $cat[$i]['image'], $cat[$i]['title'], '32', '32') . '</a></td>' . "\n" .
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
      <tr>
        <td><?php echo owpTransLine('1', '10'); ?></td>
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
