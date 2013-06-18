<script>
// Not working :(
window.onload = update_hours_sum();

function update_hours_sum()
{
  var number_of_projects = $('[name^=project]').length;
  var sum = 0;
  for(var i = 1; i <= number_of_projects; i++)
  {
    sum = sum + Number($("[name='projects[" + i + "]']").val());
  }
  $('#hours_sum').html(sum);
  if(sum > 40)
  {
    $('#hours_sum').css({color:'red'});
  } else {
    $('#hours_sum').css({color:'blue'});
  }
}
</script>
<h1>Reportar horas</h1>
<?php echo form_open(); ?>

<table class="table">
  <tbody>
    <tr>
      <td>Desarrollador</td>
      <td><?php echo form_dropdown('user', $users); ?></td>
    </tr>
    <tr>
      <td>Semana</td>
      <td><?php echo form_dropdown('week', $weeks, $last_week); ?></td>
    </tr>
    <?php foreach ($projects as $project) : ?>

    <tr>
      <td><?php echo $project->name; ?></td>
      <td><?php 
      $this->load->model('Reported_Hour');
      if($this->Reported_Hour->report_exists($project->id))
      {
		$hours = $reported_hours[$project->id][1][1];
      } else {
        $hours = 0;
      }
      echo form_input(array(
        'name' => 'projects[' . $project->id . ']',
        'type' => 'number',
        'value' => $hours,
	'onKeyUp' => 'update_hours_sum()'
      )); ?> horas</td>
    </tr>
    <?php endforeach; ?>

    <tr>
      <td><div style='float:left'>Horas cargadas:&nbsp</div><div id='hours_sum' style='font-size:25px'></div></td>
      <td><?php echo form_submit(array(
        'value' => 'Guardar',
        'class' => 'btn btn-primary'
      )); ?>


      <?php echo anchor('home', 'Cancelar', array('class' => 'btn btn-link')); ?></td>
    </tr>
    <?php echo form_close(); ?>

  </tbody>
</table>
