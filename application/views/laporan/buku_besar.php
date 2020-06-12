<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Laporan</h4> &emsp; <small><b>Buku Besar</b></small>
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
								<a href="#">Buku Besar</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Buku Besar</h4>
								</div>
								<div class="card-body">

									<form method="GET">
										<div class="row">
											<div class="col-md-3">
												<label><b>Akun</b></label>
												<select class="form-control" name="coa_id" required="">
													<?php foreach ($akun as $row) { ?>
															<option <?php if($row['id'] == $this->input->get('coa_id')){ echo "selected='selected'"; } ?> value="<?php echo $row['id'] ?>"><?php echo $row['kode_coa']." - ".$row['nama_coa'] ?></option>
													<?php } ?>
												</select>
											</div>

											<div class="col-md-2">
												<label><b>Bulan</b></label>
												<select class="form-control" name="bulan" required="">
													<option value="">Pilih</option>
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

									<div class="table-responsive">
				                      <table class="table">
				                        <thead style="background-color:#eee">
				                          <tr>
				                          	<th rowspan="2">Tanggal</th>
				                            <th rowspan="2" style="width: 25%">Akun</th>
				                            <th rowspan="2" style="width: 5%">Ref</th>
				                            <th rowspan="2">Debit</th>
				                            <th rowspan="2">Kredit</th>
				                            <th colspan="2" class="text-center">Saldo</th>
				                          </tr>

				                          <tr>
				                          	<th>Debit</th>
				                          	<th>Kredit</th>
				                          </tr>
				                        </thead>

				                        <tbody id="tableItem">
				                          <?php $n = $total_debit = $total_kredit = $saldo = 0; 
				                                foreach ($jurnal as $row) { 
				                                	if($row['posisi'] == 'd'){
				                                		$saldo += $row['nominal'];
				                                		$title = $row['nama_coa'];
				                                		$total_debit += $row['nominal'];

				                                	}else{
				                                		$saldo -= $row['nominal'];
				                                		$title = '&emsp;&emsp;&emsp;'.$row['nama_coa'];
				                                		$total_kredit += $row['nominal'];
				                                	}
				                          ?>

				                                  <tr>
				                                  	<td>
				                                  		<?php echo date('Y-m-d',strtotime($row['waktu_jurnal'])) ?><br>
				                                  		<small>
				                                  			<?php echo $row['kode_transaksi'] ?>
				                                  		</small>
				                                  	</td>
				                                    <td><?php echo $title ?></td>
				                                    <td><?php echo $row['kode_coa'] ?></td>

				                                    <?php if($row['posisi'] == 'd'){ ?>
				                                    		<td class="text-right"><?php echo format_rp($row['nominal']) ?></td>
				                                    		<td></td>
				                                    <?php }else{ ?>
				                                    		<td></td>
				                                    		<td class="text-right"><?php echo str_replace('-', '', format_rp($row['nominal']))?></td>
				                                    <?php } ?>

				                                    <?php if($saldo > 0){ ?>
						                            		<td class="text-right"><h4><b id="grandTotal"><?php echo format_rp($saldo) ?></b></h4></td>
						                            		<td class="text-right"><h4><b id="grandTotal"></td>


						                            <?php }else{ ?>

						                            		<td class="text-right"><h4><b id="grandTotal"></td>
						                            		<td class="text-right"><?php echo str_replace('-', '', format_rp($row['nominal']))?></td>

						                            <?php } ?>

				                                  </tr>

				                          <?php } ?>

				                        </tbody>

				                          <tr>
				                            <td colspan="5"><h4><b>SALDO AKHIR</b></h4></td>
				                            <?php if($saldo > 0){ ?>
				                            		<td class="text-right"><h4><b id="grandTotal"><?php echo format_rp($saldo) ?></b></h4></td>
				                            		<td class="text-right"><h4><b id="grandTotal"></td>


				                            <?php }else{ ?>

				                            		<td class="text-right"><h4><b id="grandTotal"></td>
				                            		<td class="text-right"><h4><b id="grandTotal"><?php echo str_replace('-', '', format_rp($saldo))?></b></h4></td>

				                            <?php } ?>
				                            
				                          </tr>

				                      </table>
				                    </div>

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