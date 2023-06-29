<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

class Session
{
   public $id;
   public $user_id;
   public $token;

   public function save()
   {
      $conn = Database::getConnection();

      if ($this->id) {
         // Обновление существующей сессии
         $stmt = $conn->prepare('UPDATE sessions SET user_id = ?, token = ? WHERE id = ?');
         $stmt->execute([$this->user_id, $this->token, $this->id]);
      } else {
         // Создание новой сессии
         $stmt = $conn->prepare('INSERT INTO sessions (user_id, token) VALUES (?, ?)');
         $stmt->execute([$this->user_id, $this->token]);

         // Установка идентификатора сессии
         $this->id = $conn->lastInsertId();
      }
   }

   public static function deleteByToken($token)
   {
      $conn = Database::getConnection();

      $stmt = $conn->prepare('DELETE FROM sessions WHERE token = ?');
      $stmt->execute([$token]);
   }

   public static function getByToken($id)
   {
      $conn = Database::getConnection();

      $stmt = $conn->prepare('SELECT token FROM sessions WHERE user_id = ?');
      $stmt->execute([$id]);
      $session = $stmt->fetch(PDO::FETCH_OBJ);

      return $session;
   }
}
