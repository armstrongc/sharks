<?php
require_once '../../common/config.php';
$success = true;
$load_defaults = true;
$errMsg = '';

require_once ROOT .'/includes/functions.inc.php';
require_once ROOT .'/includes/resize.image.class.php';
$resize_image = new Resize_Image;

// URL.params
if(!isset($_GET['mode'])) $_GET['mode'] = 'add';
if(!isset($_GET['gallery_image_id'])) $_GET['gallery_image_id'] = '0';
if(!isset($_GET['gallery_id'])) $_GET['gallery_id'] = '0';

require_once ROOT .'/cfc/gallery.php';
$dbobject = new galleryObj;
$where = "gallery_id=" .$_GET['gallery_id'];
$qpost = $dbobject->getData($where);

$_GLOBALS['gallery_name']=$qpost[0]['gallery_name'];

// CFCs
require_once ROOT .'/cfc/galleryImage.php';
$dbobject = new galleryImageObj;

// get data
$where = "gallery_image_id=" .$_GET['gallery_image_id'];
$dbobject->sql_orderby = 'display_order ASC';
$quser = $dbobject->getData($where);
foreach ($quser as $row) {
  $_GLOBALS['gallery_id'] = $row['gallery_id'];
  $_GLOBALS['image_file'] = $row['image_file'];
  $_GLOBALS['image_file_original'] = $row['image_file'];
  $_GLOBALS['image_name'] = $row['image_name'];
  $_GLOBALS['image_description'] = $row['image_description'];
  $_GLOBALS['is_live'] = $row['is_live'];
  $_GLOBALS['display_order'] = $row['display_order'];
}

if(isset($_POST['submit_crop'])){

	copy(ROOT .'/images/gallery/original/' .$_GLOBALS['image_file'],ROOT .'/images/gallery/temp/' .$_GLOBALS['image_file']);
	
	$originalImage = ROOT .'/images/gallery/temp/' .$_GLOBALS['image_file'];
	
	// Get the original geometry and calculate scales
	list($width, $height) = getimagesize($originalImage);

	// Get the new with & height
	$width = (int)$_POST['w'];
	$height = (int)$_POST['h'];
	
	$src = $originalImage;
	$dst = ROOT .'/images/gallery/temp/temp_' .$_GLOBALS['image_file'];;
	
	$type = strtolower(substr(strrchr($_GLOBALS['image_file'],"."),1));
	if($type == 'jpeg') $type = 'jpg';
	switch($type){
	  case 'bmp': $img = imagecreatefromwbmp($src); break;
	  case 'gif': $img = imagecreatefromgif($src); break;
	  case 'jpg': $img = imagecreatefromjpeg($src); break;
	  case 'png': $img = imagecreatefrompng($src); break;
	  default : return "Unsupported picture type!";
	}
	
	$ratio = max($width/$_POST['w'], $height/$_POST['h']);
    $h = $height / $ratio;
    $x = ($_POST['w'] - $width / $ratio) / 2;
    $w = $width / $ratio;
	
	$new = imagecreatetruecolor($width, $height);

	// preserve transparency
	if($type == "gif" or $type == "png"){
	  imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
	  imagealphablending($new, false);
	  imagesavealpha($new, true);
	}
	
	imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);

	switch($type){
	  case 'bmp': imagewbmp($new, $dst); break;
	  case 'gif': imagegif($new, $dst); break;
	  case 'jpg': imagejpeg($new, $dst); break;
	  case 'png': imagepng($new, $dst); break;
	}

}

