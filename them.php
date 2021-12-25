<?php
    include 'config.php';
    // $sql_brand = "SELECT * FROM brands";
    // $query_brand = mysqli_query($connect, $sql_brand);

    if(isset($_POST['sbm'])){
        $name = $_POST['name'];
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $price = $_POST['price'];
        $content = $_POST['content'];
        $sql = "INSERT INTO product (name, image, price, content) VALUES('$name', '$image', $price, '$content')";
        $query = mysqli_query($conn, $sql);
        move_uploaded_file($image_tmp, 'image/'.$image);
        header('location: admin.php');
    }
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
            <h2>Thêm sản phẩm</h2>
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="form-group">
                    <label>Ảnh sản phẩm</label> <br>
                    <input type="file" name="image">
                </div>

                <!-- <div class="form-group">
                    <label>Số lượng sản phẩm</label>
                    <input type="number" name="quantity" class="form-control">
                </div> -->

                <div class="form-group">
                    <label>Giá sản phẩm</label>
                    <input type="number" name="price" class="form-control">
                </div>

                <div class="form-group">
                    <label>Mô tả sản phẩm</label>
                    <input type="text" name="content" class="form-control">
                </div>
                <button name="sbm" class="btn btn-success">Thêm mới</button>
            </form>
        </div>
    </div>
</div>