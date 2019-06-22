<div class="col-md-8 col-md-offset-2">
	<div class="row" id="registerForm">
		<h1>Recuperación de password con codeigniter</h1>
		<br>
		<?php
			messages_flash('danger',validation_errors(),'Errores del formulario', true);

			//si hay error enviando el email
			messages_flash('danger','not_email_send','Error enviando el email');

			//si se ha enviando el email correctamente
			messages_flash('success','mail_send','Email enviado correctamente');

			//si hay error enviando el email
			messages_flash('danger','expired_request','Error recuperación password');

			//si hay error modificando el password lo mostramos
			messages_flash('danger','error_password_changed','Error modificando el password');

			//si se ha modificado el password correctamente
			messages_flash('success','password_changed','Password modificado correctamente');
		?>

		<?php echo form_open(base_url("recovery/request_password")) ?>

			<div class="input-group col-md-12">
			    <span class="input-group-addon">Email</span>
			    <input type="text" name="email" class="form-control" value="<?php echo set_value('email')?>">
			</div><br>

			<button type="submit" class="btn btn-success col-md-4 col-md-offset-8">Recuperar el password</button>

		<?php echo form_close() ?>
	</div>
</div>

<style type="text/css">
#registerForm
{
	margin-top: 100px;
}
</style>
