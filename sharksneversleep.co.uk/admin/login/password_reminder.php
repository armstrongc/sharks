<?php 
require_once '../common/config.php';

$success = 1;
$errMsg = '';

// URL PARAMS
if(!isset($_GET['action'])) $_GET['action']='';
$_GLOBALS['action'] = $_GET['action'];

if(isset($_POST['submit'])){
	
	$success = 1;
	$errMsg = '';

	if($_POST["username"]==''){
		$success = 0;
		$errMsg = $errMsg .'Please enter your email address<br />';
	}else{
		
		// get content extended class
		require_once ROOT .'/cfc/user.php';
		$dbobject = new userObj;

		$dbobject->sql_where   = 'email="' .$_POST["username"] . '"';
		
		// get data
		$where = "";
		$qlogin = $dbobject->getData($where);
		
		if(!$qlogin){
			$success = 0;
			$errMsg = $errMsg .'Your email address was not found on the system<br />';
		}
			
	}
	
	if($success){
		foreach ($qlogin as $row) {
		  $_REQUEST['user_id']=$row['user_id'];
		  $_GLOBALS['email']=$row['email'];
		  $_GLOBALS['first_name']=$row['first_name'];
		  $_GLOBALS['last_name']=$row['last_name'];
		  $_REQUEST['display_name']=$row['display_name'];
		  $_GLOBALS['password']=$row['password'];
	   }	

	  // send mail
	  
	  $to      = $_GLOBALS['email'];
	  $subject = $site_name .' Password Reminder';
	  
	  $message = 'Dear ' .$_GLOBALS['first_name'] .' ' .$_GLOBALS['last_name'] ."\r\n\r\n";
	  $message .= 'Your login details are as follows' ."\r\n\r\n";
	  $message .= 'Username : ' .$_GLOBALS['email'] ."\r\n";
	  $message .= 'Password : ' .$_GLOBALS['password'] ."\r\n\r\n";
	  $message .= 'Regards ' .$site_name;
	  
	  $headers = 'From: ' .$site_admin_email ."\r\n" .
	  'Reply-To: ' .$site_admin_email ."\r\n" .
	  'X-Mailer: PHP/' . phpversion();
	  
	  //echo $to ."<br />" .$subject ."<br />" .$message ."<br />" .$headers;
	  //mail($to, $subject, $message, $headers);
	 
	   $_GLOBALS['action']='success';
	   
	}
	
} else {
	$_POST["username"] = "";
}

require_once '../common/header.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/login">Login</a> <span class="divider">></span></li>
  <li class="active">Password Reminder</li>
</ul>

<h1>Password Reminder</h1>

<div class="alert alert-info">
	Please login below to access this section.
</div>

<?php if($_GLOBALS['action']=='success'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      Your login details have been sent to your email address. <a href="<?php echo $site_url ?>/login">Click Here</a> to Login.
    </div>
<?php }?>

<?php if($errMsg!=''){?>
<div class="alert alert-error">
    <a class="close" data-dismiss="alert">×</a>
    <?php echo $errMsg?>
</div>
<?php }?>

<form class="well"  name="loginForm" id="loginForm" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" >
	<fieldset>
	
    <div class="control-group">
      <label class="control-label" for="username">Email</label>
      <div class="controls">
       <input type="text" class="input-xlarge" id="username" name="username">
      </div>
    </div>
    
	<div class="form-actions">
      <button type="submit" name="submit" id="submit" class="btn btn-primary">Login</button>
    </div>
   
	<br clear="all" />
    </fieldset>
</form>

</body>
</html>

