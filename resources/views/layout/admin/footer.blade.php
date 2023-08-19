
    <!-- plugins:js -->
    <script src="../admin/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../admin/vendors/chart.js/Chart.min.js"></script>
    <script src="../admin/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="../admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="../admin/js/dataTables.select.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../admin/js/off-canvas.js"></script>
    <script src="../admin/js/hoverable-collapse.js"></script>
    <script src="../admin/js/template.js"></script>
    <script src="../admin/js/settings.js"></script>
    <script src="../admin/js/todolist.js"></script>
    <!-- endinject -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.category-row').click(function() {
                var productDetails = $(this).next('.product-details');
                $('.product-details').not(productDetails).slideUp('fast');
                productDetails.slideToggle('fast');
            });
        });
    </script>

    <!-- Custom js for this page-->
    <script src="../admin/js/dashboard.js"></script>
    <script src="../admin/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
    <footer>
        <div class="footer mt-5">
            <p class="text-center">&copy; 2023 H2ST. All rights reserved.</p>
            <p class="text-center">Help: 0123 456 789</p>
        </div>
    </footer>
    </body>

    </html>
