<?php
/* ----------------------------------------------------------------------
   $Id: server_info.php,v 1.6 2003/04/20 06:48:05 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: server_info.php,v 1.3 2002/03/16 01:36:56 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

  require('includes/system.php');

  $system = owpGetSystemInformation();
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
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
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td><table border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td class="smallText"><b><?php echo TITLE_SERVER_HOST; ?></b></td>
                <td class="smallText"><?php echo $system['host'] . ' (' . $system['ip'] . ')'; ?></td>
                <td class="smallText">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo TITLE_DATABASE_HOST; ?></b></td>
                <td class="smallText"><?php echo $system['db_server'] . ' (' . $system['db_ip'] . ')'; ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TITLE_SERVER_OS; ?></b></td>
                <td class="smallText"><?php echo $system['system'] . ' ' . $system['kernel']; ?></td>
                <td class="smallText">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo TITLE_DATABASE; ?></b></td>
                <td class="smallText"><?php echo $system['db_version']; ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TITLE_SERVER_DATE; ?></b></td>
                <td class="smallText"><?php echo $system['date']; ?></td>
                <td class="smallText">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo TITLE_DATABASE_DATE; ?></b></td>
                <td class="smallText"><?php echo $system['db_date']; ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TITLE_SERVER_UP_TIME; ?></b></td>
                <td colspan="3" class="smallText"><?php echo $system['uptime']; ?></td>
              </tr>
              <tr>
                <td colspan="4"><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TITLE_HTTP_SERVER; ?></b></td>
                <td colspan="3" class="smallText"><?php echo $system['http_server']; ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TITLE_PHP_VERSION; ?></b></td>
                <td colspan="3" class="smallText"><?php echo $system['php'] . ' (' . TITLE_ZEND_VERSION . ' ' . $system['zend'] . ')'; ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
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