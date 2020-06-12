<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Master Data</h4> &emsp; <small><b>Akademik</b></small>
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
								<a href="#">Akademik</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="#">Tahun Ajaran</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Tahun Ajaran</h4>
								</div>
								<div class="card-body">

									<div class="row">
						                <div class="col-md-12">
						                  <?php echo $this->session->flashdata('alert_message') ?>
						                </div>
						              </div>

						              <button data-toggle="modal" data-target="#modalTambahPR" class="btn btn-primary btn-flat mt-2 mb-2"><i class="fa fa-plus"></i> Tambah Tahun Ajaran</button>
						              <br><br>

						              <table class="table">
						                <thead>
						                  <tr>
						                    <th style="width: 5%">NO</th>
						                    <th>TAHUN AJARAN</th>
						                    <th>WAKTU MULAI</th>
						                    <th>WAKTU SELESAI</th>
						                    <th>STATUS</th>
						                    <th class="text-center" style="width: 15%"><i class="fa fa-cog"></i></th>
						                  </tr>
						                </thead>
						                <tbody>
						                  <?php $i = 0; foreach($list as $row){ $i++; ?>
						                    
						                    <tr>
						                      <td><?php echo $i ?></td>
						                      <td><?php echo $row['nama_ta'] ?></td>
						                      <td>
						                        <?php echo get_monthname(date('m', strtotime($row['waktu_mulai']))).date(' Y', strtotime($row['waktu_mulai']))?>  
						                      </td>
						                      <td>
						                        <?php echo get_monthname(date('m', strtotime($row['waktu_selesai']))).date(' Y', strtotime($row['waktu_selesai'])) ?>
						                      </td>
						                      
						                      <td>
						                        <?php if($row['is_aktif'] == '1'){ ?>
						                            <a onclick="return confirm('Non Aktifkan Tahun Ajaran Ini')" href='<?php echo site_url('set_active_ta/'.$row['id'].'/0') ?>' class='badge badge-success'><i class='fa fa-check'></i> Aktif</a>
						                        
						                        <?php }else{ ?>
						                            <a onclick="return confirm('Aktifkan Tahun Ajaran Ini')" href='<?php echo site_url('set_active_ta/'.$row['id'].'/1') ?>' class='badge badge-danger'><i class='fa fa-ban'></i>Non Aktif</a>

						                        <?php } ?>
						                      </td>

						                      <td class="text-center">
						                        
						                        <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
						                                onclick="
						                                  edit(
						                                    '<?php echo $row['id'] ?>',
						                                    '<?php echo $row['nama_ta'] ?>',
						                                    '<?php echo $row['waktu_mulai'] ?>',
						                                    '<?php echo $row['waktu_selesai'] ?>'
						                                  )">
						                            <i class="fa fa-edit"></i>
						                        </a>
						                        &nbsp;

						                        <a href="<?php echo site_url('master_data/akademik/tahun_ajaran/detail/'.$row['id']) ?>" data-toggle="tooltip" title="Lihat" class="text-info">
						                          <i class="fa fa-search"></i>
						                        </a>

						                        &nbsp;
						                        <a href="<?php echo site_url('delete_tahun_ajaran/'.$row['id']) ?>" data-toggle="tooltip" title="Hapus" class="text-danger" onclick="return confirm('Hapus Data Ini ?')">
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

<form action="<?php echo site_url('insert_tahun_ajaran') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahPR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                 <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Tahun Ajaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
             </div>

             <div class="modal-body">
                <div class="form-group">
                   <label>Tahun Ajaran</label>
                   <input autocomplete="off" type="text" name="nama_ta" id="nama_ta" class="form-control" placeholder="Tahun Ajaran..." required />
                </div>

                <div class="form-group">
                   <label>Waktu Mulai</label>
                   <input autocomplete="off" type="text" name="waktu_mulai" id="nama_pr" class="form-control date-picker" placeholder="Waktu Mulai..." required/>
                </div>

                <div class="form-group">
                   <label>Waktu Selesai</label>
                   <input autocomplete="off" type="text" name="waktu_selesai" id="harga_pr" class="form-control date-picker" placeholder="Waktu Selesai..." required/>
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

   <form action="<?php echo site_url('update_tahun_ajaran') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditPR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Tahun Ajaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
             </div>

             <input type="hidden" name="id_ta" id="e_id">

             <div class="modal-body">
                <div class="form-group">
                   <label>Tahun Ajaran</label>
                   <input autocomplete="off" type="text" name="nama_ta" id="e_nama_ta" class="form-control" placeholder="Tahun Ajaran..." required/>
                </div>

                <div class="form-group">
                   <label>Waktu Mulai</label>
                   <input autocomplete="off" type="text" name="waktu_mulai" id="e_mulai" class="form-control date-picker" placeholder="Waktu Mulai..." required/>
                </div>

                <div class="form-group">
                   <label>Waktu Selesai</label>
                   <input autocomplete="off" type="text" name="waktu_selesai" id="e_selesai" class="form-control date-picker" placeholder="Waktu Selesai..." required/>
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
     function edit(id, nama, waktu_mulai, waktu_selesai){
      $('#e_id').val(id);
      $('#e_nama_ta').val(nama);
      $('#e_mulai').val(waktu_mulai);
      $('#e_selesai').val(waktu_selesai);
      $('#modalEditPR').modal('show'); 
   }
   </script>

   <script type="text/javascript">
        $(function() {
            $('.date-picker').datepicker({
              dateFormat : "yy-mm-dd"
            });
        });
    </script>