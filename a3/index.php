<?php
    session_start();
    require_once('post-validation.php');
    require_once('tools.php');
    $storage;
    topModule();
    loginModule();
    navModule();
    articleBuilder();
    endModule();
?>