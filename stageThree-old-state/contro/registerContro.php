<?php

use PHPMailer\PHPMailer\PHPMailer;
//require 'vendor/autoload.php';

include_once 'model/register.php';

class RegisterContro extends Register
{
    private $username;
    private $password;
    private $passwordConfirm;
    private $firstName;
    private $lastName;
    private $email;
    private $mobile;
    private $role;

    public function __construct($username, $password, $passwordConfirm, $firstName, $lastName, $email, $mobile, $role)
    {
        $this->username = strtolower($username);
        $this->password = $password;
        $this->passwordConfirm = $passwordConfirm;
        $this->firstName = strtolower($firstName);
        $this->lastName = strtolower($lastName);
        $this->email = strtolower($email);
        $this->mobile = $mobile;
        $this->role = strtolower($role);
    }

    public function register()
    {
        // Get user register information if any
        $result = $this->getUserInfoByUsername($this->username);

        // Check all field are filled
        if (empty($this->username) || empty($this->password) || empty($this->passwordConfirm) || empty($this->firstName) || empty($this->lastName) || empty($this->email) || empty($this->mobile) || empty($this->role)) {
            $_SESSION['error'] = 'Please make sure all fields are filled';
            header('location: register.php');
            exit();
        }

        // Verify that the password matches
        if ($this->password != $this->passwordConfirm) {
            $_SESSION['error'] = 'Passwords do not match';
            header('location: register.php');
            exit();
        }

        // Check if the username already exists
        if ($result['username']) {
            $_SESSION['error'] = 'Username already exists';
            header('location: register.php');
            exit();
        }

        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        $this->registerUser($this->username, $passwordHash, $this->firstName, $this->lastName, $this->email, $this->mobile, $this->role);

        // Redirect if successful
        header('location: login.php');
    }
    public function isDetailCorrect()
    {
        if (empty($this->username) || empty($this->email) || empty($this->mobile) || empty($this->firstName) || empty($this->lastName)) {
            $_SESSION['error'] = 'all field required';
            header('location: resetPassword.php');
            // echo "all field required";
            exit();
        }

        $result = $this->getUserInfoByUsername($this->username);

        if ($result['username'] != $this->username || $result['email'] != $this->email || $result['mobile'] != $this->mobile || $result['firstName'] != $this->firstName || $result['lastName'] != $this->lastName) {
            $_SESSION['error'] = 'detail incorrect';
            header('location: resetPassword.php');
            // echo "detail incorrect";
            exit();
        }
    }
    public function getUser()
    {
        return $this->getUserInfoByUsername($this->username);
    }

    public function getValidationCode()
    {
        return $this->getValidationByUsername($this->username);
    }

    public function updateStatus()
    {
        $this->updateUserStatus($this->username);
    }

    public function matchAllFields()
    {
        $this->checkInfo($this->username);
    }

    public function getNewPassword()
    {
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        $this->resetPassword($this->username, $passwordHash);
    }
}
