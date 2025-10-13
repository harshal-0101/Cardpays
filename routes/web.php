<?php

use Illuminate\Support\Facades\Route;   
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\DashboadController;
use App\Http\Controllers\CallerController;


Route::get('/home', function () {
    return view('welcome');
});

// Route::get('/', function () {
//     return view('Lead');
// });

Route::get('/login', function () {
    return view('AdminLogin');
});

// Route::get('/admin', function () {
//     return view('crmadmin');
// })->name('admin.admin');

Route::get('/lead-detail', function () {
    return view('Leaddetails');
})->name('lead-detail.details');

Route::get('/manager', function () {
    return view('crmmanage');
})->name('manager.manager');

Route::get('/register', function () {
    return view('register');
})->middleware('guest')->name('register');

Route::post('/loginU', [UserController::class, 'Login'])
    ->middleware('guest')
    ->name('loginU');


Route::post('/user/store', [UserController::class, 'store'])->name('user.store');

// routes/web.php

Route::get('/leads', [LeadsController::class, 'index'])->name('leads.Lead');
// Route::get('/caller', [LeadsController::class, 'caller'])->name('leads.caller');
Route::post('/leads', [LeadsController::class, 'store'])->name('leads.store');

Route::post('/leads/bulk-delete', [LeadsController::class, 'bulkDestroy'])->name('leads.bulk_destroy');

// routes/web.php

Route::get('/leads/export-csv', [LeadsController::class, 'exportCsv'])->name('leads.export.csv');


Route::get('/admin', [DashboadController::class, 'index'])->name('admin.admin');
Route::get('/caller', [CallerController::class, 'index'])->name('caller.caller');

Route::post('/leads/{id}/update-stage', [CallerController::class, 'updateStage'])
    ->name('leads.updateStage');
