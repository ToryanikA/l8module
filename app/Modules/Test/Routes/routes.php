<?php

use App\Classes\Permissions;
use App\Modules\Groups\Middleware\CanAccess;
use App\Modules\Test\Controllers\TestController;

Route::group(
    [
    'middleware' => ['web', 'auth'],
    'as' => 'test.',
    ],
    function () {
        Route::get('/test', [TestController::class, 'index'])
            ->middleware(CanAccess::class . ':test,' . Permissions::VIEW);
        Route::get('/test/create', [TestController::class, 'create'])
            ->middleware(CanAccess::class . ':test,' . Permissions::CREATE);
        Route::get('/test/edit', [TestController::class, 'edit'])
            ->middleware(CanAccess::class . ':test,' . Permissions::EDIT);
    }
);
