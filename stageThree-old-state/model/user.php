<?php
include_once 'dbh.php';
class User extends Dbh
{
    protected function inactiveUser()
    {
        $sql = 'SELECT * FROM `user` WHERE `newUser` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([0]);
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();
            return $result;
        }
        return 0;
    }
    protected function activateUser($userID)
    {
        $sql = 'SELECT * FROM `user` WHERE `newUser` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([0]);
        $result = $stmt->fetchAll();
        if ($stmt->rowCount() > 0) {
            if ($result[0]['newUser'] == '0') {
                $sql = 'INSERT INTO `summary` (`action`, `date`) VALUES (?, ?)';
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute(['user approved', date('m-Y')]);
            }
        }

        $sql = 'UPDATE `user` SET `active` = ?, `newUser` = ? WHERE `userID` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([1, 1, $userID]);
    }
    protected function deleteUser($userID)
    {
        $sql = 'DELETE FROM `user` WHERE `userID` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userID]);
    }
    protected function getAllUsers()
    {
        $sql = 'SELECT * FROM `user`';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    protected function deactiveUser($userID)
    {
        $sql = 'UPDATE `user` SET `active` = ? WHERE `userID` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([0, $userID]);
    }
    protected function getUserByID($userID)
    {
        $sql = 'SELECT * FROM `user` WHERE `userID` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userID]);
        $result = $stmt->fetch();
        return $result;
    }
    protected function updateMyProfile($email, $mobile)
    {
        $sql = 'UPDATE `user` SET `email` = ?, `mobile` = ? WHERE `userID` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email, $mobile, $_SESSION['userID']]);
    }
    protected function getNotNewAllUsers()
    {
        $sql = 'SELECT * FROM `user` WHERE `newUser` = 1';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
