<!DOCTYPE html>
<html lang="en">

<?php include("include/config.php");

?>
<?php

session_start();

if (!isset($_SESSION['username'])) {

    header("Location: include/login.php");
    exit();
}

$userId = $_SESSION['username'];

$sql = "SELECT id, product_name, quantity, price, total FROM orders WHERE username = '$userId'";
$result = $sqlink->query($sql);

$cartContent ="";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cartContent .= "<p>{$row['quantity']} x {$row['product_name']} - \${$row['price']} (Total: \${$row['total']})<button onclick=\"updateQuantity({$row['id']}, 1)\">+</button><button onclick=\"updateQuantity({$row['id']}, -1)\">-</button><button onclick=\"removeFromCart({$row['id']})\">Remove</button>
        </p>";
    }
} else {
    $cartContent = "Your cart is empty.";
}


$sqlink->close();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="images/is.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="include/iss.js" async></script>
</head>
<body>
    
<div id="picpic">

    <div id="pangalawangpic">
        <img src="images/two.png" id="two"> 
    </div>

    <div id="unangpic">
        <img src="images/kk.jpg" id="kk">  
    </div>
        <div id="divso">
            <a href="include/logout.php" class="btn btn-danger ml-3" id="signout">Sign Out</a>
        </div>
</div>

<div id="tatlopic">
        <a href="#" onclick="openPopup()">
            <img src="images/shopping-bag.png" alt="shopping cart">
        </a>
    </div>

<div class="overlay" id="overlay">
  <div class="popup">
        <span class="close-btn" onclick="closePopup()">X</span>
        <h2 style="text-align: center;">Basket</h2>
        <p>Some orders</p>
        <?php echo "$cartContent"; ?>
  </div>
