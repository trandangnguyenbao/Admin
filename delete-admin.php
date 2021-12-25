<?php 
include 'config.php';
if(isset($_GET['id_admin'])){
	$id = $_GET['id_admin'];
}
$sql = "DELETE FROM admin WHERE id_admin=$id";
if($connect->query($sql) == TRUE){
    header("location:manageadmin.php");
}
else{
    echo "lỗi xáo dữ liệu".$connect->error;
}
$connect->close();
?>