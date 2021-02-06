<?php
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $database_name = "penerbangan";

    $connection = new mysqli($server_name, $username, $password, $database_name);

    $id_data = $_GET['id'];
    $sql_delete_data = "DELETE FROM bandara WHERE id=".$id_data;

    if($connection->query($sql_delete_data) == TRUE){
        header('location: index.php');
    }
    else{
        echo "<script>alert('Gagal Menghapus Data')</script>".$connection->error;
    }
?>