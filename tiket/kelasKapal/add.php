<?php
// Create database connection using config file
include_once("..\config.php");
 
// Fetch all users data from database
$jadwal_kapal = mysqli_query($mysqli, "SELECT * FROM jadwal_kapal inner join kapal on kapal.kode_kapal = jadwal_kapal.kode_kapal");
$kelas = mysqli_query($mysqli, "SELECT * FROM kelas");
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
                    <select name="kode_jadwal_kapal" >
                        <?php  while ($data=mysqli_fetch_array($jadwal_kapal)) {?>
                        <option value="<?php echo $data['kode_jadwal_kapal'] ?>" ><?php echo $data['kode_jadwal_kapal']?></option>
                    <?php   } ?>
                    </select>
                </td>                
            </tr>

            <tr> 
                <td>Kode Kelas</td>
                <td>
                    <select name="kode_kelas" >
                        <?php  while ($data=mysqli_fetch_array($kelas)) {?>
                        <option value="<?php echo $data['kode_kelas'] ?>" ><?php echo $data['kode_kelas'].' - '.$data['nama_kelas'] ?></option>
                    <?php   } ?>
                    </select>
                </td>                
            </tr>

            <tr> 
                <td>Jumlah Penumpang</td>
                <td><input required type="number" name="jumlah_penumpang"></td>
            </tr>

            <tr> 
                <td>Harga Tiket</td>
                <td><input required type="number" name="harga_tiket"></td>
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

        $kode_jadwal_kapal = $_POST['kode_jadwal_kapal'];
        $kode_kelas = $_POST['kode_kelas'];
        $jumlah_penumpang = $_POST['jumlah_penumpang'];
        $harga_tiket = $_POST['harga_tiket'];        

        
        // include database connection file
        include_once("..\config.php");
                
        // Insert user data into table
        $result = mysqli_query($mysqli, "INSERT INTO kelas_kapal(kode_jadwal_kapal,kode_kelas,jumlah_penumpang,harga_tiket) VALUES('$kode_jadwal_kapal','$kode_kelas','$jumlah_penumpang','$harga_tiket')");
        echo mysqli_error($mysqli);
        
        // Show message when user added
        echo "Kelas Kapal added successfully. <a href='index.php'>View Kelas Kapal</a>";
    }
    ?>
</body>
</html>