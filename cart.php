<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng  </title>
    <link rel="stylesheet" href="account.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
        include 'config.php';
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array();
        }
        // else{
        //     echo "Không có vật phẩm nào trong giỏ hàng !!!";
        // }
        $error = false;
        $success = false;
       
        if (isset($_GET['action'])) {
            function update_cart($add = false) {
                foreach ($_POST['soluong'] as $id => $soluong) {
                    if ($soluong == 0) {
                        unset($_SESSION["cart"][$id]);
                    } else {
                        if ($add) {
                            $_SESSION["cart"][$id] += $soluong;
                        } else {
                            $_SESSION["cart"][$id] = $soluong;
                        }
                    }
                }
            }

            switch ($_GET['action']) {
                case "add":
                    update_cart(true);
                    header('Location: product.php');
                    break;
                case "delete":
                    if (isset($_GET['id'])) {
                        unset($_SESSION["cart"][$_GET['id']]);
                    }
                    header('Location: cart.php');
                    break;
                case "submit":
                    if (isset($_POST['update_click'])) { //Cập nhật số lượng sản phẩm
                        update_cart();
                        header('Location: cart.php');
                    } elseif ($_POST['order_click']) { //Đặt hàng sản phẩm
                        if (empty($_POST['name'])) {
                            $error = "Bạn chưa nhập tên của người nhận";
                        } elseif (empty($_POST['phone'])) {
                            $error = "Bạn chưa nhập số điện thoại người nhận";
                        } elseif (empty($_POST['address'])) {
                            $error = "Bạn chưa nhập địa chỉ người nhận";
                        } elseif (empty($_POST['soluong'])) {
                            $error = "Giỏ hàng rỗng";
                        }
                        
                        if ($error == false && !empty($_POST['soluong'])) { //Xử lý lưu giỏ hàng vào db
                            
                            $products = mysqli_query($conn, "SELECT * FROM `product` WHERE `id` IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
                            $total = 0;
                            $orderProducts = array();
                            while ($row = mysqli_fetch_array($products)) {
                                $orderProducts[] = $row;
                                $total += $row['price'] * $_SESSION["cart"][$row['id']];
                                $tongtien = $total + $total*0.1;
                            }
                            $insertOrder = mysqli_query($conn, "INSERT INTO `order` (`id`, `name`, `phone`, `address`, `note`, `total`) VALUES (NULL, '" . $_POST['name'] . "', '" . $_POST['phone'] . "', '" . $_POST['address'] . "', '" . $_POST['note'] . "', " . $tongtien . ");");
                            $orderID = $conn->insert_id;
                            $insertString = "";
                            $soluong = "";
                            foreach ($orderProducts as $key => $product) {
                                $insertString .= "(NULL, '" . $orderID . "', '" . $product['id'] . "', '" . $_POST['soluong'].[$product['id']] . "', '" . $product['price'] . "')";
                                if ($key != count($orderProducts) - 1) {
                                    $insertString .= ",";
                                }
                            }
                            $insertOrder = mysqli_query($conn, "INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `soluong`, `price`) VALUES " . $insertString . ";");
                            $success = "Đặt hàng thành công";
                            header('location: map.php');
                            // unset($_SESSION['cart']);
                            
                            
                        }
                        
                    }
                    break;
            }
        }
        if (!empty($_SESSION["cart"])) {
            $products = mysqli_query($conn, "SELECT * FROM `product` WHERE `id` IN (".implode(",", array_keys($_SESSION["cart"])).")");
        }
//        $result = mysqli_query($con, "SELECT * FROM `product` WHERE `id` = ".$_GET['id']);
//        $product = mysqli_fetch_assoc($result);
//        $imgLibrary = mysqli_query($con, "SELECT * FROM `image_library` WHERE `product_id` = ".$_GET['id']);
//        $product['images'] = mysqli_fetch_all($imgLibrary, MYSQLI_ASSOC);
        ?>
        <?php if (!empty($error)) { ?> 
                <div id="notify-msg">
                    <?= $error ?>. <a href="javascript:history.back()">Quay lại</a>
                </div>
            <?php } elseif (!empty($success)) { ?>
                <div id="notify-msg">
                    <?= $success ?>. <a href="index.php">Tiếp tục mua hàng</a>
                </div>
            <?php } else { ?>
                <a href="index.php">Trang chủ</a>
                <?php }?>






    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="index.php"><img src="image/logo_header.png" width="250px"></a>
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
            <img src="image/menu.png" class="menu-icon"
             onclick="menutoggle()">               
        </div>
    </div> 


<!----------- cart items details --------------->   
<div class="small-container cart-page">
    <form id="cart-form" action="cart.php?action=submit" method="POST">
        <table>
            <tr>
                <th>Sản Phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
            </tr>

            <!-- demo -->
            <?php 
                    $num = 1;
                    $products = mysqli_query($conn, "SELECT * FROM `product` WHERE `id` IN (".implode(",", array_keys($_SESSION["cart"])).")");
                      
                            while ($row = mysqli_fetch_array($products)) { ?>
                                <tr>
                                   <td>
                                       <div class="cart-info">
                                           <img src="image/<?php echo $row['image']; ?>">
                                           <div>
                                               <p><?=$row['name']?></p>
                                               <!-- <small class="product-price"><?=$row['price']?>*<?=$_SESSION["cart"][$row['id']]?></small> -->
                                               
                                               <small class="product-price"><?= number_format($row['price'], 0, ",", ".") ?> VNĐ</small>
                                               <br>
                                               <a href="cart.php?action=delete&id=<?= $row['id'] ?>" class="product-delete">Xóa</a>
                                           </div>
                                       </div>
                                   </td>
                                   <td class="product-soluong"><input style="text-align: center;" size="1" type="text" name="soluong[]" value="<?=$_SESSION["cart"][$row['id']]?>" name="soluong[<?=$row['id']?>]"></td>
                                   <td class="total-money"><?= number_format($row['price'] * $_SESSION["cart"][$row['id']], 0, ",", ".") ?> VNĐ</td>            
                               </tr>
                           <?php 
                           $num++;
                           }      
                        
                 
            ?>
           
        </table>
        
        <div class="total-price">
        <?php
            if (!empty($products)) {
                $total = 0;
                $num = 1;
        ?>

            <?php
                $products = mysqli_query($conn, "SELECT * FROM `product` WHERE `id` IN (".implode(",", array_keys($_SESSION["cart"])).")");
                while ($row = mysqli_fetch_array($products)) {
                    $total += $row['price'] * $_SESSION["cart"][$row['id']];
                    $num++; 
                    $thue = $total*0.1;
                }
            ?>

            <table>
                <tr>
                    <td>Tổng : </td>
                    <td><?= number_format($total, 0, ",", ".") ?> VNĐ</td>
                </tr>
                <tr>
                    <td>Thuế VAT ( 10 % ) : </td>
                    <td><?= number_format($thue, 0, ",", ".") ?> VNĐ</td>
                </tr>
                <tr>
                    <td>Tổng cộng : </td>
                    <td><?= number_format($total+$thue, 0, ",", ".") ?> VNĐ</td>
                </tr>
            </table>



            
        </div>
        
        <!-- chi tiết người mua -->

        <hr>
        <div><label>Người nhận: </label><input type="text" value="" name="name" /></div>
        <div><label>Điện thoại: </label><input type="text" value="" name="phone" /></div>
        <div><label>Địa chỉ: </label><input type="text" value="" name="address" /></div>
        <div><label>Ghi chú: </label><textarea name="note" cols="50" rows="7" ></textarea></div>
        <input type="submit" name="order_click" value="Đặt hàng" class="btn5"/>
        <!-- <a href="map.php">Đặt hàng</a> -->
        </form>
        <?php }?>


        <!--<a href="" class="nut">Đặt hàng</a>-->
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-2">
                <!-- <input type="submit" name="order_click" value="Đặt hàng" class="nut"/> -->
                <!-- <a href="cart.php" class="nut">Đặt hàng</a> -->
            </div>
        </div>
    </form>
    

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
                    <img src="image/the_coffee_house_2.jpg" >
                    
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
    

</body>
</html>