<?php
include_once 'dbh.php';
class Timeline extends Dbh
{
    protected function newTimeLine($name, $user, $document = null, $hour, $date)
    {
        $sql = 'INSERT INTO `timeline` (`action_name`, `action_userID`, `action_documentID`, `hour`, `date`) VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $user, $document, $hour, $date]);
    }

    protected function getAll()
    {
        // $sql = 'SELECT * FROM `timeline` ORDER BY `timeline`.`action_ID` DESC';
        $sql = 'SELECT *, `user`.`firstName`, `user`.`lastName` FROM `timeline` JOIN `user` ON `timeline`.`action_userID` = `user`.`userID` ORDER BY `timeline`.`action_ID` DESC';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    protected function getSummary()
    {
        $sql = 'SELECT action, DATE, COUNT(*) AS COUNT FROM summary GROUP BY action, DATE;';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    protected function getSummaryAll()
    {
        $sql = 'SELECT action, DATE, COUNT(*) AS COUNT FROM summary GROUP BY action';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    protected function getStaffAll()
    {
        $sql = 'SELECT role, COUNT(*) AS COUNT FROM user WHERE newUser = 1 GROUP BY role';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function getDocumentLevelAll()
    {
        $sql = 'SELECT level, COUNT(*) AS COUNT FROM document GROUP BY level';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
