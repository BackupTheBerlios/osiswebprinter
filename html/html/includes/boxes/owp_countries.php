<?php
/* ----------------------------------------------------------------------
   $Id: owp_countries.php,v 1.3 2003/04/25 15:56:55 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: taxes.php,v 1.16 2002/03/16 00:20:11 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */
?>
<!-- countries //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_LOCATION_AND_TAXES,
                     'link'  => owpLink(basename($owpSelf), owpGetAllGetParameters(array('selected_box')) . 'selected_box=countries'));

  if ($selected_box == 'countries') {
    $contents[] = array('text'  => '<a href="' . owpLink($owpFilename['countries'], '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TAXES_COUNTRIES . '</a><br>' .
                                   '<a href="' . owpLink($owpFilename['zones'], '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TAXES_ZONES . '</a>');
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- countries_eof //-->
