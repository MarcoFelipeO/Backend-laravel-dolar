<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DolarController;

Route::get('/dolares', [DolarController::class, 'consultar']);
Route::put('/dolares/{fecha}', [DolarController::class, 'actualizar']);
Route::delete('/dolares/{fecha}', [DolarController::class, 'eliminar']);

