<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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



Route::prefix('admin')->middleware('auth')->group(function () {
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
    Route::get('/vehicles/add', [AdminController::class, 'showAddVehicleForm'])->name('admin.vehicles.add');
    Route::post('/vehicles/add', [AdminController::class, 'store'])->name('admin.vehicles.add');
    Route::delete('/vehicles/{vehicle}', [AdminController::class, 'deleteVehicle'])->name('admin.vehicles.delete');
    Route::get('/vehicles', [AdminController::class, 'showAllVehicles'])->name('admin.vehicles');
    Route::get('/vehicles/search', [AdminController::class, 'searchVehicle'])->name('admin.vehicles.searchVehicle');

    //import and export users  
    Route::post('/users/import', [AdminController::class, 'import'])->name('admin.users.import');
    Route::get('/users/export', [AdminController::class, 'export'])->name('admin.users.export');
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
