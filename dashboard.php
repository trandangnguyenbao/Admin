<?php
            if (isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
                }
            ?>
            <?php
            $username = "root"; // Khai báo username
            $password = ""; // Khai báo password
            $server = "localhost"; // Khai báo server
            $dbname = "webbtl"; // Khai báo database
            // Kết nối database tintuc
            $conn = mysqli_connect($server, $username, $password, $dbname);

            //Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
            if (!$conn) {
                die("Không kết nối :" . mysqli_connect_error());
                exit();
            }
        ?>
<!DOCTYPE html>
<head>
	<title>NHÀ QUÊ</title>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link href="admin.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div id="header">
        <ul class="header__top">
            <li class="header__top--item"><i class="fa fa-map-marker" aria-hidden="true"></i> 146 cửa hàng trên toàn quốc</li>
            <li class="header__top--item"><i class="fa fa-phone" aria-hidden="true"></i> Đặt hàng: 09785686865</li>
            <li class="header__top--item"><i class="fa fa-check" aria-hidden="true"></i>Là chuỗi cafe tại chỗ lớn trong nước</li>
        </ul>
        <div class="nav">
            <img src="image/logo_header.png" alt="" class="nav--item">
            <ul class="nav__list">
                <a href="dashboard.php"><li class="nav__list--item">Dashboard</li></a>
                <a href="danhsach.php"><li class="nav__list--item">Manage Product</li></a>
                <a href="quanliloaihang.php"><li class="nav__list--item">Manage category</li></a>
                <a href="quanlidonhang.php"><li class="nav__list--item">Manage Order</li></a>
                <a href="quanlytaikhoan.php"><li class="nav__list--item">Manager User</li></a>
                <a href="dangxuat.php"><li class="nav__list--item">Log Out</li></a>
            </ul>
        </div>
        <div class="background">
            <img src="image/banner-web-desktop_6f6298edc7f24867b2766f995ecb0a09.jpeg" alt="">
        </div>
    </div>

    <div class="main-content">
            <div class="wrapper">
                <h1>Danh Mục Quản Lý </h1>
        <br><br>
        
                <div class="col-4 text-center">
                    <?php
                        $sql = "SELECT * FROM user";
    
                        $res = mysqli_query($conn, $sql);
    
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    Tài Khoản
                </div>
                
                <div class="col-4 text-center">
                <?php
                        $sql = "SELECT * FROM product_type";
    
                        $res = mysqli_query($conn, $sql);
    
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    Loại Hàng
                </div>
    
                <div class="col-4 text-center">
                    <?php
                        $sql = "SELECT * FROM `order`";
    
                        $res = mysqli_query($conn, $sql);
    
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    Số Đơn Hàng
                </div>
    
                <div class="col-4 text-center">
                <?php
                        $sql = "SELECT * FROM product";
    
                        $res = mysqli_query($conn, $sql);
    
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    Số Sản Phẩm
                </div>
                <div class="col-4 text-center">
                <?php
                        $sql = "SELECT * FROM product Where ma_lh = '1'";
    
                        $res = mysqli_query($conn, $sql);
    
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    Nước Giải Khát
                </div>
                <div class="col-4 text-center">
                <?php
                        $sql = "SELECT * FROM product Where ma_lh = '2'";
    
                        $res = mysqli_query($conn, $sql);
    
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    Đồ Ăn Vặt
                </div>
                <div class="col-4 text-center">
                <?php
                        $sql = "SELECT * FROM product Where ma_lh = '3'";
    
                        $res = mysqli_query($conn, $sql);
    
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    Quà Lưu Niệm
                </div>
                
                <div class="col-4 text-center">
            <?php
                     $result = mysqli_query($conn, "SELECT * FROM `order`");
                     $i=0;
                     $Doanhthu = 0;
                     while ($row = mysqli_fetch_assoc($result)){              
                     $i++;		
                     $Doanhthu = $Doanhthu + $row['total'];}
             ?>
                <h1><?php echo $Doanhthu; ?></h1>        
                Doanh Thu
            </div>
                
                <!-- <div class="col-4 text-center">
                
                        /*$result = mysqli_query($conn, "SELECT name, sum(soluong) as soluong FROM cart_order WHERE soluong = (SELECT Min(soluong) FROM cart_order)");
                        while ($row = mysqli_fetch_assoc($result)){              
                        $tensanpham = $row['tenmonhang'];
                        }
                    ?>*/
                    <h1>/*<php echo $tensanpham; ?>*/</h1>
                    Sản Phẩm Bán Ít nhất
                </div> -->
                <div class="clearfix"></div>
            </div>
        </div>
        
        </div>

     <!----------footer----------->
     <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>Đặt hàng: 1800 6936</h3>
                    <p style="text-align:left;color:white;font-size:14px;font-weight:100;">
                        Địa chỉ: Tầng 3-4 Hub Building 195/10E Điện Biên Phủ, P.15, Q.Bình Thạnh, TP.Hồ Chí Minh</p>
                    <div class="app-logo">
                        <!-- <img src="image/play-store.png">
                            <img src="image/app-store.png"> -->
                        <img src="image/1639628541.png">
                    </div>
                </div>
                <div class="footer-col-2">
                    <img src="image/coffehouse.png">
                </div>
                <div class="footer-col-3">
                    <h3>Giới thiệu</h3>
                    <ul>
                        <li>Về chúng tôi</li><br>
                        <li>Khuyễn mãi</li><br>
                        <li>Cửa hàng</li><br>
                        <li>Tuyển dụng</li>
                    </ul>
                </div>
                <div class="footer-col-4">
                    <br>
                    <h3>Liên hệ</h3>
                    <ul>
                        <li>Facebook</li><br>
                        <li>Twitter</li><br>
                        <li>Instagram</li><br>
                        <li>Discord</li><br>

                    </ul>
                </div>
            </div>
            <hr>

        </div>
    </div>

</body>
</html>