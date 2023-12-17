<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Xóa kho</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
$MaMH=$_GET['MaMH'];
        $conn=mysqli_connect("localhost","root","", "Webshops");
        if($conn==false){
            die("Connect fail:" .mysqli_connect_error($conn));
        }
        else{
            $query = "DELETE FROM kho where MaMH='".$MaMH."'";
            $result = mysqli_query($conn,$query);
            if($result>0){
                echo "<script type='text/javascript'>",
                "alert('Xóa dữ liệu thành công');",
                "window.location.href='khoo.php'",
                "</script>";
            }
            else{
                echo "Data is empty";
            }
        }
?>
<a href="khoo.php">Quay lại</a>
</body>
</html>