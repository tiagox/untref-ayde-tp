<h1>Usuarios</h1>
<table class="table">
  <tr>
    <th>Nombre</th>
    <th>Nombre de usuario</th>
    <th>Rol</th>
    <th>Horas semanales</th>
    <th>Sueldo</th>
    <th>Fecha de ingreso</th>
    <th>&nbsp;</th>
  </tr>
  <?php foreach ($users as $user) : ?>

  <tr>
    <td><?= $user->name ?></td>
    <td><?= $user->username ?></td>
    <td><?= $roles[$user->rol] ?></td>
    <td><?= $user->weekly_hours ?></td>
    <td><?= $user->salary ?></td>
    <td><?= (new DateTime($user->entry_date))->format('d/m/Y') ?></td>
    <td>
      <div class="btn-group">
        <?php if ($permissions[$rol]['users']['edit']) : ?>
        <?php echo anchor('users/edit/' . $user->id, '<i class="icon-pencil"></i>', array('class' => 'btn')); ?>
        <?php endif; ?>

        <?php if ($permissions[$rol]['users']['delete']) : ?>
        <?php echo anchor('users/delete/' . $user->id, '<i class="icon-trash"></i>', array('class' => 'btn delete-user')); ?>
        <?php endif; ?>

      </div>
    </td>
  </tr>
  <?php endforeach; ?>

  <?php if ($permissions[$rol]['users']['add']) : ?>
  <tr>
    <td colspan="7"><?php echo anchor('users/add', 'Agregar usuario', array('class' => 'btn')); ?></td>
  </tr>
  <?php endif; ?>
</table>
