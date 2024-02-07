<?php
include_once 'dbh.php';
class Document extends Dbh
{
    protected function saveDocumentPath($userID, $file, $title, $level, $date)
    {
        // $sql = 'INSERT INTO `document`(`userID`, `filePath`, `title`, `level`, `date`) VALUES (?, ?, ?, ?, ?)';
        $sql = 'INSERT INTO `document`(`userID`, `filePath`, `title`, `level`, `date`) VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userID, $file, $title, $level, $date]);

        $sql = 'SELECT * FROM `document` WHERE `userID` = ? ORDER BY `document`.`documentID` DESC LIMIT 1';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userID]);
        $result = $stmt->fetchAll();
        $_SESSION['documentID'] = $result[0]['documentID'];
        
        $sql = 'INSERT INTO `summary`(`action`, `date`) VALUES (?, ?)';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['upload', date('m-Y')]);
    }
    protected function getAllDocument($userID = null)
    {
        if ($userID == null) {
            $sql = 'SELECT * FROM `document` ORDER BY `documentID` DESC';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } else {
            $sql = 'SELECT * FROM `document` WHERE `userID` = ? ORDER BY `documentID` DESC';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$userID]);
            $result = $stmt->fetchAll();
            return $result;
        }
    }
    protected function deleteDocumentById($file)
    {
        $sql = 'DELETE FROM `document` WHERE `filePath` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$file]);
        $sql = 'INSERT INTO `summary`(`action`, `date`) VALUES (?, ?)';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['delete', date('m-Y')]);
    }
    protected function getDocumentByPath($filePath)
    {
        $sql = 'SELECT * FROM `document` WHERE `filePath` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$filePath]);
        $result = $stmt->fetch();
        return $result;
    }
    protected function updateDocumentByID($userID, $file, $title, $level, $date, $documentID)
    {
        $sql = 'UPDATE `document` SET `editorID` = ?, `filePath` = ?, `title` = ?, `level` = ?, `editDate` = ? WHERE `documentID` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userID, $file, $title, $level, $date, $documentID]);
        header('location: view.php');
        $sql = 'INSERT INTO `summary`(`action`, `date`) VALUES (?, ?)';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['edit', date('m-Y')]);
    }
    protected function updateDocumentByIDNoFile($userID, $title, $level, $date, $documentID)
    {
        $sql = 'UPDATE `document` SET `editorID` = ?, `title` = ?, `level` = ?, `editDate` = ? WHERE `documentID` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userID, $title, $level, $date, $documentID]);
        header('location: view.php');
        $sql = 'INSERT INTO `summary`(`action`, `date`) VALUES (?, ?)';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['edit', date('m-Y')]);
    }
    protected function getAllDocumentByPathID($id)
    {
        $sql = 'SELECT `document`.*, `user`.`firstName`, `user`.`lastName` FROM `document` LEFT JOIN `user` ON `user`.`userID` = `document`.`userID` WHERE `filePath` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll();
        return $result;
    }
}