<?php
/* ----------------------------------------------------------------------
   $Id: header.php,v 1.4 2003/04/25 07:21:50 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:
   
   File: header.php,v 1.19 2002/04/13 16:11:52 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2002 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */
?>
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
<?php
  if ($messageStack->size > 0) {
    echo $messageStack->output();
  }
?>
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#F6F7EB" width="100%">
  <tr>
    <td bgcolor="#B1B78B" align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td><?php echo $breadcrumb->trail(' &raquo; '); ?></td>
        <td><?php echo owpTransLine('1', '40'); ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#000000"><?php echo owpTransLine(); ?></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><?php echo owpTransLine('1', '390'); ?></td> 
    <td align="left" valign="top">
