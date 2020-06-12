
<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Keuangan</h4> &emsp; <small><b>BOP Keluar</b></small>
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
								<a href="#">Keuangan</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="#">Dana BOP</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Dana BOP Keluar</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<div class="table-responsive">
										<table class="display table table-hover datatables" >
											<thead style="background-color: #eee">
												<tr>
													<th style="width: 5%">No</th>
													<th>Kode</th>
						                            <th>Tanggal Transaksi</th>
						                            <th>Total</th>
						                            <th>Keterangan</th>
						                            <th class="text-center"><i class="fa fa-cog"></i></th>
												</tr>
											</thead>
											<tbody>
												<?php $n = 0;
						                          foreach ($list as $row) { $n++; ?>

						                            <tr>
						                              <td><?php echo $n ?></td>
						                              <td><?php echo $row['kode_transaksi'] ?></td>
			                                          <td><?php echo $row['tanggal_transaksi'] ?></td>
			                                          <td><?php echo format_rp($row['total_transaksi']) ?></td>
			                                          <td><?php echo $row['keterangan'] ?></td>
			                                          <td class="text-center">
			                                          	<a data-toggle="tooltip" title="Lihat Penggunaan" href="<?php echo site_url('transaksi/keuangan/bop_out/detail/'.$row['id']) ?>" class="btn btn-primary btn-sm shadow"><i class="fa fa-search"></i></a>
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
				</div>

