<?php
// Start the session
session_start();
$edit = true;
$title = 'Edit file';
// Only admin/editor allowed on here
if ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'editor') {
    header('location: login.php');
}
// Only active user allowed on here
if ($_SESSION['active'] != 1) {
    header('location: login.php');
}
// Check if they got here by GET
if (!$_GET['filePath']) {
    header('location: login.php');
}
// Store the file path from GET
$filePath = $_GET['filePath'];
// Check they got here by POST
if (isset($_POST['update'])) {
    $newTitle = $_POST['title'];
    $newLevel = $_POST['level'];
    $documentID = $_POST['documentID'];
    if ($_POST['newFile'] == 'yes') {
        include_once 'inc/upload.php';
    } else {
        $newDocument = $filePath;
        // Instantiate Class
        include_once 'model/document.php';
        include_once 'contro/documentContro.php';
        $document = new DocumentContro();
        include_once 'contro/timelineContro.php';
        $timeline = new TimelineContro();
        $timeline->addNewTimeLine('edit document', $_SESSION['userID'], $documentID);
        // Running the code
        $document->updateDocumentNoFile($_SESSION['userID'], $_POST['title'], $_POST['level'], date("Y/m/d"), $documentID);
    }
}
// Instantiate Class
include_once 'model/document.php';
include_once 'contro/documentContro.php';
$document = new DocumentContro();
// Get all of the document info
$file = $document->getDocumentPath($filePath);
// Load the header
include_once 'inc/head.php';
// retrieve all files in the specified directory path
$dir_path = 'document/';
$myFiles = glob($dir_path . '*.{pdf,doc,docx,txt,png,jpeg,jpg}', GLOB_BRACE);
foreach ($myFiles as $myFile) {
    $new_array = array();
    $new_array[] = $filePath;
    if (in_array($myFile, $new_array)) {
?>
        <form method="POST" enctype="multipart/form-data" class="max-500 box">
            <div class="between">
                <h1>Edit document</h1>
                <div class="gap-row">
                    <a href="<?= $filePath ?>" class="btn blue">View</a>
                    <button name="update" class="btn lime">Update</button>
                </div>
            </div>
            <?php if (isset($_SESSION['error'])) {
                echo '<p class="error">' . $_SESSION['error'] . '</p>';
                unset($_SESSION['error']);
            } 

           if (isset($_SESSION['valid'])) {
                echo '<p class="valid-message">' . $_SESSION['valid'] . '</p>';
                unset($_SESSION['valid']);
              echo '<script>setTimeout(function() { document.querySelector(".valid-message").style.display = "none"; }, 5000);</script>';
           }
            ?>
            <input type="hidden" name="documentID" value="<?= $file['documentID'] ?>">
            <label for="title">Title</label>
            <input type="text" value="<?= $file['title'] ?>" name="title" id="title">
            <label for="level">level</label>
            <select id="level" name="level">
                <option>low</option>
                <option>mid</option>
                <option>high</option>
            </select>
            <label for="newFile">Are you updating the file as well?</label>
            <select id="newFile" name="newFile">
                <option>yes</option>
                <option>no</option>
            </select>
            <label for="file">New File</label>
            <input type="file" id="file" name="fileToUpload">
        </form>
<?php
    }
}
// Load the footer
include_once 'inc/foot.php';
?>