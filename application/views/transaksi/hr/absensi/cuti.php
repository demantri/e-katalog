<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Transaksi</h4> &emsp; <small><b>Absensi</b></small>
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
								<a href="#">HR</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="#">Absensi</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="#">Cuti</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Pengajuan Izin</h4>
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
												 Pengajuan
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#pills-profile-icon" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
												 Diterima
											</a>
										</li>

										<li class="nav-item">
											<a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#ditolak" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
												 Ditolak
											</a>
										</li>
									</ul>

									<div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
										<div class="tab-pane fade show active" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
											<div class="table-responsive">
												<table class="display table table-hover datatables" >
													<thead style="background-color: #eee">
														<thead>
						                                    <tr>
						                                      <th style="width:5%">No</th>
						                                      <th style="width:20%">Karyawan</th>
						                                      <th style="width:10%">Tipe</th>
						                                      <th class="text-center">Rentang Waktu</th>
						                                      <th style="width:27%">Keterangan</th>
						                                      <th style="width:15%" class="text-center"><i class="fa fa-cog"></i></th>
						                                    </tr>
													</thead>
													<tbody>
					                                    <?php 
					                                        $n = 0;
					                                        foreach ($pending as $row) { $n++; 

					                                          $date1 = new DateTime($row['tanggal_mulai']);
					                                          $date2 = new DateTime($row['tanggal_selesai']);
					                                          $interval = $date1->diff($date2);

					                                    ?>
					                                          <tr>
					                                            <td><?php echo $n; ?></td>
					                                             <td><?php echo $row['kode_karyawan']." / ".$row['nama_karyawan'] ?></td>
					                                            <td><?php echo $row['tipe'] ?></td>
					                                            <td class='text-center'><?php echo $row['tanggal_mulai']." s/d ".$row['tanggal_selesai'] ?> <br> ( <?php echo $interval->days + 1 ?> Hari )</td>
					                                            <td><?php echo $row['keterangan'] ?></td>
					                                            <td class="text-center">
					                                              <a onclick="return confirm('Apakah anda yakin menolak izin ini ?')" class='btn btn-danger btn-sm' href="<?php echo site_url('set_izin/deny/'.$row['id']) ?>" data-toggle="tooltip" title="Tolak"><span class='fa fa-ban'></span></a> &nbsp;
					                                              <a onclick="return confirm('Apakah anda yakin menyetujui izin ini ?')" class='btn btn-success btn-sm' href="<?php echo site_url('set_izin/approve/'.$row['id']) ?>" data-toggle="tooltip" title="Setujui"><span class='fa fa-check'></span></a>
					                                            </td>
					                                          </tr>
					                                    <?php } ?>
					                                  </tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane fade" id="pills-profile-icon" role="tabpanel" aria-labelledby="pills-profile-tab-icon">

											<div class="table-responsive">
												<table class="table">
				                                  <thead>
				                                    <thead>
					                                    <tr>
					                                      <th style="width:5%">No</th>
					                                      <th style="width:20%">Karyawan</th>
					                                      <th style="width:10%">Tipe</th>
					                                      <th class="text-center">Rentang Waktu</th>
					                                      <th style="width:27%">Keterangan</th>
					                                      <th style="width:15%" class="text-center"><i class="fa fa-cog"></i></th>
					                                    </tr>
				                                  </thead>
				                                  <tbody>
				                                    <?php 
				                                        $n = 0;
				                                        foreach ($approve as $row) { $n++; 
				                                          $date1 = new DateTime($row['tanggal_mulai']);
				                                          $date2 = new DateTime($row['tanggal_selesai']);
				                                          $interval = $date1->diff($date2);
				                                    ?>
				                                          <tr>
				                                            <td><?php echo $n; ?></td>
				                                             <td><?php echo $row['kode_karyawan']." / ".$row['nama_karyawan'] ?></td>
				                                            <td><?php echo $row['tipe'] ?></td>
				                                            <td class='text-center'><?php echo $row['tanggal_mulai']." s/d ".$row['tanggal_selesai'] ?> <br> ( <?php echo $interval->days + 1 ?> Hari )</td>
				                                            <td><?php echo $row['keterangan'] ?></td>
				                                            <td class="text-center">
				                                              <span class="badge badge-success bg-success"><i class="fa fa-check"></i> Diterima</span>
				                                               &nbsp;
				                                               <a class='btn btn-danger btn-xs' href="<?php echo site_url('set_izin/undo/'.$row['id']) ?>" data-toggle="tooltip" title="Batalkan"><span class='fa fa-ban'></span></a>
				                                            </td>
				                                          </tr>
				                                    <?php } ?>
				                                  </tbody>
				                                </table>
											</div>

										</div>

										<div class="tab-pane fade" id="ditolak" role="tabpanel" aria-labelledby="pills-profile-tab-icon">
											<table class="table">
			                                  <thead>
			                                    <tr>
			                                      <th style="width:5%">No</th>
			                                      <th style="width:20%">Karyawan</th>
			                                      <th style="width:10%">Tipe</th>
			                                      <th class="text-center">Rentang Waktu</th>
			                                      <th style="width:27%">Keterangan</th>
			                                      <th style="width:15%" class="text-center"><i class="fa fa-cog"></i></th>
			                                    </tr>
			                                  </thead>
			                                  <tbody>
			                                    <?php 
			                                        $n = 0;
			                                        foreach ($deny as $row) { $n++; 
			                                          $date1 = new DateTime($row['tanggal_mulai']);
			                                          $date2 = new DateTime($row['tanggal_selesai']);
			                                          $interval = $date1->diff($date2);
			                                    ?>
			                                          <tr>
			                                            <td><?php echo $n; ?></td>
			                                            <td><?php echo $row['kode_karyawan']." / ".$row['nama_karyawan'] ?></td>
			                                            <td><?php echo $row['tipe'] ?></td>
			                                            <td class='text-center'><?php echo $row['tanggal_mulai']." s/d ".$row['tanggal_selesai'] ?> <br> ( <?php echo $interval->days + 1 ?> Hari )</td>
			                                            <td><?php echo $row['keterangan'] ?></td>
			                                            <td class="text-center">
			                                              <span class="badge badge-danger bg-danger"><i class="fa fa-ban"></i> Ditolak</span>
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
