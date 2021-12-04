<?php
// Create database connection using config file
include_once("..\config.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM kapal");
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
                <td><input required type="text" name="kode_jadwal_kapal"></td>
            </tr>

            <tr> 
                <td>Kode Kapal</td>
                <td>
                    <select name="kode_kapal" >
                        <?php  while ($data=mysqli_fetch_array($result)) {?>
                        <option value="<?php echo $data['kode_kapal'] ?>" ><?php echo $data['kode_kapal'].' - '.$data['nama_kapal'] ?></option>
                    <?php   } ?>
                    </select>
                </td>                
            </tr>


            <tr> 
                <td>Tanggal Berangkat</td>
                <td><input required type="date" name="tgl_berangkat"></td>
            </tr>

            <tr> 
                <td>Jam Berangkat</td>
                <td><input required type="time" name="jam_berangkat"></td>
            </tr>

            <tr> 
                <td>Tanggal Tiba</td>
                <td><input required type="date" name="tgl_tiba"></td>
            </tr>

            <tr> 
                <td>Jam Tiba</td>
                <td><input required type="time" name="jam_tiba"></td>
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
        $tgl_berangkat=$_POST['tgl_berangkat'];
        $jam_berangkat=$_POST['jam_berangkat'];
        $tgl_tiba=$_POST['tgl_tiba'];
        $jam_tiba=$_POST['jam_tiba'];

        $kode_jadwal_kapal = $_POST['kode_jadwal_kapal'];
        $kode_kapal = $_POST['kode_kapal'];
        $tgl_jam_berangkat = date('Y-m-d H:i:s', strtotime("$tgl_berangkat $jam_berangkat"));
        $tgl_jam_tiba = date('Y-m-d H:i:s', strtotime("$tgl_tiba $jam_tiba"));
        // $tgl_jam_tiba = date('Y-m-d H:i:s', strtotime("$_POST['tgl_tiba'] $_POST['jam_tiba']"));

        
        // include database connection file
        include_once("..\config.php");

             $result_jadwal_kapal = mysqli_query($mysqli, "SELECT * FROM kelas_kapal
    inner join kelas on kelas.kode_kelas = kelas_kapal.kode_kelas
    inner join jadwal_kapal on jadwal_kapal.kode_jadwal_kapal = kelas_kapal.kode_jadwal_kapal
    inner join kapal on kapal.kode_kapal = jadwal_kapal.kode_kapal");

    while($data = mysqli_fetch_array($result_jadwal_kapal)) {         
        if($data['kode_jadwal_kapal'] == $kode_jadwal_kapal){
            echo "Duplicate entry ".$kode_jadwal_kapal." for key 'PRIMARY'";
            return;
        }
    }
                
        // Insert user data into table
        $result = mysqli_query($mysqli, "INSERT INTO jadwal_kapal(kode_jadwal_kapal,kode_kapal,tgl_jam_berangkat,tgl_jam_tiba) VALUES('$kode_jadwal_kapal','$kode_kapal','$tgl_jam_berangkat','$tgl_jam_tiba')");
        // echo mysqli_error($mysqli);
        
        // Show message when user added
        echo "Jadwal added successfully. <a href='index.php'>View Jadwal</a>";
    }
    ?>
</body>
</html>