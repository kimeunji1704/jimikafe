<?php
    include_once('..\admin\HeaderNV.php');
    include_once('..\admin\sidebarNV.php');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
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
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all"/>
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all" />
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all"  />
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
        table { 
            text-align: center;
        }
        th{
            font-size: 13px;
            width: 35px;
            font-size:18px;
        }
        td{
            font-size:13px;
            width: 35px;
            font-size:16px;
        }
        td a{
            margin-right: 5px;
        }
        .content{
            margin-top: 77px;
            margin-left: 300px;
        }
        </style>
</head>

<body>
<div class="content" >
    <form method="Post">   
    </form>
    <div style="margin-left: 50px; padding-bottom: 15px; padding-top: 15px; display: inline-block;">
        <h3 style="color: #000000; display: inline-block; font-size: 35px;">Nhân viên</h3>
    </div>

    <?php
        $TenKH ="";
    ?>
    <div style="margin-top: 10px; padding-left: 50px;padding-right: 50px; display: flex; justify-content: space-between;" >
        <form method="Post" class="search">
            <input type="text" name="txtSearch" placeholder="Tìm kiếm theo tên nhân viên" style="border: 1px solid #000; font-size: 16px; width: 350px;" value="<?php echo isset($_POST['txtSearch']) ? $_POST['txtSearch'] : $TenKH ?>">
            <button type="submit" name="btnSearch" id="btnSearch" class="btn btn-primary" style="background-color: #006400; ">Tìm kiếm</button><br></br>
        </form>
    </div>

    <div style="padding-left: 50px;padding-right: 50px;">
        <?php 
            $conn = mysqli_connect('localhost', 'root', '', 'jimikafe');
            $result = mysqli_query($conn, 'SELECT COUNT(id) AS total FROM employees');
            $row = mysqli_fetch_array($result);
            $total_records = $row['total'];
            
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $limit = 10;
            $total_page = ceil($total_records / $limit);
            
            // Giới hạn current_page trong khoảng 1 đến total_page
            if ($current_page > $total_page) {
                $current_page = $total_page;
            } else if ($current_page < 1) {
                $current_page = 1;
            }
            $start = ($current_page - 1) * $limit;
            
            $query = "";
            if (isset($_POST['txtSearch'])) {
                $KeyWord = $_POST['txtSearch'];
                $query = "SELECT id, name, sex, position
                          FROM employees 
                          WHERE name LIKE N'%".$KeyWord."%' 
                          LIMIT $start, $limit";
            } else {
                $query = "SELECT id, name, sex, position
                          FROM employees 
                          LIMIT $start, $limit";
            }
            
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result)>0){
                echo "<table class='table table-hover'>";
                echo "<thead>";
                echo "<th> Mã nhân viên</th> ";
                echo "<th> Họ tên</th>";
                echo "<th> Giới tính</th>";
                echo "<th> Chức vụ</th>";
                echo "<th>Thao Tác</th>";
                echo "</thead>";
                echo "<tbody>";
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>" .$row["id"]."</td>";
                echo "<td>" .$row["name"]."</td>";
                echo "<td>" . ($row["sex"] == 1 ? "Nữ" : "Nam") . "</td>";
                if($row["position"]==0){
                    echo "<td>Quản lý</td>";
                  }elseif($row["position"]==1){
                    echo "<td>Thu ngân</td>";
                  }elseif($row["position"]==2){
                    echo "<td>Nhân viên phục vụ</td>";
                  }elseif($row["position"]==3){
                    echo "<td>Nhân viên pha chế</td>";
                  }
                echo "<td>" . "<a href = 'viewNV_NV.php?id=".$row["id"]."' class='btn btn-outline-primary'>Xem chi tiết</a>"."</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
            }
            else{
            echo "Không có dữ liệu";
            }
            
        ?>

<div style="margin-top: 10px; display: flex; justify-content: space-between;" >
            <div class="pagination">
            <?php 
                if ($current_page > 1 && $total_page > 1) {
                    echo '<a href="indexNV_NV.php?page=' . ($current_page - 1) . '">&#171;</a> | ';
                }
                for ($i = 1; $i <= $total_page; $i++){
                    if ($i == $current_page){
                        echo '<span>'.$i.'</span> | ';
                    }
                    else{
                        echo '<a href="indexNV_NV.php?page='.$i.'">'.$i.'</a> |';
                    }
                }
                if ($current_page < $total_page && $total_page > 1) {
                    echo '<a href="indexNV_NV.php?page=' . ($current_page + 1) . '">&#187;</a> | ';
                }
            ?>
            </div>
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