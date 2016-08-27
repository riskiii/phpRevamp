<?php
$first_name = $_POST['first_name'];
$last_name  = $_POST['last_name'];
$email      = $_POST['email'];
$comments   = $_POST['comments'];
$human      = $_POST['human'];
$from       = 'From: DannyGSmith';
$to         = 'dgs@riskiii.com';
$subject    = 'Hello from Contact Form';

var_dump($_POST);

$body = "From: $last_name, $first_name\n E-Mail: $email\n Message:\n $comments";

if ($_POST['submit']) {
   if ($last_name != '' && $first_name != '' && $email != '') {
      if ($human == '4') {
         if (mail ($to, $subject, $body, $from)) {
            echo '<p>Your message has been sent!</p>';
         } else {
            echo '<p>Something went wrong, go back and try again!</p>';
         }
      } else if ($_POST['submit'] && $human != '4') {
         echo '<p>You answered the anti-spam question incorrectly!</p>';
      }
   } else {
      echo '<p>You need to fill in all required fields!!</p>';
   }
}