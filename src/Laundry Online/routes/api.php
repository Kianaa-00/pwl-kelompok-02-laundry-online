<?php 

use App\Http\Controllers\Api\OrderApiController;
use Illuminate\Support\Facades\Route;

Route::get('/Order', [OrderApiController::class, 'index']);
Route::get('/Order/{resi}', [OrderApiController::class, 'show']);