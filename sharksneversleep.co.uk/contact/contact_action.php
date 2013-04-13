<?php
$to      = $site_owner_email;
$subject = 'contact message from ' .$site_owner_email;
$message = '
Name: ' .$_REQUEST['name'] .'
Email: ' .$_REQUEST['email'] .'

Message:
' .$_REQUEST['message'];

$headers = 'From: ' . $_REQUEST['email'] . "\r\n" .
    'Reply-To: ' . $_REQUEST['email'] . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

$msg = "Thank you, your message was sent successfully";
$_REQUEST['name'] = "";
$_REQUEST['email'] = "";
$_REQUEST['message'] = "";

?>



