@extends('layouts/contentNavbarLayout')

@section('title', 'Books ')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/extended-ui-perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/js/ui-modals.js')}}"></script>
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-3">
        <h5 class="mt-2 mb-3">Book Display</h5>
    </div>
    <div class="col-6">
        {{-- <div class="alert alert-info alert-dismissible" role="alert" id="alert">
            <h5>This is a success dismissible alert — check it out!</h5>
            <div>
                <small><i class="text-muted">Will close after 5 seconds</i></small>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div> --}}
    </div>
    <div class="col-3"></div>
</div>
<div class="row">
    <div class="col-lg-9 overflow-hidden" style="height: 542px;" id="vertical-example">
        <h3>{{ $noDisplayMessage }}</h3>
        <p>{{ $subMessage }}</p>
        <div class="row row-cols-1 row-cols-md-4 g-4 mb-2">
            @foreach ($books as $book)
            @php
            $author = DB::table('author_tbl')->where('authorID', '=', $book->authorID)->first();
            $theCategory = DB::table('tbl_bookcategory')->where('categoryID', '=', $book->categoryID)->first();
            $isActive = DB::table('isActive_tbl')->where('is_activeID', '=', $book->is_activeID)->first();
            @endphp
            <div class="col">
                <div class="card card-pullup" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasEnd{{ $book->bookID }}" aria-controls="offcanvasEnd"
                    style="cursor: pointer">
                    <img class="card-img-top h-px-325" src="{{asset('/images/books/' . $book->bookIMG)}}"
                        alt="Card image cap" />
                    <div class="card-body">
                        <h5 class="card-title"><strong>{{ $book->bookTitle }}</strong></h5>
                        <small><b>Author: </b>{{ $author->firstName }} {{ $author->lastName }}</small><br>
                        <small><b>Category: </b>{{ $theCategory->categoryName }} </small><br>
                        <small><b>Publisher: </b>{{ $book->bookPublisher }} </small><br>
                        <small><b>Year published: </b>{{ $book->bookPublicationYear }} </small><br>
                        <p class="card-text"><small class="text-muted">{{ $isActive->status }}</small></p>
                    </div>
                </div>
            </div>
            {{-- CANVA RIGHT --}}
            <div class="offcanvas offcanvas-end mt-n1" tabindex="-1" id="offcanvasEnd{{ $book->bookID }}"
                aria-labelledby="offcanvasEndLabel">
                <div class="offcanvas-header">
                    <h4 id="offcanvasEndLabel" class="offcanvas-title">{{ $book->bookTitle }}</h4>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <br>
                <p class="mx-4"><small class="text-muted"><b>Written by: </b>{{ $author->firstName }} {{
                        $author->lastName }}
                        <br>
                        <b>ISBN: </b>{{ $book->bookISBN }} <br>
                        <b>Book copies: </b>{{ $book->bookCopies }} <br>
                    </small>
                </p>
                <div class="offcanvas-body my-auto mx-1 flex-grow-0">
                    <p class="text-start">{{ $book->bookSummary }}</p>
                </div>
                <div class="padding-canvas-footer mx-4 my-4">
                    @if ($book->bookURL == '#')
                    <a type="button" class="btn btn-primary mb-2 d-grid w-100" href="{{ $book->bookURL }}">No
                        review</a>
                    @else
                    <a type="button" class="btn btn-primary mb-2 d-grid w-100" target="_blank"
                        href="{{ $book->bookURL }}">See
                        review</a>
                    @endif
                    <button type="button" class="btn btn-outline-secondary d-grid w-100"
                        data-bs-dismiss="offcanvas">Back</button>
                </div>
            </div>
            @endforeach
        </div>
        {{-- <div class="">
            @foreach ($books as $book)
            @php
            $author = DB::table('author_tbl')->where('authorID', '=', $book->authorID)->first();
            $theCategory = DB::table('tbl_bookcategory')->where('categoryID', '=', $book->categoryID)->first();
            $isActive = DB::table('isActive_tbl')->where('is_activeID', '=', $book->is_activeID)->first();
            @endphp
            <div class="row mb-3">
                <div class="col">

                    <div class="card">
                        <div class="row g-0">
                            <div class="col-lg-3 col-sm-5 col-md-4">
                                <img class="card-img card-img-left" src="{{asset('/images/books/' . $book->bookIMG)}}"
                                    alt="{{ $book->bookIMG }}" />
                            </div>
                            <div class="col-lg-8 col-md-4 col-sm-5">
                                <div class="card-body">
                                    <h3 class="card-title choose">{{ $book->bookTitle }}</h3>
                                    <b>Author: </b>{{ $author->firstName }} {{ $author->lastName }}<br>
                                    <b>Category: </b>{{ $theCategory->categoryName }}<br>
                                    <b>ISBN: </b>{{ $book->bookISBN }} <br>
                                    <b>Publisher: </b>{{ $book->bookPublisher }} <br>
                                    <b>Year published: </b>{{ $book->bookPublicationYear }} <br>
                                    <b>Book copies: </b>{{ $book->bookCopies }} <br>

                                    <p class="card-text"><small class="text-muted">{{ $isActive->status }}</small></p>

                                </div>
                                <div class="card-footer">
                                    <div class="row gy-2">
                                        <div class="col-lg-2 col-md-4">
                                            <button type="button" class="btn btn-xs " data-bs-toggle="offcanvas"
                                                data-bs-target="#offcanvasEnd{{ $book->bookID }}"
                                                aria-controls="offcanvasEnd">View
                                                details</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd{{ $book->bookID }}"
                aria-labelledby="offcanvasEndLabel">
                <div class="offcanvas-header">
                    <h4 id="offcanvasEndLabel" class="offcanvas-title">{{ $book->bookTitle }}</h4>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <p class="mx-4"><small class="text-muted">Written by {{ $author->firstName }} {{ $author->lastName
                        }}</small>
                </p>
                <div class="offcanvas-body my-auto mx-1 flex-grow-0">
                    <p class="text-start">{{ $book->bookSummary }}</p>
                </div>
                <div class="padding-canvas-footer mx-4 my-4">
                    @if ($book->bookURL == '#')
                    <a type="button" class="btn btn-primary mb-2 d-grid w-100" href="{{ $book->bookURL }}">No
                        review</a>
                    @else
                    <a type="button" class="btn btn-primary mb-2 d-grid w-100" target="_blank"
                        href="{{ $book->bookURL }}">See
                        review</a>
                    @endif
                    <button type="button" class="btn btn-outline-secondary d-grid w-100"
                        data-bs-dismiss="offcanvas">Back</button>
                </div>
            </div>
            @endforeach
        </div> --}}
    </div>

    <div class="col-lg-3 ">
        <h3></h3>
        <div class="accordion" id="accordionExample">
            <div class="card accordion-item active mb-3">
                <h2 class="accordion-header" id="headingOne">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse"
                        data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                        <span class=""><i class="bx bxs-book-content pe-2 mt-n1 link-primary"></i>BOOK COUNT</span>
                    </button>
                </h2>

                <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="ms-2">
                            All registered books: <strong>{{ $allcount }}</strong> <br>
                            By category:
                            <ul>
                                @foreach ($categories as $category)
                                <li>{{ $category->categoryName }}: @php
                                    $countCategory = DB::table('tbl_book')->where('categoryID', '=',
                                    $category->categoryID)->where('isDeleted', '=', '0')->get();
                                    $countByCategory = $countCategory->count();
                                    @endphp <strong>{{ $countByCategory }}</strong></li>
                                @endforeach
                            </ul>
                            Number of categories: <strong>{{ $categoryCount }}</strong> <br>
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
                        <span class=""><i class="bx bxs-category-alt pe-2 mt-n1 link-info"></i>CATEGORIES</span>
                    </button>

                </h2>
                <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        All category: <br>
                        <ul style="list-style-type: none">
                            @foreach ($categories as $category)
                            <li><a class="btn btn-md" href="{{ route('category') }}">{{ $category->categoryName }}</a>
                            </li>
                            @endforeach

                        </ul>
                        <div class="row mb-3" style="padding-left: 6px">
                            <div class="col-12">
                                <button class="btn btn-info btn-md"
                                    onclick="window.location.href='{{ route('category') }}'" style="min-width: 280px"
                                    type="button">
                                    <span class=""><i class="bx bx-info-circle pe-2 mt-n1"></i>SEE EACH STATUS</span>
                                </button>
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
                                    onclick="window.location.href='{{ route('manage') }}'" style="min-width: 280px"
                                    type="button">
                                    <span class=""><i class="bx bxs-cog pe-2 mt-n1"></i>MANAGE BOOKS</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="divider">
                <div class="divider-text fw-semibold">Shortcuts</div>
            </div>

            <div class="d-grid gap-2 col-lg-12 mx-auto">
                <button class="btn btn-primary btn-lg" type="button">Button</button>
                <button class="btn btn-secondary btn-lg" type="button">Button</button>
            </div> --}}
        </div>

    </div>
