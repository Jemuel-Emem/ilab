<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AddServices;
use Livewire\Livewire;
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

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');


Route::middleware([

    ])->group(function () {
         Route::get('/dashboard', function () {
           if (auth()->user()->is_admin == 1) {
            return redirect()->route('Admindashboard');
           }
           else if (auth()->user()->is_admin == 2) {
            return redirect()->route('Techniciandashboard');
           }

           else{
            return redirect()->route('user-dashboard');
           }
         })->name('userdashboard');

    });

    Route::prefix('admin')->middleware('admin')->group(function(){
        Route::get('/Admindashboard', function(){
            return view('admin.index');
        })->name('Admindashboard');

        Route::get('/Add-services', function(){
            return view('admin.add-services');
        })->name('adminadd');

        Route::get('/Billing', function(){
            return view('admin.billing');
        })->name('admin-billing');

        Route::get('/Patient-Information', function(){
            return view('admin.patient-information');
        })->name('admin-information');

        Route::get('/Daily-Transaction', function(){
            return view('admin.daily-transaction');
        })->name('admin-daily');

         Route::get('/Print', function(){
             return view('livewire.admin.print-services');
         })->name('printServices');



     });
    //  Route::get('/admin/services/print', [AddServices::class, 'print'])->name('printServices');
     Route::prefix('patient')->middleware('patient')->group(function(){
        Route::get('/dashboard', function(){
               return view('patient.index');
           })->name('user-dashboard');

           Route::get('/services', function(){
            return view('patient.services');
        })->name('user.services');

        Route::get('/appointment', function(){
            return view('patient.appointment');
        })->name('app');

        Route::get('/payment', function(){
            return view('patient.payment');
        })->name('payment');

        Route::get('/med-history', function(){
            return view('patient.med-history');
        })->name('med-history');
    });

    Route::prefix('technician')->middleware('technician')->group(function(){
        Route::get('/dashboard', function(){
               return view('technician.index');
           })->name('Techniciandashboard');

           Route::get('/dashboard.appointment', function(){
            return view('technician.appointment');
        })->name('Technician.appointment');

        Route::get('/dashboard.patients', function(){
            return view('technician.patients');
        })->name('Technician.patients');

        Route::get('/dashboard.payment', function(){
            return view('technician.payment');
        })->name('Technician.payment');
    });
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
require __DIR__.'/auth.php';
