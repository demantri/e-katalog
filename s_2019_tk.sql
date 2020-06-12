-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2020 at 09:49 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `s_2019_tk`
--

-- --------------------------------------------------------

--
-- Table structure for table `ak_kelas`
--

CREATE TABLE `ak_kelas` (
  `id` int(10) NOT NULL,
  `kode_kelas` varchar(100) DEFAULT NULL,
  `nama_kelas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ak_kelas`
--

INSERT INTO `ak_kelas` (`id`, `kode_kelas`, `nama_kelas`) VALUES
(2, 'KLS-0001', 'A'),
(3, 'KLS-0002', 'B'),
(4, 'KLS-0003', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `ak_komponen_biaya`
--

CREATE TABLE `ak_komponen_biaya` (
  `id` int(10) NOT NULL,
  `kode_komponen` varchar(50) DEFAULT NULL,
  `nama_komponen` varchar(200) DEFAULT NULL,
  `cicilan` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ak_komponen_biaya`
--

INSERT INTO `ak_komponen_biaya` (`id`, `kode_komponen`, `nama_komponen`, `cicilan`) VALUES
(1, 'KMP-0001', 'Pendaftaran', '0'),
(2, 'KMP-0002', 'SPP', ''),
(3, 'KMP-0003', 'Uang Baju', '0'),
(4, 'KMP-0004', 'Uang Pembangunan', '0'),
(5, 'KMP-0005', 'Uang Buku', '0');

-- --------------------------------------------------------

--
-- Table structure for table `ak_siswa`
--

CREATE TABLE `ak_siswa` (
  `id` int(10) NOT NULL,
  `kelas_id` int(10) DEFAULT NULL,
  `tahun_ajaran_id` int(10) DEFAULT NULL,
  `kode_pendaftaran` varchar(50) DEFAULT NULL,
  `nis` int(50) DEFAULT NULL,
  `nama_lengkap` varchar(250) DEFAULT NULL,
  `tempat_lahir` varchar(200) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki - Laki','Perempuan') DEFAULT NULL,
  `agama` varchar(200) DEFAULT NULL,
  `anak_ke` int(50) DEFAULT NULL,
  `jumlah_saudara` int(50) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `ot_bpk_nama_lengkap` varchar(200) DEFAULT NULL,
  `ot_bpk_tempat_lahir` varchar(200) DEFAULT NULL,
  `ot_bpk_tanggal_lahir` date DEFAULT NULL,
  `ot_bpk_no_telp` varchar(13) DEFAULT NULL,
  `ot_bpk_agama` varchar(200) DEFAULT NULL,
  `ot_bpk_pekerjaan` varchar(200) DEFAULT NULL,
  `ot_bpk_pendidikan` varchar(200) DEFAULT NULL,
  `ot_ib_nama_lengkap` varchar(200) DEFAULT NULL,
  `ot_ib_tempat_lahir` varchar(200) DEFAULT NULL,
  `ot_ib_tanggal_lahir` date DEFAULT NULL,
  `ot_ib_no_telp` varchar(13) DEFAULT NULL,
  `ot_ib_agama` varchar(200) DEFAULT NULL,
  `ot_ib_pekerjaan` varchar(200) DEFAULT NULL,
  `ot_ib_pendidikan` varchar(200) DEFAULT NULL,
  `level` enum('0','1') DEFAULT '0',
  `is_undur` enum('0','1') DEFAULT '0',
  `tgl_undur` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ak_siswa`
--

INSERT INTO `ak_siswa` (`id`, `kelas_id`, `tahun_ajaran_id`, `kode_pendaftaran`, `nis`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `anak_ke`, `jumlah_saudara`, `alamat`, `ot_bpk_nama_lengkap`, `ot_bpk_tempat_lahir`, `ot_bpk_tanggal_lahir`, `ot_bpk_no_telp`, `ot_bpk_agama`, `ot_bpk_pekerjaan`, `ot_bpk_pendidikan`, `ot_ib_nama_lengkap`, `ot_ib_tempat_lahir`, `ot_ib_tanggal_lahir`, `ot_ib_no_telp`, `ot_ib_agama`, `ot_ib_pekerjaan`, `ot_ib_pendidikan`, `level`, `is_undur`, `tgl_undur`) VALUES
(27, NULL, 2, '28G4G5P6', NULL, 'asd', 'asd', '2020-03-04', 'Laki - Laki', 'Islam', 3, 5, 'asd', 'asd', 'asd', '2020-03-05', '123', 'Islam', 'asd', 'asd', 'asd', 'asd', '2020-03-05', '123', 'Islam', 'asd', 'asd', '0', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ak_tahun_ajaran`
--

CREATE TABLE `ak_tahun_ajaran` (
  `id` int(10) NOT NULL,
  `nama_ta` varchar(50) DEFAULT NULL,
  `waktu_mulai` date DEFAULT NULL,
  `waktu_selesai` date DEFAULT NULL,
  `is_aktif` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ak_tahun_ajaran`
--

INSERT INTO `ak_tahun_ajaran` (`id`, `nama_ta`, `waktu_mulai`, `waktu_selesai`, `is_aktif`) VALUES
(2, '2019 / 2020', '2020-03-05', '2021-02-05', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ak_tahun_ajaran_komponen`
--

CREATE TABLE `ak_tahun_ajaran_komponen` (
  `id` int(10) NOT NULL,
  `tahun_ajaran_id` int(10) DEFAULT NULL,
  `komponen_biaya_id` int(10) DEFAULT NULL,
  `nominal` int(50) DEFAULT NULL,
  `tipe` enum('Pendaftaran','Bulanan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ak_tahun_ajaran_komponen`
--

INSERT INTO `ak_tahun_ajaran_komponen` (`id`, `tahun_ajaran_id`, `komponen_biaya_id`, `nominal`, `tipe`) VALUES
(2, 2, 1, 50000, 'Pendaftaran'),
(3, 2, 2, 25000, 'Bulanan'),
(4, 2, 3, 150000, 'Pendaftaran'),
(5, 2, 4, 1500000, 'Pendaftaran'),
(6, 2, 5, 300000, 'Pendaftaran');

-- --------------------------------------------------------

--
-- Table structure for table `a_aset`
--

CREATE TABLE `a_aset` (
  `id` int(10) NOT NULL,
  `kategori_id` int(10) DEFAULT NULL,
  `kode_aset` varchar(50) DEFAULT NULL,
  `nama_aset` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a_aset`
--

INSERT INTO `a_aset` (`id`, `kategori_id`, `kode_aset`, `nama_aset`) VALUES
(12, 9, 'AT-0001', 'Genset 2000'),
(13, 12, 'AT-0002', 'Meja Olympic'),
(14, 13, 'AT-0003', 'Yamaha Vixion 2012');

-- --------------------------------------------------------

--
-- Table structure for table `a_aset_detail`
--

CREATE TABLE `a_aset_detail` (
  `id` int(11) NOT NULL,
  `transaksi_aset_id` int(11) DEFAULT NULL,
  `aset_id` int(11) DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `kode_detail_aset` varchar(50) DEFAULT NULL,
  `is_retur` enum('0','1') DEFAULT '0',
  `is_active` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `a_kategori`
--

CREATE TABLE `a_kategori` (
  `id` int(10) NOT NULL,
  `kode_kategori` varchar(50) DEFAULT NULL,
  `nama_kategori` varchar(200) DEFAULT NULL,
  `masa_pakai` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a_kategori`
--

INSERT INTO `a_kategori` (`id`, `kode_kategori`, `nama_kategori`, `masa_pakai`) VALUES
(9, 'KTG-0001', 'Mesin', 5),
(10, 'KTG-0002', 'Tanah', 10),
(11, 'KTG-0003', 'Gedung', 10),
(12, 'KTG-0004', 'Peralatan', 5),
(13, 'KTG-0005', 'Kendaraan', 5);

-- --------------------------------------------------------

--
-- Table structure for table `a_lokasi`
--

CREATE TABLE `a_lokasi` (
  `id` int(10) NOT NULL,
  `kode_lokasi` varchar(50) DEFAULT NULL,
  `nama_lokasi` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a_lokasi`
--

INSERT INTO `a_lokasi` (`id`, `kode_lokasi`, `nama_lokasi`) VALUES
(1, 'LKS-0001', 'Tata Usaha'),
(2, 'LKS-0002', 'Gudang'),
(3, 'LKS-0003', 'Aula'),
(4, 'LKS-0004', 'Administrasi'),
(6, 'LKS-0005', 'Parkiran');

-- --------------------------------------------------------

--
-- Table structure for table `a_penyusutan_log`
--

CREATE TABLE `a_penyusutan_log` (
  `id` int(10) NOT NULL,
  `bulan` int(10) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `log_fixed` date DEFAULT NULL,
  `tanggal_log` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `a_vendor`
--

CREATE TABLE `a_vendor` (
  `id` int(10) NOT NULL,
  `kode_vendor` varchar(50) DEFAULT NULL,
  `nama_vendor` varchar(200) DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `v_no_rek` varchar(50) DEFAULT NULL,
  `v_an` varchar(100) DEFAULT NULL,
  `v_bank` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a_vendor`
--

INSERT INTO `a_vendor` (`id`, `kode_vendor`, `nama_vendor`, `no_telp`, `alamat`, `keterangan`, `username`, `password`, `v_no_rek`, `v_an`, `v_bank`) VALUES
(3, 'VDR-0001', 'Ucok Bengkel', '083181826488', 'Jl. Antapani No.32, Kota Bandung, Jawa Barat', 'Tempat service kendaraan', 'gabot01', '123456', '123123', 'PT. Berkah Mandiri', 'BNI'),
(5, 'VDR-0002', 'Toni Repair', '0889932313', 'Jl. Bengkong Raya No.42, Bekasi Utara, Kota Bekasi, Jawa Barat', 'Perbaikan Perabot', 'gabot02', '123456', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hr_absensi`
--

CREATE TABLE `hr_absensi` (
  `id` int(10) NOT NULL,
  `karyawan_id` int(10) DEFAULT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `status` enum('hadir','izin','dinas','sakit','terlambat','cuti') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_absensi`
--

INSERT INTO `hr_absensi` (`id`, `karyawan_id`, `waktu_masuk`, `waktu_keluar`, `status`) VALUES
(1, 9, '2019-01-03 07:19:00', '2019-01-03 18:19:00', 'hadir'),
(2, 9, '2019-11-05 07:50:00', '2019-11-05 17:06:00', 'terlambat'),
(9, 9, '2019-11-26 00:00:00', '2019-11-26 00:00:00', 'dinas'),
(10, 9, '2019-11-27 00:00:00', '2019-11-27 00:00:00', 'dinas'),
(11, 9, '2019-11-28 00:00:00', '2019-11-28 00:00:00', 'dinas'),
(12, 9, '2019-12-03 06:54:00', '2019-12-03 18:54:00', 'hadir'),
(13, 9, '2020-02-03 06:18:00', '2020-02-03 18:18:00', 'hadir'),
(16, 9, '2020-02-07 06:39:43', '2020-02-07 18:42:07', 'hadir'),
(17, 9, '2020-02-04 06:25:00', '2020-02-04 17:25:00', 'hadir'),
(18, 9, '2020-02-05 06:25:00', '2020-02-05 17:25:00', 'hadir'),
(19, 9, '2020-02-06 07:25:00', '2020-02-06 17:25:00', 'hadir'),
(20, 9, '2020-02-10 07:45:00', '2020-02-10 17:26:00', 'terlambat'),
(21, 9, '2020-02-11 07:45:00', '2020-02-11 17:45:00', 'terlambat'),
(22, 9, '2020-02-14 06:25:00', '2020-02-14 17:26:00', 'hadir'),
(23, 9, '2020-02-17 06:27:00', '2020-02-17 18:27:00', 'hadir'),
(24, 9, '2020-02-18 07:27:00', '2020-02-18 18:27:00', 'hadir');

-- --------------------------------------------------------

--
-- Table structure for table `hr_gaji`
--

CREATE TABLE `hr_gaji` (
  `id` int(10) NOT NULL,
  `bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12') DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `waktu_generate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_gaji`
--

INSERT INTO `hr_gaji` (`id`, `bulan`, `tahun`, `waktu_generate`) VALUES
(15, '1', 2019, '2019-11-21 01:38:06'),
(16, '1', 2020, '2020-02-02 20:20:32'),
(20, '2', 2020, '2020-03-07 03:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `hr_gaji_detail`
--

CREATE TABLE `hr_gaji_detail` (
  `id` int(10) NOT NULL,
  `gaji_id` int(10) DEFAULT NULL,
  `karyawan_id` int(10) DEFAULT NULL,
  `total_masuk` int(10) DEFAULT '0',
  `total_hadir` int(10) DEFAULT NULL,
  `total_terlambat` int(10) DEFAULT '0',
  `maksimal_kehadiran` int(10) DEFAULT NULL,
  `gaji_pokok` int(50) DEFAULT NULL,
  `gaji_kehadiran` int(50) DEFAULT '0',
  `gaji_keterlambatan` int(50) DEFAULT '0',
  `tunjangan_makan` int(50) DEFAULT NULL,
  `tunjangan_lembur` int(50) DEFAULT '0',
  `tunjangan_lain` int(50) DEFAULT NULL,
  `hutang` int(50) DEFAULT '0',
  `pph` int(50) DEFAULT '0',
  `total_gaji` int(50) DEFAULT NULL,
  `tunjangan_komponen` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_gaji_detail`
--

INSERT INTO `hr_gaji_detail` (`id`, `gaji_id`, `karyawan_id`, `total_masuk`, `total_hadir`, `total_terlambat`, `maksimal_kehadiran`, `gaji_pokok`, `gaji_kehadiran`, `gaji_keterlambatan`, `tunjangan_makan`, `tunjangan_lembur`, `tunjangan_lain`, `hutang`, `pph`, `total_gaji`, `tunjangan_komponen`) VALUES
(62, NULL, 9, 1, 1, 0, 23, 86957, 86957, 0, NULL, NULL, NULL, NULL, NULL, 86957, NULL),
(63, 15, 9, 1, 1, 0, 23, 86957, 86957, 0, NULL, NULL, NULL, NULL, NULL, 86957, NULL),
(64, 16, 9, 0, 0, 0, 23, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(65, 17, 9, 1, 1, 0, 20, 100000, 100000, 0, NULL, NULL, NULL, NULL, NULL, 100000, NULL),
(66, 19, 9, 10, 8, 2, 20, 900000, 800000, 100000, NULL, 55000, 2510000, NULL, NULL, 3465000, '[{\"nominal\":2000000,\"name\":\"THR\"},{\"nominal\":240000,\"name\":\"Transport\"},{\"nominal\":120000,\"name\":\"Makan\"},{\"nominal\":150000,\"name\":\"Kesehatan\"}]'),
(67, 20, 9, 10, 8, 2, 20, 900000, 800000, 100000, NULL, 55000, 2510000, 425000, 0, 3040000, '[{\"nominal\":2000000,\"name\":\"THR\"},{\"nominal\":240000,\"name\":\"Transport\"},{\"nominal\":120000,\"name\":\"Makan\"},{\"nominal\":150000,\"name\":\"Kesehatan\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `hr_izin`
--

CREATE TABLE `hr_izin` (
  `id` int(10) NOT NULL,
  `karyawan_id` int(10) DEFAULT NULL,
  `tipe` enum('Izin','Sakit','Dinas','Cuti') DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `keterangan` text,
  `status` enum('pending','approve','deny') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_izin`
--

INSERT INTO `hr_izin` (`id`, `karyawan_id`, `tipe`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `status`) VALUES
(32, 9, 'Dinas', '2019-11-26', '2019-11-28', 'asdasdasd', 'approve'),
(33, 9, 'Sakit', '2020-02-04', '2020-02-07', 'Test', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `hr_jabatan`
--

CREATE TABLE `hr_jabatan` (
  `id` int(10) NOT NULL,
  `kode_jabatan` varchar(50) DEFAULT NULL,
  `nama_jabatan` varchar(200) DEFAULT NULL,
  `gaji` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_jabatan`
--

INSERT INTO `hr_jabatan` (`id`, `kode_jabatan`, `nama_jabatan`, `gaji`) VALUES
(2, 'JBT-0001', 'Guru', 2000000),
(3, 'JBT-0002', 'Kepala Sekolah', 3000000);

-- --------------------------------------------------------

--
-- Table structure for table `hr_karyawan`
--

CREATE TABLE `hr_karyawan` (
  `id` int(10) NOT NULL,
  `jabatan_id` int(10) DEFAULT NULL,
  `rfid` varchar(200) DEFAULT NULL,
  `kode_karyawan` varchar(100) DEFAULT NULL,
  `nama_karyawan` varchar(100) DEFAULT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `jenis_kelamin` enum('Laki - Laki','Perempuan') DEFAULT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `is_nikah` enum('0','1') DEFAULT NULL,
  `is_anak` enum('0','1') DEFAULT '0',
  `jml_anak` int(10) DEFAULT '0',
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `k_no_rek` varchar(50) DEFAULT NULL,
  `k_an` varchar(100) DEFAULT NULL,
  `k_bank` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_karyawan`
--

INSERT INTO `hr_karyawan` (`id`, `jabatan_id`, `rfid`, `kode_karyawan`, `nama_karyawan`, `alamat`, `jenis_kelamin`, `no_telp`, `is_nikah`, `is_anak`, `jml_anak`, `username`, `password`, `k_no_rek`, `k_an`, `k_bank`) VALUES
(9, 2, '123456789', 'KRY-0001', 'Bellatrix Lestrange', 'Parak Laweh', 'Perempuan', '083181826488', NULL, '0', 0, 'gabot01', '123456', '214342', 'Wader Jhonson', 'BNI'),
(10, 3, '213423', 'KRY-0002', 'Anastasha', 'adasd', 'Perempuan', '41234', NULL, '0', 0, 'gabot02', '123456', '1241', 'asda', 'BNI');

-- --------------------------------------------------------

--
-- Table structure for table `hr_lembur`
--

CREATE TABLE `hr_lembur` (
  `id` int(10) NOT NULL,
  `karyawan_id` int(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `total_jam` int(10) DEFAULT NULL,
  `nominal_lembur` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_lembur`
--

INSERT INTO `hr_lembur` (`id`, `karyawan_id`, `tanggal`, `total_jam`, `nominal_lembur`) VALUES
(11, 9, '2019-11-21', 5, 125000),
(12, 9, '2020-02-07', 2, 55000);

-- --------------------------------------------------------

--
-- Table structure for table `hr_tunjangan`
--

CREATE TABLE `hr_tunjangan` (
  `id` int(10) NOT NULL,
  `nama_tunjangan` varchar(100) DEFAULT NULL,
  `jml` int(10) DEFAULT NULL,
  `nominal` int(50) DEFAULT NULL,
  `tipe` enum('lembur','nikah','anak','harian','bulanan','per_orang','tahunan') DEFAULT NULL,
  `bulan` int(10) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `t_val` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_tunjangan`
--

INSERT INTO `hr_tunjangan` (`id`, `nama_tunjangan`, `jml`, `nominal`, `tipe`, `bulan`, `tahun`, `t_val`) VALUES
(1, NULL, 1, 25000, 'lembur', NULL, NULL, NULL),
(2, NULL, 2, 55000, 'lembur', NULL, NULL, NULL),
(3, NULL, 3, 125000, 'lembur', NULL, NULL, NULL),
(7, 'THR 2020', NULL, 0, 'tahunan', 2, 2020, NULL),
(8, 'Transport', NULL, 30000, 'harian', 2, 2020, NULL),
(9, 'Makan', NULL, 15000, 'harian', 2, 2020, NULL),
(10, 'Kesehatan', NULL, 150000, 'bulanan', 2, 2020, NULL),
(11, 'Kehadiran', NULL, 20000, 'harian', 2, 2020, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hr_waktu`
--

CREATE TABLE `hr_waktu` (
  `id` int(10) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') DEFAULT NULL,
  `jam_tiba_mulai` time DEFAULT NULL,
  `jam_tiba_terlambat` time DEFAULT NULL,
  `jam_tiba_selesai` time DEFAULT NULL,
  `jam_pulang_mulai` time DEFAULT NULL,
  `jam_pulang_selesai` time DEFAULT NULL,
  `is_aktif` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_waktu`
--

INSERT INTO `hr_waktu` (`id`, `hari`, `jam_tiba_mulai`, `jam_tiba_terlambat`, `jam_tiba_selesai`, `jam_pulang_mulai`, `jam_pulang_selesai`, `is_aktif`) VALUES
(1, 'Senin', '05:00:00', '07:30:00', '08:00:00', '17:00:00', '20:00:00', '1'),
(2, 'Selasa', '05:00:00', '07:30:00', '08:30:00', '17:00:00', '20:00:00', '1'),
(3, 'Rabu', '05:00:00', '07:30:00', '08:00:00', '17:00:00', '20:00:00', '1'),
(4, 'Kamis', '05:00:00', '07:30:00', '08:00:00', '17:00:00', '20:00:00', '1'),
(5, 'Jumat', '05:00:00', '07:30:00', '08:00:00', '17:00:00', '20:00:00', '1'),
(6, 'Sabtu', '05:00:00', '07:30:00', '08:00:00', '17:00:00', '20:00:00', '0'),
(7, 'Minggu', '05:00:00', '07:30:00', '08:00:00', '17:00:00', '20:00:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `id` int(10) NOT NULL,
  `coa_id` int(10) DEFAULT NULL,
  `transaksi_id` int(10) DEFAULT NULL,
  `waktu_jurnal` datetime DEFAULT NULL,
  `posisi` enum('d','k') DEFAULT NULL,
  `nominal` int(50) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`id`, `coa_id`, `transaksi_id`, `waktu_jurnal`, `posisi`, `nominal`, `status`) VALUES
(139, 6, 131, '2020-03-05 21:28:54', 'd', 2000000, '0'),
(140, 7, 131, '2020-03-05 21:28:54', 'k', 2000000, '0'),
(141, 6, 132, '2020-03-05 21:28:54', 'd', 25000, '0'),
(142, 8, 132, '2020-03-05 21:28:54', 'k', 25000, '0');

-- --------------------------------------------------------

--
-- Table structure for table `k_beban`
--

CREATE TABLE `k_beban` (
  `id` int(10) NOT NULL,
  `kode_beban` varchar(200) DEFAULT NULL,
  `nama_beban` varchar(200) DEFAULT NULL,
  `coa_id` int(11) DEFAULT NULL,
  `is_bulanan` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_beban`
--

INSERT INTO `k_beban` (`id`, `kode_beban`, `nama_beban`, `coa_id`, `is_bulanan`) VALUES
(1, 'BBN-0001', 'Pensil', 6, '0'),
(2, 'BBN-0002', 'Listrik', 4, '1'),
(3, 'BBN-0003', 'Air', 3, '1'),
(4, 'BBN-0004', 'Buku', 6, '0'),
(5, 'BBN-0005', 'Alat Tulis', 9, '0');

-- --------------------------------------------------------

--
-- Table structure for table `k_coa`
--

CREATE TABLE `k_coa` (
  `id` int(10) NOT NULL,
  `kode_coa` varchar(10) DEFAULT NULL,
  `nama_coa` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_coa`
--

INSERT INTO `k_coa` (`id`, `kode_coa`, `nama_coa`) VALUES
(1, '111', 'Kas'),
(2, '511', 'Beban'),
(3, '412', 'Bank'),
(4, '415', 'Utang'),
(5, '3123', 'Modal'),
(6, '1111', 'Piutang'),
(7, '1245', 'Pendapatan diterima dimuka'),
(8, '51341', 'Pendapatan SPP'),
(9, '123123', 'Perlengkapan'),
(10, '121', 'Panjar');

-- --------------------------------------------------------

--
-- Table structure for table `k_pemilik`
--

CREATE TABLE `k_pemilik` (
  `id` int(10) NOT NULL,
  `nama_pemilik` varchar(200) DEFAULT NULL,
  `no_hp` varchar(200) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `p_no_rek` varchar(50) DEFAULT NULL,
  `p_an` varchar(100) DEFAULT NULL,
  `p_bank` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_pemilik`
--

INSERT INTO `k_pemilik` (`id`, `nama_pemilik`, `no_hp`, `alamat`, `p_no_rek`, `p_an`, `p_bank`) VALUES
(2, 'Bella', '1234512', 'Parak Pisang', '1231241', 'Ucok', 'BJB'),
(3, 'Tono', '123123', 'asdasd', '124312', 'asd', 'TEst');

-- --------------------------------------------------------

--
-- Table structure for table `k_rek`
--

CREATE TABLE `k_rek` (
  `id` int(10) NOT NULL,
  `kode_rek` varchar(50) DEFAULT NULL,
  `nama_bank` varchar(200) DEFAULT NULL,
  `atas_nama` varchar(200) DEFAULT NULL,
  `no_rek` varchar(50) DEFAULT NULL,
  `saldo` int(50) DEFAULT '0',
  `is_default` enum('0','1') DEFAULT '0',
  `is_bop` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_rek`
--

INSERT INTO `k_rek` (`id`, `kode_rek`, `nama_bank`, `atas_nama`, `no_rek`, `saldo`, `is_default`, `is_bop`) VALUES
(1, 'REK-0001', 'BNI', 'Wader Jhonson', '0774422315', -14550000, '1', '0'),
(2, 'REK-0002', 'BJB', 'Wader Jhonson', '992213214563', 131876877, '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `k_rek_history`
--

CREATE TABLE `k_rek_history` (
  `id` int(10) NOT NULL,
  `rek_id` int(10) DEFAULT NULL,
  `transaksi_pembayaran_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `k_rek_history`
--

INSERT INTO `k_rek_history` (`id`, `rek_id`, `transaksi_pembayaran_id`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(10) NOT NULL,
  `vendor_id` int(10) DEFAULT NULL,
  `siswa_id` int(10) DEFAULT NULL,
  `pemilik_id` int(10) DEFAULT NULL,
  `karyawan_id` int(10) DEFAULT NULL,
  `rek_id` int(10) DEFAULT NULL,
  `nama_pemilik` varchar(200) DEFAULT NULL,
  `kode_transaksi` varchar(50) DEFAULT NULL,
  `nama_instuisi` varchar(200) DEFAULT NULL,
  `tanggal_transaksi` datetime DEFAULT NULL,
  `jangka_waktu` date DEFAULT NULL,
  `tipe` enum('perolehan','setoran','penarikan','bop','bank','tabungan_siswa','komponen_pendidikan','komponen_operasional','undur_diri','perbaikan','pemeliharaan','pinjaman','panjar','transaksi_beban') DEFAULT NULL,
  `jenis` enum('masuk','keluar') DEFAULT NULL,
  `pembayaran` enum('Tunai','Kredit') DEFAULT NULL,
  `metode` enum('Cash','Transfer') DEFAULT NULL,
  `level` enum('0','1','2','3') DEFAULT '1',
  `total_transaksi` int(50) DEFAULT NULL,
  `total_bayar` int(50) DEFAULT '0',
  `sisa_bayar` int(50) DEFAULT '0',
  `status` enum('Lunas','Belum Lunas') DEFAULT NULL,
  `is_created` enum('0','1') DEFAULT '0',
  `is_deny` enum('0','1') DEFAULT '0',
  `is_konfirmasi` enum('0','1') DEFAULT '0',
  `keterangan` text,
  `keterangan_deny` text,
  `keterangan_acc` text,
  `kd_giro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `vendor_id`, `siswa_id`, `pemilik_id`, `karyawan_id`, `rek_id`, `nama_pemilik`, `kode_transaksi`, `nama_instuisi`, `tanggal_transaksi`, `jangka_waktu`, `tipe`, `jenis`, `pembayaran`, `metode`, `level`, `total_transaksi`, `total_bayar`, `sisa_bayar`, `status`, `is_created`, `is_deny`, `is_konfirmasi`, `keterangan`, `keterangan_deny`, `keterangan_acc`, `kd_giro`) VALUES
(131, NULL, 27, NULL, NULL, NULL, NULL, 'TRX-KMPP-05032020-0001', NULL, '2020-03-05 21:28:54', NULL, 'komponen_pendidikan', 'masuk', 'Kredit', 'Cash', '3', 2000000, 0, 0, 'Belum Lunas', '1', '0', '0', NULL, NULL, NULL, NULL),
(132, NULL, 27, NULL, NULL, NULL, NULL, 'TRX-KMPO-05032020-0001', NULL, '2020-03-05 21:28:54', NULL, 'komponen_operasional', 'masuk', 'Kredit', 'Cash', '3', 25000, 0, 0, 'Belum Lunas', '1', '0', '0', NULL, NULL, NULL, NULL),
(133, NULL, NULL, NULL, NULL, NULL, NULL, 'TRX-MBNK-26032020-0001', NULL, '2020-03-26 14:04:18', NULL, 'bank', 'keluar', 'Tunai', 'Cash', '3', 123123, 123123, 0, 'Lunas', '1', '0', '0', 'asdasd', NULL, NULL, 1233),
(134, NULL, NULL, NULL, NULL, NULL, NULL, 'TRX-BBN-26032020-0001', NULL, '2020-03-26 14:59:40', NULL, 'transaksi_beban', 'keluar', 'Tunai', 'Cash', '2', 3000, 5000, -2000, 'Lunas', '1', '0', '0', NULL, NULL, NULL, NULL),
(135, NULL, NULL, NULL, NULL, NULL, NULL, 'TRX-BBN-27032020-0001', NULL, '2020-03-27 19:13:30', NULL, 'transaksi_beban', 'keluar', 'Tunai', 'Cash', '2', 1200, 1200, 0, 'Lunas', '1', '0', '0', NULL, NULL, NULL, NULL),
(136, NULL, NULL, NULL, NULL, NULL, NULL, 'TRX-BBN-27032020-0002', NULL, '2020-03-27 19:18:55', NULL, 'transaksi_beban', 'keluar', 'Tunai', 'Cash', '3', 30000, 30000, 0, 'Lunas', '1', '1', '0', NULL, NULL, '', NULL),
(137, NULL, NULL, NULL, NULL, NULL, NULL, 'TRX-BBN-27032020-0003', NULL, '2020-03-27 20:26:40', NULL, 'transaksi_beban', 'keluar', 'Tunai', 'Cash', '1', 1, 1, 0, 'Lunas', '1', '0', '0', NULL, NULL, NULL, NULL),
(138, NULL, NULL, NULL, NULL, NULL, NULL, 'TRX-BBN-27032020-0004', NULL, '2020-03-27 20:52:29', NULL, 'transaksi_beban', 'keluar', 'Tunai', 'Cash', '3', 4000, 4000, 0, 'Lunas', '1', '0', '0', NULL, NULL, '', NULL),
(139, NULL, NULL, NULL, NULL, NULL, NULL, 'TRX-BBN-27032020-0005', NULL, NULL, NULL, 'transaksi_beban', NULL, NULL, NULL, '1', NULL, 0, 0, NULL, '0', '0', '0', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_aset`
--

CREATE TABLE `transaksi_aset` (
  `id` int(10) NOT NULL,
  `transaksi_id` int(10) DEFAULT NULL,
  `aset_id` int(10) DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `harga` int(10) DEFAULT NULL,
  `subtotal` int(10) DEFAULT NULL,
  `nilai_residu` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_beban`
--

CREATE TABLE `transaksi_beban` (
  `id` int(10) NOT NULL,
  `transaksi_id` int(10) DEFAULT NULL,
  `beban_id` int(10) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `harga` int(50) DEFAULT NULL,
  `subtotal` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_beban`
--

INSERT INTO `transaksi_beban` (`id`, `transaksi_id`, `beban_id`, `qty`, `harga`, `subtotal`) VALUES
(1, 134, 1, 2, 1500, 3000),
(2, 135, 1, 1, 1200, 1200),
(3, 136, 4, 10, 3000, 30000),
(4, 137, 1, 1, 1, 1),
(6, 138, 4, 2, 2000, 4000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_bop`
--

CREATE TABLE `transaksi_bop` (
  `id` int(10) NOT NULL,
  `transaksi_id` int(10) DEFAULT NULL,
  `nama_komponen` varchar(250) DEFAULT NULL,
  `qty` int(50) DEFAULT NULL,
  `harga_satuan` int(50) DEFAULT NULL,
  `subtotal` int(50) DEFAULT NULL,
  `subtotal_acc` int(50) DEFAULT NULL,
  `tanggal_pengeluaran` date DEFAULT NULL,
  `metode_pengeluaran` enum('Transfer','Cash') DEFAULT NULL,
  `is_acc` enum('0','1') DEFAULT '1',
  `keterangan_pengeluaran` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pembayaran`
--

CREATE TABLE `transaksi_pembayaran` (
  `id` int(10) NOT NULL,
  `transaksi_id` int(10) DEFAULT NULL,
  `jumlah_bayar` int(50) DEFAULT NULL,
  `tanggal_bayar` datetime DEFAULT NULL,
  `keterangan_pembayaran` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_pembayaran`
--

INSERT INTO `transaksi_pembayaran` (`id`, `transaksi_id`, `jumlah_bayar`, `tanggal_bayar`, `keterangan_pembayaran`) VALUES
(1, 133, 123123, '2020-03-26 14:04:18', NULL),
(2, 136, 30000, '2020-03-27 20:56:49', NULL),
(3, 138, 4000, '2020-03-27 21:10:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pemeliharaan`
--

CREATE TABLE `transaksi_pemeliharaan` (
  `id` int(10) NOT NULL,
  `transaksi_id` int(10) DEFAULT NULL,
  `aset_detail_id` int(10) DEFAULT NULL,
  `harga_pemeliharaan` int(50) DEFAULT NULL,
  `keterangan_pemeliharaan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pendidikan`
--

CREATE TABLE `transaksi_pendidikan` (
  `id` int(10) NOT NULL,
  `transaksi_id` int(10) DEFAULT NULL,
  `ta_komponen_id` int(10) DEFAULT NULL,
  `harga_komponen` int(50) DEFAULT NULL,
  `bulan` int(2) DEFAULT NULL,
  `sisa_bayar_komponen` int(50) DEFAULT NULL,
  `total_bayar_komponen` int(50) DEFAULT NULL,
  `is_lunas` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_pendidikan`
--

INSERT INTO `transaksi_pendidikan` (`id`, `transaksi_id`, `ta_komponen_id`, `harga_komponen`, `bulan`, `sisa_bayar_komponen`, `total_bayar_komponen`, `is_lunas`) VALUES
(49, 131, 2, 50000, NULL, NULL, NULL, '0'),
(50, 131, 4, 150000, NULL, NULL, NULL, '0'),
(51, 131, 5, 1500000, NULL, NULL, NULL, '0'),
(52, 131, 6, 300000, NULL, NULL, NULL, '0'),
(53, 132, 3, 25000, NULL, NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_undur_diri`
--

CREATE TABLE `transaksi_undur_diri` (
  `id` int(10) NOT NULL,
  `transaksi_id` int(10) DEFAULT NULL,
  `komponen_biaya_id` int(10) DEFAULT NULL,
  `nominal` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `posisi` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `posisi`) VALUES
(1, 'Wader Jhonson', 'admin', 'admin', 'Superadmin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ak_kelas`
--
ALTER TABLE `ak_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ak_komponen_biaya`
--
ALTER TABLE `ak_komponen_biaya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ak_siswa`
--
ALTER TABLE `ak_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun_ajaran_id` (`tahun_ajaran_id`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `ak_tahun_ajaran`
--
ALTER TABLE `ak_tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ak_tahun_ajaran_komponen`
--
ALTER TABLE `ak_tahun_ajaran_komponen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tahun_ajaran_id` (`tahun_ajaran_id`),
  ADD KEY `komponen_biaya_id` (`komponen_biaya_id`);

--
-- Indexes for table `a_aset`
--
ALTER TABLE `a_aset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `a_aset_detail`
--
ALTER TABLE `a_aset_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aset_id` (`aset_id`),
  ADD KEY `lokasi_id` (`lokasi_id`),
  ADD KEY `transaksi_aset_id` (`transaksi_aset_id`);

--
-- Indexes for table `a_kategori`
--
ALTER TABLE `a_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_lokasi`
--
ALTER TABLE `a_lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_penyusutan_log`
--
ALTER TABLE `a_penyusutan_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_vendor`
--
ALTER TABLE `a_vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_absensi`
--
ALTER TABLE `hr_absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawan_id` (`karyawan_id`);

--
-- Indexes for table `hr_gaji`
--
ALTER TABLE `hr_gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_gaji_detail`
--
ALTER TABLE `hr_gaji_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_izin`
--
ALTER TABLE `hr_izin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawan_id` (`karyawan_id`);

--
-- Indexes for table `hr_jabatan`
--
ALTER TABLE `hr_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_karyawan`
--
ALTER TABLE `hr_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_lembur`
--
ALTER TABLE `hr_lembur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `karyawan_id` (`karyawan_id`);

--
-- Indexes for table `hr_tunjangan`
--
ALTER TABLE `hr_tunjangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_waktu`
--
ALTER TABLE `hr_waktu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coa_id` (`coa_id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `k_beban`
--
ALTER TABLE `k_beban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_coa`
--
ALTER TABLE `k_coa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_pemilik`
--
ALTER TABLE `k_pemilik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_rek`
--
ALTER TABLE `k_rek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `k_rek_history`
--
ALTER TABLE `k_rek_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rek_id` (`rek_id`),
  ADD KEY `transaksi_pembayaran_id` (`transaksi_pembayaran_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemilik_id` (`pemilik_id`),
  ADD KEY `siswa_id` (`siswa_id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `rek_id` (`rek_id`);

--
-- Indexes for table `transaksi_aset`
--
ALTER TABLE `transaksi_aset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aset_id` (`aset_id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `transaksi_beban`
--
ALTER TABLE `transaksi_beban`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`),
  ADD KEY `beban_id` (`beban_id`);

--
-- Indexes for table `transaksi_bop`
--
ALTER TABLE `transaksi_bop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `transaksi_pembayaran`
--
ALTER TABLE `transaksi_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `transaksi_pemeliharaan`
--
ALTER TABLE `transaksi_pemeliharaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`),
  ADD KEY `aset_detail_id` (`aset_detail_id`);

--
-- Indexes for table `transaksi_pendidikan`
--
ALTER TABLE `transaksi_pendidikan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`),
  ADD KEY `ta_komponen_id` (`ta_komponen_id`);

--
-- Indexes for table `transaksi_undur_diri`
--
ALTER TABLE `transaksi_undur_diri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`),
  ADD KEY `komponen_biaya_id` (`komponen_biaya_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ak_kelas`
--
ALTER TABLE `ak_kelas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ak_komponen_biaya`
--
ALTER TABLE `ak_komponen_biaya`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ak_siswa`
--
ALTER TABLE `ak_siswa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ak_tahun_ajaran`
--
ALTER TABLE `ak_tahun_ajaran`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ak_tahun_ajaran_komponen`
--
ALTER TABLE `ak_tahun_ajaran_komponen`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `a_aset`
--
ALTER TABLE `a_aset`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `a_aset_detail`
--
ALTER TABLE `a_aset_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `a_kategori`
--
ALTER TABLE `a_kategori`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `a_lokasi`
--
ALTER TABLE `a_lokasi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `a_penyusutan_log`
--
ALTER TABLE `a_penyusutan_log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `a_vendor`
--
ALTER TABLE `a_vendor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hr_absensi`
--
ALTER TABLE `hr_absensi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `hr_gaji`
--
ALTER TABLE `hr_gaji`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `hr_gaji_detail`
--
ALTER TABLE `hr_gaji_detail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `hr_izin`
--
ALTER TABLE `hr_izin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `hr_jabatan`
--
ALTER TABLE `hr_jabatan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hr_karyawan`
--
ALTER TABLE `hr_karyawan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hr_lembur`
--
ALTER TABLE `hr_lembur`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `hr_tunjangan`
--
ALTER TABLE `hr_tunjangan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hr_waktu`
--
ALTER TABLE `hr_waktu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `k_beban`
--
ALTER TABLE `k_beban`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `k_coa`
--
ALTER TABLE `k_coa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `k_pemilik`
--
ALTER TABLE `k_pemilik`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `k_rek`
--
ALTER TABLE `k_rek`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `k_rek_history`
--
ALTER TABLE `k_rek_history`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `transaksi_aset`
--
ALTER TABLE `transaksi_aset`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_beban`
--
ALTER TABLE `transaksi_beban`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi_bop`
--
ALTER TABLE `transaksi_bop`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_pembayaran`
--
ALTER TABLE `transaksi_pembayaran`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi_pemeliharaan`
--
ALTER TABLE `transaksi_pemeliharaan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_pendidikan`
--
ALTER TABLE `transaksi_pendidikan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `transaksi_undur_diri`
--
ALTER TABLE `transaksi_undur_diri`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ak_siswa`
--
ALTER TABLE `ak_siswa`
  ADD CONSTRAINT `ak_siswa_ibfk_1` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `ak_tahun_ajaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ak_siswa_ibfk_2` FOREIGN KEY (`kelas_id`) REFERENCES `ak_kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ak_tahun_ajaran_komponen`
--
ALTER TABLE `ak_tahun_ajaran_komponen`
  ADD CONSTRAINT `ak_tahun_ajaran_komponen_ibfk_1` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `ak_tahun_ajaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ak_tahun_ajaran_komponen_ibfk_2` FOREIGN KEY (`komponen_biaya_id`) REFERENCES `ak_komponen_biaya` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `a_aset`
--
ALTER TABLE `a_aset`
  ADD CONSTRAINT `a_aset_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `a_kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `a_aset_detail`
--
ALTER TABLE `a_aset_detail`
  ADD CONSTRAINT `a_aset_detail_ibfk_1` FOREIGN KEY (`aset_id`) REFERENCES `a_aset` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `a_aset_detail_ibfk_2` FOREIGN KEY (`lokasi_id`) REFERENCES `a_lokasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `a_aset_detail_ibfk_3` FOREIGN KEY (`transaksi_aset_id`) REFERENCES `transaksi_aset` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hr_absensi`
--
ALTER TABLE `hr_absensi`
  ADD CONSTRAINT `hr_absensi_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `hr_karyawan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hr_izin`
--
ALTER TABLE `hr_izin`
  ADD CONSTRAINT `hr_izin_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `hr_karyawan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hr_lembur`
--
ALTER TABLE `hr_lembur`
  ADD CONSTRAINT `hr_lembur_ibfk_1` FOREIGN KEY (`karyawan_id`) REFERENCES `hr_karyawan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `jurnal_ibfk_1` FOREIGN KEY (`coa_id`) REFERENCES `k_coa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jurnal_ibfk_2` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `k_rek_history`
--
ALTER TABLE `k_rek_history`
  ADD CONSTRAINT `k_rek_history_ibfk_1` FOREIGN KEY (`rek_id`) REFERENCES `k_rek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `k_rek_history_ibfk_2` FOREIGN KEY (`transaksi_pembayaran_id`) REFERENCES `transaksi_pembayaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pemilik_id`) REFERENCES `k_pemilik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`siswa_id`) REFERENCES `ak_siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`vendor_id`) REFERENCES `a_vendor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`rek_id`) REFERENCES `k_rek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_aset`
--
ALTER TABLE `transaksi_aset`
  ADD CONSTRAINT `transaksi_aset_ibfk_1` FOREIGN KEY (`aset_id`) REFERENCES `a_aset` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_aset_ibfk_2` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_beban`
--
ALTER TABLE `transaksi_beban`
  ADD CONSTRAINT `transaksi_beban_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_beban_ibfk_2` FOREIGN KEY (`beban_id`) REFERENCES `k_beban` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_bop`
--
ALTER TABLE `transaksi_bop`
  ADD CONSTRAINT `transaksi_bop_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_pembayaran`
--
ALTER TABLE `transaksi_pembayaran`
  ADD CONSTRAINT `transaksi_pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_pemeliharaan`
--
ALTER TABLE `transaksi_pemeliharaan`
  ADD CONSTRAINT `transaksi_pemeliharaan_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_pemeliharaan_ibfk_2` FOREIGN KEY (`aset_detail_id`) REFERENCES `a_aset_detail` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_pendidikan`
--
ALTER TABLE `transaksi_pendidikan`
  ADD CONSTRAINT `transaksi_pendidikan_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_pendidikan_ibfk_2` FOREIGN KEY (`ta_komponen_id`) REFERENCES `ak_tahun_ajaran_komponen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_undur_diri`
--
ALTER TABLE `transaksi_undur_diri`
  ADD CONSTRAINT `transaksi_undur_diri_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_undur_diri_ibfk_2` FOREIGN KEY (`komponen_biaya_id`) REFERENCES `ak_komponen_biaya` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
