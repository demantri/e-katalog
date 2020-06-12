<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Transaksi</h4> &emsp; <small><b>Gaji</b></small>
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
								<a href="#">Gaji</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Detail Preview Gaji</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<a class="btn btn-outline-primary" href="<?php echo site_url('transaksi/hr/gaji/daftar') ?>"><i class="fa fa-chevron-left"></i> KEMBALI</a>

									<br><br>

									<div class="panel panel-default">
										<br>
										<div class="panel-body">
											<table class="table">
												<tr>
													<th style="width: 20%; background-color: #eee" class="">BULAN</th>
													<td style="width: 20%;" class="text-center"><?php echo get_monthname($bulan) ?></td>
													<th style="width: 20%;background-color: #eee" class="">JUMLAH KARYAWAN</th>
													<td style="width: 20%" class="text-center" ><?php echo $gaji['total_karyawan'] ?></td>
												</tr>
												<tr>
													<th style="background-color: #eee">TAHUN</th>
													<td class="text-center"><?php echo $tahun ?></td>
													<th style="background-color: #eee">TOTAL</th>
													<td class="text-center" style="text-align: right">Rp. <?php echo number_format($gaji['total_gaji'],0,'','.') ?></td>
												</tr>
											</table>
										</div>
									</div>

									<br>

									<table class="table table-bordered">
										<thead>
											<tr>
												<th style="width:5%;vertical-align: middle;" class="text-center" rowspan="2">NO</th>
												<th style="width:15%;vertical-align: middle;" class="text-left" rowspan="2">NAMA</th>
												<th colspan="2" class="text-center">KEHADIRAN</th>
												<th colspan="4" class="text-center">KOMPONEN GAJI</th>
												<th rowspan="2" style="vertical-align: middle;">TOTAL GAJI</th>
											</tr>
											<tr>
												<th class="text-center">H</th>
												<th class="text-center">T</th>
												<th align="center"><center>Gaji</center></th>
												<!--th>Tunjangan Nikah</th-->
												<!--th>Tunjangan Anak</th-->
												<th>Lembur</th>
												<th>Tunjangan</th>
												<th>Utang</th>
											</tr>
										</thead>
										<tbody>

										<?php $n=0; foreach ($gaji['list'] as $row) { $n++;?>
											<tr>
												<td style="padding: 0 10px !important" class="text-center"><?php echo $n ?></td>
												<td style="padding: 0 10px !important"><small><?php echo $row['nama_karyawan']."<br>".$row['kode_karyawan']; ?></small></td>
												<td class="text-center"><?php echo $row['total_hadir'] ?></td>
												<td class="text-center"><?php echo $row['total_terlambat'] ?></td>
												<td style="text-align: right;padding: 0 10px !important"><?php echo format_rp($row['gaji_pokok']) ?></td>
												<td style="text-align: right; padding: 0 10px !important"><?php echo format_rp($row['tunjangan_lembur']) ?></td>
												<td style="text-align: right; padding: 0 10px !important">
													<?php echo format_rp($row['tunjangan_lain']) ?>
													<a  onclick="t_komponen(
															'<?php echo $row["kode_karyawan"]." / ".$row["nama_karyawan"] ?>',
															'<?php echo htmlentities(json_encode($row["tunjangan_komponen"])) ?>'
													    )" 
														href="javascript:void(0)" class="text-primary"><i class="fa fa-eye"></i></a>
												</td>
												<td class="text-danger" style="text-align: right; padding: 0 10px !important"><?php echo format_rp($row['hutang']) ?></td>
												<td style="text-align: right; padding: 0 10px !important"><?php echo format_rp($row['total_gaji']) ?></td>
											</tr>
										<?php } ?>
										</tbody>
									</table>

								</div>
							</div>
						</div>


					</div>
				</div>

  <input type="hidden" name="source" value="lain">
   <input type="hidden" name="tipe" value="lembur">
     <div class="modal fade" id="modalTunjangan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Detail Tunjangan</h4>
                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">&times;</button>
             </div>

             <div class="modal-body">

                <div class="form-group">
                   <label>Karyawan</label>
                   <h5 id="d_karyawan"></h5>
                </div>

                <table class="table">
                	<thead>
                		<tr>
                			<th>Tunjangan</th>
                			<th class="text-center">Nominal</th>
                		</tr>
                	</thead>
                	<tbody id="tableTunjangan">
                		
                	</tbody>
                	<tfoot>
                		<tr style="background-color: #eee">
                			<th>TOTAL</th>
                			<th id="d_total" class="text-right"></th>
                		</tr>
                	</tfoot>
                </table>

             </div>

             <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
             </div>

           </div>
        </div>
     </div>

<script type="text/javascript">
	function t_komponen(karyawan, komponen){
		var js = komponen.replace('&quot;', '\"');
		obj = $.parseJSON(komponen);

		var txt = ""; var subtotal = 0;
		$.each(obj, function(index, val){
			subtotal += val.nominal;
			txt += "<tr>";
			txt += "<td>"+ val.name +"</td>";
			txt += "<td class='text-right'>"+ format_rp(val.nominal) +"</td>";
			txt += "</tr>";
		});

		$('#tableTunjangan').html(txt);
		$('#d_total').text(format_rp(subtotal));

		$('#d_karyawan').text(karyawan);
		$('#modalTunjangan').modal('show');
	}
</script>