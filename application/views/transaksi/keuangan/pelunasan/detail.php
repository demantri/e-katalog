<?php 
	
	if($page == 'utang'){
		$title = 'Utang';
	}else{
		$title = 'Piutang';
	}

?>


<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Pelunasan</h4> &emsp; <small><b><?php echo $title ?></b></small>
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
								<a href="#">Pelunasan</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="<?php echo site_url('transaksi/keuangan/pelunasan/'.$page); ?>"><?php echo $title ?></a>
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
											<a href="<?php echo site_url('transaksi/keuangan/pelunasan/'.$page) ?>" class="btn btn-primary btn-border btn-flat pull-left"><i class="fa fa-chevron-left"></i> KEMBALI</a>

											&emsp;

											<a data-toggle="modal" data-target="#modalPembayaran" href="javascript:void(0)" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> TAMBAH PEMBAYARAN</a>
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
						                        <b><?php echo $transaksi['tipe'] ?></b>
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
						                          <?php $n = $grandTotal = 0;  $status = false;
						                                foreach ($pembayaran as $row) { $n++;

						                                	if($transaksi['tipe'] == 'pinjaman'){
						                                		if($n >=2){
						                                			$status = true;
						                                			$grandTotal += $row['jumlah_bayar'];
						                                		}
						                                	}else{
						                                		$status = true;
						                                		$grandTotal += $row['jumlah_bayar'];
						                                	}

						                                	if($status){

						                                ?>

						                                  <tr>
						                                    <td><?php echo $n ?></td>
						                                    <td><?php echo $row['tanggal_bayar'] ?> <br> <small>Keterangan : <?php echo $row['keterangan_pembayaran'] ?></small></td>
						                                    <td class="text-right"><?php echo format_rp($row['jumlah_bayar']) ?></td>
						                                  </tr>

						                          <?php } } ?>

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

						              <div class="row">
						              	<div class="col-md-12">
						              		<div class="card">
						                      <div class="card-header"><img style="width: 25px" src="<?php echo base_url('assets/img/icon/barang.png') ?>"> &nbsp;<b>DAFTAR BARANG</b></div>
						                    </div>

						                     <div class="table-responsive">
						                      <table class="table">
						                        <thead style="background-color:#eee">
						                          <tr>
						                            <th>PRODUK</th>
						                            <th style="width: 10%">JUMLAH</th>
						                            <th style="width: 25%">SUBTOTAL</th>
						                          </tr>
						                        </thead>

						                        <tbody id="tableItem">
						                          <?php $n = $grandTotal = 0; 
						                                foreach ($item as $row) { $n++; $grandTotal += $row['subtotal']?>

						                                  <tr>
						                                    <td><?php echo $row['komponen'] ?></td>
						                                    <td><?php echo $row['qty'] ?></td>
						                                    <td class="text-right"><?php echo format_rp($row['subtotal']) ?></td>
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


<form action="<?php echo site_url('insert_pembayaran/'.$page.'/'.$transaksi['id']) ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalPembayaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           	<div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> PERSETUJUAN</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

             <div class="modal-body">

                <div class="form-group">
                	<div class="row">
	                	<div class="col-md-4">
	                		<b>Total Transaksi</b>
	                		<h4><?php echo format_rp($transaksi['total_transaksi']) ?></h4>
	                	</div>
	                   	<div class="col-md-4">
	                		<b>Sisa Bayar</b>
	                		<h4><?php echo format_rp($transaksi['sisa_bayar']) ?></h4>
	                	</div>
	                	<div class="col-md-4">
	                		<b>Sudah Bayar</b>
	                		<h4><?php echo format_rp($transaksi['total_bayar']) ?></h4>
	                	</div>
	                </div>
                   
                </div>

                <div class="form-group">
                	<div class="row">
                		<div class="col-md-6">
                			<label><b>Nominal Pelunasan</b></label>
                			<input type="text" class="form-control rupiah" name="jumlah_bayar" required="" autocomplete="off" placeholder="Nominal (Rp)" id="nominal">
                		</div>
                		<div class="col-md-6">
                			<label><b>Sisa</b></label>
                			<input id="sisa_bayar" type="text" class="form-control rupiah" disabled="" value="<?php echo format_rp($transaksi['sisa_bayar']) ?>" autocomplete="off">
                		</div>
                	</div>
                </div>

                 <div class="form-group">
                   <label>Keterangan</label>
                   <textarea class="form-control" name="keterangan_pembayaran" placeholder="Keterangan..."></textarea>
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
   		var sisa_bayar = parseInt(<?php echo $transaksi['sisa_bayar'] ?>);

   		$(document).on('keyup keypress', '#nominal', function(){
   			var nominal = format_angka($(this).val());
   			total = sisa_bayar - nominal;
   			if(total < 0){
   				alert('Nominal Pembayaran tidak boleh melebihi sisa bayar');
   				$('#sisa_bayar').val(format_rp(sisa_bayar));
   				$('#nominal').val('');

   			}else{
   				$('#sisa_bayar').val(format_rp(total));
   			}
   		})
   </script>