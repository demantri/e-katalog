<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Keuangan</h4> &emsp; <small><b>Tabungan Siswa</b></small>
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
								<a href="#">Tabungan Siswa</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Tabungan Siswa</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<form method="GET">
										<div class="row">
											<div class="col-md-4">
												<label><b>Siswa</b></label><br>
												<select class="form-control" name="id">
													<option value="">Pilih</option>
													<?php foreach ($siswa as $row) { ?>
														<option <?php if($row['ak_siswa_id'] == $this->input->get('id')){ echo "selected='selected'"; } ?> value="<?php echo $row['ak_siswa_id'] ?>"><?php echo $row['nis']." - ".$row['nama_lengkap'] ?></option>
													<?php } ?>
												</select>
											</div>
											<div class="col-md-8">
												<br>
												<button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
											</div>
										</div>
									</form>

									<br>

									<?php if($this->input->get('id')){ ?>

											<button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahBOP"><i class="fa fa-plus"></i> Tambah Tabungan</button>
											<br><br>

											<div class="table-responsive">
												<table class="display table table-hover datatables" >
													<thead style="background-color: #eee">
														<tr>
															<th style="width: 5%">No</th>
															<th>Kode</th>
								                            <th>Tanggal Transaksi</th>
								                            <th>Total</th>
								                            <th>Keterangan</th>
														</tr>
													</thead>
													<tbody>
														<?php $n = 0;
								                          foreach ($list as $row) { $n++; ?>

								                            <tr>
								                              <td><?php echo $n ?></td>
								                              <td><?php echo $row['kode_transaksi'] ?></td>
					                                          <td><?php echo $row['tanggal_transaksi'] ?></td>
					                                          <td><?php echo format_rp($row['total_transaksi']) ?></td>
					                                          <td><?php echo $row['keterangan'] ?></td>
								                            </tr>

								                    <?php } ?>
													</tbody>
												</table>
											</div>

									<?php } ?>

								</div>
							</div>
						</div>


					</div>
				</div>



<form action="<?php echo site_url('insert_tabungan_siswa/'.$this->input->get('id')) ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahBOP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                 <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Tabungan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
             </div>

             <div class="modal-body">
             	<div class="form-group">
                   <label>Nominal</label>
                   <input autocomplete="off" type="text" readonly="" name="kode_transaksi" id="kode" class="form-control" value="<?php echo $last_code ?>" required />
                </div>

                <div class="form-group">
                   <label>Nominal</label>
                   <input autocomplete="off" type="text" name="total_transaksi" id="nama_ta" class="form-control rupiah" placeholder="Nominal..." required />
                </div>

                <div class="form-group">
                   <label>Tanggal</label>
                   <input autocomplete="off" type="text" name="tanggal_transaksi" class="form-control date-picker" placeholder="Tanggal..." required />
                </div>

                <div class="form-group">
                   <label>Keterangan</label>
                   <input autocomplete="off" type="text" name="keterangan" id="nama_ta" class="form-control" placeholder="Keterangan..." required />
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
    $(function() {
        $('.date-picker').datepicker({
          dateFormat : "yy-mm-dd"
        });
    });
</script>