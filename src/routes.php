<?php

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/identity/{code?}', Neondigital\Identify\Controllers\VerifyController::class)->name('identify.authorise.verify');

    Route::post('/identity/resend', Neondigital\Identify\Controllers\ResendController::class)->name('identify.authorise.resend');
});
