<?php
session_start();
require "assets/helper/fonctions.php";
require_once "models/Router.php";
require_once "models/Database.php";

// CSRF
if (empty($_SESSION['csrf_token'])) { 

    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generates a 64-character hex token
}

$db = new Database();
// 
if(isset($_POST['createdb'])){ 

    if(isset($_POST['checkbox']) && $_POST['checkbox'] == 'on' ){
        
        $db->createDatabase(DBNAME,true);
    }else{
        
        $db->createDatabase(DBNAME,false);
    }
    
}

$router = new Router($db);

require "routes.php";

$router->resolve($_SERVER['REQUEST_URI']);
