<?php
/* ----------------------------------------------------------------------
   $Id: header.php,v 1.1 2003/03/28 17:42:03 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<title><?php  echo INSTALLATION; ?></title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=<?php  echo CHARSET; ?>">
<META NAME="AUTHOR" CONTENT="OSIS GmbH">
<META NAME="GENERATOR" CONTENT="OSIS GmbH -- http://www.osisnet.de">
<META NAME="ROBOTS" content="NOFOLLOW">
<link rel="StyleSheet" href="style/style.css" type="text/css" />
</head>
<body>
<table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr> 
    <td rowspan="5"><img src="images/trans.gif" width="1" height="460" border="0" alt=" "></td>   
    <td align="left" valign="top" class="ow-main"><font class="ow-pageTitle"><?php  echo owTextTool::heading(INSTALLATION); ?></font></td>
  </tr>
  <tr>
    <td><img src="images/trans.gif" width="1%" height="6" border="0" alt=" "></td>
  </tr>
  <tr>
    <td align="left" valign="top" class="ow-main"><table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">
      <tr class="ow-footer">
        <td class="ow-footer">&nbsp;&nbsp;<?php  echo strftime(DATE_LONG); ?>&nbsp;&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr> 
    <td align="left" valign="top">
