<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sửa kho</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

     <style type="text/css">
        td{
            padding-right: 20px;
            padding-top: 15px;
            padding-bottom: 15px;
        }
    a{
    background: red;
    color: white;
    width: 25px;
    height: 60px;
    padding: 1px 13px 4px;
    border: 1.5px solid #28a745;
    }
    input{
        width: 430px;
    }
    </style>
</head>
<body>
    <div id="main">
<?php
$MaMH = $_GET['MaMH'];
$GiaNhap = "";
$NgayNhap = "";
$SoLuong = "";
$Nhacungcap = "";
$conn = mysqli_connect("localhost","root","", "webshops");
    if($conn == false){
        die("Connect fail: ". mysqli_connect_error($conn));
    }
    else{
        $query="SELECT * FROM kho where MaMH='".$MaMH."'";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                $MaMH=$row["MaMH"];
                $SoLuong = $row["Soluong"];
                $MaNCC = $row["MaNCC"];
                $NgayNhap=$row["NgayNhap"];
                $GiaNhap=$row["GiaNhap"];
            }
        }
        else{
            echo "Data is empty";
        }
    }
?>

<div id="header" style="background-color: #CCFFFF; height: 70px;">
     <h2 style="color: #333; text-align: center; padding: 15px 300px 17px 300px;">EDIT DỮ LIỆU</h2>
</div>
<div style="padding: 70px 31% 16.5%; margin: 0 -30px; width: 100%;">

<form method="post">
     <table>
        <tr>
        <td>Mã mặt hàng</td>
                <td>
                    <input type="text" name="txtMMH" value="<?php echo $MaMH ?>" readonly="true">
                </td>
            </tr>

             <tr>
            <td>Số lượng</td>
                <td>
                    <input type="text" name="txtSL" value="<?php echo isset($_POST['txtSL']) ? $_POST['txtSL']:$SoLuong ?>" >
                </td>
            </tr>

              <tr>
            <td>Mã nhà cung cấp</td>
                <td>
                    <input type="text" name="txtMNCC" value="<?php echo isset($_POST['txtMNCC']) ? $_POST['txtMNCC']:$MaNCC ?>" >
                </td>
            </tr>

            <tr>
            <td>Ngày nhập</td>
                <td>
                    <input type="text" name="txtDate" value="<?php echo isset($_POST['txtDate']) ? $_POST['txtDate']:$NgayNhap ?>" >
                </td>
            </tr>

            <tr>
            <td>Giá nhập</td>
                <td>
                    <input type="text" name="txtGN" value="<?php echo isset($_POST['txtGN']) ? $_POST['txtGN']:$GiaNhap ?>" >
                </td>
            </tr>


            <tr>
                <td></td>
                <td>
                    <button type="submit" id="btnSave" style=" color: white; background-color: red;" name="btnSave">Ghi dữ liệu</button>
                    <a href="khoo.php">Quay lại</a>
                </td>
            </tr>
     </table>
</form>

<?php
function Insert(){
        //Step 1: Connect db
        $conn=mysqli_connect("localhost","root","","Webshops");
        if($conn==false){
            die("Connect fail:". mysqli_connect_error($conn));
        }
        else{
           $MaMH = $_POST['txtMMH'];
                $GiaNhap = $_POST['txtGN'];
                $NgayNhap = $_POST['txtDate'];
                $SoLuong = $_POST["txtSL"];                   
                $MaNCC = $_POST["txtMNCC"];  

            //Step 2
            $query = "UPDATE kho SET Soluong='".$SoLuong."', MaNCC='".$MaNCC."', NgayNhap ='".$NgayNhap."', GiaNhap ='".$GiaNhap."' WHERE MaMH='".$MaMH."'";
            //Step 3
            $result = mysqli_query($conn,$query);
            if($result==true){
                echo "Update dữ liệu thành công";
            }
            else{
                echo "Lỗi ghi dữ liệu" . mysqli_error($conn);
            }
        }
    }
        mysqli_close($conn);
        if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['btnSave'])){
            Insert();
    }
?>
  </div>
</div>
</body>
</html>