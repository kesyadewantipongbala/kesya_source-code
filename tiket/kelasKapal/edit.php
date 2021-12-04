<?php
// include database connection file
include_once("..\config.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $kode_jadwal_kapal=$_POST['kode_jadwal_kapal'];
    $kode_kelas=$_POST['kode_kelas'];
    $jumlah_penumpang=$_POST['jumlah_penumpang'];
    $harga_tiket=$_POST['harga_tiket'];
        
    // update user data
    $result = mysqli_query($mysqli, "UPDATE kelas_kapal SET kode_jadwal_kapal='$kode_jadwal_kapal', kode_kelas='$kode_kelas', jumlah_penumpang='$jumlah_penumpang', harga_tiket='$harga_tiket' WHERE id_kelas_kapal=$id");
    // echo mysqli_error($mysqli);
    
    // Redirect to homepage to display updated user in list
    header("Location: index.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id_kelas_kapal = $_GET['id'];
 
// Fetech user data based on id_kelas_kapal
$result = mysqli_query($mysqli, "SELECT * FROM kelas_kapal WHERE id_kelas_kapal='$id_kelas_kapal'");
$jadwal_kapal = mysqli_query($mysqli, "SELECT * FROM jadwal_kapal inner join kapal on kapal.kode_kapal = jadwal_kapal.kode_kapal");
$kelas = mysqli_query($mysqli, "SELECT * FROM kelas");
$jadwal_kapal = mysqli_query($mysqli, "SELECT * FROM jadwal_kapal");
while($data = mysqli_fetch_array($result))
{
    $kode_jadwal_kapal = $data['kode_jadwal_kapal'];
    $kode_kelas = $data['kode_kelas'];
    $jumlah_penumpang = $data['jumlah_penumpang'];
    $harga_tiket = $data['harga_tiket'];
}
?>
<html>
<head>    
    <title>Edit User Data</title>
</head>
 
<body>
    <a href="index.php">Home</a>
    <br/><br/>
    
    <form name="update_user" method="post" action="edit.php">
        <table border="0">
            
            <tr> 
                <td>Kode Jadwal Kapal</td>
                <td>
                    <select name="kode_jadwal_kapal" >
                        <?php  while ($val=mysqli_fetch_array($jadwal_kapal)) {?>
                        <option <?php if ($kode_jadwal_kapal==$val['kode_jadwal_kapal']):?> selected <?php endif ?>  value="<?php echo $val['kode_jadwal_kapal'] ?>" ><?php echo $val['kode_jadwal_kapal'] ?></option>
                    <?php   } ?>
                    </select>
                </td>                
            </tr>

            <tr> 
                <td>Kode Kelas</td>
                <td>
                    <select name="kode_kelas" >
                        <?php  while ($val=mysqli_fetch_array($kelas)) {?>
                        <option <?php if ($kode_kelas==$val['kode_kelas']):?> selected <?php endif ?>  value="<?php echo $val['kode_kelas'] ?>" ><?php echo $val['kode_kelas'].' - '.$val['nama_kelas'] ?></option>
                    <?php   } ?>
                    </select>
                </td>                
            </tr>

            <tr> 
                <td>Jumlah Penumpang</td>
                <td><input required type="number" value="<?php echo $jumlah_penumpang ?>" name="jumlah_penumpang"></td>
            </tr>

            <tr> 
                <td>Harga Tiket</td>
                <td><input required type="number" value="<?php echo $harga_tiket ?>" name="harga_tiket"></td>
            </tr>

            <tr>
                <td><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>