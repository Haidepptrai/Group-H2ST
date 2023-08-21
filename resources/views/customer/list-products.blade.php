@include('layout.customer.header-product')
        @if (session()->has('order_success'))
            <div class="alert alert-success">{{ session()->get('order_success') }}</div>
        @endif
        @if (session()->has('order_fail'))
            <div class="alert alert-success">{{ session()->get('order_fail') }}</div>
        @endif
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
                                href="{{ route('customerListProducts', ['sort' => 'bestseller']) }}">Popularity</a>
                        </li>
                    </ul>
                </div>
            </div>

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
                            <input type="number" name="min_price" id="min_price"
                                value="{{ request('min_price') }}">
                        </div>
                        <div class="form-item">
                            <label for="max_price">Max Price:</label>
                            <input type="number" name="max_price" id="max_price"
                                value="{{ request('max_price') }}">
                        </div>
                        <button type="submit">Apply Filters</button>
                    </form>
                </div>
            </div>

            <div class="product-display">
                <div class="product-list">
                    @if (!$products->isEmpty())
                        @foreach ($products as $product)
                            @php
                                $displayProduct = $product->status == 1 && $product->category->status == 1;
                            @endphp
                            @if ($displayProduct)
                                <div class="product-item btn-group">
                                    <a href="{{ url('customer/detail-products/' . $product->proid) }}"
                                        class="btn btn-outline-secondary border border-5 rounded-4 product"
                                        draggable="false">
                                        <div class="product-image">
                                            <img src="{{ asset('pro_img/' . $product->proimage) }}"
                                                alt="{{ $product->proname }}" class="rounded-2" loading="lazy">
                                        </div>
                                        <div class="product-info">
                                            <p class="product-name">{{ $product->proname }}</p>
                                            <p class="stars">
                                            <!-- <div class="star-rating">
                                                @php
                                                    $fullStars = floor($roundedAverageVote);
                                                    $decimalPart = $roundedAverageVote - $fullStars;
                                                    $remainingStars = 5 - $fullStars - $decimalPart;
                                                @endphp

                                                @for ($i = 1; $i <= $fullStars; $i++)
                                                    <span class="bi bi-star" style="color: gold;"></span>
                                                @endfor

                                                @if ($decimalPart >= 0.1 && $decimalPart <= 0.5)
                                                    <span class="bi bi-star-half" style="color: gold;"></span>
                                                @elseif ($decimalPart >= 0.6 && $decimalPart <= 0.9)
                                                    <span class="bi bi-star" style="color: gold;"></span>
                                                @endif

                                                @for ($i = 1; $i <= $remainingStars; $i++)
                                                    <span class="bi bi-star" style="color: gray;"></span>
                                                @endfor
                                            </div> -->
                                            </p>
                                            @php
                                                $salePrice = $product->proprice - ($product->proprice * $product->discount) / 100;
                                            @endphp
                                            <p class="product-price text-success h4">
                                                {{ number_format($salePrice, 2) }}$
                                            </p>
                                            <p class="product-price text-danger h6 text-decoration-line-through">
                                                {{ $product->proprice }}$</p>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100"
                                    fill="currentColor" class="bi bi-emoji-frown display-4 text-muted mb-3"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M8 1a7 7 0 0 0-7 7c0 3.198 2.209 5.935 5.188 6.628a1 1 0 0 0 .624 0C13.791 13.935 16 11.198 16 8a7 7 0 0 0-7-7zm-.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm2-1.5a.5.5 0 0 0-1 0V10a1 1 0 0 0-1-1 1 1 0 0 0-1 1v.5a2 2 0 0 0 2 2 2 2 0 0 0 2-2z" />
                                </svg>
                                <p class="h5">Oops! No products match your search criteria.</p>
                                <p class="mb-4">Feel free to explore other categories or refine your search.</p>
                                <a href="{{ route('customerListProducts') }}" class="btn btn-primary btn-lg">Explore
                                    Categories</a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="category-list">
                    <h5>Categories</h5>
                    <ul>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('customerListProducts', ['catid' => $category->catid]) }}"
                                    class="btn btn-outline-light text-dark"
                                    draggable="false">{{ $category->catname }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="pagination">
                <nav aria-label="Product list panigation">
                    <ul class="pagination">
                        @if (isset($search))
                            <li class="page-item{{ $search->previousPageUrl() ? '' : ' disabled' }}">
                                <a class="page-link"
                                    href="{{ $search->appends(['query' => $searchQuery])->previousPageUrl() }}"><i
                                        class="bi bi-arrow-bar-left"></i></a>
                            </li>
                            @for ($i = 1; $i <= $search->lastPage(); $i++)
                                <li class="page-item{{ $i == $search->currentPage() ? ' active' : '' }}">
                                    <a class="page-link"
                                        href="{{ $search->appends(['query' => $searchQuery])->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item{{ $search->nextPageUrl() ? '' : ' disabled' }}">
                                <a class="page-link"
                                    href="{{ $search->appends(['query' => $searchQuery])->nextPageUrl() }}"><i
                                        class="bi bi-arrow-bar-right"></i></a>
                            </li>
                        @else
                            <li class="page-item{{ $products->previousPageUrl() ? '' : ' disabled' }}">
                                <a class="page-link" href="{{ $products->previousPageUrl() }}"><i
                                        class="bi bi-arrow-bar-left"></i></a>
                            </li>
                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                                <li class="page-item{{ $i == $products->currentPage() ? ' active' : '' }}">
                                    <a class="page-link"
                                        href="{{ route('customerListProducts', array_merge(request()->except('page'), ['page' => $i])) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item{{ $products->nextPageUrl() ? '' : ' disabled' }}">
                                <a class="page-link" href="{{ $products->nextPageUrl() }}"><i
                                        class="bi bi-arrow-bar-right"></i></a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
    </div>
    </div>

    </main>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/nouislider@X.X.X/dist/nouislider.min.js"></script>
<script src="../../customer/products-list/displaySort.js"></script>

@include('layout.customer.footer')
