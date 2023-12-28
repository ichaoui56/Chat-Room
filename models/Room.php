<?php

class Room {
    function insertRoom($roomName, $creator, $members, $db) {
        $sql = "INSERT INTO room (room_name, creator) VALUES (?,?)";
        $stmt = mysqli_stmt_init($db);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "si", $roomName,$creator);
        mysqli_stmt_execute($stmt);
        $roomId = mysqli_insert_id($db);

        $this->insertMember($roomId, $creator, $db);
        foreach ($members as $member) {
            $this->insertMember($roomId, $member, $db);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }

    function insertMember($roomId, $member, $db) {
        $sql = "INSERT INTO room_member (room_id, user_id) VALUES (?,?)";
        $stmt = mysqli_stmt_init($db);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $roomId, $member);
        mysqli_stmt_execute($stmt);
    }

    function insertMesaage($roomId, $member, $message, $date, $db) {
        $sql = "INSERT INTO message (room_id, user_id, message, date) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($db);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "iisi", $roomId, $member, $message, $date);
        mysqli_stmt_execute($stmt);
    }

    static function getAll()
    {
        global $db;
        $result = $db->query("SELECT * FROM room ORDER BY `room_id` DESC");
        if ($result)
            return $result->fetch_all(MYSQLI_ASSOC);
    }

    static function getAllMembers($room_id)
    {
        global $db;
        $result = $db->query("
            SELECT user.* FROM room_member
            JOIN user ON room_member.user_id = user.user_id
            WHERE room_member.room_id = '$room_id' 
        ");

        if ($result)
            return $result->fetch_all(MYSQLI_ASSOC);
    }

    static function getChat($room_id)
    {
        global $db;
        $result = $db->query("
            SELECT user.*, message.* FROM message
            JOIN user ON message.user_id = user.user_id
            WHERE message.room_id = '$room_id'
        ");

        if ($result)
            return $result->fetch_all(MYSQLI_ASSOC);
    }

    static function addFriendRequest($sender, $receiver) {
        global $db;
        $sql = "INSERT INTO friend_request (sender, receiver) VALUES (?,?)";
        $stmt = mysqli_stmt_init($db);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $sender, $receiver);
        mysqli_stmt_execute($stmt);
    }

    static function getFriendInvitation($receiver) {
        global $db;
        $result = $db->query("
            SELECT user.* FROM friend_request
            JOIN user ON friend_request.sender = user.user_id
            WHERE message.room_id = '$receiver'
        ");

        if ($result)
            return $result->fetch_all(MYSQLI_ASSOC);
    }
    static function invitaionDisplay($user, $db)
    {
        $result = $db->query("
            SELECT room_invitation.invitation_id, room.*, user.username, user.picture FROM room_invitation
            JOIN room ON room_invitation.room_id = room.room_id
            JOIN user ON room_invitation.sender = user.user_id
            WHERE room_invitation.receiver = '$user'
        ");

        if ($result)
            return $result->fetch_all(MYSQLI_ASSOC);
    }

}

?>