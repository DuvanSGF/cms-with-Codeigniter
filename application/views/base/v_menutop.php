<div id="page-wrapper" class="gray-bg">
<div class="row border-bottom">
    <nav class="navbar navbar-static-top  white-bg" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

    </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">Bienvenido <?php echo $user_name; ?></span>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li>
                        <div class="dropdown-messages-box">
                            <a href="profile.html" class="pull-left">
                                <span class="icon">
                                    <i class="fa fa-truck"></i>
                                </span>
                            </a>
                            <div class="media-body">
                                <small class="pull-right">Hace 3 min</small>
                                <strong>Vehiculo VNN 0001</strong> <br>El vehiculo lleva mas de 6 horas en carretera, confirmar con conductor<br>

                            </div>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="dropdown-messages-box">
                            <a href="profile.html" class="pull-left">
                                <span class="icon">
                                    <i class="fa fa-usd"></i>
                                </span>
                            </a>
                            <div class="media-body">
                                <small class="pull-right">Hace 3 min</small>
                                <strong>Orden de Pedido 0001</strong> <br>Orden de pedido le faltan 24 horas para entrega, llamar para confirmar<br>

                            </div>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="dropdown-messages-box">
                            <a href="profile.html" class="pull-left">
                                <span class="icon">
                                    <i class="fa fa-truck"></i>
                                </span>
                            </a>
                            <div class="media-body">
                                <small class="pull-right">Hace 3 min</small>
                                <strong>Vehiculo VNN 0001</strong> <br>El vehiculo lleva mas de 6 horas en carretera, confirmar con conductor<br>

                            </div>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="text-center link-block">
                            <a href="mailbox.html">
                                <i class="fa fa-envelope"></i> <strong>Leer todos los mensajes</strong>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>



            <li>
              <a href="<?php echo base_url(); ?>C_home/logout">
                    <i class="fa fa-sign-out"></i> Salir
                </a>
            </li>
        </ul>

    </nav>
    </div><!--fin row border-bottom-->
