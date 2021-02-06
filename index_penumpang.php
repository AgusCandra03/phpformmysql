<html>
    <head>
        <title>Daftar Penumpang</title>
        <style>
            table, tr, th, td {border: 1px solid black}
        </style>
        <body>
            
            <?php
                $server_name =  "localhost";
                $name = "root";
                $password = "";
                $database = "penerbangan";

                $connection = new mysqli($server_name, $name, $password, $database);

                $keyword = "";
                if(count($_GET)>0){
                    $keyword = $_GET['keyword'];
                }
            ?>

            <h2>Daftar Penumpang Penerbangan</h2><br>

            <form method="GET" action="">
                <input type="text" name="keyword" value="<?php echo $keyword; ?>">
                <button type="submit">Search</button>
            </form>

            <a href="insert_penumpang.php">Tambah Penumpang</a><br>

            <table method="POST" action="">
                <tr>
                    <td>No.</td>
                    <td>Penerbangan</td>
                    <td>Penumpang</td>
                    <td>Status</td>
                    <td>Update</td>
                    <td>Delete</td>
                </tr>

                <?php
                    $sql_penumpang = "SELECT penumpang_penerbangan.id, penerbangan.id_pesawat ,customer.nama, penerbangan.waktu_penerbangan, penumpang_penerbangan.status_penumpang 

                    FROM penumpang_penerbangan, customer, penerbangan
                    
                    WHERE penumpang_penerbangan.id_penumpang = customer.id AND penumpang_penerbangan.id_penerbangan = penerbangan.id";

                    if(strlen($keyword)>0){
                        $sql_penumpang = "SELECT * FROM penumpang_penerbangan, customer WHERE
                                nama LIKE '%".$keyword."%'
                        ";
                    }

                    $result = $connection->query($sql_penumpang);

                    if($result->num_rows>0){
                        $i = 1;
                        while($row = $result->fetch_assoc()){
                            echo "<tr>";
                                echo "<td>".$i."</td>";
                                echo "<td>".$row['id']."</td>";
                                echo "<td>".$row['nama']."</td>";

                                if($row['status_penumpang']==1){
                                    $row['status_penumpang'] = "Belum Terbang";
                                    echo "<td>".$row['status_penumpang']."</td>";
                                }elseif($row['status_penumpang']==2){
                                    $row['status_penumpang'] = "Sudah Terbang";
                                    echo "<td>".$row['status_penumpang']."</td>";
                                }else{
                                    $row['status_penumpang'] = "Batal Terbang";
                                    echo "<td>".$row['status_penumpang']."</td>";
                                }

                                
                                echo "<td><a href='update_penumpang.php?id=".$row['id']."'>Update</a></td>";
                                echo "<td><a href='delete_penumpang.php?id=".$row['id']."'>Delete</a></td>";
                            echo "</tr>";
                            $i++;
                        }
                    }else{
                        echo "Data Kosong".$connection->error;
                    }
                ?>

            </table>

        </body>
    </head>
</html>