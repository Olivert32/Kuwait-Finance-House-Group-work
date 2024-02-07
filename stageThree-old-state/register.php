<?php
// Start the session
session_start();
// Only none logged on user can view this page
if (isset($_SESSION['logged_on'])) {
    header('location: index.php');
}
// Check if user reached by POST method
if (isset($_POST['register'])) {
    // Grab data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $role = $_POST['role'];



    // Check if passwords match
    if ($password !== $passwordConfirm) {
        $_SESSION['error'] = 'Passwords do not match';
    } else {
        // Hash the password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Instantiate Class
        include_once 'model/register.php';
        include_once 'contro/registerContro.php';
        $register = new registerContro($username, $password, $passwordConfirm, $firstName, $lastName, $email, $mobile, $role);

        // Running the code
        $register->register();

        // Redirect if successful
        header('location: validateEmail.php?email='.$this->$email);
    }
}
// Set title
$title = 'Register';
// Load the header
include_once 'inc/head.php';
?>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="max-500 box">
    <h1>Sign up</h1>
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
    <!-- Password Confirm -->
    <label for="passwordConfirm">Password Confirm</label>
    <input type="password" id="passwordConfirm" name="passwordConfirm">
    <!-- First Name -->
    <label for="firstName">First Name</label>
    <input type="text" id="firstName" name="firstName">
    <!-- Last Name -->
    <label for="lastName">Last Name</label>
    <input type="text" id="lastName" name="lastName">
    <!-- Email -->
    <label for="email">Email</label>
    <input type="email" id="email" name="email">
    <!-- Mobile -->
    <label for="mobile">Mobile</label>
    <input type="number" id="mobile" name="mobile">
    <!-- Role -->
    <label for="role">Role</label>
    <select id="role" name="role">
        <option>Editor</option>
        <option>Viewer</option>
        <option>Adder</option>
        <option>Admin</option>
    </select>
    <!-- Submit -->
    <button name="register" class="btn lime">Register</button>
</form>
<?php
// Load the footer
include_once 'inc/foot.php';
?>