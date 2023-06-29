<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

class User
{
   public $id;
   public $login;
   public $password;

   public static function isLoggedIn()
   {
      // Проверяем, есть ли информация о пользователе в сессии или в cookies
      return isset($_COOKIE['session_token']) && isset($_COOKIE['user_id']);
   }

   public function save()
   {
      $conn = Database::getConnection();

      if ($this->id) {
         // Обновление существующего пользователя
         $stmt = $conn->prepare('UPDATE users SET login = ?, password = ? WHERE id = ?');
         $stmt->execute([$this->login, $this->password, $this->id]);
      } else {
         // Создание нового пользователя
         $stmt = $conn->prepare('INSERT INTO users (login, password) VALUES (?, ?)');
         $stmt->execute([$this->login, $this->password]);

         // Установка идентификатора пользователя
         $this->id = $conn->lastInsertId();
      }
   }

   public static function findByLogin($login)
   {
      $conn = Database::getConnection();

      $stmt = $conn->prepare('SELECT * FROM users WHERE login = ?');
      $stmt->execute([$login]);
      $user = $stmt->fetch(PDO::FETCH_OBJ);

      if ($user) {
         $model = new User();
         $model->id = $user->id;
         $model->login = $user->login;
         $model->password = $user->password;

         return $model;
      }

      return null;
   }

   public static function findById($id)
   {
      $conn = Database::getConnection();

      $stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
      $stmt->execute([$id]);
      $user = $stmt->fetch(PDO::FETCH_OBJ);

      return $user;
   }
}
