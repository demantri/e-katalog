<!-- coba update -->

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
								<a href="<?php echo site_url('transaksi/keuangan/cash_out'); ?>">Pendanaan</a>
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

									<div class="row">
										<div class="col-md-12">
											<a href="<?php echo site_url('transaksi/keuangan/cash_out') ?>" class="btn btn-primary btn-border btn-flat pull-left"><i class="fa fa-chevron-left"></i> KEMBALI</a>

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
						                      <div class="card-header"><img style="width: 25px" src="<?php echo base_url('assets/img/icon/barang.png') ?>"> &nbsp;<b>DAFTAR BEBAN</b></div>
						                    </div>

						                     <div class="table-responsive">
						                      <table class="table">
						                        <thead style="background-color:#eee">
						                          <tr>
						                            <th>NO</th>
						                            <th>PRODUK</th>
						                            <th>KETERANGAN</th>
						                            <!-- <th style="width: 10%">JUMLAH</th> -->
						                            <th style="width: 25%">SUBTOTAL</th>
						                          </tr>
						                        </thead>

						                        <tbody id="tableItem">
						                          <?php $n = $grandTotal = 0; $i= 1; 
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
							                <?php if($transaksi['level'] == '2' && $transaksi['tipe'] != 'undur_diri'){ ?>
							                    	<a data-toggle="modal" data-target="#modalApprove" class="btn btn-success" href="javascript:void(0)"><i class="fa fa-check"></i> TERIMA</a>
							                    	&emsp;
							                    	<a class="btn btn-danger" href="javascript:void(0)" data-toggle="modal" data-target="#modalDeny"><i class="fa fa-ban"></i> TOLAK</a>
							                    </div>
							                <?php }else if($transaksi['tipe'] == 'undur_diri'){ ?>

							                	<a data-toggle="modal" data-target="#modalApprove" class="btn btn-success" href="javascript:void(0)"><i class="fa fa-check"></i> TERIMA</a>

							                <?php }else{ 

							                		if($transaksi['level'] == '3'){ ?>

							                			<span class="badge badge-success"><i class="fa fa-check-circle"></i> Diterima</span>
							                			<hr>
							                			<p class="text-muted">Keterangan</p>
							                			<?php echo $transaksi['keterangan_acc'] ?>

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


<form action="<?php echo site_url('insert_approve_keuangan/approve/'.$transaksi['id']) ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalApprove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           	<div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> PERSETUJUAN</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Transaksi</label>
                   <input type="text" name="kode_kategori" id="kode" class="form-control" placeholder="Kode Jabatan" value="<?php echo $transaksi['kode_transaksi'];?>" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nominal</label><br>
                   <h4><?php if($transaksi['tipe'] != 'pinjaman'){ echo format_rp($transaksi['total_bayar']); }else{ echo format_rp($transaksi['total_transaksi']);  } ?></h4>
                </div>

                <div class="form-group">
                	<label>Pencairan</label><br>
                	<div class="selectgroup selectgroup-secondary selectgroup-pills">
                		<?php if($transaksi['metode'] == 'Cash'){ ?>
                				<label class="selectgroup-item">
									<input type="radio" name="metode" value="Cash" class="selectgroup-input m" checked="">
									<span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-money-bill-wave"></i> Cash</span>
								</label>

                		<?php }else{ ?>

                				<label class="selectgroup-item">
									<input type="radio" name="metode" value="Transfer" class="selectgroup-input m" checked="">
									<span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-laptop"></i> Transfer</span>
								</label>

                		<?php } ?>
						
						
					</div>
                </div>

                <?php if($transaksi['metode'] == 'Transfer'){ ?>

                		<div class="form-group" id="rekBody">
		                   <label>Pilih Rekening</label>
		                   <select class="form-control" name="rek_id">
		                   	<option value="">Pilih</option>
		                   	<?php foreach ($rek as $row) { ?>
		                   			<option value="<?php echo $row['id'] ?>"><?php echo $row['nama_bank']." - ".$row['no_rek']." a/n ".$row['atas_nama'] ?></option>
		                    <?php } ?>
		                   </select>
		                </div>

                <?php } ?>

                 <div class="form-group" id="rekBody">
                   <label>Keterangan</label>
                   <textarea class="form-control" name="keterangan"></textarea>
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

   <form action="<?php echo site_url('insert_approve_keuangan/deny/'.$transaksi['id']) ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalDeny" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           	<div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> PENOLAKAN</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

             <div class="modal-body">

                 <div class="form-group" id="rekBody">
                   <label>Keterangan Penolakan</label>
                   <textarea class="form-control" name="keterangan"></textarea>
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

   	<?php if($transaksi['metode'] == 'Cash'){ ?>
   			$('#rekBody').hide();
   	<?php }else{ ?>
   			$('#rekBody').show();
   	<?php } ?>

   	$(document).on('change', '.m', function(){
   		var val = $(this).val();

   		if(val == 'Transfer'){
   			$('#rekBody').show();
   		}else{
   			$('#rekBody').hide();
   		}
   	})
   </script>