<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

class CreateSessionsTable
{
   public function up()
   {
      $sql = "CREATE TABLE sessions (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_id INT(11) UNSIGNED,
            token VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )";

      $conn = Database::getConnection();
      $conn->exec($sql);
   }

   public function down()
   {
      $sql = "DROP TABLE IF EXISTS sessions";

      $conn = Database::getConnection();
      $conn->exec($sql);
   }
}

// Создание таблицы
$table = new CreateSessionsTable();
$table->up();
