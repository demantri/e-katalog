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
								<a href="#">Beban</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Beban</h4>
								</div>
								<div class="card-body">

									<div class="row">
				                      <div class="col-md-12">
				                        <?php echo $this->session->flashdata('alert_message') ?>
				                      </div>
				                    </div>

				                    <button data-toggle="modal" data-target="#modalTambahAKT" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Beban</button>
				                            <br><br>

				                    <div class="table-responsive">
				                      <table class="display table table-hover datatables" >
				                        <thead>
				                          <tr>
				                            <th style="width: 5%">No</th>
				                            <th>Kode</th>
				                            <th>Nama Beban</th>
				                            <th>Akun</th>
				                            <th class="text-center"><i class="fa fa-cog"></i></th>
				                          </tr>
				                        </thead>
				                        <tbody>
				                          <?php $n = 0;
				                                        foreach ($list as $row) { $n++; ?>

				                                          <tr>
				                                            <td><?php echo $n ?></td>
				                                            <td style="width: 15%"><?php echo $row['kode_beban'] ?></td>
				                                            <td><?php echo $row['nama_beban'] ?></td>
				                                            <td><?php echo $row['kode_coa']." / ".$row['nama_coa'] ?></td>

				                                            <td style="width: 15%" class="text-center">
				                                                <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
				                                                        onclick="
				                                                          edit(
				                                                            '<?php echo $row['beban_id'] ?>',
				                                                            '<?php echo $row['kode_beban'] ?>',
				                                                            '<?php echo $row['nama_beban'] ?>',
				                                                            '<?php echo $row['coa_id'] ?>',
				                                                            '<?php echo $row['is_bulanan'] ?>'
				                                                          )">
				                                                    <i class="fa fa-edit"></i>
				                                                </a>

				                                                &nbsp;

				                                                <a onclick="return confirm('Hapus data ini ?')" href="<?php echo site_url('delete_beban/'.$row['beban_id']) ?>" data-toggle="tooltip" title="Hapus" class="text-danger">
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



<form action="<?php echo site_url('insert_beban') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahAKT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Beban</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                
                
             </div>

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Beban</label>
                   <input type="text" name="kode_beban" id="kode" class="form-control" placeholder="Kode Jabatan" value="<?php echo $last_code;?>" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama Beban</label>
                   <input autocomplete="off" type="text" name="nama_beban" id="nama" class="form-control" placeholder="Nama Beban..." required/>
                </div>

                <div class="form-group">
                   <label>Pilih Akun</label>
                   <select class="form-control" name="coa_id" required="">
                     <option value="">Pilih</option>
                     <?php foreach($coa as $row) { ?>
                          
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['nama_coa'] ?></option>

                     <?php } ?>
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

   <form action="<?php echo site_url('update_beban') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditAKT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Beban</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                
             </div>

             <input type="hidden" name="id_beban" id="e_id">

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Beban</label>
                   <input type="text" name="kode_beban" id="e_kode" class="form-control" placeholder="Kode Beban" value="<?php echo $last_code;?>" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Nama Beban</label>
                   <input autocomplete="off" type="text" name="nama_beban" id="e_nama" class="form-control" placeholder="Nama Beban..." required/>
                </div>

                <div class="form-group">
                   <label>Pilih Akun</label>
                   <select class="form-control" name="coa_id" id="e_coa" required="">
                     <option value="">Pilih</option>
                     <?php foreach($coa as $row) { ?>
                          
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['nama_coa'] ?></option>

                     <?php } ?>
                   </select>
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
 function edit(id, kode, nama, coa_id, bulanan){
  $('#e_id').val(id);
  $('#e_kode').val(kode);
  $('#e_nama').val(nama);

  $('#e_coa option').removeAttr('selected');
  $('#e_coa option[value="'+coa_id+'"]').attr('selected','selected');

  $('#e_bulanan').removeAttr('checked');

  if(bulanan == '1'){
    $('#e_bulanan').attr('checked','checked');
  }

  $('#modalEditAKT').modal('show'); 
}
</script>