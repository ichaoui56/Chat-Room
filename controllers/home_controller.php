<?php

if(isset($_POST['logout'])){
    $user = new User;
    $user->logout();
}