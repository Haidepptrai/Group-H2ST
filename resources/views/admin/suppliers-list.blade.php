@include('layout.admin.header')
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Suppliers List</h3>
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <div class="overflow-auto" style="height: 700px;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th> Supplier ID </th>
                                        <th> Supplier Name </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($supp as $s)
                                        <tr>
                                            <td>{{ $s->id }}</td>
                                            <td>{{ $s->suppliername }}</td>
                                            <td>
                                                <a href="{{ url('admin/suppliers-edit/' . $s->id) }}"><i
                                                        class="bi bi-pencil-square"></i></a> | <a
                                                    href="{{ url('admin/suppliers-delete/' . $s->id) }}"
                                                    class="delete-category"
                                                    data-url="{{ url('admin/suppliers-delete/' . $s->id) }}"><i
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
@include('layout.admin.footer')
