<?php
// Create database connection using config file
include_once("..\config.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM kapal ORDER BY kode_kapal DESC");
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
<h2>Data Kapal</h2>
<a href="add.php">Add New Kapal</a><br/><br/>
 
    <table width='80%' border=1>
 
    <tr>
        <th>No</th>
        <th>Kode Kapal</th>
        <th>Nama Kapal</th>
        <th>Action</th>
    </tr>
    <?php $no=1;
    while($data = mysqli_fetch_array($result)) {         
        echo "<tr>";
        echo "<td>".$no."</td>";
        echo "<td>".$data['kode_kapal']."</td>";
        echo "<td>".$data['nama_kapal']."</td>";
        echo "<td><a href='edit.php?id=$data[kode_kapal]'>Edit</a> | <a href='delete.php?id=$data[kode_kapal]'>Delete</a></td></tr>";$no++;
    }
    ?>
    </table>
</body>
</html>