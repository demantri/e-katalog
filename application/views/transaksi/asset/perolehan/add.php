<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Master Data</h4> &emsp; <small><b>Asset</b></small>
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
								<a href="#">perolehan</a>
							</li>
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Perolehan</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<a href="<?php echo site_url('transaksi/asset/perolehan') ?>" class="btn btn-primary btn-border btn-flat"><i class="fa fa-chevron-left"></i> KEMBALI</a>
              						<br><br>

              						<div class="row">
						                <div class="col-md-3">
						                  <div class="card">
						                    <div class="card-header"><b>DETAIL</b></div>
						                    <div class="card-body">
						                    	 <form method="POST" action="<?php echo site_url('insert_transaksi/'.$perolehan['id']) ?>">
								                    <div class="form-group">
								                       <label>Kode transaksi</label>
								                       <input type="text" name="kode_transaksi" id="kode_transaksi" class="form-control" placeholder="Kode Bahan Baku" value="<?php echo $perolehan['kode_transaksi'];?>" readonly="" autocomplete="off" required />
								                    </div>

								                    <div class="form-group col-md-12">
								                       <label>Tipe Pembayaran</label>
								                       <select required="" class="form-control" name="pembayaran" id="tipe">
								                         <option value="">Pilih</option>
								                         <option value="Kredit">Kredit</option>
								                         <option value="Tunai">Tunai</option>
								                       </select>
								                    </div>

								                    <div class="form-group">
								                       <label>Total Bayar</label>
								                       <input value="Silahkan Pilih Tipe Pembayaran !" readonly="" id="total_bayar" type="text" name="total_bayar" class="form-control rupiah" placeholder="Total Dibayar" autocomplete="off" required />
								                       <small id="notifPrice"></small>
								                    </div>

								                    <div class="form-group">
								                       <label>Keterangan <small>(Optional)</small></label>
								                       <textarea type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan..." autocomplete="off"></textarea>
								                    </div>

								                    <div class="form-group">
								                       <button id="btnSave" disabled="disabled" class="btn btn-flat btn-block btn-success"><i class="fa fa-check"></i> SIMPAN</button>
								                    </div>

								                  </form>
						                    </div>
						                  </div>
						                </div>

						                <div class="col-md-9">
						                    <div class="card">
						                      <div class="card-header"><b>DAFTAR BARANG</b></div>
						                    </div>

						                    <form method="POST" id="formAdd">

							                    <div class="row">
							                        
							                          <input type="hidden" name="transaksi_id" value="<?php echo $perolehan['id'] ?>">
							                          <div class="form-group col-md-4">
							                             <label>Aset</label>
							                             <select class="form-control" name="aset_id" id="aset">
							                               <option value="" data-price="0">Pilih</option>
							                               <?php foreach ($aset as $row){ ?>
							                                        <option value="<?php echo $row['id_aset'] ?>"><?php echo $row['kode_aset']." / ".$row['nama_aset'] ?></option>
							                               <?php } ?>
							                             </select>
							                          </div>

							                          <div class="form-group col-md-2">
							                             <label>Harga <small>( / Satuan)</small></label>
							                             <input type="text" id="price" name="harga" class="form-control rupiah" placeholder="Rp. 0" autocomplete="off">
							                          </div>

							                          <div class="form-group col-md-3">
							                             <label>Nilai Residu <small>( / Satuan)</small></label>
							                             <input type="text" id="nilai_residu" name="nilai_residu" class="form-control rupiah" autocomplete="off" placeholder="Rp. 0">
							                          </div>

							                          <div class="form-group col-md-2">
							                             <label>Jumlah</label>
							                             <input type="number" name="jumlah" class="form-control" placeholder="0" autocomplete="off">
							                          </div>

							                          <div class="form-group col-md-1">
							                             <br>
							                             <label></label>
							                             <button id="btnAdd" data-toggle="tooltip" title="Tambah" style="margin-top:13px" class="btn btn-primary btn-sm">
							                                <i class="fa fa-plus"></i>
							                             </button>
							                          </div>

							                    </div>
						                	</form>

						                     <div class="table-responsive">
						                      <table class="table">
						                        <thead style="background-color:#eee">
						                          <tr>
						                            <th style="width: 30%">ASET</th>
						                            <th style="width: 20%">HARGA</th>
						                            <th style="width: 5%">JUMLAH</th>
						                            <th style="width: 20%">SUBTOTAL</th>
						                            <th style="width: 20%">NILAI RESIDU</th>
						                            <th class="text-center"><i class="fa fa-cog"></i></th>
						                          </tr>
						                        </thead>

						                        <tbody id="tableItem">
						                          <?php $n = $grandTotal = 0; 
						                                foreach ($item as $row) { $n++; $grandTotal += $row['subtotal'] ?>

						                                  <tr>
						                                    <td><?php echo $row['komponen'] ?></td>
						                                    <td class="text-right"><?php echo format_rp($row['harga']) ?></td>
						                                    <td><?php echo $row['qty'] ?></td>
						                                    <td class="text-right"><?php echo format_rp($row['subtotal']) ?></td>
						                                    <td class="text-right"><?php echo format_rp($row['nilai_residu']) ?></td>

						                                    <td class="text-center">
						                                      <!--<a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
						                                              onclick="
						                                                edit(
						                                                  '<?php// echo $row['transaksi_aset_id'] ?>',
						                                                  '<?php// echo $row['aset_id'] ?>',
						                                                  '<?php// echo $row['jumlah'] ?>'
						                                                )">
						                                          <i class="fa fa-edit"></i>
						                                      </a>
						                                      &nbsp;-->
						                                      <a href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" data-toggle="tooltip" title="Hapus" class="text-danger btnDelete">
						                                        <i class="fa fa-trash"></i>
						                                      </a>
						                                    </td>
						                                  </tr>

						                          <?php } ?>

						                        </tbody>

						                          <tr>
						                            <td><input type="hidden" id="inputGrandTotal" name="grandTotal" value="<?php echo $grandTotal ?>"></td>
						                            <td colspan="2"><h4><b>TOTAL</b></h4></td>
						                            <td colspan="3" class="text-left"><h4><b id="grandTotal"><?php echo format_rp($grandTotal) ?></b></h4></td>
						                          </tr>

						                      </table>
						                    </div>
						                </div>
						              </div>

								</div>
							</div>
						</div>


					</div>
				</div>

