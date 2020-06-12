<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Laporan</h4> &emsp; <small><b>Gaji</b></small>
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
								<a href="#">Laporan</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="#">Laporan</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Laporan Gaji</h4>
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
													<th class="text-center" style="width:20%">JUMLAH KARYAWAN</th>
													<th style="text-align: center">TOTAL</th>
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
															<td class="text-center"><?php echo $total_karyawan ?></td>
															<td style="text-align: right"><?php echo format_rp($total_gaji) ?></td>
															<td class="text-center">

																<?php if($row['id_gaji'] != ''){ ?>
																		<a class='btn btn-primary btn-sm shadow' href="<?php echo site_url('laporan/penggajian/detail/'.$row['bulan'].'/'.$row['tahun']) ?>" data-toggle="tooltip" title="Lihat Detail"><i class='fa fa-search'></i></a>
																<?php }else{ 
																		$d = cal_days_in_month(CAL_GREGORIAN,$row['bulan'],$row['tahun']);

				                    									if(strtotime(date('d')."-".date('m')."-".date('Y')) >= strtotime($d."-".$row['bulan']."-".$row['tahun'])){
				                    							?>
				                    										
				                    							<?php
				                    									}else{
				                    							?>
				                    										
				                    							<?php
				                    									}
				                    							?>
				                    										&nbsp;
				                    										<a data-toggle="tooltip" title="Preview" class="btn btn-primary btn-sm" href="<?php echo site_url('laporan/penggajian/detail/'.$row['bulan'].'/'.$row['tahun']) ?>"><i class="fa fa-search"></i></a>
				                    										<br><br>
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



<script>

	$(document).on('change','#tahun', function(){
		$('#formGaji').submit();
	})

	$(document).on('click','.generateGaji',function(){

		var bulan = $(this).attr('data-month');
		var tahun = $(this).attr('data-year');

		var r = confirm("Apakah anda yakin ingin melakukan penggajian bulan "+filter_month(bulan)+" "+tahun+" ?");
		if (r == true) {
		  $.ajax({
				url : "<?php echo site_url('generate_gaji') ?>",
				method : "POST",
				dataType : "json",
				data : {
					bulan : bulan,
					tahun : tahun
				},
				beforeSend : function(){
					$(this).html('<i class="fa fa-spinner fa-spin"></i> Proses...').attr('disabled','disabled');
				},
				success : function(res){
					if(res.status == 'success'){
						$(this).remove();
						alert('Gaji berhasil digenerate');
						location.reload();
					}else{
						$('#status').html(res.message);
					}
					
				},
				complete : function(){
					$(this).html('GENERATE GAJI').removeAttr('disabled');
				}
			})
		}
	});

	function filter_month(month){
		if(month == 1){
			month = "Januari";
		}else if(month == 2){
			month = "Februari";
		}else if(month == 3){
			month = "Maret";
		}else if(month == 4){
			month = "April";
		}else if(month == 5){
			month = "Mei";
		}else if(month == 6){
			month = "Juni";
		}else if(month == 7){
			month = "Juli";
		}else if(month == 8){
			month = "Agustus";
		}else if(month == 9){
			month = "September";
		}else if(month == 10){
			month = "Oktober";
		}else if(month == 11){
			month = "November";
		}else if(month == 12){
			month = "Desember";
		}

		return month;
	}
</script>