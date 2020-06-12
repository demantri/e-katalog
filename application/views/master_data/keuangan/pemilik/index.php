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
								<a href="#">Pemilik</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Pemilik</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<button data-toggle="modal" data-target="#modalTambahKTG" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah pemilik</button>
              						<br><br>

									<div class="table-responsive">
										<table class="display table table-hover datatables" >
											<thead style="background-color: #eee">
												<tr>
													<th style="width: 5%">No</th>
													<th>Nama</th>
													<th>No Telp</th>
													<th>Alamat</th>
													<th>Rekening</th>
													<th class="text-center"><i class="fa fa-cog"></i></th>
												</tr>
											</thead>
											<tbody>
												<?php $n = 0;
				                                  foreach ($list as $row) { $n++; ?>

				                                    <tr>
				                                      <td><?php echo $n ?></td>
				                                      <td style="width: 15%"><?php echo $row['nama_pemilik'] ?></td>
				                                      <td><?php echo $row['no_hp'] ?></td>
				                                      <td><?php echo $row['alamat'] ?></td>
				                                      <td><?php echo $row['p_bank']." - ".$row['p_no_rek']." a/n ".$row['p_an'] ?></td>

				                                      <td style="width: 15%" class="text-center">
				                                          <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
				                                                  onclick="
				                                                    edit(
				                                                      '<?php echo $row['id'] ?>',
				                                                      '<?php echo $row['nama_pemilik'] ?>',
				                                                      '<?php echo $row['no_hp'] ?>',
				                                                      '<?php echo $row['alamat'] ?>',
				                                                      '<?php echo $row['p_bank'] ?>',
				                                                      '<?php echo $row['p_no_rek'] ?>',
				                                                      '<?php echo $row['p_an'] ?>'
				                                                    )">
				                                              <i class="fa fa-edit"></i>
				                                          </a>

				                                          &nbsp;

				                                          <a onclick="return confirm('Hapus data ini ?')" href="<?php echo site_url('delete_pemilik/'.$row['id']) ?>" data-toggle="tooltip" title="Hapus" class="text-danger">
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

<form action="<?php echo site_url('insert_pemilik') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahKTG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah pemilik</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <div class="modal-body">
                <div class="form-group">
                   <label>Nama pemilik</label>
                   <input autocomplete="off" type="text" name="nama_pemilik" id="" class="form-control" placeholder="Nama pemilik..." required/>
                </div>

                <div class="form-group">
                   <label>No Hp</label>
                   <input type="text" name="no_hp" id="" class="form-control" placeholder="No Hp..." autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Alamat</label>
                   <input type="text" name="alamat" id="" class="form-control" placeholder="Alamat..." autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama Bank</label>
                   <input type="text" name="p_bank" id="" class="form-control" placeholder="Nama Bank..." autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>No Rek</label>
                   <input type="text" name="p_no_rek" id="" class="form-control" placeholder="No Rekening..." autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Atas Nama</label>
                   <input type="text" name="p_an" id="" class="form-control" placeholder="Atas Nama..." autocomplete="off" required />
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

   <form action="<?php echo site_url('update_pemilik') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditKTG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah pemilik</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <input type="hidden" name="id_pemilik" id="e_id">

             <div class="modal-body">
                

                <div class="form-group">
                   <label>Nama pemilik</label>
                   <input autocomplete="off" type="text" name="nama_pemilik" id="e_nama" class="form-control" placeholder="Nama pemilik..." required/>
                </div>

                <div class="form-group">
                   <label>No Hp</label>
                   <input type="text" name="no_hp" id="e_no_telp" class="form-control" placeholder="No Hp..." autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Alamat</label>
                   <input type="text" name="alamat" id="e_alamat" class="form-control" placeholder="Alamat..." autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama Bank</label>
                   <input type="text" name="p_bank" id="e_bank" class="form-control" placeholder="Nama Bank..." autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>No Rek</label>
                   <input type="text" name="p_no_rek" id="e_no_rek" class="form-control" placeholder="No Rekening..." autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Atas Nama</label>
                   <input type="text" name="p_an" id="e_atas_nama" class="form-control" placeholder="Atas Nama..." autocomplete="off" required />
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
 function edit(id, nama, telp, alamat, bank, no_rek, an){
  $('#e_id').val(id);
  $('#e_no_telp').val(telp);
  $('#e_nama').val(nama);
  $('#e_alamat').val(alamat);
  $('#e_bank').val(bank);
  $('#e_no_rek').val(no_rek);
  $('#e_atas_nama').val(an);

  $('#modalEditKTG').modal('show'); 
}
</script>