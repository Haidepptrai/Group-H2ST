const productElement = document.querySelectorAll('.cart');
let totalPrice = 0;
productElement.forEach((item) => {
    const quantity = item.querySelector('.view-quantity');
    const price = item.querySelector('.product-price');
    const quantityParse = parseInt(quantity.textContent, 10);
    const priceParse = parseFloat(price.textContent.replace(/\$/g, ""));
    totalPrice += quantityParse * priceParse;
});
const totalPriceElement = document.getElementById('total-price');
const formattedPrice = totalPrice.toLocaleString("en-US", {
    style: "currency",
    currency: "USD",
});
totalPriceElement.value = formattedPrice;