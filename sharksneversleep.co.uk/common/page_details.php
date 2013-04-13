<?php
$page_title = "Sharks never Sleep";
$page_description = "";
$canonical = "http://www.sharksneversleep.co.uk";
$keywords = "Sharks never Sleep, HTML5, CSS3, jQuery, Coldfusion, SEO, SQL, web developer, London, UK";
$ogimage = "http://www.sharksneversleep.co.uk/img/layout/logo_opengraph.png";
$ogtitle = "Sharks never Sleep | Web Design &amp Development Blog";

switch ($primaryDir)
{
case "":
  	$page_title = "Sharks never Sleep | Web Design &amp Development Blog | HTML, CSS, Javascript, Design";
	//$page_description = "Christian Armstrong is a front end website developer with over 9 years experience in building high quality websites.";
  	break;
case "contact":
	$page_title = "Contact Details | Web Design &amp Development Blog | Sharks never Sleep";
	break;
case "privacy":

    switch ($filename)
    {
    case "cookies":
        $page_title = "Cookie policy | Web Design &amp Development Blog | Sharks never Sleep";
        break;
    case "privacy":
        $page_title = "Privacy policy | Web Design &amp Development Blog | Sharks never Sleep";
        break;
    default:
        $page_title = "Privacy | Web Design &amp Development Blog | Sharks never Sleep";
    }
    break;

default:
    $page_title = "Sharks never Sleep| Web Design &amp Development Blog | HTML, CSS, Javascript, Design";
}

?>