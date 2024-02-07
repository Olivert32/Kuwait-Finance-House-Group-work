<?php
// Start the session
session_start();
if (!isset($_SESSION['logged_on'])) {
  header('location: login.php');
}
// Set title
$title = 'Profile';
// Load the header
include_once 'inc/head.php';
// Instantiate Class
include_once 'model/user.php';
include_once 'contro/userContro.php';
$user = new UserContro();
$result = $user->getUser($_SESSION['userID']);
?>
<div class="profile-page">
  <div class="between">
    <h1>My Account:</h1>
    <a href="profile-edit.php" class="btn black">Edit Profile</a>
  </div>
  <div class="profile grid-2-2">
    <div class="box">
      <p>User ID:</p>
      <p><?= $result['userID'] ?></p>
    </div>
    <div class="box">
      <p>Username:</p>
      <p><?= $result['username'] ?></p>
    </div>
    <div class="box">
      <p>First Name:</p>
      <p><?= $result['firstName'] ?></p>
    </div>
    <div class="box">
      <p>Last Name:</p>
      <p><?= $result['lastName'] ?></p>
    </div>
    <div class="box">
      <p>Email:</p>
      <p class="email"><?= $result['email'] ?></p>
    </div>
    <div class="box">
      <p>Mobile:</p>
      <p><?= $result['mobile'] ?></p>
    </div>
    <div class="box">
      <p>Role:</p>
      <p><?= $result['role'] ?></p>
    </div>
    <div class="box">
      <p>account: </p>
      <p>
        <?php if ($result['active'] == 1) { ?>
          active
        <?php } else { ?>
          in-active
        <?php } ?>
      </p>
    </div>
  </div>
</div>
<?php
// Load the footer
include_once 'inc/foot.php';
?>