<?php
session_start();
if (isset($_SESSION['username'])) {
    echo $_SESSION['username'];
}
else{
    ;
}
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
        $id = "";
        $name = "";
        $sex = " ";
        $birth= " ";
        $position="";
        $phone="";
        $address="";
        $conn = mysqli_connect("localhost","root","", "jimikafe");
        if($conn == false){
            die("Connect fail: ". mysqli_connect_error($conn));
        }
        else{
            $query="SELECT id, name, sex, birth, position, phone, address
                    from accounts, employees
                    where accounts.employee_id = employees.id and accounts.username='".$_SESSION['username']."'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    $id =$row["id"];
                    $name =$row["name"];
                    $sex = $row["sex"];
                    $birth = $row["birth"];
                    $position=$row["position"];
                    $phone=$row["phone"];
                    $address=$row["address"];
                }
            }
            else{
                echo "Data is empty";
            }
        }
        mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin cá nhân</title>
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

<body>
<div class="content">
        <div>
            <h2 style=" text-align: center; color: #777777; padding-bottom: 15px; padding-top: 15px;">Sửa thông tin cá nhân<h2>
        </div>
            <div class="title-content">
                <form action="" method="post" class="form-content">
                    <div class="text-content">
                        <div class="input-text">
                            <p>Mã nhân viên</p><input type="text" name="id" class="textfiel" value="<?php echo isset($_POST['id']) ? $_POST['id']:$id ?>" readonly>
                        </div>

                        <div class="input-text">
                            <p>Tên nhân viên</p><input type="text" name="name" class="textfiel" value="<?php echo isset($_POST['name']) ? $_POST['name']:$name ?>">
                        </div>

                        <div class="input-text">
                            <p>Giới tính</p>
                            <?php
                                $genderValue = isset($_POST['sex']) ? $_POST['sex'] : $sex;
                                $genderText = ($genderValue == 0) ? 'Nam' : 'Nữ';
                            ?>
                            <input type="text" name="sex" class="textfiel" value="<?php echo $genderText; ?>" readonly>
                        </div>


                        <div class="input-text">
                            <p>Ngày sinh</p>
                            <input type="date" name="birth" class="textfiel" value="<?php echo isset($_POST['birth']) ? $_POST['birth']:$birth ?>">
                        </div>

                        <div class="input-text">
                            <p>Chức vụ</p>
                            <?php
                                $positionValue = isset($_POST['position']) ? $_POST['position'] : $position;
                                $positionText = '';

                                switch ($positionValue) {
                                    case 0:
                                        $positionText = 'Quản lý';
                                        break;
                                    case 1:
                                        $positionText = 'Thu ngân';
                                        break;
                                    case 2:
                                        $positionText = 'Nhân viên phục vụ';
                                        break;
                                    case 3:
                                        $positionText = 'Nhân viên pha chế';
                                        break;
                                    default:
                                        $positionText = 'Không xác định';
                                        break;
                                }
                            ?>
                            <input type="text" name="position" class="textfiel" value="<?php echo $positionText; ?>" readonly>
                        </div>


                        <div class="input-text">
                            <p>SĐT</p>
                            <input type="text" name="phone" class="textfiel" value="<?php echo isset($_POST['phone']) ? $_POST['phone']:$phone ?>" >
                        </div>

                        <div class="input-text">
                            <p>Địa Chỉ</p>
                            <input type="text" name="address" class="textfiel" value="<?php echo isset($_POST['address']) ? $_POST['address']:$address ?>" >
                        </div>

                        <div class="form-group">
                            <button type="submit" id="btnSave" name="btnSave" class="btn btn-outline-success">Cập nhật</button>
                            <a href="indexTTCN.php" class="btn btn-outline-danger">Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
    </div>

            <?php
                function UpdateData(){
                //Step 1: Connect db
                $conn=mysqli_connect("localhost","root","","jimikafe");
                if($conn==false){
                    die("Connect fail:". mysqli_connect_error($conn));
                }
                else{
                    $id =$_POST["id"];
                    $name =$_POST["name"];
                    $birth=$_POST["birth"];
                    $phone=$_POST["phone"];
                    $address=$_POST["address"];
                    //Step 2
                    $query = "UPDATE employees SET name ='".$name."', birth='".$birth."',phone='".$phone."',address='".$address."' WHERE id= '".$id."'";
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
                    UpdateData();
                }
            ?>

        </div>
    </div>
</div>

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
