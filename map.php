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
                foreach ($_POST['quantity'] as $id => $quantity) {
                    if ($quantity == 0) {
                        unset($_SESSION["cart"][$id]);
                    } else {
                        if ($add) {
                            $_SESSION["cart"][$id] += $quantity;
                        } else {
                            $_SESSION["cart"][$id] = $quantity;
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
                        } elseif (empty($_POST['quantity'])) {
                            $error = "Giỏ hàng rỗng";
                        }
                        
                        if ($error == false && !empty($_POST['quantity'])) { //Xử lý lưu giỏ hàng vào db
                            
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
                            foreach ($orderProducts as $key => $product) {
                                $insertString .= "(NULL, '" . $orderID . "', '" . $product['id'] . "', '" . $_POST['quantity'][$product['id']] . "', '" . $product['price'] . "')";
                                if ($key != count($orderProducts) - 1) {
                                    $insertString .= ",";
                                }
                            }
                            $insertOrder = mysqli_query($conn, "INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES " . $insertString . ";");
                            $success = "Đặt hàng thành công";
                            unset($_SESSION['cart']);
                            header('location: index.php');
                            
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
                <!-- <a href="index.php">Trang chủ</a> -->
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

<!-- test -->
<iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d26175.416376737452!2d106.67994179707222!3d10.796396618838056
        !2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x317528a391cd4f8f%3A0x29948ead
        14575d6e!2zVGhlIENvZmZlZSBIb3VzZSAtIEQyLCAxNTctMTU3QSwgTmd1eeG7hW4gR2lhIFRyw60sIFBoxrDhu
        51uZyAyNSwgQsOsbmggVGjhuqFuaCwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oIDcwMDAwMCwgVmnhu4d0IE5h
        bQ!3m2!1d10.8053277!2d106.7157371!4m5!1s0x3175295a2dd8a8d3%3A0x1f15baf24f3bd9a0!2zNjc4IFRyx
        rDhu51uZyBDaGluaCwgUGjGsOG7nW5nIDE1LCBUw6JuIELDrG5oLCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmg!3m2
        !1d10.806023399999999!2d106.6354104!5e0!3m2!1svi!2s!4v1622114821865!5m2!1svi!2s" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

<!----------- cart items details --------------->   
<div class="small-container cart-page">
    <h1>Chi tiết đơn hàng : </h1><br>
    <h4>Mã hóa đơn: BNT2001 <br> </h4>
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
                                   <td class="product-quantity"><input style="text-align: center;" size="1" type="text" name="quantity[]" value="<?=$_SESSION["cart"][$row['id']]?>" name="quantity[<?=$row['id']?>]"></td>
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
        <!-- <div><label>Người nhận: </label><input type="text" value="" name="name" /></div>
        <div><label>Điện thoại: </label><input type="text" value="" name="phone" /></div>
        <div><label>Địa chỉ: </label><input type="text" value="" name="address" /></div>
        <div><label>Ghi chú: </label><textarea name="note" cols="50" rows="7" ></textarea></div>
        <input type="submit" name="order_click" value="Đặt hàng" class="btn5"/> -->
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