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
                <td>Nama Petugas</td>
                <td><input type="text" name="nama_petugas"></td>
            </tr>            
                <td></td>
                <td><input type="submit" name="Submit"></td>
            </tr>
        </table>
    </form>
    
    <?php
 
    // Check If form submitted, insert form data into users table.
    if(isset($_POST['Submit'])) {
        $nama_petugas = $_POST['nama_petugas'];
        
        // include database connection file
        include_once("..\config.php");
                
        // Insert user data into table
        $result = mysqli_query($mysqli, "INSERT INTO petugas(nama_petugas) VALUES('$nama_petugas')");
        
        // Show message when user added
        echo "User added successfully. <a href='index.php'>View Data</a>";
    }
    ?>
</body>
</html>