<?php
// Bắt đầu hoặc khôi phục session
session_start();

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['username'])) {
    // Hủy bỏ tất cả các biến session
    session_unset();

    // Hủy bỏ session
    session_destroy();

    // Điều hướng người dùng đến trang đăng nhập hoặc trang chính
    header('Location: ../Login/login.php');
    exit();
} else {
    // Nếu người dùng chưa đăng nhập, bạn có thể thực hiện các xử lý khác ở đây
    echo "Người dùng chưa đăng nhập.";
}
?>
