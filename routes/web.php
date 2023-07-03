<?php

use Illuminate\Support\Facades\Route;



$controller_path = 'App\Http\Controllers';

Route::get('/', $controller_path . '\MainController@homepagee')->name('index');
Route::get('dash2', $controller_path . '\MainController@dash2')->name('dash2');
Route::get('manage', $controller_path . '\MainController@manageBooks')->name('manage');
Route::get('category', $controller_path . '\MainController@bookCategory')->name('category');

// ADD BOOKS ROUTES
Route::post('registerOnDash', $controller_path . '\UserController@registerBookDash2')->name('registerOnDash');
Route::post('registerOnManage', $controller_path . '\UserController@registerBookManage')->name('registerOnManage');

// SET ALL ACTIVE / INACTIVE BOOKS
Route::get('setBooksActive', $controller_path . '\UserController@setAllBooksActive')->name('setBooksActive');
Route::get('setBooksInactive', $controller_path . '\UserController@setAllBooksInactive')->name('setBooksInactive');

// SET ALL ACTIVE / INACTIVE CATEGORIES
Route::get('setCategoryActive', $controller_path . '\UserController@setAllCategoryActive')->name('setCategoryActive');
Route::get('setCategoryInactive', $controller_path . '\UserController@setAllCategoryInactive')->name('setCategoryInactive');
//
// SET INDIVIDUAL ACTIVE/INACTIVE BOOKS
Route::get('setActive_Book/{bookID}', $controller_path . '\UserController@setActive_Book')->name('setActive_Book');
Route::get('setInactive_Book/{bookID}', $controller_path . '\UserController@setInactive_Book')->name('setInactive_Book');

// SET INDIVIDUAL ACTIVE/INACTIVE CATEGORY
Route::get('setActive_Cat/{categoryID}', $controller_path . '\UserController@setActive_Category')->name('setActive_Cat');
Route::get('setInactive_Cat/{categoryID}', $controller_path . '\UserController@setInactive_Category')->name('setInactive_Cat');

// DELETE BOOK
Route::get('delete_book/{bookID}', $controller_path . '\UserController@delete_book')->name('delete_book');

// EDIT BOOK
Route::post('edit_book/{bookIDD}', $controller_path . '\UserController@edit_book')->name('edit_book');