<form method="post" id="formUpdate" enctype="multipart/form-data">
     <div class="modal fade" id="modalEditItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Jumlah</h4>
             </div>

             <input type="hidden" name="penjualan_detail_id" id="e_id">

             <div class="modal-body">
                <div class="form-group">
                   <label>Produk</label>
                   <input id="e_nama" type="text" name="nama_pr" id="nama_pr" class="form-control" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Jumlah</label>
                   <input type="number" name="qty" id="e_qty" class="form-control" placeholder="0" autocomplete="off">
                </div>
             </div>

             <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                <button type="submit" id="btnUpdate" class="btn btn-warning btn-flat"><i class="fa fa-edit"></i> Ubah</button>
             </div>

           </div>
        </div>
     </div>
   </form>


<script>

    $(document).on('change', '#produk', function(){
      var price = $('#produk option:selected').attr('data-price');
      $('#price').val(format_rp(price));
    });

    var site_url = "<?php echo site_url() ?>";
    var transaksi_id = "<?php echo $perolehan['id'] ?>"

    $(document).on('submit','#formAdd', function(e){
      e.preventDefault();

      if($('#harga').val() < 0){
        alert('Jumlah Produk harus > 0');
      }else{

        $.ajax({
          url    : site_url + "/insertProdukPenjualan",
          method : "POST",
          dataType : "json",
          data   : $('#formAdd').serialize(),
          beforeSend : function(){
            $('#formAdd').addClass('disable');
            $('#btnAdd').html('<i class="fa fa-spinner fa-spin"></i>');
          },
          success : function(res){
            if(res.status){
              $('#formAdd')[0].reset();
              
              $('#tableItem').html(reload(res.data));

            }else{
              alert(res.message);
            }
          },
          complete : function(){
            $('#formAdd').removeClass('disable');
            $('#btnAdd').html('<i class="fa fa-plus"></i>');
          }

        });

      }

      return false;
    });


    $(document).on('submit','#formUpdate', function(e){
      e.preventDefault();

      if($('#e_qty').val() < 0){
        alert('Jumlah Produk harus > 0');
      }else{

        $.ajax({
          url    : site_url + "/updateProdukPenjualan/"+ transaksi_id,
          method : "POST",
          dataType : "json",
          data   : $('#formUpdate').serialize(),
          beforeSend : function(){
            $('#formUpdate').addClass('disable');
            $('#btnUpdate').html('<i class="fa fa-spinner fa-spin"></i>');
          },
          success : function(res){
            if(res.status){
              $('#modalEditItem').modal('hide');
              $('#tableItem').html(reload(res.data));

            }else{
              alert(res.message);
            }
          },
          complete : function(){
            $('#formUpdate').removeClass('disable');
            $('#btnUpdate').html('<i class="fa fa-edit"></i> Ubah');
          }

        });

      }

      return false;
    })

    $(document).on('click','.btnDelete', function(){

        var id = $(this).attr('data-id');

        $.ajax({
          url    : site_url + "/deleteProdukPenjualan/"+ transaksi_id,
          method : "POST",
          dataType : "json",
          data   : {
            transaksi_aset_id : id
          },
          beforeSend : function(){
            $('.btnDelete').html('<i class="fa fa-spinner fa-spin"></i>');
          },
          success : function(res){
            if(res.status){
              $('#tableItem').html(reload(res.data));

            }else{
              alert(res.message);
            }
          }

        });

    })

    function reload(data){
      var grandTotal = 0; var txt = '';

      $.each(data, function(index, val){
        grandTotal += parseInt(val.subtotal);

        txt += "<tr id='row"+val.id+"'>";
        txt +=  "<td>"+val.komponen+"</td>";
        txt +=  "<td class='text-right' id='price_pcs"+val.id+"'>"+format_rp(val.harga)+"</td>";
        txt +=  "<td id='qty"+val.id+"'>"+val.qty+"</td>";
        txt +=  "<td class='text-right' id='price"+val.id+"'>"+format_rp(val.subtotal)+"</td>";
        txt +=  "<td class='text-right' id='nilai_residu"+val.id+"'>"+format_rp(val.nilai_residu)+"</td>";

        txt +=  "<td class='text-center'><a href='javascript:void(0)' data-id='"+val.id+"' class='text-danger btnDelete'><i class='fa fa-trash'></i></a></td>";

        //txt +=  "<td class='text-center'><a href='javascript:void(0)' onclick='edit("+ id +", &quot;"+ val.aset_id +"&quot;,"+ val.jumlah +")' data-id='"+id+"' data-qty='"+val.jumlah+"' data-toggle='tooltip' title='Ubah' class='text-warning'><i class='fa fa-edit'></i></a> <a href='javascript:void(0)' data-id='"+id+"' class='text-danger btnDelete'><i class='fa fa-trash'></i></a></td>";
        txt += "</tr>";

      });

      $('#inputGrandTotal').val(grandTotal);
      $('#grandTotal').html(format_rp(parseInt(grandTotal)));

      if($('#tipe').val() == 'Kredit'){
  		$('#total_bayar').removeAttr('readonly').val('');
  	
  	  }else if($('#tipe').val() == 'Tunai'){
  		$('#total_bayar').attr('readonly','readonly').val(format_rp($('#inputGrandTotal').val()));
  		
  		if($('#inputGrandTotal').val() == 0){
  			$('#btnSave').attr('disabled','disabled');
  		}
  	  }

      return txt;
    }

    $(document).on('change', '#tipe', function(){
      if($('#tipe').val() != ''){

      	if($('#tipe').val() == 'Kredit'){
      		$('#total_bayar').removeAttr('readonly').val('');
      	
      	}else{
      		$('#total_bayar').attr('readonly','readonly').val(format_rp($('#inputGrandTotal').val()));
      		$('#notifPrice').html('');
      		$('#btnSave').removeAttr('disabled');

      		if($('#inputGrandTotal').val() == 0){
	  			$('#btnSave').attr('disabled','disabled');
	  		}
      	}

      }else{
        $('#total_bayar').attr('readonly','readonly').val('Silahkan Pilih Tipe Pembayaran !');
      }
    })

    $(document).on('keyup', '#total_bayar', function(){
      if($('#tipe').val() == 'Kredit'){
        
        if(format_angka($('#total_bayar').val()) < $('#inputGrandTotal').val()){
          $('#btnSave').removeAttr('disabled').html('<i class="fa fa-check"></i> SIMPAN');
          $('#notifPrice').html('');
        
        }else{
          $('#btnSave').attr('disabled','disabled');
          $('#notifPrice').html('<span class="text-danger"><i class="fa fa-ban"></i> Tipe Kredit, tidak boleh bayar melebihi total perolehan</span>');
        }

      }else{

        if(format_angka($('#total_bayar').val()) >= $('#inputGrandTotal').val()){
          $('#btnSave').removeAttr('disabled').html('<i class="fa fa-check"></i> SIMPAN');
        
        }else{
          $('#btnSave').attr('disabled','disabled').html('<i class="fa fa-ban"></i> Tipe Tunai, total pembayaran harus melebihi total penjualan');
        }

      }
    })

    function edit(id, nama, qty){
      $('#e_id').val(id);
      $('#e_nama').val(nama);
      $('#e_qty').val(qty);
      $('#modalEditItem').modal('show'); 
    }
  </script>