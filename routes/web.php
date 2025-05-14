<?php


use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\ClientController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ======== ADMIN LOGIN ROUTES ========
Route::middleware('web')->group(function () {
    Route::get('/admin/login', function () {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    })->name('admin.login');

    Route::post('/admin/login', [AdminAuthController::class, 'login']);
});
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', function () {
        $clientsCount = \App\Models\Client::count();

        return view('admin.dashboardAdmin', compact('clientsCount'));
    })->name('admin.dashboard');

    Route::get('/admin/clients', [ClientController::class, 'index'])->name('admin.clients'); // List all clients
    Route::get('/admin/clients/create', [ClientController::class, 'create'])->name('admin.clients.create'); // Show create form
    Route::post('/admin/clients', [ClientController::class, 'store'])->name('admin.clients.store'); // Store new client
    Route::get('/admin/clients/{id}/edit', [ClientController::class, 'edit'])->name('admin.clients.edit'); // Show edit form
    Route::put('/admin/clients/{id}', [ClientController::class, 'update'])->name('admin.clients.update'); // Update client
    Route::delete('/admin/clients/{id}', [ClientController::class, 'destroy'])->name('admin.clients.destroy'); //
    Route::resource('clients', ClientController::class);

 
    Route::get('/admin/dashboard', [ClientController::class, 'dashboard'])->name('admin.dashboard'); // Dashboard route    
});

// ======== CLIENT LOGIN ROUTES ========
Route::get('/client/login', function () {
    return view('admin.clients.login');  // You may have a view like this for client login
})->name('client.login');

Route::post('/client/login', [ClientAuthController::class, 'login']);
Route::post('/client/logout', [ClientAuthController::class, 'logout'])->name('client.logout');

// ======== PROTECTED CLIENT ROUTES ========
Route::middleware(['auth:client'])->group(function () {
    Route::get('/client/dashboard', function () {
        return view('admin.clients.dashboard');  // You may have a view like this for client dashboard
    })->name('client.dashboard');
});