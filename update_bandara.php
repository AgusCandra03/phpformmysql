<html>
    <head>
        <title>Update Data</title>
    </head>
    <body>
    <!-- Menarik data id yang di klik -->
    <?php
        $server_name = "localhost";
        $username = "root";
        $password = "";
        $database_name = "penerbangan";
    
        $connection = new mysqli($server_name, $username, $password, $database_name);

        // mengambil nilai id yang ada pada url
        $id_data = $_GET['id'];
        $sql_get_data = "SELECT * FROM bandara WHERE id=".$id_data;
        $result_get_data = $connection->query($sql_get_data);
        // jika data ada
        $data_diupdate = '';
        if($result_get_data->num_rows>0){
            $data_diupdate = $result_get_data->fetch_assoc();
        }
    ?>

        <b>Update Form Bandara</b><br>
        <form method="POST" action="">
            Kode Bandara : <input type="text" name="kode_bandara" value="<?php echo $data_diupdate['kode_bandara'] ?>"><br>
            Nama Bandara : <input type="text" name="nama_bandara" value="<?php echo $data_diupdate['nama_bandara'] ?>"><br>
            Alamat Bandara : <input type="text" name="alamat_bandara" value="<?php echo $data_diupdate['alamat_bandara'] ?>"><br>
            <button type="submit">Simpan</button>
        </form>
        <?php
            if(count($_POST)>1){
                //fungsi menyimpan data
                if(!$connection->connect_error){
                    $sql_bandara = "UPDATE bandara SET
                        kode_bandara='".$_POST['kode_bandara']."',
                        nama_bandara='".$_POST['nama_bandara']."',
                        alamat_bandara='".$_POST['alamat_bandara']."',
                        updated_at='".date('Y-m-d h:i:s')."'
                        WHERE id=".$id_data;

                    if($connection->query($sql_bandara)==TRUE){
                        header('location: index.php');
                    }
                    else{
                        echo "<script>alert('Gagal Memasukkan Data')</script>".$connection->error;
                    }
                }
            }  
            
        ?>
    </body>
</html>