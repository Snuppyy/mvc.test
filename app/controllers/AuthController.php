<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/Session.php';

class AuthController
{
   public function register()
   {
      // Поиск пользователя по id
      $user = User::findById($_COOKIE['user_id']);

      if ($user && Session::getByToken($user->id)->token == $_COOKIE['session_token']) {
         header('Location: /');
         exit();
      }
      // Проверка, была ли отправлена форма регистрации
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         // Получение данных из формы
         $login = $_POST['login'];
         $password = $_POST['password'];

         // Валидация данных (можно добавить дополнительные проверки)

         // Поиск пользователя по логину
         $existingUser = User::findByLogin($login);

         if ($existingUser) {
            // Пользователь с таким логином уже существует, отображение ошибки
            $error = 'Пользователь с таким логином уже зарегистрирован.';
            include $_SERVER['DOCUMENT_ROOT'] . '/app/views/register.php';
            return;
         }

         // Создание нового пользователя
         $user = new User();
         $user->login = $login;
         $user->password = password_hash($password, PASSWORD_DEFAULT);
         $user->save();

         // Редирект на страницу успешной регистрации
         header('Location: /login');
         exit();
      }

      // Отображение страницы регистрации
      include $_SERVER['DOCUMENT_ROOT'] . '/app/views/register.php';
   }

   public function login()
   {
      // Поиск пользователя по id
      $user = User::findById($_COOKIE['user_id']);

      if ($user && Session::getByToken($user->id)->token == $_COOKIE['session_token']) {
         header('Location: /');
         exit();
      }

      // Проверка, была ли отправлена форма авторизации
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         // Получение данных из формы
         $login = $_POST['login'];
         $password = $_POST['password'];

         $user = User::findByLogin($login);

         // Проверка правильности пароля
         if ($user && password_verify($password, $user->password)) {
            // Создание сессии
            $session = new Session();
            $session->user_id = $user->id;
            $session->token = bin2hex(random_bytes(16));
            $session->save();

            // Установка куки с токеном сессии
            setcookie('session_token', $session->token, time() + (60 * 60 * 24 * 30), '/');
            setcookie('user_id', $session->user_id, time() + (60 * 60 * 24 * 30), '/');

            // Редирект на защищенную страницу
            header('Location: /');
            exit();
         } else {
            // Неверные учетные данные, отображение ошибки
            $error = 'Неверные учетные данные. Попробуйте еще раз.';
            include $_SERVER['DOCUMENT_ROOT'] . '/app/views/login.php';
         }
      }

      // Отображение страницы авторизации
      include $_SERVER['DOCUMENT_ROOT'] . '/app/views/login.php';
   }

   public function logout()
   {
      // Удаление токена сессии из базы данных и куки
      if (isset($_COOKIE['session_token'])) {
         $token = $_COOKIE['session_token'];
         Session::deleteByToken($token);
         setcookie('session_token', '', time() - 3600, '/');
         setcookie('user_id', '', time() - 3600, '/');
      }

      // Редирект на страницу авторизации
      header('Location: /login');
      exit();
   }
}
