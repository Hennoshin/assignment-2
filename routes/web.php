<?php

use App\Http\Controllers\Web\BeritaController;
use App\Http\Controllers\Web\UnitKerjaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\LoginStaffController;
use App\Http\Controllers\Web\EmployeeController;
use App\Http\Controllers\Web\SalariesController;
use App\Http\Controllers\Web\RewardTypeController;
use App\Http\Controllers\Web\UsersController;
use App\Http\Controllers\Web\RewardController;
use App\Http\Controllers\Web\AttendenceController;
use App\Http\Controllers\Web\PaidLeaveController;
use App\Http\Controllers\Web\OverTimeController;
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
    if (empty(session())) {
        return redirect('/login');
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
            # take out this once
            Route::get('staf-login', function () {
                return view('auth.staf-login');
            })->name('login_staf');
            Route::get('staf-otp-login/{employee_uuid}', function () {
                return view('auth.staf-otp');
            })->name('login_staf_otp');
            Route::post('staf-validate', [LoginStaffController::class, 'stafValidate'])->name('web.staf.validate');
            Route::post('staf-otp-validate/{employee_uuid}', [LoginStaffController::class, 'stafValidateOtp'])->name('web.staf.otp');
            Route::get('staf-otp-renew/{employee_uuid}', [LoginStaffController::class, 'stafRenewOtp'])->name('web.staf.otprenew');
            # take out this once
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

                Route::group(['prefix' => 'salaries'], function () {
                    Route::get('/', [SalariesController::class, 'index'])->name('web.salaries.index');
                    Route::get('/export', [SalariesController::class, 'export'])->name('web.salaries.export');
                    Route::get('/do-import', [SalariesController::class, 'gopageimport'])->name('web.salaries.gopageimport');
                    Route::post('/import', [SalariesController::class, 'import'])->name('web.salaries.import');
                    Route::get('/create', [SalariesController::class, 'create'])->name('web.salaries.create');
                    Route::get('/print/{id}', [SalariesController::class, 'print'])->name('web.salaries.print');
                    Route::post('/', [SalariesController::class, 'store'])->name('web.salaries.store');
                    Route::get('/{id}/edit', [SalariesController::class, 'edit'])->name('web.salaries.edit');
                    Route::put('/{id}', [SalariesController::class, 'update'])->name('web.salaries.update');
                    Route::delete('/{id}', [SalariesController::class, 'destroy'])->name('web.salaries.delete');
                });

                Route::group(['prefix' => 'reward-type'], function () {
                    Route::get('/', [RewardTypeController::class, 'index'])->name('web.reward-type.index');
                    Route::get('/create', [RewardTypeController::class, 'create'])->name('web.reward-type.create');
                    Route::post('/', [RewardTypeController::class, 'store'])->name('web.reward-type.store');
                    Route::get('/{id}/edit', [RewardTypeController::class, 'edit'])->name('web.reward-type.edit');
                    Route::put('/{id}', [RewardTypeController::class, 'update'])->name('web.reward-type.update');
                    Route::delete('/{id}', [RewardTypeController::class, 'destroy'])->name('web.reward-type.delete');
                });

                Route::group(['prefix' => 'unit-kerja'], function () {
                    Route::get('/', [UnitKerjaController::class, 'index'])->name('web.unit-kerja.index');
                    Route::get('/create', [UnitKerjaController::class, 'create'])->name('web.unit-kerja.create');
                    Route::post('/', [UnitKerjaController::class, 'store'])->name('web.unit-kerja.store');
                    Route::get('/{id}/edit', [UnitKerjaController::class, 'edit'])->name('web.unit-kerja.edit');
                    Route::put('/{id}', [UnitKerjaController::class, 'update'])->name('web.unit-kerja.update');
                    Route::delete('/{id}', [UnitKerjaController::class, 'destroy'])->name('web.unit-kerja.delete');
                });

                Route::group(['prefix' => 'rewards'], function () {
                    Route::get('/', [RewardController::class, 'index'])->name('web.rewards.index');
                    Route::get('/export', [RewardController::class, 'export'])->name('web.rewards.export');
                    Route::get('/create', [RewardController::class, 'create'])->name('web.rewards.create');
                    Route::post('/', [RewardController::class, 'store'])->name('web.rewards.store');
                    Route::get('/{id}/edit', [RewardController::class, 'edit'])->name('web.rewards.edit');
                    Route::put('/{id}', [RewardController::class, 'update'])->name('web.rewards.update');
                    Route::delete('/{id}', [RewardController::class, 'destroy'])->name('web.rewards.delete');
                    Route::get('/claim/{id}', [RewardController::class, 'claim'])->name('web.rewards.claim');
                });

                Route::group(['prefix' => 'employees'], function () {
                    Route::get('/', [EmployeeController::class, 'index'])->name('web.employees.index');
                    Route::get('/export', [EmployeeController::class, 'export'])->name('web.employees.export');
                    Route::get('/create', [EmployeeController::class, 'create'])->name('web.employees.create');
                    Route::post('/', [EmployeeController::class, 'store'])->name('web.employees.store');
                    Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('web.employees.edit');
                    Route::put('/{id}', [EmployeeController::class, 'update'])->name('web.employees.update');
                    Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('web.employees.delete');
                });

                Route::group(['prefix' => 'paid-leaves'], function () {
                    Route::get('/', [PaidLeaveController::class, 'index'])->name('web.paid-leaves.index');
                    Route::get('/export', [PaidLeaveController::class, 'export'])->name('web.paid-leaves.export');
                    Route::get('/create', [PaidLeaveController::class, 'create'])->name('web.paid-leaves.create');
                    Route::post('/', [PaidLeaveController::class, 'store'])->name('web.paid-leaves.store');
                    Route::get('/{id}/edit', [PaidLeaveController::class, 'edit'])->name('web.paid-leaves.edit');
                    Route::put('/{id}', [PaidLeaveController::class, 'update'])->name('web.paid-leaves.update');
                    Route::get('/{id}', [PaidLeaveController::class, 'show'])->name('web.paid-leaves.show');
                    Route::delete('/{id}', [PaidLeaveController::class, 'destroy'])->name('web.paid-leaves.delete');
                    Route::post('/approve/{id}', [PaidLeaveController::class, 'approve'])->name('web.paid-leaves.approve');
                });

                Route::group(['prefix' => 'attendence'], function () {
                    Route::get('/', [AttendenceController::class, 'index'])->name('web.attendence.index');
                    Route::get('/export', [AttendenceController::class, 'export'])->name('web.attendence.export');
                    Route::get('/quick-add', [AttendenceController::class, 'quickAdd'])->name('web.attendence.quick-add');
                    Route::get('/quick-add/{id}', [AttendenceController::class, 'quickAddForm'])->name('web.attendence.quick-add-form');
                    Route::post('/quick-add/{id}', [AttendenceController::class, 'quickAddSave'])->name('web.attendence.quick-add-save');
                    // Route::get('/create', [AttendenceController::class, 'create'])->name('web.attendence.create');
                    Route::post('/', [AttendenceController::class, 'store'])->name('web.attendence.store');
                    // Route::get('/{id}/edit', [AttendenceController::class, 'edit'])->name('web.attendence.edit');
                    Route::put('/{id}', [AttendenceController::class, 'update'])->name('web.attendence.update');
                    Route::delete('/{id}', [AttendenceController::class, 'destroy'])->name('web.attendence.delete');
                });

                Route::group(['prefix' => 'overtime'], function () {
                    Route::get('/', [OverTimeController::class, 'index'])->name('web.overtime.index');
                    Route::get('/export', [OverTimeController::class, 'export'])->name('web.overtime.export');
                    Route::get('/create', [OverTimeController::class, 'create'])->name('web.overtime.create');
                    Route::post('/', [OverTimeController::class, 'store'])->name('web.overtime.store');
                    Route::get('/{id}/edit', [OverTimeController::class, 'edit'])->name('web.overtime.edit');
                    Route::put('/{id}', [OverTimeController::class, 'update'])->name('web.overtime.update');
                    Route::get('/{id}', [OverTimeController::class, 'show'])->name('web.overtime.show');
                    Route::delete('/{id}', [OverTimeController::class, 'destroy'])->name('web.overtime.delete');
                    Route::post('/approve/{id}', [OverTimeController::class, 'approve'])->name('web.overtime.approve');
                    Route::post('/addprogress/{id}', [OverTimeController::class, 'progress'])->name('web.overtime.progress');
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
