<?php
include_once 'dbh.php';
class Login extends Dbh
{
    protected function getUserInfoByUsername($username)
    {
        $sql = 'SELECT * FROM `user` WHERE `username` = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);
        $result = $stmt->fetch();
        return $result;
    }
}
