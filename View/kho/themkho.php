<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Thêm kho</title>
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
    padding: 4px 13px 10px;
    border: 1px solid #28a745;
    border-radius: 5px;
    }
    </style>
</head>
<body>
    <div id="main">
        <div id="header" style="background-color: #CCFFFF; height: 70px;">
        <h2 style="color: #333; text-align: center; padding: 15px 0px;">THÊM SẢN PHẨM MỚI TRONG KHO</h2>
        </div>

    <form method="post">
         <div style="padding: 75px 30% 13%; margin: 0 -30px; width: 100%;">
        <table>

            <tr>
                <td>Mã mặt hàng</td>
                <td>
                    <input type="text" name="txtMMH" class="form-control" id="txtMMH"  style="width: 420px;"/>
                </td>
            </tr>

            <tr>
                <td>Số lượng</td>
                <td>
                    <input type="text" name="txtSL" class="form-control" id="txtSL"/>
                </td>
            </tr>

            <tr>
                <td>Mã nhà cung cấp</td>
                <td>
                    <input type="text" name="txtMNCC" class="form-control" id="txtMNCC"/>
                </td>
            </tr>

             <tr>
                <div class="input-text">
                    <td>Ngày nhập:</td>
                    <td>
                    <input type="date" placeholder="" name="txtDate" class="textfiel">
                    </td>
                    </div>
            </tr>

             <tr>
                <td>Giá nhập</td>
                <td>
                    <input type="text" name="txtGN" class="form-control" id="txtGN"/>
                </td>
            </tr>



            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-success" id="btnSave" style=" color: white; background-color: red;" name="btnSave">Ghi giữ liệu</button>
                    <a href="khoo.php">Quay lại</a>
                </td>
            </tr>
        </table>
    </form>

    <?php
     function InsertData() {
            $conn = mysqli_connect("localhost", "root", "", "webshops");
            if ($conn == false) {
                die("connect fial " . mysqli_connect_error($conn));
            } else {

                $MaMH = $_POST['txtMMH'];
                $GiaNhap = $_POST['txtGN'];
                $NgayNhap = $_POST['txtDate'];
                $SoLuong = $_POST['txtSL'];
                $MaNCC = $_POST['txtMNCC'];

                
                $query = "INSERT INTO kho( MaMH, Soluong, MaNCC, NgayNhap, GiaNhap) VALUES ('$MaMH','$SoLuong','$MaNCC','$NgayNhap','$GiaNhap')";

                $result = mysqli_query($conn, $query);
                if ($result == true) {
                    echo "thêm mới dữ liệu thành công";
                } else {
                    echo "Lỗi ghi dữ liệu" . mysqli_error($conn);
                }
            }
            mysqli_close($conn);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['btnSave'])) {
            InsertData();
        }
    ?>
        </div>
</body>
</html>