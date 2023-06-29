<? require_once 'layouts/header.php'; ?>

<h1>Создать задачу</h1>
<form method="post" action="/create">
   <div class="form-group">
      <label for="username">Имя пользователя</label>
      <input type="text" class="form-control" id="username" name="username" required>
   </div>
   <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" required>
   </div>
   <div class="form-group">
      <label for="task">Текст задачи</label>
      <textarea class="form-control" id="task" name="task" rows="3" required></textarea>
   </div>
   <button type="submit" class="btn btn-primary">Создать</button>
</form>

<? require_once 'layouts/footer.php'; ?>