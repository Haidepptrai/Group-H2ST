@include('layout.admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Products add</h3>
                                    @if (Session::has('success'))
                                        <div class="alert alert-success" role="alert">{{ Session::get('success') }}
                                        </div>
                                    @endif
                                    <table class="table table-striped">
                                        <form method="POST" action="{{ url('admin/products-save') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="md-3">
                                                <label for="proname" class="form-label">Product Name:</label>
                                                <input type="text" id="proname" name="proname"
                                                    class="form-control" placeholder="Enter name products" required>
                                                <div class="invalid-feedback">
                                                    Please enter a product name.
                                                </div>
                                            </div><br>

                                            <div class="md-3">
                                                <label for="catid" class="form-label">Category:</label>
                                                <select id="catid" name="catid" class="form-select" required>
                                                    @foreach ($cate as $c)
                                                        <option value="{{ $c->catid }}">{{ $c->catname }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a category.
                                                </div>
                                            </div>

                                            <div class="md-3">
                                                <label for="proimage" class="form-label">Image:</label>
                                                <input type="file" id="proimage" name="proimage"
                                                    class="form-control" required>
                                                <div class="invalid-feedback">
                                                    Please choose an image file.
                                                </div>
                                            </div><br>

                                            <div class="md-3">
                                                <label for="prodescription" class="form-label">Product
                                                    descriptions:</label>
                                                <textarea name="prodescription" id="prodescription" rows="5" class="form-control" required></textarea>
                                                <div class="invalid-feedback">
                                                    Please enter some product descriptions.
                                                </div>
                                            </div><br>

                                            <div class="md-3">
                                                <label for="prodetails" class="form-label">Product details:</label>
                                                <textarea name="prodetails" id="prodetails" rows="5" class="form-control" required></textarea>
                                                <div class="invalid-feedback">
                                                    Please enter some product details.
                                                </div>
                                            </div><br>

                                            <div class="md-3">
                                                <label for="proprice" class="form-label">Price:</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" id="proprice" name="proprice"
                                                        class="form-control" min="0" step="0.01" required
                                                        placeholder="Enter price of products">
                                                    <div class="invalid-feedback">
                                                        Please enter a valid price.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status:</label>
                                                <select name="status" id="status" class="form-control" required>
                                                    <option value="1">Show</option>
                                                    <option value="0">Not Show</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select the product status.
                                                </div>
                                            </div>

                                            <div class="md-3">
                                                <label for="discount" class="form-label">Discount:</label>
                                                <input name="discount" id="discount" rows="5"
                                                    class="form-control" required>
                                                <div class="invalid-feedback">
                                                    Please enter some product discount.
                                                </div>
                                            </div><br>

                                            <div class="mb-3">
                                                <label for="bestseller" class="form-label">Hot sales:</label>
                                                <select name="bestseller" id="bestseller" class="form-control"
                                                    required>
                                                    <option value="1">Hot Sale</option>
                                                    <option value="0">Not Hot Sale</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select whether the product is a hot sale or not.
                                                </div>
                                            </div>

                                            <div class="md-3">
                                                <label for="quantity" class="form-label">Quantity:</label>
                                                <input name="quantity" id="quantity" rows="5"
                                                    class="form-control" required>
                                                <div class="invalid-feedback">
                                                    Please enter some product quantity.
                                                </div>
                                            </div><br>
                                            <div class="md-3">
                                                <label for="suppid" class="form-label">Supplier:</label>
                                                <select id="suppid" name="suppid" class="form-select" required>
                                                    @foreach ($supp as $s)
                                                        <option value="{{ $s->id }}">{{ $s->suppliername }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a supplier.
                                                </div>
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-success">Add new</button>
                                        </form>
                                    </table>
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
        @include('layout.admin.footer')
