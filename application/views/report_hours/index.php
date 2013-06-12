<h1>Reportar horas</h1>
<?php echo form_open(); ?>

<table class="table">
  <tr>
    <td>Semana</td>
    <td><?php echo form_dropdown('week', $weeks, $last_week); ?></td>
  </tr>
  <?php foreach ($projects as $project) : ?>

  <tr>
    <td><?php echo $project->name; ?></td>
    <td><?php echo form_input(array(
      'name' => 'id',
      'id' => $project->id,
      'type' => 'number',
      'value' => 0
    )); ?> horas</td>
  </tr>
  <?php endforeach; ?>

  <tr>
    <td>&nbsp;</td>
    <td><?php echo form_submit(array(
      'value' => 'Guardar',
      'class' => 'btn btn-primary'
    )); ?>


    <?php echo anchor('home', 'Cancelar', array('class' => 'btn btn-link')); ?></td>
  </tr>
  <?php echo form_close(); ?>

</table>
