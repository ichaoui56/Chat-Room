<?php

class UserImpl implements UserDao
{
    private $usersTable = "user";

    /** Lite of all users
     * @return mixed
     */
    public function listAllUsers()
    {
        $this->query('SELECT * From '. $this->usersTable);
        $this->execute();
        $users = $this->resultSet();
        if ($users !== null) {
        }
        return $users;
    }

    /** Login
     * @param User $user
     * @return false
     */
    public function login(User $user)
    {
        $this->query('SELECT * FROM' . $this->usersTable . 'WHERE email = :email');
        $this->bind(':email', $user->getEmail());

        $row = $this->single();

        $hashed_password = $row->password;
        if(password_verify($user->getPassword(), $hashed_password)){
            return $row;
        } else {
            return false;
        }
    }

    /** List
     * @param $colName
     * @param $colValue
     * @return void
     * @throws Exception
     */
    public function listUser($colName, $colValue) {
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

    /** ADD New User:
     * @param string $email
     * @param string $password
     * @param string $username
     * @return void
     * @throws Exception
     */
    public function register($email, $password, $username, $picture)
    {
        // Checking If Email Already Exists:
        $emailCheck = $this->emailExistance($email);
        if (!empty($emailCheck)) {
            header('Location:../html/');
        }
        $hashedPassword = hash('sha256', $password);
        $this->query('INSERT INTO ' . $this->usersTable . ' (email, password, username ,picture) VALUES (:email, :password, :username, :picture);');
        $this->bind(':email', $email);
        $this->bind(':picture', $picture);
        $this->bind(':password', $hashedPassword);
        $this->bind(':username', $username);
        $this->execute();
    }

    /** Update user
     * @param $valueCol
     * @param $value
     * @param $identifierCol
     * @param $identifier
     * @return void
     */
    public function updateUser($valueCol, $value, $identifierCol, $identifier)
    {
        $this->allowedColumns = ['email', 'name', 'password', 'id'];
        $paramValidation = $this->checkParam($valueCol, $identifierCol);
        if ($paramValidation) {
            $this->query('UPDATE ' . $this->usersTable . '
                        SET ' . $valueCol . ' = :value 
                        WHERE ' . $identifierCol . ' = :identifier');
            $this->bind(':value', $value);
            $this->bind(':identifier', $identifier);
            $this->execute();
        }
    }

    /** Delete user
     * @param $identifierCol
     * @param $identifier
     * @return void
     */
    public function deleteUser($identifierCol, $identifier)
    {
        $this->allowedColumns = ['email', 'name', 'password', 'id'];
        $paramValidation = $this->checkParam($identifierCol);
        if ($paramValidation) {
            $this->query('DELETE FROM ' . $this->usersTable . ' WHERE ' . $identifierCol . ' = :identifier');
            $this->bind(':identifier', $identifier);
            $this->execute();
        }
    }

    /** Check If Email Already Exists:
     * @param string $email
     * @return mixed
     */
    public function emailExistance($email)
    {
        $this->query("SELECT * FROM " . $this->usersTable . " WHERE email = :email");
        $this->bind(':email', $email);
        $this->execute();
        return $this->single();
    }

    /** Email Sanitize:
     * @param $email
     * @return mixed
     */
    public function sanitizeEmail($email)
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    /** Username Sanitize:
     * @param $username
     * @return mixed
     */

    public function sanitizeUsername($username)
    {
        return filter_var($username, FILTER_SANITIZE_STRING);
    }

    /** Password Sanitize:
     * @param $password
     * @return mixed
     */

    public function sanitizePassword($password)
    {
        return filter_var($password, FILTER_SANITIZE_STRING);
    }


    /** Email Validate:
     * @param string $email
     * @return bool
     */
    public function emailValidate($email)
    {
        $sanitizedEmail = $this->sanitizeEmail($email);
        return filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL);
    }

    /** Validate Name:
     * @param string $username
     * @return bool
     */
    public function nameValidate($username)
    {
        $sanitizedUsername = $this->sanitizeUsername($username);
        // Add your username validation logic here (e.g., length, allowed characters)
        return (bool)preg_match('/^[a-zA-Z0-9_]{3,20}$/', $sanitizedUsername);
    }

    /** Validate Password:
     * @param string $password
     * @return bool
     */
    public function passwordValidate($password)
    {
        $sanitizedPassword = $this->sanitizePassword($password);
        // Add your password validation logic here (e.g., strength, length)
        return strlen($sanitizedPassword) >= 8;
    }


}






























