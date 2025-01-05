<?php
session_start();
require "assets/helper/fonctions.php";
// dd(password_hash('password', PASSWORD_DEFAULT));
// dd($_SESSION);
require_once "core/Router.php";
require_once "models/Database.php";

// dd("eeeeee");
// CSRF
if (empty($_SESSION['csrf_token'])) { 

    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generates a 64-character hex token
}

$db = new Database();
// 

if(isset($_POST['createdb'])){ 

    if(isset($_POST['checkbox']) && $_POST['checkbox'] == 'on' ){
        $db->createDatabase(DBNAME,true);
        // dd(33);
    }else{
        $db->createDatabase(DBNAME,false);
        // dd(22);
    }
    
}

$router = new Router($db);

require "routes.php";

$router->resolve($_SERVER['REQUEST_URI']);
