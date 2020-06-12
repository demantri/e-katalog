<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
								<a href="#">Perizinan</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Izin</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<button class="btn btn-primary" data-toggle="modal" data-target="#modalIzin"><i class="fa fa-plus"></i> Ajukan Perizinan</button>

									<br><br>

									<ul class="nav nav-pills nav-secondary  nav-pills-no-bd nav-pills-icons" id="pills-tab-with-icon" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="pills-home-tab-icon" data-toggle="pill" href="#pills-home-icon" role="tab" aria-controls="pills-home-icon" aria-selected="true">
												 Pengajuan
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#pills-profile-icon" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
												 Diterima
											</a>
										</li>

										<li class="nav-item">
											<a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#ditolak" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
												 Ditolak
											</a>
										</li>
									</ul>

									<div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
										<div class="tab-pane fade show active" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
											<div class="table-responsive">
												<table class="display table table-hover datatables" >
													<thead style="background-color: #eee">
														<thead>
						                                    <tr>
						                                      <th style="width:5%">No</th>
						                                      <th style="width:10%">Tipe</th>
						                                      <th class="text-center">Rentang Waktu</th>
						                                      <th>Keterangan</th>
						                                      <th class="text-center" style="width: 15%"><i class="fa fa-cog"></i></th>
						                                    </tr>
													</thead>
													<tbody>
					                                    <?php 
					                                        $n = 0;
					                                        foreach ($pending as $row) { $n++; 

					                                          $date1 = new DateTime($row['tanggal_mulai']);
					                                          $date2 = new DateTime($row['tanggal_selesai']);
					                                          $interval = $date1->diff($date2);

					                                    ?>
					                                          <tr>
					                                            <td><?php echo $n; ?></td>
					                                            <td><?php echo $row['tipe'] ?></td>
					                                            <td class='text-center'><?php echo $row['tanggal_mulai']." s/d ".$row['tanggal_selesai'] ?> <br> ( <?php echo $interval->days + 1 ?> Hari )</td>
					                                            <td><?php echo $row['keterangan'] ?></td>
					                                            <td class="text-center">
					                                            	<span class="badge badge-primary">Pengajuan</span>
					                                            </td>
					                                          </tr>
					                                    <?php } ?>
					                                  </tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane fade" id="pills-profile-icon" role="tabpanel" aria-labelledby="pills-profile-tab-icon">

											<div class="table-responsive">
												<table class="table">
				                                  <thead>
				                                    <thead>
					                                    <tr>
					                                      <th style="width:5%">No</th>
					                                      <th style="width:10%">Tipe</th>
					                                      <th class="text-center">Rentang Waktu</th>
					                                      <th style="width:27%">Keterangan</th>
					                                      <th style="width:15%" class="text-center"><i class="fa fa-cog"></i></th>
					                                    </tr>
				                                  </thead>
				                                  <tbody>
				                                    <?php 
				                                        $n = 0;
				                                        foreach ($approve as $row) { $n++; 
				                                          $date1 = new DateTime($row['tanggal_mulai']);
				                                          $date2 = new DateTime($row['tanggal_selesai']);
				                                          $interval = $date1->diff($date2);
				                                    ?>
				                                          <tr>
				                                            <td><?php echo $n; ?></td>
				                                            <td><?php echo $row['tipe'] ?></td>
				                                            <td class='text-center'><?php echo $row['tanggal_mulai']." s/d ".$row['tanggal_selesai'] ?> <br> ( <?php echo $interval->days + 1 ?> Hari )</td>
				                                            <td><?php echo $row['keterangan'] ?></td>
				                                            <td class="text-center">
				                                              <span class="badge badge-success bg-success"><i class="fa fa-check"></i> Diterima</span>
				                                            </td>
				                                          </tr>
				                                    <?php } ?>
				                                  </tbody>
				                                </table>
											</div>

										</div>

										<div class="tab-pane fade" id="ditolak" role="tabpanel" aria-labelledby="pills-profile-tab-icon">
											<table class="table">
			                                  <thead>
			                                    <tr>
			                                      <th style="width:5%">No</th>
			                                      <th style="width:10%">Tipe</th>
			                                      <th class="text-center">Rentang Waktu</th>
			                                      <th style="width:27%">Keterangan</th>
			                                      <th style="width:15%" class="text-center"><i class="fa fa-cog"></i></th>
			                                    </tr>
			                                  </thead>
			                                  <tbody>
			                                    <?php 
			                                        $n = 0;
			                                        foreach ($deny as $row) { $n++; 
			                                          $date1 = new DateTime($row['tanggal_mulai']);
			                                          $date2 = new DateTime($row['tanggal_selesai']);
			                                          $interval = $date1->diff($date2);
			                                    ?>
			                                          <tr>
			                                            <td><?php echo $n; ?></td>
			                                            <td><?php echo $row['tipe'] ?></td>
			                                            <td class='text-center'><?php echo $row['tanggal_mulai']." s/d ".$row['tanggal_selesai'] ?> <br> ( <?php echo $interval->days + 1 ?> Hari )</td>
			                                            <td><?php echo $row['keterangan'] ?></td>
			                                            <td class="text-center">
			                                              <span class="badge badge-danger bg-danger"><i class="fa fa-ban"></i> Ditolak</span>
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
				</div>


<form action="<?php echo site_url('insert_izin') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalIzin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Perizinan</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
             </div>

             <div class="modal-body">
                
                <div class="form-group row">
				    <label for="inputEmail3" class="col-sm-2 col-form-label">Tipe</label>
				    <div class="col-sm-3">
				      <select class="form-control" name="tipe" required="required">
				      	<option value="">Pilih</option>
				      	<option value="Izin">Cuti</option>
				      	<option value="Sakit">Sakit</option>
				      	<option value="Dinas">Dinas</option>
				      </select>
				    </div>
				</div>
				<div class="form-group row">
				    <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal</label>
				    <div class="col-sm-4">
				      <input autocomplete="off" id="start" type="text" required="required" class="form-control date-picker" id="inputEmail3"  name="start" placeholder="Tanggal Mulai...">
				    </div>

				    <label for="inputEmail3" class="col-sm-2 col-form-label">
				    	<i class="fa fa-arrow-left"></i> 
				    	<i class="fa fa-calendar"></i>
				    	<i class="fa fa-arrow-right"></i>
				    </label>
				    <div class="col-sm-4">
				      <input autocomplete="off" id="end" type="text" required="required" class="form-control date-picker" id="inputEmail3"  name="end" placeholder="Tanggal Selesai...">
				    </div>
				</div>
				<div class="form-group row">
				    <label for="inputEmail3" class="col-sm-2 col-form-label">Keterangan</label>
				    <div class="col-sm-10">
				      <textarea autocomplete="off" type="text" required="required" class="form-control" id="inputEmail3"  name="keterangan" placeholder="Keterangan..."></textarea>
				    </div>
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


 <script type="text/javascript">
    $(function() {
        $('.date-picker').datepicker({
          dateFormat : "yy-mm-dd"
        });
    });
</script>