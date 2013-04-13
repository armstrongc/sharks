<?php 
require_once '../common/config.php';

$success = 1;
$errMsg = '';

if(isset($_POST['submit'])){
	include("login_validation.php");
	if($success)include("login_action.php");
} else {
	$_POST["username"] = "";
	$_POST["password"] = "";
}

require_once '../common/header.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li class="active">Login</li>
</ul>

<h1>Login Page</h1>

<div class="alert alert-info">
	Please login below to access this section.
</div>

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
    
    <div class="control-group">
      <label class="control-label" for="password">Password</label>
      <div class="controls">
       <input type="password" class="input-xlarge" id="password" name="password">
      </div>
    </div>
	
    <div class="control-group">
    	<a href="password_reminder.php">Forgotten your password?</a>
    </div>
    
	<div class="form-actions">
      <button type="submit" name="submit" id="submit" class="btn btn-primary">Login</button>
    </div>
   
	<br clear="all" />
    </fieldset>
</form>

</body>
</html>

