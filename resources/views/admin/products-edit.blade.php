@include('layout.admin.header-for-edit')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Products edit</h3>
                                    @if (Session::has('success'))
                                        <div class="alert alert-success" role="alert">{{ Session::get('success') }}
                                        </div>
                                    @endif
                                    <table class="table table-striped">
                                        <form method="POST" action="{{ url('admin/products-update') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="productID">Product ID</label>
                                                <input type="text" class="form-control" id="productID"
                                                    name="productid" value="{{ $pro->proid }}" readonly>
                                            </div>
                                            <div class="md-3">
                                                <label for="proname" class="form-label">Product Name:</label>
                                                <input type="text" id="proname" name="proname"
                                                    class="form-control" value="{{ $pro->proname }}">
                                                <div class="invalid-feedback">
                                                    Please enter a product name.
                                                </div>
                                            </div>

                                            <div class="mb-3 mt-3">
                                                <label for="category">Category:</label>
                                                <select name="catid" id="catid" class="form-control">
                                                    @foreach ($cate as $c)
                                                        <option value="{{ $c->catid }}"
                                                            {{ $c->catid == $pro->catid ? 'selected' : '' }}>
                                                            {{ $c->catname }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-5">
                                                <label for="proimage" class="form-label">Image:</label><br>
                                                <input type="file" name="proimage" id="proimage"
                                                    class="form-control"><br>
                                                <img src="{{ asset('pro_img/' . $pro->proimage) }}"
                                                    alt="Product Image" width="100px" height="100px">
                                                <div class="invalid-feedback">
                                                    Please choose an image file.
                                                </div>
                                            </div>
                                            <div class="md-3">
                                                <label for="prodescription" class="form-label">Product
                                                    descriptions:</label>
                                                <textarea name="prodescription" id="prodescription" rows="5" class="form-control">{{ $pro->prodescription }}</textarea>
                                                <div class="invalid-feedback">
                                                    Please enter some product descriptions.
                                                </div>
                                            </div>

                                            <div class="md-3">
                                                <label for="prodetails" class="form-label">Product details:</label>
                                                <textarea name="prodetails" id="prodetails" rows="5" class="form-control">{{ $pro->prodetails }}</textarea>
                                                <div class="invalid-feedback">
                                                    Please enter some product details.
                                                </div>
                                            </div>

                                            <div class="md-3">
                                                <label for="proprice" class="form-label">Price:</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" id="proprice" name="proprice"
                                                        class="form-control" min="0" step="0.01"
                                                        value="{{ $pro->proprice }}">
                                                    <div class="invalid-feedback">
                                                        Please enter a valid price.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="md-3">
                                                <label for="discount" class="form-label">Discount:</label>
                                                <input name="discount" id="discount" rows="5"
                                                    class="form-control" value="{{ $pro->discount }}"></input>
                                                <div class="invalid-feedback">
                                                    Please enter some product discount.
                                                </div>
                                            </div>

                                            <div class="md-3">
                                                <label for="quantity" class="form-label">Quantity:</label>
                                                <input name="quantity" id="quantity" rows="5"
                                                    class="form-control" value="{{ $pro->proquantity }}">
                                                <div class="invalid-feedback">
                                                    Please enter some product quantity.
                                                </div>
                                            </div>
                                            <div class="mb-3 mt-3">
                                                <label for="supplier">Supplier:</label>
                                                <select name="suppid" id="suppid" class="form-control">
                                                    @foreach ($supp as $s)
                                                        <option value="{{ $s->id }}"
                                                            {{ $s->id == $pro->supid ? 'selected' : '' }}>
                                                            {{ $s->suppliername }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-success">Update</button>
                                            <a href="{{ url('admin/products-list') }}"
                                                class="btn btn-secondary">Back</a>
                                        </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.3/purify.min.js"></script>
    <script>
        function sanitizeHTML(input) {
            var sanitized = DOMPurify.sanitize(input, {
                ALLOWED_TAGS: [
                    'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'ul', 'ol', 'li', 'strong', 'em', 'u',
                    's', 'mark', 'del', 'ins', 'sub', 'sup', 'a', 'img', 'table', 'thead', 'tbody',
                    'tr', 'th', 'td', 'div', 'br', 'hr', 'span', 'code', 'var'
                ],
                ALLOWED_ATTR: ['href', 'src', 'alt', 'title', 'style'],
            });
            return sanitized;
        }

        CKEDITOR.replace('prodescription', {
            autoParagraph: false,
            onBeforeGetData: function(evt) {
                evt.data.dataValue = sanitizeHTML(evt.editor.getData());
            }
        });

        CKEDITOR.replace('prodetails', {
            autoParagraph: false,
            onBeforeGetData: function(evt) {
                evt.data.dataValue = sanitizeHTML(evt.editor.getData());
            }
        });
    </script>
    @include('layout.admin.footer-for-edit')
