@include('layout.customer.header-profile')
<body>
    <nav>
    </nav>
    <div class="d-flex align-items-start page-container">
        <div class="nav nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <div class="logo-brand">
                <a class="navbar-brand fw-semibold" href="{{ route('home') }}">H2ST Furniture</a>
            </div>
            <div class="direction">
                <button class="nav-link active" id="v-pills-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="#v-pills-profile"
                    aria-selected="true">Account</button>
                <button class="nav-link" id="v-pills-order-tab" data-bs-toggle="pill" data-bs-target="#v-pills-order"
                    type="button" role="tab" aria-controls="v-pills-order" aria-selected="false">Your
                    order</button>
                @if (session()->has('id'))
                    <button class="nav-link" id="v-pills-changePass-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-changePass" type="button" role="tab"
                        aria-controls="v-pills-changePass" aria-selected="false">Change Password</button>
                @endif
                <button class="nav-link" id="v-pills-delete-tab" data-bs-toggle="pill" data-bs-target="#v-pills-delete"
                    type="button" role="tab" aria-controls="v-pills-delete" aria-selected="false">Delete
                    Account</button>
                <button class="btn text-danger" id="logoutBtn" type="button">Log out</button>
                <div class="modal fade" id="LogOutAlertModal" tabindex="-1" aria-labelledby="LogOutAlert"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="LogOutAlertLabel">Alert Logout</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Do you want to log out
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn"><a class="text-danger"
                                        href="{{ route('customerLogout') }}">Logout</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                            <img src="../../user_img/{{ Session::get('userimage') }}" alt="">
                        @endif
                    </div>
                    <div class="user-basic-info">
                        <div class="user-name"> {{ $user->userfirstname }} {{ $user->userlastname }}</div>
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
                    @if (session()->has('id') || session('user'))
                        <form action="{{ route('updateUserProfile', ['id' => session()->get('id') ?? Auth::id()]) }}"
                            id="userForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="row row-cols-2">
                                    <div class="col">
                                        <label for="userfirstName" class="form-label">First Name</label>
                                        <input type="text" name="userfirstName" id="userfirstName"
                                            class="form-control"
                                            value="{{ $user->userfirstname }}"
                                            placeholder="Update your first name">
                                    </div>
                                    <div class="col">
                                        <label for="userlastName">Last Name</label>
                                        <input type="text" name="userlastName" id="userlastName"
                                            class="form-control"
                                            value="{{ $user->userlastname }}"
                                            placeholder="Update your last name">
                                    </div>
                                    <div class="col">
                                        <label for="userEmail">Email</label>
                                        <input type="email" name="userEmail" id="userEmail" class="form-control"
                                            value="{{ $user->useremail }}"
                                            placeholder="Update your email" required>
                                    </div>
                                    <div class="col">
                                        <label for="userGender">Gender</label>
                                        <select class="form-select" aria-label="Select gender" name="userGender"
                                            id="userGender">
                                            <option value="0"
                                                {{ session('user') ? '' : '' }}{{ Session()->has('id') && Session::get('usergender') == 0 ? 'selected' : '' }}>
                                                Male</option>
                                            <option value="1"
                                                {{ session('user') ? '' : '' }}{{ Session()->has('id') && Session::get('usergender') == 1 ? 'selected' : '' }}>
                                                Female</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="userPhone">Enter a phone number</label>
                                        <input type="tel" id="userPhone" name="userPhone" class="form-control"
                                            value="{{ $user->userphone }}"
                                            pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="Update your phone number"  title="Please enter a valid 10 to 12 digit phone number">
                                    </div>
                                    <div class="col">
                                        <label for="userAddress">Enter your birthday</label>
                                        <input type="date" name="userAddress" id="userAddress"
                                            class="form-control"
                                            value="{{ $user->userbirthday }}">
                                    </div>
                                    <div class="col">
                                        <label for="userDoB">Enter your Address Number</label>
                                        <input type="text" name="userAddress" id="userDoB" class="form-control"
                                            value="{{ $user->useraddress }}"
                                            placeholder="Update your address">
                                    </div>
                                    <div class="col">
                                        <label for="select-province">Select Province</label>
                                        <select class="form-select" id="select-province" aria-label="Select City"
                                            name="userCity" required>
                                            <option disabled selected>Select City</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="select-district">Select District</label>
                                        <select class="form-select" id="select-district"
                                            aria-label="Select Districts" name="userDistrict" required>
                                            <option disabled selected>Select Districts</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="select-ward">Select Ward</label>
                                        <select class="form-select" id="select-ward" aria-label="Select Wards"
                                            name="userWards" required>
                                            <option disabled selected>Select Wards</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-end my-5"
                                    id="saveChangesBtn">Save
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
            @if (session()->has('id'))
                @if (Session::has('success'))
                    {{-- {{ Session::get('success') }} --}}
                @else
                    {{ Session::get('error') }}
                @endif
                <div class="tab-pane fade" id="v-pills-changePass" role="tabpanel"
                    aria-labelledby="v-pills-profile-tab" tabindex="0">
                    <div class="tab-title">
                        Change Your Password
                    </div>
                    <hr width="95%" style="margin: auto;">
                    <div class="personal-setting">

                        <form action="{{ route('changePassword', ['id' => session()->get('id') ?? Auth::id()]) }}"
                            id="userFormChangePass" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="row row-cols-2">
                                    <div class="col">
                                        <label for="oldPassword" class="text-primary">Enter your password</label>
                                        <input type="password" name="oldPassword" id="userOldPass"
                                            placeholder="Enter your password" class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="newPassword" class="text-info">Enter your new password</label>
                                        <input type="password" name="newPassword" id="newPassword"
                                            placeholder="Enter your password" class="form-control" pattern="[a-zA-Z0-9_]{3,20}"  title="Username must be between 6 and 20 characters and can contain letters, numbers, and underscores">
                                        <label for="newPassConfirm" class="text-info">Confirm your new
                                            password</label>
                                        <input type="password" name="newPassConfirm" id="newPassConfirm"
                                            placeholder="Enter your password" class="form-control" >
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-end my-5"
                                    id="saveChangesPassBtn">Save
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
                    </div>
                </div>
            @endif
            <div class="tab-pane fade" id="v-pills-order" role="tabpanel" aria-labelledby="v-pills-order-tab"
                tabindex="0">
                <div class="tab-title">
                    Your Order
                </div>
                <div class="order-info">
                    <table class="table table-bordered">
                        <h6 class="text-info">Order ID: details</h6>
                    </table>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Date order</th>
                                <th scope="col">Status</th>
                                <th scope="col">Total cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($order as $o)
                                <input type="hidden" value="{{ $o->userid }}" id="userid">
                                <tr class="order-row">
                                    <th scope="row">{{ $i++ }}</th>
                                    <td id="orderid">{{ $o->orderid }}</td>
                                    <td>{{ $o->orderdate }}</td>
                                    @if ($o->status == 1)
                                        <td>Wait For Confirm</td>
                                    @elseif ($o->status == 2)
                                        <td>Delivery</td>
                                    @elseif ($o->status == 3)
                                        <td>Recived</td>
                                    @elseif ($o->status == 0)
                                        <td>Canceled</td>
                                    @endif
                                    <td>{{ $o->totalcost }}$</td>
                                </tr>
                                <tr class="order-details" style="display: none;">
                                    <td colspan="6">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $j = 1;
                                                @endphp
                                                @foreach ($orderDetails as $od)
                                                    <tr>
                                                        <th scope="row">{{ $j++ }}</th>
                                                        <td>{{ $od->proname }}</td>
                                                        <td><img src="" alt=""></td>
                                                        <td>{{ $od->proprice }}</td>
                                                        <td>{{ $od->quantity }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-delete" role="tabpanel" aria-labelledby="v-pills-delete-tab"
                tabindex="0">
                <div class="tab-title text-danger">
                    Delete Your Account
                </div>
                @if (Session::has('id'))
                    <div class="input-password">
                        @if (Session::has('error'))
                            {{ Session::get('error') }}
                        @endif
                        <form action="{{ route('deleteAccount', ['id' => session()->get('id') ?? Auth::id()]) }}"
                            id="userFormDelete" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="col">
                                <label for="userPassDelete">Enter your password</label>
                                <input type="password" name="userPassDelete" id="userPassDelete"
                                    placeholder="Enter your password" class="form-control">
                                <label for="userPassConfirm">Confirm your password</label>
                                <input type="password" id="userPassConfirm" placeholder="Enter your password"
                                    class="form-control">
                            </div>
                            <button type="submit" id="deleteAccountBtn" class="btn btn-danger">Delete
                                Account</button>
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
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else(session('user'))
                    <form action="{{ route('deleteAccount', ['id' => session()->get('id') ?? Auth::id()]) }}"
                        id="userFormDelete" enctype="multipart/form-data" method="POST">
                        @csrf
                        <button type="submit" id="deleteAccountBtn" class="btn btn-danger">Delete
                            Account</button>
                    </form>
                @endif
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
    <script src="../../customer/personal-account/getVietNamAPI.js"></script>
    <script src="../../customer/personal-account/logOutAlert.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../customer/personal-account/displayOrder.js"></script>
</body>
