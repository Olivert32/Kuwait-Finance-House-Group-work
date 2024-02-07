<?php
include_once 'model/user.php';
class UserContro extends User
{
    public function getAllInactiveUser()
    {
        return $this->inactiveUser();
    }
    public function acceptUser($userID)
    {
        $this->activateUser($userID);
        $_SESSION['error'] = 'User ' . $userID . ' activated';
    }
    public function declineUser($userID)
    {
        $this->deleteUser($userID);
        $_SESSION['error'] = 'User ' . $userID . ' deleted';
    }
    public function getAllUser()
    {
        return $this->getAllUsers();
    }
    public function deactive($userID)
    {
        $this->deactiveUser($userID);
        $_SESSION['error'] = 'User ' . $userID . ' de-activated';
    }
    public function getUser($userID)
    {
        return $this->getUserByID($userID);
    }
    public function getAllCurrentUser()
    {
        return $this->getNotNewAllUsers();
    }
    public function update($email, $mobile, $password)
    {
        // Get user detail 
        $result = $this->getUserByID($_SESSION['userID']);

        // Check all field are filled
        if (empty($email) || empty($mobile) || empty($password)) {
            $_SESSION['error'] = 'Please make sure all field are filled';
            header('location: profile-edit.php');
            exit();
        }

        // Verify the email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Invalid email address';
            header('location: profile-edit.php');
            exit();
        }

        // Verify password matches
        if (!password_verify($password, $result['password'])) {
            $_SESSION['error'] = 'Incorrect password';
            header('location: profile-edit.php');
            exit();
        }

        // Update user information
        $this->updateMyProfile($email, $mobile);
    }
}
