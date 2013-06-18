<div class="navbar navbar-inverse navbar-static-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <span class="brand">Soluciones informaticas</span>
      <div class="nav-collapse collapse">
        <ul class="nav pull-right">
          <li><?php echo anchor('/auth/logout', 'Cerrar sesión'); ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="content">
    <div class="row-fluid">
      <div class="span3">
        <div class="well sidebar-nav">
          <ul class="nav nav-list">
            <li class="nav-header">Accesos</li>
            <li<?php echo ($selected === 'report_hours') ? ' class="active"' : ''; ?>>
              <?php echo anchor('report_hours', 'Reportar horas'); ?>
            </li>
            <li<?php echo ($selected === 'projects') ? ' class="active"' : ''; ?>>
              <?php echo anchor('projects', 'Proyectos'); ?>
            </li>
            <li<?php echo ($selected === 'reports') ? ' class="active"' : ''; ?>>
              <?php echo anchor('reports', 'Generar reporte'); ?>
            </li>
          </ul>
        </div>
      </div>
      <div class="span9">
