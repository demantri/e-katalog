<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Keuangan</h4> &emsp; <small><b>Pendanaan</b></small>
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
								<a href="#">Pendanaan</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Pendanaan</h4>
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
						                            <th class="text-center">Pembayaran</th>
						                            <th class="text-center">Status</th>
													<th class="text-center"><i class="fa fa-cog"></i></th>
												</tr>
											</thead>
											<tbody>
												<?php $n = 0;
						                          foreach ($req as $row) { $n++; ?>

						                            <tr>
						                              <td><?php echo $n ?></td>
						                              <td><?php echo $row['kode_transaksi'] ?></td>
			                                          <td><?php echo $row['tanggal_transaksi'] ?></td>
			                                          <td><?php echo format_rp($row['total_transaksi']) ?></td>
			                                          <td class="text-center">
			                                          	<?php echo $row['pembayaran'] ?>
			                                          </td>

			                                          <td class="text-center">
			                                          	<?php if($row['level'] == '1'){ ?>

			                                          			<span class="badge badge-primary"><i class="fa fa-clock"></i> Menunggu Acc </span>

			                                          	<?php }else if($row['level'] != '1'){ ?>

			                                          			<span class="text-success"><i class="fa fa-check-circle"></i> Disetujui </span>

			                                          	<?php }else if($row['is_deny'] == '1'){ ?>

			                                          			<span class="text-danger"><i class="fa fa-ban"></i> Ditolak </span>

			                                          	<?php } ?>
			                                          </td>

						                              <td class="text-center">
						                                  
						                                  <a href="<?php echo site_url('transaksi/review/cashflow/detail/'.$row['id']) ?>" data-toggle="tooltip" title="Lihat Detail" class="btn btn-primary shadow btn-sm">
						                                    <i class="fa fa-search"></i> Review
						                                  </a>
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
