<?php

$dbhost = 'localhost';
$dbusername = 'web120-armo2013';
$dbuserpass = 'ht6_jkh45-elf_kPP';
$query      = NULL;

function db_connect($dbname)
{
   global $dbconnect, $dbhost, $dbusername, $dbuserpass;

   if (!$dbconnect) $dbconnect = mysql_connect($dbhost, $dbusername, $dbuserpass) or die('Error connecting to mysql');
   if (!$dbconnect) {
      return 0;
   } elseif (!mysql_select_db($dbname)) {
      return 0;
   } else {
      return $dbconnect;
   } // if

} // db_connect
?>