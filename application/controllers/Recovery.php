<?php
defined("BASEPATH") or die("Acceso prohibido");

class Recovery extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* @desc - renderiza header vista y footer
	* @param $view - string con el nombre de la vista a renderizar
	* @param $data - array con datos para pasar a la vista
	*/
	private function render($view, $data)
	{
		$this->load->view("templates/header", $data);
		$this->load->view($view, $data);
		$this->load->view("templates/footer", $data);
	}

	/**
	* @desc - genera un token para cada usuario registrado
	* @return token
	*/
	private function token()
    {
        return sha1(uniqid(rand(),true));
    }

    /**
    * @desc - renderiza la vista register
    */
	public function index()
	{
		$data = array();
		$data["title"] = "Recovery pass with codeigniter";
		$this->render("register", $data);
	}

	/**
	* @desc - procesa el formulario de registro
	*/
	public function register()
	{
		$this->form_validation->set_rules(
			'email', 'email', 'required|trim|min_length[2]|max_length[50]|is_unique[users.email]|valid_email'
		);
        $this->form_validation->set_rules(
        	'password', 'password', 'required|trim|min_length[6]|max_length[50]'
        );

        $this->form_validation->set_message('required', 'El %s es requerido');
        $this->form_validation->set_message('valid_email', 'El %s no tiene un formato correcto');
        $this->form_validation->set_message('is_unique', 'El email escogido ya está en uso');
        $this->form_validation->set_message('min_length', 'El %s debe tener al menos %s carácteres');
        $this->form_validation->set_message('max_length', 'El %s debe tener al menos %s carácteres');

        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
        	$data = array(
        			"email"		=>	$this->input->post("email"),
        			"password"	=>	sha1($this->input->post("password")),
        			"token"		=>	$this->token(),
        		);

        	$this->load->model("recovery_model");
        	if($this->recovery_model->register($data) === TRUE)
        	{
        		$this->session->set_flashdata("registered", "Te has registrado correctamente");
        		redirect(base_url("recovery"),"refresh");
        	}
        }
	}

	/**
    * @desc - renderiza la vista recovery_pass
    */
	public function request_pass()
	{
		$data = array();
		$data["title"] = "Recovery pass with codeigniter";
		$this->render("recovery_pass", $data);
	}

	/**
	* @desc - posibilita al usuario a solicitar un nuevo password
	*/
	public function request_password()
	{
		$this->form_validation->set_rules(
			'email', 'email', 'required|trim|valid_email|callback_comprobar_email'
		);

        $this->form_validation->set_message('required', 'El %s es requerido');
        $this->form_validation->set_message('valid_email', 'El %s no tiene un formato correcto');

        if($this->form_validation->run() == FALSE)
        {
            $this->request_pass();
        }
        else
        {
        	$this->load->model("recovery_model");
        	//obtenemos los datos del usuario porque existe el email
        	$userData = $this->recovery_model->getUserData($this->input->post("email"));

        	//si se ha actualiado el request_token y todo ha ido bien
        	//enviamos un email al usuario
        	if($userData)
        	{
        		if($this->sendMailRecoveryPass($userData) === TRUE)
        		{
        			$this->session->set_flashdata(
        				"mail_send", "Se ha enviado un email a su correo para recuperar su password, tiene 5 minutos"
        			);
        		}
        		else
        		{
        			$this->session->set_flashdata(
        				"not_email_send", "Ha ocurrido un error enviando el email, pruebe más tarde"
        			);
        		}
        		redirect(base_url("recovery/request_pass"),"refresh");
        	}
        }
	}

	/**
    * @desc - callback para la validación del formulario que valida si existe el email en la base de datos
    */
    public function comprobar_email()
    {
        $email = $this->input->post('email');
        $this->load->model("recovery_model");
        $comprobar_email = $this->recovery_model->verifica_email($email);
        if ($comprobar_email !== TRUE)
        {
            $this->form_validation->set_message('comprobar_email', 'El email introducido no existe en la base de datos');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /**
    * @desc - renderiza la vista recovery_pass
    */
	public function recovery_password($token = "")
	{
		//si el password ha caducado
		if($this->checkIsLiveToken($token) === FALSE)
		{
			$this->session->set_flashdata(
				"expired_request", "Si necesita recuperar su password rellene el
				formulario con su email y le haremos llegar un correo con instrucciones"
			);
			redirect(base_url("recovery/request_password"),"refresh");
		}
		$data = array();
		$data["title"] = "Recovery pass with codeigniter";
		$data["token"] = $token;
		$this->session->set_userdata("id_user_recovery_pass", $this->checkIsLiveToken($token)->id);
		$this->render("form_recovery", $data);
	}

	/**
	* @desc - procesa el formulario para cambiar el password del usuario
	*/
	public function update_password()
	{
		//validamos que los passwords coincidan
		$this->form_validation->set_rules(
        	'password', 'password', 'required|trim|min_length[6]|max_length[50]|matches[conf_password]'
        );

        $this->form_validation->set_rules(
        	'conf_password', 'confirm pass', 'required|trim|min_length[6]|max_length[50]'
        );

        $this->form_validation->set_message('required', 'El %s es requerido');
        $this->form_validation->set_message('matches', 'El %s y el %s no coinciden');
        $this->form_validation->set_message('max_length', 'El %s no puede tener más de %s carácteres');
        $this->form_validation->set_message('min_length', 'El %s no puede tener menos de %s carácteres');

        //si el formulario no pasa mandamos a recovery_password con el token como parámetro
        if($this->form_validation->run() == FALSE)
        {
            $this->recovery_password($this->input->post("token"));
        }
        else
        {

        	$data = array(
        			"password"		=>	sha1($this->input->post("password")),
        			"user_id"		=>	$this->session->userdata("id_user_recovery_pass"),
        			"request_token"	=>	date('Y-m-d H:i:s'),
        			"token"			=>	$this->token()//ponemos otro token nuevo
        		);

        	$this->load->model("recovery_model");

        	//si el password se ha cambiado correctamente y actualizado los datos
        	if($this->recovery_model->change_password($data) === TRUE)
        	{
        		$this->session->set_flashdata(
					"password_changed", "Su password ha sido modificado correctamente"
				);
        	}
        	//en otro caso error
        	else
        	{
        		$this->session->set_flashdata(
					"error_password_changed", "Ha ocurrido un error modificando su password"
				);
        	}
        	redirect(base_url("recovery/request_pass"),"refresh");
        }
	}

	/**
	* @desc - comprueba si el token ha expirado o no, el usuario tiene 5 minutos de tiempo
	* @param $token - string unico por usuario
	*/
	private function checkIsLiveToken($token)
	{
		$this->load->model("recovery_model");
		return $this->recovery_model->checkIsLiveToken($token);
	}

	/**
	* @desc - configura y envia un email con gmail
	* @param - $userdata array con los datos del usuario para enviar el email
	*/
    private function sendMailRecoveryPass($userdata)
    {
        //cargamos la libreria email de ci
        $this->load->library("email");

        //configuracion para gmail
        $configGmail = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'damejia.98@gmail.com',
            'smtp_pass' => '3143982594',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        );

        //cargamos la configuración para enviar con gmail
        $this->email->initialize($configGmail);

        $this->email->from('damejia.98@gmail.com');
        $this->email->to($userdata->email);
        $this->email->subject('Recuperación de password en nuestra plataforma');

        $html = '<h2>Pulsa el siguiente enlace para recuperar tu password</h2><hr><br>';
        $html .= '<a href="http://localhost/recovery_pass_ci/recovery/recovery_password/'.$userdata->token.'">';
        $html .= 'http://localhost/recovery_pass_ci/recovery/recovery_password/'.$userdata->token.'</a>';

        $this->email->message($html);

        if($this->email->send())
        {
        	return TRUE;
        }
    }
}
