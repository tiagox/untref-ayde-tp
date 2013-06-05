<h1>Proyectos</h1>
<h2>Agregar proyecto</h2>
<?php echo form_open(); ?>

<?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>

<table class="table">
  <tr>
    <td>Nombre</td>
    <td><?php echo form_input(array(
      'name' => 'name',
      'id' => 'name'
    )); ?></td>
  </tr>
  <tr>
    <td>Estado</td>
    <td><?php echo form_dropdown('active', $status); ?></td>
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
