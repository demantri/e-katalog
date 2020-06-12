
<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Keuangan</h4> &emsp; <small><b>Beban</b></small>
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
				<a href="#">Beban</a>
			</li>
			<li class="separator">
				<i class="fa fa-arrow-right"></i>
			</li>
			<li class="nav-item">
				<a href="#">Tambah</a>
			</li>
		</ul>
		
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Tambah Transaksi Beban</h4>
				</div>
				<div class="card-body">

					<div class="row">
						<div class="col-md-12">
							<?php echo $this->session->flashdata('alert_message') ?>
						</div>
					</div>

					<a href="<?php echo site_url('transaksi/keuangan/beban') ?>" class="btn btn-outline-primary btn-flat mt-2 mb-2"><i class="fa fa-chevron-left"></i> Kembali</a>
		            <br><br>
		            <div class="row">
		            	<div class="col-md-4">
		            		<div class="card">
		            			<div class="card-header">
		            				<div class="">DETAIL</div>
		            			</div>

		            			<form method="POST" action="<?php echo site_url('insert_transaksi_keluar/'.$pembelian['id']) ?>">

			                        <div class="row">
		                                <div class="form-group">
		                                     <label>Kode Pembelian</label>
		                                     <input type="text" name="kode_transaksi" id="kode_pembelian" class="form-control" placeholder="Kode Bahan Baku" value="<?php echo $pembelian['kode_transaksi'];?>" readonly="" autocomplete="off" required />
		                                </div>

		                                <div class="form-group">
		                                   <label>Tipe Pembayaran</label>
		                                   <select required="" class="form-control" name="pembayaran" id="tipe">
		                                     <option value="">Pilih</option>
		                                     <option value="Kredit">Kredit</option>
		                                     <option value="Tunai">Tunai</option>
		                                   </select>
		                                </div>

                                    <div class="form-group">
                                       <label>Metode</label>
                                       <select required="" class="form-control" name="metode">
                                         <option value="">Pilih</option>
                                         <option value="Cash">Cash</option>
                                         <option value="Transfer">Transfer</option>
                                       </select>
                                    </div>

		                                <div class="form-group">
		                                     <label>Total Bayar</label>
		                                     <input value="Silahkan Pilih Tipe Pembayaran !" disabled="" id="total_bayar" type="text" name="total_bayar" class="form-control rupiah" placeholder="Total Dibayar" autocomplete="off" required />
		                                </div>

		                                <div class="form-group">
		                                    <br>
		                                     <button style="margin-top: 8px" id="btnSave" disabled="disabled" class="btn btn-flat btn-block btn-success"><i class="fa fa-check"></i> SIMPAN</button>
		                                </div>
			                        </div>

		                        </form>
		            		</div>
		            	</div>

		            	<div class="col-md-8">
		            		<div class="card">
		            			<div class="card-header">
		            				<div class=""></div>
		            			</div>
		            		</div>

		            		<form method="POST" id="formAdd">
                            <div class="row">
                              
                                <input type="hidden" name="transaksi_id" value="<?php echo $pembelian['id'] ?>">
                                <div class="form-group col-md-6">
                                   <label>Beban</label>
                                   <select class="form-control" name="beban_id" id="produk">
                                     <option value="" data-price="0">Pilih</option>
                                     <?php foreach ($bb as $row){ ?>
                                              <option value="<?php echo $row['beban_id'] ?>"><?php echo $row['kode_beban']." / ".$row['nama_beban'] ?></option>
                                     <?php } ?>
                                   </select>
                                </div>

                                <div class="form-group col-md-4">
                                   <label>Keterangan</label>
                                   <input type="text" id="ket" name="keterangan" class="form-control" autocomplete="off">
                                </div>

                                <div class="form-group col-md-2">
                                   <label>Total</label>
                                   <input type="text" id="price" name="harga" class="form-control rupiah" autocomplete="off" placeholder="Rp. 0">
                                </div>

                                <div class="form-group col-md-2" hidden="">
                                   <label>Jumlah</label>
                                   <input type="number" name="qty" class="form-control" placeholder="0" autocomplete="off" value="1" readonly="">
                                </div>

                                <div class="form-group col-md-1">
                                   
                                   <label></label><br>
                                   <button id="btnAdd" data-toggle="tooltip" title="Tambah" style="margin-top:8px" class="btn btn-primary btn-sm btn-flat">
                                      <i class="fa fa-plus"></i>
                                   </button>
                                </div>
                              
                          </div>
                        </form>

                           <div class="table-responsive">
                            <table class="table">
                              <thead style="background-color:#eee">
                                <tr>
                                  <th>BEBAN</th>
                                  <th>NOMINAL</th>
                                  <!-- <th style="width: 10%">JUMLAH</th> -->
                                  <!-- <th style="width: 20%">SUBTOTAL</th> -->
                                  <th style="width: 30%">KETERANGAN</th>
                                  <th class="text-center"><i class="fa fa-cog"></i></th>
                                </tr>
                              </thead>

                              <tbody id="tableItem">
                                <?php $n = $grandTotal = 0; 
                                      // foreach ($item as $row) { $n++; $grandTotal += $row['qty'] * $row['harga']
                                      foreach ($item as $row) { $n++; $grandTotal += $row['harga']?>

                                        <tr>
                                          <td><?php echo $row['komponen'] ?></td>
                                          <td><?php echo format_rp($row['harga']) ?></td>
                                          <td><?php echo $row['keterangan']?></td>
                                          <td class="text-center">
                                            <a href="javascript:void(0)" data-toggle="tooltip" title="Ubah" class="text-warning"
                                                    onclick="
                                                      edit(
                                                        '<?php echo $row['id'] ?>',
                                                        '<?php echo $row['komponen'] ?>',
                                                        // '<?php echo $row['qty'] ?>'
                                                      )">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            &nbsp;
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
                                  <td class="text-right"><h4><b id="grandTotal"><?php echo format_rp($grandTotal) ?></b></h4></td>
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
                <h4 class="modal-title text-white" id="myModalLabel"><i class="fa fa-edit"></i> Ubah Jumlah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>

             </div>

             <input type="hidden" name="transaksi_beban_id" id="e_id">

             <div class="modal-body">
                <div class="form-group">
                   <label>Beban</label>
                   <input id="e_nama" type="text" name="nama_pr" id="nama_pr" class="form-control" readonly="" autocomplete="off" required />
                </div>

                <div class="form-group">
                   <label>Keterangan</label>
                   <input id="ket" type="text" name="keterangan"  class="form-control" autocomplete="off" value="<?php echo $row['keterangan']?>" />
                </div>

                <!-- <div class="form-group">
                   <label>Jumlah</label>
                   <input type="number" name="qty" id="e_qty" class="form-control" placeholder="0" autocomplete="off">
                </div> -->
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
    $(function() {
      $( ".datepicker" ).datepicker({
        dateFormat : "yy-mm-dd",
        minDate : 0
      });
    });

    var site_url = "<?php echo site_url() ?>";
    var pembelian_id = "<?php echo $pembelian['id'] ?>";

    $(document).on('submit','#formAdd', function(e){
      e.preventDefault();

      if($('#harga').val() < 0){
        alert('Jumlah Produk harus > 0');
      }else{

        $.ajax({
          url    : site_url + "/insertProdukKeluar",
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
          url    : site_url + "/updateProdukKeluar/"+ pembelian_id,
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
          url    : site_url + "/deleteProdukKeluar/"+ pembelian_id,
          method : "POST",
          dataType : "json",
          data   : {
            transaksi_beban_id : id
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
      var grandTotal = 0;
      var txt = '';

      $.each(data, function(index, val){
        var subtotal = parseInt(val.harga);
        grandTotal += subtotal;
        var id = val.transaksi_beban_id;

        txt += "<tr id='row"+id+"'>";
        txt +=  "<td>"+val.komponen+"</td>";
        txt +=  "<td class='text-right'>"+format_rp(val.harga)+"</td>";
        // txt +=  "<td id='qty"+id+"'>"+val.qty+"</td>";
        // txt +=  "<td class='text-right' id='price"+id+"'>"+format_rp(val.harga * val.qty)+"</td>";
        // txt +=  "<td class='text-right' id='price"+id+"'>"+format_rp(val.harga)+"</td>";

        // tambah keterangan
        txt +=  "<td>"+val.keterangan+"</td>";
        // txt +=  "<td class='text-center'><a href='javascript:void(0)' onclick='edit("+ id +", &quot;"+ val.komponen +"&quot;,"+ val.qty +")' data-id='"+id+"' data-qty='"+val.qty+"' data-toggle='tooltip' title='Ubah' class='text-warning'><i class='fa fa-edit'></i></a> <a href='javascript:void(0)' data-id='"+id+"' class='text-danger btnDelete'><i class='fa fa-trash'></i></a></td>";
        txt +=  "<td class='text-center'><a href='javascript:void(0)' onclick='edit("+ id +", &quot;"+ val.komponen +"&quot)' data-id='"+id+"'  data-toggle='tooltip' title='Ubah' class='text-warning'><i class='fa fa-edit'></i></a> <a href='javascript:void(0)' data-id='"+id+"' class='text-danger btnDelete'><i class='fa fa-trash'></i></a></td>";
        txt += "</tr>";

      });

      $('#inputGrandTotal').val(grandTotal);
      $('#grandTotal').html(format_rp(grandTotal));

      return txt;
    }

    $(document).on('change', '#tipe', function(){
      if($('#tipe').val() != ''){
        $('#total_bayar').removeAttr('disabled').val('');
      }else{
        $('#total_bayar').attr('disabled','disabled').val('Silahkan Pilih Tipe Pembayaran !');
      }
    })

    $(document).on('keyup', '#total_bayar', function(){
      if($('#tipe').val() == 'Kredit'){
        
        if(format_angka($('#total_bayar').val()) < $('#inputGrandTotal').val()){
          $('#btnSave').removeAttr('disabled').html('<i class="fa fa-check"></i> SIMPAN');
        
        }else{
          $('#btnSave').attr('disabled','disabled').html('<i class="fa fa-ban"></i> Tipe Kredit, tidak boleh bayar melebihi total pembelian');
        }

      }else{

        if(format_angka($('#total_bayar').val()) >= $('#inputGrandTotal').val()){
          $('#btnSave').removeAttr('disabled').html('<i class="fa fa-check"></i> SIMPAN');
        
        }else{
          $('#btnSave').attr('disabled','disabled').html('<i class="fa fa-ban"></i> Tipe Tunai, total pembayaran harus melebihi total pembelian');
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