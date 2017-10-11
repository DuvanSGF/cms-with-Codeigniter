<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller {

  function __construct()
  {
  				parent::__construct();

  /* Librerias de codeigniter son obligatorias */
  		$this->load->database();
  		$this->load->helper('url');
  		$this->load->model('m_globals');
  /* ------------------ */
  }

  public function index()
	{
      $output= new stdClass();
      $this->m_globals->get_configuration();
      $output->titulo_empresa =$this->m_globals->conf_bussines;
      $output->titulo_nombreapp =$this->m_globals->conf_aplication;
      $output->titulo_dev =$this->m_globals->conf_dev;
      $output->titulo_email =$this->m_globals->conf_email;
      $output->titulo_descripcion =$this->m_globals->conf_descripcionapp;
      $output->titulo_derechos =$this->m_globals->conf_right;
      $output->titulo_icono =$this->m_globals->conf_icono;
      $output->faviconapp =$this->m_globals->conf_favicon;
      $this->load->helper(array('form'));
    	$this->load->view("/Login/V_login", $output);
  }
}
