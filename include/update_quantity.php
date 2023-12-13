<?php 
include("config.php");
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: include/login.php");
    exit();
}
$userId = $_SESSION['username'];

$productId = isset($_POST['productId']) ? $_POST['productId'] : null;
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
$quantityChange = isset($_POST['quantityChange']) ? $_POST['quantityChange'] : null;

$sql = "SELECT id, product_name, quantity, price, total FROM orders WHERE id = $productId AND username = '$userId'";
$result = $sqlink->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentQuantity = $row['quantity'];

    $updatedQuantity = $currentQuantity + $quantityChange;
    if ($updatedQuantity < 1) {
  
        $deleteQuery = "DELETE FROM orders WHERE id = $productId AND username = '$userId'";

        if ($sqlink->query($deleteQuery) === TRUE) {
            echo "Product removed from cart successfully!";
        } else {
            echo "Error: " . $deleteQuery . "<br>" . $sqlink->error;
        }
    } else {
        $updateQuery = "UPDATE orders SET quantity = $updatedQuantity, total = price * $updatedQuantity WHERE id = $productId AND username = '$userId'";

        if ($sqlink->query($updateQuery) === TRUE) {
            echo "Product quantity updated successfully!";
        } else {
            echo "Error: " . $updateQuery . "<br>" . $sqlink->error;
        }
    }
} else {
    echo "Product not found!";
}

$sqlink->close();
?>