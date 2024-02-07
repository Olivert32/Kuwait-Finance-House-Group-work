<?php
// Start the session
session_start();
if (!isset($_SESSION['logged_on'])) {
  header('location: login.php');
}
// Set title
$title = 'Upload file';
// Load the header
include_once 'inc/head.php';
include_once 'model/user.php';
include_once 'contro/userContro.php';
$user = new UserContro();
$result = $user->getUser($_SESSION['userID']);
if (isset($_POST['update'])) {
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $password = $_POST['password'];
  $user->update($email, $mobile, $password);
  header('location: profile.php');
}
?>
<form method="POST" class="box max-500">
  <h1>Edit profile</h1>
  <?php if (isset($_SESSION['error'])) {
    echo '<p class="error">' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']);
  } ?>
  <label for="email">Email</label>
  <input type="email" id="email" class="input-styling" name="email" value="<?= $result['email'] ?>">
  <label for="mobile">Mobile</label>
  <input type="mobile" id="mobile" class="input-styling" name="mobile" value="<?= $result['mobile'] ?>">
  <label for="password">Confirm password</label>
  <input type="password" id="password" class="input-styling" name="password">
  <button name="update" class="btn black">Update</button>
</form>
<?php
// Load the footer
include_once 'inc/foot.php';
?>