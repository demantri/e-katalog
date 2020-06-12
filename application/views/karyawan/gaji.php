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
								<a href="#">Gaji</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Gaji</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12" id="status">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<div class="row">
										<div class="col-md-4">
											<form method="GET" id="formGaji">
												<div class="form-group">
													<label class="control-label"><b>Tahun</b></label>
													<select id="tahun" class="form-control" name="tahun">
														<?php for ($i=2019; $i <= date('Y'); $i++) {  ?>
																	<option <?php if($tahun == $i){ echo "selected='selected'"; } ?> value="<?php echo $i ?>"><?php echo $i ?></option>
														<?php } ?>
													</select>
												</div>
												
											</form>
										</div>
									</div>

									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr style="background-color: #eee">
													<th style="width:15%">BULAN</th>
													<th style="width:10%">TAHUN</th>
													<th style="text-align: center">TOTAL</th>
													<th style="width: 15%" class="text-center">STATUS</th>
													<th style="width: 20%" class="text-center"><i class="fa fa-cog"></i></th>
												</tr>
											</thead>
											<tbody>
												<?php $n = 0; $total_gaji = 0;
													  foreach($gaji as $row){ $n++; 

													  	if($row['total_gaji'] == 0){
												  			$total_gaji 	= $row['next']['total_gaji'];
												  			$total_karyawan = $row['next']['total_karyawan'];

													  	}else{
													  		$total_gaji 	= $row['total_gaji'];
													  		$total_karyawan = $row['total_karyawan'];
													  	}
												?>
														<tr>
															<td><?php echo get_monthname($row['bulan']) ?></td>
															<td><?php echo $row['tahun'] ?></td>
															<td style="text-align: right"><?php echo format_rp($total_gaji) ?></td>

															<td class="text-center">
																<?php if($row['id_gaji'] == ''){ ?>
																		<span class="badge badge-danger">Belum Dibayarkan</span>
																<?php }else{ ?>
																		<span class="badge badge-primary">Sudah Dibayar</span>
																<?php } ?>
															</td>
															<td class="text-center">

																<?php if($row['id_gaji'] != ''){ ?>
																		<a class='btn btn-primary btn-sm shadow' href="<?php echo site_url('karyawan/gaji/detail/'.$row['id_gaji']) ?>" data-toggle="tooltip" title="Lihat Detail"><i class='fa fa-search'></i></a>

																<?php }else{ ?>
				                    										
				                    							<?php
																	  } 
																?>
															</td>
														</tr>
												<?php 
														$total_karyawan = $row['total_karyawan'];
														$total_gaji 	= $row['total_gaji'];
													} 
												?>
											</tbody>
										</table>
									</div>

								</div>
							</div>
						</div>


					</div>
				</div>


 <script type="text/javascript">
    $(function() {
        $('.date-picker').datepicker({
          dateFormat : "yy-mm-dd"
        });
    });
</script>