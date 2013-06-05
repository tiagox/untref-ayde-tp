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
