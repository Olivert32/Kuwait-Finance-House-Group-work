<?php
$title = 'Reset Password';
include_once 'inc/head.php';
include_once 'contro/registerContro.php';
if (isset($_POST['password'])) {
    $register = new RegisterContro($_POST['username'], $_POST['password'], null, null, null, null, null, null);
    $register->getNewPassword();
}
$register = new RegisterContro($_POST['username'], null, null, $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['mobile'], null);
$register->isDetailCorrect();
?>
    <form method="POST" class="max-500 box">
        <h1>Reset</h1>
        <input type="hidden" name="username" value="<?= $_POST['username'] ?>">
        <label for="password">password</label>
        <input type="password" name="password" id="password">
        <button class="btn black">reset</button>
    </form>
<?php
include_once 'inc/foot.php';