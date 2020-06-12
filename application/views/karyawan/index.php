<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Dashboard</h4> &emsp; <small><b></b></small>
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
								<a href="#">Dashboard</a>
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
									<h4 class="card-title">Dashboard</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

					                  <?php 

					                    if($this->input->get('bulan')){
					                      $bulan = $this->input->get('bulan');
					                    }else{
					                      $bulan = date('m');
					                    }

					                    if($this->input->get('tahun')){
					                      $tahun = $this->input->get('tahun');
					                    }else{
					                      $tahun = date('Y');
					                    }

					                    for($d=1; $d<=31; $d++){
					                        $time = mktime(12, 0, 0, $bulan, $d, $tahun);          
					                        if(date('m', $time) == $bulan){     
					                            $day[]= $d;
					                        }
					                    }

					                  ?>

					                  <form method="get">
					                    <div class="row">
					                      <div class="col-md-3">
					                        <select name="bulan" class="form-control">
					                          <option value="">Pilih Bulan</option>
					                          <?php for ($i=1; $i <= 12 ; $i++) { ?>
					                              <option <?php if($i == $bulan){ echo "selected='selected'"; } ?> value="<?php echo $i ?>"><?php echo get_monthname($i) ?></option>
					                          <?php } ?>
					                        </select>
					                      </div>
					                      <div class="col-md-2">
					                        <select name="tahun" class="form-control">
					                          <option>Pilih Tahun</option>
					                          <?php for ($i=2018; $i <= 2024 ; $i++) { ?>
					                              <option <?php if($i == $tahun){ echo "selected='selected'"; } ?> value="<?php echo $i ?>"><?php echo $i ?></option>
					                          <?php } ?>
					                        </select>
					                      </div>
					                      <div class="col-md-2">
					                        <button class="btn btn-primary btn-sm"><i class="fa fa-search"></i> &nbsp;Lihat</button>
					                      </div>
					                    </div>
					                  </form>

					                  
					                  <br>

					                  <table>
					                    <tr>
					                      <td class='text-center' style="width:5%; height: 30px;width: 30px"><i class='fa fa-check text-success'></i></td>
					                      <td>&nbsp;Hadir&emsp;</td>
					                      <td class='text-center bg-info' style="width:5%;width: 30px"><i class='fa fa-check text-success'></i></td>
					                      <td>&nbsp;Terlambat&emsp;</td>
					                      <td class='text-center bg-danger' style="width:5%;width: 30px">S</td>
					                      <td>&nbsp;Sakit&emsp;</td>
					                      <td class='text-center bg-primary' style="width:5%;width: 30px">I</td>
					                      <td>&nbsp;Izin&emsp;</td>
					                      <td class='text-center bg-warning' style="width:5%;width: 30px">C</td>
					                      <td>&nbsp;Cuti&emsp;</td>
					                    </tr>
					                  </table>

					                <div class="table-responsive">
					                  <table class="table" style="display: block;
					                                              width:1700px;
					                                              white-space: nowrap;">
					                    <thead>
					                      <tr>
					                        <th colspan="30" class="text-center"><?php echo get_monthname($bulan) ?></th>
					                      </tr>
					                      <tr>
					                        <?php foreach($day as $i){ 
					                          echo "<th class='text-center'>".$i."</th>";
					                        } ?>
					                      </tr>
					                    </thead>
					                    <tbody>
					                      <?php 
					                      	$hadir = 0;
					                      	$num_days = 0;
					                        foreach ($absensi as $row) { ?>
					                          
					                          <tr>
					                            <?php foreach($day as $i){

					                              $absen_val = searchKey($row['absensi'],'hari',$i);
					                              if(!empty($absen_val)) {
					                                  $num_days++;

					                                  foreach ($absen_val as $data_absen){
					                                    $id_absensi = $data_absen['id_absensi'];
					                                    $tanggal = date('Y-m-d', strtotime($data_absen['waktu_masuk']));
					                                    $waktu_masuk  = substr($data_absen['waktu_masuk'],11,5);
					                                    $waktu_keluar = substr($data_absen['waktu_keluar'],11,5);

					                                    $att = 'data-id-absensi="'.$id_absensi.'"
					                                        data-tanggal="'.$tanggal.'"
					                                        data-name="'.$row['nama_karyawan'].'" 
					                                        data-waktu-masuk="'.$waktu_masuk.'" 
					                                        data-waktu-keluar="'.$waktu_keluar.'"';
					                                    
					                                    if($data_absen['status'] == 'hadir' || $data_absen['status'] == 'setengah_hari'){
					                                    	$hadir++;
					                                      echo "<td class='text-center'>
					                                          <a data-toggle='modal' data-target='#modalDetail' href='javascript:void(0)' class='get_detail' ".$att."><i class='fa fa-check text-success'></i></a>
					                                          </td>";

					                                    }else if($data_absen['status'] == 'terlambat'){
					                                    	$hadir++;
					                                      echo "<td class='text-center bg-info'><a data-toggle='modal' data-target='#modalDetail' href='javascript:void(0)' class='get_detail' ".$att."><i class='fa fa-check text-success'></i></a></td>";
					                                    
					                                    }else{

					                                      if($data_absen['status'] == 'izin'){
					                                        $s = 'I';
					                                      }else if($data_absen['status'] == 'sakit'){
					                                        $s = 'S';
					                                      }else{
					                                        $s = 'D';
					                                      }

					                                      echo "<td class='text-center bg-warning'>".$s."</td>";
					                                    }
					                                  }

					                              }else{
					                                $fulldate = $tahun."-".$bulan."-".$i;
					                                if(!filterDay($fulldate, $workday)){
					                                  echo "<td class='' style='background-color:#cdcdcd'></td>";
					                                
					                                }else{
					                                	$num_days++;
					                                    echo "<td class='bg-danger text-center'></td>";
					                                  

					                                }
					 
					                              }
					                              
					                            } ?>
					                          </tr>

					                      <?php } ?>
					                    </tbody>
					                  </table>

					                </div>


					                <div class="row my-3">
							            <div class="col-md-3"></div>
							            <div class="col-md-3">
							                <div class="card">
							                    <div class="card-body text-center">
							                        <h4 class="pb-3"><b>KEHADIRAN</b></h4>
							                        <div class="row">
							                            <div class="col-md-12 text-center">
							                                <span style="padding:5px;border:3px solid #eee;font-size:18px"><b><?php echo $hadir." / ".$num_days ?></b></span>
							                            </div>
							                        </div>
							                    </div>

							                    <?php $banding =  ($hadir / $num_days) * 100; ?>

							                    <div class="card-footer">
							                        <div class="progress r-0">
							                            <div class="progress-bar" role="progressbar" style="width: <?php echo $banding ?>%;" aria-valuenow=""
							                                 aria-valuemin="0" aria-valuemax="128"></div>
							                        </div>
							                    </div>
							                </div>
							            </div>

							            <div class="col-md-3">
							                <div class="card">
							                    <div class="card-body text-center">
							                        <h4 class="pb-3"><b>IZIN / CUTI</b></h4>
							                        <div class="row">
							                            <div class="col-md-12 text-center">
							                                <span style="padding:5px;font-size:18px"><b><?php echo $total_cuti ?> Hari</b></span>
							                            </div>
							                        </div>
							                    </div>
							                    <div class="card-footer text-center">
							                        <a href="<?php echo site_url('auth_karyawan/izin') ?>" class="btn btn-xs btn-primary">Ajukan</a>
							                    </div>
							                </div>
							            </div>

							        </div>

								</div>
							</div>
						</div>


					</div>
				</div>


