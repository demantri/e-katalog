,<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Laporan</h4> &emsp; <small><b>Kartu Piutang</b></small>
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
								<a href="#">Laporan</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="#">Kartu Piutang Pegawai</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Kartu Piutang</h4>
								</div>
								<div class="card-body">

									<form method="GET">
										<div class="row">
											<div class="col-md-4">
												<label><b>Pegawai</b></label>
												<select class="form-control" name="com_id" required="">
													<option value="all">Lihat Semua</option>
													<?php foreach($com as $row){ ?>
															<option <?php if($this->input->get('com_id') == $row['karyawan_id']){ echo "selected='selected'"; } ?> value="<?php echo $row['karyawan_id'] ?>"><?php echo $row['kode_karyawan']." / ".$row['nama_karyawan'] ?></option>
													<?php } ?>
												</select>
											</div>

											<div class="col-md-2">
												<label><b>Bulan</b></label>
												<select class="form-control" name="bulan">
													<option value="all">Semua</option>
													<?php for ($i = 1 ; $i <= 12 ; $i++){ ?>
															<option <?php if($this->input->get('bulan') == $i){ echo "selected='selected'"; } ?> value="<?php echo $i ?>"><?php echo get_monthname($i) ?></option>
													<?php } ?>
												</select>
											</div>

											<div class="col-md-2">
												<label><b>Tahun</b></label>
												<select class="form-control" name="tahun" required="">
													<option value="">Pilih</option>
													<?php for ($i = 2019 ; $i <= date('Y') ; $i++){ ?>
															<option <?php if($this->input->get('tahun') == $i){ echo "selected='selected'"; } ?> value="<?php echo $i ?>"><?php echo $i ?></option>
													<?php } ?>
												</select>
											</div>

											<div class="col-md-1">
												<br>
												<button class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
											</div>
										</div>
									</form>

									<br>

									<?php if($this->input->get('com_id')){ ?>

											<div class="text-center">
												<hr>
												<h3>RA BAHRUL ILMI</h3>
												<h4>KARTU PIUTANG KARYAWAN</h4>

												<?php if($this->input->get('bulan') != 'all' && $this->input->get('tahun')){
													echo "<h6>Periode ";
												} ?>
												<h5>
												<?php 
													if($this->input->get('bulan') != 'all'){
														echo " Bulan ".get_monthname($this->input->get('bulan'));
													}

													if($this->input->get('tahun') != 'all'){
														echo " Tahun ".$this->input->get('tahun');
													}

												 ?>
												</h5>
												<hr>
											</div>

											<div class="table-responsive">
												<table class="table">
													<tr>
														<th style="background-color: #eee;width: 15%">Kode</th>
														<td><?php echo $detail['kode_karyawan'] ?></td>
													</tr>
													<tr>
														<th style="background-color: #eee">Nama</th>
														<td><?php echo $detail['nama_karyawan'] ?></td>
													</tr>
												</table>
											</div>

											<div class="table-responsive">
						                      <table class="table">
						                        <thead style="background-color:#eee">
						                          <tr>
						                          	<th>Tanggal</th>
						                          	<th>Kode Transaksi</th>
						                          	<th>Keterangan</th>
						                            <th>Debit</th>
						                            <th>Kredit</th>
						                          </tr>
						                        </thead>

						                        <tbody id="tableItem">
						                          <?php $n = $total_debit = $total_kredit = 0; 
						                                foreach ($list as $row){
						                          ?>

						                                  <tr>
						                                  	<td><?php echo date('Y-m-d',strtotime($row['tanggal_transaksi'])) ?></td>
						                                  	<td><?php echo $row['transaksi'] ?></td>
						                                  	<td><?php echo $row['ket'] ?></td>
						                                  	
						                                    <?php if($row['posisi'] == 'debit'){ $total_debit += $row['nominal'] ?>
						                                    		<td class="text-right"><?php echo format_rp($row['nominal']) ?></td>
						                                    		<td></td>
						                                    <?php }else{ $total_kredit += $row['nominal']; ?>
						                                    		<td></td>
						                                    		<td class="text-right"><?php echo format_rp($row['nominal']) ?></td>
						                                    <?php } ?>

						                                  </tr>

						                          <?php } ?>

						                        </tbody>

						                          <tr>
						                            <td colspan="2"><h4><b>TOTAL</b></h4></td>
						                            <td class="text-right"><h4><b id="grandTotal"><?php echo format_rp($total_debit) ?></b></h4></td>
						                            <td class="text-right"><h4><b id="grandTotal"><?php echo format_rp($total_kredit) ?></b></h4></td>
						                          </tr>

						                      </table>
						                    </div>

									<?php } ?>

								</div>
							</div>
						</div>


					</div>
				</div>

<script type="text/javascript">
    $(function() {
        $('.date-picker').datepicker({
          dateFormat : "yy-mm-dd"
        });
    });
</script>