<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">

        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">




                <div class="dropdown profile-element">

      <h3><a href="index.html" class="site_title"><i class="<?=$titulo_icono;?>"></i> <span><?=$titulo_nombreapp;?></span></a></h3>

      <span><img alt="image" class="img-circle" src="<?=base_url();?>assets/uploads/files/<?=$user_photo;?>" width="48" height="48" /></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?=$user_name?></strong>
                        </span> <span class="text-muted text-xs block"><?=$user_rol_name ?><b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#">Perfil</a></li>
<?php
  if ($user_rol == 1){
    echo '    <li><a href="'.base_url().'c_home/cms_tabla/cms_user">Usuarios</a></li>
              <li><a href="'.base_url().'c_home/cms_tabla/cms_rol">roles</a></li>
              <li><a href="'.base_url().'c_home/cms_tabla/cms_permisos">permisos</a></li>
              <li><a href="'.base_url().'c_home/cms_tabla/cms_menu">menus</a></li>
              <li><a href="'.base_url().'c_home/cms_tabla/cms_configuracion">configuracion</a></li>';
  }
 ?>
                        <li class="divider"></li>
                        <li><a href="<?=base_url()?>C_home/logout">Salir</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    <span class="fa fa-paw"></span>
                </div>
            </li>
<li><a href="<?=base_url();?>C_home"><i class="fa fa-home"></i> <span class="nav-label">Inicio</span></a></li>

<?php
$aux_menu = $array_menu["opc_menu"];
$aux_submenu = 0;
if ($aux_menu){

  foreach ($aux_menu as $menu_key) {
    if ($menu_key->id_menu_referencia == $menu_key->id_menu) {
      if($aux_submenu == 1){
          echo '</ul>
                </li>';
          $aux_submenu = 0;
      } //fin submenu

      if($menu_key->url_menu <> null){
        echo '<li><a href="'.base_url().$menu_key->url_menu.'"><i class="'.$menu_key->icono_menu.'"></i> <span class="nav-label">'.$menu_key->name_menu.'</span></a></li>';
      }else{
        echo '<li><a><i class="'.$menu_key->icono_menu.'"></i> <span class="nav-label">'.$menu_key->name_menu.'</span> <span class="fa arrow"></span></a>
              <ul class="nav nav-second-level collapse" >';
        $aux_submenu = 1;
      } //fin Url menu.
    }else{
      echo '<li><a href="'.base_url().$menu_key->url_menu.'">'.$menu_key->name_menu.'</a></li>';
    } //fin si existe menu.
  } //fin foreach
}//menu por defecto. si noy hay permisos.
?>

  </ul>

    </div>
</nav>
<script type="text/javascript">
$(function() {
  $('nav a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');
});
</script>
