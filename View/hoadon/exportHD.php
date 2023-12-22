<?php
    // Connect to the database
    $con = mysqli_connect('localhost', 'root', '', 'jimikafe');
    if (mysqli_connect_errno()) {
        echo 'ConnectFailed: ' . mysqli_connect_error();
        exit;
    }
    // Set the headers for Excel download
    header("Content-Disposition: attachment; filename = hoadon_excel.xlsx");
    header("Content-Type: application/vnd.ms-excel");
	$id_bill = $_POST['id_bill'];
    // Function to sanitize and format data for Excel
    function data($str) {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        return $str; // Return the sanitized string
    }
    // Query to fetch data from the database
    $query = "SELECT product.product_name, bill_detail.quantity, product.unit_price
              FROM bill_detail
              JOIN bill ON bill.id_bill = bill_detail.id_bill
              JOIN product ON product.id = bill_detail.product_id
              WHERE bill_detail.id_bill = '$id_bill'";
    $result = mysqli_query($con, $query);
    // Check if there are rows in the result set
    if (mysqli_num_rows($result) > 0) {
        // Set the field names for Excel
        $field = array('Tên sản phẩm', 'Số lượng', 'Giá');
        $exceldata = implode("\t", array_values($field)) . "\n";
        // Loop through the result set and build the Excel data
        while ($row = mysqli_fetch_assoc($result)) {
            $post_list[] = array(
                'product_name' => $row['product_name'],
                'quantity' => $row['quantity'],
                'unit_price' => $row['unit_price']
            );
        }
        // Output the headers
        echo $exceldata;
        // Output the data
        foreach ($post_list as $post) {
            array_walk($post, 'data');
            echo implode("\t", array_values($post)) . "\n";
        }
        exit;
    } else {
        echo "No data found";
    }
    // Close the database connection
    mysqli_close($con);
?>
