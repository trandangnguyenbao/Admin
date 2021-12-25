<?php 
$username = "root"; // Khai báo username
$password = ""; // Khai báo password
$server = "localhost"; // Khai báo server
$dbname = "webbtl"; // Khai báo database
// Kết nối database tintuc
$connect = new mysqli($server, $username, $password, $dbname);
//Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
if ($connect->connect_error) {
     die("Không kết nối :" . $conn->connect_error);
    exit();
}
if(isset($_GET['id'])){
	$id = $_GET['id'];
}
$sql = "DELETE FROM `order` WHERE id=$id";
if($connect->query($sql) == TRUE){
    header("location:quanlidonhang.php");
}
else{
    echo "lỗi xáo dữ liệu".$connect->error;
}
$connect->close();
?>