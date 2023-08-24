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
                                            <h2 class="card-title mb-4 text-center">Add New Category</h2>
                                            @if (Session::has('success'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ Session::get('success') }}</div>
                                            @endif
                                            @if (Session::has('error'))
                                                <div class="alert alert-danger" role="alert">
                                                    {{ Session::get('error') }}</div>
                                            @endif
                                            <form class="forms-sample" method="POST"
                                                action="{{ url('admin/categories-save') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="catname">Category name</label>
                                                    <input type="text" class="form-control" id="catname"
                                                        name="catname" placeholder="Enter category name" required>
                                                </div>
                                                <div class="mb-5">
                                                    <label for="status">Status</label><br>
                                                    <select name="status" id="status">
                                                        <option value="1">Show</option>
                                                        <option value="0">Not Show</option>
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
@include('layout.admin.footer')
