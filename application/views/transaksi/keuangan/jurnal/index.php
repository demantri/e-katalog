<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Keuangan</h4> &emsp; <small><b>Post Jurnal</b></small>
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
								<a href="#">Post Jurnal</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Jurnal</h4>
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
													<th>Transaksi</th>
						                            <th class="text-center">Nominal</th>
						                            <th class="text-center">Status</th>
						                            <th class="text-center"><i class="fa fa-cog"></i></th>
												</tr>
											</thead>
											<tbody>
												<?php $n = 0;
						                          foreach ($list as $row) { $n++; ?>

						                            <tr>
						                              <td><?php echo $n ?></td>
						                              <td><?php echo $row['kode_transaksi'] ?> <br> 
						                              	<small style="font-size: 13px">( <?php echo show_tipe_transaksi($row['tipe'], $row['jenis']) ?> )</small> <br>
						                              	<small style="font-size:13px"><?php echo $row['waktu_jurnal'] ?></small> <br><br></td>
			                                          <td class="text-right"><?php echo format_rp($row['total_transaksi']) ?></td>
			                                          <td class="text-center">
			                                          	<?php if($row['status_jurnal'] == '0'){ ?>
			                                          			<span class="badge badge-primary"><i class="fa fa-clock"></i> Pending</span>
			                                          	<?php }else{ ?>
			                                          			<span class="badge badge-success"><i class="fa fa-check-circle"></i> Sudah Diposting</span>
			                                          	<?php } ?>
			                                          </td>
			                                          <td class="text-center">
			                                          	<a class="btn btn-primary btn-sm shadow" href="<?php echo site_url('transaksi/keuangan/jurnal/detail/'.$row['id']) ?>"><i class="fa fa-search"></i></a>
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



<form action="<?php echo site_url('insert_bop') ?>" method="post" enctype="multipart/form-data">
     <div class="modal fade" id="modalTambahBOP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                 <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah BOP</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
             </div>

             <div class="modal-body">
             	<div class="form-group">
                   <label>Nominal</label>
                   <input autocomplete="off" type="text" readonly="" name="kode_transaksi" id="kode" class="form-control" value="<?php echo $last_code ?>" required />
                </div>

                <div class="form-group">
                   <label>Nominal</label>
                   <input autocomplete="off" type="text" name="total_transaksi" id="nama_ta" class="form-control rupiah" placeholder="Nominal..." required />
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
                   <label>Keterangan</label>
                   <input autocomplete="off" type="text" name="keterangan" id="nama_ta" class="form-control" placeholder="Keterangan..." required />
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