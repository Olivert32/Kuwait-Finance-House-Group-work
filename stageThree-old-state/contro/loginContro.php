<?php
include_once 'model/login.php';
class LoginContro extends Login
{
    private $username;
    private $password;

    public function __construct($username, $password)
    {
        $this->username = strtolower($username);
        $this->password = $password;
    }

    public function login()
    {
        // Get user login information
        $result = $this->getUserInfoByUsername($this->username);

        // Check all field are filled
        if (empty($this->username) || empty($this->password)) {
            $_SESSION['error'] = 'Please make sure all field are filled';
            header('location: login.php');
            exit();
        }

        // Verify that user exist
        if ($result['username'] != $this->username) {
            $_SESSION['error'] = 'Username or password is wrong';
            header('location: login.php');
            exit();
        }

        // Verify password matches, in this case password is not hashed
        if (!password_verify($this->password, $result['password'])) {
            $_SESSION['error'] = 'Username or password is wrong';
            header('location: login.php');
            exit();
        }

        // Add sessions veriable / UserId is stored to track the user around the website
        session_regenerate_id();
        $_SESSION['logged_on'] = true;
        $_SESSION['active'] = $result['active'];
        $_SESSION['role'] = $result['role'];
        $_SESSION['userID'] = $result['userID'];
        $_SESSION['firstName'] = ucfirst($result['firstName']);
        $_SESSION['lastName'] = ucfirst($result['lastName']);
    }
}
