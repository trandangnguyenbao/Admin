<?php
include 'config.php';
    $id = $_GET['id'];
    $sql = "DELETE FROM product WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    header('location: admin.php');
?>