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
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');  
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
    Route::delete('materi/halaman-5/reset', [MateriController::class, 'resetHalamanLima'])->name('materi.halaman5.reset');
    Route::get('materi/halaman-6', [MateriController::class, 'halamanEnam'])->name('materi.halaman6');
   
    Route::get('materi/halaman-7', [MateriController::class, 'halaman7'])->name('materi.halaman7');


    Route::get('materi/halaman-8', [MateriController::class, 'halaman8'])->name('materi.halaman8');
    

    Route::get('materi/halaman-9', [MateriController::class, 'halaman9'])->name('materi.halaman9');
    Route::post('materi/halaman-9/simpan', [MateriController::class, 'simpanHalaman9'])->name('materi.halaman9.simpan');
    Route::post('materi/halaman-9/reset', [MateriController::class, 'resetHalaman9'])->name('materi.halaman9.reset');

    Route::get('materi/halaman-10', [MateriController::class, 'halaman10'])->name('materi.halaman10');
    Route::post('materi/halaman-10/submit', [MateriController::class, 'submitHalaman10'])->name('materi.halaman10.submit');
    Route::post('materi/halaman-10/reset', [MateriController::class, 'resetHalaman10'])->name('materi.halaman10.reset');  
    
    Route::get('materi/halaman-11', [MateriController::class, 'halaman11'])->name('materi.halaman11');
    Route::get('materi/halaman-12', [MateriController::class, 'halaman12'])->name('materi.halaman12');
    Route::get('materi/halaman-13', [MateriController::class, 'halaman13'])->name('materi.halaman13');
    Route::get('materi/halaman-14', [MateriController::class, 'halaman14'])->name('materi.halaman14');
    
    Route::get('materi/halaman-15', [MateriController::class, 'halaman15'])->name('materi.halaman15');
    Route::post('materi/halaman-15/simpan', [MateriController::class, 'simpanHalaman15'])->name('materi.halaman15.simpan');
    Route::delete('materi/halaman-15/reset', [MateriController::class, 'resetHalaman15'])->name('materi.halaman15.reset');

    Route::get('materi/halaman-16', [MateriController::class, 'halaman16'])->name('materi.halaman16');
    Route::post('materi/halaman-16/simpan', [MateriController::class, 'simpanHalaman16'])->name('materi.halaman16.simpan');
    Route::delete('materi/halaman-16/reset', [MateriController::class, 'resetHalaman16'])->name('materi.halaman16.reset');

    Route::get('materi/halaman-17', [MateriController::class, 'halaman17'])->name('materi.halaman17');


    Route::get('evaluasi/petunjuk', [EvaluasiController::class, 'petunjuk'])->name('evaluasi.petunjuk');

    Route::get('evaluasi', [EvaluasiController::class, 'index'])->name('evaluasi.index');
    Route::post('evaluasi/simpan', [EvaluasiController::class, 'simpan'])->name('evaluasi.simpan');
    Route::post('evaluasi/reset', [EvaluasiController::class, 'reset'])->name('evaluasi.reset');


    Route::get('datasiswa', [AdminController::class, 'siswaIndex'])->name('datasiswa.index');
    Route::get('datasiswa/create', [AdminController::class, 'siswaCreate'])->name('datasiswa.create');
    Route::post('datasiswa', [AdminController::class, 'siswaStore'])->name('datasiswa.store');
    Route::get('datasiswa/{user}/edit', [AdminController::class, 'siswaEdit'])->name('datasiswa.edit');
    Route::put('datasiswa/{user}', [AdminController::class, 'siswaUpdate'])->name('datasiswa.update');
    Route::delete('datasiswa/{id}', [AdminController::class, 'siswaDestroy'])->name('datasiswa.destroy');

    Route::get('datalatihan', [AdminController::class, 'latihanIndex'])->name('datalatihan.index');
    Route::get('datalatihan/{nilai}/edit', [AdminController::class, 'latihanEdit'])->name('datalatihan.edit');
    Route::put('datalatihan/{id}', [AdminController::class, 'latihanUpdate'])->name('datalatihan.update');
    Route::delete('datalatihan/{id}', [AdminController::class, 'latihanDestroy'])->name('datalatihan.destroy');

    Route::get('hasilbelajar', [AdminController::class, 'hasilBelajarIndex'])->name('hasilbelajar.index');
    Route::get('hasilbelajar/{nilai}/edit', [AdminController::class, 'hasilBelajarEdit'])->name('hasilbelajar.edit');
    Route::put('hasilbelajar/{id}', [AdminController::class, 'hasilBelajarUpdate'])->name('hasilbelajar.update');
    Route::delete('hasilbelajar/{id}', [AdminController::class, 'hasilBelajarDestroy'])->name('hasilbelajar.destroy');

    Route::get('kkm', [AdminController::class, 'kkmIndex'])->name('kkm.index');
    Route::get('kkm/{kkm}/edit', [AdminController::class, 'kkmEdit'])->name('kkm.edit');
    Route::put('kkm/{kkm}', [AdminController::class, 'kkmUpdate'])->name('kkm.update');
    Route::delete('kkm/{kkm}', [AdminController::class, 'kkmDestroy'])->name('kkm.destroy');

    Route::get('hasilbelajar/export', [AdminController::class, 'export'])
    ->name('hasilbelajar.export');


});