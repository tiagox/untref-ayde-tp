<h1>Generar reporte</h1>
<h2>Reporte de horas por proyecto</h2>
<div>
  <table class="table">
    <tr>
      <td class="span2"><?php echo form_dropdown(
        'months',
        $months,
        null,
        'id="cost_report_month"');
      ?></td>
      <td class="span2"><?php echo anchor(
        'reports/horas_por_proyecto',
        'Ver reporte',
        array(
          'class' => 'btn',
          'id' => 'cost_report'
        ));
      ?></td>
      <td>Listar el costo de los recursos consumidos por cada proyecto.
        Seleccione un mes del listado y haga clic en "Ver reporte".</td>
    </tr>
  </table>
</div>
