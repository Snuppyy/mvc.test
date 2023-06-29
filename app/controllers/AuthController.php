<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Session.php';

class AuthController
{
   public function register()
   {

      $user = User::findById($_SESSION['user_id']);

      if ($user && Session::getByToken($user->id)->token == $_SESSION['session_token']) {
         header('Location: /');
         exit();
      }

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {

         $login = $_POST['login'];
         $password = $_POST['password'];


         $existingUser = User::findByLogin($login);

         if ($existingUser) {
            $error = 'Пользователь с таким логином уже зарегистрирован.';
            include $_SERVER['DOCUMENT_ROOT'] . '/app/views/register.php';
            return;
         }

         $user = new User();
         $user->create($login, password_hash($password, PASSWORD_DEFAULT));

         header('Location: /login');
         exit();
      }

      include $_SERVER['DOCUMENT_ROOT'] . '/app/views/register.php';
   }

   public function login()
   {
      $user = User::findById($_SESSION['user_id']);

      if ($user && Session::getByToken($user->id)->token == $_SESSION['session_token']) {
         header('Location: /');
         exit();
      }

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {

         $login = $_POST['login'];
         $password = $_POST['password'];

         $user = User::findByLogin($login);

         if ($user && password_verify($password, $user->password)) {

            $hash = bin2hex(random_bytes(16));
            $session = new Session();
            $session->create($user->id, $hash);

            $_SESSION['session_token'] = $hash;
            $_SESSION['user_id'] = $user->id;

            header('Location: /');
            exit();
         } else {
            $error = 'Неверные учетные данные. Попробуйте еще раз.';
         }
      }

      include $_SERVER['DOCUMENT_ROOT'] . '/app/views/login.php';
   }

   public function logout()
   {

      if (isset($_SESSION['session_token'])) {
         $token = $_SESSION['session_token'];
         Session::deleteByToken($token);
         session_unset();
      }

      header('Location: /');
      exit();
   }
}
