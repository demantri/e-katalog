<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.themekita.com/atlantis/livepreview/examples/demo1/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 30 Oct 2019 18:06:06 GMT -->
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>TK</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">


  <!-- CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/atlantis.css">

  <script src="<?php echo base_url() ?>assets/js/core/jquery.3.2.1.min.js"></script>

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/demo.css">

  <style type="text/css">
    .timeline_active{
      border:2px solid #31CE36 ; padding: 10px;border-radius: 10px;
    }
  </style>
</head>
<body onload="window.print()">
  <div class="wrapper">

					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header text-center">
									<h4 class="card-title">LAPORAN GAJI</h4>
									<h5>Bulan <?php echo get_monthname($bulan)." Tahun ".$tahun ?></h5>
								</div>
								<div class="card-body">

									<div class="panel panel-default">
										<br>
										<div class="panel-body">
											<table class="table">
												<tr>
													<th style="width: 20%; background-color: #eee" class="">BULAN</th>
													<td style="width: 20%;" class="text-center"><?php echo get_monthname($bulan) ?></td>
													<th style="width: 20%;background-color: #eee" class="">JUMLAH KARYAWAN</th>
													<td style="width: 20%" class="text-center" ><?php echo $gaji['total_karyawan'] ?></td>
												</tr>
												<tr>
													<th style="background-color: #eee">TAHUN</th>
													<td class="text-center"><?php echo $tahun ?></td>
													<th style="background-color: #eee">TOTAL</th>
													<td class="text-center" style="text-align: right">Rp. <?php echo number_format($gaji['total_gaji'],0,'','.') ?></td>
												</tr>
											</table>
										</div>
									</div>

									<br>

									<table class="table">
										<thead>
											<tr>
												<th style="width:5%;vertical-align: middle;" class="text-center" rowspan="2">NO</th>
												<th style="width:23%;vertical-align: middle;" rowspan="2">NAMA</th>
												<th colspan="2" class="text-center">KEHADIRAN</th>
												<th colspan="2" class="text-center">KOMPONEN GAJI</th>
											</tr>
											<tr>
												<th class="text-center">H</th>
												<th class="text-center">T</th>
												<th align="center"><center>Gaji</center></th>
												<!--th>Tunjangan Nikah</th-->
												<!--th>Tunjangan Anak</th-->
												<th>Lembur</th>
												<th align="center"><center>Total Gaji</center></th>
											</tr>
										</thead>
										<tbody>

										<?php $n=0; foreach ($gaji['list'] as $row) { $n++;?>
											<tr>
												<td><?php echo $n ?></td>
												<td class="text-center"><?php echo $row['kode_karyawan']." / ".$row['nama_karyawan'] ?></td>
												<td class="text-center"><?php echo $row['total_hadir'] ?></td>
												<td class="text-center"><?php echo $row['total_terlambat'] ?></td>
												<td style="text-align: right">Rp. <?php echo number_format($row['gaji_pokok'],0,'','.') ?></td>
												<td style="text-align: right">Rp. <?php echo number_format($row['tunjangan_lembur'],0,'','.') ?></td>
												<td style="text-align: right">Rp. <?php echo number_format($row['total_gaji'],0,'','.') ?></td>
											</tr>
										<?php } ?>
										</tbody>
									</table>

									<br><br><br><br>

								</div>
							</div>
						</div>


					</div>
				</div>
