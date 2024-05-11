<?php

use App\Http\Controllers\admin\ClientController;
use App\Http\Controllers\admin\InvoiceController;
use App\Http\Controllers\admin\SpairPartController;
use App\Http\Controllers\admin\VehicleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\admin\MechanicController;
use App\Http\Controllers\admin\RepairController;
use App\Http\Controllers\PDFController;
use App\Models\SpairPart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SpairPartsController;
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



Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'showAllUsers'])->name('admin.users');
    Route::get('/users/add', [AdminController::class, 'showAddUserForm'])->name('admin.users.add');
    Route::post('/users/add', [AdminController::class, 'addUser'])->name('admin.users.add');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{id}/update', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::get('/users/search', [AdminController::class, 'searchUser'])->name('admin.users.searchUser');

    // Remove user
    Route::delete('/users/{id}/remove', [AdminController::class, 'removeUser'])->name('admin.users.remove');

    //vehicules
    Route::get('/vehicles/add', [VehicleController::class, 'create'])->name('admin.vehicles.add');
    Route::post('/vehicles/add', [VehicleController::class, 'store'])->name('admin.vehicles.add');
    Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('admin.vehicles.delete');
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('admin.vehicles');
    Route::get('/vehicles/search', [VehicleController::class, 'searchVehicle'])->name('admin.vehicles.searchVehicle');
    Route::get('admin/vehicles/getOwner', [VehicleController::class, 'getOwner'])->name('admin.vehicles.getOwner');
    Route::get('admin/vehicles/search', [VehicleController::class, 'searchUser'])->name('admin.vehicles.searchUser');


    //import and export users  
    Route::post('/users/import', [AdminController::class, 'import'])->name('admin.users.import');
    Route::get('/users/export', [AdminController::class, 'export'])->name('admin.users.export');
    //allclients
    Route::get('/clients', [ClientController::class, 'index'])->name('admin.show-clients');
    //add client
    Route::get('/add/client', [ClientController::class, 'create'])->name('admin.add-client');
    Route::post('/add/client', [ClientController::class, 'store'])->name('admin.add-client');
    //edit client
    Route::get('/edit/client/{id}', [ClientController::class, 'edit'])->name('admin.edit-client');
    Route::put('/edit/client/{id}', [ClientController::class, 'update'])->name('admin.edit-client');
    //delete client
    Route::delete('/delete/client/{id}',[ClientController::class, 'destroy'])->name('admin.delete-client');
    //show mechanics
    Route::get('/mechanics', [MechanicController::class, 'index'])->name('admin.show-mechanics');
    //add mechanic
    Route::get('/add/mechanic', [MechanicController::class, 'create'])->name('admin.add-mechanic');
    Route::post('/add/mechanic', [MechanicController::class, 'store'])->name('admin.add-mechanic');
    //edit mechanic
    Route::get('/edit/mechanic/{id}', [MechanicController::class, 'edit'])->name('admin.edit-mechanic');
    Route::put('/edit/mechanic/{id}', [MechanicController::class, 'update'])->name('admin.edit-mechanic');
    //delete mechanic
    Route::delete('/delete/mechanic/{id}',[MechanicController::class,'deleteMechanic'])->name('admin.delete-mechanic');
    //show repairs
    Route::get('/repairs',[RepairController::class,'index'])->name('admin.show-repair');
    //add repair
    Route::get('/add/repair',[RepairController::class,'create'])->name('admin.add-repair');
    Route::post('/add/repair',[RepairController::class,'store'])->name('admin.add-repair');
    //edit repair
    Route::get('/edit/repair/{id}',[RepairController::class,'edit'])->name('admin.edit-repair');
    Route::put('/edit/repair/{id}',[RepairController::class,'update'])->name('admin.update-repair');
    Route::put('/edit/repair/status/{id}',[RepairController::class,'statusUpdateRepair'])->name('admin.update-repair-status');
    //delete repair
    Route::delete('/delete/repair/{id}',[RepairController::class,'deleteRepair'])->name('admin.delete-repair');
    //show spairs Parts
    Route::get('/spair-parts/',[SpairPartController::class,'index'])->name('admin.show-parts');
    //add spair part
    Route::get('/add/spair-parts',[SpairPartController::class,'create'])->name('admin.add-parts');
    Route::post('/add/spair-parts',[SpairPartController::class,'store'])->name('admin.add-parts');
    //edit spair part
    Route::get('/edit/spair-parts/{id}',[SpairPartController::class,'edit'])->name('admin.edit-parts');
    Route::put('/edit/spair-parts/{id}',[SpairPartController::class,'update'])->name('admin.edit-parts');
    //delete spair part
    Route::delete('/delete/spair-parts/{id}',[SpairPartController::class,'destroy'])->name('admin.delete-parts');
    //show invoices
    Route::get('/invoices',[InvoiceController::class,'index'])->name('admin.show-invoices');
    //add invoice
    Route::get('/add/invoice',[InvoiceController::class,'create'])->name('admin.add-invoice');
    Route::post('/add/invoice',[InvoiceController::class,'store'])->name('admin.add-invoice');
    //edit invoice
    Route::get('/edit/invoice/{id}',[InvoiceController::class,'edit'])->name('admin.edit-invoice');
    Route::put('/edit/invoice/{id}',[InvoiceController::class,'update'])->name('admin.edit-invoice');
    //delete invoice
    Route::delete('/delete/invoice/{id}',[InvoiceController::class,'destroy'])->name('admin.delete-invoice');
    //pdf invoice
    Route::get('/pdf/invoice/{id}',[PDFController::class,'generatePDF'])->name('admin.pdf-invoice');
});
Route::get('/verify-email/{token}', function ($token) {
    // Find the user by email verification token
    $user = User::where('email_verification_token', $token)->first();

    if ($user) {
        // If user found, mark email as verified and remove the verification token
        $user->email_verified_at = now();
        $user->email_verification_token = null;
        $user->save();

        // Redirect the user to a success page or display a success message
        return redirect('/login')->with('success', 'Email verified successfully. You can now log in.');
    } else {
        // If user not found, redirect to an error page or display an error message
        return redirect('/login')->with('error', 'Invalid or expired verification link.');
    }
})->name('verify.email');
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', 'LoginController@show')->name('login.show');

    Route::group(['middleware' => ['guest']], function () {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/','LoginController@show')->name('login.show');
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
    });

    Route::group(['middleware' => ['auth']], function () {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::get('/changeLocale/{locale}',function($locale){
    session()->put('locale',$locale);
    return redirect()->back();
})->name('pages.changeLocale');