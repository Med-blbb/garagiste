<?php

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

Route::get('/', function () {
    return view('welcome');
});
// routes/web.php

Route::prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

    // Gestion des utilisateurs
    Route::get('/users', 'AdminController@users')->name('admin.users');
    Route::get('/users/{id}', 'AdminController@userDetails')->name('admin.user.details');
    Route::post('/users/{id}/suspend', 'AdminController@suspendUser')->name('admin.user.suspend');
    Route::post('/users/{id}/activate', 'AdminController@activateUser')->name('admin.user.activate');

    // Gestion des articles
    Route::get('/articles', 'AdminController@articles')->name('admin.articles');
    Route::get('/articles/{id}', 'AdminController@articleDetails')->name('admin.article.details');
    Route::post('/articles/{id}/publish', 'AdminController@publishArticle')->name('admin.article.publish');
    Route::post('/articles/{id}/unpublish', 'AdminController@unpublishArticle')->name('admin.article.unpublish');

    // Autres fonctionnalités d'administration...
});
