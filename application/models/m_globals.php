<?php
Class m_globals extends CI_Model
{
   var $conf_titulo;
   var $conf_descripcion;
   var $conf_bussines;
   var $conf_aplication;
   var $conf_dev;
   var $conf_email;
   var $conf_descripcionapp;
   var $conf_right;
   var $conf_icono;
   var $conf_favicon;

  function procesa_registro($tabla, $campo, $valor,$campo_retorna_1)
  {

     $this->db->select('*');
     $this->db->from($tabla);
     $this->db->where($campo, $valor);
     $this->db->limit(1);

     $query = $this->db->get();

     if($query->num_rows() == 1)
     {
       $result=$query->result();
       foreach($result as $row)
       {
         $aux_=$row->$campo_retorna_1;
       }
       return $aux_;
       //return $query->result();
     }else{
       return false;
     }

  }

  function get_seccion($tabla)
 {
   $this->db->select('*');
   $this->db->from('cms_menu');
   $this->db->where('tabla', $tabla);
   $this->db->limit(1);

   $query = $this->db->get();

   if($query->num_rows() == 1)
   {
       $result  =   $query->result();
//       print_r($result);
       foreach($result as $row){

         $this->conf_titulo        =   $row->name_menu;
         $this->conf_descripcion   =   $row->descripcion;

        }


//       return $query->result();
   }
   else
   {
     return false;
   }
 }

 function get_configuration()
{
  $this->db->select('*');
  $this->db->from('cms_configuracion');
  $this->db->limit(1);

  $query = $this->db->get();

  if($query->num_rows() == 1)
  {
      $result  =   $query->result();
      foreach($result as $row){

        $this->conf_bussines           =   $row->name_bussines;
        $this->conf_aplication         =   $row->name_aplication;
        $this->conf_dev                =   $row->dev_aplication;
        $this->conf_email              =   $row->email_aplication;
        $this->conf_descripcionapp     =   $row->descripcion_aplication;
        $this->conf_right              =   $row->right_aplication;
        $this->conf_icono              =   $row->icono_aplication;
        $this->conf_favicon            =   $row->favicon_aplication;
       }

  }
  else
  {
    return false;
  }
}

}


?>
