<?php 

	if($tipe == 'in'){
		$title = 'Masuk';
	}else{
		$title = 'Keluar';
	}

?>

<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Setoran Bank</h4> &emsp; <small><b>Keuangan</b></small>
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
								<a href="#"><?php echo $title ?></a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Setoran Bank <?php echo $title ?></h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<button data-toggle="modal" data-target="#modalTambahKTG" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah Setoran <?php echo $title ?></button>
              						<br><br>

									

              						<ul class="nav nav-pills nav-secondary  nav-pills-no-bd nav-pills-icons" id="pills-tab-with-icon" role="tablist">
              							<?php 
              								$active = '';
              								if($tipe == 'in'){ ?>
              									<li class="nav-item">
													<a class="nav-link active" id="pills-home-tab-icon" data-toggle="pill" href="#pills-home-icon" role="tab" aria-controls="pills-home-icon" aria-selected="true">
														<img style="width: 25px" src="<?php echo base_url('assets/img/icon/megaphone.png') ?>"> Request
													</a>
												</li>
              							<?php }else{
              								$active = 'active';
              							} ?>
										
										<!-- <li class="nav-item">
											<a class="nav-link <?php echo $active ?>" id="pills-profile-tab-icon" data-toggle="pill" href="#pills-profile-icon" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
												<img style="width: 25px" src="<?php echo base_url('assets/img/icon/list.png') ?>"> Daftar Setoran
											</a>
										</li> -->
									</ul>

									
									<div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
										
										<?php 
              								$active = '';
              								if($tipe == 'in'){ ?>
              									<div class="tab-pane fade show active" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
													<div class="table-responsive">
														<table class="display table table-hover datatables" >
															<thead style="background-color: #eee">
																<tr>
																	<th style="width: 5%">No</th>
																	<th>Kode</th>
										                            <th>Tanggal Transaksi</th>
										                            <th>Total</th>
										                            <th>Keterangan</th>
																</tr>
															</thead>
															<tbody>
																<?php $n = 0;
										                          foreach ($req as $row) { $n++; ?>

										                            <tr>
										                              <td><?php echo $n ?></td>
										                              <td><?php echo $row['kode_transaksi'] ?></td>
							                                          <td><?php echo $row['tanggal_transaksi'] ?></td>
							                                          <td><?php echo format_rp($row['total_transaksi']) ?></td>
							                                          <td><?php echo $row['keterangan'] ?></td>
										                            </tr>

										                    <?php } ?>
															</tbody>
														</table>
													</div>
												</div>
              							<?php }else{
              								$active = 'show active';
              							} ?>

										<div class="tab-pane fade <?php echo $active ?>" id="pills-profile-icon" role="tabpanel" aria-labelledby="pills-profile-tab-icon">

											<div class="table-responsive">
												<table class="display table table-hover datatables" >
													<thead style="background-color: #eee">
														<tr>
															<th style="width: 5%">No</th>
															<th>Kode</th>
															<th>No Giro</th>
								                            <th>Tanggal Transaksi</th>
								                            <th>Total</th>
								                            <th class="text-center">Status</th>
														</tr>
													</thead>
													<tbody>
														<?php $n = 0;
								                          foreach ($list as $row) { $n++; ?>

								                            <tr>
								                              <td><?php echo $n ?></td>
								                              <td><?php echo $row['kode_transaksi'] ?></td>
								                              <td><?php echo $row['kd_giro'] ?></td>
					                                          <td><?php echo $row['tanggal_transaksi'] ?></td>
					                                          <td><?php echo format_rp($row['total_transaksi']) ?></td>

					                                          <td class="text-center"><?php echo show_level($row['level']) ?></td>

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
				</div>

<form action="<?php echo site_url('insert_setoran_bank/'.$tipe) ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahKTG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah <?php echo $title ?></h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <div class="modal-body">
                <div class="form-group">
                   <label>Kode Setoran<?php echo $title ?></label>
                   <input type="text" value="<?php echo $last_code ?>" readonly name="kode_transaksi" id="" class="form-control" placeholder="Kode Setoran" autocomplete="off" required />
                </div>


                <div class="form-group" id="rekBody">
                   <label>Pilih Rekening</label>
                   <select class="form-control" name="rek_id">
                   	<option value="">Pilih</option>
                   	<?php foreach ($rek as $row) { ?>
                   			<option value="<?php echo $row['id'] ?>"><?php echo $row['nama_bank']." - ".$row['no_rek']." a/n ".$row['atas_nama'] ?></option>
                    <?php } ?>
                   </select>
                </div>

                <div class="form-group">
                   <label>No. Giro</label>
                   <input autocomplete="off" type="number" name="kd_giro" id="" class="form-control" placeholder="Kode Giro..." required/>
                </div>

                <div class="form-group">
                   <label>Nominal</label>
                   <input autocomplete="off" type="text" name="total_transaksi" id="" class="form-control rupiah" placeholder="Nominal (Rp)..." required/>
                </div>

                <div class="form-group">
                   <label>Keterangan</label>
                   <input autocomplete="off" type="text" name="keterangan" id="" class="form-control" placeholder=" Keterangan..." required/>
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
