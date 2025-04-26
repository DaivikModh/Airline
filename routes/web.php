<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\User;
use App\Models\Airline;
use App\Models\Flights;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/cart',function () {
    return view('cart');
});

Route::get('/admin',function () {
    $airlines = Airline::select('airline_id', 'airline_name')->distinct()->get();
    $flights = DB::table('flights')
        ->join('airlines', 'flights.airline_id', '=', 'airlines.airline_id')
        ->select('flights.*', 'airlines.airline_name')
        ->get();
    return view('admin', compact('airlines','flights'));
});

    Route::get('/search',function () {
    $from = Flights::pluck('departure_airport')->unique(); // Optional: remove duplicates
    $to = Flights::pluck('arrival_airport')->unique(); // Optional: remove duplicates
    return view('search', compact('from','to'));
});

Route::get('/login', function(){
    return view('login');
});

Route::get('/register', function(){
    return view('register');
});

Route::get('/add_shop',function() {
    return view('add_medicine');
});

Route::get('/booking',function() {
    return view('book_flight');
});


Route::post('/login_user',[User:: class, 'login_user']);
Route::get('/logout',[User:: class, 'logout']);
Route::post('/submitdata',[User:: class, 'submitdata']);
Route::post('/checkemail',[User:: class, 'checkemail'])->name('checkemail');

Route::post('/add_flight',[User:: class, 'add_flight']);
Route::post('/delete_flight',[User:: class, 'delete_flight']);
Route::post('/search_flight',[User:: class, 'search_flight'])->name('search_flights');
Route::get('/book_flight/{flight_id}',[User:: class, 'book_flight'])->name('booking');

Route::get('/shop',[User:: class, 'shop']);
Route::post('/add_medicine',[User:: class, 'add_medicine']);
Route::get('/cart',[User:: class, 'show_cart'])->name('show_cart');
Route::get('/addcart/{id}',[User::class,'addcart'])->name('addcart');
Route::get('/removecart/{id}',[User::class,'removecart'])->name('removecart');
Route::get('/addqty/{cart_id}', [User::class, 'addqty'])->name('addqty');
Route::get('/remqty/{cart_id}', [User::class, 'remqty'])->name('remqty');