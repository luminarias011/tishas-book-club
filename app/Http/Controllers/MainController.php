<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function dash2(Request $request)
    {
        $searching = $request['search'] ?? "";

        if ($searching != "") {
            $bookSearch = DB::table('tbl_book')->where('is_activeID', '=', '1')
                ->where('bookTitle', 'Like', '%' . $request->search . '%')
                // ->orWhere('bookAuthor', 'Like', '%' . $request->search . '%')
                ->orWhere('bookPublicationYear', 'Like', '%' . $request->search . '%')
                // ->orWhere('bookPublisher', 'Like', '%' . $request->search . '%')
                // ->orWhere('isActive', '=', $request->search)
                ->orderBy('bookTitle', 'asc')
                ->get();
            if ($bookSearch->count() == 0) {
                $noDisplayMessage = "NO BOOKS FOUND!";
                $subMessage = "It could be deleted, deactivated or not registered";
                $books = $bookSearch;
            } else {
                $noDisplayMessage = "";
                $subMessage = "";
                $books = $bookSearch;
            }
        } else {
            $subMessage = "";
            $noDisplayMessage = "";
            $noDisplay = "";
            $books = DB::table('tbl_book')
                ->where('is_activeID', '=', '1')
                ->Where('isDeleted', '=', '0')
                ->orderBy('bookTitle', 'asc')
                ->get();
        }

        $alll = DB::table('tbl_book')->where('isDeleted', '=', '0')
            ->get();
        $allcount = $alll->count();

        $categories = DB::table('tbl_bookcategory')->get();
        $categoryCount = $categories->count();

        return view('content.dashboard.dash2', compact('books', 'allcount', 'categories', 'categoryCount', 'noDisplayMessage', 'subMessage'));
    }

    public function homepagee()
    {
        $alll = DB::table('tbl_book')->where('isDeleted', '=', '0')
            ->get();
        $allcount = $alll->count();

        $recents = DB::table('tbl_book')
            ->where('is_activeID', '=', '1')
            ->Where('isDeleted', '=', '0')
            ->orderBy('bookID', 'desc')
            ->take(4)
            ->get();

        session()->flush();
        return view('content.homepage.index', compact('allcount', 'recents'));
    }

    public function manageBooks()
    {
        $books = DB::table('tbl_book')
            ->where('isDeleted', '=', '0')
            ->get();

        $categories = DB::table('tbl_bookcategory')->get();

        return view('content.dashboard.manageBooks', compact('books', 'categories'));
    }

    public function bookCategory()
    {
        $categories = DB::table('tbl_bookcategory')->get();

        return view('content.dashboard.category', compact('categories'));
    }

    // public function compose()
    // {
    //     return view('compose');
    // }
    // public function replies()
    // {
    //     return view('replies');
    // }


    // public function main()
    // {
    //     if (session('usr_id')) {
    //         return view('main');
    //     } else {
    //         return view('login');
    //     }
    // }
}
