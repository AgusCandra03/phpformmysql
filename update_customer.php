<html>
    <head>
        <title>Form Update Data</title>
    </head>
    <body>
        <?php
            $server_name = "localhost";
            $name = "root";
            $password = "";
            $database = "penerbangan";

            $connection = new mysqli($server_name, $name, $password, $database);

            $get_id = $_GET['id'];
            $sql_get_customer = "SELECT * FROM customer WHERE id=".$get_id;
            $result_get_customer = $connection->query($sql_get_customer);

            $data_update = '';
            if($result_get_customer->num_rows>0){
                $data_update = $result_get_customer->fetch_assoc();
            }
        ?>

        <h1>Update From Bandara</h1><br>
        <form method="POST" action="">
            Nama Lengkap :
            <input type="text" name="nama" value="<?php echo $data_update['nama'] ?>"><br>
            Nomor KTP :
            <input type="text" name="nomor_ktp" value="<?php echo $data_update['nomor_ktp'] ?>"><br>
            Alamat :
            <input type="text" name="alamat" value="<?php echo $data_update['alamat'] ?>"><br>
            Jenis Kelamin :
            <input type="text" name="jenis_kelamin" value="<?php echo $data_update['jenis_kelamin'] ?>"><br>
            Tanggal Lahir :
            <input type="date" name="tanggal_lahir" value="<?php echo $data_update['tanggal_lahir'] ?>"><br>

            <button type="submit">Update</button>
        </form>
    
        <?php
            if(count($_POST)>1){
                if(!$connection->connect_error){
                    $sql_update_customer = "UPDATE customer SET 
                    nama='".$_POST['nama']."',
                    nomor_ktp='".$_POST['nomor_ktp']."',
                    alamat='".$_POST['alamat']."',
                    jenis_kelamin='".$_POST['jenis_kelamin']."',
                    tanggal_lahir='".$_POST['tanggal_lahir']."',
                    updated_at='".date('Y-m-d h:i:s')."'
                    WHERE id=".$get_id;

                    if($connection->query($sql_update_customer)==TRUE){
                        header('location: index_customer.php');
                    }else{
                        echo "<script>Gagal mengupdate Data</script>".$connection->error;
                    }
                }
            }
        ?>
    </body>

</html>