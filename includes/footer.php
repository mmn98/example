</div><!-- ./wrapper -->
            <!-- add new calendar event modal -->
            <script src="<?php echo BASE_URL; ?>js/jquery.min.js" type="text/javascript"></script>
            <!-- jQuery UI 1.10.3 -->
            <script src="<?php echo BASE_URL; ?>js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
            <!-- Bootstrap -->
            <script src="<?php echo BASE_URL; ?>js/bootstrap.min.js" type="text/javascript"></script>
            <!-- Director App -->
            <script src="<?php echo BASE_URL; ?>js/Director/app.js" type="text/javascript"></script>

            <script src="<?php echo BASE_URL; ?>js/custom.js" type="text/javascript"></script>
           
            <!-- for validation plugin using jQuery-->
            <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
            <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
            <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
            <!--for DataTables functionality -->
            <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> 
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
          
 <script>
    $(document).ready(function() {
    $('#resizable').DataTable({
        
       "columnDefs": [
    { "orderable": false, "targets": 0 },
    { "orderable": false, "targets": 4 },
            ]
        });
} );

    </script>

           
        </body>
    </html>
    