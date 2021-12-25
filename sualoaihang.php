<?php
    include 'config.php';
    $id_type = $_GET['id_type'];
    $result = mysqli_query($conn, "SELECT * FROM `product_type` where id_type = $id_type");
    $row = mysqli_fetch_assoc($result);

    if(isset($_POST['sbm'])){
        $id_type = $_POST['id_type'];
        $name = $_POST['name'];
        $sql = "UPDATE `product_type` SET id_type = '$id_type', name = '$name' WHERE id_type = $id_type";

        $query = mysqli_query($conn, $sql);
        header('location: quanliloaihang.php');
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
            <h2>SỬA LOẠI HÀNG</h2>
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>ID</label>
                    <input type="number" name="id_type" class="form-control" value="<?php echo $row['id_type']; ?>">
                </div>

                <div class="form-group">
                    <label>Tên Loại Hàng</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>">
                </div>

                <button name="sbm" class="btn btn-success">Sửa</button>
            </form>
        </div>
    </div>
</div>