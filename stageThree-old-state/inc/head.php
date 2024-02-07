<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="/stageThree/js/main.js" defer></script>
    <script src="/stageThree/js/search.js" defer></script>
    <title><?= $title ?></title>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/desktop.css" media="only screen and (min-width: 1000px)" />
    <link rel="stylesheet" href="css/mobile.css" media="only screen and (max-width: 1000px)" />
</head>

<body>
    <header>
        <nav class="wrapper">
            <a href="index.php" class="logo">Kuwait Finance House</a>
            <div class="burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul>
                <li><a class="active" href="index.php">Home</a></li>
                <!-- Logged in view -->
                <?php if (isset($_SESSION['logged_on'])) {
                    if ($_SESSION['role'] == 'admin') { ?>
                        <!-- Admin -->
                        <li><a href="account.php">Approval</a></li>
                        <li><a href="users.php">Users</a></li>
                        <li><a href="time-line.php">Time Line</a></li>
                    <?php }
                    if ($_SESSION['role'] == 'adder') { ?>
                        <!-- Adder -->
                        <li><a href="upload.php">Upload</a></li>
                        <li><a href="time-line-adder.php">Timeline</a></li>
                        <?php } ?>
                    <li><a href="view.php">View</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="inc/logout.php">Logout</a></li>
                    <!-- Not logged in view -->
                <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
            </ul>
        <?php } ?>
        </nav>
    </header>
    <main class="wrapper">