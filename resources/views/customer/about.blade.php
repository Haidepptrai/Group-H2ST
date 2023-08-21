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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    {{-- Bootstrap 5 icon --}}
    <link rel="stylesheet" href="../customer/about-us/about-us.css">
    <title>About Us</title>
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
                        <div class="dropdown user-profile">
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
                                @if (Session::has('id'))
                                <li><a class="dropdown-item" href="{{ url('customer/user-profile/'.Session::get('id')) }}"><i
                                    class="bi bi-person-lines-fill "></i> My profile</a></li>
                                @elseif (session('user'))
                                <li><a class="dropdown-item" href="{{ url('customer/user-profile/'.Auth::id()) }}"><i
                                    class="bi bi-person-lines-fill "></i> My profile</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('customerLogout') }}"><i
                                            class="bi bi-box-arrow-in-left"></i>Log out</a></li>
                            </ul>
                        </div>
                    @else
                        <div class="user-ava"><a href="{{ route('customerLogin') }}" draggable="false"><box-icon
                                    name='user'></box-icon></a></div>
                    @endif
                    <div class="shopping-cart"><a href="{{ route('cart') }}"><box-icon name='cart'></box-icon></a></div>
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

        <div class="banner-with-title">
            <img src="../customer/home-page/carousel/carousel01.jpg" alt="">
            <div class="banner-title position-absolute top-50 start-50 translate-middle ">About us</div>
        </div>

        <div class="services">
            <div class="services-item">
                <p class="service-icon"><svg width="49" height="62" viewBox="0 0 62 62" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M56.8333 30.9998C56.8333 45.2598 45.26 56.8331 31 56.8331C16.74 56.8331 5.16666 45.2598 5.16666 30.9998C5.16666 16.7398 16.74 5.1665 31 5.1665C45.26 5.1665 56.8333 16.7398 56.8333 30.9998Z"
                            stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M40.5842 39.215L32.5758 34.4359C31.1808 33.6092 30.0442 31.62 30.0442 29.9925V19.4009"
                            stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>Shop online</p>
                <p class="service-description">Seamless Shopping, Delivered to Your Doorstep - Experience the
                    Convenience of Online Shopping with Us. </p>
            </div>
            <div class="services-item">
                <p class="service-icon"><svg width="49" height="62" viewBox="0 0 62 62" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M19.375 19.8141V17.3082C19.375 11.4957 24.0508 5.78657 29.8633 5.24407C36.7867 4.5724 42.625 10.0232 42.625 16.8174V20.3824"
                            stroke="#1A1A1A" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M23.25 56.8332H38.75C49.135 56.8332 50.995 52.674 51.5375 47.6107L53.475 32.1107C54.1725 25.8073 52.3641 20.6665 41.3333 20.6665H20.6667C9.63583 20.6665 7.8275 25.8073 8.52499 32.1107L10.4625 47.6107C11.005 52.674 12.865 56.8332 23.25 56.8332Z"
                            stroke="#1A1A1A" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M40.03 31.0002H40.0532" stroke="#1A1A1A" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M21.9441 31.0002H21.9674" stroke="#1A1A1A" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Free shipping</p>
                <p class="service-description">Free Shipping Worldwide - Shop with Confidence and Enjoy Hassle-Free
                    Delivery to Your Doorstep.</p>
            </div>
            <div class="services-item">
                <p class="service-icon"><svg width="49" height="62" viewBox="0 0 62 62" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.16667 21.9712H56.8333" stroke="#1A1A1A" stroke-width="1.5"
                            stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M15.5 42.6377H20.6667" stroke="#1A1A1A" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M27.125 42.6377H37.4583" stroke="#1A1A1A" stroke-width="1.5" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M16.6367 9.05469H45.3375C54.5341 9.05469 56.8333 11.328 56.8333 20.3955V41.6047C56.8333 50.6722 54.5342 52.9455 45.3633 52.9455H16.6367C7.46584 52.9714 5.16667 50.698 5.16667 41.6305V20.3955C5.16667 11.328 7.46584 9.05469 16.6367 9.05469Z"
                            stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Return policy</p>
                <p class="service-description">Easy Returns and Hassle-Free Refunds - Shop with Confidence knowing
                    you have a Flexible Return Policy.</p>
            </div>
            <div class="services-item">
                <p class="service-icon"><svg width="49" height="62" viewBox="0 0 62 62" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M22.4023 37.0189C22.4023 40.3514 24.9598 43.0381 28.1373 43.0381H34.6215C37.3857 43.0381 39.6332 40.6873 39.6332 37.7939C39.6332 34.6423 38.264 33.5314 36.2232 32.8081L25.8123 29.1914C23.7715 28.4681 22.4023 27.3573 22.4023 24.2056C22.4023 21.3123 24.6498 18.9614 27.414 18.9614H33.8982C37.0757 18.9614 39.6332 21.6481 39.6332 24.9806"
                            stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M31 15.5V46.5" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M31 56.8331C45.2674 56.8331 56.8333 45.2672 56.8333 30.9998C56.8333 16.7325 45.2674 5.1665 31 5.1665C16.7327 5.1665 5.16669 16.7325 5.16669 30.9998C5.16669 45.2672 16.7327 56.8331 31 56.8331Z"
                            stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Payment</p>
                <p class="service-description">Secure and Convenient Payment Options - Experience seamless
                    transactions with our trusted payment methods.</p>
            </div>
        </div>

        <div class="banner-with-introduction">
            <img src="../customer/about-us/./banner02.jpg" alt="">
        </div>

        <div class="website-introduction">
            <section class="introduction-title">
                <h2 class="section-header">
                    Functionality
                    meets perfection
                </h2>
                <p class="section-description">
                    Elevate Your Living Spaces with Our Exquisite Furniture Collection. Immerse Yourself in Unmatched
                    Quality and Aesthetic Brilliance, Crafted to Enhance Your Home's Beauty and Comfort.
                </p>
            </section>
            <section class="introduction-progress-bar">
                <div class="progress-bar-item">
                    <h5>Creativity<span class="percent">72%</span></h5>
                    <div class="progress" role="progressbar" aria-label="progressCreativity" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100" style="height: 10px">
                        <div class="progress-bar" style="width: 72%"></div>
                    </div>
                </div>
                <div class="progress-bar-item">
                    <h5>Advertising<span class="percent">84%</span></h5>
                    <div class="progress" role="progressbar" aria-label="progressCreativity" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100" style="height: 10px">
                        <div class="progress-bar" style="width: 84%"></div>
                    </div>
                </div>
                <div class="progress-bar-item">
                    <h5>Design<span class="percent">72%</span></h5>
                    <div class="progress" role="progressbar" aria-label="progressCreativity" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100" style="height: 10px">
                        <div class="progress-bar" style="width: 72%"></div>
                    </div>
                </div>
            </section>
        </div>

        <div class="lastest-product-list">
            @foreach ($products as $product)
                <div class="product-card-item">
                    <div class="product-image">
                        <img src="{{ asset('pro_img/' . $product->proimage) }}" alt="{{ $product->proname }}">
                    </div>
                    <div class="product-info">
                        <a href="{{ url('customer/detail-products/' . $product->proid) }}" class="product-name"> {{ $product->proname }}</a>
                        <p class="product-price">{{ $product->proprice }}$</p>
                    </div>
                </div>
            @endforeach

            <script src="../convertToDollar.js"></script>
        </div>
    </div>
</body>
<footer>
    <div class="foot-container">
        <a class="navbar-brand" href="{{ route('home') }}">H2ST Furniture</a>
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
