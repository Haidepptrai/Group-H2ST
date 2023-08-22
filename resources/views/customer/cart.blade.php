<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layout.customer.header-tag')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ URL::asset('customer/shopping-cart/shopping-cart.css') }}">
    <script src="{{ asset('js/custom.js') }}"></script>
    <title>Shopping Cart</title>
</head>

<body>
    <div class="page-container">
        @include('layout.customer.top-navigate')
        <div class="cart-info">
            <a class="icon-link" href="{{ route('customerListProducts') }}">
                <box-icon class="backLink" name='chevrons-left' color="#0d6efd"></box-icon>
                Continue Shopping
            </a>
            <div class="title">
                <h5>Shopping cart</h5>
            </div>
            <form action="@if (Session::has('id'))
            {{ url('customer/input-user/'.Session::get('id')) }}
            @elseif(Session::has('user'))
            {{ url('customer/input-user/'.Auth::id()) }}
            @endif
            " method="GET">
                @csrf
                <div class="overflow-auto border border-2 mb-2" style="height: 700px;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (session('cart'))
                                @php
                                    $i = 1;
                                    $total = 0;
                                @endphp
                                @foreach (session('cart') as $id => $details)
                                    <tr class="cart" rowId="{{ $id }}">
                                        @php
                                        $proid = $details['proid'];
                                        @endphp
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $details['proname'] }}</td>
                                        <td><img src="../pro_img/{{ $details['proimage'] }}" alt=""
                                                class="rounded" width="100" height="100">
                                        </td>
                                        <td class="product-price text-success" id="price_{{ $i }}">
                                            {{ $details['proprice'] }}</td>
                                        <td class="view-quantity">
                                            <div class="adjust-quantity">
                                                <div class="select-quantity">
                                                    <button type="button" class="btn-minus"
                                                        onclick="decreaseQuantity({{ $details['proid'] }}, {{ $i }})">-</button>
                                                    <input type="number" value="{{ $details['quantity'] }}"
                                                        id='quantity_{{ $i }}' min="1"
                                                        max="{{ $details['inventory'] }}" readonly>
                                                    <button type="button" class="btn-plus"
                                                        onclick="increaseQuantity({{ $details['proid'] }}, {{ $i }})">+</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ url('customer/remove-from-cart/' . $details['proid']) }}"
                                                class="text-danger"><i class="bi bi-trash-fill"></a></i>
                                        </td>
                                    </tr>
                                    @php
                                        $proPrice = $details['proprice'] * $details['quantity'];
                                        $total += $proPrice;
                                    @endphp
                                @endforeach
                                <input type="hidden" id="lenght" value="{{ count(session('cart')) }}">
                            @else
                                <tr>
                                    <td colspan="6" class="text-center text-danger h3">Cart is empty</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="float-end">
                    @if (session('cart'))
                        Totals: <span class="text-success">$</span><span class="text-success"
                            id="total-cart">{{ $total }}</span>
                        <br>
                        <button type="submit" class="btn btn-primary text-light text center">Confirm</button>
                    @endif
                </div>
            </form>
        </div>
</body>
<script src="../customer/convertToDollar.js"></script>
{{-- <script src="../customer/shopping-cart/product-quantity.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{URL::asset('customer/shopping-cart/adjustQuantity.js')}}"></script>
@include('layout.customer.footer')
