<?php
include("config.php");
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: include/login.php");
    exit();
}
$userId = $_SESSION['username'];

$productId = isset($_POST['productId']) ? $_POST['productId'] : null;


$deleteQuery = "DELETE FROM orders WHERE id = $productId AND username = '$userId'";

if ($conn->query($deleteQuery) === TRUE) {
    echo "Product removed from cart successfully!";
} else {
    echo "Error: " . $deleteQuery . "<br>" . $conn->error;
}

$conn->close();
?>