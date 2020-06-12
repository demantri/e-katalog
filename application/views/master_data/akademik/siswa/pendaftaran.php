<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="row">
	<div class="wizard-container wizard-round col-md-9">
		<div class="wizard-header text-center">
			<h3 class="wizard-title"><b>PENDAFTARAN</b></h3>
			<small>Daftar Calon Siswa Baru</small>
		</div>

		<div class="row">
			<div class="col-md-12">
				<?php echo $this->session->flashdata('alert_message') ?>
			</div>
		</div>
		<form id="formDaftar" method="POST" action="<?php echo site_url('insertPendaftaran') ?>">
			<div class="wizard-body">
				<div class="row">

					<ul class="wizard-menu nav nav-pills nav-primary">
						<li class="step" style="width: 33.3333%;">
							<a class="nav-link active final-step" href="#about" data-toggle="tab" aria-expanded="true"><i class="fa fa-user mr-0"></i> Data Pendaftar</a>
						</li>
						<li class="step" style="width: 33.3333%;">
							<a class="nav-link final-step" href="#account" data-toggle="tab"><i class="fa fa-file mr-2"></i> Data Orang Tua</a>
						</li>
						<li class="step" style="width: 33.3333%;">
							<a class="nav-link final-step" href="#address" data-toggle="tab"><i class="fa fa-map-signs mr-2"></i> Konfirmasi</a>
						</li>
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane active" id="about">
						<div class="row">
							<div class="col-md-12">
								<h4 class="info-text">BIODATA CALON SISWA</h4>
							</div>
							<div class="col-sm-12 pl-0">
	                          <div class="form-group">
	                            <label for="name">Nama Lengkap</label>
	                            <input class="form-control" name="nama_lengkap" id="nama_lengkap" type="text" placeholder="Nama Lengkap..." required="required">
	                          </div>

	                          <div class="row">
	                            <div class="col-md-6">
	                              <div class="form-group">
	                                <label for="lname">Tempat Lahir</label>
	                                <input required="" class="form-control" name="tempat_lahir" id="tempat_lahir" type="text" placeholder="Tempat Lahir...">
	                              </div>
	                            </div>

	                            <div class="col-md-6">
	                              <div class="form-group">
	                                <label for="contact">Tanggal Lahir</label>
	                                <input required="" class="form-control date-picker" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir...">
	                              </div>
	                            </div>
	                          </div>

	                          <div class="form-group">
	                            <label for="name">Jenis Kelamin</label>
	                            <select required="" name="jenis_kelamin" id="jk" class="form-control">
	                              <option value="">Pilih</option>
	                              <option value="Laki - Laki">Laki - Laki</option>
	                              <option value="Perempuan">Perempuan</option>
	                            </select>
	                          </div>

	                          <div class="form-group">
	                            <label for="name">Agama</label>
	                            <select required="" id="agama" name="agama" class="form-control">
	                              <option value="">Pilih</option>
	                              <option value="Islam">Islam</option>
	                              <option value="Kristen">Kristen</option>
	                              <option value="Budha">Budha</option>
	                              <option value="Hindu">Hindu</option>
	                            </select>
	                          </div>

	                          <div class="row">
	                            <div class="col-md-6">
	                              <div class="form-group">
	                                <label for="lname">Jumlah Saudara</label>
	                                <input class="form-control" required="" id="jumlah_saudara" name="jumlah_saudara" type="text" placeholder="Jumlah Saudara...">
	                              </div>
	                            </div>

	                            <div class="col-md-6">
	                              <div class="form-group">
	                                <label for="contact">Anak Ke</label>
	                                <input class="form-control" required="" name="anak_ke" id="anak_ke" placeholder="Anak Ke...">
	                              </div>
	                            </div>
	                          </div>

	                          <div class="form-group">
	                            <label for="name">Alamat</label>
	                            <input class="form-control" name="alamat" id="alamat" type="text" placeholder="Alamat..." required="required">
	                          </div>

	                      </div>
						</div>
					</div>
					<div class="tab-pane" id="account">
						<h4 class="info-text">Data Orang Tua </h4>
						<div class="row">
                          <div class="col-md-6">
                            <div class="card">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-md-12">
                                    <h6><b>AYAH</b></h6><br>
                                    <div class="form-group">
                                      <label for="name">Nama Lengkap</label>
                                      <input required="" class="form-control" name="ot_bpk_nama_lengkap" id="bpk_nama_lengkap" type="text" placeholder="Nama Lengkap..." required="required">
                                    </div>

                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="lname">Tempat Lahir</label>
                                          <input required="" class="form-control" name="ot_bpk_tempat_lahir" id="bpk_tempat_lahir" type="text" placeholder="Tempat Lahir...">
                                        </div>
                                      </div>

                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="contact">Tanggal Lahir</label>
                                          <input required="" class="form-control date-picker" name="ot_bpk_tanggal_lahir" id="bpk_tanggal_lahir" placeholder="Tanggal Lahir...">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label for="contact">Agama</label>
                                      <select required="" id="bpk_agama" name="ot_bpk_agama" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Hindu">Hindu</option>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label for="contact">No Telp</label>
                                      <input class="form-control" name="ot_bpk_no_telp" id="bpk_no_telp" placeholder="No Telp..." required="">
                                    </div>

                                    <div class="form-group">
                                      <label for="contact">Pendidikan Terakhir</label>
                                      <input class="form-control" name="ot_bpk_pendidikan" id="bpk_pendidikan" placeholder="Pendidikan terakhir..." required="">
                                    </div>

                                    <div class="form-group">
                                      <label for="contact">Pekerjaan</label>
                                      <input class="form-control" name="ot_bpk_pekerjaan" id="bpk_pekerjaan" placeholder="Pekerjaan..." required="">
                                    </div>

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="card">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-md-12">
                                    <h6><b>IBU</b></h6><br>
                                    <div class="form-group">
                                      <label for="name">Nama Lengkap</label>
                                      <input class="form-control" name="ot_ib_nama_lengkap" id="ib_nama_lengkap" type="text" placeholder="Nama Lengkap..." required="required">
                                    </div>

                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="lname">Tempat Lahir</label>
                                          <input class="form-control" name="ot_ib_tempat_lahir" id="ib_tempat_lahir" type="text" placeholder="Tempat Lahir...">
                                        </div>
                                      </div>

                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="contact">Tanggal Lahir</label>
                                          <input class="form-control date-picker" name="ot_ib_tanggal_lahir" id="ib_tanggal_lahir" placeholder="Tanggal Lahir...">
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label for="contact">Agama</label>
                                      <select required="" id="ib_agama" name="ot_ib_agama" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Hindu">Hindu</option>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label for="contact">No Telp</label>
                                      <input class="form-control" name="ot_ib_no_telp" id="ib_no_telp" placeholder="No Telp...">
                                    </div>

                                    <div class="form-group">
                                      <label for="contact">Pendidikan Terakhir</label>
                                      <input class="form-control" name="ot_ib_pendidikan" id="ib_pendidikan" placeholder="Pendidikan Terakhir...">
                                    </div>

                                    <div class="form-group">
                                      <label for="contact">Pekerjaan</label>
                                      <input class="form-control" name="ot_ib_pekerjaan" id="ib_pekerjaan" placeholder="Pekerjaan...">
                                    </div>

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
					</div>
					<div class="tab-pane" id="address">
						<div class="row">
							<div class="col-md-12">
                            
                            <div class="card">
                              <div class="card-header text-center bg-primary">
                                <h4 class="card-title text-white">Konfirmasi Pendaftaran</h4>
                              </div>
                              <div class="card-body">

                                <div class="row">
                                  <div class="col-md-12 text-center">
                                    <small>KODE PENDAFTARAN</small>
                                    <?php $kode = generateRandom(8) ?>
                                    <h4><b><?php echo $kode ?></b></h4>
                                    <input type="hidden" name="kode_pendaftaran" value="<?php echo $kode ?>">
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-12">
                                      <h6><b>Data Siswa</b></h6>
                                      <br>
                                      <table class="table">
                                        <tr>
                                          <th>Nama Lengkap</th>
                                          <td id="o_nama_lengkap"></td>
                                          <th>Agama</th>
                                          <td id="o_agama"></td>
                                        </tr>

                                        <tr>
                                          <th>Tempat / Tanggal Lahir</th>
                                          <td id="o_ttl"></td>
                                          <th>Anak Ke</th>
                                          <td id="o_anak_ke"></td>
                                        </tr>

                                        <tr>
                                          <th>Jenis Kelamin</th>
                                          <td id="o_jk"></td>
                                          <th>Jumlah Saudara</th>
                                          <td id="o_jumlah_saudara"></td>
                                        </tr>

                                        <tr>
                                          <th>Alamat</th>
                                          <td id="o_alamat" colspan="3"></td>
                                        </tr>
                                      </table>

                                  </div>
                                </div>

                                <hr>

                                <div class="row">
                                  <div class="col-md-6">
                                    <h6><b>Data Ayah</b></h6>
                                      <br>
                                      <table class="table">
                                        <tr>
                                          <th>Nama Lengkap</th>
                                          <td id="o_bpk_nama_lengkap"></td>
                                        </tr>

                                        <tr>
                                          <th>Tempat / Tanggal Lahir</th>
                                          <td id="o_bpk_ttl"></td>
                                        </tr>

                                        <tr>
                                          <th>No Telepon</th>
                                          <td id="o_bpk_no_telp"></td>
                                        </tr>

                                        <tr>
                                          <th>Agama</th>
                                          <td id="o_bpk_agama"></td>
                                        </tr>

                                        <tr>
                                          <th>Pendidikan</th>
                                          <td id="o_bpk_pendidikan"></td>
                                        </tr>

                                        <tr>
                                          
                                          <th>Pekerjaan</th>
                                          <td id="o_bpk_pekerjaan"></td>
                                        </tr>
                                      </table>
                                  </div>

                                  <div class="col-md-6">
                                    <h6><b>Data Ibu</b></h6>
                                      <br>
                                      <table class="table">
                                        <tr>
                                          <th>Nama Lengkap</th>
                                          <td id="o_ib_nama_lengkap"></td>
                                        </tr>

                                        <tr>
                                          <th>Tempat / Tanggal Lahir</th>
                                          <td id="o_ib_ttl"></td>
                                        </tr>

                                        <tr>
                                          <th>No Telepon</th>
                                          <td id="o_ib_no_telp"></td>
                                        </tr>

                                        <tr>
                                          <th>Agama</th>
                                          <td id="o_ib_agama"></td>
                                        </tr>

                                        <tr>
                                          <th>Pendidikan</th>
                                          <td id="o_ib_pendidikan"></td>
                                        </tr>

                                        <tr>
                                          
                                          <th>Pekerjaan</th>
                                          <td id="o_ib_pekerjaan"></td>
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
			</div>

			<div class="wizard-action">
				<div class="pull-left">
					<input type="button" class="btn btn-previous btn-fill btn-black" name="previous" value="Previous">
				</div>
				<div class="pull-right">
					<input type="button" class="btn btn-next btn-danger final-step" name="next" value="Next">
					<input id="finalBtn" type="button" class="btn btn-finish btn-danger" name="finish" value="Finish" style="display: none;">
				</div>
				<div class="clearfix"></div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
  $('.date-picker').datepicker({
    dateFormat:"yy-mm-dd",
    changeMonth: true,
    changeYear: true
  });

  $(document).on('click', '.final-step', function(){

    $('#o_nama_lengkap').text($('#nama_lengkap').val());
    $('#o_alamat').text($('#alamat').val());
    $('#o_anak_ke').text($('#anak_ke').val());
    $('#o_jumlah_saudara').text($('#jumlah_saudara').val());
    $('#o_jk').text($('#jk').val());
    $('#o_ttl').text($('#tempat_lahir').val() + " / " + $('#tanggal_lahir').val());
    $('#o_agama').text($('#agama').val());

    $('#o_bpk_nama_lengkap').text($('#bpk_nama_lengkap').val());
    $('#o_bpk_ttl').text($('#bpk_tempat_lahir').val() + " / " + $('#bpk_tanggal_lahir').val());
    $('#o_bpk_agama').text($('#bpk_agama').val());
    $('#o_bpk_no_telp').text($('#bpk_no_telp').val());
    $('#o_bpk_pendidikan').text($('#bpk_pendidikan').val());
    $('#o_bpk_pekerjaan').text($('#bpk_pekerjaan').val());

    $('#o_ib_nama_lengkap').text($('#ib_nama_lengkap').val());
    $('#o_ib_ttl').text($('#ib_tempat_lahir').val() + " / " + $('#ib_tanggal_lahir').val());
    $('#o_ib_agama').text($('#ib_agama').val());
    $('#o_ib_no_telp').text($('#ib_no_telp').val());
    $('#o_ib_pendidikan').text($('#ib_pendidikan').val());
    $('#o_ib_pekerjaan').text($('#ib_pekerjaan').val());

  });

  $(document).on('click', '#finalBtn', function(){

    r = confirm('Apakah kamu yakin ?');

    if(r){
      $('#formDaftar').submit();
    }

  })
</script>