checkoutClickedvar removeItems, quantity, addToCart, checkout;

window.onload = function () {

    //each item in the cart should have a remove button
    removeItems = document.getElementsByClassName('removeFromCart');
    removeItems.forEach(createRemoveEventListener);

    //each item in the cart should have the ability to change the number of items being ordered
    quantity = document.getElementsByClassName('cartQuantity')
    quantity.forEach(createChangeQuantityEventListener);

    //each item in the menu should have the ability to be added to the cart
    addToCart = document.getElementsByClassName('itemPrice');
    addToCart.forEach(createAddToCartEventListener);

    //the cart will need to have a checkout button that can be clicked to end the transaction
    checkout = document.getElementsByClassName('checkout');
    checkout.addEventListener('click', checkoutClicked);
}

function createRemoveEventListener(item) {
    item.addEventListener('click', removeCartItem);
}

function createChangeQuantityEventListener(item) {
    item.addEventListener('change', changeQuantity);
}

function createAddToCartEventListener(item) {
    item.addEventListener('click', addToCartClicked);
}

///CONTINUE FROM HERE
function purchaseClicked() {
    alert('Order Placed.');
    var cartItems = document.getElementsByClassName('cartItems');
    cartItems.forEach(placeOrder);
    //while (cartItems.hasChildNodes()) {
    //    cartItems.removeChild(cartItems.firstChild);
    //}
    updateCartTotal();
}

var placeOrder = function(item) {
    var itemChild = item.firstChild;
    //add each item to the order here
    //remove item from cart
    item.removeChild(itemChild);
}

function removeCartItem(event) {
    var remove = event.target;
    remove.parentElement.parentElement.remove();
    updateCartTotal();
}

function changeQuantity(event) {
    var input = event.target;
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1;
    }
    updateCartTotal();
}

function addToCartClicked(event) {
    var button = event.target;
    var itemPrice = button.value;
    var itemParent = button.parentElement;//.parentElement;
    var itemName = itemParent.getElementsByClassName('itemName').innerHTML;
    //var itemPrice = shopItem.getElementsByClassName('itemPrice').innerHTML;
    addItemToCart(itemName, itemPrice);
    updateCartTotal();
}

function addItemToCart(itemName, itemPrice) {
    var cartRow = document.createElement('div');
    cartRow.classList.add('cartRow');
    var cartItems = document.getElementsByClassName('cartItems');
    var cartItemNames = cartItems.getElementsByClassName('cartItemName');
    for (var i = 0; i < cartItemNames.length; i++) {
        if (cartItemNames[i].innerHTML == title) {
            alert('Already added. Try incrementing.');
            return;
        }
    }
    var removeImg = new Image();
    removeImg.src = "images/invalid.png";
    var cartRowContents = `
        <div class="cartItem cartColumn">
            <span class="cartItemName">${itemName}</span>
        </div>
        <span class="cartPrice cartColumn">${itemPrice}</span>
        <div class="cartQuantity cartColumn">
            <input class="cartQuantity" type="number" value="1">
            <button class="removeFromCart" type="button">${removeImg}</button>
        </div>`;
    cartRow.innerHTML = cartRowContents;
    cartItems.append(cartRow);
    cartRow.getElementsByClassName('removeFromCart').addEventListener('click', removeCartItem);
    cartRow.getElementsByClassName('cartQuantity').addEventListener('change', quantityChanged);
}

function updateCartTotal() {
    var cartItemContainer = document.getElementsByClassName('cartItems');
    var cartRows = cartItemContainer.getElementsByClassName('cartRow');
    var total = 0;
    for (var i = 0; i < cartRows.length; i++) {
        var cartRow = cartRows[i];
        var priceElement = cartRow.getElementsByClassName('cart-price');
        var quantityElement = cartRow.getElementsByClassName('cartQuantity');
        var price = parseFloat(priceElement.innerHTML.replace('$', ''));
        var quantity = quantityElement.value;
        total = total + (price * quantity);
    }
    total = Math.round(total * 100) / 100;
    document.getElementsByClassName('totalPrice').innerHTML = '$' + total;
}
