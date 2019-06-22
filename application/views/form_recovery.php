<div class="col-md-8 col-md-offset-2">
	<div class="row" id="registerForm">
		<h1>Recuperación de password con codeigniter</h1>
		<br>
		<?php

			messages_flash('danger',validation_errors(),'Errores del formulario', true);

			//si el email no se ha podido enviar
			messages_flash('danger','not_mail_send','Error enviando el email');

			//si el email ha sido enviado correctamente se lo notificamos
			messages_flash('success','mail_send','Email enviado correctamente');
		?>
		<?php echo form_open(base_url("recovery/update_password")) ?>

			<div class="input-group col-md-12">
			    <span class="input-group-addon">The new password</span>
			    <input type="password" name="password" class="form-control">
			</div><br>

			<div class="input-group col-md-12">
			    <span class="input-group-addon">Confirm password</span>
			    <input type="password" name="conf_password" class="form-control">
			</div><br>

			<input type="hidden" name="token" value="<?php echo $token ?>">

			<button type="submit" class="btn btn-success col-md-4 col-md-offset-8">Cambiar el password</button>

		<?php echo form_close() ?>
	</div>
</div>

<style type="text/css">
#registerForm
{
	margin-top: 100px;
}
</style>
