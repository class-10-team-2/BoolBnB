<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('guest.index');
})->name('guest.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::namespace('User')
    ->name('user.')
    ->prefix('user')
    ->middleware('auth')
    ->group(function () {
        Route::resource('apartments', 'ApartmentController');
        Route::get('apartments/{apartment}/stats', 'ApartmentController@stats')->name('apartments.stats');
    });


// Route::post('/search', 'Guest\SearchController@index')->name('guest.search');
// Route::get('/search', 'Guest\SearchController@index')->name('guest.search'); // ???

// Braintree
Route::get('/payment/make', 'PaymentsController@make')->name('payment.make');
Route::namespace('User')
    ->prefix('user')
    ->middleware('auth')
    ->group(function () {
        Route::post('store_sponsoship', 'ApartmentController@store_sponsorship')->name('user.apartments.store_sponsoship');
        // Route::get('store_sponsoship', 'ApartmentController@view_sponsorship');
    });

Route::post('guest/apartment/search', 'Guest\SearchController@search')->name('guest.apartment.search');

// Algolia
Route::get('search', function () {
    $query = 'hill'; // <-- Change the query for testing.

    $apartments = App\Apartment::search($query)
        ->where('baths', '>', 3)
        ->get();

    return $apartments;
});
