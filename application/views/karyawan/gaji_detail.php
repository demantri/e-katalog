

<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Dashboard</h4> &emsp; <small><b></b></small>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="#">
									<i class="fa fa-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="#">Dashboard</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="<?php echo site_url('karyawan/gaji') ?>">Gaji</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="#">Detail Gaji</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Detail Gaji</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<a class="btn btn-outline-primary" href="<?php echo site_url('karyawan/gaji') ?>"><i class="fa fa-chevron-left"></i> KEMBALI</a>

									<br><br>

									<div class="panel panel-default">
										<br>
										<div class="panel-body">
											<table class="table">
												<tr>
													<th style="width: 20%;background-color: #eee" class="">BULAN</th>
													<td style="width: 20%" class="text-center"><?php echo get_monthname($gaji['bulan']) ?></td>
													<th style="width: 20%;background-color: #eee" class="">TOTAL</th>
													<td style="width: 20%" class="text-center" >Rp. <?php echo number_format($gaji['total_gaji'],0,'','.') ?></td>
													<td rowspan="2" style="vertical-align: middle" class="text-center">
														<!--<a href="#" class="btn btn-primary"><i class="icon-print"></i> Cetak</a>-->
													</td>
												</tr>
												<tr>
													<th style="background-color: #eee">TAHUN</th>
													<td class="text-center"><?php echo $gaji['tahun'] ?></td>
													<th style="background-color: #eee"></th>
													<td class="text-center" style="text-align: right"></td>
												</tr>
											</table>
										</div>
									</div>

									<br>

									<table class="table">
										<thead>
											<tr>
												<th colspan="2" class="text-center">KEHADIRAN</th>
												<th colspan="2" class="text-center">KOMPONEN GAJI</th>
												<th rowspan="2" class="text-center">TOTAL GAJI</th>
												<th rowspan="2" class="text-center"><i class="fa fa-cog"></i></th>
											</tr>
											<tr>
												<th class="text-center">H</th>
												<th class="text-center">T</th>
												<th align="center"><center>Gaji</center></th>
												<th>Lembur</th>
											</tr>
										</thead>
										<tbody>
										<?php $n=0; foreach ($list as $row) { $n++;?>
											<tr>
													<td class="text-center"><?php echo $row['total_hadir'] ?></td>
													<td class="text-center"><?php echo $row['total_terlambat'] ?></td>
													<td style="text-align: right">Rp. <?php echo number_format($row['gaji_pokok'],0,'','.') ?></td>
													<td style="text-align: right">Rp. <?php echo number_format($row['tunjangan_lembur'],0,'','.') ?></td>
													<td style="text-align: right">Rp. <?php echo number_format($row['total_gaji'],0,'','.') ?></td>
													<td class="text-center">
														<a class='text-info' target="_blank" href="<?php echo site_url('transaksi/hr/gaji/daftar/detail/'.$gaji['gaji_id'].'/cetak/'.$row['karyawan_id']) ?>" data-toggle="tooltip" title="Cetak Slip aji"><i class='fa fa-print'></i></a>
													</td>
												</tr>
										<?php } ?>
										</tbody>
									</table>

									

								</div>
							</div>
						</div>


					</div>
				</div>
