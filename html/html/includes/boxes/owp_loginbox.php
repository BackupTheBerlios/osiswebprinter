<?php
/* ----------------------------------------------------------------------
   $Id: owp_loginbox.php,v 1.1 2003/05/03 15:56:02 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */
?>

<!-- loginbox //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();
  
  $heading[] = array('text'  => BOX_HEADING_LOGIN,
                     'link'  => owpLink($owpFilename['login']));

  $contents[] = array('text'  => '<table border="0" width="100%" cellspacing="0" cellpadding="0">' . owpDrawForm('login', $owpFilename['login'], 'action=process') . "\n" .
                                 '  <tr>' . "\n" .
                                 '    <td class="main">' . TEXT_INFO_USER_EMAIL . '</td>' . "\n" .
                                 '  </tr>' . "\n" .
                                 '  <tr>' . "\n" .
                                 '    <td>' . owpInputField('email_address') . '</td>' . "\n" .
                                 '  </tr>' . "\n" .
                                 '  <tr>' . "\n" .
                                 '    <td class="main">' . TEXT_INFO_PASSWORD . '</td>' . "\n" .
                                 '  </tr>' . "\n" .
                                 '  <tr>' . "\n" .
                                 '    <td><input type="password" name="password"></td>' . "\n" .
                                 '  </tr>' . "\n" .
                                 '  <tr>' . "\n" .
                                 '    <td><input type="submit" name="Submit" value="Login"></td>' . "\n" .
                                 '  </tr>' . "\n" .
                                 '</form></table>');            
  
  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- loginbox_eof //-->