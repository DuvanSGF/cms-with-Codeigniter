<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link href="<?= base_url()?>static/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url()?>static/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?= base_url()?>static/css/animate.css" rel="stylesheet">
    <link href="<?= base_url()?>static/css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/uploads/files/<?php echo $favicon_app; ?>" />
</head>
<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold"><?=$titulo_empresa;?></h2>

  <?=$titulo_descripcion;?>


            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                  <?php
                        $attributes = array('id' => 'login-form');
                        echo form_open('c_verificacionLogin', $attributes); //se define el formulario
                   ?>
                        <div class="form-group">
                            <input type="text" class="form-control" id="frm_user" name="frm_user" placeholder="Usuario" required="">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="frm_pwd" name="frm_pwd" placeholder="Password" required="">
                        </div>

                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                        <a href="#">
                            <small>olvide mi contraseña?</small>
                        </a>

                        <p class="text-muted text-center">
                            <small>No tengo una cuenta?</small>
                        </p>
                        <a class="btn btn-sm btn-white btn-block" href="register.html">Crear una cuenta</a>
                        <?
                                   if(validation_errors()){
                                   ?>
                                   <br/><div class="error-box round"><?php echo validation_errors(); ?></div>
                                   <?
                                   }
                                   ?>
                    </form>
                    <p class="m-t">
                        <small><?=$titulo_dev;?> </small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                <?=$titulo_derechos;?>
            </div>
            <div class="col-md-6 text-right">

            </div>
        </div>
    </div>

</body>

</html>
