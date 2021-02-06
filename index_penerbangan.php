<html>
    <head>
        <title>Daftar Penerbangan</title>
        <style>
            table, th, td, tr {border: 1px solid black}
        </style>
    </head>
    <body>
        
        <?php
            $server_name = "localhost";
            $name = "root";
            $password = "";
            $database = "penerbangan";

            $connection = new mysqli($server_name, $name, $password, $database);

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
        <h2>Daftar Penerbangan</h2><br>

        <form method="GET" action="">
            <input type="text" name="keyword" value="<?php echo $keyword; ?>">
            <button type="submit">Search</button>
        </form>

        <a href="insert_penerbangan.php">Tambah Penerbangan</a>

        <table method="POST" action="">
            <tr>
                <th>No.</th>
                <th>Kode Pesawat</th>
                <th>Nama Pesawat</th>
                <th>Asal</th>
                <th>Tujuan</th>
                <th>Waktu Penerbangan</th>
                <th>Status Penerbangan</th>
                <th>Penumpang Penerbangan</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>

            <?php
                $sql_penerbangan = "SELECT penerbangan.id, pesawat.kode_pesawat, pesawat.nama_pesawat, asal.nama_bandara as bandara_asal, 
                tujuan.nama_bandara as bandara_tujuan, penerbangan.waktu_penerbangan, penerbangan.status_penerbangan

                FROM penerbangan, pesawat, bandara as asal, bandara as tujuan
                
                WHERE penerbangan.id_pesawat = pesawat.id AND
                penerbangan.id_bandara_dari = asal.id AND
                penerbangan.id_bandara_tujuan = tujuan.id";

                if(strlen($keyword)>0){
                    $sql_penerbangan = "SELECT * FROM penerbangan, pesawat, bandara WHERE
                            kode_pesawat LIKE '%".$keyword."%'
                            OR nama_pesawat LIKE '%".$keyword."%'
                            OR bandara_asal LIKE '%".$keyword."%'
                            OR bandara_tujuan LIKE '%".$keyword."%'
                            ";
                }

                $result = $connection->query($sql_penerbangan);

                if($result->num_rows>0){
                    $i = 1;
                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                            echo "<td>".$i."</td>";
                            echo "<td>".$row['kode_pesawat']."</td>";
                            echo "<td>".$row['nama_pesawat']."</td>";
                            echo "<td>".$row['bandara_asal']."</td>";
                            echo "<td>".$row['bandara_tujuan']."</td>";
                            echo "<td>".$row['waktu_penerbangan']."</td>";

                            if($row['status_penerbangan']==1){
                                $row['status_penerbangan'] = "Belum Terbang";
                                echo "<td>".$row['status_penerbangan']."</td>";
                            }elseif($row['status_penerbangan']==2){
                                $row['status_penerbangan'] = "Sudah Terbang";
                                echo "<td>".$row['status_penerbangan']."</td>";
                            }else{
                                $row['status_penerbangan'] = "Batal Terbang";
                                echo "<td>".$row['status_penerbangan']."</td>";
                            }
                            
                            
                            echo "<td><a href='index_penumpang.php?id=".$row['id']."'>Detail</a></td>";
                            echo "<td><a href='update_penerbangan.php?id=".$row['id']."'>Update</a></td>";
                            echo "<td><a href='delete_penerbangan.php?id=".$row['id']."'>Delete</a></td>";
                        echo "</tr>";
                        $i++;
                    }
                }else{
                    echo "Data Kosong".$connection->error;
                }
            ?>
        </table>
    </body>
</html>