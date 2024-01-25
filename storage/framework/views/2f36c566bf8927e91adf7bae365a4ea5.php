<!-- BEGIN: Vendor JS-->
<script src="<?php echo e(asset('assets/vendor/libs/jquery/jquery.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/popper/popper.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/js/bootstrap.js')); ?>"></script>


<script src="<?php echo e(asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/js/menu.js')); ?>"></script>
<?php echo $__env->yieldContent('vendor-script'); ?>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/cards-search.js')); ?>"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>

<script type="text/javascript">
    $('#search').on('keyup', function(){
        // alert('hello');
        $Svalue=$(this).val();
        // alert($Svalue);
        $.ajax({
            type: 'get',
            url: '<?php echo e(URL::to('search')); ?>',
            data: {'search':$Svalue},

            // success:function(data){
            //     console.log(data);
            //     $('#Contents').html(data);
            // }
        });
    })

    $(document).ready(function () {

        $('#allBooks_tbl').dataTable({
            "pageLength": 10,
            "responsive": true,
            "autoWidth": true,
            "order": [[ 2, 'asc' ]],
        });
        $('#allCategories_tbl').dataTable({
        "pageLength": 10,
        "responsive": true,
        "autoWidth": true,
        "order": [[ 1, 'asc' ]],
        });/*
        $('#viewtbl').dataTable({
            "pageLength": 50,
            "responsive": true,
            "autoWidth": true,
        });*/
        $('#example').DataTable();

        setTimeout(function () {
        
        // Closing the alert
        $('#alert').alert('close');
        }, 4000);
    });
    
</script>


<script>
    <?php if(Session::has('success')): ?>
    toastr.success("<?php echo e(Session::get('success')); ?>");
    <?php endif; ?>
    
    
    <?php if(Session::has('info')): ?>
    toastr.info("<?php echo e(Session::get('info')); ?>");
    <?php endif; ?>
    
    
    <?php if(Session::has('warning')): ?>
    toastr.warning("<?php echo e(Session::get('warning')); ?>");
    <?php endif; ?>
    
    
    <?php if(Session::has('error')): ?>
    toastr.error("<?php echo e(Session::get('error')); ?>");
    <?php endif; ?>
</script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
<?php echo $__env->yieldPushContent('pricing-script'); ?>
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
<?php echo $__env->yieldContent('page-script'); ?>
<!-- END: Page JS--><?php /**PATH C:\laragon\www\tishas-book-club\resources\views/layouts/sections/masterIncludes/scripts.blade.php ENDPATH**/ ?>