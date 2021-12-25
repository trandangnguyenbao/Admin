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
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="index.html"><img src="image/logo_header.png" width="250px"></a>
            </div>
            <nav>
                <ul id="MenuItems">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="product.html">Products</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Contact</a></li>
                    <li><a href="account.html">Account</a></li>
                </ul>
            </nav>
            <a href="cart.html"><img src="image/cart.png" width="30px" height="30px"></a>
            <img src="photo/menu.png" class="menu-icon"
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
                        
                        <span onclick="login()">Đăng nhập</span>
                        <span onclick="register()">Đăng ký</span>
                        <hr id="Indicator">
                        <?php
                            include 'config.php';
                            $username = $_POST['username'];
                            $email =  $_POST['email'];
                            $password = md5($_POST['password']) ;
                            if (isset($_POST['register']) && $_POST['username'] !='' && $_POST['password'] != '' && $_POST['email'] != ''){
                                $sql = "INSERT INTO user (username,email,password) VALUES ('$username','$email','$password')";
                                mysqli_query($conn,$sql);
                                $my_var1 =' <p style="color: red;">Đăng kí thành công !</p>';
                                echo "<br>";
                                echo $my_var1;
                            }
                        ?>
                        <br>
                       
                    </div>
                    
                    
                    <form id="LoginForm" action="login_submit.php" method="post">
                        <input type="text" placeholder="Tên tài khoản" name="username">
                        <input type="password" placeholder="Mật khẩu" name="password">
                        <button type="submit" name="login" class="btn">Đăng nhập </button>
                        <a href="">Quên mật khẩu</a>
                    </form>

                    <form id="RegForm" action="register_submit.php" method="post">
                        <input type="text" placeholder="Tên tài khoản" name="username">
                        <input type="email" placeholder="Email" name="email">
                        <input type="password" placeholder="Mật khẩu" name="password">
                        <button type="submit" class="btn" name="register">Đăng ký</button>

                        
                       
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
        function register(){

            RegForm.style.transform = "translateX(0px)";
            LoginForm.style.transform = "translateX(0px)";
            Indicator.style.transform = "translateX(100px)";
        }

        function login(){

            RegForm.style.transform = "translateX(300px)";
            LoginForm.style.transform = "translateX(300px)";
            Indicator.style.transform = "translateX(0px)";
        }


    </script>
    

</body>
</html>

