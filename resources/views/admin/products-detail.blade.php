@include('layout.admin.header-for-edit')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Products Detail</h3>
                                    @section('content')
                                        <div class="container">
                                            <h1>{{ $product->proname }}</h1>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4"
                                                    style="border: solid 1px black; border-radius: 50px 20px; display: flex; justify-content: center; align-items: center;">
                                                    <img src="{{ asset('pro_img/' . $product->proimage) }}"
                                                        alt="{{ $product->proname }}" class="img-fluid-3"
                                                        style="max-width: 90%; max-height: 90%; object-fit: cover;">
                                                </div>
                                                <div class="col-md-8">
                                                    <p><strong>Description:</strong> {{ $product->prodescription }}</p>
                                                    <p><strong>Details:</strong> {{ $product->prodetails }}</p>
                                                    <p><strong>Price:</strong> ${{ $product->proprice }}</p>
                                                    <p><strong>Discount:</strong> {{ $product->discount }}%</p>
                                                    <p><strong>Quantity:</strong> {{ $product->proquantity }}</p>
                                                    <p><strong>Category:</strong> {{ $product->catname }}</p>
                                                    <p><strong>Status:</strong>
                                                        @if ($product->status == 1)
                                                            <span style="color: green;">Show</span>
                                                        @else
                                                            <span style="color: red;">Not Show</span>
                                                        @endif
                                                    </p>
                                                    <p><strong>Hot Sales:</strong>
                                                        @if ($product->bestseller == 1)
                                                            <span style="color: green;">Best Sell</span>
                                                        @else
                                                            <span style="color: red;">Normal</span>
                                                        @endif
                                                    </p>
                                                    <p><strong>Date Added:</strong>
                                                        {{ date('Y-m-d', strtotime($product->date)) }}</p>
                                                </div>
                                            </div>
                                        </div><br><br>
                                        <a href="{{ url('admin/products-edit/' . $product->proid) }}"
                                            class="btn btn-secondary">Edit</a>
                                        <a href="{{ url('admin/products-list') }}" class="btn btn-secondary">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- main-panel ends -->
                </div>
                <!-- page-body-wrapper ends -->
            </div>
            <!-- container-scroller -->
            @include('layout.admin.footer-for-edit')
