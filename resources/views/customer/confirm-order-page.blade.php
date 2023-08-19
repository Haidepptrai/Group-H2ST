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

    <link rel="stylesheet" href="../customer/confirm-order/confirm-order.css">

    <!-- Bootstrap 5 css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="{{ asset('js/custom.js') }}"></script>
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
                <a class="navbar-brand" href="{{ route('home') }}">H2ST Furniture</a>
                <div class="collapse navbar-collapse" id="navbarToggler">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customerListProducts') }}">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('aboutUs') }}">About Us</a>
                        </li>
                    </ul>
                    @if (session('user'))
                        <div class="dropdown">
                            <a type="button" class="btn border-0 dropdown-toggle-no-caret" data-bs-toggle="dropdown">
                                <img src="{{ session('user')->getAvatar() }}" class="rounded-circle " alt="Avatar"
                                    width="40" height="40">
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person-lines-fill "></i> My
                                        profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-receipt"></i>My order</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('customerLogout') }}"><i
                                            class="bi bi-box-arrow-in-left"></i> Log out</a></li>
                            </ul>
                        </div>
                    @else
                        <div class="user-ava"><a href="{{ route('customerLogin') }}" draggable="false"><box-icon
                                    name='user'></box-icon></a>
                        </div>
                    @endif

                    <div class="shopping-cart"><a href="#" draggable="false"><box-icon
                                name='cart'></box-icon></a></div>
                    <form class="d-flex" role="search" action="{{ route('customerListProducts') }}" method="GET">
                        <label>
                            <input type="search" class="search-field" autocomplete="off" placeholder="Search …"
                                name="query" title="Search for:" />
                        </label>
                        <input type="submit" class="search-submit" value="Search" />
                    </form>
                </div>
            </div>
        </nav>
        @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="cart-info">
            <a class="icon-link" href="#">
                <box-icon class="backLink" name='chevrons-left' color="#0d6efd"></box-icon>
                Back to order
            </a>
            <div class="title text-center text-primary my-5">
                <h1>Confirm order</h1>
            </div>
            <div class="confirm-information">
                <form class="confirm-send" action="{{ url('customer/add-order') }}" method="POST">
                    @csrf
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
                                            src="../pro_img/{{ $details['proimage'] }}"
                                            class="rounded" width="100" height="100">
                                    </td>
                                    <td class="product-price text-success">{{ $details['proprice'] }}$</td>
                                    <td class="view-quantity">
                                        {{ $details['quantity'] }}
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="line"></div>
                    <div class="customer-infor">
                        <h4>Customer Information</h4>
                        <input type="hidden" class="form-control" id="userId" name="userId"
                        value="@if(session('user')){{ Auth::id() }}@else{{ Session::get('id') }}@endif"
                        aria-describedby="emailHelp" required>
                        <div class="mb-3 ms-3">
                            <label for="userEmail" class="form-label fw-bold">Email</label>
                            <input type="text" readonly class="form-control-plaintext" id="userEmail"
                                value="{{ $email }}" name="userEmail">
                        </div>
                        <div class="mb-3 ms-3">
                            <label for="userName" class="form-label fw-bold">Name</label>
                            <input type="text" readonly class="form-control-plaintext" id="userName"
                                value="{{ $name }}" name="userName">
                        </div>
                        <div class="mb-3 ms-3">
                            <label for="userPhone" class="form-label fw-bold">Phone Number</label>
                            <input type="text" readonly class="form-control-plaintext" id="userPhone"
                                value="{{ $phone }}" name="userPhone">
                        </div>
                        <div class="mb-3 ms-3">
                            <label for="userAddress" class="form-label fw-bold">Address</label>
                            <input type="text" readonly class="form-control-plaintext" id="userAddress"
                                value="{{ $address }}" name="userAddress">
                        </div>
                        <div class="mb-3 ms-3">
                            <label for="userWard" class="form-label fw-bold">Your Ward</label>
                            <input type="text" readonly class="form-control-plaintext" id="userWard"
                                value="{{ $ward }}" name="userWard">
                        </div>
                        <div class="mb-3 ms-3">
                            <label for="userDistrict" class="form-label fw-bold">Your District</label>
                            <input type="text" readonly class="form-control-plaintext" id="userDistrict"
                                value="{{ $district }}" name="userDistrict">
                        </div>
                        <div class="mb-3 ms-3">
                            <label for="userCity" class="form-label fw-bold">Your City</label>
                            <input type="text" readonly class="form-control-plaintext" id="userCity"
                                value="{{ $city }}" name="userCity">
                        </div>
                    </div>
                    <div class="float-end mx-5">
                        <button type="submit" class="btn btn-primary position-relative top-0 start-50 translate-middle"> Payment </button>
                        <div class="total">
                            Totals:  <input id="total-price" class="text-success" name="total" value="" readonly>
                        </div>
                    </div>
                </form>
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
    totalPriceElement.value = formattedPrice;
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
