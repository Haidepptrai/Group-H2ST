@include('layout.admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Products List</h3>
                                    @if (Session::has('success'))
                                        <div class="alert alert-success" role="alert">{{ Session::get('success') }}
                                        </div>
                                    @endif
                                    <div class="overflow-auto" style="height: 700px;">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Image</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                    <th>Discount</th>
                                                    <th>Hot Sales</th>
                                                    <th>Date Publish</th>
                                                    <th>Quantity</th>
                                                    <th>Action</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pro as $p)
                                                    <tr>
                                                        <td>{{ $p->proid }}</td>
                                                        <td>{{ $p->proname }}</td>
                                                        <td>
                                                            @if ($p->category)
                                                                {{ $p->category->catname }}
                                                            @endif
                                                        </td>
                                                        <td><img src="{{ '../../public/pro_img/' . $p->proimage }}"
                                                                width="100px" height="100px"></td>
                                                        <td>${{ $p->proprice }}</td>
                                                        <td>
                                                            @if ($p->status == 1)
                                                                <a
                                                                    href="{{ URL::to('/unactive_product/' . $p->proid) }}"><span
                                                                        class="fa fa-eye"
                                                                        style="color: blue; font-size: 30px"></span></a>
                                                            @else
                                                                <a
                                                                    href="{{ URL::to('/active_product/' . $p->proid) }}"><span
                                                                        class="fa fa-eye-slash"
                                                                        style="color: red; font-size: 30px"></span></a>
                                                            @endif
                                                        </td>
                                                        <td>{{ $p->discount }}%</td>
                                                        <td>
                                                            @if ($p->bestseller == 1)
                                                                <a
                                                                    href="{{ URL::to('/normal_product/' . $p->proid) }}"><span
                                                                        class="bi bi-fire"
                                                                        style="color: red; font-size: 30px"></span></a>
                                                            @else
                                                                <a href="{{ URL::to('/best_product/' . $p->proid) }}"><span
                                                                        class="bi bi-fire"
                                                                        style="color: black; font-size: 30px"></span></a>
                                                            @endif
                                                        </td>
                                                        <td>{{ date('Y-m-d', strtotime($p->date)) }}</td>
                                                        <td>{{ $p->proquantity }}</td>
                                                        <td>
                                                            <a href="{{ url('admin/products-edit/' . $p->proid) }}"><i
                                                                    class="bi bi-pencil-square"></i></a> | <a
                                                                href="{{ url('admin/products-delete/' . $p->proid) }}"
                                                                class="delete-product"
                                                                data-url="{{ url('admin/products-delete/' . $p->proid) }}"><i
                                                                    class="bi bi-trash text-danger"></i></a>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group"><a
                                                                    href="{{ url('admin/products-detail/' . $p->proid) }}"
                                                                    class="btn btn-sm btn-outline-secondary">Details</a>
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
            // Get all elements with class 'delete-product'
            const deleteLinks = document.querySelectorAll('.delete-product');
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
