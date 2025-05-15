<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MateriController;
use App\Http\Controllers\Admin\EvaluasiController;

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile-update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('change-password', [ProfileController::class, 'password'])->name('password.index');
    Route::put('update-password', [ProfileController::class, 'updatePassword'])->name('password.update');

    // User, Role, Permission
    Route::resource('users', UserController::class);
    Route::get('user-ban-unban/{id}/{status}', [UserController::class, 'banUnban'])->name('user.banUnban');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    // Materi
    Route::get('materi', [MateriController::class, 'index'])->name('materi.index');
    Route::get('materi/halaman-2', [MateriController::class, 'halamanDua'])->name('materi.halaman2');
    Route::get('materi/halaman-3', [MateriController::class, 'halamanTiga'])->name('materi.halaman3');
    Route::get('materi/halaman-4', [MateriController::class, 'halamanEmpat'])->name('materi.halaman4');
    Route::post('materi/halaman-4/simpan', [MateriController::class, 'simpanHalamanEmpat'])->name('materi.halaman4.simpan');
    Route::delete('materi/halaman4/reset', [MateriController::class, 'resetHalamanEmpat'])->name('materi.halaman4.reset');
    Route::get('materi/halaman-5', [MateriController::class, 'halamanLima'])->name('materi.halaman5');
    Route::post('materi/halaman-5/simpan', [MateriController::class, 'simpanHalamanLima'])->name('materi.halaman5.simpan');
    Route::delete('materi/halaman5/reset', [MateriController::class, 'resetHalaman5'])->name('materi.halaman5.reset');
    Route::get('materi/halaman-6', [MateriController::class, 'halamanEnam'])->name('materi.halaman6');

    Route::get('evaluasi/petunjuk', [EvaluasiController::class, 'petunjuk'])->name('evaluasi.petunjuk');

    Route::get('evaluasi', [EvaluasiController::class, 'index'])->name('evaluasi.index');
    Route::post('evaluasi/simpan', [EvaluasiController::class, 'simpan'])->name('evaluasi.simpan');

});