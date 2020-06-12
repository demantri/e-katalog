<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Transaksi</h4> &emsp; <small><b>Gaji</b></small>
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
								<a href="#">HR</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="#">Lembur</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Lembur</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<button data-toggle="modal" data-target="#modalTambahKTG" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Lembur</button>
              						<br><br>

									<div class="table-responsive">
										<table class="display table table-hover datatables" >
											<thead style="background-color: #eee">
												<tr>
													<th style="width: 5%">No</th>
													<th>Karyawan</th>
													<th>Jumlah Lembur (Jam)</th>
													<th>Tanggal</th>
													<th class="text-center">Nominal</th>
												</tr>
											</thead>
											<tbody>
												<?php $n = 0;
						                          foreach ($list as $row) { $n++; ?>

						                            <tr>
						                              <td><?php echo $n ?></td>
						                              <td><?php echo $row['kode_karyawan']." / ".$row['nama_karyawan'] ?></td>
						                              <td><?php echo $row['total_jam'] ?></td>
						                              <td><?php echo $row['tanggal'] ?></td>
						                              <td class="text-right"><?php echo format_rp($row['nominal_lembur']) ?></td>

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

<form action="<?php echo site_url('insert_lembur') ?>" method="post" enctype="multipart/form-data">
	 <input type="hidden" name="tipe" value="lembur">
     <div class="modal fade" id="modalTambahKTG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Lembur</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <div class="modal-body">

                <div class="form-group">
                   <label>Karyawan</label>
                   <select required="" class="form-control" name="karyawan_id">
                   	<option value="">Pilih</option>
                   	<?php foreach ($karyawan as $row) { ?>
                   		<option value="<?php echo $row['karyawan_id'] ?>"><?php echo $row['nama_karyawan'] ?></option>
                   	<?php } ?>
                   </select>
                </div>

                <div class="form-group">
                   <label>Total Jam Lembur</label>
                   <input autocomplete="off" type="text" name="jml_lembur" id="nama" class="form-control" placeholder="Total Jam Lembur..." required/>
                </div>

                <div class="form-group">
                   <label>Tanggal</label>
                   <input autocomplete="off" type="text" name="tgl" id="nama" class="form-control datepicker" placeholder="Tanggal Lembur..." required/>
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
