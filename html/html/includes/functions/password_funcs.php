<?php
/* ----------------------------------------------------------------------
   $Id: password_funcs.php,v 1.4 2003/05/01 14:37:29 r23 Exp $

   OSIS WebPrinter for your Homepage
   http://www.osisnet.de
   
   Ralf Zschemisch
   http://www.r23.de/
   
   Copyright (c) 2003 r23
   ----------------------------------------------------------------------
   Based on:

   password_funcs.php: Functions to handle encryption 
   and validation of user passwords.
   Copyright (C) 2000 Darren McClelland. All rights reserved. 
   This program is free software licensed under the 
   GNU General Public License (GPL).
 
   ----------------------------------------------------------------------
   LICENSE
  
   This program is free software; you can redistribute it and/or
   modify it under the terms of the GNU General Public License (GPL)
   as published by the Free Software Foundation; either version 2
   of the License, or (at your option) any later version.
  
   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.
  
   To read the license please visit http://www.gnu.org/copyleft/gpl.html
   ----------------------------------------------------------------------
    
   $Log: password_funcs.php,v $
   Revision 1.4  2003/05/01 14:37:29  r23
   misc update

   Revision 1.1  2003/04/04 07:53:41  r23
   initial import

   Revision 1.7  2001/12/14 16:13:23  dgw_
 
   this function is defined twice ... lets unify
 
   Revision 1.6  2001/09/20 19:27:07  mbs
   updates to tep standard.
 
   Revision 1.5  2000/10/19 12:12:14  tmoulton
   Change 1 to true and 0 to false (note lower case)
 
   Revision 1.4  2000/10/19 11:38:38  tmoulton
   My PHP did not like TRUE/FALSE, changed to 1 or 0
 
   Revision 1.3  2000/10/18 14:28:25  dmcclelland
   Made a change in owpValidatePasword() to allow
   allow it to work on an unencrypted password
   database or with NULL passwords.
 
   Revision 1.2  2000/10/18 14:16:08  dmcclelland
   Replaced calls to gettimeofday() with mt_rand() and mt_srand().
   gettimeofday() is very new in PHP4.
   ----------------------------------------------------------------------  
   password_funcs.php,v 1.7 2001/12/14 16:13:23 dgw_  
   The Exchange Project - Community Made Shopping!
   http://www.theexchangeproject.org
   ---------------------------------------------------------------------- */

/*  This funstion validates a candidate password.
*   $plain_pass is the plaintext password entered by the
*   user.
*   $db_pass is the contents of the customer_password field
*   in the customer table. $db_pass has this structure:
*   hash:salt Hash is an MD5 hash of the password + salt
*   and salt is a two character 'salt'.
*/

function owpValidatePasword($plain_pass, $db_pass){
  /*Quick test to let this work on unencrypted passwords and NULL
   Passwords*/
  if ($plain_pass == $db_pass){
    return(true);
  }
     
  /* split apart the hash / salt*/
  if (!($subbits = split(":", $db_pass, 2))){
     return(false);
  }
    
  $dbpassword = $subbits[0];
  $salt = $subbits[1];
    
  $passtring = $salt . $plain_pass;
    
  $encrypted = md5($passtring);
  if (strcmp($dbpassword, $encrypted) == 0) {
    return(true);
  } else {
    return(false);
  }
} 

/*  This function makes a new password from a plaintext password. An
 *   encrypted password + salt is returned 
 */

function owpCryptPassword($plain_pass){
  /* create a semi random salt */
  mt_srand ((double) microtime() * 1000000);
  for($i=0;$i<10;$i++){
    $tstring	.= mt_rand();
  }
    
  $salt = substr(md5($tstring),0, 2);
    
  $passtring = $salt . $plain_pass;
    
  $encrypted = md5($passtring);
    
  return($encrypted . ":" . $salt);
} 


function owpCreatePassword($pass_len = '8'){
  mt_srand ((double) microtime() * 1000000);
  $allchar = "abcdefghijknmpqrstuvwxyzABCDEFGHKLNMPRSTUVWXYZ2345679";
  $password = "" ;
  for ($i = 0; $i<$pass_len ; $i++){
    $password .= substr( $allchar, mt_rand (0,53), 1 ) ;
  }
  return($password);
}

?>