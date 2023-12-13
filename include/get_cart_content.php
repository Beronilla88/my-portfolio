<?php
include("config.php");

session_start();

if (!isset($_SESSION['username'])) {
    echo "<p>Your cart is empty.</p>";
    exit();
}

$userId = $_SESSION['username'];

$sql = "SELECT id, product_name, quantity, price, total FROM orders WHERE username = '$userId'";
$result = $sqlink->query($sql);

$cartContent = "";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $cartContent .= "***********************************************************************************************
      <p class='cart-item'>
          <span><b>{$row['quantity']} x <i>{$row['product_name']}</i> - \${$row['price']} (Total: \${$row['total']})</span></b>
          <button class='more-btn' onclick=\"updateQuantity({$row['id']}, 1)\">+</button>
          <button class='less-btn' onclick=\"updateQuantity({$row['id']}, -1)\">-</button>
          <button class='remove-btn' onclick=\"removeFromCart({$row['id']})\">Remove</button>
        </p>";
    }
} else {
    $cartContent = "<p class='empty-cart'><i>Your cart is empty.</i></p>";
}

$sqlink->close();

?>
<style>
    .overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    align-items: center;
    justify-content: center;
    
  }

  .popup {
    background-color: rgb(0, 0, 0);
    padding: 0;
    margin: 0;
    border-radius: 5px;
    box-shadow: -10px 0px 20px rgba(13, 98, 255, 0.685), 10px 0px 20px rgba(235, 53, 53, 0.884), 5px 10px 20px rgba(255, 220, 64, 0.884), -5px -10px 20px rgba(255, 220, 64, 0.884);
    position: relative;
    width: 600px;
    height:  400px;
    overflow-y: auto;
    z-index: 2; 
    color: white;
    border-style: double;   



  }
  .popup p.cart-item {
    text-align: left;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    margin-left: 10px;
}

.popup p.cart-item span {
    flex: 1;
}



.popup button {
    margin-left: 5px;
    border-radius: 30px;
    padding: 10px 20px;
    cursor: pointer;
}

.popup button.more-btn {
    background-color: #4CAF50;
    color: white;
}

.popup button.less-btn {
    background-color: #ff4d2d;
    color: white;
}

.popup button.remove-btn {
    background-color: #c72f14;
    color: white;
}

.popup button:hover {
    filter: brightness(90%);
}

.empty-cart {
    text-align: center;
    
}

#ppp {
    font-weight: 1000;
    font-size: 50px;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    margin-top: 30px;
    margin-bottom: 10px;
    text-align: center;
    color: white;

}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
    font-weight:1000;
    font-size: large;
    background-color: #bd1a1a;
    padding-left: 10px;
    padding-right: 10px;
    color: wheat;
  }
  .popup::-webkit-scrollbar {
    width: 5px; 
}

.popup::-webkit-scrollbar-thumb {
      background-color: white;
    border-radius: 20px; 
}

.popup::-webkit-scrollbar-track {
  background-color: rgb(0, 0, 0);


}


</style>
<body>
  <div class="popup">
    <span class="close-btn" onclick="closePopup()">X</span>
    <p style="text-align: center;" id="ppp">Basket</p>
    <?php echo "$cartContent"; ?>
</div>
</body>