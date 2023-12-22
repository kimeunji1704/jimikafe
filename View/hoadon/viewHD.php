<?php
    include_once('..\admin\Header.php');
    include_once('..\admin\sidebar.php');
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
            width: 100px;
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
<body class="animsition">
<?php
        $id_bill =$_GET['id_bill'];
        $date = "";
        $total_amount = "";
        $conn = mysqli_connect("localhost","root","", "jimikafe");
        if($conn == false){
            die("Connect fail: ". mysqli_connect_error($conn));
        }
        else{
            $query="SELECT bill.id_bill, bill.date, bill.total_amount
            FROM bill
            WHERE bill.id_bill = '$id_bill'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    $id_bill  = $row["id_bill"];
                    $date = $row["date"];
                    $total_amount = $row["total_amount"];
                    $formatted_amount = number_format($total_amount, 2, '.', ',');
                    
                }
            }
            else{
                echo "Data is empty";
            }
        }
    ?>
    <div class="content"> 
        <div style="margin-left: 50px; padding-bottom: 15px; padding-top: 15px; display: inline-block;width: 1169px;">
            <h3 style="color: #000000; display: inline-block; font-size: 30px;">Thông tin chi tiết hóa đơn</h3>
        </div>
            <div class="title-content">
                <form action="" method="post" class="form-content">
                    <div class="text-content">

                        <div class="input-text">
                            <p>Mã hóa đơn</p>
                            <input type="text" id="id_bill" name="id_bill" class="textfiel" style="width: 200px; height: 30px;" value="<?php echo isset($_POST['id_bill']) ? $_POST['id_bill'] : $id_bill ?>" readonly>
                        </div>

                        <div class="input-text">
                            <p>Ngày</p>
                            <input type="date" name="date" class="textfiel" style="width: 200px; height: 30px;" value="<?php echo isset($_POST['date']) ? $_POST['date'] : $date ?>"readonly>
                        </div>

                        
                        <div class="input-text">
                            <p>Tổng tiền</p>
                            <input type="text" name="total_amount" class="textfiel" style="width: 200px; height: 30px;" value="<?php echo isset($_POST['total_amount']) ? $_POST['total_amount'] : $total_amount ?>" readonly>
                        </div>

                        <div class="form-group" style="margin-left: 100px">
                            <a href="indexHD.php" class="btn btn-outline-danger">Quay lại</a>
                            <button id="export" name="export" class="btn btn-outline-primary">Xuất hóa đơn</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
    <?php
        $id_bill =$_GET['id_bill'];
        $id = "";
        $name = "";
        $quantity = "";
        $unit_price = "";
        $total_amount = "";
        $conn = mysqli_connect("localhost","root","", "jimikafe");
        if($conn == false){
            die("Connect fail: ". mysqli_connect_error($conn));
        }
        else{
            $query="SELECT bill_detail.id, product.product_name, bill_detail.quantity, product.unit_price
                    FROM bill_detail
                    JOIN bill ON bill.id_bill = bill_detail.id_bill
                    JOIN product ON product.id = bill_detail.product_id
                    WHERE bill.id_bill = '$id_bill'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result)>0){
                    echo "<table class='table table-hover content'>";
                    echo "<thead>";
                    echo "<th>#</th>";
                    echo "<th>Tên sản phẩm</th>";
                    echo "<th>Số lượng</th>";
                    echo "<th>Giá</th>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["product_name"] . "</td>";
                        echo "<td>" . $row["quantity"] . "</td>";
                        echo "<td>" . number_format($row["unit_price"]) . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
            }
            else{
                echo "Data is empty";
            }
        }
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector("button[name='export']").addEventListener("click", function(event){
                event.preventDefault();
                var idBill = document.getElementById("id_bill").value;
                console.log(idBill);
                $.ajax({
                    url: 'exportHD.php',
                    type: 'POST',
                    data:{id_bill: idBill},
                    success: function(response){
                        console.log(response);
                    }
                });
            });
        });
    </script>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>