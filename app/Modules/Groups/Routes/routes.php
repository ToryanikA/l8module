<?php

use App\Classes\Permissions;
use App\Modules\Groups\Controllers\GroupController;
use App\Modules\Groups\Middleware\CanAccess;

Route::group(
    [
        'middleware' => ['web', 'auth'],
        'as' => 'groups.',
    ],
    function () {
        Route::get('/groups', [GroupController::class, 'index'])
            ->middleware(CanAccess::class . ':groups,' . Permissions::VIEW)->name('list');
        Route::get('/groups/create', [GroupController::class, 'create'])
            ->middleware(CanAccess::class . ':groups,' . Permissions::CREATE)->name('create');
        Route::get('/groups/{id}', [GroupController::class, 'edit'])
            ->middleware(CanAccess::class . ':groups,' . Permissions::EDIT)->name('edit');
    }
);
