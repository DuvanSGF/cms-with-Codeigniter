<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends CI_Controller {

function __construct()
{
				parent::__construct();
  $this->load->library('email');
}

public function index()
{
  $config = Array(
    'protocol' => 'smtp',
    'smtp_host' => 'ssl://smtp.googlegmail.com',
    'smtp_port' => 465,
    'smtp_user' => 'damejia.98@gmail.com',
    'smtp_pass' => '3143982594',
    'mailtype' => 'html',
    'charset' => 'utf-8',
    'newline' => "\r\n",
    'wordwrap'=> TRUE
  );
  $this->load->library('email', $config);
  $this->email->from('damejia.98@gmail.com', 'Root user ');
  $this->email->to('kaxcortes314@gmail.com');
  $this->email->subject('Email Test');
  $this->email->message('Testing the email class. IM THE KING');
  $this->email->set_newline("\r\n");

 if($result = $this->email->send()){
  echo "Enviado";
}else {
  echo "no se pudo";
}
 $this->email->print_debugger();
	}

}
