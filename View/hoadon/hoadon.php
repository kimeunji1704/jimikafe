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

// Thực hiện truy vấn
$query = "SELECT id, product_name, unit_price  FROM product";
$result = mysqli_query($conn, $query);
// Duyệt qua dữ liệu và tạo danh sách options
$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $options .= "<option value='" . $row['unit_price'] . "'>" . $row["id"] . "-" . $row['product_name'] . "</option>";
}

function checkDateInRange($startDate, $endDate)
{
    $currentDate = new DateTime();
    $startDateObj = DateTime::createFromFormat('Y-m-d', $startDate);
    $endDateObj = DateTime::createFromFormat('Y-m-d', $endDate);

    if ($startDateObj && $endDateObj) {
        // Đảm bảo ngày bắt đầu nhỏ hơn ngày kết thúc
        if ($startDateObj < $endDateObj) {
            return ($currentDate > $startDateObj) && ($currentDate < $endDateObj);
        } else {
            // Ngày bắt đầu không nhỏ hơn ngày kết thúc
            return false;
        }
    } else {
        // Định dạng ngày không hợp lệ
        return false;
    }
}

$queryCoupon = "SELECT id, discount, startime, endtime FROM voucher";
$resultCoupon = mysqli_query($conn, $queryCoupon);

$optionsCoupon = "";
while ($rowCoupon = mysqli_fetch_assoc($resultCoupon)) {
    if (checkDateInRange($rowCoupon["startime"], $rowCoupon["endtime"])) {
        $optionsCoupon .= "<option value='" . $rowCoupon['id'] . "'>" . $rowCoupon['discount'] . "</option>";
    }
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

        .text-content {
            font-size: 17px;
            color: #000000;
            padding-left: 20px;
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
        <div style="margin-left: 50px; padding-bottom: 15px; padding-top: 15px; display: inline-block;width: 1169px;">
            <h3 style="color: #000000; display: inline-block; font-size: 30px;">Hóa đơn</h3>
        </div>
        <div class="them">
            <div class="table">
                <form action="" method="post" class="form-content">
                    <div class="text-content">
                        <div class="input-text">
                            <p>Ngày</p>
                            <input type="date" name="date" id="date" placeholder="dd-MM-yyyy" class="textfiel">
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
                            <p>Khuyến mãi (%)</p>
                            <select name="coupon-spinner" id="coupon-spinner" style="height:30px; width:200px;">
                                <?php echo $optionsCoupon; ?>
                            </select>
                        </div>

                        <div class="input-text">
                            <p>Tổng tiền</p>
                            <input type="text" disabled name="total_amount" id="total_amount" class="textfiel" readonly>
                        </div>

                        <div class="form-group">
                            <button style="margin-left: 650px;" type="submit" id="save_bill" name="btnSave"
                                class="btn btn-outline-success"><i class="fa fa-plus"></i>Thêm</button>
                            <a href="indexHD.php" class="btn btn-outline-danger">Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var productList = [];
            var productTable = document.getElementById("product-table");
            var productSpinner = document.getElementById("product-spinner");
            var couponSpinner = document.getElementById("coupon-spinner");
            var total_price = 0;
            var products_price = 0;
            var discount = 0;
            var priceDiscount = 0;
            var firstClick = true;

            function Product(productName, quantity, price) {
                this.productName = productName;
                this.quantity = quantity;
                this.price = price;
            }

            couponSpinner.addEventListener("click", function () {
                if (firstClick == false) {
                    discount = couponSpinner.options[couponSpinner.selectedIndex].text;
                    updateTotalPrice();
                    firstClick = true;
                } else {
                    firstClick = false;
                }
            });

            productSpinner.addEventListener("change", function () {
                var productPrice = parseFloat(productSpinner.options[productSpinner.selectedIndex].value);
                var productName = productSpinner.options[productSpinner.selectedIndex].text;

                var product = new Product(productName, 1, productPrice);

                var foundProduct = productList.find(function (p) {
                    return p.productName === productName;
                });

                if (!foundProduct) {
                    productList.push(product);
                    addProductRow(product);
                    updateTotalPrice();
                }
            });

            function addProductRow(product) {
                var row = productTable.insertRow();
                var nameCell = row.insertCell(0);
                nameCell.innerHTML = product.productName;

                var quantityCell = row.insertCell(1);
                var inputQuantity = document.createElement("input");
                inputQuantity.type = 'number';
                inputQuantity.value = product.quantity;
                inputQuantity.addEventListener('change', function () {
                    handleQuantityChange(product, inputQuantity);
                });
                quantityCell.appendChild(inputQuantity);

                var buttonCell = row.insertCell(2);
                var buttonDelete = document.createElement("button");
                buttonDelete.setAttribute("class", "btn btn-outline-danger delete-button");
                buttonDelete.innerHTML = "-";
                buttonDelete.onclick = function () {
                    handleDeleteRow(product, row);
                };
                buttonCell.appendChild(buttonDelete);

                products_price += (product.price * product.quantity);
            }

            function handleQuantityChange(product, inputQuantity) {
                var newQuantity = parseInt(inputQuantity.value, 10);
                product.quantity = newQuantity;
                updateTotalPrice();
            }

            function handleDeleteRow(product, row) {
                var productIndex = productList.indexOf(product);
                if (productIndex !== -1) {
                    productList.splice(productIndex, 1);
                }
                row.parentNode.removeChild(row);
                updateTotalPrice();
            }

            function updateTotalPrice() {
                var totalAmount = document.getElementById("total_amount");
                total_price = products_price;

                if (discount > 0) {
                    priceDiscount = total_price * (discount / 100);
                    total_price -= priceDiscount;
                }

                totalAmount.value = total_price;
            }

            function sendBillData(date, idVoucher, total_price, productList) {
                $.ajax({
                    url: 'create.php',
                    type: 'POST',
                    data: { date: date, idVoucher: idVoucher, total_price: total_price, productList: JSON.stringify(productList) },
                    success: function (response) {
                        if (response == 200) {
                            window.location.href = 'indexHD.php';
                        } else {
                            console.log("Failed to add bill.");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            document.querySelector("button[name='btnSave']").addEventListener("click", function (event) {
                event.preventDefault();
                var date = document.getElementById("date").value;
                var idVoucher = couponSpinner.options[couponSpinner.selectedIndex].value;
                var total_price_input = document.getElementById("total_amount");
                var total_price_value = total_price_input.value;
                sendBillData(date, idVoucher, total_price_value, productList);
            });
        });
    </script>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>

</html>