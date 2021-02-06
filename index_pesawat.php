<html>
    <head>
        <title>Tabel Pesawat</title>
        <style>
            table, tr, td, th {border: 1px solid black}
        </style>
        <body>
        
        <?php
            $server_name = "localhost";
            $name ="root";
            $password = "";
            $database = "penerbangan";

            $conncetion = new mysqli($server_name, $name, $password, $database);

            $keyword ="";
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
        <h2>Daftar Pesawat</h2><br>

        <form method="GET" action="">
            <input type="text" name="keyword" value="<?php echo $keyword; ?>">
            <button type=submit>Search</button>
        </form>

        <a href="insert_pesawat.php">Tambah Data</a><br>

        <table action="POST" method="">
            <tr>
                <th>No.</th>
                <th>Kode Pesawat</th>
                <th>Nama Pesawat</th>
                <th>Tahun Pembuatan</th>
                <th>Nama Maskapai</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>

            <?php
                $sql_pesawat = "SELECT * FROM pesawat";

                if(strlen($keyword)>0){
                    $sql_pesawat = "SELECT * FROM pesawat WHERE
                            kode_pesawat LIKE '%".$keyword."%'
                            OR nama_pesawat LIKE '%".$keyword."%'
                            OR tahun_pembuatan LIKE '%".$keyword."%'
                            OR nama_maskapai LIKE '%".$keyword."%'";
                }

                $result_pesawat = $conncetion->query($sql_pesawat);

                if($result_pesawat->num_rows>0){
                    $i = 1;
                    while($row = $result_pesawat->fetch_array()){
                        echo "<tr>";
                            echo "<td>".$i."</td>";
                            echo "<td>".$row['kode_pesawat']."</td>";
                            echo "<td>".$row['nama_pesawat']."</td>";
                            echo "<td>".$row['tahun_pembuatan']."</td>";
                            echo "<td>".$row['nama_maskapai']."</td>";
                            echo "<td><a href='update_pesawat.php?id=".$row['id']."'>Update</a></td>";
                            echo "<td><a href='delete_pesawat.php?id=".$row['id']."'>Delete</a></td>";
                        echo "</tr>";
                        $i++;
                    }
                }else{
                    echo "<tr><td colspan=7>Data Kosong</td></tr>";
                }
            ?>

        </table>

        </body>
    </head>
</html>