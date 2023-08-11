<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin H2ST</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../admin/vendors/feather/feather.css">
    <link rel="stylesheet" href="../admin/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../admin/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../admin/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="../admin/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../admin/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../admin/images/favicon.png" />
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>

<body>
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo mr-5" href="{{ url('admin/index') }}"><img
                    src="../admin/images/Logo_name.png" class="mr-2" alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="{{ url('admin/index') }}"><img
                    src="../admin/images/Logo_text_darkblue.png" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
            <ul class="navbar-nav mr-lg-2">
                <li class="nav-item nav-search d-none d-lg-block">
                    <div class="input-group">
                        <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                            <span class="input-group-text" id="search">
                                <i class="icon-search"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now"
                            aria-label="search" aria-describedby="search">
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                        <img src="../admin_img/{{ Session::get('adminimage') }}" alt="profile" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="{{ url('admin/admins-profile') }}">
                            <i class="bi bi-person-badge text-primary"></i>
                            My profile
                        </a>
                        <a class="dropdown-item" href="{{ route('adminLogout') }}">
                            <i class="ti-power-off text-primary"></i>
                            Logout
                        </a>
                    </div>
                </li>
                <li class="nav-item nav-settings d-none d-lg-flex">
                    <h5 class="text-primary">{{ Session::get('adminfullname') }}</h5>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/index') }}">
                        <i class="icon-grid menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic">
                        <i class="bi bi-justify-left menu-icon"></i>
                        <span class="menu-title">Categories</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ url('admin/categories-list') }}">Categories List</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/categories-add') }}">Add
                                    Category</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#form-elements">
                        <i class="bi bi-lamp menu-icon"></i>
                        <span class="menu-title">Products</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="form-elements">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{ url('admin/products-list') }}">Products
                                    List</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('admin/products-add') }}">Add
                                    Product</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/users-list') }}" aria-expanded="false"
                        aria-controls="charts">
                        <i class="bi bi-person-circle menu-icon"></i>
                        <span class="menu-title">Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/feedbacks-list') }}" aria-expanded="false"
                        aria-controls="tables">
                        <i class="bi bi-chat-dots menu-icon"></i>
                        <span class="menu-title">Feedback</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/orders-list') }}" aria-expanded="false"
                        aria-controls="auth">
                        <i class="bi bi-basket menu-icon"></i>
                        <span class="menu-title">Order</span>
                    </a>
                </li>
                @if (Session::get('adminlevel') == 1)
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false"
                            aria-controls="icons">
                            <i class="bi bi-person-vcard menu-icon"></i>
                            <span class="menu-title">Admin</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="icons">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ url('admin/admins-list') }}">Admins
                                        List</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/admins-add') }}">Add
                                        Admins</a></li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- partial -->
        <div class="container">
        <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Suppliers List</h3>
                                    @if (Session::has('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                    <div class="overflow-auto" style="height: 700px;">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th> Supplier ID </th>
                                                    <th> Supplier Name </th>
                                                    <th> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($supp as $s)
                                                    <tr>
                                                        <td>{{ $s->id }}</td>
                                                        <td>{{ $s->suppliername }}</td>
                                                        <td>
                                                            <a href="{{ url('admin/suppliers-edit/' . $s->id) }}"><i
                                                                    class="bi bi-pencil-square"></i></a> | <a
                                                                href="{{ url('admin/suppliers-delete/' . $s->id) }}"
                                                                class="delete-category"
                                                                data-url="{{ url('admin/suppliers-delete/' . $s->id) }}"><i
                                                                    class="bi bi-trash text-danger"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
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
    <script src="../admin/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../admin/vendors/chart.js/Chart.min.js"></script>
    <script src="../admin/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="../admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="../admin/js/dataTables.select.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../admin/js/off-canvas.js"></script>
    <script src="../admin/js/hoverable-collapse.js"></script>
    <script src="../admin/js/template.js"></script>
    <script src="../admin/js/settings.js"></script>
    <script src="../admin/js/todolist.js"></script>
    <!-- endinject -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.category-row').click(function() {
            var productDetails = $(this).next('.product-details');
            $('.product-details').not(productDetails).slideUp('fast');
            productDetails.slideToggle('fast');
        });
    });
</script>

    <!-- Custom js for this page-->
    <script src="../admin/js/dashboard.js"></script>
    <script src="../admin/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
</body>

</html>