<div id="modalDetail" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <span id="" class="modal-title">Detail Presensi</span>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><i class="fa fa-close"></i></button>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="col-md-12">
            <table class="table">
              <tr>
                <td style="background-color:#eee; width: 25%"><b>Nama Karyawan</b></td>
                <td id="gd_nama"></td>
                <td style="background-color:#eee; width: 15%"><b>Tanggal</b></td>
                <td id="gd_tanggal"></td>
              </tr>
            </table>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
                <form id="formAbsen" method="post" action="<?php echo site_url('update_absen'); ?>">
                <input type="hidden" name="id_absen" id="id_absen">
                <input type="hidden" name="tanggal" id="i_tanggal">
                <div class="form-group">
                   <label class="control-label">Jam Masuk</label>
                   <input type="text" id="gd_waktu_masuk" disabled="" class="form-control timepicker" name="jam_masuk" required="">
                </div>
                <div class="form-group">
                   <label class="control-label">Jam Keluar</label>
                   <input type="text" id="gd_waktu_keluar" disabled="" class="form-control timepicker" name="jam_keluar" required="">
                </div>

                <!--<button class="btn btn-warning btn-flat waves-effect waves-light"> Ubah </button>-->
              </form>
          </div>
        </div> 
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
	
	$(document).on('click','.get_detail',function(){
    var id_absen     = $(this).attr('data-id-absensi');
    var waktu_masuk  = $(this).attr('data-waktu-masuk');
    var waktu_keluar = $(this).attr('data-waktu-keluar');
    var tanggal      = $(this).attr('data-tanggal');
    var nama         = $(this).attr('data-name');

    $('#id_absen').val(id_absen);

    $('#gd_nama').html(nama);
    $('#gd_tanggal').html(tanggal);

    $('#i_tanggal').val(tanggal);
    $('#gd_waktu_keluar').val(waktu_keluar);
    $('#gd_waktu_masuk').val(waktu_masuk);
  })

</script>