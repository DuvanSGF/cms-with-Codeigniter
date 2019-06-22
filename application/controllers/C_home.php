<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_home extends CI_Controller {

function __construct()
{
				parent::__construct();

/* Librerias de codeigniter son obligatorias */
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('m_menu');
		$this->load->model('m_globals');
		$this->load->model('m_user');
/* ------------------ */

$this->load->library('grocery_CRUD');

}

public function index()
{
	if($this->session->userdata('logged_in'))
		{
			$output = new stdClass();
			$output->pintacrud="no";
    	$this->_cms_output($output);
    }else {
      redirect('C_login', 'refresh');
    }
}

public function cms_tabla($tabla)
	{
		if($this->session->userdata('logged_in'))
			{
				if ($this->m_user->getpermisos($tabla)){

					$crud = new grocery_CRUD();
					$crud->set_table($tabla);
					if ($tabla == 'cms_user'){
						$crud->set_relation('id_rol','cms_rol','nombre');
						$crud->set_field_upload('foto','assets/uploads/files');
						//validamos el campo email en el grocery_CRUD
						$crud->set_rules('email','email','valid_email');
						//validamos el campo user en el grocery_CRUD
						$crud->set_rules('user','user','alpha');

					}elseif ($tabla == 'cms_permisos'){
						$crud->set_relation('id_rol','cms_rol','nombre');
						$crud->set_relation('id_menu','cms_menu','name_menu');
					}elseif ($tabla == 'cms_configuracion'){
						$crud->set_field_upload('favicon_aplication','assets/uploads/files');
					}elseif ($tabla == 'cms_menu') {
						$crud->set_relation('id_menu','cms_menu','name_menu');
						//$crud->set_relation('name_menu','cms_menu','id_menu');
					}elseif ($tabla == 'cms_despachos') {
						$crud->set_relation('id_rol','cms_despachos','id_despachos');
						$crud->set_relation('id_rol','cms_rol','nombre');
					}
					$output = $crud->render();
					$this->m_globals->get_seccion($tabla);
					$output->titulo_pagina =$this->m_globals->conf_titulo;
					$output->titulo_descripcion =$this->m_globals->conf_descripcion;
					$output->pintacrud="si";
					$this->_cms_output($output);

				}else{
					$output = new stdClass();
					$output->pintacrud="no";
					$output->content="v_errorperimisos";
					$this->_cms_output($output);
				}

	    }else {
	      redirect('C_login', 'refresh');
	    }
		}



public function pinta_menux()
{
	if($this->session->userdata('logged_in'))
		{
			$output= new stdClass();

				$output->pintacrud="si";
	    	$this->_cms_output($output);
	   }else{
	      redirect('C_login', 'refresh');
	    }
}


function logout(){

	$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('C_home', 'refresh');

}


function _cms_output($output = null)
{
/*datos de session de usuario*/
	$session_data         	=   $this->session->userdata('logged_in');
	$output->user_name  	  =   $session_data['ses_user_name'];
	$output->user_rol  		  =   $session_data['ses_user_rol'];
	$output->user_photo 	  =   $session_data['ses_user_foto'];
	$output->user_rol_name 	=   $session_data['ses_user_rol_name'];
	$resultmenu             =   $this->m_menu->menu_permisos($output->user_rol);
	$output->array_menu     =   array('opc_menu'=> $resultmenu);
	$this->m_globals->get_configuration();
	$output->titulo_empresa =$this->m_globals->conf_bussines;
	$output->titulo_dev =$this->m_globals->conf_dev;
	$output->titulo_email =$this->m_globals->conf_email;
	$output->titulo_descripcionapp =$this->m_globals->conf_descripcionapp;
	$output->titulo_derechos =$this->m_globals->conf_right;
	$output->titulo_icono =$this->m_globals->conf_icono;
  $output->titulo_nombreapp =$this->m_globals->conf_aplication;
	$output->faviconapp =$this->m_globals->conf_favicon;

	$this->load->view('/base/v_index.php',$output);
}
}
