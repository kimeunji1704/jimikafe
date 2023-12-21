<?php
    include_once('..\admin\Header.php');
    include_once('..\admin\sidebar.php');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>JIMI KAFE</title>
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css\cssCreate.css">
    <link href="css/font-face.css" rel="stylesheet" media="all" />
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all"/>
    <linkhref="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all" />
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all"/>
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all" />
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all" />
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all"/>
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all" />
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all" />
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all" />
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all" />
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all" />
    <link href="css/theme.css" rel="stylesheet" media="all" />
    <meta name="robots" content="index, nofollow" />

    <style>
        .content{
            margin-top: 77px;
            margin-left: 300px;
        }
        .form-content {
            width: 100%;
            display: flex;
        }
        .text-content {
            width: 45%;
        }
        .img-content {
            width: 55%;
        }
        .text-content .input-text {
            margin-top: 25px;
            display: flex;
        }
        .text-content .input-text p {
            width: 145px;
            padding-right: 5px;
            color: #000000;

        }
        .text-content .input-text .textfiel {
            border: 1px solid #000;
            padding-left: 2px;
            width: 320px;
        }
        .title-content{
            padding-left: 100px;
        }
        .form-group{
            margin-top: 15px;
            margin-left: 120px;
        }
        </style>
  </head>

<body class="animsition">
    <?php
        $MaNCC =$_GET['id'];
        $TenNCC = " ";
        $phone = " ";
        $address = " ";
        $description = " ";
        $conn = mysqli_connect("localhost","root","", "jimikafe");
        if($conn == false){
            die("Connect fail: ". mysqli_connect_error($conn));
        }
        else{
            $query="SELECT * FROM supplier where id='".$MaNCC."'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    $TenNCC=$row["name"];
                    $SDT=$row["phone"];
                    $Diachi=$row["address"];
                    $Mota=$row["description"];
                }
            }
            else{
                echo "Không có dữ liệu";
            }
        }
    ?>

    <div class="content">
    <div style="margin-left: 50px; padding-bottom: 15px; padding-top: 15px; display: inline-block;width: 1169px;">
            <h3 style="color: #000000; display: inline-block; font-size: 30px;">Cập nhật thông tin nhà cung cấp</h3>
        </div>
            <h2 style="padding-top: 15px; padding-bottom: 15px; font-size: 25px; padding-left: 65px;">Cập nhật dữ liệu</h2>
            <div class="title-content">
                <form action="" method="post" class="form-content">
                    <div class="text-content">
                        <div class="input-text">
                            <p>Mã nhà cung cấp<span class="note" style="color:crimson">(*)</span></p>
                            <input type="text" name="MaNCC" class="textfiel" value="<?php echo isset($_POST['MaNCC']) ? $_POST['MaNCC']:$MaNCC ?>" readonly>
                        </div>

                        <div class="input-text">
                            <p>Tên nhà cung cấp<span class="note" style="color:crimson">(*)</span></p>
                            <input type="text" name="TenNCC" class="textfiel" value="<?php echo isset($_POST['TenNCC']) ? $_POST['TenNCC']:$TenNCC ?>" required>
                        </div>

                        <div class="input-text">
                            <p>Số điện thoại<span class="note" style="color:crimson">(*)</span></p>
                            <input type="text" name="SDT" class="textfiel" value="<?php echo isset($_POST['SDT']) ? $_POST['SDT']:$SDT ?>" required>
                        </div>

                        <div class="input-text">
                            <p>Địa chỉ</p>
                            <input type="text" name="Diachi" class="textfiel" value="<?php echo isset($_POST['Diachi']) ? $_POST['Diachi']:$Diachi ?>">
                        </div>

                        <div class="input-text">
                            <p>Mô tả</p>
                            <input type="text" name="Mota" class="textfiel" style value="<?php echo isset($_POST['Mota']) ? $_POST['Mota']:$Mota ?>" >
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" id="btnSave" name="btnSave" class="btn btn-outline-success" href="indexDanhmuc.php">Cập nhật</button>
                            <a href="Nhacungcap.php" class="btn btn-outline-danger">Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
    </div>

            <?php
                function InsertData(){
                //Step 1: Connect db
                $conn=mysqli_connect("localhost","root","","jimikafe");
                if($conn==false){
                    die("Connect fail:". mysqli_connect_error($conn));
                }
                else{
                    $MaNCC = $_POST['MaNCC'];
                    $TenNCC = $_POST['TenNCC'];
                    $SDT = $_POST['SDT'];
                    $Diachi = $_POST['Diachi'];
                    $Mota = $_POST['Mota'];
                    //Step 2
                    $query = "UPDATE supplier SET supplier_name='".$TenNCC."', phone='".$SDT."', address='".$Diachi."', description='".$Mota."'  WHERE id='".$MaNCC."'";
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
                //mysqli_close($con);
                if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['btnSave'])){
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