</div>


    <div class="main-container">
        <div class="main-header">
            <h2>DEEP FRIED STREETS FOODS</h2>
        </div>
        <div class="main-flexbox">
            <div class="inner-flexbox" id="flexbox1">
                    <div id="flexboxone">
                     <div id="flip1">
                            <img src="images/382957533_1371155866847053_2497019350538027055_n.jpg" alt="Image 1" class="classimg">
                            <div class="pall">  
                            <p> Chicken Skin </p>
                            </div>
                      </div>
                     </div>
                     <div class="description" id="description1">
                        <p>The golden, crispy cloak of poultry perfection.</p>
                        <p class="star">Ratings: ✬✬✬✬✬</p>
                    </div>
                    <button onclick="addToCart(1)" class="pobt"> PLACE ORDER </button>
            </div>

            <div class="inner-flexbox" id="flexbox2">
                <div id="flexboxone">
                 <div id="flip1">
                    <img src="images/400790501_728898069269440_7520585297423651191_n.jpg" alt="Image 2" class="classimg">
                    <p> Proben </p>
                  </div>
                 </div>
                 <div class="description" id="description1">
                    <p>Chicken's way of proving it can be snack-sized.</p>
                    <p class="star">Ratings: ✬✬✬✬✬</p>
                </div>
                <button onclick="addToCart(4)" class="pobt"> PLACE ORDER </button>
            </div>

            <div class="inner-flexbox" id="flexbox3">
                <div id="flexboxone">
                 <div id="flip1">
                    <img src="images/405502450_2994909200651034_5685738846256604314_n.jpg" alt="Image 3" class="classimg">
                    <p> Kwek Kwek</p>
                  </div>
                 </div>
                 <div class="description" id="description1">
                    <p>Quail eggs dressed up for a crispy carnival.</p>
                    <p class="star">Ratings: ✬✬✬✬✬</p>
                </div>
                <button onclick="addToCart(5)" class="pobt"> PLACE ORDER </button>
            </div>

            <div class="inner-flexbox" id="flexbox4">
                <div id="flexboxone">
                 <div id="flip1">
                    <img src="images/kikiam.jpg" alt="Image 4" class="classimg">
                    <p> Kikiam </p>
                  </div>
                 </div>
                 <div class="description" id="description1">
                    <p>The mysterious log that knows all the right rolls.</p>
                    <p class="star">Ratings: ✬✬✬✬✬</p>
                </div>
                <button onclick="addToCart(6)" class="pobt"> PLACE ORDER </button>
            </div>
    
            <div class="inner-flexbox" id="flexbox5">
                <div id="flexboxone">
                 <div id="flip1">
                    <img src="images/cheesestick.jpg" alt="Image 1" class="classimg">
                    <p> Cheese Stick </p>
                  </div>
                 </div>
                 <div class="description" id="description1">
                    <p>Dairy's daring escape into the deep fryer.</p>
                    <p class="star">Ratings: ✬✬✬✬✬</p>
                </div>
                <button onclick="addToCart(7)" class="pobt"> PLACE ORDER </button>
            </div>

            <div class="inner-flexbox" id="flexbox6">
                <div id="flexboxone">
                 <div id="flip1">
                    <img src="images/Fish-Balls.png" alt="Image 2" class="classimg">
                    <p> Fish Balls </p>
                  </div>
                 </div>
                 <div class="description" id="description1">
                    <p>Bouncy spheres of aquatic joy.</p>
                    <p class="star">Ratings: ✬✬✬✬✬</p>
                </div>
                <button onclick="addToCart(8)" class="pobt"> PLACE ORDER </button>
            </div>

            <div class="inner-flexbox" id="flexbox7">
                <div id="flexboxone">
                 <div id="flip1">
                    <img src="images/squid-balls.png" alt="Image 3" class="classimg">
                    <p> Squid Balls</p>
                  </div>
                 </div>
                 <div class="description" id="description1">
                    <p>The ocean's answer to meatballs, cephalopod style.</p>
                    <p class="star">Ratings: ✬✬✬✬✬</p>
                </div>
                <button onclick="addToCart(9)" class="pobt"> PLACE ORDER </button>
            </div>

            <div class="inner-flexbox" id="flexbox8">
                <div id="flexboxone">
                 <div id="flip1">
                    <img src="images/fries.jpg" alt="Image 4" class="classimg">
                    <p> Fries </p>
                  </div>
                 </div>
                 <div class="description" id="description1">
                    <p>Potato soldiers marching into golden battle.</p>
                    <p class="star">Ratings: ✬✬✬✬✬</p>
                </div>
                <button onclick="addToCart(10)" class="pobt"> PLACE ORDER </button>
            </div>

            <div class="inner-flexbox" id="flexbox9">
                <div id="flexboxone">
                 <div id="flip1">
                    <img src="images/calamares.jpg" alt="Image 4" class="classimg">
                    <p> Calamares </p>
                  </div>
                 </div>
                 <div class="description" id="description1">
                    <p>Squid doing the tango with a crunchy coat.</p>
                    <p class="star">Ratings: ✬✬✬✬✬</p>
                </div>
                <button onclick="addToCart(11)" class="pobt"> PLACE ORDER </button>
            </div>

            
        </div>
    </div>

    <div class="main-container">
        <div class="main-header">
            <h2>BBQ IHAW STREET FOODS</h2>
        </div>
        <div class="main-flexbox">
            <div class="inner-flexbox" id="flexbox10">
                    <div id="flexboxone">
                     <div id="flip1">
                            <img src="images/Betamax.jpg" alt="Image 1" class="classimg">
                            <div class="pall">  
                            <p> Betamax </p>
                            </div>
                      </div>
                     </div>
                     <div class="description" id="description1">
                        <p>Blood sticks, making you the director of your grill show.</p>
                        <p class="star">Ratings: ✬✬✬✬✬</p>
                    </div>
                    <button onclick="addToCart(12)" class="pobt"> PLACE ORDER </button>
            </div>

            <div class="inner-flexbox" id="flexbox11">
                <div id="flexboxone">
                 <div id="flip1">
                    <img src="images/385530704_879938713780827_2732780270684417422_n.png" alt="Image 2" class="classimg">
                    <p> Isaw Chicken </p>
                  </div>
                 </div>
                 <div class="description" id="description1">
                    <p>Chicken on a stick, with a twist of skewered sass.</p>
                    <p class="star">Ratings: ✬✬✬✬✬</p>
                </div>
                <button onclick="addToCart(13)" class="pobt"> PLACE ORDER </button>
            </div>

            <div class="inner-flexbox" id="flexbox12">
                <div id="flexboxone">
                 <div id="flip1">
                    <img src="images/isawpork.jpg" alt="Image 3" class="classimg">
                    <p> Isaw Pork </p>
                  </div>
                 </div>
                 <div class="description" id="description1">
                    <p>Pork skewers that make you go hog-wild.</p>
                    <p class="star">Ratings: ✬✬✬✬✬</p>
                </div>
                <button onclick="addToCart(14)" class="pobt"> PLACE ORDER </button>
            </div>

            <div class="inner-flexbox" id="flexbox13">
                <div id="flexboxone">
                 <div id="flip1">
                    <img src="images/tenga.jpg" alt="Image 4" class="classimg">
                    <p> Tenga </p>
                  </div>
                 </div>
                 <div class="description" id="description1">
                    <p>Piggy ears, because every barbecue needs a good listener.</p>
                    <p class="star">Ratings: ✬✬✬✬✬</p>
                </div>
                <button onclick="addToCart(15)" class="pobt"> PLACE ORDER </button>
            </div>
    
            <div class="inner-flexbox" id="flexbox14">
                <div id="flexboxone">
                 <div id="flip1">
                    <img src="images/paa.jpg" alt="Image 1" class="classimg">
                    <p> Adidas </p>
                  </div>
                 </div>
                 <div class="description" id="description1">
                    <p>Chicken feet, strutting their stuff on the grill runway.</p>
                    <p class="star">Ratings: ✬✬✬✬✬</p>
                </div>
                <button onclick="addToCart(16)" class="pobt"> PLACE ORDER </button>
            </div>

            <div class="inner-flexbox" id="flexbox15">
                <div id="flexboxone">
                 <div id="flip1">
                    <img src="images/helmet.jpg" alt="Image 2" class="classimg">
                    <p> Helmet </p>
                  </div>
                 </div>
                 <div class="description" id="description1">
                    <p>Head-turning grilled goodness, no need for a helmet!</p>
                    <p class="star">Ratings: ✬✬✬✬✬</p>
                </div>
                <button onclick="addToCart(17)" class="pobt"> PLACE ORDER </button>
            </div>

            <div class="inner-flexbox" id="flexbox16">
                <div id="flexboxone">
                 <div id="flip1">
                    <img src="images/balonan.jpg" alt="Image 3" class="classimg">
                    <p>BALON-BALONAN</p>
                  </div>
                 </div>
                 <div class="description" id="description1">
                    <p>Grilled gizzards burst with flavors, turning every bite into a tasty party!</p>
                    <p class="star">Ratings: ✬✬✬✬✬</p>
                </div>
                <button onclick="addToCart(18)" class="pobt"> PLACE ORDER </button>
            </div>

            <div class="inner-flexbox" id="flexbox17">
                <div id="flexboxone">
                 <div id="flip1">
                    <img src="images/atay.jpg" alt="Image 4" class="classimg">
                    <p> Atay </p>
                  </div>
                 </div>
                 <div class="description" id="description1">
                    <p>Chicken liver, the small but mighty knight of the grill castle.</p>
                    <p class="star">Ratings: ✬✬✬✬✬</p>
                </div>
                <button onclick="addToCart(19)" class="pobt"> PLACE ORDER </button>
            </div>

            <div class="inner-flexbox" id="flexbox18">
                <div id="flexboxone">
                 <div id="flip1">
                    <img src="images/laman.png" alt="Image 4" class="classimg">
                    <p> BBQ Laman </p>
                  </div>
                 </div>
                 <div class="description" id="description1">
                    <p>Skewers that are the meaty protagonists of your grill story.</p>
                    <p class="star">Ratings: ✬✬✬✬✬</p>
                </div>
                <button onclick="addToCart(20)" class="pobt"> PLACE ORDER </button>
            </div>

            
        </div>
    </div>
    <script>
        
function openPopup() {
    document.getElementById('overlay').style.display = 'flex';
    document.body.style.overflow = 'hidden';
    updatePopupContent();
}

function closePopup() {
    document.getElementById('overlay').style.display = 'none';
    document.body.style.overflow = 'auto';
}
  
        //
function updatePopupContent() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "include/get_cart_content.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('overlay').innerHTML = xhr.responseText;
        }
    };

    xhr.send();
}

//
function addToCart(product_name) {
    // Use AJAX to send the product ID to the server
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "include/add_to_cart.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var quantity = prompt("Enter quantity:", 1);

    xhr.send("product_name=" + product_name + "&quantity=" + quantity);

    // Handle the response if needed
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response from the server
            console.log(xhr.responseText);
            location.reload();
        }
    };
}
//
    function updateQuantity(productId, quantityChange) {
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "include/update_quantity.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.send("productId=" + productId + "&quantityChange=" + quantityChange);

        
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                
                updatePopupContent();
            }
        };
    }

    function removeFromCart(productId) {
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "include/update_quantity.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.send("productId=" + productId + "&quantityChange=" + -99999);

        
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                
                updatePopupContent();
            }
        };
    }


</script>
</body>
</html>