<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <title>Регистарция</title>
   <link rel="stylesheet" href="/assets/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="/assets/dist/css/styles.css">
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary vh-100">
   <?php if (isset($error)) { ?>
      <div class="error"><?php echo $error; ?></div>
   <?php } ?>
   <main class="form-signin m-auto">
      <form action="index.php?action=register" method="POST">
         <h1 class="h3 mb-3 fw-normal">Регистарция</h1>

         <div class="form-floating">
            <input name="login" type="text" class="form-control" id="floatingInput" placeholder="admin">
            <label for="floatingInput">Логин</label>
         </div>
         <div class="form-floating">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="123">
            <label for="floatingPassword">Пароль</label>
         </div>

         <button class="btn btn-primary w-100 py-2" type="submit">Зарегистрироваться</button>
      </form>
   </main>
   <script src="/assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>