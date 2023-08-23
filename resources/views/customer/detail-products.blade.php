<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.customer.header-tag')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ URL::asset('customer/product-detail/product-detail.css') }}"></link>

    <title>Products: {{ $products->proname }}</title>
</head>
<body>
    <div class="page-container">
        @include('layout.customer.top-navigate')
        @if (Session::has('AddToCart'))
        <div class="alert alert-success text-center">{{ Session::get('AddToCart') }}</div>
        @endif
        <main>
            <div class="breadcrumb">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('customerListProducts') }}">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('customer/detail-products/' . $products->proid) }}">{{ $products->proname }}</a></li>
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
                        @php
                            $fullStars = floor($roundedAverageVote);
                            $decimalPart = $roundedAverageVote - $fullStars;
                            $remainingStars = 5 - $fullStars - $decimalPart;
                        @endphp
                        @for ($i = 1; $i <= $fullStars; $i++)
                            <span class="fa fa-star" style="color: gold;"></span>
                        @endfor

                        @if ($decimalPart >= 0.1 && $decimalPart <= 0.4)
                            <span class="fa fa-star-half" style="color: gold;"></span>
                        @elseif ($decimalPart >= 0.6 && $decimalPart <= 0.9)
                            <span class="bi bi-star" style="color: gold;"></span>
                        @endif
                        @for ($i = 1; $i <= $remainingStars; $i++)
                            <span class="fa fa-star" style="color: gray;"></span>
                        @endfor
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
                            @if ($products->proquantity == 0)
                                <div class="text-danger">This product is out of stock</div>
                            @else
                                <button class="btn btn-secondary text-light text center" id="addToCart">Add to
                                    cart</button>
                            @endif
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
                            <label for="detail" class="form-label">Detail</label>
                            <textarea class="form-control" id="detail" name="detail" rows="3" required></textarea>
                        </div>
                        <h5>Your rating about this product</h5>
                        <div class="rating mb-3">
                            <input type="radio" id="star5" name="rating" value="5"/>
                            <label for="star5" title="5 stars">5</label>
                            <input type="radio" id="star4" name="rating" value="4"/>
                            <label for="star4" title="4 stars">4</label>
                            <input type="radio" id="star3" name="rating" value="3"/>
                            <label for="star3" title="3 stars">3</label>
                            <input type="radio" id="star2" name="rating" value="2"/>
                            <label for="star2" title="2 stars">2</label>
                            <input type="radio" id="star1" name="rating" value="1"/>
                            <label for="star1" title="1 stars">1</label>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <script src="../../customer/product-detail/validateRating.js"></script>
                @endif
                <div class="modal fade" id="ratingModalAlert" data-bs-backdrop="static" data-bs-keyboard="false"
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
                                        <label for="star{{ $i }}" title="{{ $i }} stars"
                                            style="color: {{ $i <= $feedback->vote ? 'gold' : 'gray' }};"></label>
                                    @endfor
                                </div>
                                <p class="card-text">{{ $feedback->detail }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No feedbacks found.</p>
                @endif
            </div>

            <div class="recommend-product">
                <h1>Maybe you will love this</h1>
                <div class="product-list-container">
                    <div class="product-list mb-3">
                        @foreach ($relatedProducts as $relatedProduct)
                            <a href="{{ url('customer/detail-products/' . $relatedProduct->proid) }}" class="product-item border border-2 rounded">
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
<script src="{{ URL::asset('customer/product-detail/sale-apply.js') }}"></script>
<script src="{{ URL::asset('customer/convertToDollar.js') }}"></script>
<script src="{{ URL::asset('customer/product-detail/rating-check.js') }}"></script>
@include('layout.customer.footer')
