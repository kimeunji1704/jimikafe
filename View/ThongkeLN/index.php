<?php
    include_once('..\Pugin\Header.php');
    include_once('..\Pugin\Sidebar.php');
?>
<!DOCTYPE html>
<html>
    <head lang="">
    <meta charset="UTF-8">
    <title>Thống kê lợi nhuận</title>
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
        .content{
            margin-top: 77px;
            margin-left: 300px;
        }
        .statistical{
            padding-left: 70px;
            padding-right: 70px;
        }
    </style>
    </head>

    <body>
        <div class="content">
        <div>
            <h2 style=" text-align: center; background-color:#CCFFFF; color: #777777; padding-bottom: 15px; padding-top: 15px;">THỐNG KÊ LỢI NHUẬN<h2>
        </div>
            <h2 style="font-size: 25px; padding-top: 15px; padding-bottom: 15px; padding-left: 50px;">Thống kê lợi nhuận theo từng năm<h2>
            <div class="statistical">
                <form action="" method="post" style="font-size: 20px;">
                    <label for="">Tháng: </label>
                    <select id="id_select" name="thang" onChange="click()">
                        <option value="1" selected="selected">1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>
                        <option value="6" >6</option>
                        <option value="7" >7</option>
                        <option value="8" >8</option>
                        <option value="9" >9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    <label for="">Năm: </label>
                    <select id="id_select" name="nam" onChange="click()">
                        <option value="2020" selected="selected">2020</option>
                        <option value="2021" >2021</option>
                    </select>
                    <!-- <input type="submit" name="submit" value="Tìm kiếm" style="margin-left:30px;"> -->
                    <button type="submit" name="submit" class="btn btn-outline-info btn-sm" style = "margin-left: 20px; text-align: center; ">Tìm kiếm</button>
                </form>
                <?php       
                    $con = mysqli_connect("localhost","root","", "webshops");
                    if($con == false){
                        die("Connect fail: " . mysqli_connect_error($con));
                    }else{
                        // $thang = $_POST['thang']; 
                        if(isset($_POST['submit'])){
                            if(!empty($_POST['thang']) AND !empty($_POST['thang'])) {
                                $thang= $_POST['thang'];
                                $nam= $_POST['nam'];
                        $query = "SELECT ngayDat, SUM(donhang.tongtien)- (SUM(kho.GiaNhap*ct_donhang.soLuong)) as Loinhuan FROM donhang 
                                        JOIN ct_donhang ON ct_donhang.maDon = donhang.maDon 
                                        JOIN mathang ON ct_donhang.maMH = mathang.MaMH 
                                        JOIN kho ON kho.MaMH = mathang.MaMH 
                                    WHERE month(ngayDat)='$thang' AND year(ngayDat)='$nam' AND tinhtrang = N'Xác nhận' 
                                    GROUP BY ngayDat;";
                        $result = mysqli_query($con, $query);
                        if(mysqli_num_rows($result)>0){
                            echo "<table class='table table-hover'>";
                            echo "<thead>";
                            echo "<th>Ngày</th>";
                            echo "<th>Lợi nhuận</th>";
                            echo "<thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<tr>";
                                echo "<td>" .$row["ngayDat"]."</td>";
                                echo "<td>" .number_format($row["Loinhuan"]) ."</td>";
                                echo "</tr>";
                            }
                            echo "</table></tbody>";
                        }
                        else{
                            echo "data is empty";
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