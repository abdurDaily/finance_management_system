<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\Role\RolePermissionController;

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
    return view('index');
})->name('index');

Route::prefix('/dashboard')->middleware(['admin'])->name('dashboard.')->group(function(){
    Route::get('/',[HomeController::class, 'index'])->name('home');
    Route::get('/logout',[HomeController::class, 'logout'])->name('logout');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//**ROLE AND PERMISSION */
Route::middleware('auth')->name('role.')->prefix('role-permission')->group(function () {
    Route::get('/index', [RolePermissionController::class, 'index'])->name('index');
    Route::post('/index', [RolePermissionController::class, 'storeRole'])->name('store');
    Route::post('/permission', [RolePermissionController::class, 'storePermission'])->name('store.permission');
    Route::get('/delete-role/{id}', [RolePermissionController::class, 'deleteRole'])->name('delete');
    Route::get('/delete-role/{id}', [RolePermissionController::class, 'deleteRole'])->name('delete');
});

require __DIR__.'/auth.php';
