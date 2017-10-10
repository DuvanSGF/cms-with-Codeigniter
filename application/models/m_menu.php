<?php
Class m_menu extends CI_Model
{
  function menu_permisos($id_rol)
  {

     $this->db->select('*');
     $this->db->from('cms_permisos cp');
     $this->db->join('cms_menu cm', 'cm.id_menu = cp.id_menu');
     $this->db->where('cp.id_rol', $id_rol);
     $this->db->Order_by('cm.id_menu_referencia','asc');
     $this->db->Order_by('cm.id_menu', 'asc');
     $this->db->Order_by('cm.position_menu', 'asc');
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
