<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Auth/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//----------------------------------------------------//
//                       ASSET                        //
//----------------------------------------------------//

	######################
	//	MASTER DATA 	//
	######################
	
		## Kategori
		$route['master_data/asset/kategori']   = 'asset/Kategori';
		$route['insert_kategori']			   = 'asset/Kategori/add';
		$route['update_kategori']			   = 'asset/Kategori/update';
		$route['delete_kategori/(:any)'] 	   = 'asset/Kategori/delete/$1';

		## Aktiva
		$route['master_data/asset/aktiva']               = 'asset/Aktiva';
		$route['master_data/asset/aktiva/detail/(:any)'] = 'asset/Aktiva/detail/$1';
		$route['insert_aktiva']			     = 'asset/Aktiva/add';
		$route['update_aktiva']			     = 'asset/Aktiva/update';
		$route['delete_aktiva/(:any)'] 	     = 'asset/Aktiva/delete/$1';

		## Lokasi
		$route['master_data/asset/lokasi']   = 'asset/Lokasi';
		$route['insert_lokasi']			     = 'asset/Lokasi/add';
		$route['update_lokasi']			     = 'asset/Lokasi/update';
		$route['delete_lokasi/(:any)'] 	     = 'asset/Lokasi/delete/$1';

		## Vendor
		$route['master_data/asset/vendor']   = 'asset/Vendor';
		$route['insert_vendor']			     = 'asset/Vendor/add';
		$route['update_vendor']			     = 'asset/Vendor/update';
		$route['delete_vendor/(:any)'] 	     = 'asset/Vendor/delete/$1';


	######################
	//	TRANSAKSI 	    //
	######################

		## Perolehan
		$route['transaksi/asset/perolehan']               = 'asset/Perolehan';
		$route['transaksi/asset/perolehan/add']			  = 'asset/Perolehan/add';
		$route['transaksi/asset/perolehan/detail/(:any)'] = 'asset/Perolehan/detail/$1';
		$route['transaksi/asset/konfirmasi']              = 'asset/Perolehan/konfirmasi';

		$route['insert_transaksi/(:any)']  		  = 'asset/Perolehan/insert/$1';
		$route['insertProdukPenjualan']    		  = 'asset/Perolehan/insert_produk';
		$route['updateProdukPenjualan/(:any)']    = 'asset/Perolehan/update_produk/$1';
		$route['deleteProdukPenjualan/(:any)']    = 'asset/Perolehan/delete_produk/$1';

		## Penempatan Aktiva
		$route['transaksi/asset/penempatan']   = 'asset/Lokasi/penempatan';
		$route['insert_asset_location/(:any)'] = 'asset/Lokasi/insert_asset_location/$1';

		## Retur
		$route['set_retur/(:any)']	= 'asset/Perolehan/set_retur/$1';

		## Penyusutan
		$route['transaksi/asset/penyusutan']    = 'asset/Penyusutan';
		$route['get_detail_aset/(:any)/(:any)'] = 'asset/Penyusutan/call_detail_aset/$1/$2';

		## Pemeliharaan
		$route['transaksi/asset/pemeliharaan']  	= 'asset/Aktiva/pemeliharaan';
		$route['transaksi/asset/pemeliharaan/add']  = 'asset/Aktiva/pemeliharaan_add';
		$route['insertProdukPemeliharaan']			= 'asset/Aktiva/insert_pemeliharaanProduk';
		$route['deleteProdukPemeliharaan/(:any)']	= 'asset/Aktiva/delete_pemeliharaanProduk/$1';
		$route['insert_pemeliharaan/(:any)']		= 'asset/Aktiva/insert_pemeliharaan/$1';
		$route['transaksi/asset/pemeliharaan/detail/(:any)'] = 'asset/Aktiva/pemeliharaan_detail/$1';