</div>
{{-- ADD MODAL --}}
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
                <form method="post" action="{{ route('registerOnDash') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameLarge" class="form-label">BOOK TITLE <i style="color: red">*</i></label>
                            <div class="input-group input-group-merge">
                                <span id="basic-book-title" class="input-group-text"><i class="bx bx-book"></i></span>
                                <input type="text" id="nameLarge" class="form-control" placeholder="Enter Title"
                                    name="book_title" aria-describedby="basic-book-title" required>
                            </div>
                        </div>
                    </div>
                    @php

                    $authorsAdd = DB::table('author_tbl')->get();

                    @endphp
                    <div class="row">
                        <div class="col-6">
                            <label for="nameLarge" class="form-label">BOOK AUTHOR <i><small>(First & Last name)
                                    </small></i><i style="color: red">*</i></label>
                            <input class="form-control" list="datalistOptions1" name="author_first" id="exampleDataList"
                                placeholder="Author First Name" required>
                            <datalist id="datalistOptions1">
                                @foreach ($authorsAdd as $authorName)
                                <option value="{{ $authorName->firstName }}"></option>
                                @endforeach
                            </datalist>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="nameLarge" class="form-label" style="color: whitesmoke"><small>.
                                </small></label>
                            <input class="form-control" list="datalistOptions2" name="author_last" id="exampleDataList"
                                placeholder="Author Last Name" required>
                            <datalist id="datalistOptions2">
                                @foreach ($authorsAdd as $authorName)
                                <option value="{{ $authorName->lastName }}"></option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameLarge" class="form-label">BOOK ISBN <i><small>(International standard book
                                        number)
                                    </small></i><i style="color: red">*</i></label>
                            <div class="input-group input-group-merge">
                                <span id="basic-book-ISBN" class="input-group-text"><i class="bx bx-barcode"></i></span>
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
                                    @foreach ($categories as $selectC)
                                    <option value="{{ $selectC->categoryID }}">{{ $selectC->categoryName }}</option>
                                    @endforeach
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
                                    list="datalistOptionsYear" class="form-control" placeholder="Enter Year Published"
                                    name="publication_year" aria-describedby="basic-book-year" required>
                                <datalist id="datalistOptionsYear">
                                    @for ($i = 1901; $i <= 2115 ; $i++) <option value="{{ $i }}">
                                        </option>
                                        @endfor
                                </datalist>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameLarge" class="form-label">BOOK COPIES <i style="color: red">*</i></label>
                            <div class="input-group input-group-merge">
                                <span id="basic-book-copies" class="input-group-text"><i
                                        class="bx bx-library"></i></span>
                                <input type="text" id="nameLarge" class="form-control" placeholder="Enter Book Copies"
                                    name="book_copies" aria-describedby="basic-book-copies" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameLarge" class="form-label">PREVIEW URL</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-book-url" class="input-group-text"><i class="bx bx-card"></i></span>
                                <input type="text" id="nameLarge" class="form-control" aria-describedby="basic-book-url"
                                    placeholder="Enter Book Preview url" name="book_url">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameLarge" class="form-label">BOOK SUMMARY</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-book-summary" class="input-group-text"><i class="bx bx-note"></i></span>
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

{{-- <div class="card mb-4">
    <h5 class="card-header">Button Options</h5>
    <div class="card-body">
        <small class="text-light fw-semibold">Block level buttons</small>
        <div class="row mt-3">
            <div class="d-grid gap-2 col-lg-6 mx-auto">
                <button class="btn btn-primary btn-lg" type="button"
                    onclick="window.location.href='{{ route('addd') }}'">ADD</button>
                <button class="btn btn-secondary btn-lg" type="button">Button</button>
            </div>
        </div>
    </div>
</div> --}}

@endsection