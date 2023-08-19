@include('layout.admin.header-for-edit')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-stretch grid-margin">
                            <div class="row flex-grow">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h2 class="card-title mb-4 text-center">Edit admin</h2>
                                            @if (Session::has('success'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ Session::get('success') }}</div>
                                            @endif
                                            <form class="forms-sample" method="POST"
                                                action="{{ url('admin/admins-update') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="adminid">Admin ID</label>
                                                    <input type="text" class="form-control" id="adminid"
                                                        name="adminid" required value="{{ $admin->adminid }}"
                                                        readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="adminusername">Admin user name</label>
                                                    <input type="text" class="form-control" id="adminusername"
                                                        name="adminusername" placeholder="Enter admin user name"
                                                        value="{{ $admin->adminusername }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="adminpassword">Admin password</label>
                                                    <input type="text" class="form-control" id="adminpassword"
                                                        name="adminpassword" placeholder="Enter admin password"
                                                        value="{{ $admin->adminpassword }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="adminfullname">Admin full name</label>
                                                    <input type="text" class="form-control" id="adminfullname"
                                                        name="adminfullname" placeholder="Enter admin fullname"
                                                        value="{{ $admin->adminfullname }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="adminemail">Admin Email</label>
                                                    <input type="text" class="form-control" id="adminemail"
                                                        name="adminemail" placeholder="Enter email of admin"
                                                        value="{{ $admin->adminemail }}">

                                                </div>
                                                <div class="mb-5">
                                                    <label for="adminimage">Image Admin</label><br>
                                                    <input type="file" name="adminimage" id="adminimage"
                                                        class="form-control"><br>
                                                    <input type="hidden" name="old_image"
                                                        value="{{ $admin->adminimage }}">
                                                    <img src="{{ url('admin_img/' . $admin->adminimage) }}"
                                                        width="100px" height="100px">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="level" class="form-label">Level:</label>
                                                    <select name="level" id="level" class="form-control"
                                                        required>
                                                        <option value="1"
                                                            @if ($admin->level == 1) selected @endif>
                                                            Administration
                                                        </option>
                                                        <option value="0"
                                                            @if ($admin->level == 0) selected @endif>Manager
                                                        </option>
                                                    </select>
                                                </div>
                                                <br>
                                                <button type="submit" class="btn btn-success mr-2">Update</button>
                                                <a href="{{ url('admin/admins-list') }}"
                                                    class="btn btn-success">Back</a>
                                            </form>
                                        </div>
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
        @include('layout.admin.footer-for-edit')
