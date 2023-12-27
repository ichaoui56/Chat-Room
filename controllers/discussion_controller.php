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



$rooms = Room::getAll();

$users = User::getAll();
$user = new User;
$userData = $user->listUser('user_id' , $_SESSION["user_id"]);

if (isset($_POST["req"]) && $_POST["req"] == "chat") {
    extract($_POST);
    $chat = Room::getChat($roomid);
    echo json_encode($chat);
    exit;
}

if (isset($_POST["req"]) && $_POST["req"] == "InsertChat") {
    extract($_POST);
    $room = new Room();
    $date = date("U");
    $room->insertMesaage($currentRoom, $_SESSION["user_id"], $messageValue, $date, $db);
    echo json_encode($_POST);
    exit;
}
