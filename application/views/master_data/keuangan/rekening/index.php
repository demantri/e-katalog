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
								<a href="#">Rekening</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Rekening</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<button data-toggle="modal" data-target="#modalTambahKTG" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Rekening</button>
              						<br><br>

									<div class="table-responsive">
										<table class="display table table-hover datatables" >
											<thead style="background-color: #eee">
												<tr>
													<th style="width: 5%">No</th>
													<th>Kode</th>
													<th>Nama Bank</th>
													<th>Nomor Rekening</th>
													<th>Atas Nama</th>
													<th class="text-center"><i class="fa fa-cog"></i></th>
												</tr>
											</thead>
											<tbody>
												<?php $n = 0;
						                          foreach ($list as $row) { $n++; ?>

						                            <tr>
						                              <td><?php echo $n ?></td>
						                              <td><?php echo $row['kode_rek'] ?></td>
						                              <td><?php echo $row['nama_bank'] ?></td>
						                              <td><?php echo $row['no_rek'] ?></td>
						                              <td><?php echo $row['atas_nama'] ?></td>

						                              <td class="text-center">
						                                  <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
						                                          onclick="
						                                            edit(
						                                              '<?php echo $row['id'] ?>',
						                                              '<?php echo $row['kode_rek'] ?>',
						                                              '<?php echo $row['nama_bank'] ?>',
						                                              '<?php echo $row['no_rek'] ?>',
						                                              '<?php echo $row['atas_nama'] ?>'
						                                            )">
						                                      <i class="fa fa-edit"></i>
						                                  </a>
						                                  &nbsp;
						                                  <a href="<?php echo site_url('master_data/keuangan/rekening/detail/'.$row['id']) ?>" data-toggle="tooltip" title="Lihat Detail" class="text-info">
						                                    <i class="fa fa-search"></i>
						                                  </a>
						                                  &nbsp;
						                                  <a onclick="return confirm('Hapus data ini ?')" href="<?php echo site_url('delete_rekening/'.$row['id']) ?>" data-toggle="tooltip" title="Hapus" class="text-danger">
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

<form action="<?php echo site_url('insert_rekening') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahKTG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Rekening</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Rekening</label>
                   <input type="text" name="kode_rek" id="kode" class="form-control" placeholder="Kode Rekening" value="<?php echo $last_code;?>" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama Bank</label>
                   <input autocomplete="off" type="text" name="nama_bank" id="nama_bank" class="form-control" placeholder="Nama Bank..." required/>
                </div>

                <div class="form-group">
                   <label>Nomor Rekening</label>
                   <input autocomplete="off" type="text" name="no_rek" id="no_rel" class="form-control" placeholder="Nomor Rekening..." required/>
                </div>

                <div class="form-group">
                   <label>Pemilik Kartu</label>
                   <input autocomplete="off" type="text" name="atas_nama" id="atas_nama" class="form-control" placeholder="Pemilik Kartu..." required/>
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

   <form action="<?php echo site_url('update_rekening') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditKTG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <input type="hidden" name="id_rekening" id="e_id">

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Kategori</label>
                   <input type="text" name="kode_rek" id="e_kode" class="form-control" placeholder="Kode Kategori..." value="<?php echo $last_code;?>" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama Bank</label>
                   <input autocomplete="off" type="text" name="nama_bank" id="e_nama" class="form-control" placeholder="Nama Bank..." required/>
                </div>

                <div class="form-group">
                   <label>Nomor Rekening</label>
                   <input autocomplete="off" type="text" name="no_rek" id="e_rek" class="form-control" placeholder="Nomor Rekening..." required/>
                </div>

                <div class="form-group">
                   <label>Pemilik Kartu</label>
                   <input autocomplete="off" type="text" name="atas_nama" id="e_atas_nama" class="form-control" placeholder="Pemilik Kartu..." required/>
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
 function edit(id, kode, nama, no_rek, atas_nama){
  $('#e_id').val(id);
  $('#e_kode').val(kode);
  $('#e_nama').val(nama);
  $('#e_rek').val(no_rek);
  $('#e_atas_nama').val(atas_nama);
  $('#modalEditKTG').modal('show'); 
}
</script>