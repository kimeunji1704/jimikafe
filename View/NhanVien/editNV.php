<?php
    include_once('..\admin\Header.php');
    include_once('..\admin\sidebarNV.php');
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
        $manv =$_GET['id'];
        $name = "";
        $sex = "";
        $date = "";
        $positionCode = "";
        $phone = "";
        $address = "";
        $conn = mysqli_connect("localhost","root","", "jimikafe");
        if($conn == false){
            die("Connect fail: ". mysqli_connect_error($conn));
        }
        else{
            $query="SELECT * from employees where id='".$manv."'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    $manv  = $row["id"];
                    $name = $row["name"];
                    var_dump($row["sex"]);
                    $sex = ($row["sex"] == '0') ? 'Nam' : 'Nữ';
                    $date = $row["birth"];
                    $positionCode = $row["position"];
                    // Map position codes to human-readable values
                    switch ($positionCode) {
                        case '0':
                            $position = 'Quản lý';
                            break;
                        case '1':
                            $position = 'Thu ngân';
                            break;
                        case '2':
                            $position = 'Nhân viên phục vụ';
                            break;
                        case '3':
                            $position = 'Nhân viên pha chế';
                            break;
                        default:
                            $position = 'Không xác định'; // Handle unexpected values
                            break;
                    }
                            $phone = $row["phone"];
                    $address = $row["address"];
                }
            }
            else{
                echo "Data is empty";
            }
        }
    ?>

    <div class="content">
        
        <div style="margin-left: 50px; padding-bottom: 15px; padding-top: 15px; display: inline-block;width: 1169px;">
            <h3 style="color: #000000; display: inline-block; font-size: 30px;">Cập nhật thông tin nhân viên</h3>
        </div>
            <h2 style="padding-top: 15px; padding-bottom: 15px; font-size: 25px; padding-left: 65px;">Cập nhật dữ liệu</h2>
            <div class="title-content">
                <form action="" method="post" class="form-content">
                    <div class="text-content">

                        <div class="input-text">
                            <p>Mã nhân viên<span class="note" style="color:crimson">(*)</span></p>
                            <input type="text" name="txtmanv" class="textfiel" style="width: 200px; height: 30px;" value="<?php echo isset($_POST['txtmanv']) ? $_POST['txtmanv'] : $manv ?>" readonly>
                        </div>


                        <div class="input-text">
                            <p>Họ tên<span class="note" style="color: crimson">(*)</span></p>
                            <input type="text" name="txtname" class="textfiel" style="width: 200px; height: 30px;" value="<?php echo isset($_POST['txtname']) ? $_POST['txtname'] : $name ?>" required>
                            <span id="nameError" style="color: crimson; display: none;">Họ tên không được để trống</span>
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


                        <div class="input-text"">
                            <p>Giới tính<span class="note" style="color:crimson">(*)</span></p>
                            <div class="ui-select__wrapper next-input--has-content" style="width:200px; height:30px;"> 
                            <select id="sex" name="sex" class="ui-select" style="width:200px; height:30px;">
                                <option value="0" <?php if ($sex == 'Nam') echo 'selected' ?>>Nam</option>
                                <option value="1" <?php if ($sex == 'Nữ') echo 'selected' ?>>Nữ</option>
                            </select>
                                <svg class="next-icon next-icon--size-16">
                                    <use xlink:href="#selectChevron"></use>
                                </svg>
                            </div>
                        </div>

                        <div class="input-text">
                            <p>Ngày sinh</p>
                            <input type="date" name="date" class="textfiel" style="width: 200px; height: 30px;" value="<?php echo isset($_POST['date']) ? $_POST['date']:$date ?>">
                        </div>
                        
                        <div class="input-text">
                            <p>Chức vụ<span class="note" style="color:crimson">(*)</span></p>
                            <div class="ui-select__wrapper next-input--has-content" style="width: 200px; height: 30px;">
                                <select id="txtchucvu" name="txtchucvu" class="ui-select" required style="width:200px; height:30px;">
                                    <option value="0" <?php if ($position == 'Quản lý') echo 'selected' ?>>Quản lý</option>
                                    <option value="1" <?php if ($position == 'Thu ngân') echo 'selected' ?>>Thu ngân</option>
                                    <option value="2" <?php if ($position == 'Nhân viên phục vụ') echo 'selected' ?>>Nhân viên phục vụ</option>
                                    <option value="3" <?php if ($position == 'Nhân viên pha chế') echo 'selected' ?>>Nhân viên pha chế</option>
                                </select>
                                    <svg class="next-icon next-icon--size-16">
                                        <use xlink:href="#selectChevron"></use>
                                    </svg>
                            </div>
                        </div>

                        <div class="input-text">
                            <p>Số điện thoại<span class="note" style="color:crimson">(*)</span></p>
                            <input type="text" name="txtphone" class="textfiel" style="width: 200px; height: 30px;" value="<?php echo isset($_POST['txtphone']) ? $_POST['txtphone']:$phone ?>" required pattern="[0-9]{10}" title="Vui lòng nhập số điện thoại 10 chữ số">
                        </div>
                        <script>
                            document.forms["myForm"]["txtphone"].addEventListener('invalid', function (e) {
                                e.target.setCustomValidity("");
                                if (!e.target.validity.valid) {
                                    e.target.setCustomValidity("Vui lòng nhập số điện thoại 10 chữ số");
                                }
                            });
                            document.forms["myForm"]["txtphone"].addEventListener('input', function (e) {
                                e.target.setCustomValidity("");
                            });
                        </script>

                        <div class="input-text">
                            <p>Địa chỉ</p>
                            <input type="text" name="address" class="textfiel" style="width: 200px; height: 30px;" value="<?php echo isset($_POST['address']) ? $_POST['address']:$address ?>">
                        </div>

                        <div class="form-group" style="margin-left: 200px">
                            <button type="submit" id="btnSave" name="btnSave" class="btn btn-outline-success">Cập nhật</button>
                            <a href="indexNV.php" class="btn btn-outline-danger">Quay lại</a>
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
                    $manv = $_POST['txtmanv'];
                    $name = $_POST['txtname'];
                    $sex = $_POST['sex'];
                    $date = $_POST['date'];
                    $position = $_POST['txtchucvu'];
                    $phone = $_POST['txtphone'];
                    $address = $_POST['address'];
                    //Step 2
                    $query = "UPDATE employees SET name ='".$name."', sex ='".$sex."', birth ='".$date."',position ='".$position."',phone ='".$phone."', address='".$address."' WHERE id='".$manv."'";
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