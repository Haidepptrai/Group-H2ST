<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../admin/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../admin/assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="../admin/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../admin/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../admin/assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../admin/assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../admin/assets/css/demo_1/style.css">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="../admin/assets/images/favicon.ico" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ url('admin/index') }}">
                    <img src="../admin/assets/images/logo.svg" alt="logo" /> </a>
                <a class="navbar-brand brand-logo-mini" href="{{ url('admin/index') }}">
                    <img src="../admin/assets/images/logo-mini.svg" alt="logo" /> </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block">Help : +050 2992 709</li>
                    <li class="nav-item dropdown language-dropdown">
                        <a class="nav-link dropdown-toggle px-2 d-flex align-items-center" id="LanguageDropdown"
                            href="#" data-toggle="dropdown" aria-expanded="false">
                            <div class="d-inline-flex mr-0 mr-md-3">
                                <div class="flag-icon-holder">
                                    <i class="flag-icon flag-icon-us"></i>
                                </div>
                            </div>
                            <span class="profile-text font-weight-medium d-none d-md-block">English</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2"
                            aria-labelledby="LanguageDropdown">
                            <a class="dropdown-item">
                                <div class="flag-icon-holder">
                                    <i class="flag-icon flag-icon-us"></i>
                                </div>English
                            </a>
                            <a class="dropdown-item">
                                <div class="flag-icon-holder">
                                    <i class="flag-icon flag-icon-fr"></i>
                                </div>French
                            </a>
                            <a class="dropdown-item">
                                <div class="flag-icon-holder">
                                    <i class="flag-icon flag-icon-ae"></i>
                                </div>Arabic
                            </a>
                            <a class="dropdown-item">
                                <div class="flag-icon-holder">
                                    <i class="flag-icon flag-icon-ru"></i>
                                </div>Russian
                            </a>
                        </div>
                    </li>
                </ul>
                <form class="ml-auto search-form d-none d-md-block" action="#">
                    <div class="form-group">
                        <input type="search" class="form-control" placeholder="Search Here">
                    </div>
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator" id="messageDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="count">7</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                            aria-labelledby="messageDropdown">
                            <a class="dropdown-item py-3">
                                <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                                <span class="badge badge-pill badge-primary float-right">View all</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="../admin/assets/images/faces/face10.jpg" alt="image"
                                        class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                                    <p class="font-weight-light small-text"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="../admin/assets/images/faces/face12.jpg" alt="image"
                                        class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                                    <p class="font-weight-light small-text"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="../admin/assets/images/faces/face1.jpg" alt="image"
                                        class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins
                                    </p>
                                    <p class="font-weight-light small-text"> The meeting is cancelled </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator" id="notificationDropdown" href="#"
                            data-toggle="dropdown">
                            <i class="mdi mdi-email-outline"></i>
                            <span class="count bg-success">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                            aria-labelledby="notificationDropdown">
                            <a class="dropdown-item py-3 border-bottom">
                                <p class="mb-0 font-weight-medium float-left">You have 4 new notifications </p>
                                <span class="badge badge-pill badge-primary float-right">View all</span>
                            </a>
                            <a class="dropdown-item preview-item py-3">
                                <div class="preview-thumbnail">
                                    <i class="mdi mdi-alert m-auto text-primary"></i>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal text-dark mb-1">Application Error
                                    </h6>
                                    <p class="font-weight-light small-text mb-0"> Just now </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item py-3">
                                <div class="preview-thumbnail">
                                    <i class="mdi mdi-settings m-auto text-primary"></i>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal text-dark mb-1">Settings</h6>
                                    <p class="font-weight-light small-text mb-0"> Private message </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item py-3">
                                <div class="preview-thumbnail">
                                    <i class="mdi mdi-airballoon m-auto text-primary"></i>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-normal text-dark mb-1">New user registration
                                    </h6>
                                    <p class="font-weight-light small-text mb-0"> 2 days ago </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle" src="../admin/assets/images/faces/face8.jpg"
                                alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="../admin/assets/images/faces/face8.jpg"
                                    alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold">Allen Moreno</p>
                                <p class="font-weight-light text-muted mb-0">allenmoreno@gmail.com</p>
                            </div>
                            <a class="dropdown-item">My Profile <span class="badge badge-pill badge-danger">1</span><i
                                    class="dropdown-item-icon ti-dashboard"></i></a>
                            <a class="dropdown-item">Messages<i class="dropdown-item-icon ti-comment-alt"></i></a>
                            <a class="dropdown-item">Activity<i class="dropdown-item-icon ti-location-arrow"></i></a>
                            <a class="dropdown-item">FAQ<i class="dropdown-item-icon ti-help-alt"></i></a>
                            <a class="dropdown-item">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="profile-image">
                                <img class="img-xs rounded-circle" src="../admin/assets/images/faces/face8.jpg"
                                    alt="profile image">
                                <div class="dot-indicator bg-success"></div>
                            </div>
                            <div class="text-wrapper">
                                <p class="profile-name">Allen Moreno</p>
                                <p class="designation">Premium user</p>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Main Menu</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/index') }}">
                            <i class="menu-icon typcn typcn-document-text"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    {{-- Products --}}
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="menu-icon typcn typcn-coffee"></i>
                            <span class="menu-title">Products</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin/products-list') }}">Product list</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin/products-add') }}">Add products</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- Categories --}}
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false"
                            aria-controls="auth">
                            <i class="menu-icon typcn typcn-document-add"></i>
                            <span class="menu-title">Categories</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin/categories-list') }}">Categories list</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin/categories-add') }}">Add categories</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- Users --}}
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <i class="menu-icon typcn typcn-document-text"></i>
                            <span class="menu-title">Users</span>
                        </a>
                    </li>
                    {{-- Feedbacks --}}
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <i class="menu-icon typcn typcn-document-text"></i>
                            <span class="menu-title">Feedbacks</span>
                        </a>
                    </li>
                    {{-- Orders --}}
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <i class="menu-icon typcn typcn-document-text"></i>
                            <span class="menu-title">Orders</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Products edit</h3>
                                    @if (Session::has('success'))
                                        <div class="alert alert-success" role="alert">{{ Session::get('success') }}
                                        </div>
                                    @endif
                                    <table class="table table-striped">
                                        <form method="POST" action="{{ url('admin/products-update') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="productID">Product ID</label>
                                                <input type="text" class="form-control" id="productID" name="productid" value="{{ $pro->proid }}" readonly>
                                            </div>
                                            <div class="md-3">
                                                <label for="proname" class="form-label">Product Name:</label>
                                                <input type="text" id="proname" name="proname"
                                                    class="form-control" value="{{ $pro->proname }}">
                                                <div class="invalid-feedback">
                                                    Please enter a product name.
                                                </div>
                                            </div>

                                            <div class="mb-3 mt-3">
                                                <label for="category">Category:</label>
                                                <select name="catid" id="catid" class="form-control">
                                                    @foreach ($cate as $c)
                                                        <option value="{{ $c->catid }}"
                                                            {{ $c->catid == $pro->catid ? 'selected' : '' }}>
                                                            {{ $c->catname }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="md-3">
                                                <label for="proimage" class="form-label">Image:</label>
                                                <label for="image">Product Image:</label>
                                                <input type="hidden" value="{{ $pro->proimage }}" id="old_image"
                                                    name="old_image"><br>
                                                <img src="../admin/pro_img/{{ $pro->proimage }}"
                                                    style="height: 100px; width: 100px;"><br>
                                                <input type="file" class="form-control" id="new_image"
                                                    name="new_image">
                                                <div class="invalid-feedback">
                                                    Please choose an image file.
                                                </div>
                                            </div>

                                            <div class="md-3">
                                                <label for="prodescription" class="form-label">Product
                                                    descriptions:</label>
                                                <textarea name="prodescription" id="prodescription" rows="5" class="form-control">{{ $pro->prodescription }}</textarea>
                                                <div class="invalid-feedback">
                                                    Please enter some product descriptions.
                                                </div>
                                            </div>

                                            <div class="md-3">
                                                <label for="prodetails" class="form-label">Product details:</label>
                                                <textarea name="prodetails" id="prodetails" rows="5" class="form-control">{{ $pro->prodetails }}</textarea>
                                                <div class="invalid-feedback">
                                                    Please enter some product details.
                                                </div>
                                            </div>

                                            <div class="md-3">
                                                <label for="proprice" class="form-label">Price:</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" id="proprice" name="proprice"
                                                        class="form-control" min="0" step="0.01"
                                                        value="{{ $pro->proprice }}">
                                                    <div class="invalid-feedback">
                                                        Please enter a valid price.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="md-3">
                                                <label for="status" class="form-label">Status:</label>
                                                <input name="status" id="status" rows="5"
                                                    class="form-control">{{ $pro->status }}</input>
                                                <div class="invalid-feedback">
                                                    Please enter some product status.
                                                </div>
                                            </div>

                                            <div class="md-3">
                                                <label for="discount" class="form-label">Discount:</label>
                                                <input name="discount" id="discount" rows="5"
                                                    class="form-control" value="{{ $pro->discount }}"></input>
                                                <div class="invalid-feedback">
                                                    Please enter some product discount.
                                                </div>
                                            </div>

                                            <div class="md-3">
                                                <label for="bestseller" class="form-label">Hot sales:</label>
                                                <input name="bestseller" id="bestseller" rows="5"
                                                    class="form-control" value="{{ $pro->bestseller }}"></input>
                                                <div class="invalid-feedback">
                                                    Please enter some product is hot sale or not.
                                                </div>
                                            </div>

                                            <div class="md-3">
                                                <label for="quantity" class="form-label">Quantity:</label>
                                                <input name="quantity" id="quantity" rows="5"
                                                    class="form-control" value="{{ $pro->quantity }}"></input>
                                                <div class="invalid-feedback">
                                                    Please enter some product quantity.
                                                </div>
                                            </div>

                                            <br>
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </form>
                                    </table>
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
    <!-- plugins:js -->
    <script src="../admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../admin/assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="../admin/assets/js/shared/off-canvas.js"></script>
    <script src="../admin/assets/js/shared/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="../admin/assets/js/demo_1/dashboard.js"></script>
    <!-- End custom js for this page-->
    <script src="../admin/assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
</body>

</html>
