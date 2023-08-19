@include('layout.admin.header')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Feedbacks List</h3>
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">{{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="overflow-auto" style="height: 700px;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th> Feedback ID </th>
                                        <th> Vote </th>
                                        <th> Detail</th>
                                        <th> Date </th>
                                        <th> User ID</th>
                                        <th> Product ID</th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feedback as $f)
                                        <tr>
                                            <td>{{ $f->feedbackid }}</td>
                                            <td>{{ $f->vote }}</td>
                                            <td>{{ $f->detail }}</td>
                                            <td>{{ $f->date }}</td>
                                            <td>{{ $f->id }}</td>
                                            <td>{{ $f->proid }}</td>
                                            <td>
                                                <a href="{{ url('admin/feedbacks-delete/' . $f->feedbackid) }}"
                                                    class="delete-feedback"
                                                    data-url="{{ url('admin/feedbacks-delete/' . $f->feedbackid) }}"><i
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
    // Get all elements with class 'delete-product'
    const deleteLinks = document.querySelectorAll('.delete-feedback');
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
