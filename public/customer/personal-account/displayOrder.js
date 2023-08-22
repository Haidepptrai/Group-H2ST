$(document).ready(function () {
    $(".order-row").click(function (event) {
        var productDetails = $(event.target).next(".order-details");
        $(".order-details").not(productDetails).slideUp("fast");
        productDetails.slideToggle("fast");
        var orderid = parseInt(document.getElementById("orderid").value);
        var orderid = parseInt(event.target.textContent);
        $.ajax({
            url: orderid,
            type: "get",
            data: {
                _token: "{{ csrf_token() }}",
                orderId: orderid,
            },
        });
    });
});
