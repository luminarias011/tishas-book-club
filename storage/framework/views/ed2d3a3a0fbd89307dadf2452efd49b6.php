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

<script type="text/javascript">
    $('#search').on('keyup', function(){
        // alert('hello');
        $Svalue=$(this).val();
        // alert($Svalue);
        $.ajax({
            type: 'get',
            url: '<?php echo e(URL::to('/')); ?>',
            data: {'search':$Svalue},

            // success:function(data){
            //     console.log(data);
            //     $('#Contents').html(data);
            // }
        });
    })
</script>

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
<?php echo $__env->yieldPushContent('pricing-script'); ?>
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
<?php echo $__env->yieldContent('page-script'); ?>
<!-- END: Page JS-->
<?php /**PATH C:\laragon\www\tishas-book-club\resources\views/layouts/sections/scripts.blade.php ENDPATH**/ ?>