<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SurveyFormController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/question', [QuestionController::class,'add']);
Route::get('/formquestion/{formid}', [QuestionController::class,'getquestion']);

Route::post('/form', [SurveyFormController::class,'add']);
Route::get('/allform', [SurveyFormController::class,'index']);

Route::get('/getanswer/{formid}', [AnswerController::class,'allans']);
Route::post('/answer', [AnswerController::class,'add']);

Route::get('/formdetail/{formid}', [SurveyFormController::class,'detail']);
