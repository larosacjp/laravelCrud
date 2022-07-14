<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Apicontroller;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/student', [ApiController::class, 'create']);
Route::get('/displayStudents', [ApiController::class, 'displayStudents'])->name('disp');
Route::get('/disptest', [ApiController::class, 'disptest']);
Route::get('/deleteStudents', [ApiController::class, 'deleteStudents']);
Route::post('/updateStudents', [ApiController::class, 'updateStudents']);
