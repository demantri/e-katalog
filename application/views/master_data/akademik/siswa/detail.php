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
								<a href="<?php echo site_url('master_data/akademik/siswa') ?>">Siswa</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="#">Detail</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Detail Siswa</h4>
								</div>
								<div class="card-body">

									<div class="row">
	                					<div class="col-md-12">
							              <?php echo $this->session->flashdata('alert_message') ?>
							            </div>
							         </div>

							         <div class="row">
										<div class="col-md-12">
											<a href="<?php echo site_url('master_data/akademik/siswa') ?>" class="btn btn-primary btn-border btn-flat pull-left"><i class="fa fa-chevron-left"></i> KEMBALI</a>
										</div>
              						</div>

								        <!--<ul class="nav nav-pills nav-secondary  nav-pills-no-bd nav-pills-icons" id="pills-tab-with-icon" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" id="pills-home-tab-icon" data-toggle="pill" href="#pills-home-icon" role="tab" aria-controls="pills-home-icon" aria-selected="true">
													<img style="width: 25px" src="<?php echo base_url('assets/img/icon/megaphone.png') ?>"> Informasi Siswa
												</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#pills-profile-icon" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
													<img style="width: 25px" src="<?php echo base_url('assets/img/icon/list.png') ?>"> Calon
												</a>
											</li>
										</ul>-->

										<div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
											<div class="tab-pane fade show active" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">

												<div class="row">
													<div class="col-md-12">
														<div class="card">
															<div class="card-header">Informasi Siswa</div>
															<div class="card-body">
																<table class="table">
																	<tr>
							                                          <th>NIS</th>
							                                          <td id="o_nama_lengkap"><?php echo $siswa['nis'] ?></td>
							                                          <th>Kode Pendaftaran</th>
							                                          <td id="o_agama"><?php echo $siswa['kode_pendaftaran'] ?></td>
							                                        </tr>

							                                        <tr>
							                                          <th>Nama Lengkap</th>
							                                          <td id="o_nama_lengkap"><?php echo $siswa['nama_lengkap'] ?></td>
							                                          <th>Agama</th>
							                                          <td id="o_agama"><?php echo $siswa['agama'] ?></td>
							                                        </tr>

							                                        <tr>
							                                          <th>Tempat / Tanggal Lahir</th>
							                                          <td id="o_ttl"><?php echo $siswa['tempat_lahir']." / ".$siswa['tanggal_lahir'] ?></td>
							                                          <th>Anak Ke</th>
							                                          <td id="o_anak_ke"><?php echo $siswa['anak_ke'] ?></td>
							                                        </tr>

							                                        <tr>
							                                          <th>Jenis Kelamin</th>
							                                          <td id="o_jk"><?php echo $siswa['jenis_kelamin'] ?></td>
							                                          <th>Jumlah Saudara</th>
							                                          <td id="o_jumlah_saudara"><?php echo $siswa['jumlah_saudara'] ?></td>
							                                        </tr>

							                                        <tr>
							                                          <th>Alamat</th>
							                                          <td id="o_alamat"><?php echo $siswa['alamat'] ?></td>
							                                          <th>Pendaftaran</th>
							                                          <td id="o_agama">
							                                          	<?php if($siswa['is_undur'] == '1'){
							                                          		echo "<span class='badge badge-danger'>Undur Diri</span>";
							                                          	}else{
							                                          		if($siswa['level'] == '0'){
							                                          			echo "<span class='badge badge-primary'><i class='fa fa-clock'></i> Menunggu Pembayaran</span>";
							                                          		
							                                          		}else{
							                                          			echo "<span class='badge badge-success'><i class='fa fa-clock'></i> Selesai</span>";
							                                          		}
							                                          		
							                                          	} ?>
							                                          </td>
							                                        </tr>

							                                        <tr>
							                                          <th>Status</th>
							                                          <td id="o_nama_lengkap">
							                                          	<?php if($siswa['level'] == '1'){
							                                          		echo "<span class='badge badge-success'>Tetap</span>";
							                                          	}else{
							                                          		echo "<span class='badge badge-primary'>Calon</span>";
							                                          	} ?>
							                                          </td>
							                                          <th colspan="2">
							                                          	<?php if($siswa['level'] == '0'){ ?>

							                                          		<?php if($siswa['is_undur'] == '0'){ ?>

								                                          			<a onclick="return confirm('Apakah anda yakin ?')" class="btn btn-danger btn-block" href="<?php echo site_url('undur_diri_siswa/'.$siswa['ak_siswa_id']) ?>"><i class="fa fa-ban"></i> UNDUR DIRI</a>

								                                          	<?php }else{ ?>

								                                          			<span class="badge badge-danger"><i></i> <i class="fa fa-ban"></i> Telah Mengundurkan Diri</span>

								                                          	<?php } ?>

							                                          	<?php }  ?>
							                                          	
							                                          </th>
							                                        </tr>

							                                      </table>

															</div>
														</div>	
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<div class="card">
															<div class="card-header">Orang Tua</div>
															<div class="card-body">
																<div class="row">
								                                  <div class="col-md-6">
								                                    <h6><b>Data Ayah</b></h6>
								                                      <br>
								                                      <table class="table">
								                                        <tr>
								                                          <th>Nama Lengkap</th>
								                                          <td id="o_bpk_nama_lengkap"><?php echo $siswa['ot_bpk_nama_lengkap'] ?></td>
								                                        </tr>

								                                        <tr>
								                                          <th>Tempat / Tanggal Lahir</th>
								                                          <td id="o_bpk_ttl"><?php echo $siswa['ot_bpk_tempat_lahir']." / ".$siswa['ot_bpk_tanggal_lahir'] ?></td>
								                                        </tr>

								                                        <tr>
								                                          <th>No Telepon</th>
								                                          <td id="o_bpk_no_telp"><?php echo $siswa['ot_bpk_no_telp'] ?></td>
								                                        </tr>

								                                        <tr>
								                                          <th>Agama</th>
								                                          <td id="o_bpk_agama"><?php echo $siswa['ot_bpk_agama'] ?></td>
								                                        </tr>

								                                        <tr>
								                                          <th>Pendidikan</th>
								                                          <td id="o_bpk_pendidikan"><?php echo $siswa['ot_bpk_pendidikan'] ?></td>
								                                        </tr>

								                                        <tr>
								                                          
								                                          <th>Pekerjaan</th>
								                                          <td id="o_bpk_pekerjaan"><?php echo $siswa['ot_bpk_pekerjaan'] ?></td>
								                                        </tr>
								                                      </table>
								                                  </div>

								                                  <div class="col-md-6">
								                                    <h6><b>Data Ibu</b></h6>
								                                      <br>
								                                      <table class="table">
								                                        <tr>
								                                          <th>Nama Lengkap</th>
								                                          <td id="o_ib_nama_lengkap"><?php echo $siswa['ot_ib_nama_lengkap'] ?></td>
								                                        </tr>

								                                        <tr>
								                                          <th>Tempat / Tanggal Lahir</th>
								                                          <td id="o_ib_ttl"><?php echo $siswa['ot_ib_tempat_lahir']." / ".$siswa['ot_ib_tanggal_lahir'] ?></td>
								                                        </tr>

								                                        <tr>
								                                          <th>No Telepon</th>
								                                          <td id="o_ib_no_telp"><?php echo $siswa['ot_ib_no_telp'] ?></td>
								                                        </tr>

								                                        <tr>
								                                          <th>Agama</th>
								                                          <td id="o_ib_agama"><?php echo $siswa['ot_ib_agama'] ?></td>
								                                        </tr>

								                                        <tr>
								                                          <th>Pendidikan</th>
								                                          <td id="o_ib_pendidikan"><?php echo $siswa['ot_ib_pendidikan'] ?></td>
								                                        </tr>

								                                        <tr>
								                                          
								                                          <th>Pekerjaan</th>
								                                          <td id="o_ib_pekerjaan"><?php echo $siswa['ot_ib_pekerjaan'] ?></td>
								                                        </tr>
								                                      </table>
								                                  </div>

								                                  
								                                  </div>
															</div>
														</div>
													</div>
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
									                                  
									                                  <a href="<?php echo site_url('master_data/akademik/siswa/detail/'.$row['id']) ?>" data-toggle="tooltip" title="Lihat Detail" class="btn btn-primary btn-sm shadow">
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

