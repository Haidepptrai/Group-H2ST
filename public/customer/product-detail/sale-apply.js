const discountValueTag = parseInt(document.getElementById("discount-value").value);
const salePercent = discountValueTag;
if (salePercent != null) {
  const originPriceTag = document.getElementById("origin-price");
  const getOriginPrice = parseFloat(
    originPriceTag.textContent.replace(/[^0-9.-]+/g, "")
  );

  const getSalePrice = getOriginPrice - (getOriginPrice * salePercent) / 100;
  const salePriceTag = document.getElementById("sale-price");
  salePriceTag.textContent = getSalePrice;
  originPriceTag.classList.add("line-through");
} else {
  document.getElementById("sale-price").remove();
}
