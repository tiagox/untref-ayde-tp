<div id="container-fluid">
	<div class="content">
		<div class="row-fluid">
      <div class="span3">
        <div class="well sidebar-nav">
          <ul class="nav nav-list">
            <li class="nav-header">Accesos</li>
            <li><?php echo anchor('home', 'Inicio'); ?></li>
            <li class="active"><?php echo anchor('report_hours', 'Reportar horas'); ?></li>
            <li><?php echo anchor('projects', 'Proyectos'); ?></li>
          </ul>
        </div>
      </div>
      <div class="span9">
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
              'type' => 'number'
            )); ?></td>
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
      </div>
		</div>
	</div>
</div>
