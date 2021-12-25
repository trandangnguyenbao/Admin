<?php 
$username = "root"; // Khai báo username
$password = ""; // Khai báo password
$server = "localhost"; // Khai báo server
$dbname = "webbtl"; // Khai báo database
// Kết nối database tintuc
$connect = new mysqli($server, $username, $password, $dbname);
//Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
if ($connect->connect_error) {
     die("Không kết nối :" . $conn->connect_error);
    exit();
}//Khai báo giá trị ban đầu, nếu không có thì khi chưa submit câu lệnh insert sẽ báo lỗi
$name = "";
$id_type = "";
$hinhanh = "";
//Lấy giá trị POST từ form vừa submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["id_type"])) { $id_type = $_POST['id_type']; }  
    if(isset($_POST["name"])) { $name = $_POST['name']; } 
    $hinhanh = $_FILES['hinhanh']['name'];  
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
   
 //Code xử lý, insert dữ liệu vào table
    $sql = "INSERT INTO product_type(id_type,name,hinhanh)
            VALUES ('".$id_type."', '".$name."', '".$hinhanh."')";
             move_uploaded_file($hinhanh_tmp, 'images/'.$hinhanh);
    if ($connect->query($sql) === TRUE) {
        header('Location:quanliloaihang.php');
 } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
 }
}
//Đóng database
    $connect->close();
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        label{
            font-weight: 500;
        }

        .card input[type="search"]{
            margin-right: -6px;
        }

        .card input[type="search"]:focus, .card-header button:focus{
            box-shadow: none!important;   
        }

        .card-header button{
            width: 140px;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
    </style>
    <title>Document</title>
    
</head>
<div class="container-fluid">
    <div class="card">  
        <div class="card-header">
            <h2>Thêm Loại Hàng</h2>
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Mã Loại Hàng</label>
                    <input type="number" name="id_type" class="form-control">
                </div>
                <div class="form-group">
                    <label>Tên Loại Hàng</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="form-group">
                    <label>Ảnh Loại Hàng</label> <br>
                    <input type="file" name="hinhanh">
                </div>

                <!-- <div class="form-group">
                    <label>Số lượng sản phẩm</label>
                    <input type="number" name="quantity" class="form-control">
                </div> -->
                <button name="sbm" class="btn btn-success">Thêm mới</button>
            </form>
        </div>
    </div>
</div>