<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Pembayaran Pendidikan</h4> &emsp; <small><b>Pendaftaran</b></small>
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
								<a href="#">Pembayaran Pendidikan</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="#">Pendaftaran</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Pembayaran Pendaftaran</h4>
								</div>
								<div class="card-body">

									
									<form method="GET">
						                <div class="row">
						                    <div class="col-md-4">
						                      <input type="text" required="" name="komp" autocomplete="off" placeholder="Kode Pendaftaran..." class="form-control" value="<?php echo $this->input->get('komp') ?>">
						                    </div>
						                    <div class="col-md-1">
						                      <button class="btn btn-primary"><i class="fa fa-search"></i></button>
						                    </div>
						                </div>
						              </form>

						              <br>

						              <div class="row">
						                <div class="col-md-12">
						                  <?php echo $this->session->flashdata('alert_message') ?>
						                </div>
						              </div>

						              <br>

						              <?php if($this->input->get('komp')){ ?>

						                      <form method="POST" action="<?php echo site_url('insert_pembayaranPendaftaran') ?>">
						                        <input type="hidden" name="siswa_id" value="<?php echo $siswa['ak_siswa_id'] ?>">
						                          <div class="row">
						                            <div class="col-md-12">
						                              <div class="card">
						                                <div class="card-body">
						                                  <h6><b>DETAIL SISWA</b></h6>
						                                  <br>

						                                  <table class="table">
						                                    <tr>
						                                      <th style="width:20%; background-color: #eee;">Nama Siswa</th>
						                                      <td style="width:30%"><?php echo $siswa['nama_lengkap'] ?></td>
						                                      <th style="width:15%; background-color: #eee;">Jenis Kelamin</th>
						                                      <td><?php echo $siswa['jenis_kelamin'] ?></td>
						                                      
						                                    </tr>
						                                    <tr>
						                                      <th style="width:15%; background-color: #eee;">Tempat / Tanggal Lahir</th>
						                                      <td><?php echo $siswa['tempat_lahir']." / ".$siswa['tanggal_lahir'] ?></td>
						                                      <th style="width:15%; background-color: #eee;">Agama</th>
						                                      <td><?php echo $siswa['agama'] ?></td>
						                                    </tr>

						                                    <tr>
						                                      <th style="width:20%; background-color: #eee;">Alamat</th>
						                                      <td><?php echo $siswa['alamat'] ?></td>
						                                    </tr>
						                                  </table>
						                                </div>
						                              </div>
						                            </div>
						                          </div>

						                          <div class="row">
						                            <div class="col-md-4">
						                              <label>NIS</label>
						                              <input type="text" name="nis" required="" class="form-control" placeholder="NIS...">
						                            </div>
						                            <div class="col-md-3">
						                              <label>Kelas</label>
						                              <select class="form-control" name="kelas_id" required="">
						                                <option value="">Pilih</option>
						                                <?php foreach ($kelas as $row) { ?>
						                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['nama_kelas'] ?></option>
						                                <?php } ?>
						                              </select>
						                            </div>
						                          </div>

						                          <br>

						                          <div class="row">
						                            <div class="col-md-12">
						                              <table class="table">
						                                <tr class="bg-primary">
						                                  <th colspan="7"><b>Pendaftaran</b></th>
						                                </tr>

						                                <tr>
						                                  <th>Kode</th>
						                                  <th>Biaya</th>
						                                  <th class="text-center">Total Biaya</th>
						                                  <th style="width: 20%" class="text-center">Cicil</th>
						                                  <th class="text-center">Bayar</th>
						                                </tr>

						                                <?php 
						                                      $n = 0;
						                                      foreach ($pembayaran as $row) { $final = $row['nominal']; $n++; ?>
						                                        <tr>
						                                          <td><?php echo $row['kode_komponen'] ?></td>
						                                          <td><?php echo $row['nama_komponen'] ?></td>
						                                          <td class="text-right"><?php echo format_rp($row['nominal']) ?></td>


						                                          <?php if($row['cicilan'] == '1'){ ?>
						                                                  <td>
						                                                    <input type="text" name="cicil[]" class="form-control rupiah" placeholder="(Rp. )">
						                                                  </td>


						                                          <?php }else{ ?>
						                                                  <td class="text-center text-danger"><i class="fa fa-minus-circle"></i></td>
						                                          <?php } ?>

						                                          <td class="text-center">
						                                            <div class="custom-control custom-checkbox">
						                                              <input type="hidden" name="ta_komponen_id" value="<?php echo $row['ta_komponen_id'] ?>">
						                                              <input name="bayar[]" type="checkbox" class="custom-control-input" value="1" id="customCheck<?php echo $n ?>">
						                                              <label class="custom-control-label" for="customCheck<?php echo $n ?>"></label>
						                                            </div>
						                                          </td>
						                                        </tr>
						                                <?php } ?>
						                              </table>
						                            </div>
						                          </div>

						                          <br>

						                          <div class="row">
						                            <div class="col-md-12">
						                              <button class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
						                            </div>
						                          </div>

						                    </form>
						              <?php } ?>


								</div>
							</div>
						</div>


					</div>
				</div>
