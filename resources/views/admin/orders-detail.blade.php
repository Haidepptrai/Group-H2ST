@include('layout.admin.header-for-edit')
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
                                        <th> Product ID</th>
                                        <th> Product Name</th>
                                        <th> Product Image </th>
                                        <th> Price </th>
                                        <th> Quantity</th>
                                        <th> Total </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderDetail as $od)
                                        <tr>
                                            <td>{{ $od->orderid }}</td>
                                            <td>{{ $od->proid }}</td>
                                            <td>{{ $od->proname }}</td>
                                            <td><img src="{{ asset('pro_img/' . $od->proimage) }}"
                                                    alt="{{ $od->proname }}" class="img-fluid-3"
                                                    style="max-width: 100%; max-height: 100%; object-fit: cover;"></td>
                                            <td>{{ $od->proprice }}</td>
                                            <td>{{ $od->quantity }}</td>
                                            <td>${{ $od->quantity * $od->proprice }}</td>
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
@include('layout.admin.footer-for-edit')
