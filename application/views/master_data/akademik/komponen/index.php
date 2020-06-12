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
								<a href="#">Komponen Biaya</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Komponen Biaya</h4>
								</div>
								<div class="card-body">

									<div class="row">
	                					<div class="col-md-12">
							              <?php echo $this->session->flashdata('alert_message') ?>
							            </div>
							         </div>

							          <button data-toggle="modal" data-target="#modalTambahSPL" class="btn btn-primary btn-flat mt-2 mb-2"><i class="fa fa-plus"></i> Tambah Komponen</button>
							          <br><br>

							          <table class="table">
							            <thead>
							              <tr>
							                <th style="width: 5%">NO</th>
							                <th>KODE</th>
							                <th>NAMA</th>
							                <th>CICILAN</th>
							                <th class="text-center" style="width: 10%"><i class="fa fa-cog"></i></th>
							              </tr>
							            </thead>
							            <tbody>
							              <?php $i = 0; foreach($list as $row){ $i++; ?>
							                
							                <tr>
							                  <td><?php echo $i ?></td>
							                  <td><?php echo $row['kode_komponen'] ?></td>
							                  <td><?php echo $row['nama_komponen'] ?></td>
							                  <td>
							                    <?php 
							                      if($row['cicilan'] == '1'){
							                        echo "<i class='fa fa-check-circle text-success'></i>";
							                      }else{
							                        echo "-";
							                      } 
							                    ?>
							                  </td>
							                  <td class="text-center">
							                    
							                    <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
							                            onclick="
							                              edit(
							                                '<?php echo $row['id'] ?>',
							                                '<?php echo $row['kode_komponen'] ?>',
							                                '<?php echo $row['nama_komponen'] ?>',
							                                '<?php echo $row['cicilan'] ?>'
							                              )">
							                        <i class="fa fa-edit"></i>
							                    </a>
							                    &nbsp;
							                    <a href="<?php echo site_url('delete_komponen/'.$row['id']) ?>" data-toggle="tooltip" title="Hapus" class="text-danger" onclick="return confirm('Hapus Data Ini ?')">
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

   <form action="<?php echo site_url('insert_komponen') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahSPL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Komponen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
             </div>

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Komponen</label>
                   <input type="text" name="kode_komponen" id="kode_komponen" class="form-control" placeholder="Kode Komponen" value="<?php echo $last_code;?>" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama Komponen</label>
                   <input autocomplete="off" type="text" name="nama_komponen" id="nama_komponen" class="form-control" placeholder="Nama Komponen" required/>
                </div>

                <div class="form-group">
                    <label class="d-block" for="chk-ani">
                      <input class="checkbox_animated" id="chk-ani" name="cicilan" type="checkbox" value="1"> Bisa Dicicil
                    </label>
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

   <form action="<?php echo site_url('update_komponen') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditTK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                 <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Komponen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
             </div>

             <input type="hidden" name="id_komponen" id="e_id">

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Komponen</label>
                   <input type="text" name="kode_komponen" id="e_kode" class="form-control" placeholder="Kode Komponen" value="<?php echo $last_code;?>" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama Komponen</label>
                   <input autocomplete="off" type="text" name="nama_komponen" id="e_nama" class="form-control" placeholder="Nama Komponen" required/>
                </div>

                <div class="form-group">
                    <label class="d-block" for="chk-ani">
                      <input class="checkbox_animated" id="chk-ani1" name="cicilan" type="checkbox" value="1"> Bisa Dicicil
                    </label>
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
     function edit(id, kode, nama, is_cicil){
      $('#e_id').val(id);
      $('#e_kode').val(kode);
      $('#e_nama').val(nama);

      if(is_cicil == '1'){
        $('#chk-ani1').attr('checked','checked');
      }else{
        $('#chk-ani1').removeAttr('checked');
      }

      $('#modalEditTK').modal('show'); 
   }
   </script>