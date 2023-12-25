<?php

include_once '_config/config.php';
include_once '_functions/functions.php';


spl_autoload_register(function ($class) {
    include_once 'models/' . $class . '.php';
});

$database = new Database();
$con = $database->dbh;

if (!empty($_GET['page'])) {
    $page = trim(strtolower($_GET['page']));
} else {
    $page = 'home';
}

$all_pages = scandir('controllers');
if (in_array($page . '_controller.php', $all_pages)) {
    //include_once 'models/Implementations/' . $page . 'Impl.php';
    include_once 'controllers/' . $page . '_controller.php';
    include_once 'views/_layout.php';
} else {
    $page = '404';
    include_once 'controllers/' . $page . '_controller.php';
    include_once 'views/_layout.php';
}
