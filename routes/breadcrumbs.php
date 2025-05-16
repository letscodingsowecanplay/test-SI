<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;



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
    $trail->push('Kuis - Halaman 4', route('admin.materi.halaman4'));
});

Breadcrumbs::for('admin.kuis.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Kuis', route('admin.kuis.index'));
});

Breadcrumbs::for('admin.kuis.hasil', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.kuis.index');
    $trail->push('Hasil Kuis', route('admin.kuis.hasil'));
});

Breadcrumbs::for('admin.materi.halaman5', function ($trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Materi - Halaman 5', route('admin.materi.halaman5'));
});
Breadcrumbs::for('admin.materi.halaman6', function ($trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Materi - Halaman 6', route('admin.materi.halaman6'));
});

Breadcrumbs::for('admin.materi.halaman7', function ($trail) {
    $trail->parent('admin.materi.index');
    $trail->push('Kuis - Halaman 7', route('admin.materi.halaman7'));
});
