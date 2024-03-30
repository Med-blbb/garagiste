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


// routes/web.php

// Route::prefix('admin')->group(function () {
//     // Dashboard
//     Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

//     // Gestion des utilisateurs
//     Route::get('/users', 'AdminController@users')->name('admin.users');
//     Route::get('/users/{id}', 'AdminController@userDetails')->name('admin.user.details');
//     Route::post('/users/{id}/suspend', 'AdminController@suspendUser')->name('admin.user.suspend');
//     Route::post('/users/{id}/activate', 'AdminController@activateUser')->name('admin.user.activate');

//     // Gestion des articles
//     Route::get('/articles', 'AdminController@articles')->name('admin.articles');
//     Route::get('/articles/{id}', 'AdminController@articleDetails')->name('admin.article.details');
//     Route::post('/articles/{id}/publish', 'AdminController@publishArticle')->name('admin.article.publish');
//     Route::post('/articles/{id}/unpublish', 'AdminController@unpublishArticle')->name('admin.article.unpublish');

//     // Autres fonctionnalités d'administration...
// });
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'showAllUsers'])->name('admin.users');
    Route::get('/users/add', [AdminController::class, 'showAddUserForm'])->name('admin.users.add');
    Route::post('/users/add', [AdminController::class, 'addUser'])->name('admin.users.add');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');


    Route::put('/users/{id}/update', [AdminController::class, 'updateUser'])->name('admin.users.update');


    // Remove user
    Route::delete('/users/{id}/remove', [AdminController::class, 'removeUser'])->name('admin.users.remove');
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