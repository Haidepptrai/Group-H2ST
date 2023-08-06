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
    <link rel="stylesheet" href="../customer/products-list/product-list.css">
    {{-- Bootstrap 5 icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <title>Product List</title> <!--Set this product list of. i.e Chair list, Table list, etc.-->
</head>

<body>
    <div class="page-container">
        <nav class="navbar navbar-expand-lg bg-transparent">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
                    aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">H2ST Furniture</a>
                <div class="collapse navbar-collapse" id="navbarToggler">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ url('customer/index') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('customer/list-products') }}">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About Us</a>
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
                                <li><a class="dropdown-item" href="{{ route('customerLogout') }}"><i
                                            class="bi bi-box-arrow-in-left"></i> Log out</a></li>
                            </ul>
                        </div>
                        {{-- <div class="fw-bold">{{ session('user')->getName() }} </div> --}}
                    @else
                        <div class="user-ava"><a href="{{ route('customerLogin') }}"><box-icon
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

        <main>
            <div class="product-sort">
                <div class="product-count">
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Sort by popularity
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Name</a></li>
                        <li><a class="dropdown-item" href="#">Price</a></li>
                        <li><a class="dropdown-item" href="#">Popularity</a></li>
                    </ul>
                </div>
            </div>

            <div class="product-display">
                <div class="product-list">
                    @foreach ($products as $product)
                        @php
                            $displayProduct = $product->status == 1 && $product->category->status == 1;
                        @endphp
                        @if ($displayProduct)
                        <a href="" class="product">
                            <div class="product-item">
                                <div class="product-image">
                                    <img src="{{asset('pro_img/' . $product->proimage)}}" alt="">
                                </div>
                                <div class="product-info">
                                    <p class="product-name">{{ $product->proname }}</p>
                                    <p class="product-price">{{ $product->proprice }}</p>
                                </div>
                            </div>
                        </a>
                        @endif
                    @endforeach
                </div>

                <div class="sort-slide">
                    <div class="slide-one">
                        <h5>Category</h5>
                        <ul>
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('customerListProducts', ['category_id' => $category->id]) }}"
                                        class="btn btn-outline-light text-dark">{{ $category->catname }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="slide-two">
                        <div id="slider"></div>

                    </div>
                </div>

            </div>
            <div class="pagination">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item{{ $products->previousPageUrl() ? '' : ' disabled' }}"><a
                                class="page-link" href="{{ $products->previousPageUrl() }}"><i
                                    class="bi bi-arrow-bar-left"></i></a>
                        </li>
                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                            <li class="page-item{{ $i == $products->currentPage() ? ' active' : '' }}"><a
                                    class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item{{ $products->nextPageUrl() ? '' : ' disabled' }}"><a class="page-link"
                                href="{{ $products->nextPageUrl() }}"><i class="bi bi-arrow-bar-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
    </div>

    </main>
    </div>
</body>
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
<script src="https://cdn.jsdelivr.net/npm/nouislider@X.X.X/dist/nouislider.min.js"></script>

</html>
