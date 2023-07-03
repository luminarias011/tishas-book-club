@extends('layouts/zCustomNavbar/manageNavbarLayout')

@section('title', 'Manage ')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/extended-ui-perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/js/ui-modals.js')}}"></script>
@endsection

@section('content')
<div>
    <div class="row">
        <h5 class="mt-1">Manage Books</h5>
        <div class="col-lg-9 overflow-hidden" style="height: 540px;" id="vertical-example">
            <div class="">
                {{-- @foreach ($books as $book) --}}

                {{-- @endforeach --}}
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
                                @foreach ($books as $book)
                                @php

                                $author = DB::table('author_tbl')->where('authorID', '=', $book->authorID)->first();
                                $isActive = DB::table('isActive_tbl')->where('is_activeID', '=',
                                $book->is_activeID)->first();

                                @endphp
                                <tr class="@if ($isActive->status=='Active')
                                @else
                                    table-warning
                                @endif">
                                    <th scope="row">{{ $book->bookID }}</th>
                                    <td class="pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                        data-bs-placement="top">
                                        <img class="mx-3" height="50" width="auto"
                                            src="{{asset('/images/books/' . $book->bookIMG)}}"
                                            alt="{{ $book->bookIMG }}" />
                                    </td>
                                    <td>{{ $book->bookTitle }}</td>
                                    <td>{{ $author->firstName }} {{ $author->lastName }}</td>
                                    @php
                                    $cat = DB::table('tbl_bookcategory')->where('categoryID', '=',
                                    $book->categoryID)->first();
                                    @endphp
                                    <td>{{ $cat->categoryName }}</td>
                                    <td>{{ $book->bookISBN }}</td>
                                    <td>{{ $book->bookPublisher }}</td>
                                    <td>{{ $book->bookPublicationYear }}</td>
                                    <td>{{ $book->bookCopies }}</td>
                                    <td><span class="badge @if ($isActive->status=='Active')
                                        bg-label-primary
                                    @else
                                        bg-label-warning
                                    @endif me-1">{{ $isActive->status }}</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $book->bookID }}"><i
                                                        class="bx bx-edit-alt me-1 link-info"></i> Edit</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('delete_book', ['bookID' => $book->bookID]) }}"><i
                                                        class="bx bx-trash me-1 link-danger"></i> Delete</a>
                                                @if ($book->is_activeID=='1')
                                                <a class="dropdown-item"
                                                    href="{{ route('setInactive_Book', ['bookID' => $book->bookID]) }}"><i
                                                        class="bx bx-toggle-right link-primary me-1"></i> Set
                                                    as Inactive</a>
                                                @else
                                                <a class="dropdown-item"
                                                    href="{{ route('setActive_Book', ['bookID' => $book->bookID]) }}"><i
                                                        class="bx bx-toggle-left link-warning me-1"></i> Set
                                                    as Active</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                {{-- EDIT MODAL --}}
                                <div class="modal fade" id="editModal{{ $book->bookID }}" tabindex="-1"
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
                                                    action="{{ route('edit_book', ['bookIDD' => $book->bookID]) }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
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
                                                                    value="{{ $book->bookTitle }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php

                                                    $authorsAdd = DB::table('author_tbl')->get();
                                                    $authorsEdit = DB::table('author_tbl')->where('authorID', '=',
                                                    $book->authorID)->first();
                                                    $selectedCategory =
                                                    DB::table('tbl_bookcategory')->where('categoryID', '=',
                                                    $book->categoryID)->first();

                                                    @endphp
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="nameLarge" class="form-label">BOOK AUTHOR
                                                                <i><small>(First & Last name)
                                                                    </small></i><i style="color: red">*</i></label>
                                                            <input class="form-control" list="datalistOptions1"
                                                                name="author_first" id="exampleDataList"
                                                                placeholder="Author First Name"
                                                                value="{{ $authorsEdit->firstName }}" required>
                                                            <datalist id="datalistOptions1">
                                                                @foreach ($authorsAdd as $authorName)
                                                                <option value="{{ $authorName->firstName }}"></option>
                                                                @endforeach
                                                            </datalist>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <label for="nameLarge" class="form-label"
                                                                style="color: whitesmoke"><small>.
                                                                </small></label>
                                                            <input class="form-control" list="datalistOptions2"
                                                                name="author_last" id="exampleDataList"
                                                                placeholder="Author Last Name"
                                                                value="{{ $authorsEdit->lastName }}" required>
                                                            <datalist id="datalistOptions2">
                                                                @foreach ($authorsAdd as $authorName)
                                                                <option value="{{ $authorName->lastName }}"></option>
                                                                @endforeach
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
                                                                    value="{{ $book->bookISBN }}" required>
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
                                                                    <option value="{{ $book->categoryID}}" selected>{{
                                                                        $selectedCategory->categoryName }}</option>
                                                                    @foreach ($categories as $selectC)
                                                                    <option value="{{ $selectC->categoryID }}">{{
                                                                        $selectC->categoryName }}</option>
                                                                    @endforeach
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
                                                                    value="{{ $book->bookPublisher }}" required>
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
                                                                    value="{{ $book->bookPublicationYear }}" required>
                                                                <datalist id="datalistOptionsYear">
                                                                    @for ($i = 1901; $i <= 2115 ; $i++) <option
                                                                        value="{{ $i }}">
                                                                        </option>
                                                                        @endfor
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
                                                                    value="{{ $book->bookCopies }}" required>
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
                                                                    value="{{ $book->bookURL }}">
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
                                                                    name="book_summary">{{ $book->bookSummary }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <small class="text-muted"><i>Current image</i></small>
                                                        <div class="col-2 mb-3">
                                                            <img class="ms-1" height="100" width="auto"
                                                                src="{{asset('/images/books/' . $book->bookIMG)}}"
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
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/ Hoverable Table rows -->
            </div>
        </div>

        <div class="col-lg-3 ">
            <div class="accordion" id="accordionExample">
                {{-- <div class="divider">
                    <div class="divider-text fw-semibold">Shortcuts</div>
                </div> --}}

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
                                    @foreach ($categories as $category)
                                    <li><a class="btn btn-md" href="{{ route('category') }}">{{ $category->categoryName
                                            }}</a>
                                    </li>
                                    @endforeach

                                </ul>
                                <div class="row mb-3" style="padding-left: 6px">
                                    <div class="col-12">
                                        <button class="btn btn-info btn-md"
                                            onclick="window.location.href='{{ route('category') }}'"
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
                                        onclick="window.location.href='{{ route('setBooksActive') }}'">SET ALL AS
                                        ACTIVE</button>
                                </div>
                            </div>
                            <div class="row mb-3 mt-1" style="padding-left: 6px">
                                <div class="col-12">
                                    <button class="btn btn-warning btn-md" style="min-width: 280px" type="button"
                                        onclick="window.location.href='{{ route('setBooksInactive') }}'">SET ALL AS
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
                                        onclick="window.location.href='{{ route('category') }}'"
                                        style="min-width: 280px" type="button">
                                        <span class=""><i class="bx bxs-cog pe-2 mt-n1"></i>MANAGE CATEGORY</span>
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-3" style="padding-left: 6px">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-md"
                                        onclick="window.location.href='{{ route('dash2') }}'" style="min-width: 280px"
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
                    <form method="post" action="{{ route('registerOnManage') }}" enctype="multipart/form-data">
                        @csrf
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
                        @php

                        $authorsAdd = DB::table('author_tbl')->get();

                        @endphp
                        <div class="row">
                            <div class="col-6">
                                <label for="nameLarge" class="form-label">BOOK AUTHOR <i><small>(First & Last name)
                                        </small></i><i style="color: red">*</i></label>
                                <input class="form-control" list="datalistOptions1" name="author_first"
                                    id="exampleDataList" placeholder="Author First Name" required>
                                <datalist id="datalistOptions1">
                                    @foreach ($authorsAdd as $authorName)
                                    <option value="{{ $authorName->firstName }}"></option>
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="nameLarge" class="form-label" style="color: whitesmoke"><small>.
                                    </small></label>
                                <input class="form-control" list="datalistOptions2" name="author_last"
                                    id="exampleDataList" placeholder="Author Last Name" required>
                                <datalist id="datalistOptions2">
                                    @foreach ($authorsAdd as $authorName)
                                    <option value="{{ $authorName->lastName }}"></option>
                                    @endforeach
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
                                        list="datalistOptionsYear" class="form-control"
                                        placeholder="Enter Year Published" name="publication_year"
                                        aria-describedby="basic-book-year" required>
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

@endsection