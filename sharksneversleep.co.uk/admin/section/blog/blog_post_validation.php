<?php

require_once ROOT .'/includes/functions.inc.php';

$success = 1;
$errMsg = '';

if(!strLen($_POST["category_id"])){
	$success = 0;
	$_GLOBALS["category_id.error"] = true;
	$errMsg .= "cat id";
}

if(!strLen($_POST["author_id"])){
	$success = 0;
	$_GLOBALS["author_id.error"] = true;
	$errMsg .= "author id";
}

if(!strLen($_POST["post_title"])){
	$success = 0;
	$_GLOBALS["post_title.error"] = true;
	$errMsg .= "title";
}

if(!strLen($_POST["post_description"])){
	$success = 0;
	$_GLOBALS["post_description.error"] = true;
	$errMsg .= "description";
}

/*
if(!strLen($_POST["post_keywords"])){
	$success = 0;
	$_GLOBALS["post_keywords.error"] = true;
	$errMsg .= "keywords";
}
*/

$date = explode('-', $_POST['post_date']);

if(!strLen($_POST["post_date"])){
	$success = 0;
	$_GLOBALS["post_date.error"] = true;
	$errMsg .= "date";
} else if(!checkdate($date[1], $date[2], $date[0])){
	$success = 0;
	$_GLOBALS["post_date.error"] = true;
	$errMsg .= "date format - M" .$date[1] ." D - " .$date[2] ." Y - " .$date[0];
}

if(!strLen($_POST["post_copy"])){
	$success = 0;
	$_GLOBALS["post_copy.error"] = true;
	$errMsg .= "copy";
}

if(!isset($_POST["is_live"])){
	$_POST["is_live"] = '';
	$errMsg .= "live";
}


// check to prevent duplicate files
if($success){

  if(strLen($_FILES["image_file"]["name"])){

	require_once ROOT .'/cfc/blogpost.php';
	$dbobject = new blogpostObj;
	$dbobject->sql_orderby = 'post_date DESC';
	$where = "post_id!=" .$_POST["post_id"];
	$qcheck = $dbobject->getData($where);
	$recordcount=$dbobject->numrows;

	$filename_check = gen_filename($_POST["post_title"]);
	$ext = explode(".", $_FILES["image_file"]["name"]);
	$filename_check = $filename_check ."." .$ext[1];
	//echo $filename_check;

	foreach ($qcheck as $row) {
		if($filename_check==$row['image_file']){
			$success = 0;
			$errMsg = '- Filename already exists. Please choose another name.<br />' .$errMsg ;
		}
	}

  }
}

if(strLen($_FILES["image_file"]["name"]) && $success){

	$upload = upload_file('image_file',ROOT .'/images/blog/','image/jpeg,image/gif,image/png',$_POST["post_title"]);

	if(strLen($upload[1])){
		$success = 0;
		$_REQUEST["image_file.error"] = true;
		$errMsg = '- error on upload<br />' .$errMsg ;
	}else{
		$_REQUEST["image_file"] = $upload[0];
	}

	if($success){

		include ROOT .'/includes/resize.image.class.php';
		$resize_image = new Resize_Image;

		// Folder where the (original) images are located with trailing slash at the end
		$images_dir = ROOT .'/images/blog/';

		// Image to resize
		$image = $_REQUEST["image_file"];

		/* Some validation */

		if(!@file_exists($images_dir.$image)){
			exit('The requested image does not exist.');
		}

		// Get the new with & height
		$new_width = (int)'300';
		$new_height = (int)'300';

		$resize_image->new_width = $new_width;
		$resize_image->new_height = $new_height;

		$resize_image->image_to_resize = $images_dir.$image; // Full Path to the file
		$resize_image->ratio = false; // Keep aspect ratio
		$resize_image->save_folder = ROOT .'/images/blog/main/'; // save file as...
		$resize_image->new_image_name = gen_filename($_POST["post_title"]);
		$process = $resize_image->resize(); // Output image

		// Get the new with & height
		$new_width = (int)'100';
		$new_height = (int)'100';

		$resize_image->new_width = $new_width;
		$resize_image->new_height = $new_height;

		$resize_image->image_to_resize = $images_dir.$image; // Full Path to the file
		$resize_image->ratio = false; // Keep aspect ratio
		$resize_image->save_folder = ROOT .'/images/blog/thumbs/'; // save file as...
		$resize_image->new_image_name = gen_filename($_POST["post_title"]);
		$process = $resize_image->resize(); // Output image

		//unlink(ROOT .'/images/gallery/' .$upload[0]);
		$ext = explode(".", $_FILES["image_file"]["name"]);
		$original = $resize_image->new_image_name ."." .$ext[1];


		if (copy(ROOT .'/images/blog/' .$upload[0],ROOT .'/images/blog/original/' .$original)) {
		  unlink(ROOT .'/images/blog/' .$upload[0]);
		}

		// FILENAME
		$ext = explode(".", $_FILES["image_file"]["name"]);
		$_POST["image_file"] = $resize_image->new_image_name ."." .strtolower($ext[1]);

	}

}else{

	if($_GET["mode"]=="add"){
		/*
		$success = 0;
		$_GLOBALS["image_file.error"] = true;
		$errMsg = '- error adding image<br />' .$errMsg ;
		*/
		$_POST["image_file"] = '';
	}else{
		$_POST["image_file"] = $_POST["image_file_original"];
	}
}


if(!$success) $errMsg = 'Please amend the highlighted fields below - <br />' .$errMsg ;
?>