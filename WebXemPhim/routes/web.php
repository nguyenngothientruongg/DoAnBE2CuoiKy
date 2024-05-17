<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomMovieController;

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
Route::get('user/searchMovie', [CustomMovieController::class, 'searchMovie'])->name('user.searchMovie');
Route::put('/admin/editCountries{id}', [CustomMovieController::class, 'updateCountries'])->name('admin.updateCountries');
Route::get('/admin/editCountries_{id}', [CustomMovieController::class, 'editCountries'])->name('admin.editCountries');
Route::delete('/admin/delete_countries{id}', [CustomMovieController::class, 'deleteCountries'])->name('admin.deleteCountries');
Route::get('admin/registrationCountries', [CustomMovieController::class, 'registrationCountries'])->name('admin.registrationCountries');
Route::post('custom-registrationCountries', [CustomMovieController::class, 'customRegistrationCountries'])->name('admin.customRegistrationCountries');
Route::get('admin/countriesList', [CustomMovieController::class, 'countriesList'])->name('admin.countriesList');

Route::get('/deleteCommentByAd/{id}', [CustomMovieController::class, 'deleteCommentByAdmin'])->name('delCommentByAd');
Route::get('/detailMovie/{id}', [CustomMovieController::class, 'detailMovieAdmin'])->name('detailMovie');
Route::post('/user/delete-watched-movies', [CustomMovieController::class, 'deleteMovieWatched'])->name('user.deleteMovieWatched');
Route::get('/user/editUser_{id}', [CustomMovieController::class, 'editUser'])->name('user.editUser');
Route::put('profileUser_{id}', [CustomMovieController::class, 'updateUser'])->name('user.updateUser');
Route::get('/user/profileUser', [CustomMovieController::class, 'profileUser'])->name('user.profileUser');
Route::delete('/admin/delete_user{id}', [CustomMovieController::class, 'deleteUser'])->name('admin.deleteUser');
Route::get('admin/userList', [CustomMovieController::class, 'adminUserList'])->name('admin.userList');
Route::get('user/category', [CustomMovieController::class, 'getListCategoryMovie'])->name('user.category');
Route::delete('/user/{id}', [CustomMovieController::class, 'deletePost'])->name('user.deletePost');
Route::post('custom-registrationPost', [CustomMovieController::class, 'postComment'])->name('user.customRegistrationPost');
Route::put('/admin/{id}', [CustomMovieController::class, 'updateMovie'])->name('admin.updateMovie');
Route::get('/admin/editMovie_{id}', [CustomMovieController::class, 'editMovie'])->name('admin.editMovie');
Route::delete('/admin/delete_movie{id}', [CustomMovieController::class, 'deleteMovie'])->name('admin.deleteMovie');
Route::get('admin/registrationMovie', [CustomMovieController::class, 'registrationMovie'])->name('admin.registrationMovie');
Route::post('custom-registrationMovie', [CustomMovieController::class, 'customRegistrationMovie'])->name('admin.registrationMovieCustom');
Route::get('admin/home', [CustomMovieController::class, 'adminHome'])->name('admin.movie');
Route::get('login', [CustomMovieController::class, 'login'])->name('login');
Route::post('custom-login', [CustomMovieController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomMovieController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomMovieController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomMovieController::class, 'signOut'])->name('signout');
Route::get('/movie/{id}/{tuoi}', [CustomMovieController::class, 'showMovie'])->name('user.showMovie');
Route::get('home', [CustomMovieController::class, 'getListMovie'])->name('user.movie');
Route::get('index', [CustomMovieController::class, 'index'])->name('index');
Route::get('/', function () {
    return view('index');
});
Route::get('dashboard', [CustomMovieController::class, 'dashboard']);
