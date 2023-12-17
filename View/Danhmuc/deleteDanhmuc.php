<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Xóa danh mục</title>
    </head>
    <body>
        <?php
        $MaDM=$_GET['id'];
        $conn=mysqli_connect("localhost","root","", "jimikafe");
        if($conn==false){
            die("Connect fail:" .mysqli_connect_error($con));
        }
        else{
            $query = "DELETE FROM categories where id='".$MaDM."'";
            $result = mysqli_query($conn,$query);
            if($result>0){
                echo "<script type='text/javascript'>",
                "alert('Xóa dữ liệu thành công');",
                "window.location.href='indexDanhmuc.php'",
                "</script>";
            }
            else{
                echo "Không có dữ liệu";
            }
        }
        ?>
    </body>
</html>