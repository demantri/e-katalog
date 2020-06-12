<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Perolehan</h4> &emsp; <small><b>Asset</b></small>
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
								<a href="#">Asset</a>
							</li>
							<li class="separator">
								<i class="fa fa-arrow-right"></i>
							</li>
							<li class="nav-item">
								<a href="#">Penyusutan</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Penyusutan</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<form method="get">
									 <div class="row">
			                          <div class="col-md-4">
                                          <div class="form-group">
                                            <label>Aset</label>
                                              
                                              <select name = "id_aset" class = "form-control" required="required" id="aset">
                                                <option value="">Pilih</option>
                                                 <?php foreach ($aset as $row) { ?>
                                                   
                                                        <option <?php if($row['id_aset'] == $this->input->get('id_aset')){ echo "selected='selected'"; } ?> value="<?php echo $row['id_aset'] ?>"><?php echo $row['kode_aset']." - ".$row['nama_aset'] ?></option>

                                                 <?php } ?>
                                              </select>
                                            <?php echo form_error('kode_aset'); ?>
                                          </div>
                                        </div>
                                        <div class="col-md-3">
                                          <div class="form-group">
                                            <label>Detail Aset</label>
                                              
                                              <select name = "id_detail_aset" class = "form-control" required="required" id="detail_aset">
                                                <option value="">Pilih</option>
                                                <?php foreach ($detail_aset as $row) { ?>
                                                   
                                                        <option <?php if($row['id'] == $this->input->get('id_detail_aset')){ echo "selected='selected'"; } ?> value="<?php echo $row['id'] ?>"><?php echo $row['kode_detail_aset']?></option>

                                                 <?php } ?>
                                              </select>
                                            <?php echo form_error('kode_aset'); ?>
                                          </div>
                                        </div>

                                        <div class="col-md-1">
                                          <div class="form-group">
                                          	<br>
                                            <label>&nbsp;</label>
                                            <button class="btn btn-primary btn-sm mt-2"> <i class="fa fa-search"></i></button>
                                          </div>
                                        </div>

                                        <?php if($this->input->get('id_aset')){ ?>
                                                <div class="col-md-1">
                                                  <br>
                                                  <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <a href="<?php echo site_url('kartuAT/cetak?id_aset='.$this->input->get('id_aset')."&id_detail_aset=".$this->input->get('id_detail_aset')) ?>" class="btn btn-primary btn-sm mt-2" target="_blank"> <i class="fa fa-print"></i></a>
                                                  </div>
                                                </div>
                                        <?php } ?>

                                        <?php 
                                            if(date('d') >= 28){ 
                                              $url = site_url('penyusutan/hitung_penyusutan');
                                              $attr = "";
                                            
                                            }else{
                                              $url = "javascript:void(0)";
                                              $attr = 'disabled="disabled"';
                                            } 
                                        ?>

                                        <?php 

                                        $k = 0;
                                        $month = '';
                                        for ($i = date('m'); $i > 0; $i--){
                                          if($i != date('m')){
                                            if(!in_array($i, $log)){
                                              $k = $i;
                                              $month .= "<br>".get_monthname($i);
                                            }
                                          }
                                        }

                                        ?>

                                        <?php if($k > 0){ ?>

                                                <div class="col-md-3">
                                                  <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <a href="<?php echo site_url('penyusutan/hitung_penyusutan') ?>" class="btn btn-success btn-block text-center">Hitung Penyusutan <?php echo $month ?></a>
                                                  </div>
                                                </div>

                                        <?php 
                                              }else{ 
                                                
                                                if(in_array(date('m'), $log)){
                                        ?>
                                                  <div class="col-md-3">
                                                    <div class="form-group">
                                                      <label>&nbsp;</label><br>
                                                      <span class="text-success"><i class="fa fa-check-circle"></i> Penyusutan sudah dihitung</span>
                                                    </div>
                                                  </div>
                                        <?php
                                                }else{

                                                    if(date('d') >= 28){
                                        ?>
                                                      <div class="col-md-3">
                                                        <div class="form-group">
                                                          <label>&nbsp;</label>
                                                          <a href="<?php echo site_url('penyusutan/hitung_penyusutan') ?>" class="btn btn-success btn-block">Hitung Penyusutan <?php echo filter_month(date('m')) ?></a>
                                                        </div>
                                                      </div>
                                        <?php
                                                    }else{
                                        ?>
                                                      <div class="col-md-3">
                                                        <div class="form-group">
                                                          <label>&nbsp;</label><br>
                                                          <a disabled="disabled" href="javascript:void(0)" class="btn btn-success btn-block">Hitung Penyusutan <?php echo filter_month(date('m')) ?></a>
                                                        </div>
                                                      </div>
                                        <?php
                                                    }

                                                }

                                              }
                                        ?>
                                     </div>
			                        </form>

									<div class="table-responsive">
										
										<table class="table table-striped table-bordered table-hover" id="datatable">
			                                <thead>
			                                <tr>
			                                  <th><center>Kode</center></th>
			                                  <th><center>Tanggal</center></th>
			                                  <th><center>Tahun</center></th>
			                                  <th><center>Bulan</center></th>
			                                  <th><center>Penyusutan</center></th>
			                                  <th><center>Akumulasi Penyusutan</center></th>
			                                  <th><center>Nilai Buku</center></th>
			                                </tr>
			                                </thead>

			                                <tbody>

			                                    <?php if($this->input->get('id_aset')){ 
			                                              
			                                              foreach ($penyusutan as $row) { 
			                                                $akumulasi = 0;
			                                                $num = 0;
			                                                $tgl = substr($row['tanggal_transaksi'], 8, 2);
			                                                $bln = substr($row['tanggal_transaksi'], 5, 2);
			                                                $thn = substr($row['tanggal_transaksi'], 0, 4);
			                                                $num = $bln;

			                                                if($tgl >= '15'){
			                                                  $num = $num + 1;

			                                                  if($bln == '12'){
			                                                    $num = 1;
			                                                  }
			                                                }

			                                                $num = $num;

			                                                $selisih = diffMonth(date('Y-m-')."1", $thn."-".$bln."-1");

			                                                $total_penyusutan = calculatePenyusutan($row['harga'], $row['nilai_residu'],$row['masa_pakai'],$row['tanggal_transaksi'],1, 0);

			                                                $akumulasi += $total_penyusutan;
			                                                $total_buku = $row['harga'] - $total_penyusutan;

			                                    ?>
			                                              <tr>
			                                                <td rowspan="<?php echo $selisih ?>"><?php echo $row['kode_detail_aset'] ?></td>
			                                                <td rowspan="<?php echo $selisih ?>"><?php echo date("Y-m-d",strtotime($row['tanggal_transaksi'])) ?></td>
			                                                <td><?php echo $thn ?></td>
			                                                <td><?php echo get_monthname($num)?></td>
			                                                <td class="text-right"><?php echo format_rp($total_penyusutan)?></td>
			                                                <td class="text-right"><?php echo format_rp($akumulasi) ?></td>
			                                                <td class="text-right"><?php echo format_rp($total_buku) ?></td>
			                                              </tr>

			                                              <?php for($i = 1; $i < $selisih; $i++){
			                                                      $new_thn = date('Y', strtotime("+".$i." months", strtotime($row['tanggal_transaksi'])));
			                                                      $new_bln = date('m', strtotime("+".$i." months", strtotime($row['tanggal_transaksi'])));

			                                                      $akumulasi += $total_penyusutan;

			                                                      if($i+1 == $row['masa_pakai']){ 
			                                                        $style = "style='background-color:#cdcdcd'";
			                                                      }else{
			                                                        $style = "";
			                                                      }
			                                              ?>

			                                                        <tr >
			                                                          <td <?php echo $style ?>><?php echo $new_thn ?></td>
			                                                          <td <?php echo $style ?>><?php echo get_monthname($new_bln)?></td>
			                                                          <td class="text-right" <?php echo $style ?>><?php echo format_rp($total_penyusutan) ?></td>
			                                                          <td class="text-right" <?php echo $style ?>><?php echo format_rp($akumulasi) ?></td>
			                                                          <td class="text-right" <?php echo $style ?>><?php echo format_rp($total_buku -= $total_penyusutan) ?></td>
			                                                        </tr>
			                                              <?php } ?>

			                                    <?php     } ?>

			                                    <?php }else{ ?>

			                                      <td colspan="7" class="text-center">
			                                        <h5 class="text-danger"><b>SILAHKAN PILIH FILTER !</b></h5>
			                                      </td>

			                                    <?php } ?>
			                                  
			                                </tbody>
			                            </table>

									</div>
								</div>
							</div>
						</div>


					</div>
				</div>

<script>
  $(document).on('change','#aset',function(){
    if($(this).val() != ''){
      $.ajax({
        url : "<?php echo site_url('get_detail_aset/all/aset') ?>",
        method : "POST",
        dataType : "json",
        data : {
          id_aset : $(this).val()
        },
        beforeSend : function(){
          $(this).attr('disabled','disabled');
        },
        success : function(res){
          if(res.status == 'success'){
            $('#detail_aset').removeAttr('disabled').html('<option>Pilih</option>');
            $.each(res.data, function( index, value ) {
              $('#detail_aset').append('<option value="'+value.detail_aset_id+'">'+value.kode_detail_aset+'</option>');
            });

          }else{
            $('#detail_aset').html("<option value=''>Aset tidak punya barang</option>").attr('disabled','disabled');
            alert(res.message);
          }
        },
        complete : function(){
          $(this).removeAttr('disabled');
        }

      });

    }else{
      $('#detail_aset').html('<option>Pilih</option>');
    }
  });
</script>