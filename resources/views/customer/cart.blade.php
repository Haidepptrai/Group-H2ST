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
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <!-- Bootstrap 5 css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../customer/shopping-cart/shopping-cart.css">
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
                    @if (session('user') || Session()->has('id'))
                        <div class="dropdown">
                            <a type="button" class="btn border-0 dropdown-toggle-no-caret" data-bs-toggle="dropdown">
                                @if (session('user'))
                                    <img src="{{ session('user')->getAvatar() }}" class="rounded-circle " alt="Avatar"
                                        width="40" height="40">
                                @endif
                                @if (Session()->has('id'))
                                    <img src="../user_img/{{ Session::get('userimage') }}" class="rounded-circle "
                                        alt="Avatar" width="40" height="40">
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('customer/user-profile') }}"><i
                                            class="bi bi-person-lines-fill "></i> My profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-receipt"></i> My order</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('customerLogout') }}"><i
                                            class="bi bi-box-arrow-in-left"></i> Log out</a></li>
                            </ul>
                        </div>
                    @else
                        <div class="user-ava"><a href="{{ route('customerLogin') }}" draggable="false"><box-icon
                                    name='user'></box-icon></a></div>
                    @endif
                    <div class="shopping-cart"><a href="#"><box-icon name='cart'></box-icon></a></div>
                    <form class="d-flex" role="search" action="search">
                        <label>
                            <input type="search" class="search-field" autocomplete="off" placeholder="Search …"
                                value="" name="searchValue" title="Search for:" />
                        </label>
                        <input type="submit" class="search-submit" value="Search" />
                    </form>
                </div>
            </div>
        </nav>

        <div class="cart-info">
            <a class="icon-link" href="{{ route('customerListProducts') }}">
                <box-icon class="backLink" name='chevrons-left' color="#0d6efd"></box-icon>
                Continue Shopping
            </a>
            <div class="title">
                <h5>Shopping cart</h5>
            </div>
            <div class="overflow-auto border border-2" style="height: 700px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (session('cart'))
                            @php
                                $i = 1;
                            @endphp
                            @foreach (session('cart') as $id => $details)
                                <tr class="cart">
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $details['proname'] }}</td>
                                    <td><img src="../pro_img/{{ $details['proimage'] }}" alt=""
                                            class="rounded" width="100" height="100">
                                    </td>
                                    <td class="product-price">{{ $details['proprice'] }}</td>
                                    <td class="view-quantity">
                                        <div class="adjust-quantity">
                                            <div class="select-quantity">
                                                <button class="btn-minus">-</button>
                                                <input type="number" class="quantity-input" value="1"
                                                    min="1">
                                                <button class="btn-plus">+</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn-remove"><a
                                                href="{{ url('customer/remove-from-cart/' . $details['proid']) }}"
                                                class="text-danger"><i class="bi bi-trash-fill"></a></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center text-danger">Cart is empty</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="float-end">
                Totals: <span id="total-price"></span>
                <br>
                <a href="{{ url('customer/confirm-order-page/'. Auth::id()) }}" class="btn btn-primary text-light text center">Add to cart</a>
            </div>
        </div>
</body>
<script src="../customer/convertToDollar.js"></script>
<script src="../customer/shopping-cart/product-quantity.js"></script>
<footer>
    <div class="foot-container text-center">
        <a class="navbar-brand " href="{{ route('home') }}">H2ST Furniture</a>
        <div class="text-center">
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
