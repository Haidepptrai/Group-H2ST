<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <link rel="stylesheet" href="../../customer/confirm-order/confirm-order.css">

    <!-- Bootstrap 5 css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>Personal Setting</title>
</head>

<body>
    <div class="page-container">
        <nav class="navbar navbar-expand-lg bg-transparent z-1">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
                    aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="../home-page/home-page.html">H2ST Furniture</a>
                <div class="collapse navbar-collapse" id="navbarToggler">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About Us</a>
                        </li>
                    </ul>
                    <div class="user-ava"><a href="#"><box-icon name='user'></box-icon></a></div>
                    <div class="shopping-cart"><a href="#"><box-icon name='cart'></box-icon></a></div>
                    <form class="d-flex" role="search" action="search">
                        <label>
                            <input type="search" class="search-field" autocomplete="off" placeholder="Search …" value=""
                                name="searchValue" title="Search for:" />
                        </label>
                        <input type="submit" class="search-submit" value="Search" />
                    </form>
                </div>
            </div>
        </nav>

        <div class="cart-info">
            <a class="icon-link" href="#">
                <box-icon class="backLink" name='chevrons-left' color="#0d6efd"></box-icon>
                Back to order
            </a>
            <div class="title">
                <h1>Confirm order</h1>
            </div>

            <div class="confirm-information">
                <form class="confirm-send">
                    {{-- <div class="overflow-auto border border-2" style="height: 700px;"></div> --}}
                    <table class="table product-confirm">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 20%;">Product Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (session('cart'))
                                @foreach (session('cart') as $id => $details)
                                <tr class="cart">
                                    <input type="text" name='productID' value="c" hidden>
                                    <td>{{ $details['proname'] }}</td>
                                    <td ><img
                                            src="../../pro_img/{{ $details['proimage'] }}"
                                            class="rounded" width="100" height="100">
                                    </td>
                                    <td class="product-price">{{ $details['proprice'] }}</td>
                                    <td class="view-quantity">
                                        1
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="line"></div>
                    <div class="customer-infor">
                        <h4>Customer Information</h4>
                        <div class="mb-3 ms-3">
                            <label for="userEmail" class="form-label fw-bold">Email</label>
                            <input type="text" readonly class="form-control-plaintext" id="userEmail"
                                value="email@example.com" name="userEmail">
                        </div>
                        <div class="mb-3 ms-3">
                            <label for="userName" class="form-label fw-bold">Name</label>
                            <input type="text" readonly class="form-control-plaintext" id="userName" value="User name"
                                name="userName">
                        </div>
                        <div class="mb-3 ms-3">
                            <label for="userPhone" class="form-label fw-bold">Phone Number</label>
                            <input type="text" readonly class="form-control-plaintext" id="userPhone" value="090000000"
                                name="userPhone">
                        </div>
                        <div class="mb-3 ms-3">
                            <label for="userAddress" class="form-label fw-bold">Address</label>
                            <input type="text" readonly class="form-control-plaintext" id="userAddress"
                                value="20 Cong Hoa street" name="userAddress">
                        </div>
                    </div>
                </form>
            </div>

            <div class="float-end mx-5">
                <input class="btn btn-primary position-relative top-0 start-50 translate-middle" type="submit"
                    value="Confirm">
                <div class="total">
                    Totals: <span id="total-price"></span>
                </div>
            </div>

        </div>
    </div>
</body>
<script src="../../customer/convertToDollar.js"></script>
<script>
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
    totalPriceElement.innerHTML = formattedPrice;
</script>

<footer>
    <div class="foot-container">
        <a class="navbar-brand" href="#">H2ST Furniture</a>
        <div class="nav-container">
            <div class="sub-nav">
                <div class="sub-title">
                    About Us
                </div>
                <div class="sub-description">We are delighted to modify your home more perfect</div>
            </div>
            <div class="sub-nav">
                <div class="sub-title">
                    Contact Information
                </div>
                <div class="sub-description">+84 123456789</div>
                <div class="sub-description">H2STFurniture@gmail.com</div>
                <div class="sub-description">xxx Cong Hoa street. Ho Chi Minh city</div>
            </div>
        </div>
    </div>
    </div>
</footer>

</html>
