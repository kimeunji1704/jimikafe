<?php
    include_once('..\admin\Header.php');
    include_once('..\admin\Sidebar.php');
?>
<!DOCTYPE html>
<html>
    <head lang="">
    <meta charset="UTF-8">
    <title>JIMI KAFE</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link
      href="vendor/font-awesome-4.7/css/font-awesome.min.css"
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
        table { 
            text-align: center;
        }
        th{
            font-size: 13px;
            width: 35px;
            font-size:18px;
            text-align: center;
        }
        td{
            font-size:13px;
            width: 35px;
            font-size:16px;
            text-align: center;
        }
        .content{
            margin-top: 77px;
            margin-left: 340px;
        }
    </style>
    </head>

    <body>
    <div style="margin-left: 50px; padding-bottom: 15px; padding-top: 15px; margin-top: 77px; margin-left: 340px;display: inline-block;">
        <h3 style="color: #000000; display: inline-block; font-size: 35px;">Danh sách hóa đơn</h3>
        <a href="hoadon.php" class="btn btn-outline-info" style="display: inline-block; margin-left:600px; background-color: #064928; color: white; font-size: 18px;">
            <svg class="" width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.66667 4.66659H7.33333V7.33325H4.66667V8.66659H7.33333V11.3333H8.66667V8.66659H11.3333V7.33325H8.66667V4.66659ZM8 1.33325C4.32 1.33325 1.33333 4.31992 1.33333 7.99992C1.33333 11.6799 4.32 14.6666 8 14.6666C11.68 14.6666 14.6667 11.6799 14.6667 7.99992C14.6667 4.31992 11.68 1.33325 8 1.33325ZM8 13.3333C5.06 13.3333 2.66667 10.9399 2.66667 7.99992C2.66667 5.05992 5.06 2.66659 8 2.66659C10.94 2.66659 13.3333 5.05992 13.3333 7.99992C13.3333 10.9399 10.94 13.3333 8 13.3333Z" fill="white"></path>
            </svg>
            Thêm hóa đơn
        </a>
            <div class="statistical" style="font-size: 18px;">
                <form action="" method="post">
                    <label for="" style="font-size: 18px;">Tháng: </label>
                    <select id="id_select" name="thang" style="font-size: 18px;" onChange="saveSelectedMonth()">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>

                    <script>
                        // Add this JavaScript function to save the selected month in localStorage
                        function saveSelectedMonth() {
                            var selectedMonth = document.getElementById("id_select").value;
                            localStorage.setItem("selectedMonth", selectedMonth);
                        }

                        // Add this JavaScript code to set the selected option on page load
                        document.addEventListener("DOMContentLoaded", function () {
                            var selectedMonth = localStorage.getItem("selectedMonth");
                            if (selectedMonth !== null) {
                                document.getElementById("id_select").value = selectedMonth;
                            }
                        });
                    </script>

                    <label for="" style="font-size: 18px;">Năm: </label>
                    <select id="id_select" name="nam" onChange="click()" style="font-size: 18px;">
                        <option value="2023" selected="selected">2023</option>
                        <option value="2024" selected="selected">2024</option>
                    </select>
                    <button type="submit" name="submit" id="btnSearch" class="btn btn-primary" style="background-color: #006400; ">Tìm kiếm</button><br></br>
                </form>
                <?php       
                    $con = mysqli_connect("localhost","root","", "jimikafe");
                    if($con == false){
                        die("Connect fail: " . mysqli_connect_error($con));
                    }else{
                        // $thang = $_POST['thang']; 
                        if(isset($_POST['submit'])){
                            if(!empty($_POST['thang']) AND !empty($_POST['thang'])) {
                                $thang= $_POST['thang'];
                                $nam= $_POST['nam'];
                        $query = "SELECT id, date, total_amount  
                                  FROM bill 
                                  WHERE month(date)='$thang' AND year(date)='$nam' 
                                  GROUP BY date;";
                        $result = mysqli_query($con, $query);
                        if(mysqli_num_rows($result)>0){
                            echo "<table class='table table-hover'>";
                            echo "<thead>";
                            echo "<th>Mã hóa đơn</th>";
                            echo "<th>Ngày</th>";
                            echo "<th>Tổng tiền</th>";
                            echo "<thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<tr>";
                                echo "<td>" .$row["id"]."</td>";
                                echo "<td>" .$row["date"]."</td>";
                                echo "<td>" .number_format($row["total_amount"]) ."</td>";
                                echo "</tr>";
                            }
                            echo "</table></tbody>";
                        }
                        else{
                            echo "Không có dữ liệu!";
                        }
                    }
                }}
                ?>
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
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"6a7dfb26e26a3cdc","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.10.0","si":100}'></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"6a7dfb26adde3cdc","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.10.0","si":100}'></script>
    </body>
</html>