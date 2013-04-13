<?php

require_once ROOT .'/includes/functions.inc.php';

$success = 1;
$errMsg = '';

if(!strLen($_POST["image_name"])){
	$success = 0;
	$_GLOBALS["image_name.error"] = true;
}

/*
if(!strLen($_POST["image_description"])){
	$success = 0;
	$_GLOBALS["image_description.error"] = true;
}
*/

// check to prevent duplicate files
if($success){

  if(strLen($_FILES["image_file"]["name"])){

	require_once ROOT .'/cfc/galleryImage.php';
	$dbobject = new galleryImageObj;
	$dbobject->sql_orderby = 'display_order';
	$where = "gallery_image_id!=" .$_POST['gallery_image_id'];
	$qcheck = $dbobject->getData($where);
	$recordcount=$dbobject->numrows;

	$filename_check = gen_filename($_POST["image_name"]);
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

	$upload = upload_file('image_file',ROOT .'/images/gallery/','image/jpeg,image/gif,image/png',$_REQUEST["image_name"]);

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
		$images_dir = ROOT .'/images/gallery/';

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
		$resize_image->save_folder = ROOT .'/images/gallery/main/'; // save file as...
		$resize_image->new_image_name = gen_filename($_REQUEST["image_name"]);
		$process = $resize_image->resize(); // Output image

		// Get the new with & height
		$new_width = (int)'100';
		$new_height = (int)'100';

		$resize_image->new_width = $new_width;
		$resize_image->new_height = $new_height;

		$resize_image->image_to_resize = $images_dir.$image; // Full Path to the file
		$resize_image->ratio = false; // Keep aspect ratio
		$resize_image->save_folder = ROOT .'/images/gallery/thumbs/'; // save file as...
		$resize_image->new_image_name = gen_filename($_REQUEST["image_name"]);
		$process = $resize_image->resize(); // Output image

		//unlink(ROOT .'/images/gallery/' .$upload[0]);
		$ext = explode(".", $_FILES["image_file"]["name"]);
		$original = $resize_image->new_image_name ."." .$ext[1];


		if (copy(ROOT .'/images/gallery/' .$upload[0],ROOT .'/images/gallery/original/' .$original)) {
		  unlink(ROOT .'/images/gallery/' .$upload[0]);
		}

		//$original = ROOT .'/images/gallery/' .$upload[0];
		//$new = ROOT .'/images/gallery/original/' .$upload[0];
		//move_uploaded_file ( $original , $new );


		// FILENAME
		$ext = explode(".", $_FILES["image_file"]["name"]);
		$_POST["image_file"] = $resize_image->new_image_name ."." .strtolower($ext[1]);
		 /*
		echo $upload[0];
		echo "<br />";
		echo $upload[1];
		echo "<br />";
		echo $upload[2];
		echo "<br />";
		break;
		*/

	}

}else{

	if($_GET["mode"]=="add"){
		$success = 0;
		$_GLOBALS["image_file.error"] = true;
		$errMsg = '- error adding image<br />' .$errMsg ;
	}else{
		$_POST["image_file"] = $_POST["image_file_original"];
	}
}

if(!isset($_POST["is_live"])){
	$_POST["is_live"] = '';
}

if(!$success) $errMsg = 'Please amend the highlighted fields below - <br />' .$errMsg ;
?>