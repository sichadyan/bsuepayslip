</div>
  <!-- /.content-wrapper -->
<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-block-down">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date("Y");?> <a href="#">Batangas State University</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="../dist/js/adminlte.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/datatables.js"></script>
<!-- datepicker -->
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script src="../dist/js/pages/dashboard3.js"></script>
<script src="dist/js/printThis.js"></script>

<!-- Custom Script-->
<script>
    $(document).ready(function () {
        //datatable 
        $('.jqdatatable').DataTable(
          {
              bProcessing: false,
              aLengthMenu: [
                              [10, 50, 100, 200, -1],
                              [10, 50, 100, 200, "All"]],
              "columnDefs": [{ "width": "10%", "targets": 0 }]
          }
        );

        //Date picker
        $('#birthdate').datepicker();
        $('#deductiondatestart').datepicker();
        $('#deductiondateend').datepicker();
    });
</script>


</body>
</html>