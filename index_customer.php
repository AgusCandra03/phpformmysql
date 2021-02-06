<html>
    <head>
        <title>Tabel Customer</title>
        <style>
            table, td, tr, th {border: 1px solid black}
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
        <h2>Daftar Customer</h2><br>
        
        <!-- Menu search -->
        <form method="GET" action="">
            <input type="text" name="keyword" value="<?php $keyword; ?>">
            <button type="submit">Search</button>
        </form>

        <a href="insert_customer.php">Tambah Data</a><br>

        <table method="POST" action="">
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>No. KTP</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>

            <?php
                $sql_customer = "SELECT * FROM customer";

                //Fungsi php untuk menu search
                if(strlen($keyword)>0){
                    $sql_customer = "SELECT * FROM customer WHERE
                            nama LIKE '%".$keyword."%'
                            OR nomor_ktp LIKE '%".$keyword."%'
                            OR alamat LIKE '%".$keyword."%'";
                }

                $result_customer = $connection->query($sql_customer);

                if($result_customer->num_rows>0){
                    $i = 1;
                    while($row = $result_customer->fetch_assoc()){
                        echo "<tr>";
                            echo "<td>".$i."</td>";
                            echo "<td>".$row['nama']."</td>";
                            echo "<td>".$row['nomor_ktp']."</td>";
                            echo "<td>".$row['alamat']."</td>";
                            if($row['jenis_kelamin']==1){
                                $row['jenis_kelamin'] = "Laki-laki";
                                echo "<td>".$row['jenis_kelamin']."</td>";
                            }
                            else{
                                $row['jenis_kelamin'] = "Perempuan";
                                echo "<td>".$row['jenis_kelamin']."</td>";
                                }
                            echo "<td>".$row['tanggal_lahir']."</td>";
                            echo "<td><a href='update_customer.php?id=".$row['id']."'>Update</a></td>";
                            echo "<td><a href='delete_customer.php?id=".$row['id']."'>Delete</a></td>";
                        echo "</tr>";
                        $i++;
                    }
                }else{
                    echo "<tr><td colspan=8>Data Kosong</td></tr>".$connection->error;
                
            }
            ?>
        </table>
    </body>
</html>