//----------------------------------------------------//
//                       AKADEMIK                     //
//----------------------------------------------------//

	######################
	//	MASTER DATA 	//
	######################
	
		## Kelas
		$route['master_data/akademik/kelas']  = 'akademik/Kelas';
		$route['insert_kelas']			   	  = 'akademik/Kelas/add';
		$route['update_kelas']			   	  = 'akademik/Kelas/update';
		$route['delete_kelas/(:any)'] 	   	  = 'akademik/Kelas/delete/$1';

		## Kelas
		$route['master_data/akademik/komponen_biaya'] = 'akademik/Komponen';
		$route['insert_komponen']		 	 = 'akademik/Komponen/add';
		$route['update_komponen']		 	 = 'akademik/Komponen/update';
		$route['delete_komponen/(:any)'] 	 = 'akademik/Komponen/delete/$1';

		## TAHUN AJARAN
		$route['master_data/akademik/tahun_ajaran'] = 'akademik/Tahun_ajaran';
		$route['insert_tahun_ajaran']		   		= 'akademik/Tahun_ajaran/add';
		$route['update_tahun_ajaran']		   		= 'akademik/Tahun_ajaran/update';
		$route['delete_tahun_ajaran/(:any)']   		= 'akademik/Tahun_ajaran/delete/$1';
		$route['set_active_ta/(:any)/(:any)']  		= 'akademik/Tahun_ajaran/set_active/$1/$2';
			// |
			// |
			// -> # KOMPONEN
			$route['master_data/akademik/tahun_ajaran/detail/(:any)'] = 'akademik/Tahun_ajaran/detail/$1';
			$route['insert_ta_komponen/(:any)']	   			 = 'akademik/Tahun_ajaran/insert_komponen/$1';
			$route['update_ta_komponen/(:any)']				 = 'akademik/Tahun_ajaran/update_komponen/$1';
			$route['delete_ta_komponen/(:any)/(:any)']		 = 'akademik/Tahun_ajaran/delete_komponen/$1/$2';

		## PENDAFTARAN
		$route['master_data/akademik/pendaftaran/add'] 	   = 'akademik/Siswa/pendaftaran';
		$route['master_data/akademik/siswa']     		   = 'akademik/Siswa/pendaftaran_list';
		$route['master_data/akademik/siswa/detail/(:any)'] = 'akademik/Siswa/detail/$1';

		$route['master_data/pendaftaran/detail/(:any)'] = 'akademik/Siswa/detail/$1';
		$route['insertPendaftaran']	          			= 'akademik/Siswa/insert_pendaftaran';
		$route['undur_diri_siswa/(:any)']				= 'akademik/Siswa/undur_diri/$1';

	######################
	//	MASTER DATA 	//
	######################

		## PEMBAYARAN PENDAFTARAN
		$route['transaksi/keuangan/pembayaran_pendidikan/(:any)'] = 'akademik/Pembayaran/pembayaran_pendidikan/$1';
		$route['insert_pembayaranPendaftaran']	= 'akademik/Pembayaran/insert_pendaftaran';
		$route['insert_pembayaranBulanan']		= 'akademik/Pembayaran/insert_bulanan';


