<?php 

// Register routes
$router->register('/', 'HomeController', 'index');

// User routes
// $router->register('/dashboard', 'AuthController', 'login');
$router->register('/login', 'AuthController', 'login');
$router->register('/logout', 'AuthController', 'logout');
$router->register('/register', 'AuthController', 'register');

$router->register('/users', 'UserController', 'index');
$router->register('/user/profile', 'UserController', 'profile');
$router->register('/user/edit', 'UserController', 'edit');

// Project routes
$router->register('/projects', 'ProjectController', 'index');
$router->register('/project/create', 'ProjectController', 'create');
$router->register('/project/edit', 'ProjectController', 'edit');
$router->register('/project/delete', 'ProjectController', 'delete');
$router->register('/projects/addMember', 'ProjectController', 'addMember');

// Task routes
$router->register('/tasks', 'TaskController', 'index');
$router->register('/task', 'TaskController', 'show');
$router->register('/taskJS', 'TaskController', 'taskJS'); //fetch in /views/pages/project_content
$router->register('/task/create', 'TaskController', 'create');
$router->register('/task/edit', 'TaskController', 'edit');
$router->register('/task/updateStatus', 'TaskController', 'updateStatus');
$router->register('/task/delete', 'TaskController', 'delete');
