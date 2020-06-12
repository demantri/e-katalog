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
								<a href="#">Chart Of Account</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar COA</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<button data-toggle="modal" data-target="#modalTambahKTG" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah COA</button>
              						<br><br>

									<div class="table-responsive">
										<table class="display table table-hover datatables" >
											<thead style="background-color: #eee">
												<tr>
													<th style="width: 5%">No</th>
													<th>Kode</th>
													<th>Nama Akun</th>
													<th class="text-center"><i class="fa fa-cog"></i></th>
												</tr>
											</thead>
											<tbody>
												<?php $n = 0;
				                                  foreach ($list as $row) { $n++; ?>

				                                    <tr>
				                                      <td><?php echo $n ?></td>
				                                      <td style="width: 15%"><?php echo $row['kode_coa'] ?></td>
				                                      <td><?php echo $row['nama_coa'] ?></td>

				                                      <td style="width: 15%" class="text-center">
				                                          <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
				                                                  onclick="
				                                                    edit(
				                                                      '<?php echo $row['id'] ?>',
				                                                      '<?php echo $row['kode_coa'] ?>',
				                                                      '<?php echo $row['nama_coa'] ?>'
				                                                    )">
				                                              <i class="fa fa-edit"></i>
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

<form action="<?php echo site_url('insert_coa') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahKTG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah COA</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode COA</label>
                   <input type="text" name="kode_coa" id="" class="form-control" placeholder="Kode COA" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama COA</label>
                   <input autocomplete="off" type="text" name="nama_coa" id="" class="form-control" placeholder="Nama COA..." required/>
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

   <form action="<?php echo site_url('update_coa') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditKTG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah COA</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <input type="hidden" name="id_coa" id="e_id">

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode COA</label>
                   <input type="text" name="kode_coa" id="e_kode" class="form-control" placeholder="Kode COA" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama COA</label>
                   <input autocomplete="off" type="text" name="nama_coa" id="e_nama" class="form-control" placeholder="Nama COA..." required/>
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
 function edit(id, kode, nama){
  $('#e_id').val(id);
  $('#e_kode').val(kode);
  $('#e_nama').val(nama);

  $('#modalEditKTG').modal('show'); 
}
</script>