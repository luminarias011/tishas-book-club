@extends('layouts/zCustomNavbar/manageNavbarLayout')

@section('title', 'Categories ')

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
        <h5 class="mt-1">Manage Categories</h5>
        <div class="col-lg-9 overflow-hidden" style="height: 540px;" id="vertical-example">
            <div class="">
                {{-- @foreach ($books as $book) --}}

                {{-- @endforeach --}}
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
                                @foreach ($categories as $cat)
                                @php

                                $isActive = DB::table('isActive_tbl')->where('is_activeID', '=',
                                $cat->is_activeID)->first();

                                @endphp
                                <tr class="@if ($isActive->status=='Active')
                                @else
                                    table-warning
                                @endif">
                                    <th scope="row">{{ $cat->categoryID }}</th>
                                    <td>{{ $cat->categoryName }}</td>
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
                                                {{-- <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="bx bx-edit-alt me-1 link-info"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="bx bx-trash me-1 link-danger"></i> Delete</a> --}}
                                                @if ($cat->is_activeID=='1')
                                                <a class="dropdown-item"
                                                    href="{{ route('setInactive_Cat', ['categoryID' => $cat->categoryID]) }}"><i
                                                        class="bx bx-toggle-right link-primary me-1"></i> Set
                                                    as Inactive</a>
                                                @else
                                                <a class="dropdown-item"
                                                    href="{{ route('setActive_Cat', ['categoryID' => $cat->categoryID]) }}"><i
                                                        class="bx bx-toggle-left link-warning me-1"></i> Set
                                                    as Active</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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
                            <span class=""><i class="bx bxs-cog pe-2 mt-n1 link-danger"></i>OPTIONS</span>
                        </button>
                    </h2>

                    <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row mb-3 mt-1" style="padding-left: 6px">
                                <div class="col-12">
                                    <button class="btn btn-success btn-md" style="min-width: 280px" type="button"
                                        onclick="window.location.href='{{ route('setCategoryActive') }}'">SET ALL AS
                                        ACTIVE</button>
                                </div>
                            </div>
                            <div class="row mb-3 mt-1" style="padding-left: 6px">
                                <div class="col-12">
                                    <button class="btn btn-warning btn-md" style="min-width: 280px" type="button"
                                        onclick="window.location.href='{{ route('setCategoryInactive') }}'">SET ALL AS
                                        INACTIVE</button>
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
    {{-- <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel3">REGISTER BOOK</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="defaultFormControlHelp" class="form-text mb-2"><i>Required fields with</i> <i
                            style="color: red">*</i>.
                    </div>
                    <form method="post" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">BOOK TITLE <i style="color: red">*</i></label>
                                <input type="text" id="nameLarge" class="form-control" placeholder="Enter Title"
                                    name="book_title" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">AUTHOR <i style="color: red">*</i></label>
                                <input type="text" id="nameLarge" class="form-control" placeholder="Book Author"
                                    name="book_author" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">BOOK ISBN <i><small>(International standard
                                            book number) </small></i><i style="color: red">*</i></label>
                                <input type="text" id="nameLarge" class="form-control" placeholder="Enter ISBN"
                                    name="book_isbn" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">CATEGORY <i style="color: red">*</i></label>
                                <select class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example" name="book_category" required>
                                    <option selected>Select category</option>
                                    @foreach ($categories as $selectC)
                                    <option value="{{ $selectC->categoryID }}">{{ $selectC->categoryName }}</option>
                                    @endforeach
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
                                <label for="nameLarge" class="form-label">PUBLICATION YEAR <i
                                        style="color: red">*</i></label>
                                <input type="text" id="nameLarge" class="form-control"
                                    placeholder="Enter Year Published" name="publication_year" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">BOOK COPIES <i
                                        style="color: red">*</i></label>
                                <input type="text" id="nameLarge" class="form-control" placeholder="Enter Book Copies"
                                    name="book_copies" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">PREVIEW URL</label>
                                <input type="text" id="nameLarge" class="form-control"
                                    placeholder="Enter Book Preview url" name="book_url">
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
    </div> --}}

</div>

@endsection