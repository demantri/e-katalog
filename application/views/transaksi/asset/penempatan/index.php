<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Asset</h4> &emsp; <small><b>Penempatan Asset</b></small>
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
								<a href="#">Penempatan Asset</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Penempatan</h4>
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
												<label>Aktiva</label>
												<select required="" class="form-control" name="aset_id">
													<option value="">Pilih</option>
													<?php foreach ($aktiva as $row) { ?>
															<option <?php if($row['id_aset'] == $this->input->get('aset_id')){ echo "selected='selected'"; } ?> value="<?php echo $row['id_aset'] ?>"><?php echo $row['kode_aset']." / ".$row['nama_aset'] ?></option>
													<?php } ?>
												</select>
											</div>

											<div class="col-md-1">
												<br>
												<button style="margin-top: 4px" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
											</div>

										</div>
									</form>

									<?php if($this->input->get('aset_id')){ ?>

									<br>

									<form method="POST" action="<?php echo site_url('insert_asset_location/'.$this->input->get('aset_id')) ?>">

										<div class="table-responsive">
											<table class="display table table-hover datatables" >
												<thead style="background-color: #eee">
													<tr>
														<th style="width: 5%">No</th>
														<th>Aktiva</th>
														<th class="text-center" style="width: 5%">Pilih</th>
													</tr>
												</thead>
												<tbody>
													<?php 

													  $n = 0;
							                          foreach ($list as $row) { $n++; ?>

							                          	<tr>
							                          		<td><?php echo $n ?></td>
							                          		<td><?php echo $row['kode_detail_aset']." / ".$row['nama_aset'] ?></td>
							                          		<td class="text-center">
							                          			<div class="custom-control custom-checkbox">
																	<input name="detail_aset[]" type="checkbox" class="custom-control-input" value="<?php echo $row['aset_detail_id'] ?>" id="customCheck<?php echo $n ?>">
																	<label class="custom-control-label" for="customCheck<?php echo $n ?>"></label>
																</div>
							                          		</td>
							                          	</tr>

							                    	<?php } ?>
												</tbody>
											</table>
										</div>

										<br>

										<div class="row">

							                <div class="col-md-4">
							                	<div class="form-group">
								                   <label>Lokasi</label>
								                   <select class="form-control" required="" name="lokasi_id">
								                   		<option value="">Pilih</option>
								                   		<?php foreach ($lokasi as $row){ ?>
								                   					<option value="<?php echo $row['id'] ?>"><?php echo $row['kode_lokasi']." / ".$row['nama_lokasi'] ?></option>
								                   		<?php } ?>
								                   </select>
								                </div>
							                </div>

							                <div class="col-md-3">
							                	<br>
							                	<button class="btn btn-success shadow mt-3"><i class="fa fa-plus"></i> <i class="fas fa-truck-loading"></i> Simpan</button>
							                </div>
										</div>
									</form>

									<br>

									<?php } ?>

								</div>
							</div>
						</div>


					</div>

   <form action="<?php echo site_url('update_aktiva') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditAKT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Aktiva</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <input type="hidden" name="id_aset" id="e_id">

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Aktiva</label>
                   <input type="text" name="kode_aset" id="e_kode" class="form-control" placeholder="Kode Aktiva" value="<?php echo $last_code;?>" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama Aktiva</label>
                   <input autocomplete="off" type="text" name="nama_aset" id="e_nama" class="form-control" placeholder="Nama Aktiva..." required/>
                </div>

                <div class="form-group">
                   <label>Kategori</label>
                   <select class="form-control" required="" name="kategori_id" id="kategori">
                   		<option value="">Pilih</option>
                   		<?php foreach ($kategori as $row){ ?>
                   					<option value="<?php echo $row['id'] ?>"><?php echo $row['nama_kategori'] ?></option>
                   		<?php } ?>
                   </select>
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
 function edit(id, kode, nama, id_kategori){
  $('#e_id').val(id);
  $('#e_kode').val(kode);
  $('#e_nama').val(nama);

  $('#kategori option').removeAttr('selected');
  $('#kategori option[value="'+id_kategori+'"]').attr('selected','selected');

  $('#modalEditAKT').modal('show'); 
}
</script>