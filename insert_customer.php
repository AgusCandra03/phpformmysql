<hntml>
    <head>
        <title>Form Insert Customer</title>
    </head>
    <body>
        <h1>Form Tambah Customer</h1>
        <form method="POST" action="">
            Nama Lengkap :
            <input type="text" name="nama"><br>
            Nomor KTP :
            <input type="text" name="nomor_ktp"><br>
            Alamat :
            <input type="text" name="alamat"><br>
            Jenis Kelamin :
            <input type="text" name="jenis_kelamin"><br>
            Tanggal Lahir :
            <input type="date" name="tanggal_lahir"><br>

            <button type="submit">Simpan</button>
        </form>

        <?php
            if(count($_POST)>1){
                $server_name = "localhost";
                $name = "root";
                $password = "";
                $database = "penerbangan";

                $connection = new mysqli($server_name, $name, $password, $database);

                if(!$connection->connect_error){
                    $sql_insert_customer = "INSERT INTO customer (nama, nomor_ktp, alamat, jenis_kelamin, tanggal_lahir, created_at, updated_at) VALUE (
                        '".$_POST['nama']."',
                        '".$_POST['nomor_ktp']."',
                        '".$_POST['alamat']."',
                        '".$_POST['jenis_kelamin']."',
                        '".$_POST['tanggal_lahir']."',
                        '".date('Y-m-d h:i:s')."',
                        '".date('Y-m-d h:i:s')."'
                        )";
                    
                    if($connection->query($sql_insert_customer)==TRUE){
                        header('location: index_customer.php');
                    }else{
                        echo "gagal Memasukkan data".$connection->error;
                        //echo "<script>alert('Gagal Memasukkan Data Customer')</script>";
                    }


                }else{
                    //echo "koneksi gagal";
                }
            }
        ?>
    </body>
</hntml>