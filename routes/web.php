<?php

use App\Http\Controllers\BlogController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',  [BlogController::class,  'index'])->name('home');
Route::get("/update-status/{id}/{status}" , [BlogController::class , 'updateStatus'])->name('update.status');
Route::post('/add-blog' ,[BlogController::class, 'store'])->name('add-blog');
// routes/web.php

Route::get('/edit-blog/{id}', [BlogController::class,  'edit'])->name('edit-blog');
Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');

