<? require '/layouts/header.php'; ?>

<h1>Задачник</h1>
<a href="/create" class="btn btn-primary mb-3">Создать задачу</a>

<table class="table">
   <thead>
      <tr>
         <th>Имя пользователя</th>
         <th>Email</th>
         <th>Текст задачи</th>
         <th>Действия</th>
      </tr>
   </thead>
   <tbody>
      <?php foreach ($tasks as $task) : ?>
         <tr>
            <td><?= $task->username ?></td>
            <td><?= $task->email ?></td>
            <td><?= $task->task ?></td>
            <td>
               <?php
               if (User::isLoggedIn()) {
                  echo '<a href="/edit?id=<?= $task->id ?>" class="btn btn-primary btn-sm">Редактировать</a>
                              <a href="/delete?id=<?= $task->id ?>" class="btn btn-danger btn-sm">Удалить</a>';
               } else {
                  echo 'Нет прав на управление задачами';
               }
               ?>
            </td>
         </tr>
      <?php endforeach; ?>
   </tbody>
</table>

<? require_once 'layouts/footer.php'; ?>