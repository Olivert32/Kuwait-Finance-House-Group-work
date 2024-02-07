<?php
session_start();
if ($_SESSION['active'] != 1) {
    header('location: login.php');
}
if (!isset($_GET['id'])) {
    header('location: view.php');
}
// Instantiate Class
include_once 'model/document.php';
include_once 'contro/documentContro.php';
$document = new DocumentContro();
$results = $document->getDocumentByPaths($_GET['id']);
// Delete document
if (isset($_POST['delete'])) {
    $filePath = $_POST['file'];
    $document->deleteDocument($filePath);
    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            header('Location: view.php?error=file deleted');
        } else {
            $_SESSION['error'] = 'Error deleting file';
        }
    } else {
        $_SESSION['error'] = 'File does not exist';
    }
}
$title = 'Detail';
include_once 'inc/head.php';
// Error
if (isset($_SESSION['error'])) {
    echo '<p class="error">' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']);
}
foreach ($results as $result) {
    include_once 'contro/timelineContro.php';
    $timeline = new TimelineContro();
    $timeline->addNewTimeLine('user viewed document', $_SESSION['userID'], $result['documentID']);
?>
    <form method="POST" class="box max-500 detail-page">
        <h1>document detail</h1>
        <div>
            <p>ID: </p>
            <p><?= $result['documentID'] ?></p>
        </div>
        <div>
            <p>Title: </p>
            <p><?= $result['title'] ?></p>
        </div>
        <div>
            <p>Level: </p>
            <p><?= $result['level'] ?></p>
        </div>
        <div>
            <p>Uploader: </p>
            <p><?= $result['firstName'] ?> <?= $result['lastName'] ?></p>
        </div>
        <div>
            <p>Upload date: </p>
            <p><?= $result['date'] ?></p>
        </div>
        <?php if ($result['editorID'] != null) { ?>
            <div>
                <p>Editor name: </p>
                <p><?= $result['editorID'] ?></p>
            </div>
            <div>
                <p>Edit date: </p>
                <p><?= $result['editDate'] ?></p>
            </div>
        <?php } ?>
        <div class="gap-row">
            <a href="<?= $result['filePath'] ?>" class="btn black">View</a>
            <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'adder') { ?>
                <!-- Delete = Admin || Adder -->
                <input type="hidden" value="<?= $result['filePath'] ?>" name="file">
                <button class="btn red" name="delete">delete</button>
            <?php }
            if ($_SESSION['role'] == 'editor') { ?>
                <!-- Delete = Editor -->
                <a href="edit.php?filePath=<?= $result['filePath'] ?>" class="btn blue">edit</a>
            <?php } ?>
        </div>
        <?php
        $extension = pathinfo(basename($_GET['id']), PATHINFO_EXTENSION); // get the extension
        if ($extension == "png" || $extension == "jpg" || $extension == "jpeg") { ?>
            <img src="<?= $result['filePath'] ?>" class="max-500">
        <?php } ?>
    </form>
<?php }
include_once 'inc/foot.php';
