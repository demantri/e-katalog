<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Keuangan</h4> &emsp; <small><b>Post Jurnal</b></small>
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
								<a href="<?php echo site_url('transaksi/keuangan/jurnal'); ?>">Post Jurnal</a>
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
									<h4 class="card-title">Detail Jurnal</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<a href="<?php echo site_url('transaksi/keuangan/jurnal') ?>" class="btn btn-primary btn-border btn-flat pull-left"><i class="fa fa-chevron-left"></i> KEMBALI</a>
										</div>
              						</div>

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
						                      <td>JENIS</td>
						                      <td class="text-right">
						                        <b><?php echo strtoupper($transaksi['jenis']) ?></b>
						                      </td>
						                    </tr>

						                    <tr>
						                      <td>TIPE</td>
						                      <td class="text-right">
						                        <b><?php echo show_tipe_transaksi($transaksi['tipe']) ?></b>
						                      </td>
						                    </tr>

						                    <tr>
						                      <td>TOTAL TRANSAKSI</td>
						                      <td class="text-right"><b><?php echo format_rp($transaksi['total_transaksi']) ?></b></td>
						                    </tr>

						                  </table>

						                </div>

						                <div class="col-md-8">
						                    <div class="card">
						                      <div class="card-header"><img style="width: 25px" src="<?php echo base_url('assets/img/icon/barang.png') ?>"> &nbsp;<b>JURNAL</b></div>
						                    </div>

						                     <div class="table-responsive">
						                      <table class="table">
						                        <thead style="background-color:#eee">
						                          <tr>
						                            <th style="width: 45%">AKUN</th>
						                            <th>REF</th>
						                            <th>DEBIT</th>
						                            <th>KREDIT</th>
						                          </tr>
						                        </thead>

						                        <tbody id="tableItem">
						                          <?php $n = $grandTotal = $t_debit = $t_kredit = 0; 
						                                foreach ($jurnal_list as $row) { 
						                                	if($row['posisi'] == 'd'){
						                                		$t_debit = $row['nominal'];
						                                		$title = $row['nama_coa'];
						                                	}else{
						                                		$t_kredit = $row['nominal'];
						                                		$title = '&emsp;&emsp;&emsp;'.$row['nama_coa'];
						                                	}
						                          ?>

						                                  <tr>
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
						                            <td colspan="2"><h4><b>TOTAL</b></h4></td>
						                            <td class="text-right"><h4><b id="grandTotal"><?php echo format_rp($t_debit) ?></b></h4></td>
						                            <td class="text-right"><h4><b id="grandTotal"><?php echo format_rp($t_kredit) ?></b></h4></td>
						                          </tr>

						                      </table>
						                    </div>
						                </div>
						              </div>

						              <div class="row">
					              		<div class="col-md-4">
					              			<div class="card">
							                    <div class="card-header"><img style="width: 25px" src="<?php echo base_url('assets/img/icon/megaphone.png') ?>"> &nbsp;<b>POSTING JURNAL</b>
							                    </div>

							                    <div class="card-body text-center">
							                <?php if($jurnal['status'] == '0'){ ?>
							                    	<a onclick="return confirm('Apakah anda yakin ?')" class="btn btn-success" href="<?php echo site_url('post_jurnal/'.$transaksi['id']) ?>"><i class="fa fa-check"></i> TERIMA</a>
							                    </div>

							                <?php }else{ ?>

							                			<span class="badge badge-success"><i class="fa fa-check-circle"></i> Sudah diposting</span>

							                <?php   
							            		}
							            	?>



							                </div>
					              		</div>

						              </div>

								</div>
							</div>
						</div>


					</div>
				</div>