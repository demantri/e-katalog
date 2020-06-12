<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Master Data</h4> &emsp; <small><b>Asset</b></small>
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
								<a href="<?php echo site_url('master_data/asset/aktiva'); ?>">Daftar</a>
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
									<h4 class="card-title">Detail Aktiva</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<a href="<?php echo site_url('master_data/asset/aktiva') ?>" class="btn btn-primary btn-border btn-flat"><i class="fa fa-chevron-left"></i> KEMBALI</a>
              						<br><br>

              						<div class="table-responsive">
				                      <table class="display table table-hover datatables">
				                        <thead style="background-color:#eee">
				                          <tr>
				                            <th style="width:5%">No</th>
				                            <th>Kode Detail Aktiva</th>
				                            <th>Tanggal Perolehan</th>
				                            <th>Harga</th>
				                            <th>Nilai Residu</th>
				                            <th>Lokasi / Ruangan</th>
				                            <th>Status</th>
				                          </tr>
				                        </thead>

				                        <tbody id="tableItem">
				                        	<?php $n = 0; foreach ($list as $row) { $n++;  ?>
				                        			<tr>
				                        				<td><?php echo $n ?></td>
				                        				<td><?php echo $row['kode_detail_aset'] ?></td>
				                        				<td><?php echo date('Y-m-d', strtotime($row['tanggal_transaksi'])) ?></td>
				                        				<td class="text-right"><?php echo format_rp($row['harga']) ?></td>
				                        				<td class="text-right"><?php echo format_rp($row['nilai_residu']) ?></td>
				                        				<td class="text-center">
				                        					<?php 

				                        						if($row['is_retur'] == '0'){
				                        							if($row['lokasi_id'] == null || is_null($row['lokasi_id'])){
					                        							echo "<span class='text-danger'><i class='fa fa-ban'></i> Belum Ditempatkan</span>";
					                        						}else{
					                        							echo $row['kode_lokasi']." / ".$row['nama_lokasi'];
					                        						}

				                        						}else{
				                        							echo "-";
				                        						}
				                        						
				                        					?>
				                        				</td>
				                        				<td class="text-center">
				                        					<?php 
				                        						if($row['is_retur'] == '0'){
				                        							echo "<span class='badge badge-success'>Aktif</span>";
				                        						}else{
				                        							echo "<span class='badge badge-danger'>Retur</span>";
				                        						}
				                        					?>
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
