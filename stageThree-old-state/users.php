<?php
// Start the session
session_start();
// Only admin/adder allowed on here
if ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'adder') {
    header('location: login.php');
}
// Only active user allowed on here
if ($_SESSION['active'] != 1) {
    header('location: login.php');
}
// Set title
$title = 'Users';
// Load the header
include_once 'inc/head.php';
// Instantiate Class
include_once 'model/user.php';
include_once 'contro/userContro.php';
$user = new UserContro();
include_once 'contro/timelineContro.php';
$timeline = new TimelineContro();
$summarysAll = $timeline->staffAll();
$data_json = json_encode($summarysAll);
if (isset($_POST['activate'])) {
    include_once 'contro/timelineContro.php';
    $timeline = new TimelineContro();
    $timeline->addNewTimeLine('user activated', $_SESSION['userID'], $_POST['userID']);
    $user->acceptUser($_POST['userID']);
}
if (isset($_POST['deactivate'])) {
    include_once 'contro/timelineContro.php';
    $timeline = new TimelineContro();
    $timeline->addNewTimeLine('user deactivated', $_SESSION['userID'], $_POST['userID']);
    $user->deactive($_POST['userID']);
}
$results = $user->getAllCurrentUser();
if (isset($_SESSION['error'])) {
    if (isset($_POST['deactivate'])) {
        echo '<p class="error">' . $_SESSION['error'] . '</p>';
        unset($_SESSION['error']);
        echo '<script>setTimeout(function() { document.querySelector(".error").style.display = "none"; }, 7000);</script>';
    }
}
if (isset($_SESSION['error'])) {
    if (isset($_POST['activate'])) {
        echo '<p class="valid-message">' . $_SESSION['error'] . '</p>';
        unset($_SESSION['error']);
        echo '<script>setTimeout(function() { document.querySelector(".valid-message").style.display = "none"; }, 7000);</script>';
    }
}
?>
<div class="between">
    <h1>Users</h1>
    <input type="text" id="searchBar" placeholder="Search..." class="box">
</div>
<?php include_once 'inc/chart.php'; ?>
<table>
    <thead>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="table-body">
        <?php foreach ($results as $result) { ?>
            <tr>
                <td class="flex gap-row">
                    <?php if ($result['active'] == 0) { ?>
                        <div class="circle red"></div>
                    <?php } else { ?>
                        <div class="circle lime"></div>
                    <?php } ?>
                    <?= $result['userID'] ?>
                </td>
                <td><?= $result['firstName'] . ' ' . $result['lastName'] ?></td>
                <td><?= $result['username'] ?></td>
                <td><?= $result['email'] ?></td>
                <td><?= $result['role'] ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="userID" value="<?= $result['userID'] ?>">
                        <?php if ($result['active'] == 0) { ?>
                            <button onClick='javascript: return confirm("are you sure you want to Re-activate this user?");' name="activate" class="btn lime" style="width: 115px">Activate</button>
                        <?php } else { ?>
                            <button onClick='javascript: return confirm("are you sure you want to De-activate this user?");' name="deactivate" class="btn red" style="width: 115px">De-activate</button>
                        <?php } ?>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php
// Load the footer
include_once 'inc/foot.php';
?>