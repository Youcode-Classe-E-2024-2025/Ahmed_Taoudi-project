<?php 

// Register routes
$router->register('/', 'HomeController', 'index');
$router->register('/home', 'HomeController', 'index');
$router->register('/home/getChartData', 'HomeController', 'getChartData');

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
$router->register('/project/getChartData', 'ProjectController', 'getChartData');
$router->register('/project/create', 'ProjectController', 'create');
$router->register('/project/edit', 'ProjectController', 'edit');
$router->register('/project/delete', 'ProjectController', 'delete');
$router->register('/project/addMember', 'ProjectController', 'addMember');
$router->register('/project/removeMember', 'ProjectController', 'removeMember');
$router->register('/project/updateVisibility', 'ProjectController', 'updateVisibility');

// Task routes
$router->register('/tasks', 'TaskController', 'index');
$router->register('/task', 'TaskController', 'show');
$router->register('/taskJS', 'TaskController', 'taskJS'); //fetch in /views/pages/project_content
$router->register('/task/create', 'TaskController', 'create');
$router->register('/task/edit', 'TaskController', 'edit');
$router->register('/task/updateStatus', 'TaskController', 'updateStatus');
$router->register('/task/delete', 'TaskController', 'delete');

// Admin routes
$router->register('/admin', 'AdminController', 'index');
$router->register('/admin/users', 'AdminController', 'users');
$router->register('/admin/users/create', 'AdminController', 'createUser');
$router->register('/admin/users/edit', 'AdminController', 'editUser');
$router->register('/admin/users/delete', 'AdminController', 'deleteUser');
$router->register('/admin/roles', 'AdminController', 'roles');
$router->register('/admin/roles/create', 'AdminController', 'createRole');
$router->register('/admin/roles/edit', 'AdminController', 'editRole');
$router->register('/admin/roles/delete', 'AdminController', 'deleteRole');
$router->register('/admin/permissions', 'AdminController', 'permissions');
