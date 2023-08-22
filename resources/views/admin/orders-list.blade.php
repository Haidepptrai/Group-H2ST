@include('layout.admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Orders List</h3>
                                    @if (Session::has('success'))
                                        <div class="alert alert-success" role="alert">{{ Session::get('success') }}
                                        </div>
                                    @endif
                                    <div class="overflow-auto" style="height: 700px;">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th> Order ID </th>
                                                    <th> User ID </th>
                                                    <th> User Name</th>
                                                    <th> Order date</th>
                                                    <th> Status </th>
                                                    <th> Total cost</th>
                                                    <th> Action </th>
                                                    <th> View order</th>
                                                    <th> Cancel</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order as $o)
                                                    <tr>
                                                        <td>{{ $o->orderid }}</td>
                                                        <td>{{ $o->userid }}</td>
                                                        <td>{{ $o->userfirstname }}{{ $o->userlastname }}</td>
                                                        <td>{{ $o->orderdate }}</td>
                                                        <td>
                                                            @if ($o->status == 0)
                                                                <a
                                                                    href="{{ URL::to('/confirm_order/' . $o->orderid) }}">
                                                                    <span class="bi bi-check-circle"
                                                                        style="color: yellow; font-size: 30px"></span>
                                                                </a>
                                                            @elseif ($o->status == 1)
                                                                <a
                                                                    href="{{ URL::to('/delivery_order/' . $o->orderid) }}">
                                                                    <span class="bi bi-truck"
                                                                        style="color: blue; font-size: 30px"></span>
                                                                </a>
                                                            @elseif ($o->status == 2)
                                                                <a
                                                                    href="{{ URL::to('/received_order/' . $o->orderid) }}">
                                                                    <span class="bi bi-bag-check-fill"
                                                                        style="color: green; font-size: 30px"></span>
                                                                </a>
                                                            @else
                                                                <span class="bi bi-x-circle"
                                                                    style="color: red; font-size: 30px"></span>
                                                            @endif
                                                        </td>
                                                        <td>${{ $o->totalcost }}</td>
                                                        <td>
                                                            <a href="{{ url('admin/orders-edit/' . $o->orderid) }}"><i
                                                                    class="bi bi-pencil-square"></i></a>
                                                            |
                                                            <a href="{{ url('admin/orders-delete/' . $o->orderid) }}"
                                                                class="delete-order"
                                                                data-url="{{ url('admin/orders-delete/' . $o->orderid) }}"><i
                                                                    class="bi bi-trash text-danger"></i></a>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group"><a
                                                                    href="{{ url('admin/orders-detail/' . $o->orderid) }}"
                                                                    class="btn btn-sm btn-outline-secondary">Details</a>
                                                        </td>
                                                        <td>
                                                            @if ($o->status != 3)
                                                                <a
                                                                    href="{{ URL::to('/cancel_order/' . $o->orderid) }}">
                                                                    <span class="bi bi-x-circle"
                                                                        style="color: red; font-size: 30px"></span>
                                                                </a>
                                                            @endif
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
        <script>
            // Get all elements with class 'delete-user'
            const deleteLinks = document.querySelectorAll('.delete-order');
            // Attach event listener to each link
            deleteLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default link behavior
                    // Get the URL from the 'data-url' attribute of the link
                    const url = this.getAttribute('data-url');
                    // Show the SweetAlert2 confirmation dialog
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this product!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            });
        </script>
        @include('layout.admin.footer')
