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
                <td>Kode Kapal</td>
                <td><input required type="text" name="kode_kapal"></td>
            </tr>
            <tr> 
                <td>Nama Kapal</td>
                <td><input required type="text" name="nama_kapal"></td>
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
        $kode_kapal = $_POST['kode_kapal'];
        $nama_kapal = $_POST['nama_kapal'];
        
        // include database connection file
        include_once("..\config.php");
         
        // Select data kapal saat ini 
        $result_kapal = mysqli_query($mysqli, "SELECT * FROM kapal ORDER BY kode_kapal DESC");
        
        while($data = mysqli_fetch_array($result_kapal)) {         
            if($data['kode_kapal'] == ($kode_kapal)){
                echo "Duplicate entry ".$kode_kapal." for key 'PRIMARY'";
                return;
            }
        }
        
        // Insert user data into table
        $result = mysqli_query($mysqli, "INSERT INTO kapal(kode_kapal,nama_kapal) VALUES('$kode_kapal','$nama_kapal')");

        // Show message when user added
        echo "User added successfully. <a href='index.php'>View Data</a>";
    }
    ?>
</body>
</html>