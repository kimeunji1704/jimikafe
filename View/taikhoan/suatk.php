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

        $username =$_GET['username'];
        $account_type = "";
        $password = " ";
        $employee_id= " ";
        //$status= " ";
        $conn = mysqli_connect("localhost","root","", "jimikafe");
        if($conn == false){
            die("Connect fail: ". mysqli_connect_error($conn));
        }
        else{
            $query="SELECT account_type, username, password, employee_id from accounts where username='".$username."'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    $username  = $row["username"];
                    $account_type =$row["account_type"];
                    $password = $row["password"];
                    $employee_id = $row["employee_id"];
                    //$status = ($row["status"] == '0') ? 'Hoạt động' : 'Ngừng hoạt động';
                }
            }
            else{
                echo "Data is empty";
            }
        }

        // Thực hiện truy vấn
        $query = "SELECT id, name FROM employees";
        $result = mysqli_query($conn, $query);
        // Duyệt qua dữ liệu và tạo danh sách options
        $options = "";
        while ($row = mysqli_fetch_assoc($result)) 
        {
            $selected = $employee_id == $row['id'] ? 'selected' : '';
            $options .= "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
        }
        mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tài khoản</title>
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
            width: 150px;
            padding-right: 10px;
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
    ?>
    <div class="content">
    <div style="margin-left: 50px; padding-bottom: 15px; padding-top: 15px; display: inline-block;width: 1169px;">
            <h3 style="color: #000000; display: inline-block; font-size: 30px;">Cập nhật thông tin tài khoản</h3>
        </div>
            <h2 style="padding-top: 15px; padding-bottom: 15px; font-size: 25px; padding-left: 65px;">Cập nhật dữ liệu</h2>
            <div class="title-content">
                <form action="" method="post" class="form-content">
                    <div class="text-content">
                        <div class="input-text"">
                            <p for="account_type" style="width: 150px; padding-right: 10px;">Loại tài khoản<span class="note" style="color:crimson">(*)</span></p>
                            <div class="ui-select__wrapper next-input--has-content" style="width: 100px; height: 20px;">
                                <select id="account_type" name="account_type" class="ui-select" style="height:30px; width:200px;">
                                    <option value="0" <?php if (isset($_POST['account_type']) && $_POST['account_type'] == '0') echo 'selected' ?>>Nhân viên</option>
                                    <option value="1" <?php if (isset($_POST['account_type']) && $_POST['account_type'] == '1') echo 'selected' ?>>Quản lý</option>
                                </select>
                                <svg class="next-icon next-icon--size-16">
                                    <use xlink:href="#selectChevron"></use>
                                </svg>
                            </div>
                        </div>

                        <div class="input-text">
                            <p>Tên đăng nhập<span class="note" style="color:crimson">(*)</span></p>
                            <input type="text" name="username" class="textfiel" style="height:30px; width:200px;" value="<?php echo isset($_POST['username']) ? $_POST['username']:$username ?>" readonly>
                        </div>

                        <div class="input-text">
                            <p>Mật khẩu<span class="note" style="color: crimson">(*)</span></p>
                            <input type="password" name="password" class="textfiel" style="height:30px; width:200px;" value="<?php echo isset($_POST['password']) ? $_POST['password'] : $password ?>">
                        </div>

                        <div class="input-text">
                            <form method="post">
                                <p style="display:inline-block; padding-right:18px ;">Tên nhân viên<span class="note" style="color:crimson">(*)</span></p>
                                <select style="display:inline-block; height:30px; width:200px;" id="employee_id" name="employee_id" disabled value="<?php echo isset($_POST['employee_id']) ? $_POST['employee_id']:$employee_id ?>">
                                    <?php echo $options; ?>
                                </select>
                            </form>
                        </div>

                        <!--<div class="input-text"">
                            <p>Trạng thái<span class="note" style="color:crimson">(*)</span></p>
                            <div class="ui-select__wrapper next-input--has-content" style="width:200px; height:30px;"> 
                                <select id="status" name="status" class="ui-select" style="width:200px; height:30px;">
                                    <option value="0" <?php //if ($status == 'Hoạt động') echo 'selected' ?>>Hoạt động</option>
                                    <option value="1" <?php //if ($status == 'Ngừng hoạt động') echo 'selected' ?>>Ngừng hoạt động</option>
                                </select>
                                <svg class="next-icon next-icon--size-16">
                                    <use xlink:href="#selectChevron"></use>
                                </svg>
                            </div>
                        </div>-->

                        <div class="form-group">
                            <button type="submit" id="btnSave" name="btnSave" class="btn btn-outline-success">Cập nhật</button>
                            <a href="taikhoan.php" class="btn btn-outline-danger">Hủy</a>
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
                    $account_type = $_POST["account_type"];
                    $username = $_POST["username"];
                    $password =$_POST["password"];
                    $employee_id = $_POST["employee_id"];
                    $status = $_POST["status"];
                    $query = "UPDATE acccounts SET account_type='".$account_type."', password ='".$password."', employee_id='".$employee_id."', status='".$status."' WHERE username= '".$username."'";
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