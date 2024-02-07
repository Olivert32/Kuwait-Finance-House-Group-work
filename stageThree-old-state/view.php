<?php
session_start();
if ($_SESSION['active'] != 1) {
    header('location: login.php');
}
// Instantiate Class
include_once 'model/document.php';
include_once 'contro/documentContro.php';
$document = new DocumentContro();
// Adder can only view files they uploaded
if ($_SESSION['role'] == 'adder') {
    $results = $document->getDocument($_SESSION['userID']);
}
// Admin & Viewer can view all the documents
if ($_SESSION['role'] != 'adder') {
    $results = $document->getDocument();
}
// Set title
$title = 'View files';
// Load the header
include_once 'inc/head.php';
// Error
if (isset($_GET['error'])) {
    echo '<p class="error">' . $_GET['error'] . '</p>';
}
if (isset($_SESSION['error'])) {
    echo '<p class="error">' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']);
}
include_once 'contro/timelineContro.php';
$timeline = new TimelineContro();
$summarysAll = $timeline->getDocumentLevel();
$data_json = json_encode($summarysAll);
include_once 'inc/document-level-chart.php';
?>
<div class="between">
    <h1>Documents</h1>
    <input type="text" id="searchBar" placeholder="Search..." class="box">
</div>
<form method="POST">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Date</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <?php foreach ($results as $result) { ?>
                <tr>
                    <td><?= $result['documentID'] ?></td>
                    <td><?= $result['title'] ?></td>
                    <td><?= $result['date'] ?></td>
                    <td><?= $result['level'] ?></td>
                    <td><a href="detail.php?id=<?= $result['filePath'] ?>" class="btn black">View</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</form>
<?php
// Load the footer
include_once 'inc/foot.php';
?>