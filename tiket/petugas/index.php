<?php
// Create database connection using config file
include_once("..\config.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM petugas ORDER BY id_petugas DESC");
?>
 
<html>
<head>    
    <title>Homepage</title>
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
<h2>Data Petugas</h2>
<a href="add.php">Add New Petugas</a><br/><br/>
 
    <table width='80%' border=1>
 
    <tr>
        <th>No</th>
        <th>Nama Petugas</th>
        <th>Action</th>
    </tr>
    <?php $no=1;
    while($data = mysqli_fetch_array($result)) {         
        echo "<tr>";
        echo "<td>".$no."</td>";
        echo "<td>".$data['nama_petugas']."</td>";
        echo "<td><a href='edit.php?id=$data[id_petugas]'>Edit</a> | <a href='delete.php?id=$data[id_petugas]'>Delete</a></td></tr>";$no++;
    }
    ?>
    </table>
</body>
</html>