//----------------------------------------------------//
//                     KEUANGAN                       //
//----------------------------------------------------//

	######################
	//	MASTER DATA 	//
	######################

		## Rekening
		$route['master_data/keuangan/rekening'] = 'keuangan/Rek';
		$route['master_data/keuangan/rekening/detail/(:any)'] = 'keuangan/Rek/detail/$1';
		$route['insert_rekening']			   	= 'keuangan/Rek/add';
		$route['update_rekening']			   	= 'keuangan/Rek/update';
		$route['delete_rekening/(:any)'] 	   	= 'keuangan/Rek/delete/$1';

		## Coa
		$route['master_data/keuangan/coa']   	= 'keuangan/Coa';
		$route['insert_coa']					= 'keuangan/Coa/add';
		$route['update_coa']					= 'keuangan/Coa/update';
		$route['delete_coa/(:any)'] 			= 'keuangan/Coa/delete/$1';

		## Pemilik
		$route['master_data/keuangan/pemilik']   	= 'keuangan/Pemilik';
		$route['insert_pemilik']					= 'keuangan/Pemilik/add';
		$route['update_pemilik']					= 'keuangan/Pemilik/update';
		$route['delete_pemilik/(:any)'] 			= 'keuangan/Pemilik/delete/$1';

		## Beban
		$route['master_data/keuangan/beban'] 			= 'keuangan/Beban';
		$route['insert_beban']			   	= 'keuangan/Beban/add';
		$route['update_beban']			   	= 'keuangan/Beban/update';
		$route['delete_beban/(:any)'] 	   	= 'keuangan/Beban/delete/$1';


	######################
	//	TRANSAKSI 	    //
	######################

		## CASH OUT
		$route['transaksi/keuangan/cash_out'] = 'keuangan/Cashflow/cash_out';
		$route['transaksi/keuangan/cash_out/detail/(:any)'] = 'keuangan/Cashflow/cash_out_detail/$1';
		$route['insert_approve_keuangan/(:any)/(:any)'] = 'keuangan/Cashflow/set_approval/$1/$2';

		## CASH IN
		$route['transaksi/keuangan/cash_in'] = 'keuangan/Cashflow/cash_in';
		$route['transaksi/keuangan/cash_in/detail/(:any)'] = 'keuangan/Cashflow/cash_in_detail/$1';

		## SETORAN
		$route['transaksi/keuangan/setoran/(:any)'] = 'keuangan/Setoran/dana/$1';
		$route['insert_setoran/(:any)']				= 'keuangan/Setoran/add/$1';

		## BOP
		$route['transaksi/keuangan/bop_in'] 		= 'Keuangan/Bop/bop_masuk';
		$route['insert_bop']						= 'Keuangan/Bop/add_bop';
		$route['transaksi/keuangan/bop_out'] 		= 'Keuangan/Bop/bop_keluar';
		$route['transaksi/keuangan/bop_out/detail/(:any)'] = 'Keuangan/Bop/bop_keluar_detail/$1';
		$route['insert_pengeluaran_bop/(:any)']		= 'Keuangan/Bop/add_bop_keluar/$1';

		## SETORAN BANK
		$route['transaksi/keuangan/setoran_bank/(:any)'] = 'keuangan/Bank/dana/$1';
		$route['insert_setoran_bank/(:any)']			 = 'keuangan/Bank/add/$1';

		## TABUNGAN
		$route['transaksi/keuangan/tabungan_siswa'] = 'keuangan/Tabungan';
		$route['insert_tabungan_siswa/(:any)']		= 'keuangan/Tabungan/add/$1';

		## PELUNASAN
		$route['transaksi/keuangan/pelunasan/(:any)']	= 'keuangan/Pelunasan/get_page/$1';
		$route['transaksi/keuangan/pelunasan/(:any)/detail/(:any)'] = 'keuangan/Pelunasan/detail/$1/$2';
		$route['insert_pembayaran/(:any)/(:any)'] = 'keuangan/Pelunasan/insert_pembayaran/$1/$2';

		## JURNAL
		$route['transaksi/keuangan/jurnal']				  = 'keuangan/Jurnal';
		$route['transaksi/keuangan/jurnal/detail/(:any)'] = 'keuangan/Jurnal/detail/$1';
		$route['post_jurnal/(:any)']					  = 'keuangan/Jurnal/post_jurnal/$1';

		## Pemeliharaan
		$route['transaksi/keuangan/beban']  		= 'keuangan/Beban/keluar';
		$route['transaksi/keuangan/beban/add']  	= 'keuangan/Beban/keluar_add';
		$route['transaksi/keuangan/beban/detail/(:any)'] 	= 'keuangan/Beban/keluar_detail/$1';

		$route['insert_transaksi_keluar/(:any)']  	= 'Keuangan/Beban/keluar_insert/$1';

		$route['insertProdukKeluar']    		  	= 'keuangan/Beban/insert_produk';
		$route['updateProdukKeluar/(:any)']    		= 'keuangan/Beban/update_produk/$1';
		$route['deleteProdukKeluar/(:any)']    		= 'keuangan/Beban/delete_produk/$1';



//----------------------------------------------------//
//                     KEPALA SEKOLAH                 //
//----------------------------------------------------//

	######################
	//	MASTER DATA 	//
	######################


	######################
	//	TRANSAKSI 	    //
	######################

		## REVIEW PENDANAAN
		$route['transaksi/review/cashflow'] = 'Review/cashflow';
		$route['transaksi/review/cashflow/detail/(:any)'] = 'Review/detail_cashflow/$1';
		$route['set_trans_level/(:any)/(:any)']	= 'Review/set_approval/$1/$2';


