<?php
    include 'config.php';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM `order` where id = $id");
    $row = mysqli_fetch_assoc($result);

    if(isset($_POST['sbm'])){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $note = $_POST['note'];
        $tinhtrang = $_POST['tinhtrang'];
        $sql = "UPDATE `order` SET name = '$name', phone = '$phone', address = '$address', note ='$note', tinhtrang = '$tinhtrang' WHERE id = $id";

        $query = mysqli_query($conn, $sql);
        header('location: quanlidonhang.php');
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
            <h2>SỬA ĐƠN ĐẶT HÀNG</h2>
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>">
                </div>

                <div class="form-group">
                    <label>Số Điện Thoại</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>">
                </div>


                <div class="form-group">
                    <label>Địa Chỉ</label>
                    <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>">
                </div>

                <div class="form-group">
                    <label>Ghi Chú</label>
                    <input type="text" name="note" class="form-control" value="<?php echo $row['note']; ?>">
                </div>

                <div class="form-group">
                    <label>Tình Trạng</label>
                    <select name="tinhtrang" id="">
                        <option value="Đang Giao Hàng">Đang Giao Hàng</option>
                        <option value="Đã Giao Hàng">Đã Giao Hàng</option>
                    </select>
                </div>

                    <button name="sbm" class="btn btn-success">Sửa</button>
            </form>
        </div>
    </div>
</div>