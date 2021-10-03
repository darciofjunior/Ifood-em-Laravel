<?php

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function() {
    Route::get('/my-orders', [Auth\OrderTenantController::class, 'index'])->middleware(['auth']);
    Route::patch('/my-orders', [Auth\OrderTenantController::class, 'update'])->middleware(['auth']);
});
