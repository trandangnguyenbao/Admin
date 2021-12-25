<?php
			session_start();
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
			}
			$id = "";
			$name = "";
			$phone = 0;
			$address = "";
			$note= "";
			$total= "";
			$tinhtrang= "";
			
			$sql1 = "SELECT id,name,phone FROM cart_order";
				$ket_qua =  $connect->query($sql1);
				$row = $ket_qua->fetch_array(MYSQLI_ASSOC);
				$id_user = $row['id_user'];
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if(isset($_POST["diachi"])) { $diachi = $_POST['diachi']; }
                if(isset($_POST["thanhtien"])) { $tongtien = $_POST['thanhtien']; }
				$sql2 = "INSERT INTO user_donhang(id_user,tongtien,diachi)
				values ('$id_user','$tongtien','$diachi')";
				if ($connect->query($sql2) === TRUE) {
					header("location:index.php");
					if (isset($_SESSION['order'])){
						echo $_SESSION['order'];
						unset($_SESSION['order']);
					}
			} else {
					echo "Error: " . $sql2 . "<br>" . $connect->error;
			}
			$connect->close();
			}
			?>