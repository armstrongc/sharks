<?php

require_once '../common/config.php';

// GET BLOG CATEGORIES
require_once ROOT .'/cfc/blogcategory.php';
$dbobject = new blogcategoryObj;
$dbobject->sql_orderby = 'display_order';
// get data
$where = "is_live=1";
$qcats = $dbobject->getData($where);
$recordcount=$dbobject->numrows;

// DEFAULT CATEGORY_ID TO 0
if(!isset($_GET['category_id']) || !is_numeric($_GET['category_id'])) $_GET['category_id'] = '0';

// GET BLOG POSTS
require_once ROOT .'/cfc/blogpost.php';
$dbobject = new blogpostObj;
$dbobject->sql_orderby = 'post_date DESC';
// IF CATEGORY_ID IS DEFINED, GET POSTS BY CATEGORY ID
if($_GET['category_id']==0){
    $where = "is_live=1";
}else{
    $where = "category_id=" .$_GET['category_id'] ." AND is_live=1";
}
$qpost_all = $dbobject->getData($where);
$recordcount=$dbobject->numrows;

// DEFAULT POST ID TO 0 IF THERE ARE NO POSTS
if(!isset($_GET['post_id']) || !is_numeric($_GET['post_id'])) $_GET['post_id'] = '0';

// GET BLOG POST TO DISPLAY
if($_GET['post_id']!=0){
    require_once ROOT .'/cfc/blogpost.php';
    $dbobject = new blogpostObj;
    $where = "post_id=" .$_GET['post_id'] ." AND is_live=1";
    $qpost = $dbobject->getData($where);

    // GET BLOG POST AUTHOR
    require_once ROOT .'/cfc/blogauthor.php';
    $dbobject = new blogauthorObj;
    $where = "author_id=" .$qpost[0]['author_id'] ." AND is_live=1";
    $qauthor = $dbobject->getData($where);
}

// GET CATEGORY NAME IF ITS SET
if($_GET['category_id']!=0){
    $dbobject = new blogcategoryObj;
    $where = "category_id=" .$_GET['category_id'] ." AND is_live=1";
    $qcat = $dbobject->getData($where);
}

$inline_page_title = "Articles";
$inline_canonical = "http://www.sharksneversleep.co.uk/" .$blog_url ."/";
$inline_ogtitle = "Articles | Sharks Never Sleep";

if($_GET['category_id'] != '0'){
    $inline_canonical .= gen_filename($qcat[0]['category']) ."/";
    $inline_page_title .= " | " .$qcat[0]['category'];
    $inline_page_description = $qcat[0]['category_description'];
    $inline_ogtitle = "Sharks Never Sleep | Articles | " .$qcat[0]['category'];
    $inline_ogimage = "http://www.sharksneversleep.co.uk/images/category/thumbs/" .$qcat[0]['image_file'];
}

if($_GET['post_id'] != '0'){
    $inline_canonical .= gen_filename($qpost[0]['post_title']) ."/";
    $inline_page_title .= " | " .$qpost[0]['post_title'];
    $inline_page_description = $qpost[0]['post_description'];
    $inline_keywords = $qpost[0]['post_keywords'];
    $inline_ogtitle = "Sharks Never Sleep | Articles | " .$qcat[0]['category'] ." | " .$qpost[0]['post_title'];
    $inline_ogimage = "http://www.sharksneversleep.co.uk/images/blog/thumbs/" .$qpost[0]['image_file'];
}

$inline_page_title .= " | Sharks Never Sleep";

// form params
if(!isset($_POST['post_id'])) $_POST['post_id'] = $qpost[0]['post_id'];
if(!isset($_POST['comment_name'])) $_POST['comment_name'] = '';
if(!isset($_POST['comment_location'])) $_POST['comment_location'] = '';
if(!isset($_POST['comment_copy'])) $_POST['comment_copy'] = '';
if(!isset($_POST['comment_date'])) $_POST['comment_date'] = date('Y-m-d');

// error params
if(!isset($_GLOBALS['comment_name.error'])) $_GLOBALS['comment_name.error'] = false;
if(!isset($_GLOBALS['comment_location.error'])) $_GLOBALS['comment_location.error'] = false;
if(!isset($_GLOBALS['comment_copy.error'])) $_GLOBALS['comment_copy.error'] = false;
if(!isset($_GLOBALS['comment_date.error'])) $_GLOBALS['comment_date.error'] = false;
if(!isset($_GLOBALS['is_live.error'])) $_GLOBALS['is_live.error'] = false;

$blog_comment_success = false;
$blog_comment_error = false;

if(isset($_POST['submit'])){

    $success = 1;
    $errMsg = '';

    if(!strLen($_POST["comment_name"])){
        $success = 0;
        $_GLOBALS["comment_name.error"] = true;
        $errMsg .= "Your Name";
    }

    if(!strLen($_POST["comment_location"])){
        $success = 0;
        $_GLOBALS["comment_location.error"] = true;
        $errMsg .= "Your Location";
    }

    if(!strLen($_POST["comment_copy"])){
        $success = 0;
        $_GLOBALS["comment_copy.error"] = true;
        $errMsg .= "Your Comment";
    }

    if($blog_comments_on){
        // RECAPTCHA
        require_once ROOT .'/includes/recaptcha-php-1.11/recaptchalib.php';
        $privatekey = $recapcha_private_key;
        $resp = recaptcha_check_answer ($privatekey,
            $_SERVER["REMOTE_ADDR"],
            $_POST["recaptcha_challenge_field"],
            $_POST["recaptcha_response_field"]);

        if (!$resp->is_valid) {
            // invalid
            $success = 0;
            $_GLOBALS["comment_recapcha.error"] = true;
            $errMsg .= "Recaptcha";
        } else {
            // valid
        }

    }

    if($success){

        require_once ROOT .'/cfc/blogcomment.php';
        $dbobject = new blogcommentObj;

        // reformat date
        $_POST['comment_date'] = date('Y-m-d H:i:s');
        $_POST['is_live'] = '';

        $_POST['comment_name'] = addslashes($_POST['comment_name']);
        $_POST['comment_location'] = addslashes($_POST['comment_location']);
        $_POST['comment_copy'] = addslashes($_POST['comment_copy']);

        $fieldarray = $dbobject->insertRecord($_POST);
        $errors = $dbobject->getErrors();

        $blog_comment_success = true;

    }else{
        $blog_comment_error = true;
    }

}

require_once '../common/header_start.php';
require_once '../common/header_end.php';

if($_GET['category_id'] == '0'){
   require_once 'blog.php';
}else if($_GET['post_id'] == '0'){
    require_once 'category.php';
} else{
    require_once 'post.php';
}

require_once '../common/footer_start.php';
?>

<link href="<?php echo $site_url ?>/js/google-code-prettify/obsidian.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo $site_url ?>/js/google-code-prettify/prettify.js"></script>
<script>
$(document).ready(function(){
    prettyPrint();
});
</script>

<?php
require_once '../common/footer_end.php';
?>


