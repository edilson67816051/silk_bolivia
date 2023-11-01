<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\AdminIndex;
use App\Livewire\Admin\Producto;
use App\Livewire\Inventario\Create;
use App\Livewire\Inventario\InventarioIndex;
use Illuminate\Support\Facades\Route;

use App\Livewire\Admin\Catalago;

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

Route::get('/prueba', [InventarioIndex::class, 'insert']);

//Route::get('/prueba',AdminIndex::class);

Route::get('/dashboard', AdminIndex::class)
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/producto', Producto::class)
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/inventario', InventarioIndex::class)
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/catalago', Catalago::class)
    ->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';