<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.customer.header-tag')
    <link rel="stylesheet" href="{{ URL::asset('customer/confirm-order/confirm-order.css') }}">
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="{{ asset('js/custom.js') }}"></script>
    <title>Confirm order</title>
</head>

<body>
    <div class="page-container">
        @include('layout.customer.top-navigate')
        @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="cart-info">
            <a class="icon-link" href="#">
                <box-icon class="backLink" name='chevrons-left' color="#0d6efd"></box-icon>
                Back to order
            </a>
            <div class="title text-center text-primary my-5">
                <h1>Confirm order</h1>
            </div>
            <div class="confirm-information">
                <form class="confirm-send" action="{{ url('customer/add-order') }}" method="POST">
                    @csrf
                    <table class="table product-confirm">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 20%;">Product Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (session('cart'))
                                @foreach (session('cart') as $id => $details)
                                <tr class="cart">
                                    <input type="text" name='productID' value="c" hidden>
                                    <td>{{ $details['proname'] }}</td>
                                    <td ><img
                                            src="../../pro_img/{{ $details['proimage'] }}"
                                            class="rounded" width="100" height="100">
                                    </td>
                                    <td class="product-price text-success">{{ $details['proprice'] }}$</td>
                                    <td class="view-quantity">
                                        {{ $details['quantity'] }}
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="line"></div>
                    <div class="customer-infor">
                        <h4>Customer Information</h4>
                        <input type="hidden" class="form-control" id="userId" name="userId"
                        value="@if(session('user')){{ Auth::id() }}@else{{ Session::get('id') }}@endif"
                        aria-describedby="emailHelp" required>
                        <div class="mb-3 ms-3">
                            <label for="userEmail" class="form-label fw-bold">Email</label>
                            <input type="text" readonly class="form-control-plaintext" id="userEmail"
                                value="{{ $email }}" name="userEmail">
                        </div>
                        <div class="mb-3 ms-3">
                            <label for="userName" class="form-label fw-bold">Name</label>
                            <input type="text" readonly class="form-control-plaintext" id="userName"
                                value="{{ $name }}" name="userName">
                        </div>
                        <div class="mb-3 ms-3">
                            <label for="userPhone" class="form-label fw-bold">Phone Number</label>
                            <input type="text" readonly class="form-control-plaintext" id="userPhone"
                                value="{{ $phone }}" name="userPhone">
                        </div>
                        <div class="mb-3 ms-3">
                            <label for="userAddress" class="form-label fw-bold">Address</label>
                            <input type="text" readonly class="form-control-plaintext" id="userAddress"
                                value="{{ $address }}" name="userAddress">
                        </div>
                        <div class="mb-3 ms-3">
                            <label for="userWard" class="form-label fw-bold">Your Ward</label>
                            <input type="text" readonly class="form-control-plaintext" id="userWard"
                                value="{{ $ward == Null ? $user->userward : $ward}}" name="userWard">
                        </div>
                        <div class="mb-3 ms-3">
                            <label for="userDistrict" class="form-label fw-bold">Your District</label>
                            <input type="text" readonly class="form-control-plaintext" id="userDistrict"
                                value="{{ $district == Null ? $user->userdistrict : $district}}" name="userDistrict">
                        </div>
                        <div class="mb-3 ms-3">
                            <label for="userCity" class="form-label fw-bold">Your City</label>
                            <input type="text" readonly class="form-control-plaintext" id="userCity"
                                value="{{ $city == Null ? $user->usercity : $city}}" name="userCity">
                        </div>
                    </div>
                    <div class="float-end mx-5 confirm-button">
                        <button type="submit" class="btn btn-primary position-relative"> Payment </button>
                        <div class="total">
                            Totals:  <input id="total-price" class="text-success" name="total" value="${{ Session::get('total') }}" readonly>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="{{URL::asset('/customer/convertToDollar.js')}}"></script>
@include('layout.customer.footer')
