<?php
/* ----------------------------------------------------------------------
   $Id: owp_userbox.php,v 1.1 2003/05/05 16:53:17 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */
?>

<!-- userbox //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();
  
  $heading[] = array('text'  => BOX_HEADING_ACCOUNT,
                     'link'  => owpLink($owpFilename['account']));

  $contents[] = array('text'  => '<a href="' . owpLink($owpFilename['account']) . '" class="menuBoxContentLink">' . BOX_ACCOUNT_INFO . '</a><br>' .
                                 '<a href="' . owpLink($owpFilename['logoff']) . '" class="menuBoxContentLink">' . BOX_ACCOUNT_LOGOFF . '</a>');                                 
                                  
  
  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- userbox_eof //-->