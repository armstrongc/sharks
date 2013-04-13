<?php
include 'common/header.php';
//include("../includes/config.php");
//include("../includes/opendb.php");

$dbhost = 'localhost';
$dbuser = 'web120-armo2013';
$dbpass = 'ht6_jkh45-elf_kPP';


echo $dbhost;
echo $dbuser;
echo $dbpass;

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error connecting to mysql');
mysql_select_db($dbname);

mysql_close($conn);

/*
$query  = "SELECT * FROM tblContent WHERE intContentId = $pageID";
$result = mysql_query($query) or die('Error, the query failed');;

while($row = mysql_fetch_assoc($result))
{
   echo "{$row['txtContent']}" ;
}
*/

//include("../includes/closedb.php");
include 'common/footer.php';
 ?>