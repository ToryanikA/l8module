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
            ->middleware(CanAccess::class . ':groups,' . Permissions::VIEW);
        Route::get('/test/create', [TestController::class, 'create'])
            ->middleware(CanAccess::class . ':groups,' . Permissions::CREATE);
        Route::get('/test/{id}', [TestController::class, 'edit'])
            ->middleware(CanAccess::class . ':groups,' . Permissions::EDIT);
    }
);
