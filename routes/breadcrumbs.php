<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Kkm;




Breadcrumbs::for('admin.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Dashboard', route('admin.index'));
});
Breadcrumbs::for('admin.users.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Users', route('admin.users.index'));
});
Breadcrumbs::for('admin.users.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.users.index');
    $trail->push('Add new user', route('admin.users.create'));
});
Breadcrumbs::for('admin.users.edit', function ($trail, User $user) {
    $trail->parent('admin.users.index');
    $trail->push("Edit {$user->name}", route('admin.users.edit', $user));
});

// Role
Breadcrumbs::for('admin.roles.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Roles', route('admin.roles.index'));
});
Breadcrumbs::for('admin.roles.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.roles.index');

    $trail->push('Add new role', route('admin.roles.create'));
});
Breadcrumbs::for('admin.roles.edit', function (BreadcrumbTrail $trail, Role $post): void {
    $trail->parent('admin.roles.index');

    $trail->push($post->name, route('admin.roles.edit', $post));
});
// Permission
Breadcrumbs::for('admin.permissions.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Permissions', route('admin.permissions.index'));
});
Breadcrumbs::for('admin.permissions.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.permissions.index');

    $trail->push('Add new permission', route('admin.permissions.create'));
});
Breadcrumbs::for('admin.permissions.edit', function (BreadcrumbTrail $trail, Permission $post): void {
    $trail->parent('admin.permissions.index');

    $trail->push($post->name, route('admin.permissions.edit', $post));
});
// profile
Breadcrumbs::for('admin.profile.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Profile', route('admin.profile.index'));
});
// change password
Breadcrumbs::for('admin.password.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('admin.index');
    $trail->push('Change Password', route('admin.password.index'));
});

//Materi

Breadcrumbs::for('admin.materi.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Materi - Halaman 1', route('admin.materi.index'));
});

Breadcrumbs::for('admin.materi.halaman2', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Materi - Halaman 2', route('admin.materi.halaman2'));
});

Breadcrumbs::for('admin.materi.halaman3', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Materi - Halaman 3', route('admin.materi.halaman3'));
});

Breadcrumbs::for('admin.materi.halaman4', function ($trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Ayo Mencoba - Halaman 4', route('admin.materi.halaman4'));
});

Breadcrumbs::for('admin.materi.halaman5', function ($trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Ayo Berlatih - Halaman 5', route('admin.materi.halaman5'));
});
Breadcrumbs::for('admin.materi.halaman6', function ($trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Materi - Halaman 6', route('admin.materi.halaman6'));
});

Breadcrumbs::for('admin.materi.halaman7', function ($trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Materi - Halaman 7', route('admin.materi.halaman7'));
});

Breadcrumbs::for('admin.materi.halaman8', function ($trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Materi - Halaman 8', route('admin.materi.halaman8'));
});

Breadcrumbs::for('admin.materi.halaman9', function ($trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Ayo Mencoba - Halaman 9', route('admin.materi.halaman9'));
});

Breadcrumbs::for('admin.materi.halaman10', function ($trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Ayo Berlatih - Halaman 10', route('admin.materi.halaman10'));
});

Breadcrumbs::for('admin.materi.halaman11', function ($trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Materi - Halaman 11', route('admin.materi.halaman11'));
});

Breadcrumbs::for('admin.materi.halaman12', function ($trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Materi - Halaman 12', route('admin.materi.halaman12'));
});

Breadcrumbs::for('admin.materi.halaman13', function ($trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Materi - Halaman 13', route('admin.materi.halaman13'));
});

Breadcrumbs::for('admin.materi.halaman14', function ($trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Materi - Halaman 14', route('admin.materi.halaman14'));
});

Breadcrumbs::for('admin.materi.halaman15', function ($trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Ayo Mencoba - Halaman 15', route('admin.materi.halaman15'));
});

Breadcrumbs::for('admin.materi.halaman16', function ($trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Ayo Berlatih - Halaman 16', route('admin.materi.halaman16'));
});

Breadcrumbs::for('admin.materi.halaman17', function ($trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Materi - Halaman 17', route('admin.materi.halaman17'));
});


Breadcrumbs::for('admin.datasiswa.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Data Siswa', route('admin.datasiswa.index'));
});

Breadcrumbs::for('admin.datasiswa.create', function ($trail) {
    $trail->parent('admin.datasiswa.index');
    $trail->push('Tambah Siswa');
});

Breadcrumbs::for('admin.datasiswa.edit', function ($trail, User $user) {
    $trail->parent('admin.datasiswa.index');
    $trail->push("Edit {$user->name}", route('admin.datasiswa.edit', $user));
});

Breadcrumbs::for('admin.datalatihan.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Data Latihan Siswa', route('admin.datalatihan.index'));
});

Breadcrumbs::for('admin.datalatihan.edit', function ($trail, Nilai $nilai) {
    $trail->parent('admin.datalatihan.index');
    $trail->push("Edit: {$nilai->user->name}", route('admin.datalatihan.edit', $nilai));
});

Breadcrumbs::for('admin.hasilbelajar.index', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Data Hasil Belajar Siswa', route('admin.hasilbelajar.index'));
});

Breadcrumbs::for('admin.hasilbelajar.edit', function ($trail, Nilai $nilai) {
    $trail->parent('admin.hasilbelajar.index');
    $trail->push("Edit: {$nilai->user->name}", route('admin.hasilbelajar.edit', $nilai));
});

Breadcrumbs::for('admin.kkm.index', function ($trail) {
    $trail->push('Data KKM', route('admin.kkm.index'));
});

Breadcrumbs::for('admin.kkm.edit', function ($trail, Kkm $kkm) {
    $trail->parent('admin.kkm.index');
    $trail->push("Edit: {$kkm->kuis_id}", route('admin.kkm.edit', $kkm));
});
