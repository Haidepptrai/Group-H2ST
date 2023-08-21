function increaseQuantity(productId, id) {
    var quantityInput = document.getElementById('quantity_' + id);
    var currentValue = parseInt(quantityInput.value);
    var maxValue = parseInt(quantityInput.max);

    if (currentValue < maxValue) {
        quantityInput.value = currentValue + 1;
    }
    $.ajax({
        url: 'add-to-cart/' + productId,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            quantity: quantityInput.value,
            totalCost: findTotal(),
        },
    });
}

function decreaseQuantity(productId, id) {
    var quantityInput = document.getElementById('quantity_' + id);
    var currentValue = parseInt(quantityInput.value);
    var minValue = parseInt(quantityInput.min);

    if (currentValue > minValue) {
        quantityInput.value = currentValue - 1;
    }
    $.ajax({
        url: '../add-to-cart/' + productId,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            quantity: quantityInput.value,
            totalCost: findTotal(),
        },
    });
}
function findTotal() {
    var total = 0;
    var id = 2;
    var check = parseInt(document.getElementById('lenght').value) + 1;

    while (id <= check) {
        var price = parseFloat(document.getElementById('price_' + id).innerText.replace('$', ''));
        var quantity = parseInt(document.getElementById('quantity_' + id).value);
        proPrice = price * quantity
        total += proPrice;
        id++;
    }

    var viewTotal = document.getElementById("total-cart");
    viewTotal.innerHTML = total.toFixed(2);
    return total;
}
