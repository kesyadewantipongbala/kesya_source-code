<?php
// Create database connection using config file
include_once("..\config.php");
 
// Fetch all users data from database
$kelas_kapal = mysqli_query($mysqli, "SELECT * FROM kelas_kapal
    inner join jadwal_kapal on jadwal_kapal.kode_jadwal_kapal = kelas_kapal.kode_jadwal_kapal
    inner join kelas on kelas.kode_kelas = kelas_kapal.kode_kelas
    inner join kapal on kapal.kode_kapal = jadwal_kapal.kode_kapal
    ");
$kelas = mysqli_query($mysqli, "SELECT * FROM kelas");
$petugas = mysqli_query($mysqli, "SELECT * FROM petugas");
$jadwal_kapal = mysqli_query($mysqli, "SELECT * FROM jadwal_kapal");
?>
<html>
<head>
    <title>Tiket Kapal</title>
</head>
 
<body>
    <a href="index.php">Go to Home</a>
    <br/><br/>
 
    <form action="add.php" method="post" nama_petugas="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Kode Jadwal Kapal</td>
                <td>
                    <select name="id_kelas_kapal" >
                        <?php  while ($data=mysqli_fetch_array($kelas_kapal)) {?>
                        <option onclick="tgl('<?php echo date('Y-m-d', strtotime($data['tgl_jam_berangkat'])) ?>','<?php echo $data['harga_tiket'] ?>')"  value="<?php echo $data['id_kelas_kapal'] ?>" ><?php echo $data['nama_kelas'].'-'.$data['nama_kapal'].'-'.$data['tgl_jam_berangkat']?></option>
                    <?php   } ?>
                    </select>
                </td>                
            </tr>

            <tr> 
                <td>Tanggal Berangkat</td>
                <td><input id="tgl" required type="date" name="tgl_berangkat"></td>
            </tr>

            <tr> 
                <td>Nama Penumpang</td>
                <td><input required type="text" name="nama_penumpang"></td>
            </tr>

            <tr> 
                <td>Tanggal Pembayaran</td>
                <td><input required type="date" name="tgl_pembayaran"></td>
            </tr>

            <tr> 
                <td>Total Pembayaran</td>
                <td><input required id="harga" type="number" name="total_pembayaran"></td>
            </tr>

            <tr> 
                <td>Kode Jadwal Kapal</td>
                <td>
                    <select name="id_petugas" >
                        <?php  while ($data=mysqli_fetch_array($petugas)) {?>
                        <option value="<?php echo $data['id_petugas'] ?>" ><?php echo $data['nama_petugas']?></option>
                    <?php   } ?>
                    </select>
                </td>                
            </tr>

            <tr>      
                <td></td>
                <td><input type="submit" name="Submit"></td>
            </tr>
        </table>
    </form>
    
    <?php
    // Check If form submitted, insert form data into users table.
    if(isset($_POST['Submit'])) {

        $id_petugas = $_POST['id_petugas'];
        $id_kelas_kapal = $_POST['id_kelas_kapal'];
        $nama_penumpang = $_POST['nama_penumpang'];
        $tgl_berangkat = $_POST['tgl_berangkat'];
        $tgl_pembayaran = $_POST['tgl_pembayaran'];
        $total_pembayaran = $_POST['total_pembayaran'];

        
        // include database connection file
        include_once("..\config.php");
                
        // Insert user data into table
        $result = mysqli_query($mysqli, "INSERT INTO tiket(id_petugas,id_kelas_kapal,nama_penumpang,tgl_berangkat,tgl_pembayaran,total_pembayaran) VALUES('$id_petugas','$id_kelas_kapal','$nama_penumpang','$tgl_berangkat','$tgl_pembayaran','$total_pembayaran')");
        echo mysqli_error($mysqli);
        
        // Show message when user added
        echo "Tiket added successfully. <a href='index.php'>View Kelas Kapal</a>.<a href='index.php'>Cetak Tiket</a>";
    }
    ?>
    <script>
        function tgl(date,harga){
            document.getElementById("tgl").value = date;
            document.getElementById("harga").value = harga;
        }
    </script>
</body>
</html>