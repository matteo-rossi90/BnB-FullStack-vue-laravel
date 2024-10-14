<?php

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

// nel path della root in assenza di caratteri dopo / o caratteri sbagliati, la route reindirizza alla pagina app di vue
Route::get('/', function () {
    return view('welcome');
});
// Route::get('/{any}', function () {
//     return view('welcome');
// })->where('any', '.*');
