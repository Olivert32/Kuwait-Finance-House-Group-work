<?php
// Start the session
session_start();
$edit = false;
// Set title
$title = 'Upload file';
// Only active user allowed on here
if ($_SESSION['active'] != 1) {
    header('location: login.php');
}
// Only adder allowed on here
if ($_SESSION['role'] != 'adder') {
    header('location: login.php');
}
// Load the header
include_once 'inc/head.php';
// Upload file
if (isset($_POST['submit'])) {
    include_once 'inc/upload.php';
    include_once 'contro/timelineContro.php';
    $timeline = new TimelineContro();
    $timeline->addNewTimeLine('new file uploaded', $_SESSION['userID'], $_SESSION['documentID']);
}
?>
<!-- Form to allow the user to upload -->
<form method="POST" enctype="multipart/form-data" class="max-500 box">
    <h1>Document upload</h1>
    <!--Error  -->
    <?php if (isset($_SESSION['error'])) {
        echo '<p class="error">' . $_SESSION['error'] . '</p>';
        unset($_SESSION['error']);
    }
     if (isset($_SESSION['valid'])) {
        echo '<p class="valid-message">' . $_SESSION['valid'] . '</p>';
        unset($_SESSION['valid']);
    }
     ?>
    <!-- Title -->
    <label for="title">Title</label>
    <input type="text" id="title" name="title">
    <!-- Level -->
    <label for="level">level</label>
    <select id="level" name="level">
        <option>low</option>
        <option>mid</option>
        <option>high</option>
    </select>
    <!-- File -->
    <input type="file" id="file" name="fileToUpload">
    <!-- Submit -->
    <button name="submit" class="btn lime">Upload</button>
</form>
<?php
// Load the footer
include_once 'inc/foot.php';
?>