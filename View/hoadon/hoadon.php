<?php
//include_once('..\admin\Header.php');
   //include_once('..\admin\Sidebar.php');
?>
<?php
// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "jimikafe");

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Thực hiện truy vấn
$query = "SELECT product_name, unit_price  FROM product";
$result = mysqli_query($conn, $query);
// Duyệt qua dữ liệu và tạo danh sách options
$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $options .= "<option value='" . $row['unit_price'] . "'>" . $row['product_name'] . "</option>";
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
    <link rel="stylesheet" href="css\cssCreate.css">
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
        .h3 {
            text-align: center;
        }
        .text-content .input-text .textfiel {
            border: 1px solid #000;
            padding-left: 2px;
            font-size: 17px;
            color: #000000;
            height: 30px;
            width: 200px;
        }

        .content {
            margin-top: 77px;
            margin-left: 300px;
            height: auto;
        }

        .them {
            background-color: #FFFFFF;
            margin: 10px 53px 20px;
            padding-left: 20px;
        }

        .form-group {
            margin-top: 5px;
            margin-left: 70px;
        }

        .input-text {
            font-size: 17px;
            color: #000000;
            margin-top: 0 0 0 8px;
        }
        .input-text .textfiel {
            border: 1px solid #000;
            padding-left: 2px;
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
        .table{
            padding-left: 50px;
        }
        .form-group{
            margin-top: 5px;
            margin-left: 70px;
        }
        .input-text{
            font-size: 17px;
            color:#000000;
        }
        .textfiel{
            font-size: 17px; 
            color:#000000;
        }
        /* .form-group{
            margin-top: 35px;
            margin-left: 622px;
        }*/
        #log {
            text-align: center;
            font-style: italic;
            color: red;
            line-height: 20px;
        }
    </style>
</head>

<body class="animsition">
    <div class="content">
        <div style="margin-left: 50px; padding-bottom: 15px; padding-top: 15px; display: inline-block;width: 1100px; height: 60px">
            <h3 style="color: #000000; display: inline-block; font-size: 30px;">Hóa đơn</h3>
        </div>
        <div class="them" >
            <div class="table">
                <form action="" method="post" class="form-content">
                    <div class="input-text">
                        <div class="input-text">
                            <p>Ngày</p>
                            <input type="date" name="date" id="date" class="textfiel">
                        </div>

                        <div class="input-text">
                            <p>Sản phẩm</p>
                            <select id="product-spinner" name="product-spinner" value=""
                                style="height:30px; width:200px;">
                                <?php echo $options; ?>
                            </select>
                        </div>

                        <table id="product-table" style="margin: top 20px; margin-bottom: 30px">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                        <div class="input-text">
                            <p>Tổng tiền</p>
                            <input type="text" disabled name="total_amount" id="total_amount" class="textfiel" readonly>
                        </div>
                        <p id="log"></p>

                        <div class="form-group">
                            <button type="submit" name="btnSave" class="btn btn-outline-success">Lưu</button>
                        </input>
                            <a href="../Mathang/indexMathang.php" class="btn btn-outline-danger">Hủy</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function Product(productName, quantity, price) {
            this.productName = productName;
            this.quantity = quantity;
            this.price = price;
        }
        var productList = [];
        var productTable = document.getElementById("product-table");
        var productSpinner = document.getElementById("product-spinner");
        var total_price = 0;
        productSpinner.addEventListener("change", function () {
            var productPrice = productSpinner.options[productSpinner.selectedIndex].value;
            var productQuantity = 1;
            var productName = productSpinner.options[productSpinner.selectedIndex].text;
            var product = new Product(productName, productQuantity, productPrice);
            var foundProduct = productList.find(function (product) {
                return product.productName === productName;
            });
            if (!foundProduct) {
                productList.push(product);
                var row = productTable.insertRow();
                var nameCell = row.insertCell(0);
                nameCell.innerHTML = productName;
                var quantityCell = row.insertCell(1);
                var inputQuantity = document.createElement("input");
                inputQuantity.type = 'number';
                inputQuantity.id = 'quantity-' + productName;
                inputQuantity.value = productQuantity;
                inputQuantity.addEventListener('change', function () {
                    handleQuantityChange(productName, inputQuantity);
                });
                quantityCell.appendChild(inputQuantity);

                var buttonCell = row.insertCell(2);
                var buttonDelete = document.createElement("button");
                buttonDelete.setAttribute("id", "row-id-" + productName);
                buttonDelete.setAttribute("class", "btn btn-outline-danger delete-button");
                buttonDelete.innerHTML = "-";
                buttonDelete.onclick = function () {
                    handleDeleteRow(product, row);
                };
                buttonCell.appendChild(buttonDelete);

                total_price += (productPrice * productQuantity);
                var totalAmount = document.getElementById("total_amount");
                totalAmount.value = total_price;
            }
        });

        function handleQuantityChange(productName, inputQuantity) {
            var newQuantity = parseInt(inputQuantity.value, 10);
            var foundProduct = productList.find(function (product) {
                return product.productName === productName;
            });

            if (foundProduct) {
                foundProduct.quantity = newQuantity;
            }

            total_price = productList.reduce(function (total, product) {
                return total + product.quantity * parseInt(product.price);
            }, 0);

            var totalAmount = document.getElementById("total_amount");
            totalAmount.value = total_price; // Displaying the total with two decimal places

        }

        function handleDeleteRow(product, row) {
            var productIndex = productList.indexOf(product);
            if (productIndex !== -1) {
                productList.splice(productIndex, 1);
            }
            row.parentNode.removeChild(row);
            total_price -= (product.quantity * product.price);
            var totalAmount = document.getElementById("total_amount");
            totalAmount.value = total_price;
        }

    </script>

    <?php
    function InsertData()
    {
        $conn = mysqli_connect("localhost", "root", "", "jimikafe");
        if ($conn == false) {
            die("connect fial " . mysqli_connect_error($conn));
        } else {
            $id_bill = $_POST['id_bill'];
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];
            $query = "INSERT INTO salaries(id_bill, date, salary, reward, fines, workhours, total) VALUES ('$id_bill','$product_id','$quantity')";
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