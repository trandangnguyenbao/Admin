<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm - Coffee House  </title>
    <link rel="stylesheet" href="account.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
        include 'config.php';
        //  $id[] = $_GET['id'];
        $sql = "SELECT * FROM product WHERE id =".$_GET['id'] ;
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        $imgLibrary = mysqli_query($conn, "SELECT * FROM product WHERE id = ".$_GET['id']);
        $row['images'] = mysqli_fetch_all($imgLibrary, MYSQLI_ASSOC);
        //  $result = mysqli_query($conn, "SELECT * FROM `product` WHERE `id` = ".$_GET['id']);
        //  $product = mysqli_fetch_assoc($result);
        //  $imgLibrary = mysqli_query($conn, "SELECT image FROM `product` WHERE `id` = ".$_GET['id']);
        //  $product['images'] = mysqli_fetch_all($imgLibrary, MYSQLI_ASSOC);

    ?>



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
                </ul>
            </nav>
            <a href="cart.php"><img src="image/cart.png" width="30px" height="30px"></a>
            <img src="photo/menu.png" class="menu-icon"
             onclick="menutoggle()">               
        </div>
    </div> 

<!---------- single product details------------>
    <div class="small-container single-product">
        <div class="row">
            <?php
                // while ($row = mysqli_fetch_array($product)){

                // }
             ?>
    <div class="col-2" id="product-detail">
        <div id="product-img">
            <img src="image/<?php echo $row['image']; ?>" width="100%">
        </div>
        <!-- <img src="image/ht-latte-macchiato_fe7fa1571b974b48a5d750bd2e9e84eb_large.webp" width="100%" id="ProductImg"> -->
        <div class="small-img-row">
        <div class="small-img-col">
       
        </div>
        </div>                
            </div>
            <div class="col-2">
                <h1><a href="product-details.php?id="><?= $row['name']?></a></h1>
                <span class="product-price"> <?= number_format($row['price'],0,",",".")?> VNĐ </span>
                <!-- <h4>55,000 Đ</h4> -->
                <select>
                    <option>Select Size</option>
                    <option>L</option>
                    <option>M</option>
                    <option>S</option>
                </select>
                <!-- <input type="number" value="1"> -->
                <form action="cart.php?action=add" id="add-to-cart-form" method="POST">
                    <input type="number" value="1" name="soluong[<?=$row['id']?>]" size="2">
                    <input type="submit" class="btn" value="Thêm vào giỏ hàng">
                    <!-- <label class="add-to-cart"><a href="product.html" class="btn">Thêm vào giỏ hàng</a></label> -->
                </form>
                
                <h3>Chi tiết sản phẩm <i class="fa fa-indent"></i></h3>
                <br>
                <p><?=$row['content'] ?></p>
                <!-- <p>Đúng gu tinh tế, healthy với vị trà nhẹ nhàng, quyện cùng sữa tươi và macchiato thơm béo. 
                   Sự kết hợp hoàn hảo bởi hồng trà dịu nhẹ và sữa tươi, nhấn nhá thêm lớp macchiato trứ danh của Nhà, cho bạn từng ngụm thưởng thức tinh tế, dễ chịu.</p> -->
            </div>
        </div>
    </div>



<!----------title -------------->
    <div class="small-container">
        <div class="row row-2">
            <h2>CÓ THỂ BẠN THÍCH</h2>
            <a href="product.php"><p>Xem thêm</p></a>
        </div>
    </div>

<!---------product---------->
    <div class="small-container">         
    </div>
            <div class="row">
                    <div class="col-4">
                        <img src="image/matcha-da-xay_7f214144321f43ff81f78f67f05a0b22_large.webp">
                        <h4>MATCHA ĐÁ XAY</h4>
                        <!--div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <i class="fa fa-star-o"></i>   
                        </div-->
                        <p>59,000 Đ</p>
                    </div>
                    <div class="col-4">
                        <img src="image/mocha-nong_66ebb6f03a874a4391fc80ad69264ea5_large.webp">
                        <h4>MOCHA</h4>
                        <!--div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>  
                        </div-->
                        <p>50,000 Đ</p>
                    </div>
                    <div class="col-4">
                        <img src="image/cold-brew-sua-tuoi_b4424df759b945a0a3c1d688300180cb_large.webp">
                        <h4>COLD BREW SỮA TƯƠI</h4>
                        <!--div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
    
                        </div-->
                        <p>45,000 Đ</p>
                    </div>
                    <div class="col-4">
                        <img src="image/tra-dao-cam-sapng_58268b7877cd4209b8fc3fa1d4909511_large.webp">
                        <h4>TRÀ ĐÀO CAM XẢ</h4>
                        <!--div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
    
                        </div-->
                        <p>45,000 Đ</p>
                    </div>        
            </div>
            
            
        </div>
<!----------footer----------->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>Download Our App</h3>
                    <p>Download App for Android and IOS mobile phone.</p>
                    <div class="app-logo">
                        <img src="image/play-store.png" >
                        <img src="image/app-store.png" >
                    </div>
                </div>
                <div class="footer-col-2">
                    <img src="image/coffehouse.png" >
                    
                </div>
                <div class="footer-col-3">
                    <h3>Useful Links</h3>
                    <ul>
                        <li>Coupons</li>
                        <li>Blog Post</li>
                        <li>Return Policy</li>
                        <li>Join Affiliate</li>
                    </ul>
                </div>
                <div class="footer-col-4">
                    <h3>Follow us</h3>
                    <ul>
                        <li>Facebook</li>
                        <li>Twitter</li>
                        <li>Instagram</li>
                        <li>Youtube</li>
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

<!---------js for product gallery--------->
    <script>
        var ProductImg = document.getElementById("ProductImg");
        var SmallImg = document.getElementsByClassName("small-img");
            SmallImg[0].onclick = function()
                {
                    ProductImg.src = SmallImg[0].src;
                }
            SmallImg[1].onclick = function()
                {
                 ProductImg.src = SmallImg[1].src;
                }
            SmallImg[2].onclick = function()
                {
                 ProductImg.src = SmallImg[2].src;
                }
            SmallImg[3].onclick = function()
                {
                 ProductImg.src = SmallImg[3].src;
                }

    </script>


</body>
</html>