<h1>Usuarios</h1>
<h2>Agregar usuario</h2>
<?php echo form_open(); ?>

<?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>

<table class="table">
  <tr>
    <td>Nombre de usuario</td>
    <td><?php echo form_input(array(
      'name' => 'username',
      'id' => 'username',
      'type' => 'email',
      'value' => set_value('username')
    )); ?></td>
  </tr>
  <tr>
    <td>Contraseña</td>
    <td><?php echo form_input(array(
      'name' => 'password',
      'id' => 'password',
      'value' => set_value('password')
    )); ?></td>
  </tr>
  <tr>
    <td>Nombre</td>
    <td><?php echo form_input(array(
      'name' => 'name',
      'id' => 'name',
      'value' => set_value('name')
    )); ?></td>
  </tr>
  <tr>
    <td>Sueldo</td>
    <td><?php echo form_input(array(
      'id' => 'salary',
      'name' => 'salary',
      'type' => 'number',
      'value' => set_value('salary') ?: 0
    )); ?></td>
  </tr>
  <tr>
    <td>Rol</td>
    <td><?php echo form_dropdown('rol', $roles, set_value('rol')); ?></td>
  </tr>
  <tr>
    <td>Horas semanales</td>
    <td><?php echo form_input(array(
      'id' => 'weekly_hours',
      'name' => 'weekly_hours',
      'type' => 'number',
      'value' => set_value('weekly_hours') ?: 40
    )); ?></td>
  </tr>
  <tr>
    <td>Fecha de ingreso</td>
    <?php $entry_date = new DateTime(); ?>
    <td><?php echo form_input(array(
      'id' => 'entry_date',
      'name' => 'entry_date',
      'readonly' => 'readonly',
      'value' => set_value('entry_date') ?: $entry_date->format('Y-m-d')
    )); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo form_submit(array(
      'value' => 'Guardar',
      'class' => 'btn btn-primary'
    )); ?>

    <?php echo anchor('projects', 'Cancelar', array('class' => 'btn btn-link')); ?></td>
  </tr>
  <?php echo form_close(); ?>

</table>
