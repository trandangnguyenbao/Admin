<?php
    include 'config.php';
    $sql = "SELECT * FROM user" ;
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products - The Coffee House  </title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>

    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="index.php"><img src="image/logo_header.png" width="300px"></a>
            </div>
            <nav>
                <ul id="MenuItems">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="product.php">Products</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Contact</a></li>
                    <li><a href="account.php">Account</a></li>
                    <!--<li><input type="text" placeholder="Tìm kiếm..."/></li>-->
                    <li>
                        <!-- <div class="search-container">
                            <form action="/action_page.php">
                                <input type="text" placeholder="Tìm kiếm.." name="search">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div> -->
                    </li>
                    <!-- <li><b>Hello,<?= $row['username'] ?></b> </li> -->
                </ul>
            </nav>
            <a href="cart.php"><img src="image/cart.png" width="30px" height="30px"></a>
            <img src="image/menu.png" class="menu-icon"
             onclick="menutoggle()">               
        </div>
    </div> 

        <div class="small-container">

            <div class="row row-2">
                <h2>TẤT CẢ SẢN PHẨM</h2>
                <!---Sắp xếp-->
                <select>
                    <option>Lựa chọn sắp xếp</option>
                    <option>Sắp xếp theo giá </option>
                    <option>Sắp xếp theo độ phổ biến</option>
                    <option>Sắp xếp theo đánh giá</option>

                </select>
            </div>

            <div class="row">
            <?php
                include 'config.php';
                // $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:8;
                // $current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
                // $offset = ($current_page - 1) * $item_per_page;
                // $products = mysqli_query($conn, "SELECT * FROM `product` ORDER BY `id` ASC  LIMIT " . $item_per_page . " OFFSET " . $offset);
                // $totalRecords = mysqli_query($conn, "SELECT * FROM `product`");
                // $totalRecords = $totalRecords->num_rows;
                // $totalPages = ceil($totalRecords / $item_per_page);
                $result=mysqli_query($conn, "SELECT * FROM `product`");
                $row = mysqli_fetch_assoc($result);
                $totalRecords = mysqli_query($conn, "SELECT * FROM `product`");
                $totalRecords = $totalRecords->num_rows;
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                $limit = 8;


                $total_page = ceil($totalRecords / $limit);

                if ($current_page > $total_page){
                    $current_page = $total_page;
                }
                else if ($current_page < 1){
                    $current_page = 1;
                }
                
                $start = ($current_page - 1) * $limit;
                $result = mysqli_query($conn, "SELECT * FROM product LIMIT $start, $limit");
                // $row = mysqli_fetch_array($query);
                // $products = mysqli_query($conn, "SELECT * FROM `product`");
                while ($row = mysqli_fetch_array($result)){
            ?>
                <div class="col-4">
                
                    <a href="product_details.php?id=<?= $row['id']?>"><img src="image/<?php echo $row['image']; ?>"></a>
                    <h4><b><a href="product_details.php?id=<?= $row['id']?>"><?= $row['name'] ?></a></b></h4>
                    <!-- <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div> -->
                    <span class="product-price"><p><?= number_format($row['price'], 0, ",", ".") ?> </p></span>
                    <!-- <form action="cart.php?action=add" id="add-to-cart-form" method="POST">
                        <button type="submit" class="btn" value="1" name="quantity[<?=$row['id']?>]" style="margin-left: 85px;">Thêm vào giỏ hàng</button>
                    </form> -->
                    
                </div>


            <?php } ?>
            </div>

            <?php
                include './pagination.php';
            ?>
            
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
<!---------js for menu--------->
    <script>
        var MenuItems = document.getElementById("MenuItems");

            MenuItems.style.maxHeight = "0px";

        function menutoggle(){
            if(MenuItems.style.maxHeight == "0px")
                {
                    MenuItems.style.maxHeight = "200px";
                }
            else
                {
                    MenuItems.style.maxHeight = "0px";
                }
               
}
    </script>
    
</body>
</html>