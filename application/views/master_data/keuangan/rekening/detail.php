<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Master Data</h4> &emsp; <small><b>Keuangan</b></small>
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
								<a href="<?php echo site_url('master_data/keuangan/rekening') ?>">Rekening</a>
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
									<h4 class="card-title">Detail Rekening</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<a href="<?php echo site_url('master_data/keuangan/rekening') ?>" class="btn btn-primary btn-border btn-flat pull-left"><i class="fa fa-chevron-left"></i> KEMBALI</a>
										</div>
              						</div>

              						<br>

									<div class="row">
										<div class="col-md-4">
											<div class="card card-dark bg-secondary-gradient">
												<div class="card-body bubble-shadow">
													<b>Rekening</b>
													<h2 class="py-4 mb-0"><?php echo chunk_split($rek['no_rek'], 4, ' '); ?></h2>
													<div class="row">
														<div class="col-8 pr-0">
															<h3 class="fw-bold mb-1"><?php echo $rek['atas_nama'] ?></h3>
															<div class="text-small text-uppercase fw-bold op-8">Pemilik Kartu</div>
														</div>
														<div class="col-4 pl-0 text-right">
															<h3 class="fw-bold mb-1"><?php echo $rek['nama_bank'] ?></h3>
															<div class="text-small text-uppercase fw-bold op-8">Nama Bank</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3">
											<div class="card card-stats card-round">
												<div class="card-body ">
													<div class="row">
														<div class="col-4">
															<div class="icon-big text-center">
																<img class="img-fluid" src="<?php echo base_url('assets/img/icon/pembayaran.png') ?>">
															</div>
														</div>
														<div class="col-8 col-stats">
															<div class="numbers">
																<p class="card-category">Total Saldo</p>
																<h4 class="card-title"><?php echo format_rp($rek['saldo']) ?></h4>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-5">
											<div class="card">
												<div class="card-header"><b>Arus dana bulan ini</b></div>
												<div class="card-body">

													<?php 
														if($balance_in == ''){
															$balance_in = 0;
														} 

														if($balance_out == ''){
															$balance_out = 0;
														} 
													?>

													<div class="row">
														<div class="col-md-6">
															<div class="row align-items-center">
																<div class="col-md-4">
																	<span class="stamp stamp-md bg-success mr-3">
																		<i class="far fa-arrow-alt-circle-down"></i>
																	</span>
																</div>
																<div class="col-md-8 col-stats ml-3 ml-sm-0">
																	<div class="numbers">
																		<p class="card-category">Dana Masuk</p>
																		<?php echo format_rp($balance_in) ?>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="row align-items-center">
																<div class="col-md-4">
																	<span class="stamp stamp-md bg-danger mr-3">
																		<i class="far fa-arrow-alt-circle-up"></i>
																	</span>
																</div>
																<div class="col-md-8 col-stats ml-3 ml-sm-0">
																	<div class="numbers">
																		<p class="card-category">Dana Keluar</p>
																		<?php echo format_rp($balance_out) ?>
																	</div>
																</div>
															</div>
														</div>
													</div>
													
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="card">
												<div class="card-header"><img style="width: 25px" src="<?php echo base_url('assets/img/icon/detail.png') ?>"> &nbsp;<b>History Penggunaan</b></div>
											</div>

											<table class="table datatables">
												<thead>
													<tr>
														<td>No</td>
														<td>Kode</td>
														<td>Tanggal Transaksi</td>
														<td>Total</td>
														<td class="text-center">Tipe</td>
														<td class="text-center"><i class="fa fa-cog"></i></td>
													</tr>
												</thead>
												<tbody>
													<?php 
														$n = 0;
														foreach ($list as $row){ $n++; ?>
														
														<tr>
															<td><?php echo $n ?></td>
															<td><?php echo $row['kode_transaksi'] ?></td>
															<td><?php echo $row['tanggal_transaksi'] ?></td>
															<td class="text-right"><?php echo format_rp($row['total_bayar']) ?></td>
															<td class="text-center">
																<?php if($row['jenis'] == 'masuk'){ ?>
																	<span class="badge badge-success"><i class="far fa-arrow-alt-circle-down"></i> Masuk</span>

																<?php }else{ ?>
																	<span class="badge badge-danger"><i class="far fa-arrow-alt-circle-up"></i> Keluar</span>

																<?php } ?>
															</td>
															<td>
																<a href="#" class="btn btn-primary shadow btn-sm"><i class="fa fa-search"></i></a>
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

   <form action="<?php echo site_url('update_rekening') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditKTG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <input type="hidden" name="id_rekening" id="e_id">

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Kategori</label>
                   <input type="text" name="kode_rek" id="e_kode" class="form-control" placeholder="Kode Kategori..." value="<?php echo $last_code;?>" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama Bank</label>
                   <input autocomplete="off" type="text" name="nama_bank" id="e_nama" class="form-control" placeholder="Nama Bank..." required/>
                </div>

                <div class="form-group">
                   <label>Nomor Rekening</label>
                   <input autocomplete="off" type="text" name="no_rek" id="e_rek" class="form-control" placeholder="Nomor Rekening..." required/>
                </div>

                <div class="form-group">
                   <label>Pemilik Kartu</label>
                   <input autocomplete="off" type="text" name="atas_nama" id="e_atas_nama" class="form-control" placeholder="Pemilik Kartu..." required/>
                </div>

             </div>

             <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning btn-flat"><i class="fa fa-edit"></i> Ubah</button>
             </div>

           </div>
        </div>
     </div>
   </form>

<script type="text/javascript">
 function edit(id, kode, nama, no_rek, atas_nama){
  $('#e_id').val(id);
  $('#e_kode').val(kode);
  $('#e_nama').val(nama);
  $('#e_rek').val(no_rek);
  $('#e_atas_nama').val(atas_nama);
  $('#modalEditKTG').modal('show'); 
}
</script>