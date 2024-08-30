<!-- ========== Modal PDF RESULTADOS ANALISIS RIESGOS ============================================================-->
  <?php include('cargar_script_bd.php'); ?>
  <?php include('inportar_bd_inspeccion.php'); ?>
  <?php include('estatus_inspeccion_frm.php'); ?>
  <?php include('inicializar_imagenes_frm.php'); ?>
  <?php include('teclado_numerico.php'); ?>
  <?php include('modalExploradorArchivos.php'); ?>
<!-- /.modal -->

<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2023 <a href="http://neftworks.com" target="blank">NefWorks</a></strong> Todos los derechos reservados.
</footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="adminLTE-3.1.0/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="adminLTE-3.1.0/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="adminLTE-3.1.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="adminLTE-3.1.0/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="adminLTE-3.1.0/dist/js/adminlte.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) 
<script src="adminLTE-3.1.0/dist/js/pages/dashboard.js"></script>-->


<!-- SweetAlert2 -->
<script src="adminLTE-3.1.0/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- daterangepicker -->
<script src="adminLTE-3.1.0/plugins/moment/moment.min.js"></script>
<script src="adminLTE-3.1.0/plugins/daterangepicker/daterangepicker.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

<!-- ChartJS -->
<script src="adminLTE-3.1.0/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="adminLTE-3.1.0/plugins/sparklines/sparkline.js"></script>
<!-- jQuery Knob Chart -->
<script src="adminLTE-3.1.0/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="adminLTE-3.1.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="adminLTE-3.1.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="adminLTE-3.1.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="adminLTE-3.1.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="adminLTE-3.1.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="adminLTE-3.1.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="adminLTE-3.1.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="adminLTE-3.1.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="adminLTE-3.1.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="adminLTE-3.1.0/plugins/jszip/jszip.min.js"></script>
<script src="adminLTE-3.1.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="adminLTE-3.1.0/plugins/pdfmake/vfs_fonts.js"></script>

<!-- Treeview -->
<script src="adminLTE-3.1.0/plugins/bootstrap-treeview/bootstrap-treeview.js"></script>

<!-- jsGrid -->
<script src="adminLTE-3.1.0/plugins/jsgrid/jsgrid.min.js"></script>

<!-- jquery-form -->
<script src="adminLTE-3.1.0/plugins/jquery-form/jquery.form.min.js"></script>

<!-- Toastr -->
<script src="adminLTE-3.1.0/plugins/toastr/toastr.min.js"></script>

<!-- Ekko Lightbox -->
<script src="adminLTE-3.1.0/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

<!-- jquery-validation -->
<script src="adminLTE-3.1.0/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="adminLTE-3.1.0/plugins/jquery-validation/additional-methods.min.js"></script>

<!-- bootstrap4-autocomplete -->
<script src="adminLTE-3.1.0/plugins/bootstrap-autocomplete/bootstrap-autocomplete.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script> -->

<!-- Scripts personalizados -->
<!-- funciones globales js -->
<script>
  var num_inspeccion_actual_js = <?php echo json_encode($inspeccion); ?>
</script>
<script src="http://etic-system.local/js/global.js"></script>
<script src="http://etic-system.local/js/teclado_numerico.js"></script>
<script src="http://etic-system.local/js/proceso_bd.js"></script>
<script src="http://etic-system.local/js/menu.js"></script>
<?php

helper('html');

// if(isset($jsonData)) echo view("partials/_json-tree",$jsonData);

//echo($inspeccion);

// if(isset($inspeccion)){
//   $arrInsp = array("inspeccion" => $inspeccion);
//   echo view("partials/_inspeccion-id",$arrInsp);
// }
// else{
//   $arrInsp = array("inspeccion" => 0);
//   echo view("partials/_inspeccion-id",$arrInsp);
// }

//if(isset($inspeccion)) echo view("partials/_inspeccion-id",$inspeccion);

// echo("<script>");
// echo("var Id_Inspeccion = $inspeccion");
// echo("</script>");


if(isset($src)) echo script_tag($src);

?>
</body>
</html>