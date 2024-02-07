<?php
session_start();
if ($_SESSION['role'] != 'adder') {
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
?>
<div class="box max-500">
    <h1>timeline</h1>
    <?php foreach ($results as $result) { 
        if ($result['action_userID'] == $_SESSION['userID']) { ?>
            <div class="timeline box">
            <div>
                <p>action id: </p>
                <p><?= $result['action_ID'] ?></p>
            </div>
            <div>
                <p>action: </p>
                <p><?= $result['action_name'] ?></p>
            </div>
            <div>
                <p>action taker ID: </p>
                <p><?= $result['action_userID'] ?></p>
            </div>
            <div>
                <p>action taker: </p>
                <p><?= $result['firstName'] ?> <?= $result['lastName'] ?></p>
            </div>
            <div>
                <p>effected document/user ID: </p>
                <p><?= $result['action_documentID'] ?></p>
            </div>
            <div>
                <p>time: </p>
                <p><?= $result['hour'] ?> / <?= $result['date'] ?></p>
            </div>
        </div>
        <?php }
     } ?>
</div>
<?php
include 'inc/foot.php';
