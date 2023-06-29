<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Task.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\View\TwitterBootstrap5View;

class TaskController
{
   private $taskModel;

   public function __construct()
   {
      $this->taskModel = new Task();
   }

   public function index($page)
   {
      $tasks = $this->taskModel->getAllTasks();
      $totalTaskCount = count($tasks);

      $adapter = new ArrayAdapter($tasks);
      $pagerfanta = new Pagerfanta($adapter);
      $pagerfanta->setMaxPerPage(TASKS_PER_PAGE);
      $pagerfanta->setCurrentPage($page);

      $pagerfantaView = new TwitterBootstrap5View();
      $pagerHtml = $pagerfantaView->render($pagerfanta, function ($page) {
         return '?page=' . $page;
      });

      $tasks = $pagerfanta->getCurrentPageResults();



      require $_SERVER['DOCUMENT_ROOT'] . '/app/views/tasks.php';
   }

   public function create()
   {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $name = $_POST['username'];
         $email = $_POST['email'];
         $taskText = $_POST['task'];

         $this->taskModel->create($name, $email, $taskText);

         header('Location: /');
         exit;
      }

      require $_SERVER['DOCUMENT_ROOT'] . '/app/views/create_task.php';
   }

   public function edit($id)
   {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $username = $_POST['username'];
         $email = $_POST['email'];
         $task = $_POST['task'];
         $completed = $_POST['completed'] ? 1 : 0;

         $this->taskModel->update($id, $username, $email, $task, $completed);

         header('Location: /');
         exit;
      }

      $task = $this->taskModel->getById($id);

      require $_SERVER['DOCUMENT_ROOT'] . '/app/views/edit_task.php';
   }

   public function delete($id)
   {
      $this->taskModel->delete($id);

      header('Location: /');
      exit;
   }
}
