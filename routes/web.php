<?php

use App\Http\Controllers\DelegationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DelegationController::class, 'index'])->name('index');
