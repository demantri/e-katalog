<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Master Data</h4> &emsp; <small><b>Siswa</b></small>
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
								<a href="#">Akademik</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="#">Siswa</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Siswa</h4>
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
													<img style="width: 25px" src="<?php echo base_url('assets/img/icon/megaphone.png') ?>"> Tetap
												</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#pills-profile-icon" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
													<img style="width: 25px" src="<?php echo base_url('assets/img/icon/list.png') ?>"> Calon
												</a>
											</li>

											<li class="nav-item">
												<a class="nav-link" id="pills-profile-tab-icons" data-toggle="pill" href="#pills-profile-icons" role="tab" aria-controls="pills-profile-icons" aria-selected="false">
													<img style="width: 25px" src="<?php echo base_url('assets/img/icon/list.png') ?>"> Undur Diri
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
																<th>Tahun Ajaran</th>
																<th>NIS</th>
									                            <th>Nama Lengkap</th>
									                            <th>Jenis Kelamin</th>
									                            <th>Alamat</th>
																<th class="text-center"><i class="fa fa-cog"></i></th>
															</tr>
														</thead>
														<tbody>
															<?php $n = 0;
									                          foreach ($tetap as $row) { $n++; ?>

									                            <tr>
									                              <td><?php echo $n ?></td>
									                              <td><?php echo $row['nama_ta'] ?></td>
									                              <td><?php echo $row['nis'] ?></td>
						                                          <td><?php echo $row['nama_lengkap'] ?></td>
						                                          <td><?php echo $row['jenis_kelamin'] ?></td>
						                                          <td><?php echo $row['alamat'] ?></td>

									                              <td class="text-center">
									                                  
									                                  <a href="<?php echo site_url('master_data/akademik/siswa/detail/'.$row['ak_siswa_id']) ?>" data-toggle="tooltip" title="Lihat Detail" class="btn btn-primary btn-sm shadow">
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
																<th>Tahun Ajaran</th>
																<th>Kode Pendaftaran</th>
									                            <th>Nama Lengkap</th>
									                            <th>Jenis Kelamin</th>
									                            <th>Status</th>
																<th class="text-center"><i class="fa fa-cog"></i></th>
															</tr>
														</thead>
														<tbody>
															<?php $n = 0;
									                          foreach ($calon as $row) { $n++; ?>

									                            <tr>
									                              <td><?php echo $n ?></td>
									                              <td><?php echo $row['nama_ta'] ?></td>
									                              <td><?php echo $row['kode_pendaftaran'] ?></td>
						                                          <td><?php echo $row['nama_lengkap'] ?></td>
						                                          <td><?php echo $row['jenis_kelamin'] ?></td>
						                                          <td>
						                                          	<?php if($row['is_undur'] == '0'){ ?>
						                                          			<span class="badge badge-primary"><i class="fa fa-clock"></i> Menunggu Pembayaran</span>
						                                          	
						                                          	<?php }else{ ?>
						                                          			<span class="badge badge-danger"><i class="fa fa-ban"></i> Undur Diri</span>
						                                          	<?php } ?>
						                                          </td>

									                              <td class="text-center">
									                                  
									                                  <a href="<?php echo site_url('master_data/akademik/siswa/detail/'.$row['ak_siswa_id']) ?>" data-toggle="tooltip" title="Lihat Detail" class="btn btn-primary btn-sm shadow">
									                                    <i class="fa fa-search"></i>
									                                  </a>
									                              </td>
									                            </tr>

									                    <?php } ?>
														</tbody>
													</table>
												</div>

											</div>



											<div class="tab-pane fade" id="pills-profile-icons" role="tabpanel" aria-labelledby="pills-profile-tab-icons">

												<div class="table-responsive">
													<table class="display table table-hover datatables" >
														<thead style="background-color: #eee">
															<tr>
																<th style="width: 5%">No</th>
																<th>Tahun Ajaran</th>
																<th>Nis</th>
									                            <th>Nama Lengkap</th>
									                            <th>Jenis Kelamin</th>
									                            <th>Status</th>
																<th class="text-center"><i class="fa fa-cog"></i></th>
															</tr>
														</thead>
														<tbody>
															<?php $n = 0;
									                          foreach ($undur as $row) { $n++; ?>

									                            <tr>
									                              <td><?php echo $n ?></td>
									                              <td><?php echo $row['nama_ta'] ?></td>
									                              <td><?php echo $row['nis'] ?></td>
						                                          <td><?php echo $row['nama_lengkap'] ?></td>
						                                          <td><?php echo $row['jenis_kelamin'] ?></td>
						                                          <td>
						                                          	<?php if($row['is_undur'] == '0'){ ?>
						                                          			<span class="badge badge-primary"><i class="fa fa-clock"></i> Menunggu Pembayaran</span>
						                                          	
						                                          	<?php }else{ ?>
						                                          			<span class="badge badge-danger"><i class="fa fa-ban"></i> Undur Diri</span>
						                                          	<?php } ?>
						                                          </td>

									                              <td class="text-center">
									                                  
									                                  <a href="<?php echo site_url('master_data/akademik/siswa/detail/'.$row['ak_siswa_id']) ?>" data-toggle="tooltip" title="Lihat Detail" class="btn btn-primary btn-sm shadow">
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
				</div>

