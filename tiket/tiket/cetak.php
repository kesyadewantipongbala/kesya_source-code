<?php
// include database connection file
include_once("..\config.php");
?>
<?php
// Display selected user data based on id
// Getting id from url
$id_tiket = $_GET['id'];
 
// Fetech user data based on id_tiket
$result = mysqli_query($mysqli, "SELECT * FROM tiket
    inner join petugas on petugas.id_petugas = tiket.id_petugas
    inner join kelas_kapal on kelas_kapal.id_kelas_kapal = tiket.id_kelas_kapal
    inner join kelas on kelas.kode_kelas = kelas_kapal.kode_kelas
    inner join jadwal_kapal on kelas_kapal.kode_jadwal_kapal = jadwal_kapal.kode_jadwal_kapal
    inner join kapal on kapal.kode_kapal = jadwal_kapal.kode_kapal
    WHERE no_tiket=$id_tiket");
 
while($data = mysqli_fetch_array($result))
{
    $nama_petugas = $data['nama_petugas'];
    $kode_jadwal_kapal = $data['kode_jadwal_kapal'];
    $nama_penumpang = $data['nama_penumpang'];
    $tgl_berangkat = $data['tgl_berangkat'];
    $jam_berangkat = date('H:i',strtotime($data['tgl_jam_berangkat']));
    $total_pembayaran = $data['total_pembayaran'];
    $nama_kelas = $data['nama_kelas'];
    $kapal = $data['kode_kapal'].'-'.$data['nama_kapal'];
    $kelas = $data['kode_kelas'].'-'.$data['nama_kelas'];
    // print_r($data);
}
?>
<html>
<head>    
    <title>Cetak Tiket</title>
</head>
 <style>
    body{
        font-family: arial;
        font-size: 16px;
    }
     td{
        padding: 10px;
     }
 </style>
<body>
    <!-- <a href="index.php">Home</a> -->
    <br/><br/>
    <h1 style="text-align: center;" >Tiket Kapal</h1>
    <form name="update_user" method="post" action="edit.php">
        <table border="0">
            <tr>
                <td>Nama Penumpang</td>
                <td><?php echo $nama_penumpang ?></td>
            </tr>

            <tr> 
                <td>Kelas</td>
                <td><?php echo $kelas ?></td>
            </tr>

            <tr> 
                <td>Kapal</td>
                <td><?php echo $kapal ?></td>
            </tr>

            <tr> 
                <td>Tgl Berangkat</td>
                <td><?php echo $tgl_berangkat ?></td>
            </tr>

            <tr> 
                <td>Jam Berangkat</td>
                <td><?php echo $jam_berangkat ?></td>
            </tr>

            <tr> 
                <td>Total Pembayaran</td>
                <td><?php echo $total_pembayaran ?></td>
            </tr>
        </table>
    </form>
        <script>
        window.print();
    </script>
</body>
</html>