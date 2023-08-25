<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.customer.header-tag')
    <link rel="stylesheet" href="{{ URL::asset('customer/input-user-info/input-user-info.css') }}">
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places,geometry"></script>
    <title>Your information</title>
</head>

<body>
    <div class="page-container">
        @include('layout.customer.top-navigate')
        <div class="information">
            <h1>Fill your information for shipment</h1>
            <br>
            <form action="{{ url('customer/confirm-order-page/'.$user->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="userEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="userEmail" name="userEmail"
                    value="{{ $user->useremail }}"
                        aria-describedby="emailHelp" required>
                    <div id="emailHelp" class="form-text text-danger user-select-none">We'll never share your email with
                        anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="userName" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="userName" name="userName"
                    value="{{ $user->userfirstname }} {{ $user->userlastname }}" required>
                </div>
                <div class="mb-3">
                    <label for="userPhone" class="form-label">Your Phone Number</label>
                    <input type="text" class="form-control" id="userPhone" name="userPhone"
                    value="{{ $user->userphone }}" pattern="[0-9]{4}[0-9]{3}[0-9]{3}" placeholder="Input your phone number"  title="Please enter a valid 9 to 12 digit phone number" required>
                </div>
                <div class="mb-3">
                    <label for="userAddress" class="form-label">Your Address</label>
                    <input type="text" class="form-control" id="userAddress" name="userAddress"
                    value="{{ $user->useraddress }}" required>
                </div>
                <div class="mb-3">
                    <select class="form-select" id="select-province" aria-label="Select City" name="userCity" required>
                        <option disabled selected value="{{ $user->usercity !== NULL ? $user->usercity : ''}}">{{ $user->usercity !== NULL ? $user->usercity : 'Select Province'}}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <select class="form-select" id="select-district" aria-label="Select Districts" name="userDistrict" required>
                        <option disabled selected value="{{ $user->userdistrict !== NULL ? $user->userdistrict : ''}}">{{ $user->userdistrict !== NULL ? $user->userdistrict : 'Select District'}}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <select class="form-select" id="select-wards" aria-label="Select Wards" name="userWard" required>
                        <option disabled selected value="{{ $user->userward !== NULL ? $user->userward : ''}}">{{ $user->userward !== NULL ? $user->userward : 'Select Ward'}}</option>
                    </select>
                </div>
                <div class="mb-3">
                <label for="shippingCost" class="form-label">Shipping cost</label>
                    <input type="text" class="form-control text-success" id="shippingCost" name="shippingCost" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <div id='map' style="width: 30rem; height: 30rem;"></div>
        </div>
    </div>
</body>

<script src=" {{URL::asset('customer/input-user-info/getVietNamAPI.js') }}"></script>

@include('layout.customer.footer')
