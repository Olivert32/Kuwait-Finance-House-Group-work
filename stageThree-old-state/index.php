<?php
// Start the session
session_start();
// Set title
$title = 'Home';
// Load the header
include_once 'inc/head.php';
?>
<div class="carousel">
    <img src="pictures/1.jpg" alt="Image 1">
    <img src="pictures/2.jpg" alt="Image 1">
    <img src="pictures/4.jpg" alt="Image 1">
    <img src="pictures/3.jpg" alt="Image 1">
</div>
<div style="height: 500px"></div>
<div class="index">
<?php if (isset($_SESSION['firstName'])) { ?>
    <h1>Welcome back <?= $_SESSION['firstName'] ?> <?= $_SESSION['lastName'] ?> </h1>
<?php } else { ?>
    <h1><a href="login.php">LOGIN</a></h1>
<?php } ?>
</div>
<?php
// Load the footerv
include_once 'inc/foot.php';
?>