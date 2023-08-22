@include('layout.admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Users List</h3>
                                    @if (Session::has('success'))
                                        <div class="alert alert-success" role="alert">{{ Session::get('success') }}
                                        </div>
                                    @endif
                                    <div class="overflow-auto" style="height: 700px;">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th> User ID</th>
                                                    <th> User Name </th>
                                                    <th> Photo </th>
                                                    <th> Email </th>
                                                    <th> First Name </th>
                                                    <th> Last Name </th>
                                                    <th> Birthday</th>
                                                    <th> Address </th>
                                                    <th> Gender </th>
                                                    <th> Phone </th>
                                                    <th> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user as $u)
                                                    <tr>
                                                        <td>{{ $u->id }}</td>
                                                        <td>{{ $u->username }}</td>
                                                        @if (file_exists( public_path('user_img/' . $u->userimage)))
                                                        <td><img src="{{ '../../public/user_img/' . $u->userimage }}"
                                                            width="100px" height="100px"></td>
                                                        @else
                                                        <td><img src="{{ $u->userimage }}"
                                                            width="100px" height="100px"></td>
                                                        @endif
                                                        <td>{{ $u->useremail }}</td>
                                                        <td>{{ $u->userfirstname }}</td>
                                                        <td>{{ $u->userlastname }}</td>
                                                        <td>{{ $u->userbirthday }}</td>
                                                        <td>{{ $u->useraddress }}</td>
                                                        @if ($u->usergender == 0)
                                                        <td> Male </td>
                                                        @elseif ($u->usergender == 1)
                                                        <td> Female </td>
                                                        @endif
                                                        <td>{{ $u->userphone }}</td>
                                                        <td>
                                                            <a href="{{ url('admin/users-delete/' . $u->id) }}"
                                                                class="delete-user"
                                                                data-url="{{ url('admin/users-delete/' . $u->id) }}"><i
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
        <script>
            // Get all elements with class 'delete-user'
            const deleteLinks = document.querySelectorAll('.delete-user');
            // Attach event listener to each link
            deleteLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default link behavior
                    // Get the URL from the 'data-url' attribute of the link
                    const url = this.getAttribute('data-url');
                    // Show the SweetAlert2 confirmation dialog
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this user!',
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
