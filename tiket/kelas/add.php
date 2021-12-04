<html>
<head>
    <title>Add Users</title>
</head>
 
<body>
    <a href="index.php">Go to Home</a>
    <br/><br/>
 
    <form action="add.php" method="post" nama_petugas="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Kode Kelas</td>
                <td><input required type="text" name="kode_kelas"></td>
            </tr>

            <tr> 
                <td>Nama Kelas</td>
                <td><input required type="text" name="nama_kelas"></td>
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
        $kode_kelas = $_POST['kode_kelas'];
        $nama_kelas = $_POST['nama_kelas'];
        
        // include database connection file
        include_once("..\config.php");
                
        // Insert user data into table
        $result = mysqli_query($mysqli, "INSERT INTO kelas(kode_kelas,nama_kelas) VALUES('$kode_kelas','$nama_kelas')");
        
        // Show message when user added
        echo "Kelas added successfully. <a href='index.php'>View Kelas</a>";
    }
    ?>
</body>
</html>