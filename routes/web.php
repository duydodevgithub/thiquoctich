<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/quiz',[QuizController::class,'getQuestions'])->name('quiz');

Route::Group(['prefix' => 'admin'], function(){
    Route::get('', function() {
        return view('admin.home');
    })->name('admin.home');

    Route::get('category', [CategoryController::class, 'getCategory'])->name('admin.category');
    Route::get('deleteCategory/{id}', [CategoryController::class, 'deleteCategory'])->name('admin.deleteCategory');
    Route::post('addCategory', [CategoryController::class, 'addCategory'])->name('admin.addCategory');

    Route::get('question', [QuestionController::class, 'getQuestion'])->name('admin.question');
    Route::post('addQuestion', [QuestionController::class, 'addQuestion'])->name('admin.addQuestion');
    Route::get('deleteQuestion/{id}', [QuestionController::class, 'deleteQuestion'])->name('admin.deleteQuestion');

});
