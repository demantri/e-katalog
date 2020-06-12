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
								<a href="#">Tunjangan</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Tunjangan</h4>
								</div>
								<div class="card-body">

									<div class="row">
					                    <div class="col-md-12">
					                      <?php echo $this->session->flashdata('alert_message') ?>
					                    </div>
					                  </div>

					                  <button data-toggle="modal" data-target="#modalTambahKTG" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Tunjangan</button>
					                          <br><br>

					                  <div class="table-responsive">
					                    <table class="display table table-hover datatables" >
					                      <thead class="">
					                        <tr>
					                          <th style="width: 5%">No</th>
					                          <th>Nama Tunjangan</th>
					                          <th>Tipe</th>
					                          <th class="text-center">Nominal</th>
					                          <th class="text-center"><i class="fa fa-cog"></i></th>
					                        </tr>
					                      </thead>
					                      <tbody>
					                        <?php $n = 0;
					                                      foreach ($list as $row) { $n++; ?>

					                                        <tr>
					                                          <td><?php echo $n ?></td>
					                                          <td><?php echo $row['nama_tunjangan'] ?></td>
					                                          <td><?php echo $row['tipe'] ?></td>
					                                          <td class="text-right">
					                                          	<?php if($row['tipe'] != 'tahunan'){ echo format_rp($row['nominal']); }else{ echo "2x Gaji"; } ?></td>

					                                          <td class="text-center">
					                                              <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="btn btn-warning btn-sm"
					                                                      onclick="
					                                                        edit(
					                                                          '<?php echo $row['id'] ?>',
					                                                          '<?php echo $row['nama_tunjangan'] ?>',
					                                                          '<?php echo $row['tipe'] ?>',
					                                                          '<?php echo $row['nominal'] ?>'
					                                                        )">
					                                                  <i class="fa fa-edit"></i>
					                                              </a>
					                                              &nbsp;
					                                              <a onclick="return confirm('Hapus data ini ?')" href="<?php echo site_url('delete_tunjangan/tunjangan_lain/'.$row['id']) ?>" data-toggle="tooltip" title="Hapus" class="btn btn-danger btn-sm">
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
  <input type="hidden" name="source" value="lain">
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
                   <label>Nama Tunjangan</label>
                   <input autocomplete="off" type="text" name="nama_tunjangan" id="nama" class="form-control" placeholder="Nama Tunjangan..." required/>
                </div>

                <div class="form-group">
                   <label>Tipe</label>
                   <select name="tipe" id="tipe" class="form-control" required="">
                     <option value="">Pilih</option>
                     <option value="harian">Harian</option>
                     <option value="bulanan">Bulanan</option>
                     <option value="tahunan">Tahunan</option>
                   </select>
                </div>

                <div class="form-group row" id="yearBody">
                	<div class="col-md-6">
                		<label>Tahun</label>
                		<select class="form-control" name="bulan">
                			<?php for ($i= 1; $i <= 12 ; $i++){ ?>
                				<option value="<?php echo $i ?>" <?php if($i == date('m')){echo "selected='selected'";} ?> value="">
                					<?php echo get_monthname($i) ?>
                				</option>
                			<?php } ?>
                		</select>
                	</div>
                	<div class="col-md-6">
                		<label>Tahun</label>
                		<select class="form-control" name="tahun">
                			<?php for ($i= 2019; $i <= date('Y') ; $i++){ ?>
                				<option value="<?php echo $i ?>" <?php if($i == date('Y')){echo "selected='selected'";} ?> value="">
                					<?php echo $i ?>
                				</option>
                			<?php } ?>
                		</select>
                		
                	</div>
                </div>

                <div class="form-group" id="nominalBody">
                   <label>Nominal</label>
                   <input autocomplete="off" type="text" name="nominal" id="nominal" class="form-control rupiah" placeholder="Nominal (Rp)...">
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
    <input type="hidden" name="source" value="lain">
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
                   <label>Nama Tunjangan</label>
                   <input autocomplete="off" type="text" name="nama_tunjangan" id="e_nama" class="form-control" placeholder="Nama Tunjangan..." required/>
                </div>

                <div class="form-group">
                   <label>Tipe</label>
                   <select name="tipe" class="form-control" required="" id="e_tipe">
                     <option value="">Pilih</option>
                     <option value="harian">Harian</option>
                     <option value="bulanan">Bulanan</option>
                      <option value="tahunan">Tahunan</option>
                   </select>
                </div>

                <div class="form-group row" id="e_yearBody">
                	<div class="col-md-6">
                		<label>Tahun</label>
                		<select class="form-control" name="bulan">
                			<?php for ($i= 1; $i <= 12 ; $i++){ ?>
                				<option value="<?php echo $i ?>" <?php if($i == date('m')){echo "selected='selected'";} ?> value="">
                					<?php echo get_monthname($i) ?>
                				</option>
                			<?php } ?>
                		</select>
                	</div>
                	<div class="col-md-6">
                		<label>Tahun</label>
                		<select class="form-control" name="tahun">
                			<?php for ($i= 2019; $i <= date('Y') ; $i++){ ?>
                				<option value="<?php echo $i ?>" <?php if($i == date('Y')){echo "selected='selected'";} ?> value="">
                					<?php echo $i ?>
                				</option>
                			<?php } ?>
                		</select>
                		
                	</div>
                </div>

                <div class="form-group" id="e_nominalBody">
                   <label>Nominal</label>
                   <input autocomplete="off" type="text" name="nominal" id="e_nominal" class="form-control rupiah" placeholder="Nominal (Rp)...">
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

	$('#e_yearBody').hide();
	$('#yearBody').hide();

	$(document).on('change', '#tipe', function(){
		if($(this).val() == 'tahunan'){
			$('#yearBody').show();
			$('#nominalBody').hide();
		}else{
			$('#yearBody').hide();
			$('#nominalBody').show();
		}
		
	})

	$(document).on('change', '#e_tipe', function(){
		if($(this).val() == 'tahunan'){
			$('#e_yearBody').show();
			$('#e_nominalBody').hide();
		}else{
			$('#e_yearBody').hide();
			$('#e_nominalBody').show();
		}
	})

 function edit(id, nama, tipe, nominal){
  $('#e_id').val(id);
  $('#e_nama').val(nama);

  $('#e_tipe option').removeAttr('selected');
  $('#e_tipe option[value="'+ tipe +'"]').attr('selected','selected');

  $('#e_nominal').val(format_rp(nominal));

  if(tipe == 'tahunan'){
  	$('#e_yearBody').show();
  	$('#e_nominalBody').hide();
  }

  $('#modalEditKTG').modal('show'); 
}
</script>