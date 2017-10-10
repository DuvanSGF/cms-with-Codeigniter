<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administracion</title>

<?php
if ($pintacrud <> "no") {

foreach($css_files as $file): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />

<?php endforeach; ?>
<?php foreach($js_files as $file): ?>

        <script src="<?php echo $file; ?>"></script>
<?php endforeach;
}else { ?>
<script src="<?= base_url()?>static/js/jquery-3.1.1.min.js"></script>
<?php
}

?>


      <link href="<?= base_url()?>static/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?= base_url()?>static/font-awesome/css/font-awesome.css" rel="stylesheet">


      <link href="<?= base_url()?>static/css/animate.css" rel="stylesheet">
      <link href="<?= base_url()?>static/css/style.css" rel="stylesheet">

      <link rel="icon" type="image/png" href="<?php echo base_url()?>assets/uploads/files/<?php echo $favicon_app; ?>" />
</head>
<body>

    <div id="wrapper">


    <?php


     $this->load->view("base/v_menuizquierdo");
           $this->load->view("base/v_menutop");
           if ($pintacrud <> "no") {
             echo '<h1>'.$titulo_pagina.'</h1>';
             echo '<p>'.$titulo_descripcion.'</p>';
             echo $output;
           }else {
             if(isset($content)){
               $this->load->view("base/".$content);

             }else{
                $this->load->view("base/v_content");
             }
           }
           $this->load->view("base/v_footer");
        ?>


        <!-- Mainly scripts -->
        <!--<script src="<?= base_url()?>static/js/jquery-3.1.1.min.js"></script>-->
        <script src="<?= base_url()?>static/js/bootstrap.min.js"></script>
        <script src="<?= base_url()?>static/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?= base_url()?>static/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="<?= base_url()?>static/js/inspinia.js"></script>
        <script src="<?= base_url()?>static/js/plugins/pace/pace.min.js"></script>

        <div style='height:20px;'></div>
        <div>
    <?php

     ?>

        </div>
    </div><!--      wrapper-->
    </div>
</body>

</html>
