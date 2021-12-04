<?php
// include database connection file
include_once("..\config.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $kode_kelas=$_POST['kode_kelas'];
    $nama_kelas=$_POST['nama_kelas'];
        
    // update user data
    $result = mysqli_query($mysqli, "UPDATE kelas SET kode_kelas='$kode_kelas', nama_kelas='$nama_kelas' WHERE kode_kelas='$id'");
    
    // Redirect to homepage to display updated user in list
    header("Location: index.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$kode_kelas = $_GET['id'];
 
// Fetech user data based on kode_kelas
$result = mysqli_query($mysqli, "SELECT * FROM kelas WHERE kode_kelas='$kode_kelas'");
 
while($user_data = mysqli_fetch_array($result))
{
    $kode_kelas = $user_data['kode_kelas'];
    $nama_kelas = $user_data['nama_kelas'];
}
?>
<html>
<head>    
    <title>Tiket Kapal</title>
</head>
 
<body>
    <a href="index.php">Home</a>
    <br/><br/>
    
    <form name="update_user" method="post" action="edit.php">
        <table border="0">
            <tr> 
                <td>Kode Kelas</td>
                <td><input type="text" name="kode_kelas" value=<?php echo $kode_kelas;?>></td>
            </tr>

            <tr> 
                <td>Nama Kelas</td>
                <td><input type="text" name="nama_kelas" value="<?php echo $nama_kelas;?>"></td>
            </tr>

                <td><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>