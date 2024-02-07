<?php
// Start the session
session_start();
// Only admin allowed on here
if ($_SESSION['role'] != 'admin' || $_SESSION['active'] != 1) {
    header('location: login.php');
}
// Only active user allowed on here
if ($_SESSION['active'] != 1) {
    header('location: login.php');
}
// Set title
$title = 'Account Request';
// Load the header
include_once 'inc/head.php';
// Get all inactive users
// Instantiate Class
include_once 'model/user.php';
include_once 'contro/userContro.php';
$user = new UserContro();
include_once 'contro/timelineContro.php';
$timeline = new TimelineContro();
// Activate User
if (isset($_POST['accept'])) {
    $timeline->addNewTimeLine('add new person into system', $_SESSION['userID'], $_POST['userID']);
    $user->acceptUser($_POST['userID']);
}
// Delete User
if (isset($_POST['decline'])) {
    $timeline->addNewTimeLine('declined new person into system', $_SESSION['userID'], $_POST['userID']);
    $user->declineUser($_POST['userID']);
}
// Store the data
$results = $user->getAllInactiveUser();
?>
<h1>Account Request</h1>
<!--Error  -->
<?php if (isset($_SESSION['error'])) {
    if(isset($_POST['accept'])){
    echo '<p class="valid-message">' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']);
    echo '<script>setTimeout(function() { document.querySelector(".valid-message").style.display = "none"; }, 5000);</script>';
    }
} 
 if (isset($_SESSION['error'])) {
    if(isset($_POST['decline'])){
    echo '<p class="error">' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']);
    echo '<script>setTimeout(function() { document.querySelector(".error").style.display = "none"; }, 5000);</script>';
    }
}
?>
<?php
if ($results != 0) { ?>
    <div class="grid-2-2">
        <?php foreach ($results as $result) { ?>
            <div class="account_request box">
                <!-- User Info -->
                <p><strong>First name:</strong> <?= $result['firstName'] ?></p>
                <p><strong>Last name:</strong> <?= $result['lastName'] ?></p>
                <p><strong>Username:</strong> <?= $result['username'] ?></p>
                <p><strong>Role:</strong> <?= $result['role'] ?></p>
                <p style="grid-column: span 2"><strong>Email address:</strong> <?= $result['email'] ?></p>
                <!-- Accept / Decline -->
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" style="grid-column: span 2">
                    <input type="hidden" value="<?= $result['userID'] ?>" name="userID">
                    <button name="accept" class="btn lime">Accept</button>
                    <button name="decline" class="btn red">Decline</button>
                </form>
            </div>
        <?php } ?>
    </div>
<?php } else { ?>
    <p class="no-user">No new users found</p>
<?php } ?>
<?php
// Load the footer
include_once 'inc/foot.php';
?>