<?php function resizeImage($originalImage,$toWidth,$toHeight){

	// Get the original geometry and calculate scales
	list($width, $height) = getimagesize($originalImage);
	$xscale=$width/$toWidth;
	$yscale=$height/$toHeight;

	 // Recalculate new size with default ratio
    if ($yscale>$xscale){
        $new_width = round($width * (1/$yscale));
        $new_height = round($height * (1/$yscale));
    }
    else {
        $new_width = round($width * (1/$xscale));
        $new_height = round($height * (1/$xscale));
    }

	// Resize the original image
    $imageResized = imagecreatetruecolor($new_width, $new_height);
    $imageTmp     = imagecreatefromjpeg ($originalImage);
    imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

	return $imageResized;
}

//This function separates the extension from the rest of the file name and returns it
function findexts ($filename)
{
	$filename = strtolower($filename) ;
	$exts = preg_split("[/\\.]", $filename) ;
	$n = count($exts)-1;
	$exts = $exts[$n];
	return $exts;
}

function filename_format_string($string){
	$string = strtolower($string);
	$string = str_replace(' ','-',$string);
	$string = str_replace('/','',$string);
	$string = str_replace('\\','',$string);
	$string = str_replace('.','',$string);
	$string = str_replace('"','',$string);
	$string = str_replace("'",'',$string);
	$string = str_replace(":",'',$string);
	return $string;
}

//This function genrates a random filename
function gen_filename ($string)
{
	if(strlen($string)){
		$filename = filename_format_string($string);
	}else{
		$filename = rand ();
	}
	return $filename;
}

//This function uploads a file
function upload_file($upload_field,$upload_directory,$upload_type,$upload_name){

	$return = array('','','');

	//get the extension of the file
	$ext = findexts($_FILES[$upload_field]['name']);

	//generate a filename
    $filename = gen_filename($upload_name);

    //recreate the new filename and extension
    $filename = $filename."." .$ext;

    //assign the subdirectory you want to save into
    $target = $upload_directory;

	//create the full file path
    $target = $target .$filename;

	// set variables to allow function to continue
	$ok=1;

	//This is our size condition
	if (isset($uploaded_size) && $uploaded_size > 350000)
	{
		$return[1] =  $return[1] ."Your file is too large.<br>";
		$ok=0;
	}

	$upload_types = explode(",",$upload_type);
	$no_of_upload_types = count($upload_types);

	if($no_of_upload_types!=0){
		if(!in_array($_FILES[$upload_field]["type"], $upload_types)){
			$return[1] =  $return[1] ."Invalid file type<br>";
			$ok=0;
		}
	}

	//Here we check that $ok was not set to 0 by an error
	if ($ok==0){
		$return[1] =  $return[1]. "Sorry your file was not uploaded";
	}else{

		if(move_uploaded_file($_FILES[$upload_field]['tmp_name'], $target)) {
		    $return[2] = $return[2] ."The file has been uploaded as ".$filename;
		} else{
		    $return[1] = $return[1] ."There was an error uploading the file, please try again!";
		}
	}

	$return[0] = $filename;

	return $return;
}

function check_email_address($email) {
	// First, we check that there's one @ symbol, and that the lengths are right
	if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
		// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
		return false;
	}
	// Split it into sections to make life easier
	$email_array = explode("@", $email);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++) {
		if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
			return false;
		}
	}
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
		$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2) {
			return false; // Not enough parts to domain
		}
		for ($i = 0; $i < sizeof($domain_array); $i++) {
			if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
				return false;
			}
		}
	}
	return true;
}

 /*
 * Created by: Stefan van Beusekom
 * Created on: 31-01-2011
 * Description: A method that ensures safe data entry, and accepts either strings or arrays. If the array is multidimensional,
 *                     it will recursively loop through the array and make all points of data safe for entry.
 * parameters: string or array;
 * return: string or array;
 */
function filterParameters($array) {

	// Check if the parameter is an array
	if(is_array($array)) {
		// Loop through the initial dimension
		foreach($array as $key => $value) {
			// Check if any nodes are arrays themselves
			if(is_array($array[$key]))
				// If they are, let the function call itself over that particular node
				$array[$key] = $this->filterParameters($array[$key]);

			// Check if the nodes are strings
			if(is_string($array[$key]))
				// If they are, perform the real escape function over the selected node
				$array[$key] = mysql_real_escape_string($array[$key]);
		}
	}
	// Check if the parameter is a string
	if(is_string($array))
		// If it is, perform a  mysql_real_escape_string on the parameter
		$array = mysql_real_escape_string($array);

	// Return the filtered result
	return $array;

}

function SterilizeFrmInput($arr) {

	//$escapedGet = array_map('mysql_real_escape_string', $arr);


  while(list($key,$val) = each ($arr))
  {
  	echo "Key : ".$key." : ".$val;
  }

}

function valid_date($date) {
    return strtotime($date);
}
?>