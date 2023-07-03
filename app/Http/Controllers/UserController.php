<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


function generateuuid()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';

    for ($i = 0; $i < 32; $i++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $string;
}

class UserController extends Controller
{
    //DASHBOARD Page Add Book
    public function registerBookDash2(Request $request)
    {
        $bookTitle = $request->book_title;
        $firstName = $request->author_first;
        $lastName = $request->author_last;
        $bookISBN = $request->book_isbn;
        $categoryID = $request->book_category;
        $bookPublisher = $request->book_publisher;
        $bookPublicationYear = $request->publication_year;
        $bookCopies = $request->book_copies;
        if ($request->book_url == "") {
            $bookURL = "#";
        } else {
            $bookURL = $request->book_url;
        }
        if ($request->book_summary == "") {
            $bookSummary = "No book summary added!";
        } else {
            $bookSummary = $request->book_summary;
        }
        $book_image = $request->file('book_image');

        if ($book_image == "") {
            $uuid = '11111aaaaa5555511111qqqqq9999900';
            $bookIMG = $uuid . '.png';
        } else {
            $uuid = generateuuid();
            $bookIMG = $uuid . '.' . $book_image->getClientOriginalExtension();
            // Store image file on server 
            Storage::disk('public-storage')->put('/images/books/' . $bookIMG, fopen($request->file('book_image'), 'r+'));
        }

        $checkAuthor = DB::table('author_tbl')->where('firstName', '=', $firstName)->where('lastName', '=', $lastName)->get();
        $authorCount = $checkAuthor->count();

        if ($authorCount > 0) {
            $checkAuthor1 = DB::table('author_tbl')->where('firstName', '=', $firstName)->where('lastName', '=', $lastName)->first();
            $authorID = $checkAuthor1->authorID;
        } else {
            DB::table('author_tbl')->insert([
                'firstName' => $firstName,
                'lastName' => $lastName,
            ]);
            $checkAuthor2 = DB::table('author_tbl')->where('firstName', '=', $firstName)->where('lastName', '=', $lastName)->first();
            $authorID = $checkAuthor2->authorID;
        }

        DB::table('tbl_book')
            ->insert([
                'bookTitle' => $bookTitle,
                'authorID' => $authorID,
                'bookISBN' => $bookISBN,
                'categoryID' => $categoryID,
                'bookPublisher' => $bookPublisher,
                'bookPublicationYear' => $bookPublicationYear,
                'bookCopies' => $bookCopies,
                'bookURL' => $bookURL,
                'bookSummary' => $bookSummary,
                'bookIMG' => $bookIMG
            ]);

        session()->flash('success', 'Yay! Book Successfully Registered.');
        return redirect()->route('dash2');
    }

    //MANAGE Page Add Book
    public function registerBookManage(Request $request)
    {
        $bookTitle = $request->book_title;
        $firstName = $request->author_first;
        $lastName = $request->author_last;
        $bookISBN = $request->book_isbn;
        $categoryID = $request->book_category;
        $bookPublisher = $request->book_publisher;
        $bookPublicationYear = $request->publication_year;
        $bookCopies = $request->book_copies;
        if ($request->book_url == "") {
            $bookURL = "#";
        } else {
            $bookURL = $request->book_url;
        }
        if ($request->book_summary == "") {
            $bookSummary = "No book summary added!";
        } else {
            $bookSummary = $request->book_summary;
        }
        $book_image = $request->file('book_image');

        if ($book_image == "") {
            $uuid = '11111aaaaa5555511111qqqqq9999900';
            $bookIMG = $uuid . '.png';
        } else {
            $uuid = generateuuid();
            $bookIMG = $uuid . '.' . $book_image->getClientOriginalExtension();
            // Store image file on server 
            Storage::disk('public-storage')->put('/images/books/' . $bookIMG, fopen($request->file('book_image'), 'r+'));
        }

        $checkAuthor = DB::table('author_tbl')->where('firstName', '=', $firstName)->where('lastName', '=', $lastName)->get();
        $authorCount = $checkAuthor->count();

        if ($authorCount > 0) {
            $checkAuthor1 = DB::table('author_tbl')->where('firstName', '=', $firstName)->where('lastName', '=', $lastName)->first();
            $authorID = $checkAuthor1->authorID;
        } else {
            DB::table('author_tbl')->insert([
                'firstName' => $firstName,
                'lastName' => $lastName,
            ]);
            $checkAuthor2 = DB::table('author_tbl')->where('firstName', '=', $firstName)->where('lastName', '=', $lastName)->first();
            $authorID = $checkAuthor2->authorID;
        }

        DB::table('tbl_book')
            ->insert([
                'bookTitle' => $bookTitle,
                'authorID' => $authorID,
                'bookISBN' => $bookISBN,
                'categoryID' => $categoryID,
                'bookPublisher' => $bookPublisher,
                'bookPublicationYear' => $bookPublicationYear,
                'bookCopies' => $bookCopies,
                'bookURL' => $bookURL,
                'bookSummary' => $bookSummary,
                'bookIMG' => $bookIMG
            ]);

        session()->flash('success', 'Yay! Book Successfully Registered.');
        return redirect()->route('manage');
    }

