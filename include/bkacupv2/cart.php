<?php
include("config.php");
$userIdInCart = $_SESSION['username'];
// Retrieve items from the cart
$sql = "SELECT id, product_name, quantity, price, total FROM orders WHERE username = '$userIdInCart'";
$result = $sqlink->query($sql);

$cartContent ="";
// Display the items in the cart
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cartContent .= "<p>{$row['quantity']} x {$row['product_name']} - \${$row['price']} (Total: \${$row['total']})<button onclick=\"updateQuantity({$row['id']}, 1)\">+</button><button onclick=\"updateQuantity({$row['id']}, -1)\">-</button><button onclick=\"removeFromCart({$row['id']})\">Remove</button>
        </p>";
    }
} else {
    $cartContent = "<p>Your cart is empty.</p>";
}

// Close the database connection
$sqlink->close();
?>

<script>
    function updateQuantity(productId, quantityChange) {
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_quantity.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.send("productId=" + productId + "&quantityChange=" + quantityChange);

        
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                
                location.reload();
            }
        };
    }

    function removeFromCart(productId) {
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "remove_from_cart.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.send("productId=" + productId);

        
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                
                location.reload();
            }
        };
    }
</script>