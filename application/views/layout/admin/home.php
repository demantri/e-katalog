<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edmin</title>
        <link type="text/css" href="<?php echo base_url() ?>assets2/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url() ?>assets2/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url() ?>assets2/css/theme.css" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url() ?>assets2/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>
    <body>
        <!-- navbar -->
        <?php
          $this->load->view('layout/admin/navbar.php');
        ?>
        <!-- /navbar -->

        <!-- isi -->
        <?php
          $this->load->view('layout/admin/container.php');
        ?>
        <!--/.wrapper-->

        <!-- footer -->
        <?php
          $this->load->view('layout/admin/footer.php');
        ?>
        <!-- footer -->

        <script src="<?php echo base_url() ?>assets2/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets2/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets2/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets2/scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets2/scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets2/scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets2/scripts/common.js" type="text/javascript"></script>
      
    </body>
