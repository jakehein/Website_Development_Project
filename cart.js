var checkoutClicked, removeItems, quantity, addToCart, checkout;

window.addEventListener("DOMContentLoaded", function () {
    console.log("in onload"); //remove
    //each item in the cart should have a remove button
    removeItems = document.getElementsByClassName('removeFromCart');
    console.log(removeItems); //remove
    [...removeItems].forEach(createRemoveEventListener);

    //each item in the cart should have the ability to change the number of items being ordered
    quantity = document.getElementsByClassName('cartQuantity');
    [...quantity].forEach(createChangeQuantityEventListener);

    //each item in the menu should have the ability to be added to the cart
    addToCart = document.getElementsByClassName('itemPrice');
    [...addToCart].forEach(createAddToCartEventListener);

    //the cart will need to have a checkout button that can be clicked to end the transaction
    checkout = document.getElementsByClassName('checkout');
    checkout[0].addEventListener('click', checkoutClicked);
});

function createRemoveEventListener(item) {
    item.addEventListener('click', removeCartItem);
}

function createChangeQuantityEventListener(item) {
    item.addEventListener('change', changeQuantity);
}

function createAddToCartEventListener(item) {
    item.addEventListener('click', addToCartClicked);
    console.log("event listener added"); //remove
}

function checkoutClicked() {
    alert('Order Placed.');
    var cartItems = document.getElementsByClassName('cartItems')[0];
    //[...cartItems].forEach(placeOrder);
    placeOrderForm(cartItems);
    //while (cartItems.hasChildNodes()) {
    //    //call method to insert POST statement back to page with hidden inputs

    //    //need to enable this
    //    //placeOrderForm(cartItems);
    //    console.log("item deleted");
    //    console.log(cartItems.firstChild);
    //    cartItems.removeChild(cartItems.firstChild);
    //}
    //updateCartTotal();
}

//var callButton

var placeOrderForm = function (cartItems) {

    var form = document.createElement("form");
    form.method = "POST";
    var cartItemContainer = document.getElementsByClassName('cartItems')[0];
    var cartRowItems = cartItemContainer.getElementsByClassName('cartRowItems');
    console.log("Cart Row Items Prints Out To: " + cartRowItems);
    console.log("Cart Row Items innerHTML: " + cartRowItems.innerHTML);
    console.log("Cart Row Items firstChild: " + cartRowItems.firstChild);
    var transactionTotal = document.createElement("input");
    transactionTotal.value = document.getElementsByClassName('totalPrice')[0].innerHTML;
    transactionTotal.name = "transactionTotal";
    form.appendChild(transactionTotal);

    for (var i = 0; i < cartRowItems.length; i++) {
        var cartRow = cartRowItems[i];


        var itemId = document.createElement("input");
        var idElement = cartRow.getElementsByClassName('cartItemID')[0];
        itemId.value = idElement.innerHTML;
        itemId.name = "itemID[]";
        form.appendChild(itemId);


        var itemPrice = document.createElement("input");
        idElement = cartRow.getElementsByClassName('cartPrice')[0];
        itemPrice.value = idElement.innerHTML;
        itemPrice.name = "itemPrice[]";
        form.appendChild(itemPrice);


        var itemQuantity = document.createElement("input");
        idElement = cartRow.getElementsByClassName('cartQuantity')[0];
        itemQuantity.value = idElement.value;
        itemQuantity.name = "itemQuantity[]";
        form.appendChild(itemQuantity);
    }

    document.body.appendChild(form);
    form.submit();
}

function removeCartItem(event) {
    var remove = event.target;
    //console.log(remove.parentElement.parentElement);
    //console.log(remove.parentElement);
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
    console.log("addedToCartClicked occured"); //remove
    var button = event.target;
    var itemPrice = button.value;
    var itemParent = button.parentElement;
    console.log(itemParent.value + "   value"); //REMOVE
    console.log(itemParent.innerHTML + "   innerHTML");
    var itemParent = button.parentElement.parentElement;//.parentElement;

    console.log(itemParent.value + "   value"); //REMOVE
    console.log(itemParent.innerHTML + "   innerHTML");

    var itemName = itemParent.getElementsByClassName('itemName')[0].innerHTML;
    var itemID = itemParent.getElementsByClassName('itemID')[0].innerHTML;
    //var itemPrice = shopItem.getElementsByClassName('itemPrice').innerHTML;
    addItemToCart(itemID, itemName, itemPrice);
    updateCartTotal();
}

function addItemToCart(itemID, itemName, itemPrice) { //compare itemID and itemPrice
    var cartRow = document.createElement('tr');
    cartRow.classList.add('cartRowItems');
    var cartItems = document.getElementsByClassName('cartItems')[0];
    //var cartItemNames = cartItems.getElementsByClassName('cartItemName');
    var cartItemPrices = document.getElementsByClassName('cartPrice');
    var cartItemIDs = cartItems.getElementsByClassName('cartItemID');
    for (var i = 0; i < cartItemIDs.length; i++) {
        if (cartItemIDs[i].innerHTML == itemID && cartItemPrices[i] == itemPrice) {
                alert('Already added. Try incrementing.');
                return;
            }
    //for (var i = 0; i < cartItemNames.length; i++) {
    //    if (cartItemNames[i].innerHTML == itemName) {
    //        alert('Already added. Try incrementing.');
    //        return;
    //    }
    }

    ///ADD ITEMID TO CART
    var cartRowContents = `
            <td class="cartItemID">${itemID}</td>
            <td class="cartItemName">${itemName}</td>
            <td class="cartPrice">${itemPrice}</td>
            <td><input class="cartQuantity" type="number" value="1"></td>
            <td><button class="removeFromCart" type="button"></button></td>
        `;
    cartRow.innerHTML = cartRowContents;
    cartItems.append(cartRow);
    cartRow.getElementsByClassName('removeFromCart')[0].addEventListener('click', removeCartItem);
    cartRow.getElementsByClassName('cartQuantity')[0].addEventListener('change', changeQuantity/*quantityChanged*/);
}

function updateCartTotal() {
    var cartItemContainer = document.getElementsByClassName('cartItems')[0];
    var cartRows = cartItemContainer.getElementsByClassName('cartRowItems');
    var total = 0;
    for (var i = 0; i < cartRows.length; i++) {
        var cartRow = cartRows[i];
        var priceElement = cartRow.getElementsByClassName('cartPrice')[0];
        var quantityElement = cartRow.getElementsByClassName('cartQuantity')[0];
        console.log(priceElement);
        var price = parseFloat(priceElement.innerHTML.replace('$', ''));
        console.log(price);
        var quantity = quantityElement.value;
        console.log(quantity);
        total = total + (price * quantity);
        console.log("Total: " + total);
    }
    total = Math.round(total * 100) / 100;
    document.getElementsByClassName('totalPrice')[0].innerHTML = '$' + total;
}
