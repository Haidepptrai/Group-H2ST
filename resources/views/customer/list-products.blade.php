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
                <a class="navbar-brand" href="{{ route('home') }}" draggable="false">H2ST Furniture</a>
                <div class="collapse navbar-collapse" id="navbarToggler">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('home') }}" draggable="false">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customerListProducts') }}" draggable="false">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('aboutUs') }}" draggable="false">About Us</a>
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
                    <div class="user-ava"><a href="{{ route('customerLogin') }}" draggable="false"><box-icon name='user'></box-icon></a>
                    </div>
                    @endif

                    <div class="shopping-cart"><a href="#" draggable="false"><box-icon name='cart'></box-icon></a></div>
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

        <main>
            <div class="product-sort">
                <div class="product-count">
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Sort by
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item"
                                href="{{ route('customerListProducts', ['sort' => 'name']) }}">Name</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('customerListProducts', ['sort' => 'price']) }}">Price</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('customerListProducts', ['sort' => 'bestseller']) }}">Popularity</a></li>
                    </ul>
                </div>
            </div>
            <script>
                const dropdownToggle = document.querySelector('.dropdown-toggle');
                const dropdownItems = document.querySelectorAll('.dropdown-item');

                // Check if the sort option is stored in localStorage
                const selectedSort = localStorage.getItem('selectedSort');
                if (selectedSort) {
                    dropdownToggle.textContent = 'Sort by ' + selectedSort;
                }

                dropdownItems.forEach(item => {
                    item.addEventListener('click', () => {
                        const selectedOption = item.textContent;
                        dropdownToggle.textContent = 'Sort by ' + selectedOption;

                        // Store the selected option in localStorage
                        localStorage.setItem('selectedSort', selectedOption);
                    });
                });
            </script>


            <div class="product-sort">
                <div class="product-sort-controls">
                    <h3>Select by order </h3>
                    <button class="btn btn-outline-dark" onclick="changeSortOrder('asc')">Increasing</button>
                    <button class="btn btn-outline-dark" onclick="changeSortOrder('desc')">Decreasing</button>
                </div>
                <div class="product-count">
                    <form id='filterPrice' action="{{ route('customerListProducts') }}" method="get">
                        <div class="form-item">
                            <label for="min_price">Min Price:</label>
                            <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}">
                        </div>
                        <div class="form-item">
                            <label for="max_price">Max Price:</label>
                            <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}">
                        </div>
                        <button type="submit">Apply Filters</button>
                    </form>
                </div>
            </div>
            <div class="product-display">
                <div class="product-list">

                    @foreach ($products as $product)
                    @php
                    $displayProduct = $product->status == 1 && $product->category->status == 1;
                    @endphp
                    @if ($displayProduct)

                    <div class="product-item">
                        <a href="{{ url('customer/detail-products/' . $product->proid) }}"
                                    class="btn btn-sm btn-outline-secondar" class="product" draggable="false">
                            <div class="product-image">
                                <img src="{{ asset('pro_img/' . $product->proimage)}}" alt="{{ $product->proname }}">
                            </div>
                            <div class="product-info">
                                <p class="product-name">{{ $product->proname }}</p>
                                <p class="product-price">{{ $product->proprice }}$</p>
                            </div>
                            <div class="btn-group">
                                <a href="{{ url('customer/detail-products/' . $product->proid) }}"
                                    class="btn btn-sm btn-outline-secondary" draggable="false">Details
                                </a>
                            </div>
                        </a>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="category-list">
                    <h5>Categories</h5>
                    <ul>
                        @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('customerListProducts', ['catid' => $category->catid]) }}"
                                class="btn btn-outline-light text-dark" draggable="false">{{ $category->catname }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

    </div>
    <div class="pagination">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item{{ $products->previousPageUrl() ? '' : ' disabled' }}"><a class="page-link"
                        href="{{ $products->previousPageUrl() }}"><i class="bi bi-arrow-bar-left"></i></a>
                </li>
                @for ($i = 1; $i <= $products->lastPage(); $i++)
                    <li class="page-item{{ $i == $products->currentPage() ? ' active' : '' }}"><a class="page-link"
                            href="{{ $products->url($i) }}">{{ $i }}</a>
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
<footer loading='lazy'>
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
<script>
    function changeSortOrder(order) {
        const urlParams = new URLSearchParams(window.location.search);
        const currentSort = urlParams.get('sort');
        window.location.href = `{{ route('customerListProducts') }}?sort=${currentSort}&order=${order}`;
    }
</script>

</html>
