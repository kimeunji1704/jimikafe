<?php
$conn = mysqli_connect("localhost", "root", "", "jimikafe");

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

$date = $_POST['date'];
$idVoucher = $_POST['idVoucher'];
$total_price = $_POST['total_price'];
$productList = json_decode($_POST['productList'], true);


$queryAddCategory = "INSERT INTO ";

$conn->close();
echo 'True';
?>