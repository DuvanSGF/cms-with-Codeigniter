<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />

<?php
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />

<?php endforeach; ?>
<?php foreach($js_files as $file): ?>

    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<link href="<?= base_url()?>static/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url()?>static/font-awesome/css/font-awesome.css" rel="stylesheet">


<link href="<?= base_url()?>static/css/animate.css" rel="stylesheet">
<link href="<?= base_url()?>static/css/style.css" rel="stylesheet">

</head>
<body>
<!-- Beginning header -->
    <div>
        <a href='<?php echo site_url('examples/offices_management')?>'>Offices</a> |
        <a href='<?php echo site_url('examples/employees_management')?>'>Employees</a> |
        <a href='<?php echo site_url('examples/customers_management')?>'>Customers</a> |
        <a href='<?php echo site_url('examples/orders_management')?>'>Orders</a> |
        <a href='<?php echo site_url('examples/products_management')?>'>Products</a> |
        <a href='<?php echo site_url('examples/film_management')?>'>Films</a>

    </div>
<!-- End of header-->
    <div style='height:20px;'></div>
    <div>
<?php echo $output; ?>

    </div>
<!-- Beginning footer -->
<div>Footer</div>
<!-- End of Footer -->
</body>
<!-- Mainly scripts -->
<script src="<?= base_url()?>static/js/jquery-3.1.1.min.js"></script>
<script src="<?= base_url()?>static/js/bootstrap.min.js"></script>
<script src="<?= base_url()?>static/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?= base_url()?>static/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?= base_url()?>static/js/inspinia.js"></script>
<script src="<?= base_url()?>static/js/plugins/pace/pace.min.js"></script>
</html>
