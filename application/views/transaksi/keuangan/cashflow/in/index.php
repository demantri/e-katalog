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
									<h4 class="card-title">Daftar Pendanaan Masuk</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<ul class="nav nav-pills nav-secondary  nav-pills-no-bd nav-pills-icons" id="pills-tab-with-icon" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="pills-home-tab-icon" data-toggle="pill" href="#pills-home-icon" role="tab" aria-controls="pills-home-icon" aria-selected="true">
												<img style="width: 25px" src="<?php echo base_url('assets/img/icon/megaphone.png') ?>"> Request
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#pills-profile-icon" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
												<img style="width: 25px" src="<?php echo base_url('assets/img/icon/list.png') ?>"> Daftar Pemasukan
											</a>
										</li>
									</ul>

									<div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
										<div class="tab-pane fade show active" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
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

					                                          <td class="text-center"><?php echo show_level($row['level']) ?></td>

								                              <td class="text-center">
								                                  
								                                  <a href="<?php echo site_url('transaksi/keuangan/cash_in/detail/'.$row['id']) ?>" data-toggle="tooltip" title="Lihat Detail" class="btn btn-primary btn-sm shadow">
								                                    <i class="fa fa-search"></i>
								                                  </a>
								                              </td>
								                            </tr>

								                    <?php } ?>
													</tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane fade" id="pills-profile-icon" role="tabpanel" aria-labelledby="pills-profile-tab-icon">

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
								                          foreach ($list as $row) { $n++; ?>

								                            <tr>
								                              <td><?php echo $n ?></td>
								                              <td><?php echo $row['kode_transaksi'] ?></td>
					                                          <td><?php echo $row['tanggal_transaksi'] ?></td>
					                                          <td><?php echo format_rp($row['total_transaksi']) ?></td>
					                                          <td class="text-center">
					                                          	<?php echo $row['pembayaran'] ?>
					                                          </td>

					                                          <td class="text-center"><?php echo show_level($row['level']) ?></td>

								                              <td class="text-center">
								                                  
								                                  <a href="<?php echo site_url('transaksi/asset/perolehan/detail/'.$row['id']) ?>" data-toggle="tooltip" title="Lihat Detail" class="btn btn-primary btn-sm shadow">
								                                    <i class="fa fa-search"></i>
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


					</div>
				</div>
