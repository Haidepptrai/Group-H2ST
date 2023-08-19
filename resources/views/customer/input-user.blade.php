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
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../customer/input-user-info/input-user-info.css">
    <script src="{{ asset('js/custom.js') }}"></script>
    <title>Your information</title>
</head>

<body>
    <div class="page-container">
        <nav class="navbar navbar-expand-lg bg-transparent z-1">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
                    aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ route('customerListProducts') }}">H2ST Furniture</a>
                <div class="collapse navbar-collapse" id="navbarToggler">
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
                        <div class="dropdown">
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
                                @if (Session::has('id'))
                                    <li><a class="dropdown-item"
                                            href="{{ url('customer/user-profile/' . Session::get('id')) }}"><i
                                                class="bi bi-person-lines-fill "></i> My profile</a></li>
                                @elseif (session('user'))
                                    <li><a class="dropdown-item"
                                            href="{{ url('customer/user-profile/' . Auth::id()) }}"><i
                                                class="bi bi-person-lines-fill "></i> My profile</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('customerLogout') }}"><i
                                            class="bi bi-box-arrow-in-left"></i>Log out</a></li>
                            </ul>
                        </div>
                    @else
                        <div class="user-ava"><a href="{{ route('customerLogin') }}" draggable="false"><box-icon
                                    name='user'></box-icon></a></div>
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
        </nav>
        <div class="information">
            <h1>Fill your information for shipment</h1>
            <br>
            <form action="{{ url('customer/confirm-order-page') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="userEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="userEmail" name="userEmail"
                    value="@if(session('user')){{ session('user')->getEmail() }}@else{{ Session::get('useremail') }}@endif"
                        aria-describedby="emailHelp" required>
                    <div id="emailHelp" class="form-text text-danger user-select-none">We'll never share your email with
                        anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="userName" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="userName" name="userName"
                    value="@if(session('user')){{ session('user')->getName() }}@else{{ Session::get('userfirstname') }} {{ Session::get('userlastname') }}@endif" required>
                </div>
                <div class="mb-3">
                    <label for="userPhone" class="form-label">Your Phone Number</label>
                    <input type="text" class="form-control" id="userPhone" name="userPhone"
                    value="@if(session('user'))@if (method_exists(session('user'), 'getPhone')){{ session('user')->getPhone() }}@endif @else{{ Session::get('userphone') }}@endif" required>
                </div>
                <div class="mb-3">
                    <label for="userAddress" class="form-label">Your Address</label>
                    <input type="text" class="form-control" id="userAddress" name="userAddress"
                    value="@if(session('user'))@if (method_exists(session('user'), 'getAddress')){{ session('user')->getAddress() }}@endif @else{{ Session::get('useraddress') }}@endif" required>
                </div>
                <div class="mb-3">
                    <select class="form-select" id="select-province" aria-label="Select City" name="userCity" required>
                        <option disabled selected>Select City</option>
                    </select>
                </div>
                <div class="mb-3">
                    <select class="form-select" id="select-district" aria-label="Select Districts" name="userDistrict" required>
                        <option disabled selected>Select Districts</option>
                    </select>
                </div>
                <div class="mb-3">
                    <select class="form-select" id="select-wards" aria-label="Select Wards" name="userWard" required>
                        <option disabled selected>Select Wards</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>

<script>
    const selectProvince = document.getElementById('select-province');
    const selectDistrict = document.getElementById('select-district');
    const selectWards = document.getElementById('select-wards');
    selectDistrict.disabled = true;
    selectWards.disabled = true;


    //Get province
    fetch('https://provinces.open-api.vn/api/?depth=3')
        .then(response => response.json())
        .then(data => {
            // Process the data and update your application's state
            data.map((d) => {
                const option = document.createElement('option'); // Create a new option element
                option.value = d.name; // Add value for the option, d.code is the code of each city
                option.textContent = d.name; // Set the text content of the option, d.name is city name from api
                selectProvince.appendChild(option); // Append the option to the select element
            })

            //Happens when user select their city
            selectProvince.addEventListener("change", function () {
                //Get province code
                const getSelectProvince = selectProvince.value;
                selectDistrict.disabled = false;

                //Reset the district option
                selectDistrict.innerHTML = '<option selected disabled>Select District</option>';
                selectWards.innerHTML = '<option selected disabled>Select District</option>';

                //Get city details district. Find the specific city by it value set at beginning
                const selectedCityData = data.find(city => city.name === getSelectProvince);

                if (selectedCityData) {
                    //Create district data of that province
                    selectedCityData.districts.map((district) => {
                        const option = document.createElement('option');
                        option.value = district.name; //Set district value as its code for further purposes
                        option.textContent = district.name;
                        selectDistrict.appendChild(option);
                    })

                    //If user selected their district, the wards will came appear
                    selectDistrict.addEventListener('change', function () {
                        //Get district code
                        const getSelectDistrict = selectDistrict.value;
                        selectWards.disabled = false;

                        //Reset the ward option
                        selectWards.innerHTML = '<option selected disabled>Select Ward</option>';

                        //Find specific district data
                        const selectedDistrictData = selectedCityData.districts.find(district => district.name === getSelectDistrict);

                        //Create ward data of that district
                        if (selectedDistrictData) {
                            selectedDistrictData.wards.map((wards) => {
                                const option = document.createElement('option');
                                option.value = wards.name;
                                option.textContent = wards.name;
                                selectWards.appendChild(option);
                            })
                        }
                    })
                }
            })

        })
        .catch(error => {
            console.error('Error fetching data - Please reload the page:', error);
        });
</script>
