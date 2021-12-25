<?php
    include 'config.php';
    if(isset($_POST['sbm']) && !empty($_POST['search'])){
        $search = $_POST['search'];
        $sql = "SELECT * FROM product_type WHERE name LIKE '%$search%'";
        $query = mysqli_query($conn, $sql);
        $total_prd = mysqli_num_rows($query);
    }else{
        $sql = "SELECT * FROM product_type";
        $query = mysqli_query($conn, $sql);
    }

    if(isset($_POST['all_prd'])){
        unset($_POST['sbm']);
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

<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
        <h1>Danh sách sản phẩm</h1>
        </div>

        <div class="card-body">
            <?php
                if(isset($total_prd)){
                    if($total_prd !==0){
                        echo "<p class='text-success'>Tìm thấy $total_prd sản phẩm</p>";
                    }else{
                        echo "<p class='text-danger'> Không tìm thấy sản phẩm nào! </p>";
                    }
                }
            ?>
            <table class="table bordered">
                <thead class="thead-dark">
                    <!-- thêm mới sản phẩm -->
                    <div class="card-footer d-flex justify-content-between">
                        <a href="themloaihang.php" class="btn__add" style="margin-top: 32px; height: 34px; width: 120px; background-color: #f18a1c; border-radius: 4px; text-align: center;padding-top: 8px; color: #fff;">
                            Thêm mới
                        </a>
                        <div class="search">
                        <form method="POST" class="d-flex" action="">
                            <input name="search" type="search" class="form-control" style="border-radius: 3px; border-color: #000;height: 34px; width: 300px; position: relative;">
                            <button name="sbm" class="btn btn-success" style="border-radius: 3px; border-color: #f18a1c; border: unset;">Tìm kiếm</button>
                        </form>
                        </div>
                        <?php
                            if(isset($_POST['sbm']) && !empty($_POST['search'])){?>
                                <form method="POST" action="">
                                    <button name="all_prd" class='btn btn-success text-light'>Tất cả loại hàng</button>
                                </form>
                        <?php } ?>
                    </div>
                        



                    <tr style="background-color: #737475;color: #fff; height: 60px;">
                        <th style="border: 1px solid #fff; text-align: center;width:2%">ID  </th>
                        
                        <th style="border: 1px solid #fff; text-align: center; width:34%">Tên Loại Hàng</th>
                        <th style="border: 1px solid #fff; text-align: center;width:23.5%">Mã Loại Hàng  </th>
                        <th style="border: 1px solid #fff; text-align: center;width:25%">Hình Ảnh</th>
                        <th style="border: 1px solid #fff; text-align: center;width:16%" >Hành động</th>
                    </tr>
                </thead>
                <?php
                $i = 1;
                include 'config.php';
                $sql = "SELECT * FROM `product_type`";
                $query = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($query)) {?>
                        <tr style="background-color: aliceblue;">
                                <td style="border: 1px solid #b4b2af; text-align: center;"><?php echo $i++; ?></th> 
                                <td style="border: 1px solid #b4b2af; text-align: center;"><?php echo $row['name']; ?></td>
                                <td style="border: 1px solid #b4b2af; text-align: center;"><?php echo $row['id_type']; ?></th>
                                <td style="border: 1px solid #b4b2af; text-align: center;">
                                    <img src="image/<?php echo $row['hinhanh']; ?>" width="150">
                                
                                </td>
                                <td style="border: 1px solid #b4b2af;text-align: center;">
                                <a class="btn btn-warning" href="sualoaihang.php?id_type=<?php echo $row['id_type']; ?>">Sửa</a>

                                <a onclick="return Del('<?php  echo $row['name'];?>')" class="btn btn-danger" href="xoaloaihang.php?id_type=<?php echo $row['id_type']; ?>">Xóa</a>
                                </td>
                            </tr>
                        <?php } ?>

            </table>
        </div>

        <!-- <div class="card-footer d-flex justify-content-between">
            <a href="admin.php?page_layout=them" class="btn btn-primary">
                Thêm mới
            </a>
            
            <?php
                if(isset($_POST['sbm']) && !empty($_POST['search'])){?>
                    <form method="POST" action="">
                        <button name="all_prd" class='btn btn-success text-light'>Tất cả sản phẩm</button>
                    </form>
                <?php } ?>
        </div> -->
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
<script>
    function Del(name){
        return confirm("Bạn có chắc chắn muốn xóa: " + name + " ?");
    }
</script>