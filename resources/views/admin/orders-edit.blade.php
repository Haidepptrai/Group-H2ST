@include('layout.admin.header-for-edit')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-stretch grid-margin">
                            <div class="row flex-grow">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h2 class="card-title mb-4 text-center">Edit Order</h2>
                                            @if (Session::has('success'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ Session::get('success') }}</div>
                                            @endif
                                            <form class="forms-sample" method="POST"
                                                action="{{ url('admin/orders-update') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="OrderID">Order ID</label>
                                                    <input type="text" class="form-control" id="OrderID"
                                                        name="OrderID" value="{{ $order->orderid }}" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="UserID">User ID</label>
                                                    <input type="text" class="form-control" id="UserID"
                                                        name="UserID" readonly value="{{ $order->userid }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="UserID">User Name</label>
                                                    <input type="text" class="form-control" id="UserID"
                                                        name="UserID" readonly value="{{ $order->userid }}">
                                                </div>

                                                <button type="submit" class="btn btn-success mr-2">Update</button>
                                                <a href="{{ url('admin/orders-list') }}"
                                                    class="btn btn-success">Back</a>
                                            </form>
                                        </div>
                                    </div>
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
