<?php

use App\Http\Controllers\DelegationController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('assign', [DelegationController::class, 'assignWorkerToCountry']);

Route::post('worker/create', [WorkerController::class, 'store'])->name('worker.create');

Route::get('worker/{worker_id}/delegations', [DelegationController::class, 'getWorkerDelegations'])->name('worker.delegations');
