<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Xóa tài khoản</title>
    </head>
    <body>
        <?php
        $username=$_GET['username'];
        $conn=mysqli_connect("localhost","root","", "jimikafe");
        if($conn==false){
            die("Connect fail:" .mysqli_connect_error($con));
        }
        else{
            $query = "DELETE FROM accounts where username='".$username."'";
            $result = mysqli_query($conn,$query);
            if($result>0){
                echo "<script type='text/javascript'>",
                "alert('Xóa dữ liệu thành công');",
                "window.location.href='taikhoan.php'",
                "</script>";
            }
            else{
                echo "Không có dữ liệu";
            }
        }
        ?>
    </body>
</html>