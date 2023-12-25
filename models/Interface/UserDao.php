<?php

interface UserDao
{
    public function listAllUsers();
    public function login(User $user);
    public function listUser($colName, $colValue);
    public function register($email, $password, $username, $picture);
    public function updateUser($valueCol, $value, $identifierCol, $identifier);
    public function deleteUser($identifierCol, $identifier);
    public function emailExistance($email);
    public function sanitizeEmail($email);
    public function sanitizeUsername($username);
    public function sanitizePassword($password);
    public function emailValidate($email);
    public function nameValidate($username);
    public function passwordValidate($password);
}