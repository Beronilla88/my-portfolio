<?php include("config.php");
// Get the product ID and quantity from the AJAX request
$product_name = $_POST['product_name'];
$quantity = $_POST['quantity'];

// Retrieve product details
$productQuery = "SELECT product_name, price FROM products WHERE id = $product_name";
$productResult = $sqlink->query($productQuery);

if ($productResult->num_rows > 0) {
    $productData = $productResult->fetch_assoc();
    $productName = $productData['product_name'];
    $price = $productData['price'];

    // Calculate the total price
    $total = $price * $quantity;

    // Insert the product into the orders table
    $insertQuery = "INSERT INTO orders (product_name, quantity, price, total)
                    VALUES ('$productName', $quantity, $price, $total)";

    if ($sqlink->query($insertQuery) === TRUE) {
        echo "Product added to cart successfully!";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $sqlink->error;
    }
} else {
    echo "Product not found!";
}

// Close the database connection
$sqlink->close();
?>