<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_register extends CI_Controller {
  public function index()
	{
    $this->load->view("/register/v_register");
  }
}
