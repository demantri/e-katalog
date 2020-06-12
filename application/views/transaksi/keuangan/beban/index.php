

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
						</ul>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Daftar Transaksi Beban</h4>
								</div>
								<div class="card-body">

									<div class="row">
										<div class="col-md-12">
											<?php echo $this->session->flashdata('alert_message') ?>
										</div>
									</div>

									<a href="<?php echo site_url('transaksi/keuangan/beban/add') ?>" class="btn btn-primary btn-flat mt-2 mb-2"><i class="fa fa-plus"></i> Tambah Transaksi Beban</a>
						              <br><br>

									<div class="table-responsive">
										<table class="table datatable">
					                        <thead>
					                          <tr>
					                            <th>NO</th>
					                            <th>KODE</th>
					                            <th>TANGGAL BEBAN</th>
					                            <th>TOTAL BEBAN</th>
					                            <th class="text-center">STATUS</th>
					                            <th class="text-center"><i class="fa fa-cog"></i></th>
					                          </tr>
					                        </thead>

					                        <tbody>
					                          <?php $n = 0; 
					                                foreach ($list as $row) { $n++; ?>

					                                  <tr>
					                                    <td><?php echo $n ?></td>
					                                    <td><?php echo $row['kode_transaksi'] ?></td>
					                                    <td><?php echo $row['tanggal_transaksi'] ?></td>
					                                    <td class="text-right"><?php echo format_rp($row['total_transaksi']) ?></td>
					                                    <td class="text-center"><?php echo show_level($row['level']) ?></td>
					                                    <td class="text-center">
					                                      <a href="<?php echo site_url('transaksi/keuangan/beban/detail/'.$row['id']) ?>" data-toggle="tooltip" title="Lihat Detail" class="btn btn-info btn-flat btn-sm">
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
