<div id="container-fluid">
	<div class="content">
		<div class="row-fluid">
			<div class="span4 offset4">
				<?php echo form_open(); ?>

				<fieldset>
					<legend>Registrar usuario</legend>
					<?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>

					<input type="text" name="username" id="username" placeholder="Mail de usuario" class="span12">
					<input type="text" name="name" id="name" placeholder="Nombre de usuario" class="span12">
					<input type="text" name="salary" id="salary" placeholder="Nombre de usuario" class="span12">
					<input type="text" name="rol" id="rol" placeholder="Rol" class="span12">
					<input type="password" name="password" id="password" placeholder="Contraseña" class="span12">
					<input type="submit" value="Registrar" class="btn btn-primary span12">
				</fieldset>
				<?php echo form_close(); ?>

			</div>
		</div>
	</div>
</div>
