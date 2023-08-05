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
                    <div class="user-ava"><a href="#"><box-icon name='user'></box-icon></a></div>
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
                    Showing 1-9 of 57 results
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
                    <div class="list-item">
                        <div class="product-image">
                            <img src="../customer/products-list/./product-list/051d8eb5f2d13e23a6b2d9832bb17b64.jpg"
                                alt="">
                        </div>
                        <div class="product-info">
                        </div>
                        <p class="product-name">Name</p>
                        <p class="product-price">$73</p>
                    </div>
                    <div class="list-item">
                        <div class="product-image">
                            <img src="../customer/products-list/./product-list/051d8eb5f2d13e23a6b2d9832bb17b64.jpg"
                                alt="">
                        </div>
                        <div class="product-info">
                        </div>
                        <p class="product-name">Name</p>
                        <p class="product-price">$73</p>
                    </div>
                    <div class="list-item">
                        <div class="product-image">
                            <img src="../customer/products-list/./product-list/051d8eb5f2d13e23a6b2d9832bb17b64.jpg"
                                alt="">
                        </div>
                        <div class="product-info">
                        </div>
                        <p class="product-name">Name</p>
                        <p class="product-price">$73</p>
                    </div>
                    <div class="list-item">
                        <div class="product-image">
                            <img src="../customer/products-list/./product-list/051d8eb5f2d13e23a6b2d9832bb17b64.jpg"
                                alt="">
                        </div>
                        <div class="product-info">
                        </div>
                        <p class="product-name">Name</p>
                        <p class="product-price">$73</p>
                    </div>
                    <div class="list-item">
                        <div class="product-image">
                            <img src="../customer/products-list/./product-list/051d8eb5f2d13e23a6b2d9832bb17b64.jpg"
                                alt="">
                        </div>
                        <div class="product-info">
                        </div>
                        <p class="product-name">Name</p>
                        <p class="product-price">$73</p>
                    </div>
                    <div class="list-item">
                        <div class="product-image">
                            <img src="../customer/products-list/./product-list/051d8eb5f2d13e23a6b2d9832bb17b64.jpg"
                                alt="">
                        </div>
                        <div class="product-info">
                        </div>
                        <p class="product-name">Name</p>
                        <p class="product-price">$73</p>
                    </div>
                    <div class="list-item">
                        <div class="product-image">
                            <img src="../customer/products-list/./product-list/051d8eb5f2d13e23a6b2d9832bb17b64.jpg"
                                alt="">
                        </div>
                        <div class="product-info">
                        </div>
                        <p class="product-name">Name</p>
                        <p class="product-price">$73</p>
                    </div>
                    <div class="list-item">
                        <div class="product-image">
                            <img src="../customer/products-list/./product-list/051d8eb5f2d13e23a6b2d9832bb17b64.jpg"
                                alt="">
                        </div>
                        <div class="product-info">
                        </div>
                        <p class="product-name">Name</p>
                        <p class="product-price">$73</p>
                    </div>
                    <div class="list-item">
                        <div class="product-image">
                            <img src="../customer/products-list/./product-list/051d8eb5f2d13e23a6b2d9832bb17b64.jpg"
                                alt="">
                        </div>
                        <div class="product-info">
                        </div>
                        <p class="product-name">Name</p>
                        <p class="product-price">$73</p>
                    </div>
                </div>

                <div class="sort-slide">
                    <div class="slide-one">
                        <h5>Category</h5>
                        <ul>
                            @foreach ($cate as $c)
                                <li><a href="" class="btn btn-outline-light text-dark">{{ $c->catname }}</a>
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
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
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
