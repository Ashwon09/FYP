<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ConsoleController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Facade\FlareClient\Report;
use GuzzleHttp\Middleware;

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
//     return view('game');
// });

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/search',[HomeController::class,'search'])->name('search');
Route::get('/filter',[HomeController::class,'filter'])->name('filter');
Route::get('/sort-by-price1',[HomeController::class,'sortByPriceasc'])->name('sortByPriceasc');
Route::get('/sort-by-price2',[HomeController::class,'sortByPricedesc'])->name('sortByPricedesc');

Route::get('/sort-by-created1',[HomeController::class,'sortBycreatedasc'])->name('sortByCreatedasc');
Route::get('/sort-by-created2',[HomeController::class,'sortBycreateddesc'])->name('sortByCreateddesc');

Route::get('/banned',[HomeController::class,'bannedView'])->name('bannedView');






Route::get('/selectedgame/{id}',[HomeController::class,'viewGame'])->name('selectedGame');



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/getview', [HomeController::class, 'returnView'])->name('returnView');

Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::group(['middleware' => ['customer']], function () {

    Route::group(['as'=>'offer.', 'prefix'=>'offer'], function(){
        Route::get('offer-form/{id}',[OfferController::class,'cashOfferForm'])->name('Form');
        Route::get('offer-/{id}',[OfferController::class,'Offer'])->name('offer');

        Route::get('offer-received',[OfferController::class,'offerReceived'])->name('offerReceived');
        Route::get('offer-sent',[OfferController::class,'offerSent'])->name('offerSent');

        Route::get('offer-sent-accepted',[OfferController::class,'offerSentAccept'])->name('offerSentAccept');
        Route::get('offer-sent-rejected',[OfferController::class,'offerSentReject'])->name('offerSentReject');
        Route::get('offer-sent-pending',[OfferController::class,'offerSentPending'])->name('offerSentPending');


        Route::get('offer-accept/{id}',[OfferController::class,'acceptOffer'])->name('accept');
        Route::get('offer-reject/{id}',[OfferController::class,'rejectOffer'])->name('reject');

    });

    Route::group(['as' => 'user.', 'prefix' => 'user'], function () {

        Route::get('/details', [UserController::class, 'details'])->name('details');
        Route::put('/update', [UserController::class, 'updateDetails'])->name('update');
        Route::get('/password-change', [UserController::class, 'passwordChangeForm'])->name('passwordChangeForm');
        Route::put('/changePassword', [UserController::class, 'changePassword'])->name('changePassword');
        Route::post('/Report{id}', [ReportController::class, 'store'])->name('report');

        Route::get('/delete-user', [UserController::class, 'deleteView'])->name('deleteView');
        Route::put('/delete-user-confirm', [UserController::class, 'deleteUser'])->name('deleteUser');


        

        Route::group(['as' => 'game.', 'prefix' => 'game'], function () {
            Route::get('/index', [GameController::class, 'index'])->name('index');
            Route::get('/indexsold', [GameController::class, 'indexsold'])->name('indexsold');
            Route::get('/indexselling', [GameController::class, 'indexselling'])->name('indexselling');
            Route::get('/create', [GameController::class, 'create'])->name('create');
            Route::post('/store', [GameController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [GameController::class, 'edit'])->name('edit');
            Route::post('/update{id}', [GameController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [GameController::class, 'destroy'])->name('delete');
            Route::get('/sold{id}', [GameController::class, 'sold'])->name('sold');

        });
        });
    });

    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::get('/home', [AdminController::class, 'index'])->name('index');
        Route::get('/viewReports', [ReportController::class, 'index'])->name('reportIndex');
        Route::get('/viewReports-user', [ReportController::class, 'index_user'])->name('user_report');


        Route::get('/deleteReports/{id}', [ReportController::class, 'destroy'])->name('report_delete');
        Route::get('/delete/{id}', [AdminController::class, 'destroy'])->name('delete');

        Route::get('/view-ban-users', [AdminController::class, 'viewBannedUsers'])->name('viewBanUsers');

        Route::get('/ban-user/{id}', [AdminController::class, 'banUser'])->name('banUser');
        Route::get('/unban-user/{id}', [AdminController::class, 'unBanUser'])->name('unBanUser');





        Route::group(['as' => 'manufacturer.', 'prefix' => 'manufacturer'], function () {
            Route::get('/index', [ManufacturerController::class, 'index'])->name('index');
            Route::get('/create', [ManufacturerController::class, 'create'])->name('create');
            Route::post('/store', [ManufacturerController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ManufacturerController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [ManufacturerController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [ManufacturerController::class, 'destroy'])->name('delete');
        });

        Route::group(['as' => 'console.', 'prefix' => 'console'], function () {
            Route::get('/index', [ConsoleController::class, 'index'])->name('index');
            Route::get('/create', [ConsoleController::class, 'create'])->name('create');
            Route::post('/store', [ConsoleController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ConsoleController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [ConsoleController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [ConsoleController::class, 'destroy'])->name('delete');
        });

        Route::group(['as' => 'genre.', 'prefix' => 'genre'], function () {
            Route::get('/index', [GenreController::class, 'index'])->name('index');
            Route::get('/create', [GenreController::class, 'create'])->name('create');
            Route::post('/store', [GenreController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [GenreController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [GenreController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [GenreController::class, 'destroy'])->name('delete');
        });
    });
});
