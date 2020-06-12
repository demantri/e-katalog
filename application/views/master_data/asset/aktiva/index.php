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
								<a href="#">Aktiva</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Aktiva</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<button data-toggle="modal" data-target="#modalTambahAKT" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Aktiva</button>
              						<br><br>

									<div class="table-responsive">
										<table class="display table table-hover datatables" >
											<thead style="background-color: #eee">
												<tr>
													<th style="width: 5%">No</th>
													<th>Kode</th>
													<th>Nama Aktiva</th>
													<th>Kategori</th>
													<th class="text-center"><i class="fa fa-cog"></i></th>
												</tr>
											</thead>
											<tbody>
												<?php $n = 0;
						                          foreach ($list as $row) { $n++; ?>

						                            <tr>
						                              <td><?php echo $n ?></td>
						                              <td><?php echo $row['kode_aset'] ?></td>
						                              <td><?php echo $row['nama_aset'] ?></td>
						                              <td><?php echo $row['kode_kategori']." / ".$row['nama_kategori'] ?></td>

						                              <td class="text-center">
						                                  <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
						                                          onclick="
						                                            edit(
						                                              '<?php echo $row['id_aset'] ?>',
						                                              '<?php echo $row['kode_aset'] ?>',
						                                              '<?php echo $row['nama_aset'] ?>',
						                                              '<?php echo $row['id_kategori'] ?>'
						                                            )">
						                                      <i class="fa fa-edit"></i>
						                                  </a>

						                                  &nbsp;

						                                  <a href="<?php echo site_url('master_data/asset/aktiva/detail/'.$row['id_aset']) ?>" data-toggle="tooltip" title="Lihat Detail" class="text-info">
						                                    <i class="fa fa-search"></i>
						                                  </a>

						                                  &nbsp;

						                                  <a onclick="return confirm('Hapus data ini ?')" href="<?php echo site_url('delete_aktiva/'.$row['id_aset']) ?>" data-toggle="tooltip" title="Hapus" class="text-danger">
						                                    <i class="fa fa-trash"></i>
						                                  </a>
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

<form action="<?php echo site_url('insert_aktiva') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahAKT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Aktiva</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Aktiva</label>
                   <input type="text" name="kode_aset" id="kode" class="form-control" placeholder="Kode Jabatan" value="<?php echo $last_code;?>" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama Aktiva</label>
                   <input autocomplete="off" type="text" name="nama_aset" id="nama" class="form-control" placeholder="Nama Aktiva..." required/>
                </div>

                <div class="form-group">
                   <label>Kategori</label>
                   <select class="form-control" required="" name="kategori_id">
                   		<option value="">Pilih</option>
                   		<?php foreach ($kategori as $row){ ?>
                   					<option value="<?php echo $row['id'] ?>"><?php echo $row['nama_kategori'] ?></option>
                   		<?php } ?>
                   </select>
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