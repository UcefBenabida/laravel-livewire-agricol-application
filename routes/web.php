<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartController;
use Illuminate\Support\Facades\Gate;

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
    return view('index');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/users', function () {
    if (Gate::allows('isAdmin') || Gate::allows('isEditor')) 
    {
        return view('users');
    } 
    else 
    {
        return view('dashboard');
    }
    
})->name('users')->middleware(['auth']);


Route::get('/parcelles', function () {
    return view('parcelle');
})->middleware(['auth'])->name('parcelles');

Route::get('/interventions', function () {
    return view('intervention');
})->middleware(['auth'])->name('interventions');

Route::get('/agriculteurs', function () {
    return view('agriculteur');
})->middleware(['auth'])->name('agriculteurs');

Route::get('/employes', function () {
    return view('employe');
})->middleware(['auth'])->name('employes');

Route::get('/tarifs', function () {
    return view('tarif');
})->middleware(['auth'])->name('tarifs');

require __DIR__.'/auth.php';
