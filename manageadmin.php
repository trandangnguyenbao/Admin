<div class="main-content">
    <div class="wrapper">
    <div class="nav" style="display: inline-flex;">
        <h1>Manage Admin</h1>
        <a href="add-admin.php" class="btn-primary "style="margin-left: 867px;">Thêm</a>
    </div>
        <br><br>    
        <table class="tbl-full">
                <tr>
                    <th>ID</th>
                    <th>Họ Tên</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <?php
                    $username = "root"; // Khai báo username
                    $password = ""; // Khai báo password
                    $server = "localhost"; // Khai báo server
                    $dbname = "user"; // Khai báo database
                    // Kết nối database tintuc
                    $connect = mysqli_connect($server, $username, $password, $dbname);
                    
                    //Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
                    if (!$connect) {
                        die("Không kết nối :" . mysqli_connect_error());
                        exit();
                    }
                    $sql = "select * from admin";
                    $query = mysqli_query($connect,$sql);
                    if($query==TRUE){
                        $num_rows = mysqli_num_rows($query);
                        $i = 0;
                        if($num_rows > 0){
                            while($rows = mysqli_fetch_assoc($query)){
                                $i++;
                               ?>
                               <tr>
                                    <td><?php echo $i ?></td>

                                    <td><?php echo $rows['fname'] ?></td>
                                    <td><?php echo $rows['lname'] ?></td>
                                    <td><?php echo $rows['Email'] ?></td>
                                    <td class="action">
                                    <a href="../admin/update-admin.php?id_admin=<?php echo $rows['id_admin']?>" class="btn-secondary">Sửa</a>
                                    <a href="../admin/delete-admin.php?id_admin=<?php echo $rows['id_admin']?>" class="btn-danger">Xoá</a>
                                </td>
                                </tr>
                                
                               <?php
                            }
                        }
                    }
                ?>
            </table>
    </div>
</div>