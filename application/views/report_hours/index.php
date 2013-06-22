<h1>Reportar horas</h1>
<?php if ($this->session->flashdata('success')) : ?>
<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <?= $this->session->flashdata('success') ?>

</div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')) : ?>
<div class="alert alert-error">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <?= $this->session->flashdata('error') ?>

</div>
<?php endif; ?>
<div class="messages"></div>
<?php echo form_open(); ?>

<table class="table">
  <tbody>
    <tr>
      <td>Semana</td>
      <td><?php echo form_dropdown('week', $weeks, $last_week, 'class="span8 week"'); ?></td>
    </tr>
    <?php foreach ($projects as $project) : ?>

    <tr>
      <td><?php echo $project->name; ?></td>
      <td><?php echo form_input(array(
        'id' => 'project_' . $project->id,
        'name' => 'projects[' . $project->id . ']',
        'class' => 'span2 project',
        'type' => 'number',
        'value' => 0
      )); ?> horas</td>
    </tr>
    <?php endforeach; ?>

    <tr>
      <td>Se cargaron: <span id="hours_count" class="label label-important">0</span> de <span id="weekly_hours" class="label">0</span> horas</td>
      <td><?php echo form_submit(array(
        'id' => 'save_hours',
        'value' => 'Guardar',
        'class' => 'btn btn-primary'
      )); ?>

      <?php echo anchor('report_hours', 'Cancelar', array('class' => 'btn btn-link')); ?></td>
    </tr>
    <?php echo form_close(); ?>

  </tbody>
</table>
