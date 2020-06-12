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
								<a href="#">Waktu</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Waktu Kerja</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<div class="table-responsive">
										<table class="display table table-hover datatables" >
											<thead style="background-color: #eee">
												<tr>
													<th style="width: 5%">No</th>
													<th>Hari</th>
													<th>Waktu Tiba</th>
													<th>Waktu Pulang</th>
                          <th class="text-center">Status</th>
													<th class="text-center"><i class="fa fa-cog"></i></th>
												</tr>
											</thead>
											<tbody>

                        <?php $n = 0; foreach ($list as $row) { $n++; ?>
                         
                                <tr>
                                  <td><?php echo $n ?></td>
                                  <td><?php echo $row['hari'] ?></td>
                                  <td>
                                    <table class="table">
                                      <tr>
                                        <td>Mulai</td>
                                        <td><?php echo $row['jam_tiba_mulai'] ?></td>
                                      </tr>
                                      <tr>
                                        <td>Terlambat</td>
                                        <td><?php echo $row['jam_tiba_terlambat'] ?></td>
                                      </tr>
                                      <tr>
                                        <td>Selesai</td>
                                        <td><?php echo $row['jam_tiba_selesai'] ?></td>
                                      </tr>
                                    </table>
                                  </td>

                                  <td>
                                    <table class="table">
                                      <tr>
                                        <td>Mulai</td>
                                        <td><?php echo $row['jam_pulang_mulai'] ?></td>
                                      </tr>
                                      <tr>
                                        <td>Selesai</td>
                                        <td><?php echo $row['jam_pulang_selesai'] ?></td>
                                      </tr>
                                    </table>
                                  </td>

                                  <td class="text-center">

                                    <?php 
                                      if($row['is_aktif'] == '1'){
                                        $to = '0';
                                        $tipe = 'success'; $title = "Aktif";
                                      }else{
                                        $to = '1';
                                        $tipe = 'danger'; $title = 'Nonaktif';
                                      } 
                                    ?>

                                    <a href="<?php echo site_url('set_waktu_presensi/'.$row['id'].'/'.$to) ?>" class="badge badge-<?php echo $tipe ?>" onclick="return confirm('Ubah status waktu ?')"><?php echo $title ?></a>
                                  </td>

                                  <td>
                                    <button class="btn btn-primary btn-sm" 
                                            onclick="edit(
                                                  '<?php echo $row['id'] ?>',
                                                  '<?php echo $row['hari'] ?>',
                                                  '<?php echo $row['jam_tiba_mulai'] ?>',
                                                  '<?php echo $row['jam_tiba_terlambat'] ?>',
                                                  '<?php echo $row['jam_tiba_selesai'] ?>',
                                                  '<?php echo $row['jam_pulang_mulai'] ?>',
                                                  '<?php echo $row['jam_pulang_selesai'] ?>'
                                                )">
                                        <i class="fa fa-edit"></i> Ubah          
                                    </button>
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

   <form action="<?php echo site_url('update_waktu') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditKTG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Waktu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <input type="hidden" name="id_waktu" id="e_id">

             <div class="modal-body">
                <div class="form-group">
                   <label>Hari</label>
                   <input type="text" name="hari" id="e_hari" class="form-control" placeholder="Hari..." readonly="" autocomplete="off" required />
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <b>WAKTU HADIR</b>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">

                       <label>Mulai</label>
                       <input autocomplete="off" type="text" name="jam_tiba_mulai" id="e_tiba_mulai" class="form-control timepicker" placeholder="Mulai..." required/>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                       <label>Terlambat</label>
                       <input autocomplete="off" type="text" name="jam_tiba_terlambat" id="e_tiba_terlambat" class="form-control timepicker" placeholder="Terlambat..." required/>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                       <label>Selesai</label>
                       <input autocomplete="off" type="text" name="jam_tiba_selesai" id="e_tiba_selesai" class="form-control timepicker" placeholder="Selesai..." required/>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <b>WAKTU PULANG</b>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                       <label>Mulai</label>
                       <input autocomplete="off" type="text" name="jam_pulang_mulai" id="e_pulang_mulai" class="form-control timepicker" placeholder="Mulai..." required/>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                       <label>Selesai</label>
                       <input autocomplete="off" type="text" name="jam_pulang_selesai" id="e_pulang_selesai" class="form-control timepicker" placeholder="Selesai..." required/>
                    </div>
                  </div>

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
 function edit(id, hari, tiba_mulai, tiba_terlambat, tiba_selesai, pulang_mulai, pulang_selesai){
  $('#e_id').val(id);
  $('#e_hari').val(hari);
  $('#e_tiba_mulai').val(tiba_mulai);
  $('#e_tiba_terlambat').val(tiba_terlambat);
  $('#e_tiba_selesai').val(tiba_selesai);
  $('#e_pulang_mulai').val(pulang_mulai);
  $('#e_pulang_selesai').val(pulang_selesai);
  
  $('#modalEditKTG').modal('show'); 
}
</script>