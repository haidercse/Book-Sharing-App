<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

//frontend route start here.
use App\Http\Controllers\frontend\pages\PagesController;
use App\Http\Controllers\frontend\pages\book\FrontendBookController;
use App\Http\Controllers\frontend\pages\user\UserController;
use App\Http\Controllers\frontend\pages\user\DashboardController;
use App\Http\Controllers\frontend\pages\book\order\OrderController;


//Admin route start here.
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\authors\AuthorController;
use App\Http\Controllers\admin\books\BookController;
use App\Http\Controllers\admin\categories\CategoryController;
use App\Http\Controllers\admin\publishers\PublisherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//     return view('welcome');
// });



/**
 * Backend or Admin Routes here
 * like book, category routes etc ..
 */

//Admin All routes start from here .
Route::group(['prefix'=>'admin'], function(){
    Route::get('/dashboard',[AdminController::class,'index']);

    //author route
    Route::resource('author',AuthorController::class);

    //books route
    Route::resource('book-sharing',BookController::class);

    Route::get('unapproved',[BookController::class,'unapprovedList'])->name('admin.unapproved.book');
    Route::post('approve/{id}',[BookController::class,'approve'])->name('admin.approve.book');

    Route::get('approved',[BookController::class,'approvedList'])->name('admin.approved.book');
   Route::post('unapproved/{id}',[BookController::class,'unapproved'])->name('admin.unApprove.book');

    //Category route
    Route::resource('category', CategoryController::class);

    //Publisher route
    Route::resource('publisher', PublisherController::class);
});

/**
 * Frontend Routes here
 * like book, category routes etc ..
 */

//All frontend routes start here

Route::get('/', [PagesController::class,'index'])->name('frontend.index');

//recent upload books
Route::get('/',[FrontendBookController::class,'recent_upload_book'])->name('recent.upload.book');


Route::group(['prefix' => 'users'], function(){

     //frontend Books route
     Route::resource('books',FrontendBookController::class);
     Route::get('/search/books',[FrontendBookController::class,'search'])->name('user.book.search');
     Route::post('/search/books/advanced',[FrontendBookController::class,'AdvancedSearch'])->name('book.searched.advanced');

      //User route
     Route::resource('user',UserController::class);

   //dashboard start
    Route::group(['prefix' => 'dashboard'], function(){
        //Dashboard route
        Route::get('user-dashboard',[DashboardController::class,'index'])->name('user.dashboard');
        Route::get('user_upload_book',[DashboardController::class,'books'])->name('user.upload.book.list');
        Route::get('user_send_request/{slug}',[DashboardController::class,'showRequestBook'])->name('user.book.show.request.page');

        Route::get('books/request-list/',[DashboardController::class,'bookRequestList'])->name('user.book.request.list');
        Route::get('books/edit/{slug}',[DashboardController::class,'bookEdit'])->name('user.book.edit');
        Route::post('books/update/{slug}',[DashboardController::class,'bookUpdate'])->name('user.book.update');
        Route::post('books/delete/{slug}',[DashboardController::class,'bookDelete'])->name('user.book.delete');
        Route::post('books/request/{slug}',[DashboardController::class,'bookRequest'])->name('user.book.request');
        Route::post('books/request/approved/{id}',[DashboardController::class,'bookRequestApproved'])->name('user.book.request.approved');
        Route::post('books/request/reject/{id}',[DashboardController::class,'bookRequestReject'])->name('user.book.request.reject');

        Route::post('books/update/request/{id}',[DashboardController::class,'bookUpdateRequest'])->name('user.book.update.request');
        Route::post('books/request/delete/{id}',[DashboardController::class,'bookDeleteRequest'])->name('user.book.delete.request');

        //order routes start here.
        Route::get('book/order-list/',[OrderController::class,'index'])->name('books.order.list');
        Route::post('book/order/approved/{id}',[OrderController::class,'orderApproved'])->name('order.book.approved');
        Route::post('book/order/reject/{id}',[OrderController::class,'orderReject'])->name('order.book.reject');

        //Return feature
        Route::post('book/order/return/store/{id}',[OrderController::class,'orderReturnStore'])->name('book.return.store');
        Route::post('book/order/return/confirm/{id}',[OrderController::class,'orderReturnConfirm'])->name('book.return.confirm');

    });


});



/**
 * This is Auth Route ..
 */
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

