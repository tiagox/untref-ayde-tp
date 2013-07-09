<h1>Usuarios</h1>
<h2>Editar usuario</h2>
<?php echo form_open(); ?>

<?php echo form_hidden('id', $user->id); ?>

<?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>

<table class="table">
  <tr>
    <td>Nombre de usuario</td>
    <td><?php echo form_input(array(
      'name' => 'username',
      'id' => 'username',
      'type' => 'email',
      'value' => set_value('username') ?: $user->username
    )); ?></td>
  </tr>
  <tr>
    <td>Contraseña</td>
    <td><?php echo form_input(array(
      'name' => 'password',
      'id' => 'password'
    )); ?></td>
  </tr>
  <tr>
    <td>Nombre</td>
    <td><?php echo form_input(array(
      'name' => 'name',
      'id' => 'name',
      'value' => set_value('name') ?: $user->name
    )); ?></td>
  </tr>
  <tr>
    <td>Sueldo</td>
    <td><?php echo form_input(array(
      'id' => 'salary',
      'name' => 'salary',
      'type' => 'number',
      'value' => set_value('salary') ?: $user->salary
    )); ?></td>
  </tr>
  <tr>
    <td>Rol</td>
    <td><?php echo form_dropdown('rol', $roles, set_value('rol') ?: $user->rol); ?></td>
  </tr>
  <tr>
    <td>Horas semanales</td>
    <td><?php echo form_input(array(
      'id' => 'weekly_hours',
      'name' => 'weekly_hours',
      'type' => 'number',
      'value' => set_value('weekly_hours') ?: $user->weekly_hours
    )); ?></td>
  </tr>
  <tr>
    <td>Fecha de ingreso</td>
    <td><?php echo form_input(array(
      'id' => 'entry_date',
      'name' => 'entry_date',
      'readonly' => 'readonly',
      'value' => set_value('entry_date') ?: $user->entry_date
    )); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo form_submit(array(
      'value' => 'Guardar',
      'class' => 'btn btn-primary'
    )); ?>

    <?php echo anchor('users', 'Cancelar', array('class' => 'btn btn-link')); ?></td>
  </tr>
  <?php echo form_close(); ?>

</table>
