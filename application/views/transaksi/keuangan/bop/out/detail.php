<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Keuangan</h4> &emsp; <small><b>BOP Keluar</b></small>
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
								<a href="<?php echo site_url('transaksi/keuangan/bop_out'); ?>">Dana BOP</a>
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
									<h4 class="card-title">Detail BOP</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<a href="<?php echo site_url('transaksi/keuangan/bop_out') ?>" class="btn btn-primary btn-border btn-flat pull-left"><i class="fa fa-chevron-left"></i> KEMBALI</a>

											<a target="_blank" href="<?php echo site_url('transaksi/keuangan/cash_out/cetak/'.$transaksi['id']) ?>" class="btn btn-info btn-flat pull-right shadow"><i class="fa fa-print"></i> CETAK</a>
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
						                      <td>TIPE</td>
						                      <td class="text-right">
						                        <b><?php echo strtoupper($transaksi['tipe']) ?></b>
						                      </td>
						                    </tr>

						                    <tr>
						                      <td>TOTAL BOP</td>
						                      <td class="text-right"><b><?php echo format_rp($transaksi['total_transaksi']) ?></b></td>
						                    </tr>

						                    <tr>
						                      <td>TOTAL PENGGUNAAN</td>
						                      <td class="text-right"><b><?php echo format_rp($total_penggunaan) ?></b></td>
						                    </tr>
						                  </table>

						                </div>

						                <div class="col-md-8">
						                    <div class="card">
						                      <div class="card-header"><img style="width: 25px" src="<?php echo base_url('assets/img/icon/barang.png') ?>"> &nbsp;<b>DAFTAR PENGGUNAAN</b></div>
						                    </div>

							                    <button data-toggle="modal" data-target="#modalTambahBOP" class="btn btn-primary btn-sm btn-flat mt-2 mb-2"><i class="fa fa-plus"></i> Tambah</button>
							              		<br><br>

						                     <div class="table-responsive">
						                      <table class="table">
						                        <thead style="background-color:#eee">
						                          <tr>
						                            <th>NAMA KOMPONEN</th>
						                            <th>METODE</th>
						                            <th style="width: 25%">SUBTOTAL</th>
						                          </tr>
						                        </thead>

						                        <tbody id="tableItem">
						                          <?php $n = $grandTotal = 0; 
						                                foreach ($item as $row) { $n++; $grandTotal += $row['subtotal']?>

						                                  <tr>
						                                    <td><?php echo $row['nama_komponen'] ?></td>
						                                    <td><?php echo $row['metode_pengeluaran'] ?></td>
						                                    <td class="text-right"><?php echo format_rp($row['subtotal']) ?></td>
						                                  </tr>

						                          <?php } ?>

						                        </tbody>

						                          <tr>
						                            <td colspan="2"><h4><b>TOTAL</b></h4></td>
						                            <td class="text-right"><h4><b id="grandTotal"><?php echo format_rp($grandTotal) ?></b></h4></td>
						                          </tr>

						                      </table>
						                    </div>
						                </div>
						              </div>

						              <div class="row">
					              		<div class="col-md-4">
					              			<div class="card">
							                    <div class="card-header"><img style="width: 25px" src="<?php echo base_url('assets/img/icon/megaphone.png') ?>"> &nbsp;<b>KETERANGAN</b>
							                    </div>

							                    <div class="card-body text-center">
							                <?php if($transaksi['level'] == '2'){ ?>
							                    	<a data-toggle="modal" data-target="#modalApprove" class="btn btn-success" href="javascript:void(0)"><i class="fa fa-check"></i> TERIMA</a>
							                    	&emsp;
							                    	<a class="btn btn-danger" href="javascript:void(0)" data-toggle="modal" data-target="#modalDeny"><i class="fa fa-ban"></i> TOLAK</a>
							                    </div>
							                <?php }else{

							                		if($transaksi['level'] == '3'){ ?>

							                			<span class="badge badge-success"><i class="fa fa-check-circle"></i> Diterima</span>
							                			<hr>
							                			<p class="text-muted">Keterangan</p>
							                			<?php echo $transaksi['keterangan'] ?>

							                <?php   }else{ ?>

							                			<span class="badge badge-danger"><i class="fa fa-ban"></i> Ditolak</span>
							                			<hr>
							                			<p class="text-muted">Keterangan</p>
							                			<?php echo $transaksi['keterangan_deny'] ?>

							                <?php   } 

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


<form action="<?php echo site_url('insert_pengeluaran_bop/'.$transaksi['id']) ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahBOP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
           	<div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> PENGGUNAAN BOP</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Transaksi</label>
                   <input type="text" name="kode_transaksi" id="kode" class="form-control" placeholder="Kode Jabatan" value="<?php echo $transaksi['kode_transaksi'];?>" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                	<div class="row">
                		<div class="col-md-6">
                			<label>Dana BOP</label><br>
                   			<h4><?php echo format_rp($transaksi['total_transaksi']) ?></h4>
                		</div>
                		<div class="col-md-6">
                			<label>Penggunaan</label><br>
                   			<h4><?php echo format_rp($total_penggunaan) ?></h4>
                		</div>
                	</div>
                </div>

                <div class="form-group">
                	<div class="row">
                		<div class="col-md-8">
                			<label>Nama Pengeluaran</label><br>
                   			<input type="text" name="nama_komponen" id="kode" class="form-control" placeholder="Nama Pengeluaran" autocomplete="off" required />
                		</div>
                		<div class="col-md-4">
                			<label>Nominal</label><br>
                   			<input type="text" name="subtotal" id="nominal" class="form-control rupiah" placeholder="Nominal" autocomplete="off" required />
                		</div>
                	</div>
                </div>

                <div class="form-group">
                	<label>Pencairan</label><br>
                	<div class="selectgroup selectgroup-secondary selectgroup-pills">
						<label class="selectgroup-item">
							<input type="radio" name="metode_pengeluaran" value="Cash" class="selectgroup-input m" checked="">
							<span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-money-bill-wave"></i> Cash</span>
						</label>
						<label class="selectgroup-item">
							<input type="radio" name="metode_pengeluaran" value="Transfer" class="selectgroup-input m">
							<span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-laptop"></i> Transfer</span>
						</label>
					</div>
                </div>

                <div class="form-group" id="rekBody">
                   <label>Pilih Rekening</label>
                   <select class="form-control" name="rek_id">
                   	<option value="">Pilih</option>
                   	<?php foreach ($rek as $row) { ?>
                   			<option value="<?php echo $row['id'] ?>"><?php echo $row['nama_bank']." - ".$row['no_rek']." a/n ".$row['atas_nama'] ?></option>
                    <?php } ?>
                   </select>
                </div>

                 <div class="form-group" id="rekBody">
                   <label>Keterangan</label>
                   <textarea class="form-control" name="keterangan_pengeluaran"></textarea>
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
   	$('#rekBody').hide();
   	var total_bop = <?php echo $transaksi['total_transaksi'] ?>;
   	var total_penggunaan = <?php echo $total_penggunaan ?>;


   	$(document).on('change', '.m', function(){
   		var val = $(this).val();

   		if(val == 'Transfer'){
   			$('#rekBody').show();
   		}else{
   			$('#rekBody').hide();
   		}
   	})

   	$(document).on('keyup', '#nominal', function(){
   		var nominal = format_angka($('#nominal').val());

   		var penggunaan = total_penggunaan + nominal;
   		if(penggunaan > total_bop){
   			alert('Tidak dapat melebihi Total BOP');
   			$('#nominal').val('').focus();
   		}

   	})
   </script>