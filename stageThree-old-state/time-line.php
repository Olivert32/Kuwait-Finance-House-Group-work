<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('location: index.php');
}
if ($_SESSION['active'] != 1) {
    header('location: login.php');
}
$title = 'timeline';
include 'inc/head.php';
include_once 'contro/timelineContro.php';
$timeline = new TimelineContro();
$results = $timeline->getAllTimeLine();
$summarys = $timeline->summary();
$summarysAll = $timeline->summaryAll();
$data_json = json_encode($summarysAll);
?>
<div style="display: flex; flex-direction: row; gap: 20px; margin: 20px;">
    <a href="time-line.php" class="btn black">both</a>
    <a href="time-line.php?view=1" class="btn black">summary</a>
    <a href="time-line.php?view=2" class="btn black">timeline</a>
</div>
<?php if (isset($_GET['view'])) {
    if ($_GET['view'] == 1) {
        include_once 'inc/summary.php';
    } else {
        include_once 'inc/timeline.php';
    }
} else {
    include_once 'inc/summary.php';
    include_once 'inc/timeline.php';
}
include 'inc/foot.php';
