<?php
// include database connection file
include_once("..\config.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    $tgl_berangkat=$_POST['tgl_berangkat'];
    $jam_berangkat=$_POST['jam_berangkat'];
    $tgl_tiba=$_POST['tgl_tiba'];
    $jam_tiba=$_POST['jam_tiba'];
    
    $kode_jadwal_kapal=$_POST['kode_jadwal_kapal'];
    $kode_kapal=$_POST['kode_kapal'];
    $tgl_jam_berangkat = date('Y-m-d H:i:s', strtotime("$tgl_berangkat $jam_berangkat"));
    $tgl_jam_tiba = date('Y-m-d H:i:s', strtotime("$tgl_tiba $jam_tiba"));
        
    // update user data
    $result = mysqli_query($mysqli, "UPDATE jadwal_kapal SET kode_jadwal_kapal='$kode_jadwal_kapal', kode_kapal='$kode_kapal', tgl_jam_berangkat='$tgl_jam_berangkat', tgl_jam_tiba='$tgl_jam_tiba' WHERE kode_jadwal_kapal='$id'");
    
    // Redirect to homepage to display updated user in list
    header("Location: index.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$kode_jadwal_kapal = $_GET['id'];
 
// Fetech user data based on kode_jadwal_kapal
$result = mysqli_query($mysqli, "SELECT * FROM jadwal_kapal WHERE kode_jadwal_kapal='$kode_jadwal_kapal'");
$kapal = mysqli_query($mysqli, "SELECT * FROM kapal");
while($data = mysqli_fetch_array($result))
{
    $kode_jadwal_kapal = $data['kode_jadwal_kapal'];
    $kode_kapal = $data['kode_kapal'];
    $tgl_jam_berangkat = $data['tgl_jam_berangkat'];
    $tgl_jam_tiba = $data['tgl_jam_tiba'];
}
?>
<html>
<head>    
    <title>Tiket Kapal</title>
</head>
 
<body>
    <a href="index.php">Home</a>
    <br/><br/>
    <pre>
    </pre>
    <form name="update_user" method="post" action="edit.php">
        <table border="0">
            <tr> 
                <td>Kode Jadwal Kapal</td>
                <td><input required type="text" value="<?php echo $kode_jadwal_kapal ?>" name="kode_jadwal_kapal"></td>
            </tr>

            <tr> 
                <td>Kode Kapal</td>
                <td>
                    <select name="kode_kapal" >
                        <?php  while ($val=mysqli_fetch_array($kapal)) {?>
                        <option <?php if ($kode_kapal==$val['kode_kapal']):?> selected <?php endif ?>  value="<?php echo $val['kode_kapal'] ?>" ><?php echo $val['kode_kapal'].' - '.$val['nama_kapal'] ?></option>
                    <?php   } ?>
                    </select>
                </td>                
            </tr>


            <tr> 
                <td>Tanggal Berangkat</td>
                <td><input required type="date" value="<?php echo date("Y-m-d", strtotime($tgl_jam_berangkat)); ?>" name="tgl_berangkat"></td>
            </tr>

            <tr> 
                <td>Jam Berangkat</td>
                <td><input required type="time" value="<?php echo date('H:i', strtotime($tgl_jam_berangkat)) ?>" name="jam_berangkat"></td>
            </tr>

            <tr> 
                <td>Tanggal Tiba</td>
                <td><input required type="date" value="<?php echo date('Y-m-d', strtotime($tgl_jam_tiba)) ?>" name="tgl_tiba"></td>
            </tr>

            <tr> 
                <td>Jam Tiba</td>
                <td><input required type="time" value="<?php echo date('H:i', strtotime($tgl_jam_tiba)) ?>" name="jam_tiba"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>