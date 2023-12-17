<?php
include_once('..\admin\Header.php');
include_once('..\admin\Sidebar.php');
?>
<?php
// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "hrm_backup");

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Thực hiện truy vấn
$query = "SELECT id, fullName FROM account";
$result = mysqli_query($conn, $query);
// Duyệt qua dữ liệu và tạo danh sách options
$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $options .= "<option value='" . $row['id'] . "'>" . $row['fullName'] . "</option>";
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tc_add</title>
    <!-- <link rel="stylesheet" href="css\cssCreate.css"> -->
    <link href="css/font-face.css" rel="stylesheet" media="all" />
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all" />
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all" />
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all" />

    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all" />

    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all" />
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all" />
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all" />
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all" />
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all" />
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all" />
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all" />

    <link href="css/theme.css" rel="stylesheet" media="all" />
    <meta name="robots" content="index, nofollow" />
    <style>
        h3 {
            text-align: center;
        }

        .content {
            margin-top: 77px;
            margin-left: 300px;
        }

        .form-content {
            width: 100%;
            display: flex;
        }

        .text-content {
            width: 100%;
        }

        .img-content {
            width: 55%;
        }

        .text-content .input-text {
            margin-top: 25px;
            display: inline-block;
            margin-right: 100px;
            width: 400px;
        }

        .text-content .input-text p {
            width: 135px;
            padding-right: 10px;
        }

        .text-content .input-text .textfiel {
            border: 1px solid #d7e1eb;
            padding-left: 2px;
            width: 294px;
            height: 32px;
        }

        .title-content {
            padding-left: 50px;
        }

        .form-group {
            margin-top: 35px;
            /* margin-left: 622px; */
        }
    </style>
</head>

<body class="animsition">
    <?php
    // Kết nối đến cơ sở dữ liệu
    $conn = mysqli_connect("localhost", "root", "", "hrm_backup");

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    // Thực hiện truy vấn
    $query = "SELECT id, fullName FROM account";
    $result = mysqli_query($conn, $query);
    // Duyệt qua dữ liệu và tạo danh sách options
    $options = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='" . $row['id'] . "'>" . $row['fullName'] . "</option>";
    }

    $queryProjectId = "SELECT MAX(idProject) as maxIdProject from projects";
    $resultMaxProjectId = mysqli_query($conn, $queryProjectId);
    if ($resultMaxProjectId->num_rows > 0) {

        $rowID = mysqli_fetch_assoc($resultMaxProjectId);
        $maxID = $rowID['maxIdProject'];
        if ($maxID == NULL) {
            $nextID = 0;
        } else {
            $nextID = $maxID + 1;
        }
    } else {
        $nextID = 0;
    }
    // Đóng kết nối
    
    mysqli_close($conn);
    ?>

    <div class="content">
        <div class="">
            <h2
                style=" text-align: center; background-color:#CCFFFF; color: #777777; padding-bottom: 15px; padding-top: 15px; padding-left: 0px;">
                THÊM MỚI DỰ ÁN<h2>
        </div>
        <div class="title-content">
            <form action="" method="post" class="form-content">
                <div class="text-content">
                    <div class="input-text">
                        <p>Mã Dự án</p>
                        <input id="ProjectID" type="text" placeholder="" name="txtID" class="textfiel"
                            value="<?php echo $nextID ?>">
                    </div>

                    <div class="input-text">
                        <p>Tên Dự án</p>
                        <input type="text" placeholder="" name="txtproject" id="txtproject" class="textfiel">
                    </div>

                    <div class="input-text">
                        <p>Ngày bắt đầu:</p>
                        <input type="date" placeholder="" name="txtstart" id="txtstart" class="textfiel">
                    </div>

                    <div class="input-text">
                        <p>Ngày kết thúc:</p>
                        <input type="date" placeholder="" name="txtend" id="txtend" class="textfiel">
                    </div>


                    <div class="input-text">
                        <p>Tên khách hàng:</p>
                        <input type="text" placeholder="" name="txtcustomer" id="txtcustomer" class="textfiel">
                    </div>

                    <div class="form-group input-text">
                        <label style="margin-top: 16px" class="form-control-label">Quản lý dự án</label>
                        <select id="pm" name="pm" value="">
                            <?php echo $options; ?>
                        </select>
                    </div>

                    <div>

                        <form method="post">
                            <p style="margin-top:20px">Chọn thành viên</p>
                            <select id="spinner_name" style="width: 293px; height: 38px" name="spinner_name">
                                <?php echo $options; ?>
                            </select>
                        </form>
                        </select>
                    </div>
                    <table id="employeeTable" style="margin-top:20px; margin-bottom: 30px">
                        <thead>
                            <tr>
                                <th>Thành viên</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <button style="margin-left: 650px;" type="submit" name="btnSave" class="btn btn-outline-success"><i
                            class="fa fa-plus"></i>Thêm</button>
                    <a href="indexDA.php" class="btn btn-outline-danger">Quay lại</a>
                    <script>
                        var itemList = [];
                        var employeeTable = document.getElementById("employeeTable");
                        var spinner = document.getElementById("spinner_name");
                        spinner.addEventListener("change", function () {
                            var selectedItem = spinner.options[spinner.selectedIndex].value;
                            if (!itemList.includes(selectedItem)) {
                                itemList.push(selectedItem);
                                var row = employeeTable.insertRow();
                                var nameCell = row.insertCell(0);
                                var selectedItemName = spinner.options[spinner.selectedIndex].text;
                                nameCell.innerHTML = selectedItemName;
                                var buttonCell = row.insertCell(1);
                                var deleteButton = document.createElement("button");
                                deleteButton.innerHTML = "Xóa";
                                deleteButton.onclick = function () {
                                    employeeTable.deleteRow(row.rowIndex);
                                };
                                buttonCell.appendChild(deleteButton);
                            }
                        });
                        var idProject = null;
                        function saveMembers() {
                            idProject = document.getElementById('ProjectID').value;
                            console.log(idProject);
                            $.ajax({
                                url: 'save.php',
                                type: 'POST',
                                data: { idProject: idProject, list: JSON.stringify(itemList) },
                                success: function (response) {
                                    console.log(response);
                                    if (response === 'True') {
                                        window.location.href = "/hrm/DuAn/indexDA.php";
                                    }
                                }
                            });
                        }

                        function create() {
                            idProject = document.getElementById('ProjectID').value;
                            var projectName = document.getElementById('txtproject').value;
                            var startDate = document.getElementById('txtstart').value;
                            var endDate = document.getElementById('txtend').value;
                            var customer = document.getElementById('txtcustomer').value;
                            var projectManager = document.getElementById('pm').value;
                            $.ajax({
                                url: 'create.php',
                                type: 'POST',
                                data: { idProject: idProject, projectName: projectName, startDate: startDate, endDate: endDate, customer: customer, projectManager: projectManager },
                                success: function (response) {
                                    console.log(response);
                                }
                            });
                        }

                        document.querySelector("button[name='btnSave']").addEventListener("click", function (event) {
                            event.preventDefault(); // Ngăn chặn hành vi mặc định của nút submit
                            create();
                            saveMembers();
                        });
                    </script>

                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
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