<?php
    session_start();
    if(!isset($_SESSION["user"]) ){
        header("location:account.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Coffee House</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!--link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
    <script src="main.js"></script>
</head>
<body>
    <div class="header">       
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
                        <li><a href="">Account</a></li>
                        <?php
                            include "config.php";
                            // $currentUser = $_SESSION['current_user'];
                            // $a = <?= $currentUser['username']?>
                            
                            <!-- echo "<li>"."Xin chào,".$a."</li>"; -->
                    
                        <!-- <li><b>Hello,<?= $currentUser['username'] ?></b> </li> -->
                        <li><a href="dangxuat.php">Logout</a> </li>
                        
                    </ul>
                </nav>
                <a href="cart.php"><img src="image/cart.png" width="30px" height="30px"></a>
                <img src="image/menu.png" class="menu-icon"
                 onclick="menutoggle()">
                
            </div>

        </div>
        <div class="row">
            <div class="col-2">
                <h1>THE COFFEE GỬI BẠN CÀ PHÊ VÀ RẤT NHIỀU ÂN CẦN, CHĂM CHÚT</h1>
                <h7>"Mỗi tách cà phê trên tay bạn đều là thành quả của một hành trình đáng tự hào.<br> Hãy cùng The Coffe House lắng nghe câu chuyện về hành trình từ nông trại đến ly cà phê"</h7>
                <a href="product.php" class="btn">Thưởng Thức Ngay &#8594;</a>
            </div>
            <div class="col-2">
                <img src="image/pixlr-bg-result.png" width="100%">

            </div>

        </div>
    </div>

<!---------- featured categories -------------->
    <div class="categories">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <img src="image/09032019-hinh-anh-ly-ca-phe-buoi-sang-dep-Serano-2-1.jpg">
                </div>
                <div class="col-3">
                    <img src="image/09032019-hinh-anh-ly-ca-phe-buoi-sang-dep-Serano-8.jpg">
                </div>
                <div class="col-3">
                    <img src="image/09032019-hinh-anh-ly-ca-phe-buoi-sang-dep-Serano-5.jpg">
                </div>
                
            </div>
        </div>
        
    </div>

<!---------- featured product -------------->  
        <div class="small-container">
            <button ><a href="http://localhost/btl/index.php?per_page=16&page=1">Nước uống nổi bậc</a></button>
            <button><a href="http://localhost/btl/index.php?per_page=16&page=2">Sản phẩm nổi bậc</a></button>
            <!-- <h2 class="title"><a href="http://localhost/btl/index.php?per_page=16&page=1"><b>NƯỚC UỐNG NỔI BẬT</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://localhost/btl/index.php?per_page=16&page=2"><b>SẢN PHẨM NỔI BẬT</b></a></h2> -->
            <!-- <h2 class="title"><b>SẢN PHẨM NỔI BẬT</b> </h2> -->
            <div class="row">

            <!-- demo -->
            <?php
                include 'config.php';
                $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:16;
                $current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
                $offset = ($current_page - 1) * $item_per_page;
                $products = mysqli_query($conn, "SELECT * FROM `product` ORDER BY `id` ASC  LIMIT " . $item_per_page . " OFFSET " . $offset);
                $totalRecords = mysqli_query($conn, "SELECT * FROM `product`");
                $totalRecords = $totalRecords->num_rows;
                $totalPages = ceil($totalRecords / $item_per_page);
                $sql = "SELECT * FROM user" ;
                $query = mysqli_query($conn, $sql);
                // $row = mysqli_fetch_array($query);
                // $products = mysqli_query($conn, "SELECT * FROM `product`");
                while ($row = mysqli_fetch_array($products)){
            ?>
                <div class="col-4">
                
                    <a href="product_details.php?id=<?= $row['id']?>"><img src="image/<?php echo $row['image']; ?>"></a>
                    <h4><b><a href="product_details.php?id=<?= $row['id']?>"><?= $row['name'] ?></a></b></h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <span class="product-price"><p><?= number_format($row['price'], 0, ",", ".") ?> </p></span>
                </div>


            <?php } ?>
                </div>


            <!-- demo -->


                <!-- <div class="col-4">
                    <a href="product-details.html"><img src="image/ht-latte-macchiato_fe7fa1571b974b48a5d750bd2e9e84eb_large.webp"></a>
                    <h4><b>HỒNG TRÀ LATTE MACCHIATO</b></h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <p>55,000 Đ</p>
                </div>

                <div class="col-4">
                    <img src="image/tra-dao-cam-sapng_58268b7877cd4209b8fc3fa1d4909511_large.webp">
                    <h4><b>TRÀ ĐÀO CAM XẢ</b></h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <i class="fa fa-star-o"></i>

                    </div>
                    <p>45,000 Đ</p>
                </div>
                <div class="col-4">
                    <img src="image/cafe-sua-da_9073dfe2143d428a91a370e79df77e49_large.webp">
                    <h4><b>CÀ PHÊ SỮA</b></h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>

                    </div>
                    <p>32,000 Đ</p>
                </div>
                <div class="col-4">
                    <img src="image/cam-pbt-da-xay_06ca55fce8e84389ab9d707f4bd753a7_large.webp">
                    <h4><b>PHÚC BỒN TỬ CAM ĐÁ XAY</b></h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>

                    </div>
                    <p>59,000 Đ</p>
                </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <img src="image/capu-nong_a2a47a422fa94e8194e9d4c4badba9d3_large.webp">
                        <h4><b>CAPPUCCINO</b></h4>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                        <p>50,000 Đ</p>
                    </div>
               
                    <div class="col-4">
                        <img src="image/caramel-macchiato-nong_667b90cf1e20493899e6727ae8c1b071_large (1).webp">
                        <h4><b>CARAMEL MACCHIATO</b></h4>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                        <p>32,000 Đ</p>
                    </div>

                    <div class="col-4">
                        <img src="image/latte-nong_ffcd92de11f74937bce4197823246d07_large.webp">
                        <h4><b>LATTE</b></h4>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                        <p>50,000 Đ</p>
                    </div>

                    <div class="col-4">
                        <img src="image/mocha-nong_66ebb6f03a874a4391fc80ad69264ea5_large.webp">
                        <h4><b>MOCHA</b></h4>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                        <p>50,000 Đ</p>
                    </div>

                </div>
            </div>
            <h2 class="title">BÁNH & SNACK</h2>
            <div class="row">
                <div class="col-4">
                    <img src="image/bbao-2-trung_883feca9c9974d11ad062a83e246808f_large.webp">
                    <h4><b>BÁNH BAO HAI TRỨNG CÚT</b></h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>

                    </div>
                    <p>25,000 Đ</p>
                </div>

                <div class="col-4">
                    <img src="image/bmi-cha-bong-pho-mai_a1cedd81aab643afad75dc01242e42ce_large.webp">
                    <h4><b>BÁNH MÌ CHÀ BÔNG PHÔ MAI</b></h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <i class="fa fa-star-o"></i>

                    </div>
                    <p>32,000 Đ</p>
                </div>
                <div class="col-4">
                    <img src="image/banh-mi-que_097b65c8e7c749398f1bdae4ae23d2ed_large.webp">
                    <h4><b>BÁNH MÌ QUE</b></h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>

                    </div>
                    <p>12,000 Đ</p>
                </div>
                <div class="col-4">
                    <img src="image/bong-lan-trung-muoi_538c729b19ce49b5aabaaca242171a51_large.webp">
                    <h4><b>BÔNG LAN TRỨNG MUỐI</b></h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>

                    </div>
                    <p>29,000 Đ</p>
                </div>
                <div class="col-4">
                    <img src="image/cam-say-deo_7205f0a0ca5a4520b9d68b13f7816062_large.webp">
                    <h4><b>CAM TƯƠI SẤY DẺO</b></h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <i class="fa fa-star-o"></i>

                    </div>
                    <p>35,000 Đ</p>
                </div>
                <div class="col-4">
                    <img src="image/com-chay-cha-bong_23e7817a73b94907806319bd2878b1e5_large.webp">
                    <h4><b>CƠM CHÁY CHÀ BÔNG</b></h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>

                    </div>
                    <p>35,000 Đ</p>
                </div>
                <div class="col-4">
                    <img src="image/ga-xe-la-chanh_2df170f8ae1f4d17b34481a79cec291a_large.webp">
                    <h4><b>GÀ XÉ LÁ CHANH</b></h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>

                    </div>
                    <p>25,000 Đ</p>
                </div>
                <div class="col-4">
                    <img src="image/thit-heo-xong-khoi_98acac131de04338b1f918d309aebf0c_large.webp">
                    <h4><b>HEO CHÁY XÔNG KHÓI</b></h4>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>

                    </div>
                    <p>35,000 Đ</p>
                </div>        
        </div> -->
<!----------- Offer ----------------->
<!----
    <div class="offer">        
        <div class="row">
            <div class="col-2">
                <img src="photo/exclusive.png" class="offer-img">
            </div>
            <div class="col-2">
                <p>Exclusively Available on RedStore</p>
                <h1>Smart Band 5</h1>
                <small>The Mi Smart Band 5 features a 39.9% larger(than Mi Band 4) 
                        AMOLED color full-touch display with adjustable brightness, so everything is clear as can be.</small><br>
                <a href="" class="btn">Buy Now &#8594; </a>
            </div>
        </div>       
    </div>
-->
<!--------Script----->
<?php
    include './pagination.php';
?>


<!-------- testimonial --------->
    <div class="testimonial">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>"Quán rộng, nhân viên đông phục vụ khá nhanh và nhiệt tình. Cảm thấy không gian đã ấm áp rồi gặp nhân viên đáng yêu như quán nữa thấy 1 ngày khởi đầu như vậy là tuyệt vời rồi."</p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>       
                    </div>
                    <img src="image/user-1.png" >
                    <h3>Bảo Trâm</h3>
                </div>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>"Quán được thiết kế với không gian hiện đại, với rất nhiều loại đồ uống và thực đơn. Điểm cộng cho quán là có đồ uống và thực đơn phong phú. Tuy nhiên, điểm trừ là quán hơi đông và ồn ào."</p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half"></i>
        
                    </div>
                    <img src="image/user-2.png" >
                    <h3>Văn Toàn</h3>
                </div>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>"Quán có rất nhiều Cơ sở trên khắp cả nước. Quán rộng, không gian thoáng mát, thỏa mái thích hợp cho mọi người. Tuy nhiên,giá của các đồ uống khá cao không phù hợp với một số khách hàng"</p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half"></i>
                        <i class="fa fa-star-o"></i>
        
                    </div>
                    <img src="image/user-3.png" >
                    <h3>Khánh Ngân</h3>
                </div>
            </div>
        </div>
    </div>
<!------------- brands -------------->
    <div class="brands">
        <div class="small-container">
            <div class="row">
                <div class="col-5">
                    <img src="image/logo-godrej.png" >
                </div>
                <div class="col-5">
                    <img src="image/logo-oppo.png" >
                </div>
                <div class="col-5">
                    <img src="image/logo-coca-cola.png" >
                </div>
                <div class="col-5">
                    <img src="image/logo-paypal.png" >
                </div>
                <div class="col-5">
                    <img src="image/logo-philips.png" >
                </div>
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
    
</body>
</html>



