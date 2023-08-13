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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../customer/product-detail/product-detail.css">
    <!-- Bootstrap 5 css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>Products: {{ $products->proname }}</title>
</head>

<body>
    <div class="page-container">
        <nav class="navbar navbar-expand-lg bg-transparent">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNav"
                    aria-controls="Click to open nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}" draggable="false">H2ST Furniture</a>
                <div class="collapse navbar-collapse" id="topNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('home') }}"
                                draggable="false">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customerListProducts') }}" draggable="false">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('aboutUs') }}" draggable="false">About Us</a>
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
                                <li><a class="dropdown-item" href="{{ url('../customer/user-profile') }}"><i
                                            class="bi bi-person-lines-fill "></i> My profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-receipt"></i> My order</a>
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
                    <div class="shopping-cart"><a href="{{ route('cart') }}" draggable="false"><box-icon
                                name='cart'></box-icon></a>
                    </div>
                    <form class="d-flex" role="search" action="{{ route('customerListProducts') }}" method="GET">
                        <label>
                            <input type="search" class="search-field" autocomplete="off" placeholder="Search …"
                                name="query" title="Search for:" />
                        </label>
                        <input type="submit" class="search-submit" value="Search" />
                    </form>

                </div>
            </div>
    </div>
    </nav>
    @if (Session::has('AddToCart'))
        <div class="alert alert-success text-center">{{ Session::get('AddToCart') }}</div>
    @endif
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
                <img src="{{ asset('pro_img/' . $products->proimage) }}" alt="{{ $products->proname }}"
                    class="border border-2 rounded-3">
            </div>
            <div class="product-buy-info">
                <div class="product-name">
                    <p>{{ $products->proname }}</p>
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
                    <input type="hidden" id="discount-value" value="{{ $products->discount }}">
                    <p id="sale-price" class="product-price text-success h5"></p>
                    <p id="origin-price" class="product-price text-danger h6">{{ $products->proprice }}$</p>
                </div>
                <div class="product-description">
                    <p>{{ $products->prodescription }}</p>
                </div>
                <div>
                    <form class="add-to-cart" action="{{ url('customer/add-to-cart/' . $products->proid) }}"
                        method="POST">
                        @csrf
                        <div class="cart">
                            <button class="btn-minus" id="previous" type="button">-</button>
                            <input type="text" class="quantity-input" min="1"
                                max="{{ $products->quantity }}" id='quantity' name="getQuantity" readonly>
                            <button class="btn-plus" id="next" type="button">+</button>
                        </div>
                        <button class="btn btn-secondary text-light text center" id="addToCart">Add to
                            cart</button>
                    </form>
                </div>
                <div class="addition-information">
                    <div class="category">
                        <p><strong>Category: {{ $products->catname }}</strong></p>
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#description" type="button" role="tab"
                                aria-controls="description" aria-selected="true">Description</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel"
                            aria-labelledby="home-tab" tabindex="0">
                            {{ $products->prodetails }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-feedback">
            <h3>Give your feedback about this product</h3>
            @if (Session()->get('id') || Auth::id())
                <form id="feedback-form"
                    action="{{ route('userFeedback', ['id' => session()->get('id') ?? Auth::id()]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth::id() }}">
                    <input type="hidden" name="proid" value="{{ $products->proid }}">
                    <div class="mb-3">
                        <label for="vote" class="form-label">Vote</label>
                        <input type="number" class="form-control" name="vote" id="vote" required>
                    </div>
                    <div class="mb-3">
                        <label for="detail" class="form-label">Detail</label>
                        <textarea class="form-control" id="detail" name="detail" rows="3" required></textarea>
                    </div>
                    <h5>Your rating about this product</h5>
                    <div class="rating mb-3">
                        <input type="radio" id="star5" name="rating" value="5" required />
                        <label for="star5" title="5 stars">5</label>
                        <input type="radio" id="star4" name="rating" value="4" required />
                        <label for="star4" title="4 stars">4</label>
                        <input type="radio" id="star3" name="rating" value="3" required />
                        <label for="star3" title="3 stars">3</label>
                        <input type="radio" id="star2" name="rating" value="2" required />
                        <label for="star2" title="2 stars">2</label>
                        <input type="radio" id="star1" name="rating" value="1" required />
                        <label for="star1" title="1 star">1</label>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                @else
                    <div class="alert alert-warning" role="alert">
                        You have to login before recommend a product!
                    </div>
                </form>
            @endif
            <script>
                // Form submission and validation
                document.getElementById('feedback-form').addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    // Perform client-side validation
                    var vote = document.getElementById('vote').value;
                    var rating = document.querySelector('input[name="rating"]:checked');

                    if (!vote || !rating) {
                        // Show the validation error modal
                        var ratingModal = new bootstrap.Modal(document.getElementById('ratingModal'));
                        ratingModal.show();
                    } else {
                        // Submit the form
                        this.submit();
                    }
                });
            </script>

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
        </div>
        <h3 style="margin-top: 2rem;">Previous User Feedback</h3>
        <div class="view-user-feedback">
            @if ($feedbacks)
                @foreach ($feedbacks as $feedback)
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Name: {{ $feedback->username }}</h6><br>
                            <h7 class="card-subtitle mb-2 text-body-secondary">Rating: {{ $feedback->vote }}</h7><br>
                            <div class="already-rating mb-3">
                                @for ($i = 5; $i >= 1; $i--)
                                    <label for="star{{ $i }}"
                                        title="{{ $i }} stars">{{ $i }}</label>
                                @endfor
                            </div>
                            <p class="card-text">{{ $feedback->detail }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No feedbacks found.</p>
            @endif
            <div class="card">
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
            <div class="card">
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
            <div class="card">
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
            <div class="card">
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

        <div class="recommend-product">
            <h1>Maybe you will love this</h1>
            <div class="product-list-container">
                <div class="product-list mb-3">
                    @foreach ($relatedProducts as $relatedProduct)
                        <a href="" class="product-item border border-2 rounded">
                            <div class="card border-light">
                                <img src="{{ asset('pro_img/' . $relatedProduct->proimage) }}" class="card-img-top"
                                    alt="..." loading="lazy">
                                <div class="card-body">
                                    <p class="product-name text-center">{{ $relatedProduct->proname }}</p>
                                    <p class="product-price text-center">{{ $relatedProduct->proprice }}</p>
                                    <p class="text-center product-rating">
                                        <i class="bi bi-star"></i><i class="bi bi-star"></i><i
                                            class="bi bi-star"></i><i class="bi bi-star"></i><i
                                            class="bi bi-star"></i>
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<footer>
    <div class="foot-container text-center">
        <a class="navbar-brand" href="{{ route('home') }}">H2ST Furniture</a>
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
