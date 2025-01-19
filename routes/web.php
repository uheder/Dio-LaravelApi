<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/api/v1');
});

require __DIR__.'/auth.php';
