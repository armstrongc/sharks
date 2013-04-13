<?php session_start();

$site_name = "Sharks Never Sleep";
$site_version = "v1.0";
$site_url = "";
$admin_url = "";
$site_admin_email = "contact@sharksneversleep.co.uk";
$site_owner_email = "contact@sharksneversleep.co.uk";
$site_holding = false;

$recapcha_public_key = '6LdRoN8SAAAAADw7kC6saJkO4SHdSF-_m9LK6eMf';
$recapcha_private_key = '6LdRoN8SAAAAACibimrvx8mWCR9qTQpsphSaB4jo';

$blog_comments_on = true;

$host = $_SERVER['HTTP_HOST'];

if($host=='www.sharksneversleep.co.uk'){
	$site_mode = 'live';
}else{
	$site_mode = 'dev';
}

if($site_holding){
	header("Location: " .$site_url ."/holding.htm");
}

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

define('ROOT', str_replace("/common/","",ABSPATH) . "/");
//END define absolute path and root


// get url structure
require_once ROOT .'/common/getDirectoryFilename.php';
require_once ROOT .'/common/page_details.php';

// Secure that shit
//require_once 'security.php';

// get content extended class

require_once ROOT .'/includes/inc_db.php';
require_once ROOT .'/includes/inc_error.php';
require_once ROOT .'/includes/functions.inc.php';
require_once ROOT .'/includes/inc_default_table.class.php';

?>