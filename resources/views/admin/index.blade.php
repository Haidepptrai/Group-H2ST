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
                    <a class="nav-link" data-toggle="collapse" href="#supplier">
                        <i class="bi bi-box2 menu-icon"></i>
                        <span class="menu-title">Suppliers</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="supplier">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link"
                                    href="{{ url('admin/suppliers-list') }}">Suppliers
                                    List</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('admin/suppliers-add') }}">Add
                                    Suppliers</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#Products">
                        <i class="bi bi-lamp menu-icon"></i>
                        <span class="menu-title">Products</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="Products">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link"
                                    href="{{ url('admin/products-list') }}">Products
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
            <!-- Dashboard Overview -->
            <div class="row">
                <div class="col-md-9">
                    <h2 class="my-4">Dashboard Overview</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white mb-5">
                                <div class="card-body">
                                    <h5 class="card-title">Total Users</h5>
                                    <p class="card-text">{{ $totalUsers }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Sales</h5>
                                    <p class="card-text">${{ number_format($totalSales, 2) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning text-white mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Orders</h5>
                                    <p class="card-text">{{ $totalOrders }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr><br><br>

            <!-- Sales and Revenue Management -->
            <div class="container">
                <h2>Sales Report</h2>
                <canvas id="salesChart" width="400" height="150"></canvas>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                var labels = ["Jan", "Feb", "Mar", "Apr", "May"];
                var sales = [100, 200, 150, 300, 250];
                var ctx = document.getElementById('salesChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line', // Set the chart type here
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'sales',
                            data: sales,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>

            <hr><br><br>

            <!-- Inventory Management -->
            <div class="container">
                <h2>Inventory Management</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Quantity Product</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="category-row">
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->product_count }}</td>
                            </tr>
                            <tr class="product-details" style="display:none;">
                                <td colspan="2">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $productDetails = explode(', ', $category->product_details);
                                            @endphp
                                            @foreach ($productDetails as $productDetail)
                                                @php
                                                    $detail = explode(' - Quantity: ', $productDetail);
                                                @endphp
                                                <tr>
                                                    <td>{{ isset($detail[0]) ? $detail[0] : '' }}</td>
                                                    <td>{{ isset($detail[1]) ? $detail[1] : '' }}</td>
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
            <hr><br>

            <!-- Analytics and Insights -->
            <div class="row">
                <div class="col-md-6">
                    <h2 class="my-4">Analytics and Insights</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="my-3">Popular Products</h3>
                            <ul class="list-group">
                                @foreach ($popularProducts as $product)
                                    <li class="list-group-item">{{ $product->proname }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr><br><br>
            <!-- Reporting and Analytics -->
            <div class="container">
                <h2>Reporting and Analytics</h2><br>
                <!-- Reporting and Analytics - Sales Revenue (Pie Chart and Column Chart) -->
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="my-3">Sales Revenue by Category (Pie Chart)</h3>
                        <canvas id="salesRevenuePieChart" width="400" height="200"></canvas>
                    </div>
                    <div class="col-md-6">
                        <h3 class="my-3">Sales Revenue by Category (Column Chart)</h3>
                        <canvas id="salesRevenueColumnChart" width="400" height="200"></canvas>
                    </div>
                </div>
                <!-- JavaScript code for the charts -->
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // Debugging: Check if the data for the pie chart is available
                    console.log('Pie Chart Data:');
                    console.log(@json($categorySalesData->pluck('catname')));
                    console.log(@json($categorySalesData->pluck('total_sales')));
                    // Generate Sales Revenue by Category Pie Chart
                    var salesRevenuePieCtx = document.getElementById('salesRevenuePieChart').getContext('2d');
                    var salesRevenuePieChart = new Chart(salesRevenuePieCtx, {
                        type: 'pie',
                        data: {
                            labels: @json($categorySalesData->pluck('catname')),
                            datasets: [{
                                data: @json($categorySalesData->pluck('total_sales')),
                                backgroundColor: [
                                    'rgba(238, 103, 38, 0.8)',
                                    'rgba(54, 162, 235, 0.8)',
                                    'rgba(36, 40, 145, 0.8)',
                                    'rgba(7, 165, 38, 0.8)',
                                    'rgba(59, 0, 72, 1)',
                                    'rgba(25, 106, 186, 0.8)',
                                    // Add more colors for additional categories if needed
                                ],
                                borderColor: 'rgba(255, 255, 255, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            legend: {
                                display: true,
                                position: 'right',
                                labels: {
                                    boxWidth: 20,
                                    fontColor: '#333'
                                }
                            }
                        }
                    });
                    // Generate Sales Revenue by Category Column Chart
                    var salesRevenueColumnCtx = document.getElementById('salesRevenueColumnChart').getContext('2d');
                    var salesRevenueColumnChart = new Chart(salesRevenueColumnCtx, {
                        type: 'bar',
                        data: {
                            labels: @json($categorySalesData->pluck('catname')),
                            datasets: [{
                                label: 'Sales Revenue',
                                data: @json($categorySalesData->pluck('total_sales')),
                                backgroundColor: 'rgba(75, 192, 192, 0.8)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
                <hr><br><br>

                <!-- Order Processing -->
                <div class="container">
                    <h2>Order Processing</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>User</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Total Cost</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->orderid }}</td>
                                    <td>{{ $order->username }}</td>
                                    <td>{{ $order->orderdate }}</td>
                                    <td>
                                        <!-- Display order status -->
                                        @if ($order->status == 0)
                                            <span class="badge bg-info">Processing</span>
                                        @elseif($order->status == 1)
                                            <span class="badge bg-warning">Shipped</span>
                                        @elseif($order->status == 2)
                                            <span class="badge bg-success">Delivered</span>
                                        @else
                                            <span class="badge bg-danger">Unknown</span>
                                        @endif
                                    </td>
                                    <td>${{ number_format($order->totalcost, 2) }}</td>
                                    <td>
                                        <!-- Add order processing actions here -->
                                        <a href="#" class="btn btn-primary">Update Status</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    <footer>
        <div class="footer mt-5">
            <p class="text-center">&copy; 2023 H2ST. All rights reserved.</p>
            <p class="text-center">Help: 0123 456 789</p>
        </div>
    </footer>
</body>

</html>
