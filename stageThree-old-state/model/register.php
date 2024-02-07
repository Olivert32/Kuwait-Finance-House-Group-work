<?php

include_once 'dbh.php';
class Register extends Dbh
{
    protected function getUserInfoByUsername($username)
    {
        $sql = 'SELECT * FROM `user` WHERE `username` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }

    protected function updateUserStatus($username)
    {
        $sql = 'UPDATE `user` SET `isVerified` = 1 WHERE `username` = ? ';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
    }

    protected function getValidationByUsername($username)
    {
        $sql = 'SELECT `validationCode` FROM `user` WHERE `username` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }

    function checkInfo($username)
    {
        $sql = 'SELECT username, mobile, email FROM `user` WHERE `username`= ? AND `mobile`= ? AND `email`= ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }


    function resetPassword($username, $password)
    {
        $sql = 'UPDATE user SET `password` = ? WHERE `username` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$password, $username]);
        $result = $stmt->fetch();
        return $result;
    }

    protected function registerUser($username, $password, $firstName, $lastName, $email, $mobile, $role)
    {
        $sql = 'INSERT INTO `user` (`username`, `password`, `firstName`, `lastName`, `email`, `mobile`, `role`) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username, $password, $firstName, $lastName, $email, $mobile, $role]);

        $sql = 'INSERT INTO `summary` (`action`, `date`) VALUES (?, ?)';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['user registered', date('m-Y')]);
    }
}
