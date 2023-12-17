<?php
    include_once('..\admin\Header.php');
    include_once('..\admin\Sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JIMI KAFE</title>
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
            width: 50%;
        }
        .img-content {
            width: 55%;
        }
        .text-content .input-text {
            margin-top: 25px;
            display: flex;
        }
        .text-content .input-text p {
            width: 130px;
            padding-right: 10px;
            color: #000000;
            font-size: 17px;
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
        $id =$_GET['id'];
        $name = "";
        $discount = "";
        $startime = "";
        $endtime = "";
        $description = "";
        $conn = mysqli_connect("localhost","root","", "jimikafe");
        if($conn == false){
            die("Connect fail: ". mysqli_connect_error($conn));
        }
        else{
            $query="SELECT * from voucher where id='".$id."'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    $id  = $row["id"];
                    $name = $row["name"];
                    $discount = $row["discount"];
                    $startime = $row["startime"];
                    $endtime = $row["endtime"];
                    $description = $row["description"];
                }
            }
            else{
                echo "Data is empty";
            }
        }
    ?>

    <div class="content">
        
        <div style="margin-left: 50px; padding-bottom: 15px; padding-top: 15px; display: inline-block;width: 1169px;">
            <h3 style="color: #000000; display: inline-block; font-size: 30px;">Cập nhật thông tin khuyến mại</h3>
        </div>
            <h2 style="padding-top: 15px; padding-bottom: 15px; font-size: 25px; padding-left: 65px;">Cập nhật dữ liệu</h2>
            <div class="title-content">
                <form action="" method="post" class="form-content">
                    <div class="text-content">

                        <div class="input-text">
                            <p>Mã khuyến mại<span class="note" style="color:crimson">(*)</span></p>
                            <input type="text" name="id" class="textfiel" style="width: 200px; height: 30px;" value="<?php echo isset($_POST['id']) ? $_POST['id'] : $id ?>" readonly>
                        </div>


                        <div class="input-text">
                            <p>Tên khuyến mại<span class="note" style="color: crimson">(*)</span></p>
                            <input type="text" name="name" class="textfiel" style="width: 200px; height: 30px;" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $name ?>" required>
                            <span id="nameError" style="color: crimson; display: none;">Tên khuyến mại không được để trống</span>
                        </div>
                        <script>
                            function validateForm() {
                                var name = document.forms["myForm"]["txtname"].value;
                                var nameError = document.getElementById("nameError");

                                if (name === "") {
                                    nameError.style.display = "block";
                                    return false;
                                } else {
                                    nameError.style.display = "none";
                                    return true;
                                }
                            }
                        </script>

                        <div class="input-text">
                            <p>Chiết khấu<span class="note" style="color: crimson">(*)</span></p>
                            <input type="text" name="discount" class="textfiel" style="width: 200px; height: 30px;" value="<?php echo isset($_POST['discount']) ? $_POST['discount'] : $discount ?>" required>
                            <span id="discountmeError" style="color: crimson; display: none;">Tên khuyến mại không được để trống</span>
                        </div>
                        <script>
                            function validateDiscount() {
                                var discountInput = document.getElementsByName("discount")[0];
                                var discountValue = discountInput.value.trim();
                                // Kiểm tra nếu giá trị không phải là số không âm
                                if (!/^\d*\.?\d*$/.test(discountValue)) {
                                    alert("Chiết khấu không hợp lệ. Vui lòng nhập số không âm.");
                                    return false;
                                }
                                // Kiểm tra nếu giá trị nằm trong khoảng từ 0 đến 100
                                var discountNumber = parseFloat(discountValue);
                                if (discountNumber < 0 || discountNumber > 100) {
                                    alert("Chiết khấu phải nằm trong khoảng từ 0 đến 100.");
                                    return false;
                                }

                                return true;
                            }
                            // Gán hàm kiểm tra cho sự kiện submit của form
                            document.querySelector("form").addEventListener("submit", function (event) {
                                if (!validateDiscount()) {
                                    event.preventDefault(); // Ngăn chặn sự kiện submit nếu giá trị không hợp lệ
                                }
                            }); 
                        </script>

                        <div class="input-text">
                            <p>Ngày bắt đầu<span class="note" style="color:crimson">(*)</span></p>
                            <input type="date" name="startime" class="textfiel" style="width: 200px; height: 30px;" value="<?php echo isset($_POST['startime']) ? $_POST['startime'] : $startime ?>" required pattern="\d{4}-\d{2}-\d{2}">
                            <span id="startimeError" style="color: crimson; display: none;">Vui lòng chọn ngày bắt đầu và định dạng YYYY-MM-DD.</span>
                        </div>
                        <script>
                            function validateStartime() {
                                var startimeInput = document.getElementsByName("startime")[0];
                                var startimeValue = startimeInput.value.trim();
                                var pattern = /\d{4}-\d{2}-\d{2}/;
                                if (!startimeValue) {
                                    document.getElementById("startimeError").style.display = "block";
                                    return false;
                                }
                                if (!pattern.test(startimeValue)) {
                                    document.getElementById("startimeError").style.display = "block";
                                    return false;
                                }
                                document.getElementById("startimeError").style.display = "none";
                                return true;
                            }
                            document.querySelector("form").addEventListener("submit", function (event) {
                                if (!validateStartime()) {
                                    event.preventDefault();
                                }
                            });
                        </script>

                        <div class="input-text">
                            <p>Ngày kết thúc</p>
                            <input type="date" name="endtime" class="textfiel" style="width: 200px; height: 30px;" value="<?php echo isset($_POST['endtime']) ? $_POST['endtime']:$endtime ?>">
                        </div>
                        
                        <div class="input-text">
                            <p>Mô tả</p>
                            <input type="text" name="description" class="textfiel" style="width: 200px; height: 30px;" value="<?php echo isset($_POST['description']) ? $_POST['description']:$description ?>">
                        </div>

                        <div class="form-group" style="margin-left: 200px">
                            <button type="submit" id="btnSave" name="btnSave" class="btn btn-outline-success">Cập nhật</button>
                            <a href="indexVoucher.php" class="btn btn-outline-danger">Quay lại</a>
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
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $discount = $_POST['discount'];
                    $startime = $_POST['startime'];
                    $endtime = $_POST['endtime'];
                    $description = $_POST['description'];
                    //Step 2
                    $query = "UPDATE voucher SET name ='".$name."', discount ='".$discount."', startime ='".$startime."', endtime ='".$endtime."',description ='".$description."'WHERE id='".$id."'";
                    //Step 3
                    $result = mysqli_query($conn, $query);
                    if($result==true){
                        echo "Cập nhật dữ liệu thành công";
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