if(isset($_POST['confirm_crop'])){
	
	unlink(ROOT .'/images/gallery/temp/' .$_GLOBALS['image_file']);
	unlink(ROOT .'/images/gallery/thumbs/' .$_GLOBALS['image_file']);
	unlink(ROOT .'/images/gallery/main/' .$_GLOBALS['image_file']);
	
	$name = explode(".",$_GLOBALS['image_file']);
	
	// Get the new with & height
	$new_width = (int)'150';
	$new_height = (int)'150';
	 
	$resize_image->new_width = $new_width;
	$resize_image->new_height = $new_height;
	 
	$resize_image->image_to_resize = ROOT .'/images/gallery/temp/temp_' .$_GLOBALS['image_file']; // Full Path to the file
	$resize_image->ratio = false; // Keep aspect ratio
	$resize_image->save_folder = ROOT .'/images/gallery/main/'; // save file as...
	$resize_image->new_image_name = $name[0];
	$process = $resize_image->resize(); // Output image
	
	// Get the new with & height
	$new_width = (int)'50';
	$new_height = (int)'50';
	 
	$resize_image->new_width = $new_width;
	$resize_image->new_height = $new_height;
	 
	$resize_image->image_to_resize = ROOT .'/images/gallery/temp/temp_' .$_GLOBALS['image_file']; // Full Path to the file
	$resize_image->ratio = false; // Keep aspect ratio
	$resize_image->save_folder = ROOT .'/images/gallery/thumbs/'; // save file as...
	$resize_image->new_image_name = $name[0];
	$process = $resize_image->resize(); // Output image
	
	unlink(ROOT .'/images/gallery/temp/temp_' .$_GLOBALS['image_file']);
	
	header("Location: " .$site_url ."/section/gallery/gallery_image.php?gallery_id=" .$_GET['gallery_id'] ."&action=" .$_GET['mode']);
	
}

// header file
require_once '../../common/header.php';

?>

<link rel="stylesheet" href="/js/jcrop/css/jquery.Jcrop.css" type="text/css" />

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/gallery/">Gallery</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/gallery/gallery_image.php?gallery_id=<?php echo $_GET['gallery_id'] ?>"><?php echo $_GLOBALS['gallery_name'] ?></a><span class="divider">></span></li>
  <li class="active"><?php echo $_GLOBALS['image_name'] ?></li>
</ul>

<h1>Gallery Images (<?php echo $_GLOBALS['gallery_name'] ?>)</h1>
<div class="alert alert-info">Crop the image below.</div>

<p>Image: <?php echo $_GLOBALS['image_file'] ?></p>


<!-- This is the image we're attaching Jcrop to -->
<img src="/images/gallery/original/<?php echo $_GLOBALS['image_file']?>" id="cropbox"  />

<!-- This is the form that our event handler fills -->
<form action="<?php echo $site_url ?>/section/gallery/gallery_image_crop.php?gallery_image_id=<?php echo $_GET['gallery_image_id']?>&gallery_id=<?php echo $_GET['gallery_id']?>&action=<?php echo $_GET['mode']?>" method="post" onsubmit="return checkCoords();">
    <input type="hidden" id="x" name="x" />
    <input type="hidden" id="y" name="y" />
    <input type="hidden" id="w" name="w" />
    <input type="hidden" id="h" name="h" />
    <input type="submit" id="submit_crop" name="submit_crop" value="Crop Image" />
</form>
<a href="<?php echo $site_url ."/section/gallery/gallery_image.php?gallery_id=" .$_GET['gallery_id'] ."&action=" .$_GET['mode']?>">Don't Crop</a>
<br />

<?php if(isset($_POST['submit_crop'])){ ?>

  <img src="/images/gallery/temp/temp_<?php echo $_GLOBALS['image_file']?>"  />

  <form action="<?php echo $site_url ?>/section/gallery/gallery_image_crop.php?gallery_image_id=<?php echo $_GET['gallery_image_id']?>&gallery_id=<?php echo $_GET['gallery_id']?>&action=<?php echo $_GET['mode']?>" method="post">
      <input type="submit" id="confirm_crop" name="confirm_crop" value="Confirm Crop Image" />
  </form>

<?php } ?>

<?php require_once '../../common/footer.php'; ?>

<script src="/js/jcrop/js/jquery.Jcrop.js"></script>
<script language="Javascript">

	$(function(){

		$('#cropbox').Jcrop({
			aspectRatio: 1,
			onSelect: updateCoords
		});

	});

	function updateCoords(c)
	{
		$('#x').val(c.x);
		$('#y').val(c.y);
		$('#w').val(c.w);
		$('#h').val(c.h);
	};

	function checkCoords()
	{
		if (parseInt($('#w').val())) return true;
		alert('Please select a crop region then press submit.');
		return false;
	};

</script>
