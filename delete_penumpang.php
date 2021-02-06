<?php

    $server_name = "localhost";
    $name = "root";
    $password = "";
    $database = "penerbangan";

    $connection = new mysqli($server_name, $name, $password, $database);

    $get_id = $_GET['id'];
    $sql_delete_penumpang = "DELETE FROM penumpang_penerbangan WHERE id=".$get_id;

    if($connection->query($sql_delete_penumpang)){
        header('location: index_penumpang.php');
    }else{
        echo "<script>alert('Gagal Menghapus Data')</script>";
    }

?>