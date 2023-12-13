<?php include("config.php");
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$userId = $_SESSION['username'];

$product_name = $_POST['product_name'];
$quantity = $_POST['quantity'];

$productQuery = "SELECT product_name, price FROM products WHERE id = $product_name";
$productResult = $sqlink->query($productQuery);

if ($productResult->num_rows > 0) {
    $productData = $productResult->fetch_assoc();
    $productName = $productData['product_name'];
    $price = $productData['price'];


    $total = $price * $quantity;


    $insertQuery = "INSERT INTO orders (product_name, quantity, price, total, username)
                    VALUES ('$productName', $quantity, $price, $total, '$userId')";

    if ($sqlink->query($insertQuery) === TRUE) {
        echo "Product added to cart successfully!";
        echo "<script>window.location.href = 'cart.php';</script>";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $sqlink->error;
    }
} else {
    echo "Product not found!";
}


$sqlink->close();
?>