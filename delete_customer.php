<?php

    $server_name = "localhost";
    $name = "root";
    $password = "";
    $database = "penerbangan";

    $connection = new mysqli($server_name, $name, $password, $database);

    $get_id = $_GET['id'];
    $sql_delete_customer = "DELETE FROM customer WHERE id=".$get_id;

    if($connection->query($sql_delete_customer)==TRUE){
        header('location: index_customer.php');
    }else{
        echo "<script>alert('Gagal Menghapus Data')</script>";
    }

?>