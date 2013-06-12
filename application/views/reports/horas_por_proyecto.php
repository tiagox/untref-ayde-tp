<h1>Generar reporte</h1>
<h2>Reporte de horas por proyecto</h2>
<h3>Correspondiente al mes de <?= $month_name ?> (<?= $month_period ?>) </h3>
<div class="span8">
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Proyecto</th>
        <th>Costo</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($report_rows as $row) : ?>

      <tr>
        <td><?= $row->project ?></td>
        <td>$ <?= number_format(intval($row->monthly_cost)) ?></td>
      </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
</div>
