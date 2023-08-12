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
                <a class="navbar-brand" href="#">H2ST Furniture</a>
                <div class="collapse navbar-collapse" id="navbarToggler">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About Us</a>
                        </li>
                    </ul>
                    <div class="user-ava"><a href="#"><box-icon name='user'></box-icon></a></div>
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
        <div class="information">
            <h1>Fill your information for shipment</h1>
            <br>
            <form action="{{ url('customer/confirm-order-page') }}" method="post">
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
                    <input type="text" class="form-control" id="userName" id="userName"
                    value="@if(session('user')){{ session('user')->getName() }}@else{{ Session::get('userfirstname') }} {{ Session::get('userlastname') }}@endif" required>
                </div>
                <div class="mb-3">
                    <label for="userPhone" class="form-label">Your Phone Number</label>
                    <input type="text" class="form-control" id="userPhone" name="userPhone"
                    value="@if(session('user'))@if (method_exists(session('user'), 'getPhone')){{ session('user')->getPhone() }}@endif @else{{ Session::get('userphone') }}@endif" required>
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
                option.value = d.code; // Add value for the option, d.code is the code of each city
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
                const selectedCityData = data.find(city => city.code === parseInt(getSelectProvince));

                if (selectedCityData) {
                    //Create district data of that province
                    selectedCityData.districts.map((district) => {
                        const option = document.createElement('option');
                        option.value = district.code; //Set district value as its code for further purposes
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
                        const selectedDistrictData = selectedCityData.districts.find(district => district.code === parseInt(getSelectDistrict));

                        //Create ward data of that district
                        if (selectedDistrictData) {
                            selectedDistrictData.wards.map((wards) => {
                                const option = document.createElement('option');
                                option.value = wards.code;
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
