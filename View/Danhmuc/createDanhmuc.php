<?php
    include_once('..\admin\Header.php');
    include_once('..\admin\Sidebar.php');
?>

<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Quản lý danh mục</title>
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
        h3{
            text-align: center;
        }
        .content{
            margin-top: 77px;
            margin-left: 300px;
        }
        .text-content .input-text .textfiel {
            border: 1px solid #000;
            padding-left: 2px;
            width: 320px;
        }
        .them{
           padding-top: 15px; 
           padding-bottom: 15px; 
           font-size: 25px; 
           padding-left: 50px;
        }
        .table{
            padding-left: 50px;
        }
        .form-group{
            margin-top: 5px;
            margin-left: 70px;
        }
        </style>
</head>

<body class="animsition">
    <div class="content">
    <div style="margin-left: 50px; padding-bottom: 15px; padding-top: 15px; display: inline-block;width: 1169px;">
            <h3 style="color: #000000; display: inline-block; font-size: 30px;">Thêm mới danh mục</h3>
            <a href="indexDanhmuc.php" class="btn btn-outline-info" style="display: inline-block; margin-left: 700px; background-color: #006600; color: white; font-size: 18px;">
                <span>Quay lại</span>
            </a>
    </div>
        <div class="them">
            <h2>Thông tin cơ bản<h2>
        </div>
        <div class="table">
            <form action="" method="post" class="form-content">
                <div class="text-content">
                    <div class="input-text">
                        <p>Tên danh mục:</p>
                        <input type="text" placeholder="" name="txtTenDM" class="textfiel">
                    </div>

                    <div class="form-group">
                        <button type="submit" name="btnSave" confirm="alert('Xác nhận lưu thông tin!')" class="btn btn-outline-success">Lưu</button>
                        <a href="indexDanhmuc.php" class="btn btn-outline-danger">Quay lại</a>
                    </div>
        </div>
            </form>
        </div>
    </div>
    <?php
        function InsertData() {
            $conn = mysqli_connect("localhost", "root", "", "jimikafe");
            if ($conn == false) {
                die("connect fial " . mysqli_connect_error($conn));
            } else {
                $TenLoai = $_POST['txtTenDM'];
                $query = "INSERT INTO categories(name) VALUES ('$TenLoai')";
                $result = mysqli_query($conn, $query);
                if ($result == true) {
                    echo "Thêm mới dữ liệu thành công";
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
