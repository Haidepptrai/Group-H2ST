@include('layout.admin.header')
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
                            <p> {{Session::get('totalCostSum')}} </p>
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
        var labels = @json($labels); // Replace with the dynamic labels data
        var sales = @json($sales); // Replace with the dynamic sales data
        var ctx = document.getElementById('salesChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
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
                            'rgba(82, 215, 38, 0.85)',
                            'rgba(255, 236, 0, 0.85)',
                            'rgba(255, 115, 0, 0.85)',
                            'rgba(255, 0, 0, 0.85)',
                            'rgba(0, 126, 214, 0.85)',
                            'rgba(124, 221, 221, 0.85)',
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
                        backgroundColor: 'rgba(75, 192, 192, 1)',
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
            <div class="overflow-auto" style="height: 700px;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Total Cost</th>
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
                                @if ($order->status == 3)
                                    <span class="badge bg-danger">Canceled</span>
                                @elseif($order->status == 1)
                                    <span class="badge bg-success">Recieved</span>
                                @elseif($order->status == 2)
                                    <span class="badge bg-info">Delivered</span>
                                @elseif($order->status == 0)
                                    <span class="badge bg-warning">Wait for confirm</span>
                                @endif
                            </td>
                            <td>${{ number_format($order->totalcost, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('layout.admin.footer')
