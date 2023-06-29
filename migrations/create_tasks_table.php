<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

class CreateTasksTable
{
   public function up()
   {
      $conn = Database::getConnection();

      $sql = '
            CREATE TABLE tasks (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                task TEXT NOT NULL,
                completed BOOLEAN NOT NULL DEFAULT 0 
            )
        ';

      $conn->exec($sql);
   }

   public function down()
   {
      $conn = Database::getConnection();

      $sql = 'DROP TABLE tasks';

      $conn->exec($sql);
   }
}

$migration = new CreateTasksTable();
$migration->up();
