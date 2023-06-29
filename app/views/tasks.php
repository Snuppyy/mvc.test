<? require 'layouts/header.php'; ?>

<h1>Задачник</h1>
<a href="/create" class="btn btn-primary mb-3">Создать задачу</a>

<table class="table">
   <thead>
      <tr>
         <th>#</th>
         <th>Имя</th>
         <th>Email</th>
         <th>Текст задачи</th>
         <th>Статус</th>
         <th>Действия</th>
      </tr>
   </thead>
   <tbody>

      <?php foreach ($tasks as $task) { ?>
         <tr class="<?php echo $task['completed'] ? 'table-success' : 'table-warning'; ?>">
            <td><?php echo $task['id']; ?></td>
            <td><?php echo $task['username']; ?></td>
            <td><?php echo $task['email']; ?></td>
            <td><?php echo $task['task']; ?></td>
            <td><?php echo $task['completed'] ? 'Выполнено' : 'Выполняется'; ?></td>
            <td>
               <?
               if (User::isLoggedIn()) {
               ?>
                  <a href="/edit?id=<?php echo $task['id']; ?>" class="btn btn-sm btn-primary">Редактировать</a>
                  <a href="/delete?id=<?php echo $task['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Удалить</a>
               <?
               } else {
               ?>
                  Нет доступа для управления
               <?
               }
               ?>
            </td>
         </tr>
      <?php } ?>
   </tbody>
</table>

<?php echo $pagerHtml; ?>

<? require_once 'layouts/footer.php'; ?>