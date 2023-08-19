@include('layout.admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-stretch grid-margin">
                            <div class="row flex-grow">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h2 class="card-title mb-4 text-center">Add New Admin</h2>
                                            @if (Session::has('success'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ Session::get('success') }}</div>
                                            @endif
                                            <form class="forms-sample" method="POST"
                                                action="{{ url('admin/admins-save') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="adminusername">Admin user name</label>
                                                    <input type="text" class="form-control" id="adminusername"
                                                        name="adminusername" placeholder="Enter username for admin"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="adminpassword">Admin password</label>
                                                    <input type="password" class="form-control" id="adminpassword"
                                                        name="adminpassword"
                                                        placeholder="Enter password for new admin" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="adminfullname">Admin full name</label>
                                                    <input type="text" class="form-control" id="adminfullname"
                                                        name="adminfullname" placeholder="Enter full of new admin"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="adminemail">Admin Email</label>
                                                    <input type="text" class="form-control" id="adminemail"
                                                        name="adminemail" placeholder="Enter email of admin" required>
                                                </div>
                                                <div class="mb-5">
                                                    <label for="adminimage">Image Admin</label><br>
                                                    <input type="file" name="adminimage" id="adminimage"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="level" class="form-label">Level:</label>
                                                    <select name="level" id="level" class="form-control"
                                                        required>
                                                        <option value="1">Administration</option>
                                                        <option value="0">Manager</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-success mr-2">Add new</button>
                                            </form>
                                        </div>
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
    @include('layout.admin.footer')
