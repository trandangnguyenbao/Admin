<?php
    include 'config.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);

    if(isset($_POST['sbm'])){
        $name = $_POST['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        if($_FILES['image']['name'] == ""){
            $image = $row['image'];
        }else{
            $image = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            move_uploaded_file($image_tmp, 'image/'.$image);
        }
        $price = $_POST['price'];
        $content = $_POST['content'];
        $sql = "UPDATE product SET name = '$name', image = '$image', price = $price, content ='$content' WHERE id = $id";

        $query = mysqli_query($conn, $sql);
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
            <h2>Sửa sản phẩm</h2>
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>">
                </div>

                <div class="form-group">
                    <label>Ảnh sản phẩm</label> <br>
                    <input type="file" name="image">
                </div>


                <div class="form-group">
                    <label>Giá sản phẩm</label>
                    <input type="number" name="price" class="form-control" value="<?php echo $row['price']; ?>">
                </div>

                <div class="form-group">
                    <label>Mô tả sản phẩm</label>
                    <input type="text" name="content" class="form-control" value="<?php echo $row['content']; ?>">
                </div>

                    <button name="sbm" class="btn btn-success">Sửa</button>
            </form>
        </div>
    </div>
</div>