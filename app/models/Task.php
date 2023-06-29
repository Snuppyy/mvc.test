<?php

class Task
{
   private $db;

   public function __construct()
   {
      $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }

   public function create($name, $email, $task)
   {
      $stmt = $this->db->prepare('INSERT INTO tasks (username, email, task) VALUES (?, ?, ?)');
      $stmt->execute([$name, $email, $task]);
   }

   public function getAllTasks()
   {
      $stmt = $this->db->query('SELECT * FROM tasks');
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   public function getTotalTaskCount()
   {
      $stmt = $this->db->query('SELECT COUNT(*) FROM tasks');
      return $stmt->fetchColumn();
   }

   public function getById($id)
   {
      $stmt = $this->db->prepare('SELECT * FROM tasks WHERE id = ?');
      $stmt->execute([$id]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }

   public function update($id, $username, $email, $task, $completed)
   {
      $stmt = $this->db->prepare('UPDATE tasks SET username = ?, email = ?, task = ?, completed = ? WHERE id = ?');
      $stmt->execute([$username, $email, $task, $completed, $id]);
   }

   public function delete($id)
   {
      $stmt = $this->db->prepare('DELETE FROM tasks WHERE id = ?');
      $stmt->execute([$id]);
   }
}
