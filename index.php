<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/AuthController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/TaskController.php';


$action = $_GET['action'] ?? '';
$id = isset($_GET['id']) ? $_GET['id'] : null;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

switch ($action) {
   case 'login':
      $authController = new AuthController();
      $authController->login();
      break;
   case 'register':
      $authController = new AuthController();
      $authController->register();
      break;
   case 'logout':
      $authController = new AuthController();
      $authController->logout();
      break;
   case 'create':
      $taskController = new TaskController();
      $taskController->create();
      break;
   case 'edit':
      $taskController = new TaskController();
      $taskController->edit($id);
      break;
   case 'delete':
      $taskController = new TaskController();
      $taskController->delete($id);
      break;
   default:
      $taskController = new TaskController();
      $taskController->index($page);
      break;
}
