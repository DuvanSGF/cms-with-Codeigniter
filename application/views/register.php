<div class="col-md-8 col-md-offset-2">
	<div class="row" id="registerForm">
		<h1>Recuperación de password con codeigniter</h1>
		<br>
		<?php
			messages_flash('danger',validation_errors(),'Errores del formulario', true);

			messages_flash('success','registered','Correcto');
		?>
		<?php echo form_open(base_url("recovery/register")) ?>

			<div class="input-group col-md-12">
			    <span class="input-group-addon">Email</span>
			    <input type="text" name="email" class="form-control" value="<?php echo set_value('email')?>">
			</div><br>

			<div class="input-group col-md-12">
			    <span class="input-group-addon">Password</span>
			    <input name="password" type="password" class="form-control">
			</div><br>

			<button type="submit" class="btn btn-success col-md-4 col-md-offset-8">Submit</button>

		<?php echo form_close() ?>
	</div>
</div>

<style type="text/css">
#registerForm
{
	margin-top: 100px;
}
</style>
