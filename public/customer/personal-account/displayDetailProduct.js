$(document).ready(function() {
    $('.order-row').click(function() {
        var orderid = $(this).data("orderid");
        var productDetails = $(this).next('.order-details');
        $('.order-details').not(productDetails).slideUp('fast');
        productDetails.slideToggle('fast');
    });
});
