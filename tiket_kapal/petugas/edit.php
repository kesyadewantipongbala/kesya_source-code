<?php
// include database connection file
include_once("..\config.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $nama_petugas=$_POST['nama_petugas'];
        
    // update user data
    $result = mysqli_query($mysqli, "UPDATE petugas SET nama_petugas='$nama_petugas' WHERE id_petugas=$id");
    
    // Redirect to homepage to display updated user in list
    header("Location: index.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id_petugas = $_GET['id'];
 
// Fetech user data based on id_petugas
$result = mysqli_query($mysqli, "SELECT * FROM petugas WHERE id_petugas=$id_petugas");
 
while($user_data = mysqli_fetch_array($result))
{
    $nama_petugas = $user_data['nama_petugas'];
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
                <td>Nama Petugas</td>
                <td><input type="text" name="nama_petugas" value=<?php echo $nama_petugas;?>></td>
            </tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>