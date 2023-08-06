document.addEventListener("DOMContentLoaded", function () {
  let productItems = document.querySelectorAll(".cart");
  const totalPriceElement = document.getElementById("total-price");

  let total = 0;

  function updateTotalPrice() {
    total = 0;
    productItems.forEach((item) => {
      const quantityInput = item.querySelector(".quantity-input");
      const priceElement = item.querySelector(".product-price");

      console.log(priceElement);
      let quantity = parseInt(quantityInput.value);
      const priceText = priceElement.textContent;
      const numericValue = parseFloat(priceText.replace(/\$/g, ""));

      total += numericValue * quantity;
    });

    const formattedTotalPrice = total.toLocaleString("en-US", {
      style: "currency",
      currency: "USD",
    });

    totalPriceElement.innerHTML = formattedTotalPrice;
  }

  productItems.forEach((item, index) => {
    const quantityInput = item.querySelector(".quantity-input");
    const btnPlus = item.querySelector(".btn-plus");
    const btnMinus = item.querySelector(".btn-minus");
    const btnRemove = item.querySelector(".btn-remove");

    const storedQuantity = localStorage.getItem(`quantity_${index}`);
    if (storedQuantity) {
      quantityInput.value = storedQuantity;
    }

    btnPlus.addEventListener("click", function () {
      let quantity = parseInt(quantityInput.value);
      if (quantity < 20) {
        quantity += 1;
        quantityInput.value = quantity;
        localStorage.setItem(`quantity_${index}`, quantity);
        updateTotalPrice();
      }
    });

    btnMinus.addEventListener("click", function () {
      let quantity = parseInt(quantityInput.value);
      if (quantity > 1) {
        quantity -= 1;
        quantityInput.value = quantity;
        localStorage.setItem(`quantity_${index}`, quantity);
        updateTotalPrice();
      }
    });

    btnRemove.addEventListener("click", function () {
      item.remove();
      productItems = document.querySelectorAll(".cart");
      localStorage.removeItem(`quantity_${index}`);
      updateTotalPrice();
    });
  });

  // Call the updateTotalPrice function initially to display the total price
  updateTotalPrice();
});
