<?php
/* ----------------------------------------------------------------------
   $Id: owp_administrators.php,v 1.3 2003/04/22 07:22:17 r23 Exp $

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
?>
<!-- administrators //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();
  
  $heading[] = array('text'  => BOX_HEADING_ADMINISTRATORS,
                     'link'  => owpLink(basename($owpSelf), owpGetAllGetParameters(array('selected_box')) . 'selected_box=administrators'));


  if ($selected_box == 'administrators') {
    $contents[] = array('text'  => '<a href="' . owpLink($owpFilename['administrators'], '', 'NONSSL') . '">' . BOX_ADMINISTRATORS_SETUP . '</a>');
  }
  
  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- administrators_eof //-->
