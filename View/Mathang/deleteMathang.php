<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Xóa sản phẩm</title>
    </head>
    <body>
        <?php
        $í=$_GET['id'];
        $conn=mysqli_connect("localhost","root","", "jimikafe");
        if($conn==false){
            die("Connect fail:" .mysqli_connect_error($con));
        }
        else{
            $query = "DELETE FROM product where id='".$id."'";
            $result = mysqli_query($conn,$query);
            if($result>0){
                echo "<script type='text/javascript'>",
                "alert('Xóa dữ liệu thành công');",
                "window.location.href='indexMathang.php'",
                "</script>";
            }
            else{
                echo "Data is empty";
            }
        }
        ?>
    </body>
</html>