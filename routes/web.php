<?php

use App\Http\Controllers\Web\BeritaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\UsersController;
use App\Helpers\MyRoute;
use App\Http\Controllers\Web\Profile\ProfileController;
use App\Http\Controllers\Web\Profile\ChangeAvatarController;
use App\Http\Controllers\Web\Profile\ChangePasswordController;
use App\Http\Controllers\Web\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (empty(auth()->user())) {
        return redirect('/landing');
    } else {
        return redirect(route('web.dashboard'));
    }
});
// LANDING PAGE
Route::get('/landing', function () {
   return view('front.landing.landing');
});

//  ROOMS
Route::get('/detail', function () {
    return view('front.rooms.detail-room');
 });
Route::get('/list-room', function () {
    return view('front.rooms.list-room');
 });
// Auth::routes();
Route::namespace('App\Http\Controllers\Web')
    ->group(
        function () {
            Route::get('login', function () {
                return view('auth.login');
            })->name('login');
            Route::post('login', [LoginController::class, 'login']);
            Route::post('logout', [LoginController::class, 'logout'])->name('logout');
            Route::get('/files', [App\Http\Controllers\HomeController::class, 'getFiles'])->name('web.getfiles');
            Route::group(['middleware' => 'auth:web'], function () {
                Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('web.dashboard');

                Route::prefix('user')->group(function () {
                    MyRoute::resourceWEB('profile', ProfileController::class, 'profile', ['index', 'store']);
                    MyRoute::resourceWEB('change-password', ChangePasswordController::class, 'profile.password', ['index', 'store']);
                    MyRoute::resourceWEB('change-avatar', ChangeAvatarController::class, 'profile.avatar', ['index', 'store']);
                });

                Route::group(['prefix' => 'settings'], function () {
                    Route::get('/', [SettingController::class, 'index'])->name('web.settings.index');
                    Route::put('/{id}', [SettingController::class, 'update'])->name('web.settings.update');
                });

                Route::group(['prefix' => 'users'], function () {
                    Route::get('/', [UsersController::class, 'index'])->name('web.users.index');
                    Route::get('/export', [UsersController::class, 'export'])->name('web.users.export');
                    Route::get('/create', [UsersController::class, 'create'])->name('web.users.create');
                    Route::post('/', [UsersController::class, 'store'])->name('web.users.store');
                    Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('web.users.edit');
                    Route::put('/{id}', [UsersController::class, 'update'])->name('web.users.update');
                    Route::delete('/{id}', [UsersController::class, 'destroy'])->name('web.users.delete');
                });

                Route::group(['prefix' => 'informations'], function () {
                    Route::get('/', [BeritaController::class, 'index'])->name('web.informations.index');
                    Route::get('/create', [BeritaController::class, 'create'])->name('web.informations.create');
                    Route::post('/', [BeritaController::class, 'store'])->name('web.informations.store');
                    Route::get('/{id}/edit', [BeritaController::class, 'edit'])->name('web.informations.edit');
                    Route::put('/{id}', [BeritaController::class, 'update'])->name('web.informations.update');
                    Route::delete('/{id}', [BeritaController::class, 'destroy'])->name('web.informations.delete');
                });



            });
        });
