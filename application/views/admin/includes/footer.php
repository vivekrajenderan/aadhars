<!-- footer content -->
<footer>
    <div class="pull-right">
        AADHAR APP by <a href="http://vijayglobal.com/">VGS</a>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>


<!-- Custom Theme Scripts -->
<script src="<?php echo base_url(); ?>assets/data_tables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/data_tables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>  
<script>
    $(document).ready(function () {
        setTimeout(function () {
            $('.alert-success').hide('slow');
        }, 4000);
         setTimeout(function () {
            $('.alert-error').hide('slow');
        }, 4000);

        $('#datatable').dataTable();

    });
</script>
</body>
</html>
