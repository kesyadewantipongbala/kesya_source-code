<?php
// Create database connection using config file
include_once("..\config.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM tiket
    inner join petugas on petugas.id_petugas = tiket.id_petugas
    inner join kelas_kapal on kelas_kapal.id_kelas_kapal = tiket.id_kelas_kapal
    inner join kelas on kelas.kode_kelas = kelas_kapal.kode_kelas
    inner join jadwal_kapal on kelas_kapal.kode_jadwal_kapal = jadwal_kapal.kode_jadwal_kapal
    inner join kapal on kapal.kode_kapal = jadwal_kapal.kode_kapal
    ");
?>
 
<html>
<head>    
    <title>Tiket Kapal</title>
</head>
 
<body>
    <ul>
        <li><a href="..\petugas">Petugas</a></li>
        <li><a href="..\kapal">Kapal</a></li>
        <li><a href="..\jadwal">Jadwal Kapal</a></li>
        <li><a href="..\kelas">Kelas</a></li>
        <li><a href="..\kelasKapal">Kelas Kapal</a></li>
        <li><a href="..\tiket">Tiket</a></li>
    </ul>
<h2>Data Transaksi Tiket</h2>
<a href="add.php">Add New Tiket</a><br/><br/>
 
    <table width='80%' border=1>
 
    <tr>
        <th>No</th>
        <th>Nama Petugas</th>
        <th>Kode Jadwal Kapal</th>
        <th>Kelas</th>
        <th>Nama Penumpang</th>
        <th>Tanggal Berangkat</th>
        <th>Jam Berangkat</th>
        <th>Tanggal Pembayaran</th>
        <th>Total Pembayaran</th>
        <th>Action</th>
    </tr>
    <?php $no=1;
    while($data = mysqli_fetch_array($result)) {         
        echo "<tr>";
        echo "<td>".$no."</td>";
        echo "<td>".$data['nama_petugas']."</td>";
        echo "<td>".$data['kode_jadwal_kapal']."</td>";
        echo "<td>".$data['kode_kelas'].'-'.$data['nama_kelas']."</td>";
        echo "<td>".$data['nama_penumpang']."</td>";
        echo "<td>".$data['tgl_berangkat']."</td>";
        echo "<td>".date('H:i',strtotime($data['tgl_jam_berangkat']))."</td>";
        echo "<td>".$data['tgl_pembayaran']."</td>";
        echo "<td>".$data['total_pembayaran']."</td>";
        echo "<td><a target='_blank' href='cetak.php?id=$data[no_tiket]'>Cetak</a></td></tr>";$no++;
    }
    ?>
    </table>
</body>
</html>