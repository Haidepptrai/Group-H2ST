@include('layout.admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Admins List</h3>
                                    @if (Session::has('success'))
                                        <div class="alert alert-success" role="alert">{{ Session::get('success') }}
                                        </div>
                                    @endif
                                    <div class="overflow-auto" style="height: 700px;">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th> Admin ID </th>
                                                    <th> Full Name</th>
                                                    <th> User Name </th>
                                                    <th> Image </th>
                                                    <th> Email </th>
                                                    <th> Level </th>
                                                    <th> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($admin as $a)
                                                    <tr>
                                                        <td>{{ $a->adminid }}</td>
                                                        <td>{{ $a->adminfullname }}</td>
                                                        <td>{{ $a->adminusername }}</td>
                                                        <td><img src="{{ '../../public/admin_img/' . $a->adminimage }}"
                                                                width="100px" height="100px"></td>
                                                        <td>{{ $a->adminemail }}</td>
                                                        <td>
                                                            @if ($a->level == 1)
                                                                <span>Administration</span>
                                                            @else
                                                                <span>Manager</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (Session::get('adminid') != $a->adminid )
                                                            <a href="{{ url('admin/admins-edit/' . $a->adminid) }}"><i
                                                                class="bi bi-pencil-square"></i></a> | <a
                                                            href="{{ url('admin/admins-delete/' . $a->adminid) }}"
                                                            class="delete-admin"
                                                            data-url="{{ url('admin/admins-delete/' . $a->adminid) }}"><i
                                                                class="bi bi-trash text-danger"></i></a>
                                                            @else
                                                            <div>Can not action</div>
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
            // Get all elements with class 'delete-product'
            const deleteLinks = document.querySelectorAll('.delete-admin');
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
