<?php

include_once './_config/config.php';
include_once 'Database.php';


class User extends Database
{
    private $userName;
    private $email;
    private $password;
    private $picture;
    public $usersTable = "user";


    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPicture()
    {
        return $this->email;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /** List
     * @param $colName
     * @param $colValue
     * @return void
     * @throws Exception
     */
    public function listUser($colName, $colValue) {
        $this->allowedColumns = ['user_id', 'id'];
        // Check Param Validation
        if($this->checkParam($colName)) {
            $this->query('SELECT * From '. $this->usersTable .' WHERE '. $colName .' = :colValue');
            $this->bind(':colValue', $colValue);
            $this->execute();
            $users = $this->single();
            if ($users !== null) {
            }
            return $users;
        }
    }

    static function getAll()
    {
        global $db;
        $result = $db->query("SELECT * FROM user");
        if ($result)
            return $result->fetch_all(MYSQLI_ASSOC);
    }

    /** ADD New User:
     * @param string $email
     * @param string $password
     * @param string $username
     * @return void
     * @throws Exception
     */
    public function register($email, $password, $username, $picture) {
        // Checking If Email Already Exists:
        $emailCheck = $this->emailExistance($email);
        if(!empty($emailCheck)) {
            header('Location:../html/');
        }
        $this->query('INSERT INTO '. $this->usersTable .' (email, password, username ,picture) VALUES (:email, :password, :username, :picture);');
        $this->bind(':email', $email);
        $this->bind(':picture', $picture);
        $this->bind(':password', $password);
        $this->bind(':username', $username);
        $this->execute();
    }

    /** login
     * @param $user_id
     * @return void
     */
    function login ($user_id) {
        $_SESSION["user_id"] = $user_id;
        $_SESSION["login"] = true;
        header('Location: index.php?page=home');
    }

    function logout () {
        session_destroy();
        header('Location: index.php?page=home');
    }


    public function updateUser($valueCol, $value, $identifierCol, $identifier) {
        $this->allowedColumns = ['email', 'name', 'password', 'id'];
        $paramValidation = $this->checkParam($valueCol, $identifierCol);
        if($paramValidation) {
            $this->query('UPDATE '. $this->usersTable.'
                        SET '. $valueCol .' = :value
                        WHERE '. $identifierCol .' = :identifier');
            $this->bind(':value', $value);
            $this->bind(':identifier', $identifier);
            $this->execute();
        }
    }

    public function deleteUser($identifierCol, $identifier) {
        $this->allowedColumns = ['email', 'name', 'password', 'id'];
        $paramValidation = $this->checkParam($identifierCol);
        if($paramValidation) {
            $this->query('DELETE FROM '. $this->usersTable .' WHERE '. $identifierCol .' = :identifier');
            $this->bind(':identifier', $identifier);
            $this->execute();
        }
    }

    /** Check If Email Already Exists:
     * @param string $email
     * @return mixed
     */
    public function emailExistance($email) {
        $this->query("SELECT * FROM ". $this->usersTable ." WHERE email = :email");
        $this->bind(':email', $email);
        $this->execute();
        return $this->single();
    }



    /** Email Sanitize:
     * @param $email
     * @return mixed
     */
//    public function sanitizeEmail($email) {
//        return filter_var($email, FILTER_SANITIZE_EMAIL);
//    }
//
//    /** Username Sanitize:
//     * @param $username
//     * @return mixed
//     */
//
//    public function sanitizeUsername($username) {
//        return filter_var($username, FILTER_SANITIZE_STRING);
//    }
//
//    /** Password Sanitize:
//     * @param $password
//     * @return mixed
//     */
//
//    public function sanitizePassword($password) {
//        return filter_var($password, FILTER_SANITIZE_STRING);
//    }


    public function emailValidate($email) {
        if(!filter_var($email, FILTER_SANITIZE_EMAIL) ||  !preg_match("/^[a-zA-Z0-9.%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,}$/", $email)) {
            return false;
        } else {
            return true;
        }
    }

//    /** Validate Name:
//
//    @param string $name
//    @return bool*/
//    public function nameValidate($name) {
//        if(!preg_match("/^[A-Za-z]{5,10}$/", $name)) {
//            return false;
//        } else {
//            return true;
//        }
//    }



    public function passwordValidate($password)
    {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/
';
        if (!preg_match($pattern, $password)) {
            return false;
        } else {
            return true;
        }
    }

}

