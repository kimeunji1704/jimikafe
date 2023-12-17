<?php
// Include database connection or connection file
include_once('path/to/db-connection-file.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSave'])) {
    // Get form data
    $supplier_id = $_POST['supplier_id'];
    $ingredient_id = $_POST['ingredient_id'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];

    // Validate the data (you can add more validation as needed)
    if (empty($supplier_id) || empty($ingredient_id) || empty($quantity) || empty($date)) {
        echo "Please fill in all the required fields.";
    } else {
        // Insert data into the database
        $query = "INSERT INTO stock_entries (supplier_id, ingredient_id, quantity, date) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, 'iiis', $supplier_id, $ingredient_id, $quantity, $date);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Stock entry added successfully.";
        } else {
            echo "Error adding stock entry: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!-- Your HTML form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your head content here -->
</head>
<body>
    <form action="" method="post">
        <label for="supplier_id">Supplier ID:</label>
        <input type="text" name="supplier_id" required><br>

        <label for="ingredient_id">Ingredient ID:</label>
        <input type="text" name="ingredient_id" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required><br>

        <label for="date">Date:</label>
        <input type="date" name="date" required><br>

        <button type="submit" name="btnSave">Save</button>
    </form>
</body>
</html>
