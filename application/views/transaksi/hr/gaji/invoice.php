<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.themekita.com/atlantis/livepreview/examples/demo1/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 30 Oct 2019 18:06:06 GMT -->
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>TK</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">


  <!-- CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/atlantis.css">

  <script src="<?php echo base_url() ?>assets/js/core/jquery.3.2.1.min.js"></script>

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/demo.css">

  <style type="text/css">
    .timeline_active{
      border:2px solid #31CE36 ; padding: 10px;border-radius: 10px;
    }
  </style>
</head>
<body onload="window.print()">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div style="padding:10px">
                    <b>PERIODE</b>
                </div>
                <table class="table">
                    <tr>
                        <th style="width:30%">Bulan</th>
                        <td><?php echo get_monthname($gaji['bulan']) ?></td>
                    </tr>
                    <tr>
                        <th style="width:30%">Tahun</th>
                        <td><?php echo $gaji['tahun'] ?></td>
                    </tr>
                </table>
                <br>
                <div style="padding:10px; background-color: #eee">
                    <b>INFO KARYAWAN</b>
                </div>
                <table class="table">
                    <tr>
                        <th style="width:30%">Kode Karyawan</th>
                        <td><?php echo $karyawan['kode_karyawan'] ?></td>
                    </tr>
                    <tr>
                        <th style="width:30%">Nama</th>
                        <td><?php echo $karyawan['nama_karyawan'] ?></td>
                    </tr>
                </table>

                <br>
                <div style="padding:10px;background-color: #eee">
                    <b>INFO GAJI</b>
                </div>

                <?php $base = ($karyawan['gaji'] / $list['maksimal_kehadiran']) ?>

                <table class="table">
                    <tr>
                        <th style="width:30%">Kehadiran</th>
                        <td><?php echo $list['total_masuk']." / ".$list['maksimal_kehadiran'] ?></td>
                    </tr>
                    <tr>
                        <th>&emsp;&emsp;Hadir Penuh</th>
                        <td><?php echo $list['total_hadir'] ?> x <?php echo format_rp($base) ?> &emsp; = &emsp;Rp. <?php echo number_format($list['gaji_kehadiran'],0,'','.') ?></td>
                    </tr>
                    <tr>
                        <th>&emsp;&emsp;Hadir Terlambat 30 Menit</th>
                        <td><?php echo $list['total_terlambat'] ?> x <?php echo format_rp((50/100) * $base) ?> &emsp; = &emsp;Rp. <?php echo number_format($list['gaji_keterlambatan'],0,'','.') ?></td>
                    </tr>
                    <tr>
                        <th style="width:30%">Tunjangan Lembur</th>
                        <td><?php echo format_rp($list['tunjangan_lembur']) ?></td>
                    </tr>
                    <tr>
                        <th style="width:30%">Tunjangan Lain - Lain</th>
                        <td></td>
                    </tr>

                    <?php $arr = json_decode($list['tunjangan_komponen'], true); ?>

                    <?php foreach ($arr as $row) { ?>
                            <tr>
                                <th>&emsp;&emsp; <?php echo $row['name'] ?></th>
                                <td><?php echo format_rp($row['nominal']) ?></td>
                            </tr>
                    <?php } ?>
                    

                    <?php $gaji_bersih = $list['gaji_kehadiran'] + $list['gaji_keterlambatan'] + $list['tunjangan_lembur'] + $list['tunjangan_lain']; ?>

                    <tr>
                        <th style="width:30%">Gaji Bersih</th>
                        <td><b><?php echo format_rp($gaji_bersih) ?></b></td>
                    </tr>
                    </table>

            </div>
        </div>
    </div>

</body>
</html>