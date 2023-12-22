<?php
//Khai báo sử dụng session
session_start();
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
//Xử lý đăng nhập
if (isset($_POST['dangnhap']))
{
//Kết nối tới database
include('connect.php');
  
//Lấy dữ liệu nhập vào
$username = addslashes($_POST['username']);
$password = addslashes($_POST['password']);
  
//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
if (!$username || !$password) {
echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}else{
    $query = "SELECT account_type, username, password FROM accounts WHERE username= '$username'";
    $result = mysqli_query($connect, $query) or die( mysqli_error($connect));
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
        $username = $row['username'];
        $account_type = $row['account_type'];
            if ($password != $row['password']) {
                echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
                exit;
            }
            else {
                $_SESSION['username'] = $username;
                if($account_type =='1'){
                    header('Location: ..\admin\admin.php');  
                    die();
                    $connect->close();
                }
                else{
                    header('Location: ..\admin\adminNV.php');
                    die();
                    $connect->close();}
                }             
        }
    else{
        echo "Tên đăng nhập không đúng. Vui lòng nhập lại!";
    }    
}
}
?>