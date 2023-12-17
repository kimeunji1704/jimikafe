<?php
    include_once('..\admin\Header.php');
    include_once('..\admin\Sidebar.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Quản lý kho</title>
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
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all" />
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all" />
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all"/>

    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all"/>

    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all" />
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all" />
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all" />
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all" />
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all" />
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all" />
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all"/>
    <link href="css/theme.css" rel="stylesheet" media="all" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  

    <meta name="robots" content="index, nofollow" />

	<style type="text/css">
	table{
        margin-top: 20px;
        text-align: center;
        }
    th{
        font-size: 22px;
    }
    td{
        font-size: 16px;
        padding:10px 15px;
    }
    h2{
        margin: 15px 0px;
        color: blue;
    }
    #nav li{
        display: inline-block;
    }
    #nav li:hover a{
        opacity: 0.6;
    }
    td>a{
         border:2px solid #000; background-color: #628b52; color: white;
         padding: 5px 15px; border-radius: 7px;
    }
   /* .content{
        margin-top: 75px;
        margin-left: 300px;
    }*/
    .btn{
        border-radius: 8px;
    }
    .content{
      margin-left:300px;
      margin-top: 80px;
    }
	</style>
</head>
<body>
<div class="content">
<div id="header" style="background-color: #CCFFFF; height: 70px; width: 100%; margin-top: -4px;">
       <h1 style="color: #333; padding-left: 480px; padding-top: 12px; padding-bottom: 15px;margin-bottom: 0px;">QUẢN LÝ KHO</h1>
    </div>

   <div id="body-main" style=" padding-top: 30px; box-sizing: unset;">
    <!-- <a class="btn btn-success" href="..\kho\export1.php">Export</a> -->
    <form action="export.php" >
        <button type="submit" name="export" class ="btn btn-primary float-right" value="Export to Excel" style=" margin-right: 65px;">Export to Excel</button>
    </form>
 	<?php
 	 $con = mysqli_connect("localhost","root","", "webshops");
    if($con == false){
        die("Connect fail: " . mysqli_connect_error($con));
    }else{
        $query = "select MaMH, Soluong, TenNCC, NgayNhap, GiaNhap from kho join nhacungcap on kho.MaNCC=nhacungcap.MaNCC";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0 ) {
                        echo "<table class='table table-striped' style='margin-top: 55px;'>";
                        echo "<thead>";
                        echo "<th>Mã mặt hàng</th>";
                        echo "<th>Số lượng</th>";
                        echo "<th>Mã nhà cung cấp</th>";
                        echo "<th>Ngày nhập</th>";
                        echo "<th>Giá nhập</th>";
                        echo "<th>Thao Tác</th>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = mysqli_fetch_assoc($result)) {
                             echo "<tr>";

                        echo "<td>" .$row["MaMH"]."</td>";
                        echo "<td>" .$row["Soluong"] ."</td>";
                        echo "<td>" .$row["TenNCC"] ."</td>";
                        echo "<td>" .$row["NgayNhap"] ."</td>";
                        echo "<td>" .$row["GiaNhap"] ."</td>";
                
                echo "<td>" ."<a href = 'suakho.php?MaMH=".$row["MaMH"]."' class='btn btn-outline-secondary'>Sửa</a>" ." ". "<a onclick='return confirm(\"Bạn có muốn xóa dữ liệu không?\")' href = 'xoakho.php?MaMH=".$row["MaMH"]."'  class='btn btn-outline-danger'>Xóa</a>"."</td>";
                echo "</tr>";

            }
            echo "</tbody></table>";

        }
        else{
            echo "data is empty";
        }
    }
 	?>

 	<?php
 	$MaMH = "";
 	?>

 <h4 style="margin-top: 35px; margin-bottom: 15px; color: blue; border-bottom: 20px; padding-left: 100px; text-transform: uppercase;">Tìm kiếm kho</h4>
    <div style="margin-top: 10px; display: flex; justify-content: space-between;">
        
        <form method="Post" class="search">
            <input type="text" name="txtSearch" style="width: 300px; border-radius: 5px; border: 1px solid #000; margin-left: 45px;" value="<?php echo isset($_POST['txtSearch']) ? $_POST['txtSearch'] : $MaMH ?>"   />
            <button type="submit" name="btnSearch" id="btnSearch"  style="color: white; background-color: red; border-radius: 5px; padding: 2px 10px;">TÌM KIẾM</button>
        </form>
    <div>
          <a href="themkho.php" class="btn btn-outline-primary" style="margin-right: 85px; width: 240px; padding: 4px 0px; border: 1px solid;">Tạo kho mới</a> <br></br>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['btnSearch'])) {
            Search();
        }

        function Search() {
            $KeyWord = $_POST['txtSearch'];
            echo "<script type='text/javascript'>var main = document.getElementById('table'); main.remove();</script>";
            $conn = mysqli_connect("localhost", "root", "", "webshops");
                if ($conn == false) {
                    echo "connect fial " . mysqli_connect_error($conn);
                } else { 
                    $query = "SELECT * FROM kho WHERE MaMH LIKE N'%".$KeyWord."%'";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0 ) {
                        echo "<table class='table table-striped' >";
                        echo "<thead>";
                        echo "<th>Mã mặt hàng</th>";
                        echo "<th>Số lượng</th>";
                        echo "<th>Mã nhà cung cấp</th>";
                        echo "<th>Ngày nhập</th>";
                        echo "<th>Giá nhập</th>";
                        echo "<th>Thao Tác</th>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = mysqli_fetch_assoc($result)) {
                             echo "<tr>";

                        echo "<td>" .$row["MaMH"]."</td>";
                        echo "<td>" .$row["Soluong"] ."</td>";
                        echo "<td>" .$row["MaNCC"] ."</td>";
                        echo "<td>" .$row["NgayNhap"] ."</td>";
                        echo "<td>" .$row["GiaNhap"] ."</td>";
                
                echo "<td>" ."<a href = 'suakho.php?MaMH=".$row["MaMH"]."' class='btn btn-outline-secondary'>Sửa</a>" ." ". "<a onclick='return confirm(\"Bạn có muốn xóa dữ liệu không?\")' href = 'xoakho.php?MaMH=".$row["MaMH"]."'  class='btn btn-outline-danger'>Xóa</a>"."</td>";
                echo "</tr>";

                        }
                        echo "</tbody></table>";
                    } else {
                        echo "Data is empty";
                    }
                } 
            mysqli_close($conn);
        }    
    ?>
</div>
</div>  
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script
      data-cfasync="false"
      src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"
    ></script>
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
    <script
      defer
      src="https://static.cloudflareinsights.com/beacon.min.js"
      data-cf-beacon='{"rayId":"6a7dfb26e26a3cdc","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.10.0","si":100}'
    ></script>
    <script
      defer
      src="https://static.cloudflareinsights.com/beacon.min.js"
      data-cf-beacon='{"rayId":"6a7dfb26adde3cdc","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.10.0","si":100}'
    ></script> 
 
</body>
</html>