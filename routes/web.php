<?php


use Illuminate\Support\Facades\Route;
use App\Models\Client;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DocumentController;


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


Route::middleware([AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        $totalClients = Client::count();

        $recentClients = Client::orderBy('created_at', 'desc')->take(5)->get(); // 5 clients récents

        return view('admin.dashboardAdmin', compact('totalClients', 'recentClients'));
    })->name('dashboard');

    // Clients
    Route::get('/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

    Route::get('/clients/{client}/upload', [ClientController::class, 'showUploadForm'])
    ->name('clients.upload.form');

Route::post('/clients/{id}/upload', [ClientController::class, 'upload'])
    ->name('clients.upload');
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

Route::get('/php-info', function () {
    phpinfo();
});