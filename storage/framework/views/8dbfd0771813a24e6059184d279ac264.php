<?php
/* Content classes */
$container = ($container ?? 'container-xxl');

?>


<?php $__env->startSection('layoutContent'); ?>
<div class="content-wrapper">
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('layouts/sections/footer/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="content-backdrop fade"></div>
</div>

<!-- Content -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/commonMaster' , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\tishas-book-club\resources\views/layouts/blankLayout.blade.php ENDPATH**/ ?>