//----------------------------------------------------//
//                   HUMAN RESOURCE                   //
//----------------------------------------------------//

	######################
	//	MASTER DATA 	//
	######################
	
		## Jabatan
		$route['master_data/hr/jabatan']   	   = 'hr/Jabatan';
		$route['insert_jabatan']			   = 'hr/Jabatan/add';
		$route['update_jabatan']			   = 'hr/Jabatan/update';
		$route['delete_jabatan/(:any)'] 	   = 'hr/Jabatan/delete/$1';

		## Karyawan
		$route['master_data/hr/karyawan']      = 'hr/Karyawan';
		$route['insert_karyawan']			   = 'hr/Karyawan/add';
		$route['update_karyawan']			   = 'hr/Karyawan/update';
		$route['delete_karyawan/(:any)'] 	   = 'hr/Karyawan/delete/$1';

		## Waktu
		$route['master_data/hr/waktu']     = 'hr/Waktu';
		$route['update_waktu']			   = 'hr/Waktu/update';
		$route['set_waktu_presensi/(:any)/(:any)'] = 'hr/Waktu/set_waktu/$1/$2';

		## Tunjangan
		$route['master_data/hr/tunjangan']     = 'hr/Tunjangan';
		$route['insert_tunjangan']			   = 'hr/Tunjangan/add';
		$route['update_tunjangan']			   = 'hr/Tunjangan/update';
		$route['delete_tunjangan/(:any)/(:any)'] 	   = 'hr/Tunjangan/delete/$1/$2';

		$route['master_data/hr/tunjangan_lain']     = 'hr/Tunjangan/tunjangan_dll';

	######################
	//	  TRANSAKSI   	//
	######################

		## ABSENSI
		$route['transaksi/hr/absensi/cuti']   	= 'hr/Absensi/cuti';
		$route['transaksi/hr/absensi/daftar']	= 'hr/Absensi/daftar';
		$route['insert_absen']			        = 'hr/Absensi/insert_absen';
		$route['set_izin/(:any)/(:any)']  		= 'hr/Absensi/set_izin/$1/$2';

		## GAJI
		$route['transaksi/hr/gaji/lembur']   	= 'hr/Gaji/lembur';
		$route['insert_lembur']					= 'hr/Gaji/insert_lembur';
		$route['transaksi/hr/gaji/daftar']		= 'hr/Gaji/daftar';
		$route['transaksi/hr/gaji/daftar/detail/(:any)'] = 'hr/Gaji/detail/$1';
		$route['transaksi/hr/gaji/daftar/detail/(:any)/cetak/(:any)'] = 'hr/Gaji/cetak_slip/$1/$2';
		$route['transaksi/hr/gaji/daftar/preview/(:any)/(:any)'] = 'hr/Gaji/detail_preview/$1/$2';
		$route['generate_gaji']					= 'hr/Gaji/generate_gaji';



$route['laporan/jurnal']   							= 'Laporan/jurnal';

$route['laporan/penggajian']   						= 'Laporan/penggajian';
$route['laporan/penggajian/detail/(:any)/(:any)']   = 'Laporan/penggajian_detail/$1/$2';

$route['laporan/piutang/(:any)']   						= 'Laporan/piutang/$1';


//----------------------------------------------------//
//                  	KARYAWAN  	                  //
//----------------------------------------------------//

$route['karyawan']		= 'Dashboard/karyawan';
$route['karyawan/izin'] = 'Dashboard/izin';
$route['insert_izin']	= 'hr/Absensi/insert_izin';

$route['karyawan/gaji'] = 'Dashboard/gaji';
$route['karyawan/gaji/detail/(:any)'] = 'Dashboard/gaji_detail/$1';

$route['karyawan/pinjaman'] = 'Dashboard/pinjaman';
$route['insert_pinjaman'] = 'hr/Gaji/insert_pinjaman';

$route['rfid']	= 'Auth/rfid';
$route['insert_rfid'] = 'Auth/insert_rfid';