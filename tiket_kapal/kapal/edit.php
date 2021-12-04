<?php
// include database connection file
include_once("..\config.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $kode_kapal=$_POST['kode_kapal'];
    $nama_kapal=$_POST['nama_kapal'];
        
    // update user data
    $result = mysqli_query($mysqli, "UPDATE kapal SET kode_kapal='$kode_kapal',nama_kapal='$nama_kapal' WHERE kode_kapal='$id'");
    
    // Redirect to homepage to display updated user in list
    header("Location: index.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$kode_kapal = $_GET['id'];
 
// Fetech user data based on id_petugas
$result = mysqli_query($mysqli, "SELECT * FROM kapal WHERE kode_kapal='$kode_kapal'");
 
while($user_data = mysqli_fetch_array($result))
{
    $kode_kapal = $user_data['kode_kapal'];
    $nama_kapal = $user_data['nama_kapal'];
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
                <td>Kode Kapal</td>
                <td><input type="text" name="kode_kapal" value=<?php echo $kode_kapal;?>></td>
            </tr>
            <tr> 
                <td>Nama Kapal</td>
                <td><input type="text" name="nama_kapal" value=<?php echo $nama_kapal;?>></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>