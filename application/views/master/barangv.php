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
								<h3>Tabel Barang</h3>
							</div>

							<div class="module-body">
								<p>
									<!-- <button class="btn btn-default" href="<?php echo site_url('master/barang/view') ?>"><i class="menu-icon icon-plus"></i> Tambah</button> -->
									<a href="<?php echo site_url('master/barang/tambah')?>" class="button btn btn-default"><i class="menu-icon icon-plus"></i> Tambah</a>
								</p>
								<table class="table table-striped table-bordered table-condensed">
								  <thead>
									<tr>
									  <th>*</th>
									  <th>ID Barang</th>
									  <th>Jenis</th>
									  <th>Merk</th>
									  <th>Nama</th>
									  <th>Warna</th>
									  <th>Stok</th>
									  <th>Harga</th>
									  <th colspan="2" style="text-align: center;">Aksi</th>
									</tr>
									<?php $no = 1;?>
								  </thead>
								  <tbody>
									<?php foreach ($barang as $item ) { 
										?>
								  		<tr>
									  		<td><?php echo $no++?></td>
									  		<td><?php echo $item['id']?></td>
									  		<td><?php echo $item['jenis']?></td>
									  		<td><?php echo $item['merk']?></td>
									  		<td><?php echo $item['namabarang']?></td>
									  		<td><?php echo $item['warna']?></td>
									  		<td><?php echo $item['stok']?></td>
									  		<td><?php echo $item['harga']?></td>
									  		<td>
									  			<a href="">Edit</a>
									  		</td>
									  		<td>
									  			<a href="">Hapus</a>
									  		</td>
										</tr>
								  	<?php } ?>
								  </tbody>
								</table>
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

	<script src="<?php echo base_url() ?>assets2/scripts/jquery-1.9.1.min.js"></script>
	<script src="<?php echo base_url() ?>assets2/scripts/jquery-ui-1.10.1.custom.min.js"></script>
	<script src="<?php echo base_url() ?>assets2/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets2/scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>