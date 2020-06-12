<?php 

	if($tipe == 'in'){
		$title = 'Setoran';
	}else{
		$title = 'Penarikan';
	}

?>

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
								<a href="#"><?php echo $title ?></a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar <?php echo $title ?></h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<button data-toggle="modal" data-target="#modalTambahKTG" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah <?php echo $title ?></button>
              						<br><br>

									<div class="table-responsive">
										<table class="display table table-hover datatables" >
											<thead style="background-color: #eee">
												<tr>
													<th style="width: 5%">No</th>
													<th>Setoran</th>
													<th>Pemilik</th>
													<th>Rekening</th>
													<th class="text-center" style="width: 15%">Nominal</th>
													<th>Keterangan</th>
												</tr>
											</thead>
											<tbody>
												<?php $n = 0;
				                                  foreach ($list as $row) { $n++; ?>

				                                    <tr>
				                                      <td><?php echo $n ?></td>
				                                      <td><?php echo $row['kode_transaksi'] ?> <br> <?php echo $row['tanggal_transaksi'] ?></td>
				                                      <td><?php echo $row['nama_pemilik'] ?></td>
				                                      <td><?php echo $row['nama_bank']." - ".$row['no_rek']." a/n ".$row['atas_nama'] ?></td>
				                                      <td class="text-right"><?php echo format_rp($row['total_transaksi']) ?></td>
				                                      <td><?php echo $row['keterangan'] ?></td>
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

<form action="<?php echo site_url('insert_setoran/'.$tipe) ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahKTG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah <?php echo $title ?></h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode <?php echo $title ?></label>
                   <input type="text" value="<?php echo $last_code ?>" readonly name="kode_transaksi" id="" class="form-control" placeholder="Kode Setoran" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Pemilik</label>
                   <select class="form-control" name="pemilik_id">
                   	<option value="">Pilih</option>
                   	<?php foreach ($pemilik as $row){ ?>
                   			<option value="<?php echo $row['id'] ?>"><?php echo $row['nama_pemilik'] ?></option>
                   	<?php } ?>
                   </select>
                </div>

                <div class="form-group">
                   <label>Rekening</label>
                   <select class="form-control" name="rek_id">
                   	<option value="">Pilih</option>
                   	<?php foreach ($rek as $row){ ?>
                   			<option value="<?php echo $row['id'] ?>"><?php echo $row['nama_bank']." - ".$row['no_rek']." a/n ".$row['atas_nama'] ?></option>
                   	<?php } ?>
                   </select>
                </div>

                <div class="form-group">
                   <label>Nominal</label>
                   <input autocomplete="off" type="text" name="total_transaksi" id="" class="form-control rupiah" placeholder="Nominal (Rp)..." required/>
                </div>

                <div class="form-group">
                   <label>Keterangan</label>
                   <input autocomplete="off" type="text" name="keterangan" id="" class="form-control" placeholder=" Keterangan..." required/>
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
