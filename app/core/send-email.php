<?php

    // Define error variables
    $errName = $errEmail = $errMessage = '';

    // Define result
    $result = '';

    // check if form is submitted
    if(isset($_POST["submit"])){

    // assign POST variables and sanitize
    $name = filter_var($_POST["name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST["message"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Define email
    $to = 'contact@damionvoshall.com';

    // Create subject
    $subject = "$name submitted a form from your portfolio site.";

    // Create Body
    $body = "From: $name\n E-mail: $email\n Message:\n $message";

    // Create Headers
    $headers = 'From: '.$to."\r\n" .
        'Reply-To: '.$email."\r\n";

    // Check if name has been entered
    if (!$_POST['name']) {
        $errName = 'Please enter your name';
    }

    // Check if email has been entered and validate
    if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errEmail = 'Please enter a valid email address.';
    }

    // Check if message has been entered
    if (!$_POST['message']) {
        $errMessage = 'Please enter your message.';
    }

    // If no errors, send email, add to database
    if (!$errName && !$errEmail && !$errMessage) {

        $data = [];
        $data['content'] = $_POST['message'];
        $data['email'] = $_POST['email'];
        $data['name'] = $_POST['name'];

        $query = "INSERT INTO emails (content,email,name) VALUES (:content,:email,:name)";

        query($query, $data);


       if (mail ($to, $subject, $body, $headers)) {
            $result='<div><p class="color-primary font-size-small font-roboto">Email Sent! You will receive a reply shortly</p></div>';
        } else {
            $result='<div><p class="alert-fail font-size-small font-roboto">Sorry, there was an issue processing your request. Please try again later.</p></div>';
        }
    }
    }
