<?php
$containerNav = $containerNav ?? 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');

?>

<!-- Navbar -->
<?php if(isset($navbarDetached) && $navbarDetached == 'navbar-detached'): ?>
<nav
  class="layout-navbar <?php echo e($containerNav); ?> navbar navbar-expand-xl <?php echo e($navbarDetached); ?> align-items-center bg-navbar-theme"
  id="layout-navbar">
  <?php endif; ?>
  <?php if(isset($navbarDetached) && $navbarDetached == ''): ?>
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="<?php echo e($containerNav); ?>">
      <?php endif; ?>

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      

      <!-- ! Not required for layout-without-menu -->
      
      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <a href="<?php echo e(config('variables.livePreview')); ?>"><img src="<?php echo e(asset('assets/logo/logo_transparent.png')); ?>"
            class="ms-2 me-2 w-auto h-px-50" alt="aaaaa"></a>
        <a href="<?php echo e(config('variables.livePreview')); ?>">
          <h5 class="mt-3 me-1"><strong> Tisha's Book Club</strong></h5>
        </a>
        <ul class="navbar-nav flex-row align-items-center ms-auto">
          <!-- Search -->
          <div class="navbar-nav align-items-center">
            <form action="">
              <div class="nav-item d-flex align-items-center">
                <a class="btn btn-outline-dark" style="color: black" href="<?php echo e(config('variables.livePreview')); ?>">
                  HOME
                </a>
                <a class="btn " style="color: black" href="<?php echo e(config('variables.booksPage')); ?>">
                  BOOK DISPLAY
                </a>
                <a class="btn " style="color: black" href="<?php echo e(config('variables.managePage')); ?>">
                  MANAGE
                </a>
                
              </div>
            </form>

          </div>
          <!-- /Search -->
          <!-- Place this tag where you want the button to render. -->
          

          <!-- User -->
          
          <!--/ User -->
        </ul>
      </div>

      <?php if(!isset($navbarDetached)): ?>
    </div>
    <?php endif; ?>
  </nav>
  <!-- / Navbar --><?php /**PATH C:\laragon\www\tishas-book-club\resources\views/layouts/sections/navbar/navbar.blade.php ENDPATH**/ ?>