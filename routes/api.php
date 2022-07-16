<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Apicontroller;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\EnrollmentsController;
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
Route::get('/displayStudent/{id}', [ApiController::class, 'displayStudent']);
Route::get('/deleteStudents', [ApiController::class, 'deleteStudents']);
Route::post('/updateStudents', [ApiController::class, 'updateStudents']);

Route::post('/createSubject', [SubjectsController::class,'createSubject']);
Route::get('/viewSubjects', [SubjectsController::class,'viewSubjects']);
Route::get('/deleteSubject/{name}',[SubjectsController::class,'deleteSubject']);
Route::post('/updateSubject/{name}',[SubjectsController::class,'updateSubject']);

Route::post('/createEnrollment', [EnrollmentsController::class,'createEnrollment']);
Route::get('/viewEnrollments/{id}', [EnrollmentsController::class,'viewEnrollments']);
