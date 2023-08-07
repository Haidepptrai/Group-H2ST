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
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <link rel="stylesheet" href="../customer/home-page/home-page.css">
    {{-- Bootstrap 5 icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <title>Home Page H2ST</title>
</head>

<body>
    <div class="page-container">
        <nav class="navbar navbar-expand-lg bg-transparent position-absolute z-1">
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
                    @if (session('user') || Session()->has('id'))
                        <div class="dropdown">
                            <a type="button" class="btn border-0 dropdown-toggle-no-caret" data-bs-toggle="dropdown">
                                @if (session('user'))
                                    <img src="{{ session('user')->getAvatar() }}" class="rounded-circle " alt="Avatar" width="40" height="40">
                                @endif
                                @if (Session()->has('id'))
                                    <img src="../user_img/{{ Session::get('userimage') }}" class="rounded-circle " alt="Avatar" width="40" height="40">
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('customer/user-profile')}}"><i class="bi bi-person-lines-fill "></i>  My profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-receipt"></i>  My order</a></li>
                                <li><a class="dropdown-item" href="{{route('customerLogout')}}"><i class="bi bi-box-arrow-in-left"></i>  Log out</a></li>
                            </ul>
                        </div>
                    @else
                    <div class="user-ava"><a href="{{ route('customerLogin') }}" draggable="false"><box-icon
                        name='user'></box-icon></a></div>
                    @endif
                    <div class="shopping-cart"><a href="{{ route('cart') }}" draggable="false"><box-icon name='cart'></box-icon></a></div>
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
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../customer/home-page/./carousel/carousel01.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../customer/home-page/./carousel/carousel02.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../customer/home-page/./carousel/carousel03.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="position-absolute top-50 start-50 translate-middle home-title">
                    <h1 class="head-title">All for your home</h1>
                    <p class="head-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Consequat dolor
                        odio odio malesuada at
                        condimentum adipiscing iaculis semper.</p>
                    <a class="addition-link" href="{{ route('customerListProducts') }}">View More<box-icon name='chevron-right'
                            color="#fff"></box-icon></a>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <main>
            <div class="top-product">
                <h1 class="top-title">
                    Products of the week
                </h1>
                <p class="top-description">
                Discover our handpicked collection of the finest products of the week, curated with care to bring you the best in style, quality, and elegance. Explore these exclusive picks and elevate your living space with sophistication and charm.
                </p>
            </div>
            <div class="top-product-card">
                <!-- hot/new products -->
                @isset($new_products)
                    @foreach ($new_products as $product)
                        @php
                            $displayProduct = $product->status == 1 && $product->category->status == 1;
                        @endphp
                        @if ($displayProduct)
                            <div class="product-card-item">
                                <p class="state">New Products</p>
                                <div class="product-image">
                                    <img src="{{ asset('pro_img/' . $product->proimage) }}" alt="{{ $product->proname }}">
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-name" draggable="false">{{ $product->proname }}</a>
                                    <p class="product-price">${{ $product->proprice }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endisset
            </div>
            <div class="banner">
                <img src="../customer/home-page/./banner/banner01.jpg" class="banner-wide-01">
                <div class="banner-description">
                    <p class="banner-title">Discover Elegance and Style - Unravel the Finest Selection of Exquisite
                        Furniture at Our Esteemed Store.</p>
                    <a href="{{ route('customerListProducts') }}" class="addition-link" draggable="false">View more<box-icon name='chevron-right'
                            color="#fff"></box-icon></a>
                </div>
            </div>
            <div class="banner">
                <img src="../customer/home-page/./banner/banner02.jpg" class="banner-wide-02">
            </div>
            <div class="product-container">
                @foreach ($featuredProducts as $fp)
                    @php
                        $displayProduct = $fp->status == 1 && $fp->category->status == 1;
                    @endphp
                    @if ($displayProduct)
                        <div class="product-list">
                            <div class="product-title">
                                <h1>{{ $fp->category->catname }}</h1>
                                <p>{{ $fp->prodescription }}</p>
                                <a href="#" class="addition-link" draggable="false">View more<box-icon name='chevron-right'
                                        color="#373737"></box-icon></a>
                            </div>
                            <div class="product-image">
                                <img src="{{ asset('pro_img/' . $fp->proimage) }}" alt=""
                                    class="product-list-image">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="order-now">
                <p>order now for an <span class="flag-bold">
                        express delivery in 24h !
                    </span></p>
                <a href="#" class="addition-link" draggable="false">View more<box-icon name='chevron-right'
                        color="#373737"></box-icon></a>
            </div>
            <div class="services">
                <div class="services-item">
                    <p class="service-icon"><svg width="62" height="62" viewBox="0 0 62 62" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M56.8333 30.9998C56.8333 45.2598 45.26 56.8331 31 56.8331C16.74 56.8331 5.16666 45.2598 5.16666 30.9998C5.16666 16.7398 16.74 5.1665 31 5.1665C45.26 5.1665 56.8333 16.7398 56.8333 30.9998Z"
                                stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M40.5842 39.215L32.5758 34.4359C31.1808 33.6092 30.0442 31.62 30.0442 29.9925V19.4009"
                                stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>Shop online</p>
                    <p class="service-description">Seamless Shopping, Delivered to Your Doorstep - Experience the
                        Convenience of Online Shopping with Us. </p>
                </div>
                <div class="services-item">
                    <p class="service-icon"><svg width="62" height="62" viewBox="0 0 62 62" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M19.375 19.8141V17.3082C19.375 11.4957 24.0508 5.78657 29.8633 5.24407C36.7867 4.5724 42.625 10.0232 42.625 16.8174V20.3824"
                                stroke="#1A1A1A" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M23.25 56.8332H38.75C49.135 56.8332 50.995 52.674 51.5375 47.6107L53.475 32.1107C54.1725 25.8073 52.3641 20.6665 41.3333 20.6665H20.6667C9.63583 20.6665 7.8275 25.8073 8.52499 32.1107L10.4625 47.6107C11.005 52.674 12.865 56.8332 23.25 56.8332Z"
                                stroke="#1A1A1A" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M40.03 31.0002H40.0532" stroke="#1A1A1A" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M21.9441 31.0002H21.9674" stroke="#1A1A1A" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Free shipping</p>
                    <p class="service-description">Free Shipping Worldwide - Shop with Confidence and Enjoy Hassle-Free
                        Delivery to Your Doorstep.</p>
                </div>
                <div class="services-item">
                    <p class="service-icon"><svg width="62" height="62" viewBox="0 0 62 62" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.16667 21.9712H56.8333" stroke="#1A1A1A" stroke-width="1.5"
                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15.5 42.6377H20.6667" stroke="#1A1A1A" stroke-width="1.5"
                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M27.125 42.6377H37.4583" stroke="#1A1A1A" stroke-width="1.5"
                                stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M16.6367 9.05469H45.3375C54.5341 9.05469 56.8333 11.328 56.8333 20.3955V41.6047C56.8333 50.6722 54.5342 52.9455 45.3633 52.9455H16.6367C7.46584 52.9714 5.16667 50.698 5.16667 41.6305V20.3955C5.16667 11.328 7.46584 9.05469 16.6367 9.05469Z"
                                stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        Return policy</p>
                    <p class="service-description">Easy Returns and Hassle-Free Refunds - Shop with Confidence knowing
                        you have a Flexible Return Policy.</p>
                </div>
                <div class="services-item">
                    <p class="service-icon"><svg width="62" height="62" viewBox="0 0 62 62" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22.4023 37.0189C22.4023 40.3514 24.9598 43.0381 28.1373 43.0381H34.6215C37.3857 43.0381 39.6332 40.6873 39.6332 37.7939C39.6332 34.6423 38.264 33.5314 36.2232 32.8081L25.8123 29.1914C23.7715 28.4681 22.4023 27.3573 22.4023 24.2056C22.4023 21.3123 24.6498 18.9614 27.414 18.9614H33.8982C37.0757 18.9614 39.6332 21.6481 39.6332 24.9806"
                                stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M31 15.5V46.5" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M31 56.8331C45.2674 56.8331 56.8333 45.2672 56.8333 30.9998C56.8333 16.7325 45.2674 5.1665 31 5.1665C16.7327 5.1665 5.16669 16.7325 5.16669 30.9998C5.16669 45.2672 16.7327 56.8331 31 56.8331Z"
                                stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        Payment</p>
                    <p class="service-description">Secure and Convenient Payment Options - Experience seamless
                        transactions with our trusted payment methods.</p>
                </div>
            </div>
        </main>
        <div id="carouselExampleFade" class="carousel slide carousel-fade" style="height: 45vh;">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-caption">
                        <svg width="41" height="31" viewBox="0 0 41 31" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.8854 4.928L12.5814 13.04C14.176 13.5947 15.4934 14.6 16.5334 16.056C17.5734 17.4427 18.0934 19.1413 18.0934 21.152C18.0934 23.648 17.2267 25.7973 15.4934 27.6C13.76 29.3333 11.6454 30.2 9.14938 30.2C6.65338 30.2 4.50404 29.3333 2.70138 27.6C0.968042 25.7973 0.101375 23.648 0.101375 21.152C0.101375 19.8347 0.309375 18.656 0.725375 17.616C1.21071 16.576 1.86938 15.4667 2.70138 14.288L11.7494 0.871994L17.8854 4.928ZM40.6614 4.928L35.3574 13.04C36.952 13.5947 38.2694 14.6 39.3094 16.056C40.3494 17.4427 40.8694 19.1413 40.8694 21.152C40.8694 23.648 40.0027 25.7973 38.2694 27.6C36.536 29.3333 34.4214 30.2 31.9254 30.2C29.4294 30.2 27.28 29.3333 25.4774 27.6C23.744 25.7973 22.8774 23.648 22.8774 21.152C22.8774 19.8347 23.0854 18.656 23.5014 17.616C23.9867 16.576 24.6454 15.4667 25.4774 14.288L34.5254 0.871994L40.6614 4.928Z"
                                fill="#2E2E2E" />
                        </svg>
                        <p class="customer-feedback">I am extremely impressed with the wide range of furniture options
                            available at your store. The quality and craftsmanship of the pieces are outstanding. As an
                            interior designer, I rely on your store to help me create stunning spaces for my clients.
                            Keep up the fantastic work!</p>
                        <h5>Sarah Johnson
                        </h5>
                        <h6>Interior Designer
                        </h6>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-caption">
                        <svg width="41" height="31" viewBox="0 0 41 31" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.8854 4.928L12.5814 13.04C14.176 13.5947 15.4934 14.6 16.5334 16.056C17.5734 17.4427 18.0934 19.1413 18.0934 21.152C18.0934 23.648 17.2267 25.7973 15.4934 27.6C13.76 29.3333 11.6454 30.2 9.14938 30.2C6.65338 30.2 4.50404 29.3333 2.70138 27.6C0.968042 25.7973 0.101375 23.648 0.101375 21.152C0.101375 19.8347 0.309375 18.656 0.725375 17.616C1.21071 16.576 1.86938 15.4667 2.70138 14.288L11.7494 0.871994L17.8854 4.928ZM40.6614 4.928L35.3574 13.04C36.952 13.5947 38.2694 14.6 39.3094 16.056C40.3494 17.4427 40.8694 19.1413 40.8694 21.152C40.8694 23.648 40.0027 25.7973 38.2694 27.6C36.536 29.3333 34.4214 30.2 31.9254 30.2C29.4294 30.2 27.28 29.3333 25.4774 27.6C23.744 25.7973 22.8774 23.648 22.8774 21.152C22.8774 19.8347 23.0854 18.656 23.5014 17.616C23.9867 16.576 24.6454 15.4667 25.4774 14.288L34.5254 0.871994L40.6614 4.928Z"
                                fill="#2E2E2E" />
                        </svg>
                        <p class="customer-feedback">I recently purchased a dining table from your furniture store, and
                            I must say, it exceeded my expectations. The design and build are top-notch, and it adds a
                            touch of elegance to my dining area. Thank you for providing such exceptional furniture
                            pieces!</p>
                        <h5>John Smith</h5>
                        <h6>Software Engineer</h6>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-caption">
                        <svg width="41" height="31" viewBox="0 0 41 31" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.8854 4.928L12.5814 13.04C14.176 13.5947 15.4934 14.6 16.5334 16.056C17.5734 17.4427 18.0934 19.1413 18.0934 21.152C18.0934 23.648 17.2267 25.7973 15.4934 27.6C13.76 29.3333 11.6454 30.2 9.14938 30.2C6.65338 30.2 4.50404 29.3333 2.70138 27.6C0.968042 25.7973 0.101375 23.648 0.101375 21.152C0.101375 19.8347 0.309375 18.656 0.725375 17.616C1.21071 16.576 1.86938 15.4667 2.70138 14.288L11.7494 0.871994L17.8854 4.928ZM40.6614 4.928L35.3574 13.04C36.952 13.5947 38.2694 14.6 39.3094 16.056C40.3494 17.4427 40.8694 19.1413 40.8694 21.152C40.8694 23.648 40.0027 25.7973 38.2694 27.6C36.536 29.3333 34.4214 30.2 31.9254 30.2C29.4294 30.2 27.28 29.3333 25.4774 27.6C23.744 25.7973 22.8774 23.648 22.8774 21.152C22.8774 19.8347 23.0854 18.656 23.5014 17.616C23.9867 16.576 24.6454 15.4667 25.4774 14.288L34.5254 0.871994L40.6614 4.928Z"
                                fill="#2E2E2E" />
                        </svg>
                        <p class="customer-feedback">I had a wonderful shopping experience at your furniture store. The
                            staff was friendly and knowledgeable, assisting me in finding the perfect bedroom set for my
                            new apartment. The delivery process was seamless, and I'm absolutely delighted with my
                            purchase. I will definitely recommend your store to my friends and colleagues.</p>
                        <h5>Emily Lee</h5>
                        <h6>Teacher</h6>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                data-bs-slide="prevv">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                data-bs-slide="nextt">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>

</html>
