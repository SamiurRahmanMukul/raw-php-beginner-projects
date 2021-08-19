<?php

$name = $_POST['txtName'];
$phone = $_POST['txtPhone'];
$email = $_POST['txtEmail'];
$message = $_POST['txtMsg'];

$email_from = "temp-user@mail.com";
$email_subject = "New Contact Form Submission";
$email_message = "User name: $name \n" .
    "User Phone: $phone \n" .
    "User Email: $email \n" .
    "User Message: $message";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= "From: $email_from" . "\r\n";
$headers .= "Cc: $email" . "\r\n";

// mail send
$result = mail($email_from, $email_subject, $email_message, $headers);

// redirect home
if ($result == true) {
    header("Location: ./../index.html");
} else {
    echo 'Sorry! Something went to wrong.';
}
