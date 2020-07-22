<!DOCTYPE html>
<html lang="en">


<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edmin</title>
	<link type="text/css" href="<?php echo base_url() ?>assets2/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="<?php echo base_url() ?>assets2/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="<?php echo base_url() ?>assets2/css/theme.css" rel="stylesheet">
	<link type="text/css" href="<?php echo base_url() ?>assets2/images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>

	<?php
			          $this->load->view('layout/admin/navbar.php');
			        ?>



	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="span3">
					<?php
			          $this->load->view('layout/admin/sidebar.php');
			        ?>
				</div><!--/.span3-->


				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Form Merk</h3>
							</div>
							<div class="module-body">
 
									<form class="form-horizontal row-fluid" enctype="multipart/form-data"  method="POST" action="<?php echo site_url('master/upload_image/save')?>">

				                	<?php echo $this->session->flashdata('error_message') ?>

										<!-- <div class="control-group">
											<label class="control-label" for="basicinput">ID</label>
											<div class="controls">
												<input data-title="A tooltip for the input" type="text" placeholder="ID" data-original-title="" class="span8 tip" value="<?php echo $kode ?>" name="id" readonly>
											</div>
										</div> -->

										<div class="control-group">
											<label class="control-label" for="basicinput">Nama File</label>
											<div class="controls">
												<input name="nama_file" data-title="A tooltip for the input" type="file" placeholder="Nama file.." data-original-title="" class="span8 tip">
											</div>
											<div class="controls" style="color: red; font-size: 10px;">
													<?php echo form_error('nama_file')?>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Keterangan</label>
											<div class="controls">
												<input name="keterangan" data-title="A tooltip for the input" type="text" placeholder="Keterangan.." data-original-title="" class="span8 tip">
											</div>
											<div class="controls" style="color: red; font-size: 10px;">
													<?php echo form_error('keterangan')?>
											</div>
										</div>

										<div class="control-group">
											<div class="controls pull-right">
												<!-- <button type="submit" class="btn btn-default">Kembali</button> -->
												<a href="<?php echo site_url('master/merk')?>" class="button btn btn-default">Kembali</a>
												<button type="submit" class="btn btn-success">Simpan</button>
											</div>
										</div>
									</form>
							</div>
						</div>

						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

	<div class="footer">
		<div class="container">
			<b class="copyright">&copy; 2014 Edmin - EGrappler.com </b> All rights reserved.
		</div>
	</div>

	<script src="<?php echo base_url() ?>assets2/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets2/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets2/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets2/scripts/flot/jquery.flot.js" type="text/javascript"></script>
</body>