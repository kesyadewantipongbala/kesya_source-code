<?php
// Create database connection using config file
include_once("..\config.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM kelas_kapal
    inner join kelas on kelas.kode_kelas = kelas_kapal.kode_kelas
    inner join jadwal_kapal on jadwal_kapal.kode_jadwal_kapal = kelas_kapal.kode_jadwal_kapal
    inner join kapal on kapal.kode_kapal = jadwal_kapal.kode_kapal");
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
<h2>Data Kelas dan Jadwal Kapal</h2>
<a href="add.php">Add New Kelas Kapal</a><br/><br/>
 
    <table width='80%' border=1>
 
    <tr>
        <th>No</th>
        <th>Kode Jadwal Kapal</th>
        <th>Kode Kelas</th>
        <th>Nama Kelas</th>
        <th>Kode Kapal</th>
        <th>Nama Kapal</th>
        <th>Tgl Jam Berangkat</th>
        <th>Tgl Jam Tiba</th>
        <th>Jumlah Penumpang</th>
        <th>Harga Tiket</th>
        <th>Action</th>
    </tr>
    <?php $no=1;
    while($data = mysqli_fetch_array($result)) {         
        echo "<tr>";
        echo "<td>".$no."</td>";
        echo "<td>".$data['kode_jadwal_kapal']."</td>";
        echo "<td>".$data['kode_kelas']."</td>";
        echo "<td>".$data['nama_kelas']."</td>";
        echo "<td>".$data['kode_kapal']."</td>";
        echo "<td>".$data['nama_kapal']."</td>";
        echo "<td>".$data['tgl_jam_berangkat']."</td>";
        echo "<td>".$data['tgl_jam_tiba']."</td>";
        echo "<td>".$data['jumlah_penumpang']."</td>";
        echo "<td>".$data['harga_tiket']."</td>";
        echo "<td><a href='edit.php?id=$data[id_kelas_kapal]'>Edit</a> | <a href='delete.php?id=$data[id_kelas_kapal]'>Delete</a></td></tr>";$no++;
    }
    ?>
    </table>
</body>
</html>