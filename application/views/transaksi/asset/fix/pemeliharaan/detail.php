<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Asset</h4> &emsp; <small><b>Pemeliharaan</b></small>
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
								<a href="#">Asset</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="<?php echo site_url('transaksi/asset/pemeliharaan'); ?>">Pemeliharaan</a>
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
									<h4 class="card-title">Detail Pemeliharaan</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<a href="<?php echo site_url('transaksi/asset/pemeliharaan') ?>" class="btn btn-primary btn-border btn-flat"><i class="fa fa-chevron-left"></i> KEMBALI</a>
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
						                      <td>TIPE</td>
						                      <td class="text-right">
						                        <b><?php echo $transaksi['pembayaran'] ?></b>
						                        <?php if($transaksi['status'] == 'Lunas'){
						                          echo "<span class='badge badge-success'>Lunas</span>";
						                        }else{
						                          echo "<span class='badge badge-danger'>Belum Lunas</span>";
						                        } ?>
						                      </td>
						                    </tr>

						                    <tr>
						                      <td>TOTAL PEROLEHAN</td>
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
						                      <div class="card-header"><img style="width: 25px" src="<?php echo base_url('assets/img/icon/barang.png') ?>"> &nbsp;<b>DAFTAR BARANG</b></div>
						                    </div>

						                     <div class="table-responsive">
						                      <table class="table">
						                        <thead style="background-color:#eee">
						                          <tr>
						                            <th>PRODUK</th>
						                            <th style="width: 40%">KETERANGAN</th>
						                            <th style="width: 25%">SUBTOTAL</th>
						                          </tr>
						                        </thead>

						                        <tbody id="tableItem">
						                          <?php $n = $grandTotal = 0; 
						                                foreach ($item as $row) { $n++; $grandTotal += $row['harga_pemeliharaan']?>

						                                  <tr>
						                                    <td><?php echo $row['kode_aset']." / ".$row['nama_aset'] ?></td>
						                                    <td><?php echo $row['keterangan_pemeliharaan'] ?></td>
						                                    <td class="text-right"><?php echo format_rp($row['harga_pemeliharaan']) ?></td>
						                                  </tr>

						                          <?php } ?>

						                        </tbody>

						                          <tr>
						                            <td colspan="2"><input type="hidden" id="inputGrandTotal" name="grandTotal" value="<?php echo $grandTotal ?>"><h4><b>TOTAL</b></h4></td>
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

							                    <?php 

							                    	$opacity_2 = $opacity_3 = 'style="opacity:0.5"';
							                    	$s1 = $s2 = $s3 = false;

							                    	if($transaksi['level'] == '1'){
							                    		$current_1 = 'timeline_active';
							                    		$current_2 = $current_3 = '';
							                    	
							                    	}else if($transaksi['level'] == '2'){
							                    		$current_2 = 'timeline_active';
							                    		$current_1 = $current_3 = '';
							                    		$opacity_2 = '';
							                    		$s1 = true;

							                    	}else if($transaksi['level'] == '3'){
							                    		$current_1 = $current_2 = $current_3 = '';
							                    		$opacity_3 = $opacity_2 = '';
							                    		$s1 = $s2 = $s3 = true;
							                    	}

							                    ?>

							                    <ol class="activity-feed">
													<li class="feed-item feed-item-secondary">
														<div class="d-flex <?php echo $current_1 ?>">
															<div class="avatar">
																<span class="avatar-title rounded-circle border border-white bg-info"><i class="fa fa-graduation-cap"></i></span>
															</div>
															<div class="flex-1 ml-3 pt-1">
																<h6 class="text-uppercase fw-bold mb-1">Kepala Sekolah</h6>
																<span class="text-muted">Pending Review.</span>
															</div>

															<?php if($s1){ ?>

																	<div class="float-right pt-1">
																		<i class="fa fa-check-circle text-success"></i>
																	</div>

															<?php } ?>
															
														</div>
													</li>

													<li class="feed-item feed-item-secondary">
														<div class="d-flex <?php echo $current_2 ?>" <?php echo $opacity_2 ?>>
															<div class="avatar">
																<span class="avatar-title rounded-circle border border-white bg-info"><i class="fas fa-money-check-alt"></i></span>
															</div>
															<div class="flex-1 ml-3 pt-1">
																<h6 class="text-uppercase fw-bold mb-1">Keuangan</h6>
																<span class="text-muted">Review Pendanaan.</span>
															</div>

															<?php if($s2){ ?>

																	<div class="float-right pt-1">
																		<i class="fa fa-check-circle text-success"></i>
																	</div>

															<?php } ?>
														</div>
													</li>

													<li class="feed-item feed-item-secondary disable">
														<div class="d-flex <?php echo $current_3 ?>" <?php echo $opacity_3 ?>>
															<div class="avatar">
																<span class="avatar-title rounded-circle border border-white bg-info"><i class="far fa-money-bill-alt"></i></span>
															</div>
															<div class="flex-1 ml-3 pt-1">
																<h6 class="text-uppercase fw-bold mb-1">Pencairan Dana</h6>
																<span class="text-muted">Invoice dibayarkan.</span>
															</div>

															<?php if($s3){ ?>

																	<div class="float-right pt-1">
																		<i class="fa fa-check-circle text-success"></i>
																	</div>

															<?php } ?>
														</div>
													</li>

												</ol>
							                </div>
					              		</div>

						                <div class="col-md-8">
						                  <div class="card">
						                    <div class="card-header"><img style="width: 25px" src="<?php echo base_url('assets/img/icon/pembayaran.png') ?>"> &nbsp;<b>DAFTAR PEMBAYARAN</b></div>
						                  </div>

						                    <div class="table-responsive">
						                      <table class="table">
						                        <thead style="background-color:#eee">
						                          <tr>
						                            <th style="width:5%">NO</th>
						                            <th>WAKTU</th>
						                            <th>JUMLAH BAYAR</th>
						                          </tr>
						                        </thead>

						                        <tbody id="tableItem">
						                          <?php $n = $grandTotal = 0; 
						                                foreach ($pembayaran as $row) { $n++; $grandTotal += $row['jumlah_bayar']?>

						                                  <tr>
						                                    <td><?php echo $n ?></td>
						                                    <td><?php echo $row['tanggal_bayar'] ?></td>
						                                    <td class="text-right"><?php echo format_rp($row['jumlah_bayar']) ?></td>
						                                  </tr>

						                          <?php } ?>

						                        </tbody>

						                          <tr>
						                            <td><input type="hidden" id="inputGrandTotal" name="grandTotal" value="<?php echo $grandTotal ?>"></td>
						                            <td><h4><b>TOTAL</b></h4></td>
						                            <td class="text-right"><h4><b id="grandTotal"><?php echo format_rp($grandTotal) ?></b></h4></td>
						                          </tr>

						                      </table>
						                    </div>

						                </div>
						              </div>

								</div>
							</div>
						</div>


					</div>
				</div>
