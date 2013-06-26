<h1>Usuarios</h1>
<table class="table">
  <tr>
    <th>Nombre</th>
    <th>Nombre de usuario</th>
    <th>Rol</th>
    <th>Horas semanales</th>
    <th>Sueldo</th>
    <th>Fecha de ingreso</th>
  </tr>
  <?php foreach ($users as $user) : ?>

  <tr>
    <td><?= $user->name ?></td>
    <td><?= $user->username ?></td>
    <td><?= $user->rol ?></td>
    <td><?= $user->weekly_hours ?></td>
    <td><?= $user->salary ?></td>
    <td><?= (new DateTime($user->entry_date))->format('d/m/Y') ?></td>
  </tr>
  <?php endforeach; ?>

</table>
