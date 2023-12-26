<?php
if (file_exists('../_config/db.php'))
    include_once '../_config/db.php';
if (file_exists('../models/Room.php')) {
    include_once '../models/Room.php';
}

if (isset($_POST["roomName"])) {
    extract($_POST);
    $creator = $_SESSION["user_id"];
    $room = new Room();
    $room->insertRoom($roomName, $creator, $members, $db);
    exit;
}

$users = User::getAll();

