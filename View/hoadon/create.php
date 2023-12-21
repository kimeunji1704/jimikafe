<?php
$conn = mysqli_connect("localhost", "root", "", "jimikafe");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$date = $_POST['date'];
$idVoucher = empty($_POST['idVoucher']) ? 1 : intval($_POST['idVoucher']);
$total_price = intval($_POST['total_price']);
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

$queryAddBill = "INSERT INTO `bill`(`id_bill`, `voucher_id`, `total_amount`, `date`) VALUES (0, '$idVoucher', '$total_price', '$date')";
$resultAddBill = mysqli_query($conn, $queryAddBill);

if ($resultAddBill) {
    $lastInsertedId = mysqli_insert_id($conn);

    foreach ($productList as $product) {
        $productId = getIdProduct($product['productName']);
        $quantity = intval($product['quantity']);

        $queryAddDetailBill = "INSERT INTO `bill_detail`(`id`, `id_bill`, `product_id`, `quantity`) VALUES (0, '$lastInsertedId', '$productId', '$quantity')";
        $resultAddDetailBill = mysqli_query($conn, $queryAddDetailBill);

        if (!$resultAddDetailBill) {
            echo 400;
            exit;  // Exit the script if detail insertion fails
        }
    }

    echo 200;
} else {
    echo 400;
}

function getIdProduct($productName)
{
    $dashPosition = strpos($productName, "-");

    if ($dashPosition !== false) {
        $number = substr($productName, 0, $dashPosition);
        return $number;
    }

    return null;  // Or handle the case where the dash is not found
}

mysqli_close($conn);
?>