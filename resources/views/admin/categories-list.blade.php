@include('layout.admin.header')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Categories List</h3>
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @elseif (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <div class="overflow-auto" style="height: 700px;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th> Category ID </th>
                                        <th> Category Name </th>
                                        <th> Reg-date </th>
                                        <th> Status </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cate as $c)
                                        <tr>
                                            <td>{{ $c->catid }}</td>
                                            <td>{{ $c->catname }}</td>
                                            <td>{{ $c->date }}</td>
                                            <td>
                                                @if ($c->status == 1)
                                                    <a href="{{ URL::to('/unactive_category/' . $c->catid) }}"><span
                                                            class="fa fa-eye"
                                                            style="color: blue; font-size: 30px"></span></a>
                                                @else
                                                    <a href="{{ URL::to('/active_category/' . $c->catid) }}"><span
                                                            class="fa fa-eye-slash"
                                                            style="color: red; font-size: 30px"></span></a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/categories-edit/' . $c->catid) }}"><i
                                                        class="bi bi-pencil-square"></i></a> | <a
                                                    href="{{ url('admin/categories-delete/' . $c->catid) }}"
                                                    class="delete-category"
                                                    data-url="{{ url('admin/categories-delete/' . $c->catid) }}"><i
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
    const deleteLinks = document.querySelectorAll('.delete-category');
    // Attach event listener to each link
    deleteLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            // Get the URL from the 'data-url' attribute of the link
            const url = this.getAttribute('data-url');
            // Show the SweetAlert2 confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this category!',
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
