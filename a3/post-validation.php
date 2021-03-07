<?php
error_reporting(0);

//Having trouble getting this to behave properly (i.e. only load up after a failed log in)
$errors = [
    "name" => "",
    "password" => "",
    "email" => "",
    "mobile" => "",
    "subject" => "",
    "message" => "",
    "errorCount" => 0
];

$formData = [
    "name" => "",
    "password" => "",
    "email" => "",
    "mobile" => ""
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["logOff"])) {
        setcookie("logIn", "", time() - 3600);
        setcookie("name", "", time() - 3600);
        setcookie("password", "", time() - 3600);
        setcookie("email", "", time() - 3600);
        setcookie("mobile", "", time() - 3600);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
    
    if ($_POST["name"] != "IanBBB") {
        $errors["errorCount"] += 1;
        $errors["name"] = "Your name's not IanBBB";
    }
    $formData["name"] = sanitise($_POST["name"]);

    if ($_POST["password"] != "p4ssw0rd") {
        $errors["errorCount"] += 1;
        $errors["password"] = "IanBBB's password is p4ssw0rd";
    }
    $formData["password"] = sanitise($_POST["password"]);
    
    if (empty($_POST["email"])) {
        $errors["errorCount"] += 1;
        $errors["email"] = "Please enter email address";
    }
    $formData["email"] = sanitise($_POST["email"]);
    
    $formData["mobile"] = sanitise($_POST["mobile"]);

    //Couldn't figure out how to get this thing to behave after clicking the "Log in" button - keeps overwriting the $formData and $errors arrays
    if (!empty($_POST["logIn"])) {
        if ($errors["errorCount"] == 0) {
            setcookie("logIn", "true", time() + 3600);

            if (!empty($_POST["rememberMe"])) {
                setcookie("name", sanitise($_POST["name"]), time() + 3600);
                setcookie("email", sanitise($_POST["email"]), time() + 3600);
                setcookie("mobile", sanitise($_POST["mobile"]), time() + 3600);
            }

            header("Location: index.php");
        } else {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }     
    }

    if (!empty($_POST["back"])) {
        header("Location: index.php");
    }

    if (!empty($_POST["editLetters"])) {
        header("Location: edit-letters.php");
    }

    if(!empty($_POST["send"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

function sanitise($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>