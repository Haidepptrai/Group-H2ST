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
    <link rel="stylesheet" href="../customer/personal-account/personal-account.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.0/css/bootstrap.min.css">
    <title>Personal Setting</title>
</head>

<body>
    <nav>
    </nav>
    <div class="d-flex align-items-start">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <div class="logo-brand">
                <a class="navbar-brand" href="{{ route('home') }}">H2ST Furniture</a>
            </div>
            <button class="nav-link active" id="v-pills-profile-tab" data-bs-toggle="pill"
                data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="#v-pills-profile"
                aria-selected="true">Account</button>
            <button class="nav-link" id="v-pills-order-tab" data-bs-toggle="pill" data-bs-target="#v-pills-order"
                type="button" role="tab" aria-controls="v-pills-order" aria-selected="true">Your order</button>
            <button class="nav-link" id="v-pills-delete-tab" data-bs-toggle="pill" data-bs-target="#v-pills-delete"
                type="button" role="tab" aria-controls="v-pills-delete" aria-selected="false">Delete
                Account</button>
            <a class="btn text-primary logoutBtn" href="{{ route('customerLogout') }}" role="button">Log out</a>
        </div>
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel"
                aria-labelledby="v-pills-profile-tab" tabindex="0">
                <div class="tab-title">
                    Your Profile
                </div>

                <div class="user-profile">
                    <div class="user-ava">
                        @if (session('user'))
                            <img src="{{ session('user')->getAvatar() }}" alt="">
                        @endif
                        @if (Session()->has('id'))
                            <img src="../user_img/{{ Session::get('userimage') }}" alt="">
                        @endif
                    </div>
                    <div class="user-basic-info">
                        <div class="user-name">
                            @if (session('user'))
                                <h6>{{ session('user')->getName() }}</h6>
                            @endif
                            @if (Session()->has('id'))
                                <h6>{{ Session::get('userfirstname') }}</h6>
                            @endif
                        </div>
                        <div class="date-create">
                            <p>
                                Member since 2020
                            </p>
                        </div>
                    </div>
                    @if (Session()->has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (session()->has('id'))
                        <div class="change-ava-button">
                            <form action="{{ route('updateUserAvatar', ['id' => session()->get('id')]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="avatar" style="display: none;" id="avatarInput" />
                                <button type="button" id="change-avatar-btn">Change Avatar</button>
                            </form>
                        </div>
                    @endif

                </div>
                <hr width="95%" style="margin: auto;">
                <div class="personal-setting">
                    @if (session()->has('id'))
                        <form action="{{ route('updateUserProfile', ['id' => session()->get('id')]) }}" id="userForm"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="container-lg">
                                <div class="row row-cols-2">
                                    <div class="col">
                                        <label for="userfirstName">First Name</label>
                                        <input type="text" name="userfirstName" id="userfirstName"
                                            value="{{ session('user') ? session('user')->getName() : '' }}{{ Session()->has('id') ? Session::get('userfirstname') : '' }}"
                                            placeholder="Update your first name">
                                    </div>
                                    <div class="col">
                                        <label for="userlastName">Last Name</label>
                                        <input type="text" name="userlastName" id="userlastName"
                                            value="{{ session('user') ? session('user')->getName() : '' }}{{ Session()->has('id') ? Session::get('userlastname') : '' }}"
                                            placeholder="Update your last name">
                                    </div>
                                    <div class="col">
                                        <label for="userEmail">Email</label>
                                        <input type="email" name="userEmail" id="userEmail"
                                            value="{{ session('user') ? session('user')->getEmail() : '' }}{{ Session()->has('id') ? Session::get('useremail') : '' }}"
                                            placeholder="Update your email">
                                    </div>
                                    <div class="col">
                                        <label for="userGender">Gender</label>
                                        <select name="userGender" id="userGender">
                                            <option value="0"
                                                {{ session('user') ? '' : '' }}{{ Session()->has('id') && Session::get('usergender') == 0 ? 'selected' : '' }}>
                                                Male</option>
                                            <option value="1"
                                                {{ session('user') ? '' : '' }}{{ Session()->has('id') && Session::get('usergender') == 1 ? 'selected' : '' }}>
                                                Female</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="userPass">Enter your password</label>
                                        <input type="text" name="userPass" id="userPass"
                                            value=" @if (session('user')) {{ Session::get('userpassword') }} @endif @if (Session()->has('id')) {{ Session::get('userpassword') }} @endif ">
                                    </div>
                                    <div class="col">
                                        <label for="userAddress">Enter your Address</label>
                                        <input type="text" name="userAddress" id="userAddress"
                                            value="{{ session('user') ? Session::get('useraddress') : '' }}{{ Session()->has('id') ? Session::get('useraddress') : '' }}"
                                            placeholder="Update your address">
                                    </div>
                                    <div class="col">
                                        <label for="userPhone">Enter a phone number</label>
                                        <input type="tel" id="userPhone" name="userPhone"
                                            value="{{ session('user') ? Session::get('userphone') : '' }}{{ Session()->has('id') ? Session::get('userphone') : '' }}"
                                            pattern="[0-9]{3}[0-9]{3}[0-9]{4}"
                                            placeholder="Update your phone number"><br>
                                    </div>
                                    <div class="col">
                                        <label for="userAddress">Enter your birthday</label>
                                        <input type="text" name="userAddress" id="userAddress"
                                            value="{{ session('user') ? Session::get('userbirthday') : '' }}{{ Session()->has('id') ? Session::get('userbirthday') : '' }}"
                                            placeholder="Update your birthday">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary " id="saveChangesBtn">Save
                                    changes</button>
                                {{-- <button type="submit" class="btn btn-primary confirm-change">Save changes</button> --}}
                                <div class="modal fade" id="nameAlert" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Alert</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Please do not let first name and last name be empty. Also in correct
                                                format
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal">Understood
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

            <div class="tab-pane fade" id="v-pills-order" role="tabpanel" aria-labelledby="v-pills-order-tab"
                tabindex="0">
                <div class="tab-title">
                    Your Order
                </div>
                <div class="order-info">
                    <table class="table table-bordered">
                        <h6 class="text-info">Order ID: #111 details</h6>
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Date order</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Jacob</td>
                                <td><img src="../product-list-page/product-list/051d8eb5f2d13e23a6b2d9832bb17b64.jpg"
                                        alt=""></td>
                                <td>Jacob</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td><img src="../product-list-page/product-list/051d8eb5f2d13e23a6b2d9832bb17b64.jpg"
                                        alt=""></td>
                                <td>Jacob</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Jacob</td>
                                <td><img src="../product-list-page/product-list/051d8eb5f2d13e23a6b2d9832bb17b64.jpg"
                                        alt=""></td>
                                <td>Jacob</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Date order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Mark</td>
                                <td>Otto</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="v-pills-delete" role="tabpanel" aria-labelledby="v-pills-delete-tab"
                tabindex="0">
                <div class="tab-title text-danger">
                    Delete Your Account
                </div>
                <div class="input-password">
                    <form action="#" id="userFormDelete">
                        <div class="col">
                            <label for="userPassDelete">Enter your password</label>
                            <input type="password" name="userPassDelete" id="userPassDelete"
                                placeholder="Enter your password">
                            <label for="userPassConfirm">Confirm your password</label>
                            <input type="password" id="userPassConfirm" placeholder="Enter your password">
                        </div>
                        <button type="submit" id="deleteAccountBtn" class="btn btn-danger">Delete Account</button>
                    </form>
                    <div class="modal fade" id="notMatchPassAlert" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Passwords do not match. Please enter the same password in both fields.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="validate-input.js" charset="utf-8"></script>
    <script src="enable-change.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("userFormDelete");
            const deleteAccountBtn = document.getElementById("deleteAccountBtn");
            const userPassDelete = document.getElementById("userPassDelete");
            const userPassConfirm = document.getElementById("userPassConfirm");
            const myModal = new bootstrap.Modal(document.getElementById('notMatchPassAlert'));
            deleteAccountBtn.addEventListener("click", function(event) {
                event.preventDefault();
                // Get the values of the password fields
                const passwordDelete = userPassDelete.value;
                const passwordConfirm = userPassConfirm.value;
                // Perform the validation
                if (passwordDelete !== passwordConfirm) {
                    myModal.show();
                    return;
                }

                // If validation passes, proceed with the form submission (delete account)
                form.submit();
            });
        });
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.0/js/bootstrap.bundle.min.js"></script>
    <script>
       document.addEventListener("DOMContentLoaded", function() {
            const avatarInput = document.getElementById("avatarInput");
            const changeAvatarBtn = document.getElementById("change-avatar-btn");

            changeAvatarBtn.addEventListener("click", function() {
                avatarInput.click();
            });

            avatarInput.addEventListener("change", function() {
                this.closest("form").submit();
            });
        });
    </script>
</body>
