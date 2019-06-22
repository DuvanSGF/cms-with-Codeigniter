<?php
defined("BASEPATH") or die("Acceso prohibido");

class Recovery_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* @desc - registra usuarios en la tabla users
	* @param - $data array con los datos del usuario
	* @return - boolean
	*/
	public function register($data = array())
	{
		if($this->db->insert("users", $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
	* @desc - comprueba si existe el email
	* @param - $email string con el email del formulario
	* @return - boolean
	*/
	public function verifica_email($email)
	{
		$query = $this->db->get_where('users', array('email' => $email));
        if($query->num_rows() === 1)
        {
            return TRUE;
        }
	}

	/**
	* @desc - obtiene los datos de un usuario por su email
	* @param - $email string con el email del formulario
	* @return - mixed
	*/
	public function getUserData($email)
	{
		$query = $this->db->get_where('users', array('email' => $email));
        if($query->num_rows() === 1)
        {
        	//actualizamos el campo request_token del usuario y
        	//le damos 5 minutos para recuperar el password
        	if($this->startRecoveryPassword($query->row()->id))
        	{
        		return $query->row();
        	}
        }
	}

	/**
	* @desc - actualiza el campo request_token del usuario para dar 5 minutos
	* @param - $user_id int con el id del usuario
	* @return - bool
	*/
	private function startRecoveryPassword($user_id)
	{
		//damos 5 minutos al usuario para recuperar su password
        $expire_stamp = date('Y-m-d H:i:s', strtotime("+5 min"));
		$data = array("request_token" => $expire_stamp);
		$this->db->where("id", $user_id);
		if($this->db->update("users", $data))
		{
			return TRUE;
		}
	}

	/**
	* @desc - comprueba si el campo request_token es menor que la fecha actual
	* @param $token - string unico por usuario
	* @return - bool
	*/
	public function checkIsLiveToken($token)
	{
		$current_stamp = date('Y-m-d H:i:s');
		$query = $this->db->select("id")
				 ->from("users")
				 ->where("token",$token)
				 ->where("request_token >",$current_stamp)
				 ->get();

		if($query->num_rows() === 1)
		{
			return $query->row();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	* @desc - hacemos el update del password del usuario
	* @param $data - array con datos para actualizar
	* @return - bool
	*/
	public function change_password($data = array())
	{
		$this->db->where("id",$data["user_id"]);
		unset($data['user_id']);//eliminamos la clave user_id del array
		if($this->db->update("users", $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}
