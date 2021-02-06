<html>
    <head>
        <title>Form Insert Pesawat</title>
    </head>
    <body>
        <h1>Form Tambah Pesawat</h1>
        <form method="POST" action="">
            Kode Pesawat :
            <input type="text" name="kode_pesawat"><br>
            Tahun Pembuatan :
            <input type="text" name="tahun_pembuatan"><br>
            Nama Pesawat :
            <input type="text" name="nama_pesawat"><br>
            Nama Maskapai :
            <input type="text" name="nama_maskapai"><br>

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
                    $sql_insert_pesawat = "INSERT INTO pesawat (kode_pesawat, tahun_pembuatan, nama_pesawat, nama_maskapai, created_at, updated_at) VALUE (
                        '".$_POST['kode_pesawat']."',
                        '".$_POST['tahun_pembuatan']."',
                        '".$_POST['nama_pesawat']."',
                        '".$_POST['nama_maskapai']."',
                        '".date('Y-m-d h:i:s')."',
                        '".date('Y-m-d h:i:s')."'
                    )";

                    if($connection->query($sql_insert_pesawat)==TRUE){
                        header('location: index_pesawat.php');
                    }else{
                        echo "<script>alert('Data Gagal Dimasukkan')</script>".$connection->error;
                    }
                }
            }
                

        ?>


    </body>
</html>