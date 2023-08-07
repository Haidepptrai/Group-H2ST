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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../customer/product-detail/product-detail.css">
    {{-- Bootstrap 5 icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <title>Product Detail</title> <!--Cai nay nho set thanh ten cua san pham gi nha-->
</head>

<body>
    <div class="page-container">
        <nav class="navbar navbar-expand-lg bg-transparent">
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
                                <img src="{{ session('user')->getAvatar() }}" class="rounded-circle " alt="Avatar" width="40" height="40">
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person-lines-fill "></i>  My profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-receipt"></i>  My order</a></li>
                                <li><a class="dropdown-item" href="{{route('customerLogout')}}"><i class="bi bi-box-arrow-in-left"></i>  Log out</a></li>
                            </ul>
                        </div>
                    @else
                    <div class="user-ava"><a href="{{ route('customerLogin') }}"><box-icon
                        name='user'></box-icon></a></div>
                    @endif
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

        <main>
            <div class="breadcrumb">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('customerListProducts') }}">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sofa large</li>
                    </ol>
                </nav>
            </div>
            <div class="product-display">
<div class="product-image">
                    <img src="{{asset('pro_img/'. $products -> proimage)}}" alt="{{ $products -> proname }}">
                </div>
                <div class="product-buy-info">
                    <div class="product-name">
                        <h4>{{ $products -> proname }}</h4>
                    </div>
                    <div class="star-rating">
                        <span class="fa fa-star "></span>
                        <span class="fa fa-star "></span>
                        <span class="fa fa-star "></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <script src="../../customer/product-detail/star-fill.js"></script>
                    <div class="product-price-display">
                        <p id="sale-price" class="product-price"></p> <!--Cai nay ko can lam gi ca-->
                        <p id="origin-price" class="product-price">{{ $products -> proprice }}$</p> <!--Fetch tu database len-->
                    </div>
                    <div class="product-description">
                        <p>{{ $products -> prodetails }}</p>
                    </div>
                    <div class="add-to-cart">
                        <div class="cart">
                            <box-icon id="previous" class="quantity-click" name='chevron-left'></box-icon>
                            <p id="quantity"></p>
                            <box-icon id="next" class="quantity-click" name='chevron-right'></box-icon>
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm">Add to cart</button>
                    </div>
                    <div class="addition-information">
                        <div class="category">
                            <p><strong>Category: {{ $products -> catname }}</strong></p>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#description" type="button" role="tab" aria-controls="description"
                                    aria-selected="true">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#addition-info" type="button" role="tab"
                                    aria-controls="addition-info" aria-selected="false">Addition Information</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#contact-tab-pane" type="button" role="tab"
                                    aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <p>
                                    {{ $products -> prodescription }}
                                </p>
                            </div>
                            <div class="tab-pane fade" id="addition-info" role="tabpanel" aria-labelledby="profile-tab"
                                tabindex="0">...</div>
                            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel"
                                aria-labelledby="contact-tab" tabindex="0">...</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="user-feedback">
                <h5>Give your feedback about this product</h5>
                <form id="feedback-form">
                    <div class="mb-3">
                        <label for="displayName" class="form-label">Name you want to display</label>
                        <input type="text" class="form-control" name="userName" id="displayName">
                    </div>
                    <div class="mb-3">
                        <label for="userComment" class="form-label">Your thought</label>
                        <textarea class="form-control" id="userComment" name="userComment" rows="3"></textarea>
                    </div>
                    <h5>Your rating about this product</h5>
                    <div class="rating mb-3">
                        <input type="radio" id="star5" name="rating" value="5" />
                        <label for="star5" title="5 stars">5</label>
                        <input type="radio" id="star4" name="rating" value="4" />
                        <label for="star4" title="4 stars">4</label>
                        <input type="radio" id="star3" name="rating" value="3" />
                        <label for="star3" title="3 stars">3</label>
                        <input type="radio" id="star2" name="rating" value="2" />
                        <label for="star2" title="2 stars">2</label>
                        <input type="radio" id="star1" name="rating" value="1" />
                        <label for="star1" title="1 star">1</label>
                    </div>
                    <div class="modal fade" id="ratingModal" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ratingModalLabel">Alert</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Please select a rating before submitting.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <h3 style="margin-top: 2rem;">Previous User Feedback</h3>
            <div class="view-user-feedback">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">User Name</h5>
                        <h5 class="card-subtitle mb-2 text-body-secondary">Rating</h5>
                        <div class="already-rating mb-3">
                            <label for="star5" title="5 stars">5</label>
                            <label for="star4" title="4 stars">4</label>
                            <label for="star3" title="3 stars">3</label>
                            <label for="star2" title="2 stars">2</label>
                            <label for="star1" title="1 star">1</label>
                        </div>
                        <p class="card-text">Leave user thought here.</p>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">User Name</h5>
                        <h5 class="card-subtitle mb-2 text-body-secondary">Rating</h5>
                        <div class="already-rating mb-3">
                            <label for="star5" title="5 stars">5</label>
                            <label for="star4" title="4 stars">4</label>
                            <label for="star3" title="3 stars">3</label>
                            <label for="star2" title="2 stars">2</label>
                            <label for="star1" title="1 star">1</label>
                        </div>
                        <p class="card-text">Leave user thought here.</p>

                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">User Name</h5>
                        <h5 class="card-subtitle mb-2 text-body-secondary">Rating</h5>
                        <div class="already-rating mb-3">
                            <label for="star5" title="5 stars">5</label>
                            <label for="star4" title="4 stars">4</label>
                            <label for="star3" title="3 stars">3</label>
                            <label for="star2" title="2 stars">2</label>
                            <label for="star1" title="1 star">1</label>
                        </div>
                        <p class="card-text">Leave user thought here.</p>

                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">User Name</h5>
                        <h5 class="card-subtitle mb-2 text-body-secondary">Rating</h5>
                        <div class="already-rating mb-3">
                            <label for="star5" title="5 stars">5</label>
                            <label for="star4" title="4 stars">4</label>
                            <label for="star3" title="3 stars">3</label>
                            <label for="star2" title="2 stars">2</label>
                            <label for="star1" title="1 star">1</label>
                        </div>
                        <p class="card-text">Leave user thought here.</p>

                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">User Name</h5>
                        <h5 class="card-subtitle mb-2 text-body-secondary">Rating</h5>
                        <div class="already-rating mb-3">
                            <label for="star5" title="5 stars">5</label>
                            <label for="star4" title="4 stars">4</label>
                            <label for="star3" title="3 stars">3</label>
                            <label for="star2" title="2 stars">2</label>
                            <label for="star1" title="1 star">1</label>
                        </div>
                        <p class="card-text">Leave user thought here.</p>

                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">User Name</h5>
                        <h5 class="card-subtitle mb-2 text-body-secondary">Rating</h5>
                        <div class="already-rating mb-3">
                            <label for="star5" title="5 stars">5</label>
                            <label for="star4" title="4 stars">4</label>
                            <label for="star3" title="3 stars">3</label>
                            <label for="star2" title="2 stars">2</label>
                            <label for="star1" title="1 star">1</label>
                        </div>
                        <p class="card-text">Leave user thought here.</p>

                    </div>
                </div>
            </div>

        </main>
    </div>
