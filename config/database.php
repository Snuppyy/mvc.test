<?php

class Database
{
   public static function getConnection()
   {
      $host = 'localhost';
      $dbname = 'testing';
      $username = 'testing';
      $password = '123';

      try {
         $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $conn;
      } catch (PDOException $e) {
         echo 'Ошибка подключения к базе данных: ' . $e->getMessage();
         exit();
      }
   }
}
