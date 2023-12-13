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
        }
    };
}




function showInfo(containerId, info) {
    const popup = document.getElementById(`info${containerId.charAt(containerId.length - 1)}`);
    popup.textContent = info;
    popup.style.display = 'block';
}

function placeOrder(flexboxName) {
    const orderContainer = document.getElementById('orderContainer');
    const orderItem = document.createElement('div');
    orderItem.textContent = flexboxName;
    orderContainer.appendChild(orderItem);
}

function clearOrders() {
    const orderContainer = document.getElementById('orderContainer');
    if (orderContainer.hasChildNodes()) {
        orderContainer.innerHTML = ''; 
    } else {
        alert("No orders to clear.");
    }
}

function goToAnotherPage() {
    window.location.href = 'walapaeh.html'; 
}

function changeImage() {
const radioButtons = document.querySelectorAll('input[name="drinkType"]');
const image = document.querySelector('.inner-flexbox img');

radioButtons.forEach((radioButton) => {
    radioButton.addEventListener('change', () => {
        if (radioButton.checked) {
            const selectedFlavor = radioButton.value;

            switch (selectedFlavor) {
                case 'COOKIES N CREAM':
                    image.src = 'cookies_n_cream.jpg';
                    break;
                case 'CHOCOLATE':
                    image.src = 'Chocolate.jpg';
                    break;
                case 'BUKO':
                    image.src = 'Buko.jpg';
                    break;
                case 'STRAWBERRY':
                    image.src = 'Strawberry.jpg';
                    break;
                case 'VANILLA':
                    image.src = 'Vanilla.jpg';
                    break;
                case 'SAGO\'T GULAMAN':
                    image.src = 'sago_gulaman.jpg';
                    break;
                case 'PINEAPPLE':
                    image.src = 'pineapple.jpg';
                    break;
                case 'BUKO PANDA':
                    image.src = 'buko_pandan.jpg';
                    break;
                default:
                    console.error(`No matching image for flavor: ${selectedFlavor}`);
                    image.src = 'pitcher.jpg';
            }

            console.log(`Selected flavor: ${selectedFlavor}, Image source: ${image.src}`);
        }
    });
});
}

window.onload = changeImage;


window.onload = changeImage;

