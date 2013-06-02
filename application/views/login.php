<div id="container-fluid">
	<div class="content">
		<div class="row-fluid">
			<div class="span4 offset4">
				<?php echo form_open(); ?>

				<fieldset>
					<legend>Iniciar sesión</legend>
					<input type="text" name="username" id="username" placeholder="Nombre de usuario" class="">
					<input type="password" name="password" id="password" placeholder="Contraseña">
					<input type="submit" value="Iniciar sesión" class="btn btn-primary pull-right">
					<?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>

				</fieldset>
				<?php echo form_close(); ?>

			</div>
		</div>
	</div>
</div>
