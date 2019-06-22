<?php
defined("BASEPATH") or die("Acceso prohibido");

if(!function_exists('messages_flash'))
{
	/**
	* @desc - muestra mensajes al usuario
	* @param $type - string con el tipo de panel de bootstrap
	* @param $flash - string mensaje a mostrar al usuario
	* @param $headMessage - string con el texto de la cabeceral del panel
	* @param $validation - bool, si es true son errores de form_validation, por defecto false
	* @return panel bootstrap con el contenido del mensaje
	*/
	function messages_flash($type,$flash,$headMessage, $validation = false)
	{
		$ci =& get_instance();
		if($validation == true && validation_errors())
		{
		?>
		<div class="panel panel-<?php echo $type ?>">
			<div class="panel-heading"><?php echo $headMessage ?></div>
			 <div class="panel-body">
			    <?php echo $flash ?>
			 </div>
		</div>
		<?php
		}
		else if($ci->session->flashdata($flash))
		{
		?>
		<div class="panel panel-<?php echo $type ?>">
			<div class="panel-heading"><?php echo $headMessage ?></div>
			 <div class="panel-body">
			    <?php echo $ci->session->flashdata($flash) ?>
			 </div>
		</div>
		<?php
		}
	}
}
