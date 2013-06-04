<div id="container-fluid">
	<div class="content">
		<div class="row-fluid">
      <div class="span3">
        <div class="well sidebar-nav">
          <ul class="nav nav-list">
            <li class="nav-header">Accesos</li>
            <li><?php echo anchor('home', 'Inicio'); ?></li>
            <li><?php echo anchor('report_hours', 'Reportar horas'); ?></li>
            <li class="active"><?php echo anchor('projects', 'Proyectos'); ?></li>
          </ul>
        </div>
      </div>
      <div class="span9">
        <h1>Proyectos</h1>
        <table class="table">
          <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th>&nbsp;</th>
          </tr>
          <?php foreach ($projects as $project) : ?>

          <tr>
            <td><?php echo $project->id; ?></td>
            <td><?php echo $project->name; ?></td>
            <td><?php echo ($project->active) ? 'Activo' : 'Inactivo'; ?></td>
            <td>
              <div class="btn-group">
                <?php echo anchor('projects/edit/' . $project->id, '<i class="icon-pencil"></i>', array('class' => 'btn')); ?>

                <?php echo anchor('projects/delete/' . $project->id, '<i class="icon-trash"></i>', array('class' => 'btn')); ?>

              </div>
            </td>
          </tr>
          <?php endforeach; ?>

          <tr>
            <td colspan="4"><?php echo anchor('projects/add', 'Agregar proyecto', array('class' => 'btn')); ?></td>
          </tr>
        </table>
      </div>
		</div>
	</div>
</div>
