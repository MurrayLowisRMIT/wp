<?php

$formData = [
    "name" => "",
    "email" => "",
    "mobile" => "",
    "subject" => "",
    "message" => ""
];

$errors = [
    "name" => "",
    "email" => "",
    "mobile" => "",
    "subject" => "",
    "message" => ""
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $errors["name"] = "Please enter a name";
    } else {
        $formData["name"] = sanitise($_POST["name"]);
    }
    if (!empty($_POST["rememberMe"])) {
        setcookie("name", sanitise($_POST["name"]), time() + 3600);
    }
    
    if (empty($_POST["email"])) {
        $errors["email"] = "Please provide a valid email address";
    }
    if (!empty($_POST["rememberMe"])) {
        setcookie("email", sanitise($_POST["email"]), time() + 3600);
    }

    if (!empty($_POST["rememberMe"])) {
        setcookie("mobile", sanitise($_POST["mobile"]), time() + 3600);
    }
    
    if (empty($_POST["subject"])) {
        $errors["subject"] = "Please enter a message subject";
    } else {
        sanitise($_POST["subject"]);
    }

    if (empty($_POST["message"])) {
        $errors["message"] = "Please enter your message";
    } else {
        sanitise($_POST["message"]);
    }  
    
    if(empty($_POST["rememberMe"])) {
        setcookie("name", "asdasd", time() - 3600);
        setcookie("email", "", time() - 3600);
        setcookie("mobile", "", time() - 3600);
    }
        
    unset($_POST["send"]);
    unset($_POST["rememberMe"]);
    
    header("Location: index.php?articleID=Contact+me");
}

function sanitise($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

?>