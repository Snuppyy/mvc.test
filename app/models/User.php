<?php

class User
{
   private static $db;
   private $id;


   public function __construct()
   {
      $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }

   public static function isLoggedIn()
   {
      return isset($_SESSION['session_token']) && isset($_SESSION['user_id']);
   }

   public function create($login, $password)
   {

      if ($this->id) {
         $stmt = $this->db->prepare('UPDATE users SET login = ?, password = ? WHERE id = ?');
         $stmt->execute([$login, $password, $this->id]);
      } else {
         $stmt = $this->db->prepare('INSERT INTO users (login, password) VALUES (?, ?)');
         $stmt->execute([$login, $password]);

         $this->id = $this->db->lastInsertId();
      }
   }

   public static function findByLogin($login)
   {
      $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $db->prepare('SELECT * FROM users WHERE login = ?');
      $stmt->execute([$login]);
      $user = $stmt->fetch(PDO::FETCH_OBJ);

      return $user;
   }

   public static function findById($id)
   {
      $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
      $stmt->execute([$id]);
      $user = $stmt->fetch(PDO::FETCH_OBJ);

      return $user;
   }
}
