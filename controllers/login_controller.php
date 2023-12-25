<?php


if (file_exists('../_classes/User.php')) {
    include_once '../models/User.php';
    include_once '../models/Database.php';
}

//if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
//
//    $picture = $_POST["picture"];
//    dd($picture);
//    $User = new User;
//    if(!$User->emailValidate($email)) {
//        header("Location: index.php?page=login+error=emailIsNotValid");
//    } elseif(!$User->passwordValidate($password)) {
//        header("Location: index.php?page=login+error=passwordIsNotValid");
//    } else {
//
//        if (isset($_FILES['picture'])) {
//
//            $password = password_hash($password, PASSWORD_BCRYPT);
//            $targetDir = "./assets/pictures/";
//            $fileName = basename($_FILES["picture"]["name"]);
//            $targetFilePath = $targetDir . $fileName;
//
//            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFilePath)) {
//
//                $userChecker = User->emailExistance($email);
//                if ($userChecker) {
//                    throw new Exception("User_exist");
//                } else {
//                    User->register($email, $password, $username, $picture);
//                }
//            }
//        }
//    }
//}

if (isset($_POST['signup'])) {
    extract($_POST);

    $password = password_hash($password, PASSWORD_BCRYPT);
    $targetDir = "./assets/pictures/";
    $fileName = basename($_FILES["picture"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    // Upload file to server
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFilePath)) {
        $User = new User();
        $userChecker = $User->emailExistance($email);
        if ($userChecker) {
            throw new Exception("User_exist");
        } else {
            $User->register($email, $password, $username, $picture);
            header('Location: index.php?page=login');
        }
    }
}

if (isset($_POST['login'])) {
    extract($_POST);
    $User = new User();
    $userChecker = $User->emailExistance($email);
    if ($userChecker) {
        if (password_verify($password, $userChecker["password"])) {
            $User->login($userChecker["user_id"]);
        }
        else
            throw new Exception("password_incorrect");
    } else {
        throw new Exception("User_doesnt_exist");
    }
}













//$userImpl = new UserImpl();
//
//if action == get
//
//$AllUsers = $userImpl->listAllUsers();
//header location users page with all the users
//
//if action == post
//    $user = new User();
//    $user->setEmail("imad@gmail.com");
//    $user set password
//$login = $userImpl->login($user)
//header location
//


?>