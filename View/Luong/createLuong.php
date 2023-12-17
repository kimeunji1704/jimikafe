<?php
    include_once('..\admin\Header.php');
    include_once('..\admin\SidebarNV.php');
?>
<?php
    // Kết nối đến cơ sở dữ liệu
    $conn = mysqli_connect("localhost", "root", "", "jimikafe");

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    // Thực hiện truy vấn
    $query = "SELECT id, name  FROM employees";
    $result = mysqli_query($conn, $query);
    // Duyệt qua dữ liệu và tạo danh sách options
    $options = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
    }
    // Đóng kết nối
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JIMI KAFE</title>
    <!-- <link rel="stylesheet" href="css\cssCreate.css"> -->
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
            height:30px; 
            width:200px;
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
       /* .form-group{
            margin-top: 35px;
            margin-left: 622px;
        }*/
        #log{
            text-align: center;
            font-style: italic;
            color: red;
            line-height: 20px;
        }
        </style>
</head>
<body class="animsition">
    <div class="content">
        <div style="margin-left: 50px; padding-bottom: 15px; padding-top: 15px; display: inline-block;width: 1169px;">
            <h3 style="color: #000000; display: inline-block; font-size: 30px;">Tính lương</h3>
         </div>
        <div class="them" >
             <div class="table">
                <form action="" method="post" class="form-content">
                    <div class="text-content">
                        <div class="input-text">
                            <p>Tên nhân viên</p>
                            <select id="employee_id" name="employee_id" value="" style="height:30px; width:200px;"> 
                                <?php echo $options; ?>
                            </select>
                        </div>
                        
                        <div class="input-text">
                            <p>Ngày</p>
                            <input type="date" name="date" id="date" class="textfiel">
                        </div>

                        <div class="input-text">
                            <p>Lương cơ bản</p>
                            <input type="text" name="salary" id="salary" class="textfiel">
                        </div>

                        <div class="input-text">
                            <p>Thưởng</p>
                            <input type="text" name="reward" id="reward" class="textfiel">
                        </div>

                        <div class="input-text">
                            <p>Khấu trừ</p>
                            <input type="text" name="fines" id="fines" class="textfiel">
                        </div>

                        <div class="input-text">
                            <p>Số giờ làm</p>
                            <input type="text" name="workhours" id="workhours" class="textfiel"class="textfiel">
                        </div>

                        <div class="input-text">
                            <p>Lương</p>
                            <input type="text" name="total" id="total" class="textfiel" readonly>
                        </div>
                        <p id="log"></p>

                        <div class="form-group">
                            <button type="button" name="btnCalculateSalary" class="btn btn-outline-success" onclick="CalculateSalary()">Tính Lương</button>
                            <button type="submit" name="btnSave" class="btn btn-outline-success">Thêm</button>
                            <a href="indexLuong.php" class="btn btn-outline-danger">Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function CalculateSalary() {
            var salary = document.getElementById("salary").value;
            var reward = document.getElementById("reward").value;
            var workhours = document.getElementById("workhours").value;
            var fines = document.getElementById("fines").value;
            var total = parseFloat(salary) * parseFloat(workhours) + parseFloat(reward) - parseFloat(fines);
            document.getElementById("total").value = isNaN(total) ? '' : total;
        }
    </script>

    <?php
        function InsertData() {
            $conn = mysqli_connect("localhost", "root", "", "jimikafe");
            if ($conn == false) {
                die("connect fial " . mysqli_connect_error($conn));
            } else {
                    $employee_id = $_POST['employee_id'];
                    $date = $_POST['date'];
                    $salary = $_POST['salary'];
                    $reward = $_POST['reward'];
                    $fines = $_POST['fines'];
                    $workhours = $_POST['workhours'];
                    $total = $_POST['total'];
                $query = "INSERT INTO salaries(employee_id, date, salary, reward, fines, workhours, total) VALUES ('$employee_id','$date','$salary','$reward','$fines','$workhours','$total')";
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>