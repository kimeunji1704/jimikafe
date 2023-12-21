<?php
$conn = mysqli_connect("localhost", "root", "", "jimikafe");

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

$date = $_POST['date'];
$idVoucher = empty($_POST['idVoucher']) ? 1 : $_POST['idVoucher'];
$total_price = $_POST['total_price'];
$productList = json_decode($_POST['productList'], true);

class Product
{
    public $productName;
    public $quantity;
    public $price;

    // Constructor
    public function __construct($productName, $quantity, $price)
    {
        $this->productName = $productName;
        $this->quantity = $quantity;
        $this->price = $price;
    }

}

$queryAddBill = "INSERT INTO `bill`(`id_bill`, `voucher_id`, `total_amount`, `date`) VALUES (0,'" . $idVoucher . "','" . $total_price . "','" . $date . "')";
$resultAddBill = mysqli_query($conn, $queryAddBill);
// $product = new Product("", -1, -1);
// if ($resultAddCategory) {
//     $queryGetIdBill = "SELECT TOP 1 id_bill FROM bill ORDER BY id_bill DESC";
//     $resultGetBill = mysqli_query($conn, $queryGetIdBill);
//     while ($row = mysqli_fetch_assoc($resultGetBill)) {
//         foreach ($productList as $product) {
//             $queryAddDetailBill = "INSERT INTO `bill_detail`(`id`, `id_bill`, `product_id`, `quantity`) VALUES (0,'" . $row["id_bill"] . "','" . getIdProduct($product . $product_name) . "','" . $product . $quantity . "')";
//             $resultAddDetailBill = mysqli_query($conn, $queryAddDetailBill);
//         }
//     }
// }

function getIdProduct($str)
{
    $dashPosition = strpos($str, "-");

    if ($dashPosition !== false) {
        $number = substr($str, 0, $dashPosition);
        echo $number;
    }
}
$conn->close();
echo 'True';
?>