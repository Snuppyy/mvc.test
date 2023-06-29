<?php

class Session
{
   private $db;
   private $id;

   public function __construct()
   {
      $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }

   public function create($user_id, $token)
   {

      if ($this->id) {
         $stmt = $this->db->prepare('UPDATE sessions SET user_id = ?, token = ? WHERE id = ?');
         $stmt->execute([$user_id, $token, $this->id]);
      } else {
         $stmt = $this->db->prepare('INSERT INTO sessions (user_id, token) VALUES (?, ?)');
         $stmt->execute([$user_id, $token]);

         $this->id = $this->db->lastInsertId();
      }
   }

   public static function deleteByToken($token)
   {
      $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $db->prepare('DELETE FROM sessions WHERE token = ?');
      $stmt->execute([$token]);
   }

   public static function getByToken($id)
   {
      $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $db->prepare('SELECT token FROM sessions WHERE user_id = ?');
      $stmt->execute([$id]);
      $session = $stmt->fetch(PDO::FETCH_OBJ);

      return $session;
   }
}
