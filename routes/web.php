<?php


use Illuminate\Support\Facades\Route;
use App\Models\Client;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ClientDashboardController;
use App\Http\Middleware\RedirectIfNotClient;
use App\Http\Middleware\RedirectIfClientAuthenticated;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactMessageController;







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
// ======== ADMIN DASHBOARD ROUTES ========

Route::middleware([AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::delete('/clients/{client}/documents/delete', [ClientController::class, 'deleteDocuments'])
        ->name('clients.deleteDocuments');

        // Route pour afficher les PDFs d’un client spécifique
Route::get('/clients/{id}/pdfs', [ClientController::class, 'showClientPdfs'])->name('clients.showPdfs');
Route::get('/clients/{id}/pdfs', [ClientController::class, 'showClientPdfsByYear'])
->name('clients.showPdfsByYear');
Route::get('/contact-messages', [ContactMessageController::class, 'listMessages'])->name('contact_messages.index');
        Route::delete('/contact-messages/delete', [ContactMessageController::class, 'deleteSelected'])->name('contact_messages.delete');
        Route::get('/contact-messages/{id}', [ContactMessageController::class, 'markAsRead'])->name('contact_messages.read');




        
        


    // Dashboard
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');

    // Clients
    Route::get('/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

    // Documents
  Route::get('/clients/{client}/upload', [ClientController::class, 'showUploadForm'])
    ->name('clients.upload.form');
    
Route::post('/clients/{id}/upload', [ClientController::class, 'upload'])
    ->name('clients.upload');
    
});
// ======== CLIENT LOGIN ROUTES ========


Route::middleware([RedirectIfClientAuthenticated::class])->name('client.')->group(function () {
    Route::get('/', [ClientAuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/', [ClientAuthController::class, 'login'])->name('login');

});



// ======== CLIENT DASHBOARD ROUTES ========

Route::middleware([RedirectIfNotClient::class])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
    Route::post('/client/documents/download-zip', [ClientDashboardController::class, 'downloadSelectedZip'])
    ->name('documents.downloadZip');
     Route::get('/infos', [ClientController::class, 'showMyInfo'])->name('infos');
    Route::get('/contact', [ContactController::class, 'show'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


    Route::get('/pdfs', [ClientDashboardController::class, 'showPdfs'])->name('pdfs');
    Route::post('/logout', [ClientAuthController::class, 'logout'])->name('logout');
    


});


Route::get('/test-middleware', function () {
    $middleware = app(\App\Http\Middleware\AuthenticateClient::class);
    return 'Middleware instancié avec succès : ' . get_class($middleware);
});

Route::middleware(['auth:client', 'updateLastSeen'])->prefix('client')->name('client.')->group(function () {
    // tes routes client ici
});

