const priceElement = document.querySelectorAll(".product-price");

// Get the current price value

priceElement.forEach((productElement) => {
  const priceValue = parseFloat(productElement.textContent);

  // Format the price with a dollar sign
  const formattedPrice = priceValue.toLocaleString("en-US", {
    style: "currency",
    currency: "USD",
  });

  // Update the element content with the formatted price
  productElement.textContent = formattedPrice;
});
