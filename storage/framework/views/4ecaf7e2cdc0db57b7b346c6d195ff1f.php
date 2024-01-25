

<?php $__env->startSection('title', 'Manage '); ?>

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
        <h5 class="mt-1">Manage Books</h5>
        <div class="col-lg-9 overflow-hidden" style="height: 540px;" id="vertical-example">
            <div class="">
                

                
                <!-- Hoverable Table rows -->
                <div class="card">
                    <h5 class="card-header mt-2 mb-n2">List of All Books</h5>
                    <hr>
                    <div class="table-responsive text-nowrap ps-3 pe-3">
                        <table id="allBooks_tbl" class="table table-hover ms-n3">
                            <caption class="ms-4">Manage</caption>
                            <thead>
                                <tr class="text-nowrap">
                                    <th>BOOK ID</th>
                                    <th>IMAGE</th>
                                    <th>TITLE</th>
                                    <th>AUTHOR</th>
                                    <th>CATEGORY</th>
                                    <th>ISBN</th>
                                    <th>PUBLISHER</th>
                                    <th>YEAR PUBLISHED</th>
                                    <th>COPIES</th>
                                    <th>STATUS</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php

                                $author = DB::table('author_tbl')->where('authorID', '=', $book->authorID)->first();
                                $isActive = DB::table('isActive_tbl')->where('is_activeID', '=',
                                $book->is_activeID)->first();

                                ?>
                                <tr class="<?php if($isActive->status=='Active'): ?>
                                <?php else: ?>
                                    table-warning
                                <?php endif; ?>">
                                    <th scope="row"><?php echo e($book->bookID); ?></th>
                                    <td class="pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                        data-bs-placement="top">
                                        <img class="mx-3" height="50" width="auto"
                                            src="<?php echo e(asset('/images/books/' . $book->bookIMG)); ?>"
                                            alt="<?php echo e($book->bookIMG); ?>" />
                                    </td>
                                    <td><?php echo e($book->bookTitle); ?></td>
                                    <td><?php echo e($author->firstName); ?> <?php echo e($author->lastName); ?></td>
                                    <?php
                                    $cat = DB::table('tbl_bookcategory')->where('categoryID', '=',
                                    $book->categoryID)->first();
                                    ?>
                                    <td><?php echo e($cat->categoryName); ?></td>
                                    <td><?php echo e($book->bookISBN); ?></td>
                                    <td><?php echo e($book->bookPublisher); ?></td>
                                    <td><?php echo e($book->bookPublicationYear); ?></td>
                                    <td><?php echo e($book->bookCopies); ?></td>
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
                                                <a class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#editModal<?php echo e($book->bookID); ?>"><i
                                                        class="bx bx-edit-alt me-1 link-info"></i> Edit</a>
                                                <a class="dropdown-item"
                                                    href="<?php echo e(route('delete_book', ['bookID' => $book->bookID])); ?>"><i
                                                        class="bx bx-trash me-1 link-danger"></i> Delete</a>
                                                <?php if($book->is_activeID=='1'): ?>
                                                <a class="dropdown-item"
                                                    href="<?php echo e(route('setInactive_Book', ['bookID' => $book->bookID])); ?>"><i
                                                        class="bx bx-toggle-right link-primary me-1"></i> Set
                                                    as Inactive</a>
                                                <?php else: ?>
                                                <a class="dropdown-item"
                                                    href="<?php echo e(route('setActive_Book', ['bookID' => $book->bookID])); ?>"><i
                                                        class="bx bx-toggle-left link-warning me-1"></i> Set
                                                    as Active</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                
                                <div class="modal fade" id="editModal<?php echo e($book->bookID); ?>" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel3">UPDATE BOOK DETAILS</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="defaultFormControlHelp" class="form-text mb-2"><i>Required
                                                        fields with <span style="color: red">*</span></i>.
                                                </div>
                                                <form method="post"
                                                    action="<?php echo e(route('edit_book', ['bookIDD' => $book->bookID])); ?>"
                                                    enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameLarge" class="form-label">BOOK TITLE <i
                                                                    style="color: red">*</i></label>
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-book-title" class="input-group-text"><i
                                                                        class="bx bx-book"></i></span>
                                                                <input type="text" id="nameLarge" class="form-control"
                                                                    placeholder="Enter Title" name="book_title"
                                                                    aria-describedby="basic-book-title"
                                                                    value="<?php echo e($book->bookTitle); ?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php

                                                    $authorsAdd = DB::table('author_tbl')->get();
                                                    $authorsEdit = DB::table('author_tbl')->where('authorID', '=',
                                                    $book->authorID)->first();
                                                    $selectedCategory =
                                                    DB::table('tbl_bookcategory')->where('categoryID', '=',
                                                    $book->categoryID)->first();

                                                    ?>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="nameLarge" class="form-label">BOOK AUTHOR
                                                                <i><small>(First & Last name)
                                                                    </small></i><i style="color: red">*</i></label>
                                                            <input class="form-control" list="datalistOptions1"
                                                                name="author_first" id="exampleDataList"
                                                                placeholder="Author First Name"
                                                                value="<?php echo e($authorsEdit->firstName); ?>" required>
                                                            <datalist id="datalistOptions1">
                                                                <?php $__currentLoopData = $authorsAdd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $authorName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($authorName->firstName); ?>"></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </datalist>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <label for="nameLarge" class="form-label"
                                                                style="color: whitesmoke"><small>.
                                                                </small></label>
                                                            <input class="form-control" list="datalistOptions2"
                                                                name="author_last" id="exampleDataList"
                                                                placeholder="Author Last Name"
                                                                value="<?php echo e($authorsEdit->lastName); ?>" required>
                                                            <datalist id="datalistOptions2">
                                                                <?php $__currentLoopData = $authorsAdd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $authorName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($authorName->lastName); ?>"></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </datalist>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameLarge" class="form-label">BOOK ISBN
                                                                <i><small>(International standard
                                                                        book
                                                                        number)
                                                                    </small></i><i style="color: red">*</i></label>
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-book-ISBN" class="input-group-text"><i
                                                                        class="bx bx-barcode"></i></span>
                                                                <input type="text" id="nameLarge" class="form-control"
                                                                    placeholder="Enter ISBN" name="book_isbn"
                                                                    aria-describedby="basic-book-ISBN"
                                                                    value="<?php echo e($book->bookISBN); ?>" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameLarge" class="form-label">CATEGORY <i
                                                                    style="color: red">*</i></label>
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-book-category"
                                                                    class="input-group-text"><i
                                                                        class="bx bx-category-alt"></i></span>
                                                                <select class="form-select"
                                                                    id="exampleFormControlSelect1"
                                                                    aria-label="Default select example"
                                                                    name="book_category"
                                                                    aria-describedby="basic-book-category" required>
                                                                    <option value="<?php echo e($book->categoryID); ?>" selected><?php echo e($selectedCategory->categoryName); ?></option>
                                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selectC): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($selectC->categoryID); ?>"><?php echo e($selectC->categoryName); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameLarge" class="form-label">PUBLISHER <i
                                                                    style="color: red">*</i></label>
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-book-publisher"
                                                                    class="input-group-text"><i
                                                                        class="bx bxs-school"></i></span>
                                                                <input type="text" id="nameLarge" class="form-control"
                                                                    placeholder="Book Publisher" name="book_publisher"
                                                                    aria-describedby="basic-book-publisher"
                                                                    value="<?php echo e($book->bookPublisher); ?>" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameLarge" class="form-label">PUBLICATION YEAR
                                                                <i style="color: red">*</i></label>
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-book-year" class="input-group-text"><i
                                                                        class="bx bx-calendar"></i></span>
                                                                <input type="number" min="1901" max="2115" step="1"
                                                                    id="nameLarge" list="datalistOptionsYear"
                                                                    class="form-control"
                                                                    placeholder="Enter Year Published"
                                                                    name="publication_year"
                                                                    aria-describedby="basic-book-year"
                                                                    value="<?php echo e($book->bookPublicationYear); ?>" required>
                                                                <datalist id="datalistOptionsYear">
                                                                    <?php for($i = 1901; $i <= 2115 ; $i++): ?> <option
                                                                        value="<?php echo e($i); ?>">
                                                                        </option>
                                                                        <?php endfor; ?>
                                                                </datalist>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameLarge" class="form-label">BOOK COPIES <i
                                                                    style="color: red">*</i></label>
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-book-copies" class="input-group-text"><i
                                                                        class="bx bx-library"></i></span>
                                                                <input type="text" id="nameLarge" class="form-control"
                                                                    placeholder="Enter Book Copies" name="book_copies"
                                                                    aria-describedby="basic-book-copies"
                                                                    value="<?php echo e($book->bookCopies); ?>" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameLarge" class="form-label">PREVIEW
                                                                URL</label>
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-book-url" class="input-group-text"><i
                                                                        class="bx bx-card"></i></span>
                                                                <input type="text" id="nameLarge" class="form-control"
                                                                    aria-describedby="basic-book-url"
                                                                    placeholder="Enter Book Preview url" name="book_url"
                                                                    value="<?php echo e($book->bookURL); ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameLarge" class="form-label">BOOK
                                                                SUMMARY</label>
                                                            <div class="input-group input-group-merge">
                                                                <span id="basic-book-summary"
                                                                    class="input-group-text"><i
                                                                        class="bx bx-note"></i></span>
                                                                <textarea class="form-control"
                                                                    id="exampleFormControlTextarea1" rows="5"
                                                                    placeholder="Enter Book Summary/Synopsis"
                                                                    aria-describedby="basic-book-summary"
                                                                    name="book_summary"><?php echo e($book->bookSummary); ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <small class="text-muted"><i>Current image</i></small>
                                                        <div class="col-2 mb-3">
                                                            <img class="ms-1" height="100" width="auto"
                                                                src="<?php echo e(asset('/images/books/' . $book->bookIMG)); ?>"
                                                                alt="">
                                                        </div>
                                                        <div class="col-10 mb-3 mt-2">
                                                            <div class="form-group">
                                                                <label for="formFile" class="form-label">Book
                                                                    cover</label>
                                                                <div class="input-group input-group-merge">
                                                                    <span id="basic-book-cover"
                                                                        class="input-group-text"><i
                                                                            class="bx bx-image-add"></i></span>
                                                                    <input class="form-control" type="file"
                                                                        id="formFile"
                                                                        aria-describedby="basic-book-cover"
                                                                        name="book_image">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                            <span class=""><i class="bx bxs-category-alt pe-2 mt-n1 link-info"></i>CATEGORIES</span>
                        </button>
                    </h2>

                    <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="">
                                All category: <br>
                                <ul style="list-style-type: none">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a class="btn btn-md" href="<?php echo e(route('category')); ?>"><?php echo e($category->categoryName); ?></a>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </ul>
                                <div class="row mb-3" style="padding-left: 6px">
                                    <div class="col-12">
                                        <button class="btn btn-info btn-md"
                                            onclick="window.location.href='<?php echo e(route('category')); ?>'"
                                            style="min-width: 280px" type="button">
                                            <span class=""><i class="bx bx-info-circle pe-2 mt-n1"></i>SEE EACH
                                                STATUS</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#accordionThree" aria-expanded="false" aria-controls="accordionThree">
                            <span class=""><i class="bx bxs-cog pe-2 mt-n1 link-danger"></i>OPTIONS</span>
                        </button>
                    </h2>
                    <div id="accordionThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row mb-3 mt-1" style="padding-left: 6px">
                                <div class="col-12">
                                    <button class="btn btn-success btn-md" style="min-width: 280px" type="button"
                                        onclick="window.location.href='<?php echo e(route('setBooksActive')); ?>'">SET ALL AS
                                        ACTIVE</button>
                                </div>
                            </div>
                            <div class="row mb-3 mt-1" style="padding-left: 6px">
                                <div class="col-12">
                                    <button class="btn btn-warning btn-md" style="min-width: 280px" type="button"
                                        onclick="window.location.href='<?php echo e(route('setBooksInactive')); ?>'">SET ALL AS
                                        INACTIVE</button>
                                </div>
                            </div>
                            <div class="row mb-3 mt-1" style="padding-left: 6px">
                                <div class="col-12">
                                    <button class="btn btn-info btn-md" style="min-width: 280px" type="button"
                                        data-bs-toggle="modal" data-bs-target="#largeModal">
                                        <span class=""><i class="bx bx-bookmark-alt-plus pe-2 mt-n1"></i>REGISTER A
                                            BOOK</span>
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-3" style="padding-left: 6px">
                                <div class="col-12">
                                    <button class="btn btn-danger btn-md"
                                        onclick="window.location.href='<?php echo e(route('category')); ?>'"
                                        style="min-width: 280px" type="button">
                                        <span class=""><i class="bx bxs-cog pe-2 mt-n1"></i>MANAGE CATEGORY</span>
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
    
    <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel3">REGISTER BOOK</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="defaultFormControlHelp" class="form-text mb-2"><i>Required fields with <span
                                style="color: red">*</span></i>.
                    </div>
                    <form method="post" action="<?php echo e(route('registerOnManage')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">BOOK TITLE <i style="color: red">*</i></label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-book-title" class="input-group-text"><i
                                            class="bx bx-book"></i></span>
                                    <input type="text" id="nameLarge" class="form-control" placeholder="Enter Title"
                                        name="book_title" aria-describedby="basic-book-title" required>
                                </div>
                            </div>
                        </div>
                        <?php

                        $authorsAdd = DB::table('author_tbl')->get();

                        ?>
                        <div class="row">
                            <div class="col-6">
                                <label for="nameLarge" class="form-label">BOOK AUTHOR <i><small>(First & Last name)
                                        </small></i><i style="color: red">*</i></label>
                                <input class="form-control" list="datalistOptions1" name="author_first"
                                    id="exampleDataList" placeholder="Author First Name" required>
                                <datalist id="datalistOptions1">
                                    <?php $__currentLoopData = $authorsAdd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $authorName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($authorName->firstName); ?>"></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </datalist>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="nameLarge" class="form-label" style="color: whitesmoke"><small>.
                                    </small></label>
                                <input class="form-control" list="datalistOptions2" name="author_last"
                                    id="exampleDataList" placeholder="Author Last Name" required>
                                <datalist id="datalistOptions2">
                                    <?php $__currentLoopData = $authorsAdd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $authorName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($authorName->lastName); ?>"></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </datalist>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">BOOK ISBN <i><small>(International standard
                                            book
                                            number)
                                        </small></i><i style="color: red">*</i></label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-book-ISBN" class="input-group-text"><i
                                            class="bx bx-barcode"></i></span>
                                    <input type="text" id="nameLarge" class="form-control" placeholder="Enter ISBN"
                                        name="book_isbn" aria-describedby="basic-book-ISBN" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">CATEGORY <i style="color: red">*</i></label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-book-category" class="input-group-text"><i
                                            class="bx bx-category-alt"></i></span>
                                    <select class="form-select" id="exampleFormControlSelect1"
                                        aria-label="Default select example" name="book_category"
                                        aria-describedby="basic-book-category" required>
                                        <option selected>Select category</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selectC): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($selectC->categoryID); ?>"><?php echo e($selectC->categoryName); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">PUBLISHER <i style="color: red">*</i></label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-book-publisher" class="input-group-text"><i
                                            class="bx bxs-school"></i></span>
                                    <input type="text" id="nameLarge" class="form-control" placeholder="Book Publisher"
                                        name="book_publisher" aria-describedby="basic-book-publisher" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">PUBLICATION YEAR <i
                                        style="color: red">*</i></label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-book-year" class="input-group-text"><i
                                            class="bx bx-calendar"></i></span>
                                    <input type="number" min="1901" max="2115" step="1" id="nameLarge"
                                        list="datalistOptionsYear" class="form-control"
                                        placeholder="Enter Year Published" name="publication_year"
                                        aria-describedby="basic-book-year" required>
                                    <datalist id="datalistOptionsYear">
                                        <?php for($i = 1901; $i <= 2115 ; $i++): ?> <option value="<?php echo e($i); ?>">
                                            </option>
                                            <?php endfor; ?>
                                    </datalist>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">BOOK COPIES <i
                                        style="color: red">*</i></label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-book-copies" class="input-group-text"><i
                                            class="bx bx-library"></i></span>
                                    <input type="text" id="nameLarge" class="form-control"
                                        placeholder="Enter Book Copies" name="book_copies"
                                        aria-describedby="basic-book-copies" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">PREVIEW URL</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-book-url" class="input-group-text"><i class="bx bx-card"></i></span>
                                    <input type="text" id="nameLarge" class="form-control"
                                        aria-describedby="basic-book-url" placeholder="Enter Book Preview url"
                                        name="book_url">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">BOOK SUMMARY</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-book-summary" class="input-group-text"><i
                                            class="bx bx-note"></i></span>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        placeholder="Enter Book Summary/Synopsis" aria-describedby="basic-book-summary"
                                        name="book_summary"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <div class="form-group">
                                    <label for="formFile" class="form-label">Book cover</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-book-cover" class="input-group-text"><i
                                                class="bx bx-image-add"></i></span>
                                        <input class="form-control" type="file" id="formFile"
                                            aria-describedby="basic-book-cover" name="book_image">
                                    </div>
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
<?php echo $__env->make('layouts/zCustomNavbar/manageNavbarLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\tishas-book-club\resources\views/content/dashboard/manageBooks.blade.php ENDPATH**/ ?>