

<?php $__env->startSection('title', 'Categories '); ?>

<?php $__env->startSection('vendor-style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('vendor-script'); ?>
<script src="<?php echo e(asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-script'); ?>
<script src="<?php echo e(asset('assets/js/extended-ui-perfect-scrollbar.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/ui-modals.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div>
    <div class="row">
        <h5 class="mt-1">Manage Categories</h5>
        <div class="col-lg-9 overflow-hidden" style="height: 540px;" id="vertical-example">
            <div class="">
                

                
                <!-- Hoverable Table rows -->
                <div class="card">
                    <h5 class="card-header mt-2 mb-n2">List of All Books</h5>
                    <hr>
                    <div class="text-nowrap ps-3 pe-3">
                        <table id="allCategories_tbl" class="table table-hover ms-n3">
                            <caption class="ms-4">Manage</caption>
                            <thead>
                                <tr class="text-nowrap">
                                    <th>CATEGORY ID</th>
                                    <th>CATEGORY NAME</th>
                                    <th>STATUS</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php

                                $isActive = DB::table('isActive_tbl')->where('is_activeID', '=',
                                $cat->is_activeID)->first();

                                ?>
                                <tr class="<?php if($isActive->status=='Active'): ?>
                                <?php else: ?>
                                    table-warning
                                <?php endif; ?>">
                                    <th scope="row"><?php echo e($cat->categoryID); ?></th>
                                    <td><?php echo e($cat->categoryName); ?></td>
                                    <td><span class="badge <?php if($isActive->status=='Active'): ?>
                                        bg-label-primary
                                    <?php else: ?>
                                        bg-label-warning
                                    <?php endif; ?> me-1"><?php echo e($isActive->status); ?></span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded"></i></button>
                                            <div class="dropdown-menu">
                                                
                                                <?php if($cat->is_activeID=='1'): ?>
                                                <a class="dropdown-item"
                                                    href="<?php echo e(route('setInactive_Cat', ['categoryID' => $cat->categoryID])); ?>"><i
                                                        class="bx bx-toggle-right link-primary me-1"></i> Set
                                                    as Inactive</a>
                                                <?php else: ?>
                                                <a class="dropdown-item"
                                                    href="<?php echo e(route('setActive_Cat', ['categoryID' => $cat->categoryID])); ?>"><i
                                                        class="bx bx-toggle-left link-warning me-1"></i> Set
                                                    as Active</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/ Hoverable Table rows -->
            </div>
        </div>

        <div class="col-lg-3 ">
            <div class="accordion" id="accordionExample">
                

                <div class="card accordion-item active mb-3">
                    <h2 class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                            data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                            <span class=""><i class="bx bxs-cog pe-2 mt-n1 link-danger"></i>OPTIONS</span>
                        </button>
                    </h2>

                    <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row mb-3 mt-1" style="padding-left: 6px">
                                <div class="col-12">
                                    <button class="btn btn-success btn-md" style="min-width: 280px" type="button"
                                        onclick="window.location.href='<?php echo e(route('setCategoryActive')); ?>'">SET ALL AS
                                        ACTIVE</button>
                                </div>
                            </div>
                            <div class="row mb-3 mt-1" style="padding-left: 6px">
                                <div class="col-12">
                                    <button class="btn btn-warning btn-md" style="min-width: 280px" type="button"
                                        onclick="window.location.href='<?php echo e(route('setCategoryInactive')); ?>'">SET ALL AS
                                        INACTIVE</button>
                                </div>
                            </div>
                            <div class="row mb-3" style="padding-left: 6px">
                                <div class="col-12">
                                    <button class="btn btn-danger btn-md"
                                        onclick="window.location.href='<?php echo e(route('manage')); ?>'" style="min-width: 280px"
                                        type="button">
                                        <span class=""><i class="bx bxs-cog pe-2 mt-n1"></i>MANAGE BOOKS</span>
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-3" style="padding-left: 6px">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-md"
                                        onclick="window.location.href='<?php echo e(route('dash2')); ?>'" style="min-width: 280px"
                                        type="button">
                                        <span class=""><i class="bx bxs-book-content pe-2 mt-n1"></i>BOOK DISPLAY</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/zCustomNavbar/manageNavbarLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\tishas-book-club\resources\views/content/dashboard/category.blade.php ENDPATH**/ ?>