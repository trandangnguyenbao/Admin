<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
       
        <div class="login">
                    <h2 class="login-header">Signup</h2>            
                     <div class="grid">
						<?php
						if (isset($_SESSION["thongbao"])){
							echo $_SESSION["thongbao"];
							session_unset();
						}
						?>    
                         <form class="login-container" action="" method="POST">
                             <input type="email" placeholder="Email" name="Email" required="">
                             <input type="password" placeholder="Mật khẩu" name="password">
                             <input type="password" placeholder="Nhập lại mật khẩu" name="repassword">
                             <input type="submit" value="Update Admin" name="submit">
                         </form>
                     </div>
                </div>
    </div>
</div>
<?php
$username = "root"; // Khai báo username
$password = ""; // Khai báo password
$server = "localhost"; // Khai báo server
$dbname = "user"; // Khai báo database
// Kết nối database tintuc
$connect = mysqli_connect($server, $username, $password, $dbname);

//Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
if (!$connect) {
    die("Không kết nối :" . mysqli_connect_error());
    exit();
}
if (isset($_POST['submit'])){
    $id=$_GET['id_admin'];
    $Email=$_POST['Email'];
    $password=$_POST['password'];
    // Check connection
    $sql = "UPDATE admin SET Email='$Email', password='$password'WHERE id_admin=$id";
    $query = mysqli_query($connect,$sql);
    if($query == TRUE){
        $_SESSION['update'] = "Admin Update Successfully!";
        header("location:manageadmin.php");
    } 
    else{
        $_SESSION['update'] = "Admin Update to Failed!";
        header("location:manageadmin.php");
    }
    $connect->close();
    }
?>