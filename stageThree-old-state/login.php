<?php
// Start the session
session_start();
// Only none logged on user can view this page
if (isset($_SESSION['logged_on'])) {
    header('location: index.php');
}
// Check if user reached by POST method
if (isset($_POST['login'])) {
    // Grab data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Instantiate Class
    include_once 'model/login.php';
    include_once 'contro/loginContro.php';
    $login = new LoginContro($username, $password);

    // Running the code
    $login->login();

    // Redirect if successful
    header('location: index.php');
}
// Set title
$title = 'Login';
// Load the header
include_once 'inc/head.php';
?>
<form method="POST" class="max-500 box">
    <h1>Log In</h1>
    <!--Error  -->
    <?php if (isset($_SESSION['error'])) {
        echo '<p class="error">' . $_SESSION['error'] . '</p>';
        unset($_SESSION['error']);
    } ?>
    <!-- Username -->
    <label for="username">Username</label>
    <input type="text" id="username" name="username">
    <!-- Password  -->
    <label for="password">Password</label>
    <input type="password" id="password" name="password">
    <!-- Submit -->
    <button name="login" class="btn lime">Login</button>
    <a href="resetPassword.php">Forgotten Password?</a>
</form>
<?php
// Load the footer
include_once 'inc/foot.php';
?>