<?php

//not really sure what to do with this array...----------------------------!!!
/*$_POST["errors"] = [
    "name" => "",
    "password" => "",
    "email" => "",
    "mobile" => "",
    "subject" => "",
    "message" => "",
    "errorCount" => 0
];*/

//$_POST["errors"]["password"] = "Your password's not 'p4ssw0rd'";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["logOff"])) {
        setcookie("logIn", "", time() - 3600);
        setcookie("name", "", time() - 3600);
        setcookie("password", "", time() - 3600);
        setcookie("email", "", time() - 3600);
        setcookie("mobile", "", time() - 3600);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
    
    if (!empty($_POST["logIn"])) {
        //$_POST["errors"]["errorCount"] = 0;
        if ($_POST["name"] != 'IanBBB') {
            $_POST["errors"]["errorCount"] = 1;
            $_POST["errors"]["name"] = "Your'e not 'IanBBB'";
        }
        if ($_POST["password"] != 'p4ssw0rd') {
            $_POST["errors"]["errorCount"] = 1;
            $_POST["errors"]["password"] = "IanBBB's password is 'p4ssw0rd'";
        }
        if (empty($_POST["email"])) {
            $_POST["errors"]["errorCount"] = 1;
            $_POST["errors"]["email"] = "Please enter a valid email";
        }
        
        if ($_POST["errors"]["errorCount"] == 0) {
            setcookie("logIn", "true", time() + 3600);
            $_POST["name"] = sanitise($_POST["name"]);
            $_POST["password"] = sanitise($_POST["password"]);
            $_POST["email"] = sanitise($_POST["email"]);
            $_POST["mobile"] = sanitise($_POST["mobile"]);
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
        unset($_POST["back"]);
    }
    
    if (!empty($_POST["editLetters"])) {
        header("Location: edit-letters.php");
        unset($_POST["editLetters"]);
    }
    
    /*if (empty($_POST["name"])) {
        $errors["name"] = "Please enter a name";
    } else {
        $formData["name"] = sanitise($_POST["name"]);
    }
    if (!empty($_POST["rememberMe"]) and !empty($_POST["logIn"])) {
        setcookie("name", sanitise($_POST["name"]), time() + 3600);
    }

    if (empty($_POST["password"])) {
        $errors["password"] = "Password error message"; //say something meaniningful-----------------!!!
    } else {
        $formData["password"] = sanitise($_POST["password"]);
    }
    if (!empty($_POST["rememberMe"]) and !empty($_POST["logIn"])) {
        setcookie("password", sanitise($_POST["password"]), time() + 3600);
    }

    if (empty($_POST["email"])) {
        $errors["email"] = "Please provide a valid email address";
    }
    if (!empty($_POST["rememberMe"]) and !empty($_POST["logIn"])) {
        setcookie("email", sanitise($_POST["email"]), time() + 3600);
    }

    if (!empty($_POST["rememberMe"]) and !empty($_POST["logIn"])) {
        setcookie("mobile", sanitise($_POST["mobile"]), time() + 3600);
    }

    if (!empty($_POST["rememberMe"])) {
        setcookie("logIn", "true", time() + 3600);
    }*/

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

    //header("Location: " . $_SERVER["HTTP_REFERER"]);
    //header("Location: index.php?articleID=Contact+me");
    if(!empty($_POST["send"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    //unset($_POST["send"]);
    //unset($_POST["logIn"]);
    //unset($_POST["rememberMe"]);
}

function sanitise($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

?>