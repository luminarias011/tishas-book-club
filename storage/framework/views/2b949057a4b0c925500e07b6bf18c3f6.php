<?php $__env->startSection('title', 'Books '); ?>

<?php $__env->startSection('vendor-style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('vendor-script'); ?>
<script src="<?php echo e(asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-script'); ?>
<script src="<?php echo e(asset('assets/js/extended-ui-perfect-scrollbar.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/ui-modals.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/ui-toasts.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-3">

  </div>
  <div class="col-6">
    <div class="alert alert-success alert-dismissible" role="alert" id="alert">
      <h4>This is a success dismissible alert — check it out!</h4>

      <div>
        <small><i>Will close after 5 seconds</i></small><button type="button" class="btn-close" data-bs-dismiss="alert"
          aria-label="Close">
        </button>
      </div>
    </div>
  </div>
  <div class="col-3">

  </div>
</div>


<div>
  <div class="row">
    <h5 class="mt-1">Book Display</h5>
    <div class="col-lg-9 overflow-hidden" style="height: 540px;" id="vertical-example">
      <div class="">
        <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $author = DB::table('author_tbl')->where('authorID', '=', $book->authorID)->first();
        $isActive = DB::table('isActive_tbl')->where('is_activeID', '=', $book->is_activeID)->first();
        ?>
        <div class="row mb-3">
          <div class="col">
            <div class="card">
              <div class="row g-0">
                <div class="col-lg-3 col-sm-5 col-md-4">
                  <img class="card-img card-img-left" src="<?php echo e(asset('/images/books/' . $book->bookIMG)); ?>"
                    alt="<?php echo e($book->bookIMG); ?>" />
                </div>
                <div class="col-lg-8 col-md-4 col-sm-5">
                  <div class="card-body">
                    <h3 class="card-title"><?php echo e($book->bookTitle); ?></h3>
                    <b>Author: </b><?php echo e($author->firstName); ?> <?php echo e($author->lastName); ?><br>
                    <b>ISBN: </b><?php echo e($book->bookISBN); ?> <br>
                    <b>Publisher: </b><?php echo e($book->bookPublisher); ?> <br>
                    <b>Year published: </b><?php echo e($book->bookPublicationYear); ?> <br>
                    <b>Book copies: </b><?php echo e($book->bookCopies); ?> <br>

                    <p class="card-text"><small class="text-muted"><?php echo e($isActive->status); ?></small></p>

                  </div>
                  <div class="card-footer">
                    <div class="row gy-2">
                      <div class="col-lg-2 col-md-4">
                        <button type="button" class="btn btn-xs " data-bs-toggle="offcanvas"
                          data-bs-target="#offcanvasEnd<?php echo e($book->bookID); ?>" aria-controls="offcanvasEnd">View
                          details</button>

                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd<?php echo e($book->bookID); ?>"
          aria-labelledby="offcanvasEndLabel">
          <div class="offcanvas-header">
            <h4 id="offcanvasEndLabel" class="offcanvas-title"><?php echo e($book->bookTitle); ?></h4>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <p class="mx-4"><small class="text-muted">Written by <?php echo e($author->firstName); ?> <?php echo e($author->lastName); ?></small>
          </p>
          <div class="offcanvas-body my-auto mx-1 flex-grow-0">
            <p class="text-start"><?php echo e($book->bookSummary); ?></p>
          </div>
          <div class="padding-canvas-footer mx-4 my-4">
            <?php if($book->bookURL == '#'): ?>
            <a type="button" class="btn btn-primary mb-2 d-grid w-100" href="<?php echo e($book->bookURL); ?>">No
              review</a>
            <?php else: ?>
            <a type="button" class="btn btn-primary mb-2 d-grid w-100" target="_blank" href="<?php echo e($book->bookURL); ?>">See
              review</a>
            <?php endif; ?>
            <button type="button" class="btn btn-outline-secondary d-grid w-100"
              data-bs-dismiss="offcanvas">Back</button>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>

    <div class="col-lg-3 ">
      <div class="accordion" id="accordionExample">
        <div class="card accordion-item active mb-3">
          <h2 class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne"
              aria-expanded="true" aria-controls="accordionOne">
              BOOK COUNT
            </button>
          </h2>

          <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <div class="ms-2">
                All registered books: <strong><?php echo e($allcount); ?></strong> <br>
                By category:
                <ul>
                  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><?php echo e($category->categoryName); ?>: <?php
                    $countCategory = DB::table('tbl_book')->where('categoryID', '=', $category->categoryID)->get();
                    $countByCategory = $countCategory->count();
                    ?> <strong><?php echo e($countByCategory); ?></strong></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                Number of categories: <strong><?php echo e($categoryCount); ?></strong> <br>
              </div>
            </div>
          </div>
        </div>

        <div class="divider">
          <div class="divider-text fw-semibold">Shortcuts</div>
        </div>

        <div class="card accordion-item mb-3">
          <h2 class="accordion-header" id="headingTwo">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
              data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
              CATEGORY

            </button>

          </h2>
          <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
              All category: <br>
              <ul style="list-style-type: none">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a class="btn btn-md" href="<?php echo e(route('category')); ?>"><?php echo e($category->categoryName); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </ul>
              <div class="row mb-3" style="padding-left: 6px">
                <div class="col-12">
                  <button class="btn btn-info btn-md" onclick="window.location.href='<?php echo e(route('category')); ?>'"
                    style="min-width: 280px" type="button">SEE EACH
                    STATUS</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
              data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree">
              OPTIONS
            </button>
          </h2>
          <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <div class="row mb-3 mt-1" style="padding-left: 6px">
                <div class="col-12">
                  <button class="btn btn-info btn-md" style="min-width: 280px" type="button" data-bs-toggle="modal"
                    data-bs-target="#largeModal">REGISTER A BOOK</button>
                </div>
              </div>
              <div class="row mb-3" style="padding-left: 6px">
                <div class="col-12">
                  <button class="btn btn-danger btn-md" onclick="window.location.href='<?php echo e(route('manage')); ?>'"
                    style="min-width: 280px" type="button">MANAGE BOOKS</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>

    </div>
  </div>
  
  <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel3">REGISTER BOOK</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="defaultFormControlHelp" class="form-text mb-2">Required fields with <i style="color: red">*</i>.
          </div>
          <form method="post" action="<?php echo e(route('register')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
              <div class="col mb-3">
                <label for="nameLarge" class="form-label">BOOK TITLE <i style="color: red">*</i></label>
                <input type="text" id="nameLarge" class="form-control" placeholder="Enter Title" name="book_title"
                  required>
              </div>
            </div>

            <div class="row">
              <div class="col mb-3">
                <label for="nameLarge" class="form-label">AUTHOR <i style="color: red">*</i></label>
                <input type="text" id="nameLarge" class="form-control" placeholder="Book Author" name="book_author"
                  required>
              </div>
            </div>

            <div class="row">
              <div class="col mb-3">
                <label for="nameLarge" class="form-label">BOOK ISBN <i><small>(International standard book number)
                    </small></i><i style="color: red">*</i></label>
                <input type="text" id="nameLarge" class="form-control" placeholder="Enter ISBN" name="book_isbn"
                  required>
              </div>
            </div>

            <div class="row">
              <div class="col mb-3">
                <label for="nameLarge" class="form-label">CATEGORY <i style="color: red">*</i></label>
                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example"
                  name="book_category" required>
                  <option selected>Select category</option>
                  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selectC): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($selectC->categoryID); ?>"><?php echo e($selectC->categoryName); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col mb-3">
                <label for="nameLarge" class="form-label">PUBLISHER <i style="color: red">*</i></label>
                <input type="text" id="nameLarge" class="form-control" placeholder="Book Publisher"
                  name="book_publisher" required>
              </div>
            </div>

            <div class="row">
              <div class="col mb-3">
                <label for="nameLarge" class="form-label">PUBLICATION YEAR <i style="color: red">*</i></label>
                <input type="text" id="nameLarge" class="form-control" placeholder="Enter Year Published"
                  name="publication_year" required>
              </div>
            </div>

            <div class="row">
              <div class="col mb-3">
                <label for="nameLarge" class="form-label">BOOK COPIES <i style="color: red">*</i></label>
                <input type="text" id="nameLarge" class="form-control" placeholder="Enter Book Copies"
                  name="book_copies" required>
              </div>
            </div>

            <div class="row">
              <div class="col mb-3">
                <label for="nameLarge" class="form-label">PREVIEW URL</label>
                <input type="text" id="nameLarge" class="form-control" placeholder="Enter Book Preview url"
                  name="book_url">
              </div>
            </div>

            <div class="row">
              <div class="col mb-3">
                <label for="nameLarge" class="form-label">BOOK SUMMARY</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                  placeholder="Enter Book Summary/Synopsis" name="book_summary"></textarea>
              </div>
            </div>

            <div class="row">
              <div class="col mb-3">
                <div class="form-group">
                  <label for="formFile" class="form-label">Book cover</label>
                  <input class="form-control" type="file" id="formFile" name="book_image">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col mb-3">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/contentNavbarLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\tishas-book-club\resources\views/content/dashboard/dash.blade.php ENDPATH**/ ?>