<?php
/* ----------------------------------------------------------------------
   $Id: whos_online.php,v 1.10 2003/04/22 07:28:33 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: whos_online.php,v 1.28 2002/08/13 20:37:48 dgw_
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  $xx_mins_ago = (time() - 900);

  require('includes/system.php');

  if (!isset($_SESSION['user_id'])) {
    $_SESSION['navigation']->set_snapshot();
    owpRedirect(owpLink($owpFilename['login'], '', 'SSL'));
  } 
  
  require(OWP_LANGUAGES_DIR . $language . '/' . $owpFilename['whos_online']);

  require(OWP_CLASSES_DIR . 'currencies.php');
  $currencies = new currencies();

// remove entries that have expired
  tep_db_query("delete from " . TABLE_WHOS_ONLINE . " where time_last_click < '" . $xx_mins_ago . "'");
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
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
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="owp-title"><?php echo HEADING_TITLE; ?></td>
            <td class="owp-title" align="right"><?php echo owpTransLine(HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ONLINE; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_CUSTOMER_ID; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_FULL_NAME; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_IP_ADDRESS; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ENTRY_TIME; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_LAST_CLICK; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_LAST_PAGE_URL; ?>&nbsp;</td>
              </tr>
<?php
  $whos_online_query = tep_db_query("select customer_id, full_name, ip_address, time_entry, time_last_click, last_page_url, session_id from " . TABLE_WHOS_ONLINE);
  while ($whos_online = tep_db_fetch_array($whos_online_query)) {
    $time_online = (time() - $whos_online['time_entry']);
    if ( ((!$_GET['info']) || (@$_GET['info'] == $whos_online['session_id'])) && (!$info) ) {
      $info = $whos_online['session_id'];
    }
    if ($whos_online['session_id'] == $info) {
      echo '              <tr class="dataTableRowSelected">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . owpLink($owpFilename['whos_online'], owpGetAllGetParameters(array('info', 'action')) . 'info=' . $whos_online['session_id'], 'NONSSL') . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo gmdate('H:i:s', $time_online); ?></td>
                <td class="dataTableContent" align="center"><?php echo $whos_online['customer_id']; ?></td>
                <td class="dataTableContent"><?php echo $whos_online['full_name']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $whos_online['ip_address']; ?></td>
                <td class="dataTableContent"><?php echo date('H:i:s', $whos_online['time_entry']); ?></td>
                <td class="dataTableContent" align="center"><?php echo date('H:i:s', $whos_online['time_last_click']); ?></td>
                <td class="dataTableContent"><?php if (eregi('^(.*)' . tep_session_name() . '=[a-f,0-9]+[&]*(.*)', $whos_online['last_page_url'], $array)) { echo $array[1] . $array[2]; } else { echo $whos_online['last_page_url']; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
              <tr>
                <td class="smallText" colspan="7"><?php echo sprintf(TEXT_NUMBER_OF_CUSTOMERS, tep_db_num_rows($whos_online_query)); ?></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();
  if ($info) {
    $heading[] = array('text' => '<b>' . TABLE_HEADING_SHOPPING_CART . '</b>');

    if (STORE_SESSIONS == 'mysql') {
      $session_data = tep_db_query("select value from " . TABLE_SESSIONS . " WHERE sesskey = '" . $info . "'");
      $session_data = tep_db_fetch_array($session_data);
      $session_data = trim($session_data['value']);
    } else {
      if (file_exists(tep_session_save_path() . '/sess_' . $info)) {
        $session_data = @file(tep_session_save_path() . '/sess_' . $info);
        $session_data = trim(implode('', $session_data));
      }
    }

    if ($length = strlen($session_data)) {
      $start_id = strpos($session_data, 'customer_id|s');
      $start_currency = strpos($session_data, 'currency|s');
      $start_country = strpos($session_data, 'customer_country_id|s');
      $start_zone = strpos($session_data, 'customer_zone_id|s');

      $session_data_id = substr($session_data, $start_id, (strpos($session_data, ';', $start_id) - $start_id + 1));
      $session_data_cart = substr($session_data, $start_cart, $i);
      $session_data_currency = substr($session_data, $start_currency, (strpos($session_data, ';', $start_currency) - $start_currency + 1));
      $session_data_country = substr($session_data, $start_country, (strpos($session_data, ';', $start_country) - $start_country + 1));
      $session_data_zone = substr($session_data, $start_zone, (strpos($session_data, ';', $start_zone) - $start_zone + 1));

      session_decode($session_data_id);
      session_decode($session_data_currency);
      session_decode($session_data_country);
      session_decode($session_data_zone);
      session_decode($session_data_cart);

      if (is_object($cart)) {
        $products = $cart->get_products();
        for ($i=0; $i<sizeof($products); $i++) {
          $contents[] = array('text' => $products[$i]['quantity'] . ' x ' . $products[$i]['name']);
        }

        if (sizeof($products) > 0) {
          $contents[] = array('text' => owpTransLine());
          $contents[] = array('align' => 'right', 'text'  => TEXT_SHOPPING_CART_SUBTOTAL . ' ' . $currencies->format($cart->show_total(), true, $currency));
        } else {
          $contents[] = array('text' => '&nbsp;');
        }
      }
    }
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
