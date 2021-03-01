<?php
    session_start();
    require_once('tools.php');
    topModule();
    navModule();
?>

<?= articleBuilder(); ?>

<?= endModule(); ?>