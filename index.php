<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/AuthController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/TaskController.php';


$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? '';

switch ($action) {
   case 'login':
      $authController = new AuthController();
      $authController->login();
      break;
   case 'register':
      $authController = new AuthController();
      $authController->register();
      break;
   case 'create':
      $authController = new TaskController();
      $authController->create();
      break;
   case 'edit':
      $authController = new TaskController();
      $authController->edit($id);
      break;
   case 'delete':
      $authController = new TaskController();
      $authController->delete($id);
      break;
      // Другие маршруты...
   default:
      $authController = new TaskController();
      $authController->index();
      break;
}
