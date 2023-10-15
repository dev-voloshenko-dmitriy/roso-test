<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::controller(EventController::class)->prefix('event')->group(function () {

    Route::get('/{title}/{place}/{date}', 'save')->where(
        [
            'title' => '[A-Za-z]+',
            'place' => '[A-Za-z]+',
            'date'  => '[0-9]{2}-[0-9]{2}-[0-9]{4}'
        ]
    );


    Route::get('/{id}/', 'show')->where(['id' => '[A-Za-z]+-[A-Za-z]+-[0-9]{2}-[0-9]{2}-[0-9]{4}']);
});
