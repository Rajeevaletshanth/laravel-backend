<?php

use App\Http\Controllers\TemplateController;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/index', [TemplateController::class, 'index']);
Route::post('/newdata', [TemplateController::class, 'addNewData']);
Route::get('/get-data/{id}', [TemplateController::class, 'findbyId']);
Route::delete('/delete/{id}', [TemplateController::class, 'deleteData']);
Route::post('/generatePdf', [TemplateController::class, 'generatePdf']);

