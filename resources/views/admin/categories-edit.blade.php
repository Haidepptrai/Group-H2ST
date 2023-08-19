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
                                            <h2 class="card-title mb-4 text-center">Edit Category</h2>
                                            @if (Session::has('success'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ Session::get('success') }}</div>
                                            @endif
                                            <form class="forms-sample" method="POST"
                                                action="{{ url('admin/categories-update') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="CategoryID">Category ID</label>
                                                    <input type="text" class="form-control" id="CategoryID"
                                                        name="CategoryID" required value="{{ $cate->catid }}"
                                                        readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="catname">Category name</label>
                                                    <input type="text" class="form-control" id="catname"
                                                        name="catname" placeholder="Enter category name" required
                                                        value="{{ $cate->catname }}">
                                                </div>
                                                <button type="submit" class="btn btn-success mr-2">Update</button>
                                                <a href="{{ url('admin/categories-list') }}"
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
@include('layout.admin.footer-for-edit')
