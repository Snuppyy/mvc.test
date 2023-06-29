<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

class CreateUsersTable
{
   public function up()
   {
      $sql = "CREATE TABLE users (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            login VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

      $conn = Database::getConnection();
      $conn->exec($sql);
   }

   public function down()
   {
      $sql = "DROP TABLE IF EXISTS users";

      $conn = Database::getConnection();
      $conn->exec($sql);
   }
}

$table = new CreateUsersTable();
$table->up();
