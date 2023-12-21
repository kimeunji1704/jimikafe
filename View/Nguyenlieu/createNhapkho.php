<?php
    include_once('..\admin\Header.php');
    include_once('..\admin\Sidebar.php');
?>
<?php
    // Kết nối đến cơ sở dữ liệu
    $conn = mysqli_connect("localhost", "root", "", "jimikafe");
    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }
    // Thực hiện truy vấn
    $query = "SELECT id, name FROM supplier";
    $result = mysqli_query($conn, $query);
    // Duyệt qua dữ liệu và tạo danh sách options
    $options = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
    }
    // Thực hiện truy vấn
    $query1 = "SELECT id, name FROM ingredient";
    $result1 = mysqli_query($conn, $query1);
    // Duyệt qua dữ liệu và tạo danh sách options
    $options1 = "";
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $options1 .= "<option value='" . $row1['id'] . "'>" . $row1['name'] . "</option>";
    }
    // Đóng kết nối
    mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JIMI KAFE</title>
    <link rel="stylesheet" href="css\cssCreate.css">
    <link href="css/font-face.css" rel="stylesheet" media="all" />
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css"
      rel="stylesheet"
      media="all"
    />
    <link
      href="vendor/font-awesome-5/css/fontawesome-all.min.css"
      rel="stylesheet"
      media="all"
    />
    <link
      href="vendor/mdi-font/css/material-design-iconic-font.min.css"
      rel="stylesheet"
      media="all"
    />

    <link
      href="vendor/bootstrap-4.1/bootstrap.min.css"
      rel="stylesheet"
      media="all"
    />

    <link
      href="vendor/animsition/animsition.min.css"
      rel="stylesheet"
      media="all"
    />
    <link
      href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css"
      rel="stylesheet"
      media="all"
    />
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all" />
    <link
      href="vendor/css-hamburgers/hamburgers.min.css"
      rel="stylesheet"
      media="all"
    />
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all" />
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all" />
    <link
      href="vendor/perfect-scrollbar/perfect-scrollbar.css"
      rel="stylesheet"
      media="all"
    />

    <link href="css/theme.css" rel="stylesheet" media="all" />
    <meta name="robots" content="index, nofollow" />
    <style>
        .h3{
            text-align: center;
        }
        .text-content .input-text .textfiel {
            border: 1px solid #000;
            padding-left: 2px;
            font-size: 17px; 
            color:#000000;
        }
        .text-content{
            font-size: 17px;
            color:#000000;
            padding-left: 20px;
        }
        .content{
            margin-top: 77px;
            margin-left: 300px;
            height: auto;
        }
        .them{
            background-color: #FFFFFF; 
            margin: 10px 53px 20px;
            padding-left: 20px;
        }
        .form-group{
            margin-top: 5px;
            margin-left: 70px;
        }
        .input-text{
            font-size: 17px;
            color:#000000;
            margin-top: 0 0 0 8px;
        }
        .input-text p{
            width: 120px;
            padding-bottom: 5px;
        }
        .next-input-wrapper{
            font-size: 17px;
            color:#000000;
            margin: 0px 0px 8px;
        }
    </style>
</head>
<body class="animsition">
    <div class="content">
        <div style="margin-left: 50px; padding-bottom: 15px; padding-top: 15px; display: inline-block;width: 1169px;">
                <h3 style="color: #000000; display: inline-block; font-size: 30px;">Thêm phiếu nhập kho</h3>
        </div>

        <div class="them" >
            <form action="" method="post" class="form-content">
                <div class="text-content">
                    <div class="input-text">
                        <p>Nhà cung cấp<span class="note" style="color:crimson">(*)</span></p>
                        <select id="supplier_id" name="supplier_id" class="textfiel" style="height:30px; width:200px;">
                            <?php echo $options; ?>
                        </select>
                    </div>

                    <div class="input-text">
                        <p>Nguyên liệu<span class="note" style="color:crimson">(*)</span></p>
                        <select id="ingredient_id" name="ingredient_id" class="textfiel" style="height:30px; width:200px;">
                            <?php echo $options1; ?>
                        </select>
                    </div>

                    <div class="input-text">
                        <p>Số lượng<span class="note" style="color:crimson">(*)</span></p>
                        <input type="number" name="quantity" class="textfiel" style="height:30px; width:300px;">
                    </div>

                    <div class="input-text">
                        <p>Ngày<span class="note" style="color:crimson">(*)</span></p>
                        <input type="date" name="date" class="textfiel" style="height:30px; width:300px;">
                    </div>

                    <div class="form-group">
                        <button type="submit" name="btnSave" class="btn btn-outline-success">Lưu</button>
                        <a href="Nhapkho.php" class="btn btn-outline-danger">Hủy</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
        function InsertData() {

            $conn = mysqli_connect("localhost", "root", "", "jimikafe");
            if ($conn == false) {
                die("connect fail " . mysqli_connect_error($conn));
            } else {
                $supplier_id =$_POST["supplier_id"];
                $ingredient_id = $_POST["ingredient_id"];
                $quantity = $_POST["quantity"];
                $date = $_POST["date"];
                $query = "INSERT INTO import(supplier_id, ingredient_id, quantity, date) VALUES ('$supplier_id', '$ingredient_id', '$quantity', '$date')";
                $result = mysqli_query($conn, $query);
                if ($result == true) {
                    echo "Thêm mới dữ liệu thành công";
                    //header('Location: ..\indexNL.php');
                } else {
                    echo "Lỗi ghi dữ liệu" . mysqli_error($conn);
                }
                $query1 = "SELECT id, quantity FROM ingredient";
                $result1 = mysqli_query($conn, $query1);
                $row = mysqli_fetch_assoc($result1);
                $total = $row['quantity'] + $quantity;
                $query2 = "UPDATE ingredient SET quantity ='".$total."' WHERE id='".$ingredient_id."'";
                $result2 = mysqli_query($conn, $query2);
            }
            mysqli_close($conn);
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['btnSave'])) {
            InsertData();
        }

    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js" ></script>
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="vendor/slick/slick.min.js"></script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="js/main.js"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"6a7dfb26e26a3cdc","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.10.0","si":100}' ></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"6a7dfb26adde3cdc","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.10.0","si":100}' ></script>
</body>
</html>