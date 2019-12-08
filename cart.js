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
    while (cartItems.hasChildNodes()) {
        //call method to insert POST statement back to page with hidden inputs

        //need to enable this
        //placeOrderForm(cartItems);
        console.log("item deleted");
        console.log(cartItems.firstChild);
        cartItems.removeChild(cartItems.firstChild);
    }
    updateCartTotal();
}
//WORKING ON THIS
var placeOrderForm = function(cartItems) {
    //STR_part(1)
    var formHeader = `<form action="lab7.php" class="CHANGE ME" id="INSERT SOMETHING ELSE" method="POST">`;

    while(/*cartItems has children or something like that*/) {
    //STR_part(2)...3...4...(N-1)
        var formBody += `
            <input type="hidden" class="" name="itemID[]" value=${itemID}>
            <input type="hidden" class="" name="itemName[]" value=${itemName}>
            <input type="hidden" class="" name="itemPrice[]" value=${itemPrice}>
            <input type="hidden" class="" name="itemQuantity[]" value=${itemQuantity}>
            `;
    }
    //STR_part(N)
    var formFooter = `
        <input type="submit" id="submit">
        </form>`; //INPUT HAD </BUTTON> TAG, NEEDED???

    //<form action="lab7.php" class="button" id="gameForm" method="POST">
    //    <input type="hidden" class="hiddenGameValues" name="game[]" value=<?=$game[0]?>>
    //    <input type="hidden" class="hiddenGameValues" name="game[]" value=<?=$game[1]?>>
    //    <input type="hidden" class="hiddenGameValues" name="game[]" value=<?=$game[2]?>>
    //    <input type="hidden" class="hiddenGameValues" name="game[]" value=<?=$game[3]?>>
    //    <input type="hidden" class="hiddenGameValues" name="game[]" value=<?=$game[4]?>>
    //    <input type="hidden" class="hiddenGameValues" name="game[]" value=<?=$game[5]?>>
    //    <input type="hidden" class="hiddenGameValues" name="totalCorrect" value=<?=$totalCorrect?>>
    //    <input type="hidden" class="hiddenGameValues" name="highScore" value=<?=$highScore?>>
    //    <input type="submit" id="newGame" value="New Game"></button>
    //</form>

    //var itemChild = item.firstChild;
    //add each item to the order here
    //remove item from cart
    //item.removeChild(itemChild);
}

function removeCartItem(event) {
    var remove = event.target;
    remove.parentElement.parentElement.parentElement.remove();
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
    var itemParent = button.parentElement.parentElement;//.parentElement;
    //console.log(itemParent.value + "   value"); //REMOVE
    //console.log(itemParent.innerHTML + "   innerHTML");
    var itemName = itemParent.getElementsByClassName('itemName')[0].innerHTML;
    var itemID = itemParent.getElementsByClassName('itemID')[0].innerHTML;
    //var itemPrice = shopItem.getElementsByClassName('itemPrice').innerHTML;
    addItemToCart(itemID, itemName, itemPrice);
    updateCartTotal();
}

function addItemToCart(itemID, itemName, itemPrice) { //compare itemID and itemPrice
    var cartRow = document.createElement('div');
    cartRow.classList.add('cartRow');
    var cartItems = document.getElementsByClassName('cartItems')[0];
    //var cartItemNames = cartItems.getElementsByClassName('cartItemName');
    var cartItemPrices = cartItems.getElementsByClassName('cartPrice');
    var cartItemIDs = cartItems.getElementsByClassName('cartItemID');
    for (var i = 0; i < cartItemIDs.length; i++) {
        if (cartItemIDs[i].innerHTML == itemID && cartItemPrices[i].innerHTML == itemPrice) {
                alert('Already added. Try incrementing.');
                return;
            }
    //for (var i = 0; i < cartItemNames.length; i++) {
    //    if (cartItemNames[i].innerHTML == itemName) {
    //        alert('Already added. Try incrementing.');
    //        return;
    //    }
    //}

    ///ADD ITEMID TO CART
    var cartRowContents = `
        <div class="cartColumn">
            <span class="cartItemID">${itemID}</span>
        </div>
        <div class="cartItem cartColumn">
            <span class="cartItemName">${itemName}</span>
        </div>
            <span class="cartPrice cartColumn">${itemPrice}</span>
        <div class="cartColumn">
            <input class="cartQuantity" type="number" value="1">
            <button class="removeFromCart" type="button"><img width="15" height="15" src="images/invalid.png"></button>
        </div>`;
    cartRow.innerHTML = cartRowContents;
    cartItems.append(cartRow);
    cartRow.getElementsByClassName('removeFromCart')[0].addEventListener('click', removeCartItem);
    cartRow.getElementsByClassName('cartQuantity')[0].addEventListener('change', changeQuantity/*quantityChanged*/);
}

function updateCartTotal() {
    var cartItemContainer = document.getElementsByClassName('cartItems')[0];
    var cartRows = cartItemContainer.getElementsByClassName('cartRow');
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
