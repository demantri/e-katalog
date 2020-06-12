<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Review</h4> &emsp; <small><b>Pendanaaan</b></small>
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
								<a href="#">Review</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="<?php echo site_url('transaksi/asset/perolehan'); ?>">Pendanaan</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="#"><?php echo $transaksi['kode_transaksi'] ?></a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Detail Transaksi</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<a href="<?php echo site_url('transaksi/review/cashflow') ?>" class="btn btn-primary btn-border btn-flat"><i class="fa fa-chevron-left"></i> KEMBALI</a>
              						<br><br>

									
              						<div class="row">
						                <div class="col-md-4">
						                  <div class="card">
						                    <div class="card-header"><img style="width: 25px" src="<?php echo base_url('assets/img/icon/detail.png') ?>"> &nbsp;<b>DETAIL</b></div>
						                  </div>

						                  <table class="table">
						                    <tr>
						                      <td>KODE</td>
						                      <td class="text-right"><b><?php echo $transaksi['kode_transaksi'] ?></b></td>
						                    </tr>

						                    <tr>
						                      <td>PEMBAYARAN</td>
						                      <td class="text-right">
						                        <b><?php echo $transaksi['pembayaran'] ?></b>
						                      </td>
						                    </tr>


						                    <tr>
						                      <td>TIPE</td>
						                      <td class="text-right">
						                      	<?php 
						                      		if ($transaksi['tipe'] == 'transaksi_beban') {
						                      			echo "<b>Transaksi Beban</b>";
						                      		}
						                      	?>
						                      </td>
						                    </tr>

						                    <tr>
						                      <td>TOTAL TRANSAKSI</td>
						                      <td class="text-right"><b><?php echo format_rp($transaksi['total_transaksi']) ?></b></td>
						                    </tr>

						                    <tr>
						                      <td>TOTAL BAYAR</td>
						                      <td class="text-right"><b><?php echo format_rp($transaksi['total_bayar']) ?></b></td>
						                    </tr>

						                    <tr>
						                      <td>SISA BAYAR</td>
						                      <td class="text-right"><b><?php echo format_rp($transaksi['sisa_bayar']) ?></b></td>
						                    </tr>
						                  </table>

						                </div>

						                <div class="col-md-8">
						                    <div class="card">
						                      <div class="card-header"><img style="width: 25px" src="<?php echo base_url('assets/img/icon/barang.png') ?>"> &nbsp;<b>DAFTAR PENGELUARAN</b></div>
						                    </div>

						                     <div class="table-responsive">
						                      <table class="table">
						                        <thead style="background-color:#eee">
						                          <tr>
						                            <th>NO</th>
						                            <th>KOMPONEN</th>
						                            <th>KETERANGAN</th>
						                            <!-- <th style="width: 10%">JUMLAH</th> -->
						                            <th style="width: 25%">NOMINAL</th>
						                          </tr>
						                        </thead>

						                        <tbody id="tableItem">
						                          <?php $n = $grandTotal = 0; $i =1;
						                                foreach ($item as $row) { $n++; $grandTotal += $row['subtotal']?>

						                                  <tr>
						                                    <td><?php echo $i++ ?></td>
						                                    <td><?php echo $row['komponen'] ?></td>
						                                    <td><?php echo $row['keterangan'] ?></td>
						                                    <!-- <td><?php echo $row['qty'] ?></td> -->
						                                    <td class="text-right"><?php echo format_rp($row['subtotal']) ?></td>
						                                  </tr>

						                          <?php } ?>

						                        </tbody>

						                          <tr>
						                            <td><input type="hidden" id="inputGrandTotal" name="grandTotal" value="<?php echo $grandTotal ?>"></td>
						                            <td></td>
						                            <td><h4><b>TOTAL</b></h4></td>
						                            <td class="text-right"><h4><b id="grandTotal"><?php echo format_rp($grandTotal) ?></b></h4></td>
						                          </tr>

						                      </table>
						                    </div>
						                </div>
						              </div>

						              <div class="row">
					              		<div class="col-md-4">
					              			<div class="card">
							                    <div class="card-header"><img style="width: 25px" src="<?php echo base_url('assets/img/icon/megaphone.png') ?>"> &nbsp;<b>PERSETUJUAN</b>
							                    </div>

							                    <div class="card-body text-center">

							                <?php if($transaksi['level'] == '1' && $transaksi['is_deny'] != '1'){ ?>
							                    	<a onclick="return confirm('Apakah anda yakin ?')" class="btn btn-success" href="<?php echo site_url('set_trans_level/approve/'.$transaksi['id']) ?>"><i class="fa fa-check"></i> TERIMA</a>
							                    	&emsp;

							                    	<?php if($transaksi['tipe'] != 'bank'){ ?>

							                    			<a onclick="return confirm('Apakah anda yakin ?')" class="btn btn-danger" href="<?php echo site_url('set_trans_level/deny/'.$transaksi['id']) ?>"><i class="fa fa-ban"></i> TOLAK</a>

							                    	<?php } ?>
							                    
							                <?php }else{

							                		if($transaksi['is_deny'] != '1'){ ?>

							                			<span class="badge badge-success"><i class="fa fa-check-circle"></i> Diterima</span>

							                <?php   }else{ ?>

							                			<span class="badge badge-danger"><i class="fa fa-ban"></i> Ditolak</span>

							                <?php   } 

							            		} 
							            	?>

							            	<br><br>
							            	<!-- <b>Keterangan</b> -->
							            	<!-- <br> -->
							            	<!-- <?php echo $transaksi['keterangan'] ?> -->

							            		</div>
							                </div>
					              		</div>

						              </div>

								</div>
							</div>
						</div>


					</div>
				</div>
