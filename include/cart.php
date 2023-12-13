<?php
include("config.php");

$sql = "SELECT id, product_name, quantity, price, total FROM orders WHERE username = '$userId'";
$result = $sqlink->query($sql);

$cartContent ="";

if ($result->num_rows > 0) {
    echo "<h1>Shopping Cart</h1>";
    while ($row = $result->fetch_assoc()) {
        $cartContent .= "<p>{$row['quantity']} x {$row['product_name']} - \${$row['price']} (Total: \${$row['total']})<button onclick=\"updateQuantity({$row['id']}, 1)\">+</button><button onclick=\"updateQuantity({$row['id']}, -1)\">-</button><button onclick=\"removeFromCart({$row['id']})\">Remove</button>
        </p>";
    }
} else {
    echo "<p>Your cart is empty.</p>";
}


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