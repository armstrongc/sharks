<script type="text/javascript">
var RecaptchaOptions = {
    theme : 'custom',
    custom_theme_widget: 'recaptcha_widget'
};
</script>

<div id="comments" class="blog_comment_form">
    <h2>Comments</h2>

    <?php
    require_once ROOT .'/cfc/blogcomment.php';
    $dbobject = new blogcommentObj;
    $where = "post_id='" .$qpost[0]['post_id'] ."' AND is_live=1";
    $qpost = $dbobject->getData($where);
    $recordcount=$dbobject->numrows;
    ?>

    <?php if($recordcount){ ?>

        <?php foreach ($qpost as $row) {?>
            <div class="blog_comment">
            <?php echo $row['comment_name'] ?>,
            <?php echo $row['comment_location'] ?><br />
            <?php echo date("jS F Y H:i:s", strtotime($row['comment_date'])); ?><br />
            <?php echo $row['comment_copy'] ?>
            </div>
        <?php } ?>

    <?php } else { ?>
        <p>There are currently no comments</p>
    <?php } ?>

    <?php if($blog_comment_success){ ?>
    <p>Thanks for your comment, it'll be up on the page shortly.</p>
    <?php } ?>
    <?php if($blog_comment_error){ ?>
    <p>Looks like there was a problem. Please fix the errors on the form below</p>
    <?php } ?>

    <form method="post" class="site_form" id="blog_comment_form" action="<?php echo $inline_canonical .'#comments'; ?>">

        <div class="form_row">
            <label for="comment_name">Name</label>
            <input type="text" class="textinput" id="comment_name" name="comment_name" required />
        </div>

        <div class="form_row">
            <label for="comment_location">Location</label>
            <input type="text" class="textinput" id="comment_location" name="comment_location" required />
        </div>

        <div class="form_row">
            <label for="comment_copy">Comment</label>
            <textarea class="textinput" id="comment_copy" name="comment_copy" rows="5"></textarea>
        </div>

        <?php
        /*
        require_once ROOT .'/includes/recaptcha-php-1.11/recaptchalib.php';
        $publickey = $recapcha_public_key;
        echo recaptcha_get_html($publickey);
        */
        ?>

        <div id="recaptcha_widget" style="display:none">

           <div id="recaptcha_image"></div>
           <div class="recaptcha_only_if_incorrect_sol" style="color:red">Incorrect please try again</div>

           <span class="recaptcha_only_if_image">Enter the words above:</span>
           <span class="recaptcha_only_if_audio">Enter the numbers you hear:</span>
           <br />

           <div class="form_row">
           <input type="text" class="textinput" id="recaptcha_response_field" name="recaptcha_response_field" />
           </div>

           <!-- <div><a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a></div>
           <div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
           <div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>

           <div><a href="javascript:Recaptcha.showhelp()">Help</a></div> -->

         </div>

         <script type="text/javascript"
            src="http://www.google.com/recaptcha/api/challenge?k=<?php echo $recapcha_public_key ?>">
         </script>

         <noscript>
           <iframe src="http://www.google.com/recaptcha/api/noscript?k=<?php echo $recapcha_public_key ?>" height="300" width="500" frameborder="0"></iframe><br>
           <textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
           <input type="hidden" name="recaptcha_response_field" value="manual_challenge">
         </noscript>

        <div class="form_row">
        <input type="submit" class="submitbtn" name="submit" id="submit" value="Post Comment" />
    </div>

    </form>
</div>
