<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập  </title>
    <link rel="stylesheet" href="account.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
        session_start();
        include 'config.php';
        $error = false;
        if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $result = mysqli_query($conn, "Select `id`,`username`,`email`,`password` from `user` WHERE (`username` ='" . $_POST['username'] . "' AND `password` = md5('" . $_POST['password'] . "'))");
            if (!$result) {
                $error = mysqli_error($conn);
            } else {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['current_user'] = $user;
            }
            mysqli_close($con);
            if ($error !== false || $result->num_rows == 0) {
                ?>
                <div id="login-notify" class="box-content">
                    <h1>Thông báo</h1>
                    <h4><?= !empty($error) ? $error : "Thông tin đăng nhập không chính xác" ?></h4>
                    <a href="./quanli.php">Quay lại</a>
                </div>
                <?php
                exit;
            }
            ?>
        <?php } ?>
        <?php if (empty($_SESSION['current_user'])) { ?>
            <div id="user_login" class="box-content">
                <!-- <h1>Đăng nhập tài khoản</h1>
                <form id="RegForm" action="./quanli.php" method="post">
                    <input type="text" placeholder="Tên tài khoản" name="username">
                    <input type="password" placeholder="Mật khẩu" name="password">
                    <button type="submit" name="login" class="btn">Đăng nhập </button>
                    <a href="">Quên mật khẩu</a>

                </form> -->


                <!-- <form action="./index.php" method="Post" autocomplete="off">
                    <label>Username</label></br>
                    <input type="text" name="username" value="" /><br/>
                    <label>Password</label></br>
                    <input type="password" name="password" value="" /></br>
                    <br>
                    <input type="submit" value="Đăng nhập" />
                </form> -->
            </div>
            <?php
        } else {
            $currentUser = $_SESSION['current_user'];
            ?>
            <div id="login-notify" class="box-content">
                Xin chào <?= $currentUser['username'] ?><br/>
                <a href="./product_listing.php">Quản lý sản phẩm</a><br/>
                <a href="./edit.php">Đổi mật khẩu</a><br/>
                <a href="./logout.php">Đăng xuất</a>
            </div>
        <?php } ?>



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
<!-----------Account page---------->
<div class="account-page">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img src="image/background.jpg" width="100%">
            </div>

            <div class="col-2">
                <div class="form-container">
                    <div class="form-btn">
                        <span onclick="register()">Đăng ký</span>
                        <span onclick="login()">Đăng nhập</span>
                        
                        <hr id="Indicator">
                    </div>    

                    

                    <form id="LoginForm" action="register_submit.php" method="post">
                        <input type="text" placeholder="Tên tài khoản" name="username">
                        <input type="email" placeholder="Email" name="email">
                        <input type="password" placeholder="Mật khẩu" name="password">
                        <button type="submit" class="btn" name="register">Đăng ký</button>   
                        
                    </form>

                    <form id="RegForm" action="quanli.php" method="post">
                        <input type="text" placeholder="Tên tài khoản" name="username">
                        <input type="password" placeholder="Mật khẩu" name="password">
                        <button type="submit" name="login" class="btn">Đăng nhập </button>
                        <a href="">Quên mật khẩu</a>

                    </form>
                    


                </div>
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

<!---------js for toggle form--------->
    <script>
    var LoginForm = document.getElementById("LoginForm");
    var RegForm = document.getElementById("RegForm");
    var Indicator = document.getElementById("Indicator");
       

        function login(){
            RegForm.style.transform = "translateX(0px)";
            LoginForm.style.transform = "translateX(0px)";
            Indicator.style.transform = "translateX(100px)";

            
        }
        function register(){
            RegForm.style.transform = "translateX(300px)";
            LoginForm.style.transform = "translateX(300px)";
            Indicator.style.transform = "translateX(0px)";
            
        }


    </script>
    

</body>
</html>