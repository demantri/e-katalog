<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Master Data</h4> &emsp; <small><b>Human Resource</b></small>
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
								<a href="#">lembur</a>
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
													<th>Jumlah Lembur (Jam)</th>
													<th class="text-center">Nominal</th>
													<th class="text-center"><i class="fa fa-cog"></i></th>
												</tr>
											</thead>
											<tbody>
												<?php $n = 0;
						                          foreach ($list as $row) { $n++; ?>

						                            <tr>
						                              <td><?php echo $n ?></td>
						                              <td><?php echo $row['jml'] ?></td>
						                              <td class="text-right"><?php echo format_rp($row['nominal']) ?></td>

						                              <td class="text-center">
						                                  <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
						                                          onclick="
						                                            edit(
						                                              '<?php echo $row['id'] ?>',
						                                              '<?php echo $row['jml'] ?>',
						                                              '<?php echo $row['nominal'] ?>'
						                                            )">
						                                      <i class="fa fa-edit"></i>
						                                  </a>
						                                  &nbsp;
						                                  <a onclick="return confirm('Hapus data ini ?')" href="<?php echo site_url('delete_tunjangan/tunjangan/'.$row['id']) ?>" data-toggle="tooltip" title="Hapus" class="text-danger">
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

<form action="<?php echo site_url('insert_tunjangan') ?>" method="post" enctype="multipart/form-data">
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
                   <label>Total Jam Lembur</label>
                   <input autocomplete="off" type="text" name="jml" id="nama" class="form-control" placeholder="Total Jam Lembur..." required/>
                </div>

                <div class="form-group">
                   <label>Nominal</label>
                   <input autocomplete="off" type="text" name="nominal" id="gaji" class="form-control rupiah" placeholder="Nominal (Rp)..." required/>
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

   <form action="<?php echo site_url('update_tunjangan') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditKTG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Lembur</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <input type="hidden" name="id_tunjangan" id="e_id">

             <div class="modal-body">

                <div class="form-group">
                   <label>Total Jam Lembur</label>
                   <input autocomplete="off" type="text" name="jml" id="e_jml" class="form-control" placeholder="Nama Lembur..." required/>
                </div>

                <div class="form-group">
                   <label>Nominal</label>
                   <input autocomplete="off" type="text" name="nominal" id="e_nominal" class="form-control rupiah" placeholder="Nominal (Rp)..." required/>
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
 function edit(id, jml, nominal){
  $('#e_id').val(id);
  $('#e_jml').val(jml);
  $('#e_nominal').val(format_rp(nominal));

  $('#modalEditKTG').modal('show'); 
}
</script>