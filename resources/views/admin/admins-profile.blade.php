@include('layout.admin.header')
<!-- partial -->
<div class="container">
    @foreach ($profile as $pf)
        @if ($pf->adminid == Session::get('adminid'))
            <br>
            <h3 class="text-center text-primary">Hello {{ Session::get('adminfullname') }}</h3>
            <div class="row">
                <div class="col-md-12 d-flex align-items-stretch grid-margin">
                    <div class="row flex-grow">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title mb-4 text-center">Your Information</h2>
                                    @if (Session::has('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ Session::get('success') }}</div>
                                    @endif
                                    @if (Session::has('fail'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ Session::get('fail') }}</div>
                                    @endif
                                    @if (Session::has('failSave'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ Session::get('failSave') }}</div>
                                    @endif
                                    <form class="forms-sample" method="POST"
                                        action="{{ url('admin/admins-saveProfile') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="adminid">Admin ID</label>
                                            <input type="text" class="form-control" id="adminid" name="adminid"
                                                required value="{{ $pf->adminid }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="adminusername">Your Username</label>
                                            <input type="text" class="form-control" id="adminusername"
                                                name="adminusername" readonly value="{{ $pf->adminusername }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="adminpassword">Your Password</label>
                                            <input type="password" class="form-control" id="adminpassword"
                                                name="adminpassword" placeholder="Enter admin password"
                                                value="{{ $pf->adminpassword }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="adminfullname">Your Full Name</label>
                                            <input type="text" class="form-control" id="adminfullname"
                                                name="adminfullname" placeholder="Enter admin fullname"
                                                value="{{ $pf->adminfullname }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="adminemail">Your Email</label>
                                            <input type="text" class="form-control" id="adminemail" name="adminemail"
                                                placeholder="Enter email of admin" value="{{ $pf->adminemail }}">

                                        </div>
                                        <div class="mb-5">
                                            <label for="adminimage">Your Image</label><br>
                                            <input type="file" name="adminimage" id="adminimage"
                                                class="form-control"><br>
                                            <input type="hidden" name="old_image" value="{{ $pf->adminimage }}">
                                            <img src="{{ url('admin_img/' . $pf->adminimage) }}" width="100px"
                                                height="100px">
                                        </div>
                                        <div class="form-group">
                                            <label for="level">Your level</label>
                                            <input type="text" class="form-control" id="level" name="level"
                                                readonly
                                                @if ($pf->level == 1) value="Administrator"
                                                            @elseif ($pf->level == 0)
                                                            value="Manager"> @endif
                                                </div>
                                            <br>
                                            <button type="submit" class="btn btn-success mr-2">Save
                                                change</button>
                                            <a href="{{ url('admin/index') }}" class="btn btn-success">Back</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    <br><br>
</div>
</div>
<!-- main-panel ends -->
</div>
<!-- container-scroller -->

@include('layout.admin.footer')
