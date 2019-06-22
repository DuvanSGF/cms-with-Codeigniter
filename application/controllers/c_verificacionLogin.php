<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_verificacionLogin extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('m_user','',TRUE);
    $this->load->model('m_globals','',TRUE);
  }

  function index()
  {
    //This method will have the credentials validation
    $this->load->library('form_validation');

    $this->form_validation->set_rules('frm_user', 'Username', 'trim|required');
    $this->form_validation->set_rules('frm_pwd', 'Password', 'trim|required|callback_check_database');

    if($this->form_validation->run() == FALSE)
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
          $this->load->view("/login/V_login", $output);
    }
    else
    {
      redirect('c_home', 'refresh');
    }
}

 function check_database($password)
 {
   //Field validation succeeded.&nbsp; Validate against database
   $username = $this->input->post('frm_user');

   //query the database
   /* @var $username VerifyLogin */
   $result = $this->m_user->login($username, $password);

   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
		$result2 = $this->m_globals->procesa_registro('cms_rol','id_rol',$row->id_rol, 'nombre');
    //$rol=$this->m_user->getrol($row->id_rol);

       $sess_array = array(
			'ses_id' => $row->id_user,
			'ses_user_name' => $row->user,
			'ses_user_rol' => $row->id_rol,
			'ses_user_rol_name' => $result2,
			'ses_user_foto' => $row->foto,
      'ses_user_estado' => $row->estado
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Usuario o contraseña invalidos');
     return false;
   }
 }
}
?>
