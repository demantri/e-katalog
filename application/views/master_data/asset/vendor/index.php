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
								<a href="#">Vendor</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Vendor</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<button data-toggle="modal" data-target="#modalTambahKTG" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Vendor</button>
              						<br><br>

									<div class="table-responsive">
										<table class="display table table-hover datatables" >
											<thead style="background-color: #eee">
												<tr>
													<th style="width: 5%">No</th>
													<th>Kode</th>
													<th style="width: 25%">Nama / Username</th>
													<th style="width: 25%">Alamat / No Telp</th>
													<th>Keterangan</th>
													<th class="text-center"><i class="fa fa-cog"></i></th>
												</tr>
											</thead>
											<tbody>
												<?php $n = 0;
						                          foreach ($list as $row) { $n++; ?>

						                            <tr>
						                              <td><?php echo $n ?></td>
						                              <td><?php echo $row['kode_vendor'] ?></td>
						                              <td><?php echo $row['nama_vendor'] ?><br><small>User : <?php echo $row['username'] ?> <hr>
                                            <?php echo $row['v_bank']." - ".$row['v_no_rek']." a/n ".$row['v_an'] ?>
                                          </small></td>
						                              <td>
						                              	<?php echo $row['alamat'] ?><br>
						                              	<small><?php echo $row['no_telp'] ?></small>
						                              </td>
						                              <td><?php echo $row['keterangan'] ?></td>

						                              <td class="text-center">
						                                  <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
						                                          onclick="
						                                            edit(
						                                              '<?php echo $row['id'] ?>',
						                                              '<?php echo $row['kode_vendor'] ?>',
						                                              '<?php echo $row['nama_vendor'] ?>',
						                                              '<?php echo $row['no_telp'] ?>',
						                                              '<?php echo $row['alamat'] ?>',
						                                              '<?php echo $row['keterangan'] ?>',
						                                              '<?php echo $row['username'] ?>',
						                                              '<?php echo $row['password'] ?>',
                                                          '<?php echo $row['v_bank'] ?>',
                                                          '<?php echo $row['v_no_rek'] ?>',
                                                          '<?php echo $row['v_an'] ?>'
						                                            )">
						                                      <i class="fa fa-edit"></i>
						                                  </a>
						                                  &nbsp;
						                                  <a onclick="return confirm('Hapus data ini ?')" href="<?php echo site_url('delete_vendor/'.$row['id']) ?>" data-toggle="tooltip" title="Hapus" class="text-danger">
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

<form action="<?php echo site_url('insert_vendor') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahKTG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Vendor</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Vendor</label>
                   <input type="text" name="kode_vendor" id="kode_vendor" class="form-control" placeholder="Kode Vendor..." value="<?php echo $last_code;?>" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama Vendor</label>
                   <input autocomplete="off" type="text" name="nama_vendor" id="nama_vendor" class="form-control" placeholder="Nama Vendor..." required/>
                </div>

                <div class="form-group">
                   <label>Alamat</label>
                   <input autocomplete="off" type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat..." required/>
                </div>

                <div class="form-group">
                   <label>No. Telp</label>
                   <input autocomplete="off" type="text" name="no_telp" id="no_telp" class="form-control" placeholder="No Telepon..." required/>
                </div>

                <div class="form-group">
                   <label>Keterangan (Optional)</label>
                   <input autocomplete="off" type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan...">
                </div>

                <div class="form-group">
                   <label>Username</label>
                   <input autocomplete="off" type="text" name="username" id="username" class="form-control" placeholder="Username..." required/>
                </div>

                <div class="form-group">
                   <label>Password</label>
                   <input autocomplete="off" type="password" name="password" id="password" class="form-control" placeholder="Password..." required/>
                </div>

                <div class="form-group">
                   <label>Nama Bank</label>
                   <input type="text" name="v_bank" id="" class="form-control" placeholder="Nama Bank..." autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>No Rek</label>
                   <input type="text" name="v_no_rek" id="" class="form-control" placeholder="No Rekening..." autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Atas Nama</label>
                   <input type="text" name="v_an" id="" class="form-control" placeholder="Atas Nama..." autocomplete="off" required />
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

   <form action="<?php echo site_url('update_vendor') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditKTG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Vendor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <input type="hidden" name="id_vendor" id="e_id">

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Supplier</label>
                   <input type="text" name="kode_vendor" id="e_kode" class="form-control" placeholder="Kode Supplier" value="<?php echo $last_code;?>" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama Supplier</label>
                   <input autocomplete="off" type="text" name="nama_vendor" id="e_nama" class="form-control" placeholder="Nama Vendor..." required/>
                </div>

                <div class="form-group">
                   <label>Alamat</label>
                   <input autocomplete="off" type="text" name="alamat" id="e_alamat" class="form-control" placeholder="Alamat..." required/>
                </div>

                <div class="form-group">
                   <label>No. Telp</label>
                   <input autocomplete="off" type="text" name="no_telp" id="e_telp" class="form-control" placeholder="No Telepon..." required/>
                </div>

                <div class="form-group">
                   <label>Keterangan (Optional)</label>
                   <input autocomplete="off" type="text" name="keterangan" id="e_keterangan" class="form-control" placeholder="Keterangan...">
                </div>

                <div class="form-group">
                   <label>Username</label>
                   <input autocomplete="off" type="text" name="username" id="e_username" class="form-control" placeholder="Username..." required/>
                </div>

                <div class="form-group">
                   <label>Password</label>
                   <input autocomplete="off" type="password" name="password" id="e_password" class="form-control" placeholder="Password..." required/>
                </div>

                <div class="form-group">
                   <label>Nama Bank</label>
                   <input type="text" name="v_bank" id="e_bank" class="form-control" placeholder="Nama Bank..." autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>No Rek</label>
                   <input type="text" name="v_no_rek" id="e_no_rek" class="form-control" placeholder="No Rekening..." autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Atas Nama</label>
                   <input type="text" name="v_an" id="e_atas_nama" class="form-control" placeholder="Atas Nama..." autocomplete="off" required />
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
 function edit(id, kode, nama, telp, alamat, keterangan, username, password, bank, no_rek, an){
  $('#e_id').val(id);
  $('#e_kode').val(kode);
  $('#e_nama').val(nama);

  $('#e_telp').val(telp);
  $('#e_alamat').val(alamat);
  $('#e_keterangan').val(keterangan);
  $('#e_username').val(username);
  $('#e_password').val(password);

  $('#e_bank').val(bank);
  $('#e_no_rek').val(no_rek);
  $('#e_atas_nama').val(an);

  $('#modalEditKTG').modal('show'); 
}
</script>