<?php $__env->startSection('title', 'Home '); ?>


<?php $__env->startSection('content'); ?>
<!-- Preloader -->
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>

<header id="HOME" style="background-position: 50% -125px;">
    <div class="section_overlay">
        <?php echo $__env->make('layouts/sections/navbar/indexNavbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="home_text wow fadeInUp animated">
                        <h2>TISHA'S BOOK CLUB MANAGEMENT</h2>
                        <p> <strong>bringing community together to learn something that matters</strong> </p>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="scroll_down">
                        <a href="#SERVICE"><img src="<?php echo e(asset('assets/index/images/scroll.png')); ?>" alt="scroll">
                            <h4>Scroll Down</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
</header>

<section class="services mb-n2" id="SERVICE">
    <div class="container mt-n5 mb-n3">
        <div class="row mb-n5">
            <div class="col-md-4 text-center">
                <div class="single_service wow fadeInUp" data-wow-delay="1s">
                    <a href="<?php echo e(route('dash2')); ?>">
                        <i class="icon-book-open"></i>
                        <h2>BOOK DISPLAY</h2>
                        <p>Display all currently active and available books</p>
                    </a>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="single_service wow fadeInUp" data-wow-delay="2s">
                    <a href="<?php echo e(route('manage')); ?>">
                        <i class="icon-gears"></i>
                        <h2>Manage books</h2>
                        <p>Manage all active and inactive books</p>
                    </a>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="single_service wow fadeInUp" data-wow-delay="3s">
                    <a href="<?php echo e(route('category')); ?>">
                        <i class="icon-gears"></i>
                        <h2>manage category</h2>
                        <p>Manage category status</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonial text-center wow fadeInUp animated mt-n5" id="TESTIMONIAL">
    <div class="container mt-n2 mb-n4">
        <img src="<?php echo e(asset('assets/logo/logo_transparent.png')); ?>" class="w-px-400 h-auto mt-n5 mb-n5" alt="weee">
        
        <div class="owl-carousel mt-n5">
            <div class="single_testimonial text-center wow fadeInUp animated">
                <p>“Despite the enormous quantity of books, how few people read! And if one reads profitably, one would
                    realize how <br />much
                    stupid stuff the vulgar herd is content to swallow every day.”</p>
                <h4>- Voltaire</h4>
            </div>
            <div class="single_testimonial text-center">
                <p>“We are of opinion that instead of letting books grow moldy behind an iron grating, far from the
                    vulgar gaze,
                    <br />it is better to let them wear out by being read.”
                </p>
                <h4>- Jules Verne</h4>
            </div>
        </div>
    </div>
</section>


<div class="fun_facts">
    <section class="header parallax home-parallax page" id="fun_facts" style="background-position: 50% -150px;">
        <div class="section_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 wow fadeInLeft animated">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="single_count">
                                    <i class="icon-book-open"></i>
                                    <h3><?php echo e($allcount); ?></h3>
                                    <p>Total Books</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</div>
<section class="work_area" id="WORK">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="work_title  wow fadeInUp animated">
                    <h1>Latest Books</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php $__currentLoopData = $recents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col no_padding">
                <div class="single_image">
                    <img class="h-px-400" src="<?php echo e(asset('/images/books/' . $recent->bookIMG)); ?>" alt="w1">
                    <div class="image_overlay">
                        <a href="<?php echo e(route('dash2')); ?>">View All Books</a>
                        <h2><?php echo e($recent->bookTitle); ?></h2>
                        <h4>Published: <?php echo e($recent->bookPublicationYear); ?></h4>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </div>
        
    </div>
</section>
<section class="call_to_action">
    <div class="container">

    </div>
</section>

<footer>
    <div class="container mt-4">
        <div class="container mb-n4">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="footer_logo   wow fadeInUp animated">
                        <img src="<?php echo e(asset('assets/logo/logo_transparent.png')); ?>" class="w-px-150 h-auto" alt="weee">
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center   wow fadeInUp animated">
                    <div class="social">
                        <h2>Follow Tisha</h2>
                        <ul class="icon_list">
                            <li><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                            <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                            <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                        </ul>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/indexLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\tishas-book-club\resources\views/content/homepage/index.blade.php ENDPATH**/ ?>