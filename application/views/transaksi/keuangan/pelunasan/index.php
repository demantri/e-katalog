<?php 
	
	if($page == 'utang'){
		$title = 'Utang';
	}else{
		$title = 'Piutang';
	}

?>


<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Pelunasan</h4> &emsp; <small><b><?php echo $title ?></b></small>
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
								<a href="#">Pelunasan</a>
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
									<h4 class="card-title">Daftar <?php echo $title ?></h4>
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
													<th>Kode</th>
													<th>Tipe</th>
						                            <th>Sisa Bayar</th>
						                            <th>Total</th>
						                            <th>Status</th>
													<th class="text-center"><i class="fa fa-cog"></i></th>
												</tr>
											</thead>
											<tbody>
												<?php $n = 0;
						                          foreach ($list as $row) { $n++; ?>

						                            <tr>
						                              <td><?php echo $n ?></td>
						                              <td><?php echo $row['kode_transaksi']."<br><small>".$row['tanggal_transaksi']."</small>" ?></td>
						                              <td><?php echo $row['tipe'] ?></td>
			                                          <td class="text-right"><?php echo format_rp($row['total_bayar']) ?></td>
			                                          <td class="text-right"><?php echo format_rp($row['total_transaksi']) ?></td>

			                                          <td class="text-center">
			                                          	<?php if($row['status'] == 'Lunas'){ ?>
			                                          			<span class="badge badge-success">Lunas</span>
			                                          	<?php }else{ ?>
			                                          			<span class="badge badge-danger">Belum Lunas</span>
			                                          	<?php } ?>
			                                          </td>
						                              <td class="text-center">
						                                  
						                                  <a href="<?php echo site_url('transaksi/keuangan/pelunasan/'.$page.'/detail/'.$row['id']) ?>" data-toggle="tooltip" title="Lihat Detail" class="btn btn-primary btn-sm shadow">
						                                    <i class="fa fa-search"></i>
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
