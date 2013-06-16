<h1>Generar reporte</h1>
<h2>Reporte de horas por proyecto</h2>
<h3>Correspondiente al mes de <?= $month_name ?> (<?= $month_period ?>) </h3>
<div class="span8">
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Proyecto</th>
        <th>Costo</th>
        <th>Cantidad de recursos</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($report_rows as $row) : ?>

      <tr>
        <td><?= $row->project ?></td>
        <td>$ <?= number_format(ceil($row->monthly_cost)) ?></td>
        <td><?= $row->resources_count ?></td>
      </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
</div>
