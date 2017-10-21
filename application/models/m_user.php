<?php
Class m_user extends CI_Model
{
 function login($username, $password)
 {
   $this->db->select('id_user, user, password, email, id_rol, foto, estado');
   $this->db->from('cms_user');
   $this->db->where('user', $username);
//   $this->db->where('user_pass', MD5($password));
   $this->db->where('password', $password);
   $this->db->limit(1);

   $query = $this->db->get();

   if($query->num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }

function getrol($id_rol)
{
  $this->db->select('nombre');
  $this->db->from('cms_rol');
  $this->db->where('id_rol', $id_rol);
  $this->db->limit(1);

  $query = $this->db->get();

  if($query->num_rows() == 1)
  {
    return $query->result();
  }
  else
  {
    return false;
  }
}

function getpermisos($tabla)
{
  $session_data  =   $this->session->userdata('logged_in');
  if( $session_data['ses_user_rol'] ==1) return true;// validamos que el super admin siempre tiene  todos los permisos

  $this->db->select('*');
  $this->db->from('cms_permisos cp');
  $this->db->join('cms_menu cm', 'cm.id_menu = cp.id_menu');
  $this->db->where('cp.id_rol', $session_data['ses_user_rol']);
  $this->db->where('cm.tabla', $tabla);
  $this->db->limit(1);

  $query = $this->db->get();

  if($query->num_rows() == 1)
  {
    return true;
  }
  else
  {
    return false;
  }
}

function register($user, $email, $password)
{
    $this->db->trans_start();
    $this->db->insert('cms_user', $user, $email, $password);

    $insert_id = $this->db->insert_id();

    $this->db->trans_complete();

    return $insert_id;
}

}
?>
