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
            <h1 style="padding-bottom: 20px;">Danh Sách Đơn Hàng</h1>
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
                        <!-- <a href="admin.php?page_layout=them" class="btn btn-primary">
                            Thêm mới
                        </a> -->

                        <?php
                            if(isset($_POST['sbm']) && !empty($_POST['search'])){?>
                                <!-- <form method="POST" action="">
                                    <button name="all_prd" class='btn btn-success text-light'>Tất cả sản phẩm</button>
                                </form> -->
                        <?php } ?>
                    </div>
                        



                    <tr style="background-color: #737475;color: #fff; height: 60px;">
                        <th style="border: 1px solid #fff; text-align: center;">ID  </th>
                        <th style="border: 1px solid #fff; text-align: center;">Tên </th>
                        <th style="border: 1px solid #fff; text-align: center;">Số điện thoại</th>
                        <th style="border: 1px solid #fff; text-align: center;">Địa chỉ </th>
                        <th style="border: 1px solid #fff; text-align: center;">Ghi chú</th>
                        <th style="border: 1px solid #fff; text-align: center;">Tổng tiền</th>
                        <th style="border: 1px solid #fff; text-align: center;">Tình Trạng</th>
                        <th style="border: 1px solid #fff; text-align: center;" width="16%">Hành động</th>
                        <!-- <th>Số lượng sản phẩm</th> -->
                        <!-- <th>Mô tả</th> -->
                        <!-- <th width="12%">Hành động</th> -->
                    </tr>
                </thead>

                <tbody>
                <?php
                include 'config.php';
                // $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:8;
                // $current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
                // $offset = ($current_page - 1) * $item_per_page;
                // $products = mysqli_query($conn, "SELECT * FROM `product` ORDER BY `id` ASC  LIMIT " . $item_per_page . " OFFSET " . $offset);
                // $totalRecords = mysqli_query($conn, "SELECT * FROM `product`");
                // $totalRecords = $totalRecords->num_rows;
                // $totalPages = ceil($totalRecords / $item_per_page);
                $result=mysqli_query($conn, "SELECT * FROM `order`");
                $row = mysqli_fetch_assoc($result);
                $totalRecords = mysqli_query($conn, "SELECT * FROM `order`");
                $totalRecords = $totalRecords->num_rows;
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                $limit = 6;


                $total_page = ceil($totalRecords / $limit);

                if ($current_page > $total_page){
                    $current_page = $total_page;
                }
                else if ($current_page < 1){
                    $current_page = 1;
                }
                
                $start = ($current_page - 1) * $limit;
                $result = mysqli_query($conn, "SELECT * FROM `order` LIMIT $start, $limit");
                        $i = 1;
                        while ($row = mysqli_fetch_array($result)) {?>
                            <tr style="background-color: aliceblue;">
                                <td style="border: 1px solid #b4b2af; text-align: center;"><?php echo $i++; ?></th>
                                <td style="border: 1px solid #b4b2af; text-align: center;"><?php echo $row['name']; ?></td>
                                <td style="border: 1px solid #b4b2af;text-align: center;"><?php echo $row['phone']; ?></td>
                                <td style="border: 1px solid #b4b2af;text-align: center;"><?php echo $row['address']; ?></td>
                                <td style="border: 1px solid #b4b2af;"><?php echo $row['note']; ?></td>
                                <td style="border: 1px solid #b4b2af;text-align: center;"><?php echo number_format($row['total'], 0, ",", ".")." Đ";  ?></td>
                                <td style="border: 1px solid #b4b2af; text-align: center;"><?php echo $row['tinhtrang']; ?></td>
                                <td style="border: 1px solid #b4b2af; text-align: center;">
                                    <a class="btn btn-warning" href="suadonhang.php?id=<?php echo $row['id']; ?>">Sửa</a>

                                    <a onclick="return Del('<?php  echo $row['name'];?>')" class="btn btn-danger" href="xoadonhang.php?id=<?php echo $row['id']; ?>">Xóa</a>
                                </td>

                            </tr>
                        <?php } ?>
                </tbody>
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
<div class="pagination" style="padding: 15px; margin-left: 45%">
<?php
                //         if ($current_page > 1 && $total_page > 1){
                //     echo '<button style = "height:30px;width:30px; background-color:white; color:black;"><a  href= "product.php?page='.($current_page-1).'"><i class="fa fa-chevron-left"></i></a></button>';
                // }

                for ($i = 1; $i <= $total_page; $i++){

                    if ($i == $current_page){
                        echo '<button style = "margin-left:10px; height:30px;width:30px; background-color:#ff523b; color:#fff;font-weight: bolder;"><span >'.$i.'</span></button>';
                    }
                    else{
                        echo '<button style = "margin-left:10px;height:30px;width:30px; background-color:white; color:black; font-weight: bolder;"><a href = "quanlidonhang.php?page='.$i.'">'.$i.'</a></button>';
                    }
                }

                // if ($current_page < $total_page && $total_page > 1){
                //     echo '<button style = "height:30px;width:30px; background-color:white; color:black;font-weight: bolder;"><a href="product.php?page='.($current_page+1).'"><i class="fa fa-chevron-right"></i></a></button>';
                // }

                ?> 
</div>
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
<script>
    function Del(name){
        return confirm("Bạn có chắc chắn muốn xóa: " + name + " ?");
    }
</script>