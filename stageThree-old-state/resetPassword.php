<?php
$title = "Reset Password";
include_once 'inc/head.php';
?>
<form action="resetPasswordContinue.php" method="POST" class="max-500 box">
    <h1>Reset password</h1>
    <label for="username">username</label>
    <input type="text" name="username" id="username">
    <label for="firstName">firstName</label>
    <input type="text" name="firstName" id="firstName">
    <label for="lastName">lastName</label>
    <input type="text" name="lastName" id="lastName">
    <label for="email">email</label>
    <input type="email" name="email" id="email">
    <label for="mobile">mobile</label>
    <input type="text" name="mobile" id="mobile">
    <button class="btn black">reset</button>
</form>
<?php
// Load the footer
include_once 'inc/foot.php';
?>