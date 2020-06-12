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
								<h3>Form Tambah Barang</h3>
							</div>
							<div class="module-body">
 
									<form class="form-horizontal row-fluid">

										<div class="control-group">
											<label class="control-label" for="basicinput">ID Barang</label>
											<div class="controls">
												<input data-title="A tooltip for the input" type="text" placeholder="ID" data-original-title="" class="span8 tip">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Nama Barang</label>
											<div class="controls">
												<input data-title="A tooltip for the input" type="text" placeholder="Nama barang" data-original-title="" class="span8 tip">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Jenis Barang</label>
											<div class="controls">
												<select tabindex="1" data-placeholder="Pilih Jenis" class="span8">
													<option value="">Pilih Jenis</option>
													<option value="Category 1">First Row</option>
													<option value="Category 2">Second Row</option>
													<option value="Category 3">Third Row</option>
													<option value="Category 4">Fourth Row</option>
												</select>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Warna Barang</label>
											<div class="controls">
												<input data-title="A tooltip for the input" type="text" placeholder="Warna Barang" data-original-title="" class="span8 tip">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Stok Barang</label>
											<div class="controls">
												<input data-title="A tooltip for the input" type="text" placeholder="Stok Barang" data-original-title="" class="span8 tip">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="basicinput">Harga Barang</label>
											<div class="controls">
												<input data-title="A tooltip for the input" type="text" placeholder="Harga Barang" data-original-title="" class="span8 tip">
											</div>
										</div>

										<div class="control-group">
											<div class="controls pull-right">
												<!-- <button type="submit" class="btn btn-default">Kembali</button> -->
												<a href="<?php echo site_url('master/barang')?>" class="button btn btn-default">Kembali</a>
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