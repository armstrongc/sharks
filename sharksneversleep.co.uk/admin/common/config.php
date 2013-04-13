<?php session_start();

$site_name = "Karibu CMS";
$site_version = "v1.0";
$site_url = "/admin";
$site_admin_email = "contact@sharksneversleep.co.uk";

$host = $_SERVER['HTTP_HOST'];
if($host=='www.sharksneversleep.co.uk'){
	$site_mode = 'live';
}else{
	$site_mode = 'dev';
}

//OLD Definition of root
//define('ROOT', $_SERVER['DOCUMENT_ROOT'] ."");

//define absolute path and root
define('ABSPATH', str_replace('\\', '/', dirname(__FILE__)) . '/');

$tempPath1 = explode('/', str_replace('\\', '/', dirname($_SERVER['SCRIPT_FILENAME'])));
$tempPath2 = explode('/', substr(ABSPATH, 0, -1));
$tempPath3 = explode('/', str_replace('\\', '/', dirname($_SERVER['PHP_SELF'])));

for ($i = count($tempPath2); $i < count($tempPath1); $i++)
    array_pop ($tempPath3);

$urladdr = $_SERVER['HTTP_HOST'] . implode('/', $tempPath3);

if ($urladdr{strlen($urladdr) - 1}== '/')
    define('URLADDR', 'http://' . $urladdr);
else
    define('URLADDR', 'http://' . $urladdr . '/');

unset($tempPath1, $tempPath2, $tempPath3, $urladdr);

define('ROOT', str_replace("/admin/common/","",ABSPATH));
//END define absolute path and root


// get url structure
require_once ROOT .'/common/getDirectoryFilename.php';

// Secure that shit
require_once 'security.php';

// get content extended class
require_once ROOT .'/includes/inc_db.php';
require_once ROOT .'/includes/inc_error.php';
require_once ROOT .'/includes/functions.inc.php';
require_once ROOT .'/includes/inc_default_table.class.php';

?>