    public function edit_book(Request $request, $bookIDD)
    {
        $bookTitle = $request->book_title;
        $firstName = $request->author_first;
        $lastName = $request->author_last;
        $bookISBN = $request->book_isbn;
        $categoryID = $request->book_category;
        $bookPublisher = $request->book_publisher;
        $bookPublicationYear = $request->publication_year;
        $bookCopies = $request->book_copies;
        if ($request->book_url == "") {
            $bookURL = "#";
        } else {
            $bookURL = $request->book_url;
        }
        if ($request->book_summary == "") {
            $bookSummary = "No book summary added!";
        } else {
            $bookSummary = $request->book_summary;
        }
        $book_image = $request->file('book_image');

        if ($book_image == "") {
            $bookgetIMG = DB::table('tbl_book')->where('bookID', '=', $bookIDD)->first();
            $bookIMG = $bookgetIMG->bookIMG;
        } else {
            $uuid = generateuuid();
            $bookIMG = $uuid . '.' . $book_image->getClientOriginalExtension();
            // Store image file on server 
            Storage::disk('public-storage')->put('/images/books/' . $bookIMG, fopen($request->file('book_image'), 'r+'));
        }

        $checkAuthor = DB::table('author_tbl')->where('firstName', '=', $firstName)->where('lastName', '=', $lastName)->get();
        $authorCount = $checkAuthor->count();

        if ($authorCount > 0) {
            $checkAuthor1 = DB::table('author_tbl')->where('firstName', '=', $firstName)->where('lastName', '=', $lastName)->first();
            $authorID = $checkAuthor1->authorID;
        } else {
            DB::table('author_tbl')->insert([
                'firstName' => $firstName,
                'lastName' => $lastName,
            ]);
            $checkAuthor2 = DB::table('author_tbl')->where('firstName', '=', $firstName)->where('lastName', '=', $lastName)->first();
            $authorID = $checkAuthor2->authorID;
        }

        DB::table('tbl_book')->where('bookID', '=', $bookIDD)
            ->update([
                'bookTitle' => $bookTitle,
                'authorID' => $authorID,
                'bookISBN' => $bookISBN,
                'categoryID' => $categoryID,
                'bookPublisher' => $bookPublisher,
                'bookPublicationYear' => $bookPublicationYear,
                'bookCopies' => $bookCopies,
                'bookURL' => $bookURL,
                'bookSummary' => $bookSummary,
                'bookIMG' => $bookIMG
            ]);

        session()->flash('success', 'Nice! Update Successfull.');
        return redirect()->route('manage');
    }

    public function setAllBooksActive()
    {
        DB::table('tbl_book')
            ->update([
                'is_activeID' => '1'
            ]);

        session()->flash('success', 'All Status Successfully Updated');
        return redirect()->route('manage');
    }

    public function setAllBooksInactive()
    {
        DB::table('tbl_book')
            ->update([
                'is_activeID' => '0'
            ]);

        session()->flash('warning', 'Warning! All Status Deactivated');
        return redirect()->route('manage');
    }

    public function setAllCategoryActive()
    {
        DB::table('tbl_bookcategory')
            ->update([
                'is_activeID' => '1'
            ]);

        session()->flash('success', 'All Status Successfully Updated');
        return redirect()->route('category');
    }

    public function setAllCategoryInactive()
    {
        DB::table('tbl_bookcategory')
            ->update([
                'is_activeID' => '0'
            ]);

        session()->flash('warning', 'Warning! All Status Deactivated');
        return redirect()->route('category');
    }

    public function setActive_Book($bookID)
    {
        DB::table('tbl_book')->where('bookID', '=', $bookID)
            ->update([
                'is_activeID' => '1'
            ]);

        session()->flash('success', 'Status Updated.');
        return redirect()->route('manage');
    }
    public function setInactive_Book($bookID)
    {
        DB::table('tbl_book')->where('bookID', '=', $bookID)
            ->update([
                'is_activeID' => '0'
            ]);

        session()->flash('success', 'Status Updated.');
        return redirect()->route('manage');
    }
    public function setActive_Category($categoryID)
    {
        DB::table('tbl_bookcategory')->where('categoryID', '=', $categoryID)
            ->update([
                'is_activeID' => '1'
            ]);

        DB::table('tbl_book')->where('categoryID', '=', $categoryID)
            ->update([
                'is_activeID' => '1'
            ]);

        session()->flash('success', 'Status Updated.');
        return redirect()->route('category');
    }
    public function setInactive_Category($categoryID)
    {
        DB::table('tbl_bookcategory')->where('categoryID', '=', $categoryID)
            ->update([
                'is_activeID' => '0'
            ]);
        DB::table('tbl_book')->where('categoryID', '=', $categoryID)
            ->update([
                'is_activeID' => '0'
            ]);

        session()->flash('success', 'Status Updated.');
        return redirect()->route('category');
    }
    public function delete_book($bookID)
    {
        DB::table('tbl_book')->where('bookID', '=', $bookID)
            ->update([
                'isDeleted' => '1'
            ]);

        session()->flash('success', 'Done! Book Deleted.');
        return redirect()->route('manage');
    }

    // public function search(Request $request)
    // {
    //     $result = "";
    //     $searched = DB::table('tbl_book')->where('bookTitle', 'Like', '%' . $request->search . '%')
    //         ->orWhere("DB::table('tbl_bookcategory')->where('categoryID', '=', '2')->first()", 'Like', '%' . $request->search . '%')->get();

    //     foreach ($searched as $Ss) {
    //         $result .=
    //             '';
    //     }
    //     return response($result);
    // }
}
