<?php
Class M_menu extends CI_Model
{
  function menu_permisos($id_rol)
  {

     $session_data  =   $this->session->userdata('logged_in');
     if( $session_data['ses_user_rol'] ==1){ // validamos que el super admin siempre tiene  todos los permisos
      $this->db->select('*');
      $this->db->from('cms_menu cm');
      $this->db->where('cm.id_menu <>', 1);
      $this->db->Order_by('cm.id_menu_referencia','asc');
      $this->db->Order_by('cm.id_menu', 'asc');
      $this->db->Order_by('cm.position_menu', 'asc');
     }else{
       $this->db->select('*');
      $this->db->from('cms_permisos cp');
      $this->db->join('cms_menu cm', 'cm.id_menu = cp.id_menu');
 $this->db->where('cp.id_rol', $id_rol);
      $this->db->Order_by('cm.id_menu_referencia','asc');
      $this->db->Order_by('cm.id_menu', 'asc');
      $this->db->Order_by('cm.position_menu', 'asc');
    }

$query = $this->db->get();

if($query->num_rows() >= 1)
{
return $query->result();
}else{
return false;
}

}
}
?>
