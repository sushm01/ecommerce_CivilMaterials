<!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">Cubicide Technology</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- JS Start Footer  -->
<!-- jQuery -->
<script src="<?php echo base_url()?>admin_asstes/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url()?>admin_asstes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url()?>admin_asstes/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>admin_asstes/dist/js/adminlte.js"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?php echo base_url()?>admin_asstes/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?php echo base_url()?>admin_asstes/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url()?>admin_asstes/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?php echo base_url()?>admin_asstes/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url()?>admin_asstes/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>admin_asstes/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url()?>admin_asstes/dist/js/pages/dashboard2.js"></script>
<!-- JS End Footer -->

<!-- JS Start Order Management DataTables  & Plugins -->
<script src="<?php echo base_url()?>admin_asstes/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>admin_asstes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>admin_asstes/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url()?>admin_asstes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>admin_asstes/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url()?>admin_asstes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url()?>admin_asstes/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url()?>admin_asstes/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url()?>admin_asstes/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url()?>admin_asstes/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url()?>admin_asstes/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url()?>admin_asstes/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
  });
</script>
<!-- JS End Order Management DataTables  & Plugins -->

</body>
</html>