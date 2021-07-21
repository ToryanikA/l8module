<?php

use App\Classes\Permissions;
use App\Modules\Users\Controllers\UserController;
use App\Modules\Groups\Middleware\CanAccess;

Route::group(
    [
        'middleware' => ['web', 'auth'],
        'as' => 'users.',
    ],
    function () {
        Route::get('/users', [UserController::class, 'index'])
            ->middleware(CanAccess::class . ':users,' . Permissions::VIEW)->name('list');
        Route::get('/users/create', [UserController::class, 'create'])
            ->middleware(CanAccess::class . ':users,' . Permissions::CREATE)->name('create');
        Route::get('/users/{id}', [UserController::class, 'edit'])
            ->middleware(CanAccess::class . ':users,' . Permissions::EDIT)->name('edit');
    }
);
