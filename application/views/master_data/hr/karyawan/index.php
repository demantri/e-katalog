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
								<a href="#">Karyawan</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Karyawan</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<button data-toggle="modal" data-target="#modalTambahKTG" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Karyawan</button>
              						<br><br>

									<div class="table-responsive">
										<table class="display table table-hover datatables" >
											<thead style="background-color: #eee">
												<tr>
													<th style="width: 5%">No</th>
													<th>Kode</th>
													<th>Nama Karyawan</th>
													<th>Jabatan</th>
													<th>Kontak</th>
													<th class="text-center"><i class="fa fa-cog"></i></th>
												</tr>
											</thead>
											<tbody>
												<?php $n = 0;
						                          foreach ($list as $row) { $n++; ?>

						                            <tr>
						                              <td><?php echo $n ?></td>
						                              <td><?php echo $row['kode_karyawan'] ?><br><small>RFID : <?php echo $row['rfid'] ?> <br> 
                                            Rek :<?php echo $row['k_bank']." - ".$row['k_no_rek']." ( a/n ".$row['k_an'].")" ?></small></td>
						                              <td><?php echo $row['nama_karyawan'] ?><br><small><?php echo $row['jenis_kelamin'] ?></small></td>
						                              <td><?php echo $row['kode_jabatan']." / ".$row['nama_jabatan'] ?></td>
						                              <td><?php echo $row['alamat'] ?><br> <small><?php echo $row['no_telp'] ?></small></td>

						                              <td class="text-center">
						                                  <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
						                                          onclick="
						                                            edit(
						                                              '<?php echo $row['karyawan_id'] ?>',
						                                              '<?php echo $row['jabatan_id'] ?>',
						                                              '<?php echo $row['rfid'] ?>',
						                                              '<?php echo $row['kode_karyawan'] ?>',
						                                              '<?php echo $row['nama_karyawan'] ?>',
						                                              '<?php echo $row['alamat'] ?>',
						                                              '<?php echo $row['jenis_kelamin'] ?>',
						                                              '<?php echo $row['no_telp'] ?>',
						                                              '<?php echo $row['username'] ?>',
						                                              '<?php echo $row['password'] ?>',
                                                          '<?php echo $row['k_no_rek'] ?>',
                                                          '<?php echo $row['k_bank'] ?>',
                                                          '<?php echo $row['k_an'] ?>'
						                                            )">
						                                      <i class="fa fa-edit"></i>
						                                  </a>
						                                  &nbsp;
						                                  <a onclick="return confirm('Hapus data ini ?')" href="<?php echo site_url('delete_karyawan/'.$row['id']) ?>" data-toggle="tooltip" title="Hapus" class="text-danger">
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

<form action="<?php echo site_url('insert_karyawan') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahKTG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Pegawai</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Karyawan</label>
                   <input type="text" name="kode_karyawan" id="kode" class="form-control" placeholder="Kode Aktiva..." value="<?php echo $last_code;?>" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama Karyawan</label>
                   <input autocomplete="off" type="text" name="nama_karyawan" id="nama" class="form-control" placeholder="Nama Karyawan..." required/>
                </div>

                <div class="form-group">
                   <label>Jenis Kelamin</label>
                   <select class="form-control" name="jenis_kelamin" required="">
                   	<option value="">Pilih</option>
                   	<option value="Laki - Laki">Laki - Laki</option>
                   	<option value="Perempuan">Perempuan</option>
                   </select>
                </div>

                <div class="form-group">
                   <label>Jabatan</label>
                   <select class="form-control" name="jabatan_id" required="">
                   	<option value="">Pilih</option>
                   	<?php foreach ($jabatan as $row) { ?>
                   			<option value="<?php echo $row['id'] ?>"><?php echo $row['nama_jabatan'] ?></option>
                   	<?php } ?>
                   </select>
                </div>

                <div class="form-group row">
                  <div class="col-md-3">
                    <label>Bank</label>
                    <input autocomplete="off" type="text" name="k_bank" id="no_rek" class="form-control" placeholder="Bank..." required/>
                  </div>
                  <div class="col-md-4">
                    <label>Nomor Rekening</label>
                    <input autocomplete="off" type="text" name="k_no_rek" id="no_rek" class="form-control" placeholder="No Rek..." required/>
                  </div>
                  <div class="col-md-5">
                    <label>Atas Nama</label>
                    <input autocomplete="off" type="text" name="k_an" id="no_rek" class="form-control" placeholder="Atas Nama..." required/>
                  </div>
                </div>

                 <div class="form-group">
                   <label>Alamat</label>
                   <input autocomplete="off" type="text" name="alamat" id="nama" class="form-control" placeholder="Alamat..." required/>
                </div>

                <div class="form-group">
                   <label>No Telepon</label>
                   <input autocomplete="off" type="text" name="no_telp" id="nama" class="form-control" placeholder="No Telepon..." required/>
                </div>


                <div class="form-group">
                   <label>Rfid</label>
                   <input autocomplete="off" type="text" name="rfid" id="nama" class="form-control" placeholder="Nomor Rfid..." required/>
                </div>

                <div class="form-group">
                   <label>Username</label>
                   <input autocomplete="off" type="text" name="username" id="nama" class="form-control" placeholder="Username..." required/>
                </div>

                <div class="form-group">
                   <label>Password</label>
                   <input autocomplete="off" type="text" name="password" id="nama" class="form-control" placeholder="Password..." required/>
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

   <form action="<?php echo site_url('update_karyawan') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditKTG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <input type="hidden" name="id_karyawan" id="e_id">

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Karyawan</label>
                   <input type="text" name="kode_karyawan" id="e_kode" class="form-control" placeholder="Kode Aktiva..." value="<?php echo $last_code;?>" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama Karyawan</label>
                   <input autocomplete="off" type="text" name="nama_karyawan" id="e_nama" class="form-control" placeholder="Nama Karyawan..." required/>
                </div>

                <div class="form-group">
                   <label>Jenis Kelamin</label>
                   <select class="form-control" name="jenis_kelamin" required="" id="e_jk">
                   	<option value="">Pilih</option>
                   	<option value="Laki - Laki">Laki - Laki</option>
                   	<option value="Perempuan">Perempuan</option>
                   </select>
                </div>

                <div class="form-group">
                   <label>Jabatan</label>
                   <select class="form-control" name="jabatan_id" required="" id="e_jabatan">
                   	<option value="">Pilih</option>
                   	<?php foreach ($jabatan as $row) { ?>
                   			<option value="<?php echo $row['id'] ?>"><?php echo $row['nama_jabatan'] ?></option>
                   	<?php } ?>
                   </select>
                </div>

                <div class="form-group row">
                  <div class="col-md-3">
                    <label>Bank</label>
                    <input autocomplete="off" type="text" name="k_bank" id="e_bank" class="form-control" placeholder="Bank..." required/>
                  </div>
                  <div class="col-md-4">
                    <label>Nomor Rekening</label>
                    <input autocomplete="off" type="text" name="k_no_rek" id="e_no_rek" class="form-control" placeholder="No Rek..." required/>
                  </div>
                  <div class="col-md-5">
                    <label>Atas Nama</label>
                    <input autocomplete="off" type="text" name="k_an" id="e_an" class="form-control" placeholder="Atas Nama..." required/>
                  </div>
                </div>

                 <div class="form-group">
                   <label>Alamat</label>
                   <input autocomplete="off" type="text" name="alamat" id="e_alamat" class="form-control" placeholder="Alamat..." required/>
                </div>

                <div class="form-group">
                   <label>No Telepon</label>
                   <input autocomplete="off" type="text" name="no_telp" id="e_telp" class="form-control" placeholder="No Telepon..." required/>
                </div>


                <div class="form-group">
                   <label>Rfid</label>
                   <input autocomplete="off" type="text" name="rfid" id="e_rfid" class="form-control" placeholder="Nomor Rfid..." required/>
                </div>

                <div class="form-group">
                   <label>Username</label>
                   <input autocomplete="off" type="text" name="username" id="e_username" class="form-control" placeholder="Username..." required/>
                </div>

                <div class="form-group">
                   <label>Password</label>
                   <input autocomplete="off" type="text" name="password" id="e_password" class="form-control" placeholder="Password..." required/>
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
 function edit(id, jabatan_id, rfid, kode, nama, alamat, jenis_kelamin, no_telp, username, password, no_rek, bank, an){
  $('#e_id').val(id);
  $('#e_kode').val(kode);
  $('#e_nama').val(nama);
  $('#e_alamat').val(alamat);
  $('#e_rfid').val(rfid);
  $('#e_telp').val(no_telp);
  $('#e_username').val(username);
  $('#e_password').val(password);
  $('#e_no_rek').val(no_rek);
  $('#e_bank').val(bank);
  $('#e_an').val(an);

  $('#e_jk option').removeAttr('selected')
  $('#e_jk option[value="'+jenis_kelamin+'"]').attr('selected', 'selected');

  $('#e_jabatan option').removeAttr('selected')
  $('#e_jabatan option[value="'+jabatan_id+'"]').attr('selected', 'selected');
  
  $('#modalEditKTG').modal('show'); 
}
</script>