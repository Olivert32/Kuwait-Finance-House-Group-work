<?php
$target_dir = "document/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check file size
if ($_FILES["fileToUpload"]["size"] > 15000000) {
    $_SESSION['error'] = 'Sorry, your file is too large max is 15mb';
    $uploadOk = 0;
    exit();
}

// Allow certain file formats
if (
    $fileType != "pdf" &&
    $fileType != "doc" &&
    $fileType != "docx" &&
    $fileType != "txt" &&
    $fileType != "png" &&
    $fileType != "jpeg" &&
    $fileType != "jpg"
) {
    $_SESSION['error'] = 'Sorry, only pdf, doc, docx, txt, png, jpeg and jpg files are allowed';
    $uploadOk = 0;
    exit();
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $_SESSION['error'] = 'Sorry, your file was not uploaded';
    // if everything is ok, try to upload file
} else {
    $filename = rand(100000000, 1000000000000) . time() . uniqid() . rand(100000000, 1000000000000) . "." . $fileType;
    $target_file = $target_dir . $filename;
    // Check if file already exists
    if (file_exists($target_file)) {
        $_SESSION['error'] = 'Sorry, file already exist';
        $uploadOk = 0;
    }
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $_SESSION['valid'] = 'Your file has been uploaded';

        // Store file path and user in database
        // Instantiate Class
        include_once 'model/document.php';
        include_once 'contro/documentContro.php';
        if ($edit == true) {
            $document = new DocumentContro($_SESSION['userID'], $target_file, $_POST['title'], $_POST['level'], date("Y/m/d"), $documentID);
            if (file_exists($_GET['filePath'])) {
                if (unlink($_GET['filePath'])) {
                    $_SESSION['valid'] = 'File  updated';
                } else {
                    $_SESSION['error'] = 'Error deleting file';
                }
            }
            // Running the code
            $document->updateDocument();
        } 
        if ($title == 'Upload file') {
            $document = new DocumentContro($_SESSION['userID'], $target_file, $_POST['title'], $_POST['level'], date("Y/m/d"));
            // Running the code
            $document->document();
        }
    } else {
        $_SESSION['error'] = 'Sorry, there was an error uploading your file';
    }
}
