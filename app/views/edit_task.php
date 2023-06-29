<? require_once 'layouts/header.php'; ?>

<h1>Редактировать задачу</h1>
<form method="post" action="/edit?id=<?= $task['id'] ?>">
   <div class="form-group">
      <label for="username">Имя пользователя</label>
      <input type="text" class="form-control" id="username" name="username" value="<?= $task['username'] ?>" required>
   </div>
   <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" value="<?= $task['email'] ?>" required>
   </div>
   <div class="form-group">
      <label for="task">Текст задачи</label>
      <textarea class="form-control" id="task" name="task" rows="3" required><?= $task['task'] ?></textarea>
   </div>
   <div class="form-group my-3">
      <input type="radio" class="btn-check" name="completed" id="success-outlined" value="1" autocomplete="off" <?= $task['completed'] ? 'checked' : '' ?>>
      <label class="btn btn-outline-success" for="success-outlined">Выполнено</label>

      <input type="radio" class="btn-check" name="completed" id="danger-outlined" value="0" autocomplete="off" <?= $task['completed'] ? '' : 'checked' ?>>
      <label class="btn btn-outline-danger" for="danger-outlined">Не выпонлено</label>
   </div>
   <button type="submit" class="btn btn-primary">Сохранить</button>
</form>

<? require_once 'layouts/footer.php'; ?>