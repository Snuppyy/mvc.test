<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Task.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/User.php';

class TaskController
{
   public function index()
   {
      $tasks = Task::getAllTasks();

      include $_SERVER['DOCUMENT_ROOT'] . '/app/views/tasks.php';
   }

   public function create()
   {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         // Получение данных из формы
         $username = $_POST['username'];
         $email = $_POST['email'];
         $task = $_POST['task'];

         // Валидация данных (можно добавить дополнительные проверки)

         // Создание новой задачи
         $newTask = new Task();
         $newTask->username = $username;
         $newTask->email = $email;
         $newTask->task = $task;
         $newTask->save();

         // Редирект на страницу со списком задач
         header('Location: /');
         exit();
      }

      header('Location: /create');
   }

   public function edit($id)
   {
      $task = Task::getTaskById($id);

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         // Получение данных из формы
         $username = $_POST['username'];
         $email = $_POST['email'];
         $taskText = $_POST['task'];

         // Валидация данных (можно добавить дополнительные проверки)

         // Обновление задачи
         $task->username = $username;
         $task->email = $email;
         $task->task = $taskText;
         $task->save();

         // Редирект на страницу со списком задач
         header('Location: /');
         exit();
      }

      header('Location: /edit');
   }

   public function delete($id)
   {
      $task = Task::getTaskById($id);

      if ($task) {
         $task->delete();
      }

      // Редирект на страницу со списком задач
      header('Location: /');
      exit();
   }
}