</body>
<script src="../../customer/product-detail/quantity-check.js"></script>
<script src="../../customer/product-detail/sale-apply.js"></script>
<script src="../convertToDollar.js"></script>
<script src="../../customer/product-detail/rating-check.js"></script>
<!--
    JavaScript mau cho rating star nha:D
    const ratingForm = document.getElementById('ratingForm');
const nameInput = document.getElementById('nameInput');
const thoughtInput = document.getElementById('thoughtInput');

ratingForm.addEventListener('submit', function (event) {
  event.preventDefault();

  // Get the selected rating value
  const ratingInputs = document.getElementsByName('rating');
  let selectedRating = 0;
  for (let i = 0; i < ratingInputs.length; i++) {
    if (ratingInputs[i].checked) {
      selectedRating = ratingInputs[i].value;
      break;
    }
  }

  // Create a data object to send to Laravel
  const formData = {
    name: nameInput.value,
    thought: thoughtInput.value,
    rating: selectedRating
  };

  // Send the data to Laravel using fetch or any other method you prefer
  // For example, using fetch:
  fetch('/submit-rating', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(formData)
  })
  .then(response => response.json())
  .then(data => {
    // Handle the response from Laravel if needed
    console.log(data);
  })
  .catch(error => {
    // Handle any errors that occurred during the request
    console.error('Error:', error);
  });
});

-->
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
