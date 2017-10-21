<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro</title>

    <!-- Mainly scripts -->
    <script src="<?= base_url()?>static/js/jquery-3.1.1.min.js"></script>
    <script src="<?= base_url()?>static/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?= base_url()?>static/js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>

    <link href="<?= base_url()?>static/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url()?>static/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?= base_url()?>static/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?= base_url()?>static/css/animate.css" rel="stylesheet">
    <link href="<?= base_url()?>static/css/style.css" rel="stylesheet">

</head>
<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">IN+</h1>

            </div>
            <h3>Register to IN+</h3>
            <p>Create account to see it in action.</p>


              <?php
                    $attributes = array('id' => 'login-form');
                    echo form_open('C_verificacionRegister', $attributes); //se define el formulario
               ?>
                <div class="form-group">
                    <input type="text" class="form-control" id="name_user" name="name_user" placeholder="Usuario" required="">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control"id="email_user" name="email_user" placeholder="Email" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password_user" name="password_user"placeholder="Password" required="">
                </div>
                <div class="form-group">
                        <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
                </div>
                <button class="btn btn-primary block full-width m-b" name="register">Register</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="<?php echo base_url()?>C_login">Login</a>
                      <?php  echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>
  </body>

  </html>
