<?php
include("config.php");
// Retrieve items from the cart
$sql = "SELECT id, product_name, quantity, price, total FROM orders";
$result = $sqlink->query($sql);

$cartContent ="";

// Display the items in the cart
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cartContent .= "<p>{$row['quantity']} x {$row['product_name']} - \${$row['price']} (Total: \${$row['total']})</p>";

    }
} else {
    $cartContent = "<p>Your cart is empty.</p>";
}

// Close the database connection
$sqlink->close();
?>