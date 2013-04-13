<?php

$info_amended = str_replace($site_url, "", $_SERVER['PHP_SELF']);
$info = explode('/', $info_amended);
$info = explode('/', $_SERVER['PHP_SELF']);

$primaryDir = '';
$secondaryDir = '';
$tertiaryDir = '';
$filename = '';

if(count($info) == 2)
{
	$primaryDir = '';
	$secondaryDir = '';
	$tertiaryDir = '';
	$filename = $info[1];
}
else if(count($info) == 3)
{
	$primaryDir = $info[1];
	$secondaryDir = '';
	$tertiaryDir = '';
	$filename = $info[2];
}
else if(count($info) == 4)
{
	$primaryDir = $info[1];
	$secondaryDir = $info[2];
	$tertiaryDir = '';
	$filename = $info[3];
}
else if(count($info) == 5)
{
	$primaryDir = $info[1];
	$secondaryDir = $info[2];
	$tertiaryDir = $info[3];
	$filename = $info[4];
}

/* remove file extension from filename */
$filename_amend = explode('.', $filename);
$filename = $filename_amend[0];

/*
echo 'primarydir: ' .$primaryDir;
echo '<br />';
echo 'secondaryDir: ' .$secondaryDir;
echo '<br />';
echo 'tertiaryDir: ' .$tertiaryDir;
echo '<br />';
echo 'filename: ' .$filename;
echo '<br />';
*/

/*
if(isset($HTTP_SERVER_VARS['QUERY_STRING']) && $HTTP_SERVER_VARS['QUERY_STRING'] != '')
{
	$pageURL = $HTTP_SERVER_VARS['PHP_SELF'] ."?" .$HTTP_SERVER_VARS['QUERY_STRING'];
} else {
	$pageURL = $HTTP_SERVER_VARS['PHP_SELF'];
}*/
?>