<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class C_recuperarEmail extends CI_Controller {
function __construct()
{
  parent::__construct();
  $this->load->model('m_user','',TRUE);
  $this->load->model('m_globals','',TRUE);
}
 function index(){

   echo "hola";
    $this->load->library('email');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('email_user', 'Email', 'required|trim|xss_clean|callback_validate_credentials');

            //check if email is in the database
        $this->load->model('M_user');
        if($this->M_user->email_exists()){
            //$them_pass is the varible to be sent to the user's email
            $temp_pass = uniqid();
            //send email with #temp_pass as a link

            $this->load->library('email', array('mailtype'=>'html'));
            $this->email->from('damejia.98@gmail.com', "Site");
            $this->email->to($this->input->post('email_user'));
            $this->email->subject("Reset your Password");

            $message = "<p>This email has been sent as a request to reset our password</p>";
            $message .= "<p><a href='".base_url()."login/reset_password/$temp_pass'>Click here </a>if you want to reset your password,
                        if not, then ignore</p>";
            $this->email->message($message);
            if($this->email->send()){
                $this->load->model('M_users');
                if($this->M_user->temp_reset_password($temp_pass)){
                    echo "check your email for instructions, thank you";
                }
            }
            else{
                echo "email was not sent, please contact your administrator";
            }

        }else{
            echo "your email is not in our database";
        }
}
function reset_password($temp_pass){
    $this->load->model('model_users');
    if($this->model_users->is_temp_pass_valid($temp_pass)){

        $this->load->view('reset_password');

    }else{
        echo "the key is not valid";
    }

}
function update_password(){
    $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');
            if($this->form_validation->run()){
            echo "passwords match";
            }else{
            echo "passwords do not match";
            }
}
}
