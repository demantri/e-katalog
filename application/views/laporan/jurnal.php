<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Laporan</h4> &emsp; <small><b>Jurnal</b></small>
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
								<a href="#">Jurnal</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Jurnal</h4>
								</div>
								<div class="card-body">

									<form method="GET">
										<div class="row">
											<div class="col-md-3">
												<label><b>Dari</b></label>
												<input type="text" name="start" class="form-control date-picker" autocomplete="off" required="" placeholder="Dari Tanggal..." value="<?php echo $this->input->get('start') ?>">
											</div>

											<div class="col-md-3">
												<label><b>Ke</b></label>
												<input type="text" name="end" class="form-control date-picker" autocomplete="off" required="" value="<?php echo $this->input->get('end') ?>" placeholder="Ke Tanggal...">
											</div>

											<div class="col-md-1">
												<br>
												<button class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
											</div>

											<div class="col-md-5 text-right">
												<br>
												<a href="<?php echo site_url('laporan/jurnal') ?>" class="btn btn-sm btn-success">Lihat Semua</a>
											</div>
										</div>
									</form>

									<br>

									<div class="table-responsive">
				                      <table class="table">
				                        <thead style="background-color:#eee">
				                          <tr>
				                          	<th>Tanggal</th>
				                          	<th>Kode Transaksi</th>
				                            <th style="width: 25%">Akun</th>
				                            <th style="width: 5%">Ref</th>
				                            <th>Debit</th>
				                            <th>Kredit</th>
				                          </tr>
				                        </thead>

				                        <tbody id="tableItem">
				                          <?php $n = $total_debit = $total_kredit = 0; 
				                                foreach ($jurnal as $row) {
				                                	if($row['posisi'] == 'd'){
				                                		// $coa = $row['nama_coa'];
				                                		// $beban = $row['nama_beban'];
				                                		// $title = $coa.' '.$beban;
				                                		$title = $row['nama_coa'];
				                                		$total_debit += $row['nominal'];
				                                	}else{
				                                		// if ($row['metode'] == 'Cash') {
				                                		// 	$tunai = 'tunai';
				                                		// } else {
				                                		// 	$tunai = 'transfer';
				                                		// }
				                                		$title = '&emsp;&emsp;&emsp;'.$row['nama_coa'];
				                                		$total_kredit += $row['nominal'];
				                                	}
				                          ?>

				                                  <tr>
				                                  	<!-- <td><?php echo date('Y-m-d',strtotime($row['waktu_jurnal'])) ?></td> -->
				                                  	<?php if($row['posisi'] == 'd'){ ?>
				                                    		<!-- <td class="text-right"><?php echo format_rp($row['nominal']) ?></td> -->
				                                    		<td><?php echo date('Y-m-d',strtotime($row['waktu_jurnal'])) ?></td>
				                                    		<!-- <td></td> -->
				                                    <?php }else{ ?>
				                                    		<!-- <td></td> -->
				                                    		<!-- <td class="text-right"><?php echo format_rp($row['nominal']) ?></td> -->
				                                    		<td></td>

				                                    <?php } ?>
				                                  	<td><?php echo $row['kode_transaksi'] ?></td>
				                                    <td><?php echo $title ?></td>
				                                    <td><?php echo $row['kode_coa'] ?></td>

				                                    <?php if($row['posisi'] == 'd'){ ?>
				                                    		<td class="text-right"><?php echo format_rp($row['nominal']) ?></td>
				                                    		<td></td>
				                                    <?php }else{ ?>
				                                    		<td></td>
				                                    		<td class="text-right"><?php echo format_rp($row['nominal']) ?></td>
				                                    <?php } ?>

				                                  </tr>

				                          <?php } ?>

				                        </tbody>

				                          <tr>
				                            <td colspan="4"><h4><b>TOTAL</b></h4></td>
				                            <td class="text-right"><h4><b id="grandTotal"><?php echo format_rp($total_debit) ?></b></h4></td>
				                            <td class="text-right"><h4><b id="grandTotal"><?php echo format_rp($total_kredit) ?></b></h4></td>
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