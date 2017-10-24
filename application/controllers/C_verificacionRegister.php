<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_verificacionRegister extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('m_user','',TRUE);
    $this->load->model('m_globals','',TRUE);
  }

  function index()
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('name_user', 'User', 'trim|required|is_unique[cms_user.user]');
    $this->form_validation->set_rules('email_user', 'Email', 'trim|required|is_unique[cms_user.email]');
    $this->form_validation->set_rules('password_user', 'Password', 'trim|required|min_length[5]');
    $this->form_validation->set_message('is_unique', 'El %s ya está existe.');
    // Si la validacion del formulario es TRUE
    if($this->form_validation->run() == TRUE)
    {
      // Agregando el Usuario a la Base de Datos.
      $data = array(
        'user'=>$_POST['name_user'],
        'email'=>$_POST['email_user'],
        'password'=>$_POST['password_user']
      );
      $this->db->insert('cms_user', $data);

      $this->session->set_flashdata("Exito", "Tu cuenta ha sido registrada. Puedes hacer login ahora");
      redirect('c_home', 'refresh');

    }else {
      $this->load->view('register/v_register');
    }
  }

  public function is_unique($str, $field)
  {
    list($table, $field)=explode('.', $field);
    $query = $this->CI->db->limit(1)->get_where($table, array($field => $str));
    return $query->num_rows() === 0;
  }
}
