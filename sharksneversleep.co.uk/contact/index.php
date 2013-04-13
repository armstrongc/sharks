<?php
include '../common/config.php';
include '../common/header_start.php';
include '../common/header_end.php';
?>

<?php
// page params
$success = true;
$msg = "";

// form params
if (!isset($_REQUEST['name'])) { $_REQUEST['name'] = ""; }
if (!isset($_REQUEST['email'])) { $_REQUEST['email'] = ""; }
if (!isset($_REQUEST['message'])) { $_REQUEST['message'] = ""; }

// error params
if (!isset($_REQUEST['name.error'])) { $_REQUEST['name.error'] = false; }
if (!isset($_REQUEST['email.error'])) { $_REQUEST['email.error'] = false; }
if (!isset($_REQUEST['message.error'])) { $_REQUEST['message.error'] = false; }

// form submitted
if (isset($_REQUEST['submit_contact'])){
  // form validation
  include 'contact_validation.php';
  if($success){
	// form action
	include 'contact_action.php';
  }
}
?>

<section class="container_12 clearfix">

    <div class="grid_6">
      <!-- contact details -->
      <article id="contactDetails">
        <header><h2>Contact</h2></header>
        <p>If you'd like to get in touch, my contact details are below, or feel free to send me a message using the form provided, and I'll get back to you as soon as possible.</p>
        <ul class="list">
          <li>Sharks Never Sleep</li>
          <li><a href="mailto:<?php echo $site_owner_email ?>"><?php echo $site_owner_email ?></a></li>
        </ul>
      </article>
    </div>

    <div class="grid_6">
      <!-- contact form -->
      <article id="contactForm">

        <?php if ($msg != "") {
          echo "<p class='error_text'>" .$msg ."</p>";
        }?>

        <form name="contact_form" id="contact_form" class="site_form" method="post" action="/contact/">

          <div class="form_row<?php if ($_REQUEST['name.error']) {?> form_error<?php } ?>">
            <label for="name" class="mandatory">Name:</label>
            <input type="text" name="name" id="name" class="textinput" value="<?php echo $_REQUEST['name']?>" required />
          </div>

          <div class="form_row<?php if ($_REQUEST['email.error']) {?> form_error<?php } ?>">
            <label for="email" class="mandatory">Email:</label>
            <input type="email" name="email" id="email" class="textinput" value="<?php echo $_REQUEST['email']?>" required />
          </div>

          <div class="form_row<?php if ($_REQUEST['message.error']) {?> form_error<?php } ?>">
            <label for="message" class="mandatory">Message:</label>
            <textarea name="message" id="message" class="textareainput" rows="10" required><?php echo $_REQUEST['message']?></textarea>
          </div>

          <input type="submit" name="submit_contact" id="submit_contact" class="submit-button" value="submit" />
          <br clear="all" />

        </form>

      </article>
    </div>
</section>


<?php
include '../common/footer_start.php';
include '../common/footer_end.php';
?>
