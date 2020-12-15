<!DOCTYPE html>
<html lang="en">
    <?php
    require_once '../view/header.php';
    $title = 'Error Page'
    ?>
    <body>
    <?php
    require_once '../view/nav.php';
    ?>
    <h1><?php echo $errorMessage ?></h1>
    <?php 
    require_once '../view/footer.php';