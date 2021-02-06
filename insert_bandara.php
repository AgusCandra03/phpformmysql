<html>
    <head>
        <title>Insert Data</title>
    </head>
    <body>
        <b>Form Bandara</b><br>
        <form method="POST" action="">
            Kode Bandara : <input type="text" name="kode_bandara"><br>
            Nama Bandara : <input type="text" name="nama_bandara"><br>
            Alamat Bandara : <input type="text" name="alamat_bandara"><br>
            <button type="submit">Simpan</button>
        </form>
        <?php
            if(count($_POST)>1){
                $server_name = "localhost";
                $username = "root";
                $password = "";
                $database_name = "penerbangan";
            
                $connection = new mysqli($server_name, $username, $password, $database_name);

                //fungsi menyimpan data
                if(!$connection->connect_error){
                    $sql_bandara = "INSERT INTO bandara (kode_bandara, nama_bandara, alamat_bandara, created_at, updated_at) VALUE (
                        '".$_POST['kode_bandara']."',
                        '".$_POST['nama_bandara']."',
                        '".$_POST['alamat_bandara']."',
                        '".date('Y-m-d h:i:s')."',
                        '".date('Y-m-d h:i:s')."')";

                    if($connection->query($sql_bandara)==TRUE){
                        header('location: index.php');
                    }
                    else{
                        echo "<script>alert('Gagal Memasukkan Data Bandara')</script>".$connection->error;
                    }
                }
            }  
            
        ?>
    </body>
</html>