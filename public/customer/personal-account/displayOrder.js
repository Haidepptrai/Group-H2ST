$(document).ready(function () {
    $(".order-row").click(function (event) {
        var productDetails = $(event.target).next(".order-details");
        $(".order-details").not(productDetails).slideUp("fast");
        productDetails.slideToggle("fast");
        var userid = parseInt(document.getElementById("userid").value);
        var orderid = parseInt(event.target.textContent);
        $.ajax({
            url: userid,
            type: "get",
            data: {
                _token: "{{ csrf_token() }}",
                orderId: orderid,
            },
        });
    });
});
