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
								<a href="<?php echo site_url('master_data/akademik/tahun_ajaran') ?>">Tahun Ajaran</a>
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
                  <?php echo $this->session->userdata('alert_message') ?>
                </div>
              </div>

              <a class="btn btn-outline-secondary" href="<?php echo site_url('master_data/akademik/tahun_ajaran') ?>"><i class="fa fa-chevron-left"></i> KEMBALI</a>

              &emsp;

              <button data-toggle="modal" data-target="#modalTambahBOM" class="btn btn-primary btn-flat mt-2 mb-2"><i class="fa fa-plus"></i> Tambah Komponen</button>

              <br><br>

              <div class="row">
                              <div class="col-md-4">
                                <div class="card">
                                    
                                    <div class="card-body">
                                      <h6><b>Detail</b></h6>
                                      <table class="table">
                                        <tr>
                                          <td>TA</td>
                                          <td class="text-right"><b><?php echo $ta['nama_ta'] ?></b></td>
                                        </tr>
                                        <tr>
                                          <td>MULAI</td>
                                          <td class="text-right"><b><?php echo get_monthname(date('m', strtotime($ta['waktu_mulai']))).date(' Y', strtotime($ta['waktu_mulai']))?>  </b></td>
                                        </tr>
                                        <tr>
                                          <td>SELESAI</td>
                                          <td class="text-right"><b><?php echo get_monthname(date('m', strtotime($ta['waktu_selesai']))).date(' Y', strtotime($ta['waktu_selesai'])) ?></b></td>
                                        </tr>
                                      </table>
                                    </div>
                                  </div>
                              </div>

                              <div class="col-md-8">
                                  <div class="card">
                                    
                                    <div class="card-body">
                                      <h6><b>Komponen Pembayaran</b></h6>
                                      <div class="table-responsive">
                                        <table class="table datatable">
                                          <thead>
                                            <tr>
                                              <th >KOMPONEN</th>
                                              <th style="width:20%">TIPE</th>
                                              <th style="width: 20%">NOMINAL</th>
                                              <th style="width: 20%" class="text-center"><i class="fa fa-cog"></i></th>
                                            </tr>
                                          </thead>

                                          <tbody>
                                            <?php $i = 0; foreach($komponen_list as $row) { $i++; ?>
                                                    <tr>

                                                      <td><?php echo $row['nama_komponen'] ?></td>
                                                      <td><?php echo $row['tipe'] ?></td>
                                                      <td><?php echo format_rp($row['nominal']) ?></td>
                                                      <td class="text-center">

                                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
                                                                onclick="
                                                                  edit(
                                                                    '<?php echo $row['ta_komponen_id'] ?>',
                                                                    '<?php echo $row['nama_komponen'] ?>',
                                                                    '<?php echo $row['nominal'] ?>',
                                                                  )">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        &nbsp;
                                                        <a href="<?php echo site_url('delete_ta_komponen/'.$ta['id'].'/'.$row['ta_komponen_id']) ?>" data-toggle="tooltip" title="Hapus" class="text-danger" onclick="return confirm('Hapus Data Ini ?')">
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

   <form action="<?php echo site_url('insert_ta_komponen/'.$ta['id']) ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahBOM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Komponen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <div class="modal-body">
                <div class="form-group">
                   <label>Komponen Pembayaran</label>
                   <select class="form-control" name="komponen_biaya_id" required="">
                     <option value="">Pilih</option>
                     <?php foreach ($komponen as $row) { ?>
                              <option value="<?php echo $row['id'] ?>"><?php echo $row['nama_komponen'] ?></option>
                     <?php } ?>
                   </select>
                </div>

                <div class="form-group">
                   <label>Nominal</label>
                   <input autocomplete="off" type="text" name="nominal" id="nominal" class="form-control rupiah" placeholder="Harga (Rp. )" required/>
                </div>

                <div class="form-group">
                   <label>Tipe</label>
                   <select class="form-control" name="tipe" required="">
                     <option value="">Pilih</option>
                     <option value="Pendaftaran">Pendaftaran</option>
                     <option value="Bulanan">Bulanan</option>
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

   <form action="<?php echo site_url('update_ta_komponen/'.$ta['id']) ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditBOM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Komponen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
             </div>

             <input type="hidden" name="ta_komponen_id" id="e_id">

             <div class="modal-body">
                <div class="form-group">
                   <label>Komponen</label><br>
                   <span id="e_komponen"></span>
                </div>

                <div class="form-group">
                   <label>Nominal</label>
                   <input id="e_nominal" autocomplete="off" type="text" name="nominal" class="form-control rupiah" placeholder="Nominal (Rp)" required/>
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
     function edit(id, komponen, nominal){
      $('#e_id').val(id);

      $('#e_komponen').text(komponen);
      $('#e_nominal').val(format_rp(parseInt(nominal)));
      $('#modalEditBOM').modal('show'); 
   }
   </script>