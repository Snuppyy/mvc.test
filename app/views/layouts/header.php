<!DOCTYPE html>
<html>

<head>
   <title>Сайт по тест заданию</title>
   <link rel="stylesheet" href="/assets/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="/assets/dist/css/styles.css">
</head>

<body>
   <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
         <div class="container">
            <a class="navbar-brand" href="/">MVC на нативном PHP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex flex-row-reverse" id="navbarNav">
               <ul class="navbar-nav ml-auto">
                  <?
                  if (User::isLoggedIn()) {
                  ?>
                     <li class="nav-item">
                        <a class="nav-link" href="/logout">Выйти</a>
                     </li>
                  <?
                  } else {
                  ?>
                     <li class="nav-item">
                        <a class="nav-link" href="/login">Авторизация</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/register">Регистрация</a>
                     </li>
                  <?
                  }
                  ?>
               </ul>
            </div>
         </div>
      </nav>
   </header>
   <div class="container">