<html>
    <head>
        <title>CRUD MySQL Dengan Form</title>
        <!-- CSS Menampilkan border pada table -->
        <style>
            table, td, tr, th {border: 1px solid black}
        </style>
    </head>
    <body>
        <?php
            $server_name = "localhost";
            $username = "root";
            $password = "";
            $database_name = "penerbangan";
        
            $connection = new mysqli($server_name, $username, $password, $database_name);
            
            //Search
            $keyword = "";
            if(count($_GET)>0){
                $keyword = $_GET['keyword'];
            }
        ?>
        <div class="menu">
            <button><a href="index.php">Bandara</a></button>
            <button><a href="index_customer.php">Customer</a></button>
            <button><a href="index_pesawat.php">Pesawat</a></button>
            <button><a href="index_penerbangan.php">Penerbangan</a></button>
        </div>
        <h2>Daftar Bandara</h2><br>
        
        <form action="" method="GET">
            <input type="text" name="keyword" value="<?php echo $keyword; ?>">
            <button type="submit">Search</button>
        </form>

        <a href="insert_bandara.php">Tambah Data</a><br>
        <table>
            <tr>
                <td>No.</td>
                <td>Kode Bandara</td>
                <td>Bandara</td>
                <td>Alamat Bandara</td>
                <td>Update</td>
                <td>Delete</td>
            </tr>
            <?php
                $sql_bandara = "SELECT * FROM bandara";

                //fungsi php pada menu search
                //if(strlen($keyword)>0){    <------ Bisa juga menggunakan strlen
                if($keyword!=""){
                    $sql_bandara = "SELECT * FROM bandara WHERE 
                        kode_bandara LIKE '%".$keyword."%' 
                        OR nama_bandara LIKE '%".$keyword."%' 
                        OR alamat_bandara LIKE '%".$keyword."%'";
                }

                $result_bandara = $connection->query($sql_bandara);

                //Mengecek Apakah Hasil Datanya Ada
                if($result_bandara->num_rows>0){
                    //Membuat nomor yang berurutan dengan while
                    $i = 1;
                    //Perulangan nilai didalam tabel pesawat
                    while($row = $result_bandara->fetch_assoc()){ // fetch_assoc digunakan sebagai pengganti fetch_array
                        echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$row['kode_bandara']."</td>";
                        echo "<td>".$row['nama_bandara']."</td>";
                        echo "<td>".$row['alamat_bandara']."</td>";
                        echo "<td><a href='update_bandara.php?id=".$row['id']."'>Update</a></td>";
                        echo "<td><a href='delete_bandara.php?id=".$row['id']."'>Delete</a></td>";
                        echo "</tr>";
                        $i++;
                    }
                }else{
                    echo "<tr><td colspan='5'>Tidak ada data dalam tabel</td></tr>";
                }

            ?>
        </table>
        
    </body>
</html>