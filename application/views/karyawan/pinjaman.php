<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Dashboard</h4> &emsp; <small><b></b></small>
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
								<a href="#">Dashboard</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="#">Pinjaman</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Pinjaman</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<button class="btn btn-primary" data-toggle="modal" data-target="#modalIzin"><i class="fa fa-plus"></i> Ajukan Pinjaman</button>

									<?php if($sisa_pinjaman == 0){
											$sisa_pinjaman = 0;
									} ?>
									<span class="pull-right">Pinjaman Belum Lunas <br><b class="text-danger"><?php echo format_rp($sisa_pinjaman) ?></b></span>

									<br><br>

									<ul class="nav nav-pills nav-secondary  nav-pills-no-bd nav-pills-icons" id="pills-tab-with-icon" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="pills-home-tab-icon" data-toggle="pill" href="#pills-home-icon" role="tab" aria-controls="pills-home-icon" aria-selected="true">
												 Pengajuan
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#pills-profile-icon" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
												 Diterima
											</a>
										</li>

										<li class="nav-item">
											<a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#ditolak" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
												 Ditolak
											</a>
										</li>
									</ul>

									<div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
										<div class="tab-pane fade show active" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
											<div class="table-responsive">
												<table class="display table table-hover datatables" >
													<thead style="background-color: #eee">
														<thead>
						                                    <tr>
						                                      <th style="width:5%">No</th>
						                                      <th>Total Pinjaman</th>
						                                      <th>Telah Dibayar</th>
						                                      <th>Sisa Pembayaran</th>
						                                      <th class="text-center">Waktu</th>
						                                      <th class="text-center" style="width: 15%"><i class="fa fa-cog"></i></th>
						                                    </tr>
													</thead>
													<tbody>
					                                    <?php 
					                                        $n = 0;
					                                        foreach ($pinjaman_pending as $row) { $n++; 

					                                    ?>
					                                          <tr>
					                                            <td><?php echo $n; ?></td>

					                                            <td class="text-right"><?php echo format_rp($row['total_transaksi']) ?></td>
					                                            <td class="text-right"><?php echo format_rp($row['total_bayar']) ?></td>
					                                            <td class="text-right"><?php echo format_rp($row['sisa_bayar']) ?></td>

					                                            <td class='text-center'><?php echo date('d-m-Y H:i', strtotime($row['tanggal_transaksi'])) ?></td>
					                                            <td class="text-center">
					                                            	<span class="badge badge-primary">Pengajuan</span>
					                                            </td>
					                                          </tr>
					                                    <?php } ?>
					                                </tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane fade" id="pills-profile-icon" role="tabpanel" aria-labelledby="pills-profile-tab-icon">

											<div class="table-responsive">
												<table class="table">
				                                  <thead>
				                                    <thead>
					                                    <tr>
					                                       <th style="width:5%">No</th>
					                                       <th>Kode</th>
						                                      <th>Total Pinjaman</th>
						                                      <th>Telah Dibayar</th>
						                                      <th>Sisa Pembayaran</th>
						                                      <th class="text-center">Waktu</th>
						                                      <th class="text-center" style="width: 15%"><i class="fa fa-cog"></i></th>
					                                    </tr>
				                                  </thead>
				                                  <tbody>
					                                    <?php 
					                                        $n = 0;
					                                        foreach ($pinjaman_acc as $row) { $n++; 

					                                    ?>
					                                          <tr>
					                                            <td><?php echo $n; ?></td>
					                                            <td><?php echo $row['kode_transaksi'] ?></td>
					                                            <td class="text-right"><?php echo format_rp($row['total_transaksi']) ?></td>
					                                            <td class="text-right"><?php echo format_rp($row['total_bayar']) ?></td>
					                                            <td class="text-right"><?php echo format_rp($row['sisa_bayar']) ?></td>

					                                            <td class='text-center'><?php echo date('d-m-Y H:i', strtotime($row['tanggal_transaksi'])) ?></td>
					                                            <td>
					                                            	Pengajuan : 
					                                            	<span class="badge badge-success">Diterima</span> <br>
					                                            	Pinjaman : <?php if($row['status'] == 'Belum Lunas'){ ?>	
					                                            			<span class="badge badge-danger">Belum Lunas</span>
					                                            	<?php }else{ ?>
					                                            			<span class="badge badge-success">Lunas</span>
					                                            	<?php } ?>
					                                            </td>
					                                          </tr>
					                                    <?php } ?>
					                                </tbody>
				                                </table>
											</div>

										</div>

										<div class="tab-pane fade" id="ditolak" role="tabpanel" aria-labelledby="pills-profile-tab-icon">
											<table class="table">
			                                  <thead>
			                                    <tr>
			                                       <th style="width:5%">No</th>
			                                       <th>Total Pinjaman</th>
			                                       <th>Telah Dibayar</th>
			                                       <th>Sisa Pembayaran</th>
			                                       <th class="text-center">Waktu</th>
			                                       <th class="text-center" style="width: 15%"><i class="fa fa-cog"></i></th>
			                                    </tr>
			                                  </thead>
			                                  <tbody>
					                                    <?php 
					                                        $n = 0;
					                                        foreach ($pinjaman_deny as $row) { $n++; 

					                                    ?>
					                                          <tr>
					                                            <td><?php echo $n; ?></td>

					                                            <td class="text-right"><?php echo format_rp($row['total_transaksi']) ?></td>
					                                            <td class="text-right"><?php echo format_rp($row['total_bayar']) ?></td>
					                                            <td class="text-right"><?php echo format_rp($row['sisa_bayar']) ?></td>

					                                            <td class='text-center'><?php echo date('d-m-Y H:i', strtotime($row['tanggal_transaksi'])) ?></td>
					                                            <td class="text-center">
					                                            	<span class="badge badge-danger">Ditolak</span>
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


<form action="<?php echo site_url('insert_pinjaman') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalIzin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Perizinan</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>

             <div class="modal-body">
              	<div class="form-group row">
				    <label for="inputEmail3" class="col-sm-4 col-form-label">Dapat Dipinjam</label>
				    <div class="col-sm-8">
				      <input autocomplete="off" disabled="" id="dapat_dipinjam" type="text" required="required" class="form-control rupiah" id="inputEmail3"  name="total_transaksi" placeholder="Nominal (Rp)..." value="<?php echo format_rp($gaji - $sisa_pinjaman) ?>">
				    </div>
				</div>

				<div class="form-group row">
				    <label for="inputEmail3" class="col-sm-4 col-form-label">Nominal Pinjaman</label>
				    <div class="col-sm-8">
				      <input autocomplete="off" id="nominal" type="text" required="required" class="form-control rupiah" id="inputEmail3"  name="total_transaksi" placeholder="Nominal (Rp)...">
				    </div>
				</div>
				<div class="form-group row">
				    <label for="inputEmail3" class="col-sm-4 col-form-label">Belum Lunas</label>
				    <div class="col-sm-8">
				      <input autocomplete="off" disabled="" id="telah_dipinjam" type="text" required="required" class="form-control rupiah" id="inputEmail3"  name="total_transaksi" placeholder="Nominal (Rp)..." value="<?php echo format_rp($sisa_pinjaman) ?>">
				    </div>
				</div>
				<div class="form-group row">
                	<label class="col-sm-4">Pencairan</label><br>
                	<div class="selectgroup selectgroup-secondary selectgroup-pills col-sm-8">
						<label class="selectgroup-item">
							<input type="radio" name="metode" value="Cash" class="selectgroup-input m" checked="">
							<span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-money-bill-wave"></i> Cash</span>
						</label>
					 	<label class="selectgroup-item">
							<input type="radio" name="metode" value="Transfer" class="selectgroup-input m">
							<span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-laptop"></i> Transfer</span>
						</label>
					</div>
                </div>
				<div class="form-group row">
				    <label for="inputEmail3" class="col-sm-4 col-form-label">Keterangan</label>
				    <div class="col-sm-8">
				      <textarea autocomplete="off" type="text" required="required" class="form-control" id="inputEmail3"  name="keterangan" placeholder="Keterangan..."></textarea>
				    </div>
				</div>

             </div>

             <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Simpan</button>
             </div>

           </div>
        </div>
     </div>
   </form>


 <script type="text/javascript">
 	var gaji = <?php echo $gaji ?>;
 	var sisa_pinjaman = <?php echo $sisa_pinjaman ?>;

 	var avl = gaji - sisa_pinjaman;

 	$(document).on('keyup keypress', '#nominal', function(){
 		var n 	  = format_angka($(this).val());
 		var total = sisa_pinjaman + n;

 		if(total > gaji){
 			alert('Tidak dapat melakukan pinjaman, karena total melebihi gaji anda');
 			$('#nominal').val('');
 			$('#dapat_dipinjam').val(format_rp(avl));
 			$('#telah_dipinjam').val(format_rp(sisa_pinjaman));
 		
 		}else{
 			$('#dapat_dipinjam').val(format_rp(avl - n));
 			$('#telah_dipinjam').val(format_rp(total));
 		}
 	})

    $(function() {
        $('.date-picker').datepicker({
          dateFormat : "yy-mm-dd"
        });
    });
</script>