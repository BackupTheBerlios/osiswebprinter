<?php
/* ----------------------------------------------------------------------
   $Id: owp_configuration.php,v 1.7 2003/05/03 15:55:01 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: configuration.php,v 1.16 2002/03/16 00:20:11 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */
?>
<!-- configuration //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_CONFIGURATION,
                     'link'  => owpLink(basename($_SERVER['PHP_SELF']), owpGetAllGetParameters(array('selected_box')) . 'selected_box=configuration'));

  if ($selected_box == 'configuration') {
    $cfg_groups = '';

    $sql = "SELECT configuration_group_id as cgID, configuration_group_title as cgTitle 
            FROM " . $owpDBTable['configuration_group'] . "  
            WHERE visible = '1' 
            ORDER BY sort_order";
    $db->cacheSecs = 3600*24; # cache 24 hours
    $configuration_groups_query = $db->CacheExecute($sql);
    while ($configuration_groups = $configuration_groups_query->fields) {   
      $cfg_groups .= '<a href="' . owpLink($owpFilename['configuration'], 'gID=' . $configuration_groups['cgID'], 'NONSSL') . '" class="menuBoxContentLink">' . $configuration_groups['cgTitle'] . '</a><br>';
      $configuration_groups_query->MoveNext();
    }
    $contents[] = array('text'  => $cfg_groups);
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- configuration_eof //-->
