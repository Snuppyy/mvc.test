<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

class Task
{
   public $id;
   public $username;
   public $email;
   public $task;

   public function save()
   {
      $conn = Database::getConnection();

      if ($this->id) {
         // Обновление существующей задачи
         $stmt = $conn->prepare('UPDATE tasks SET username = ?, email = ?, task = ? WHERE id = ?');
         $stmt->execute([$this->username, $this->email, $this->task, $this->id]);
      } else {
         // Создание новой задачи
         $stmt = $conn->prepare('INSERT INTO tasks (username, email, task) VALUES (?, ?, ?)');
         $stmt->execute([$this->username, $this->email, $this->task]);

         // Установка идентификатора задачи
         $this->id = $conn->lastInsertId();
      }
   }

   public static function getAllTasks()
   {
      $conn = Database::getConnection();

      $stmt = $conn->query('SELECT * FROM tasks');
      $tasks = $stmt->fetchAll(PDO::FETCH_OBJ);

      return $tasks;
   }

   public static function getTaskById($id)
   {
      $conn = Database::getConnection();

      $stmt = $conn->prepare('SELECT * FROM tasks WHERE id = ?');
      $stmt->execute([$id]);
      $task = $stmt->fetch(PDO::FETCH_OBJ);

      return $task;
   }

   public function delete()
   {
      $conn = Database::getConnection();

      $stmt = $conn->prepare('DELETE FROM tasks WHERE id = ?');
      $stmt->execute([$this->id]);
   }
}
