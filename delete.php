<?php
include 'config.php';
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id = $id";
    $query = mysqli_query($con, $sql);
    header('location: admin.php');
?>