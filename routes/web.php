<?php

use App\Log\Http\Controllers\LogActionController;
use App\Login\Http\Controllers\LoginController;
use App\Option\Http\Controllers\OptionController;
use App\Question\Http\Controllers\QuestionController;
use App\Role\Http\Controllers\RoleController;
use App\Subject\Http\Controllers\SubjectController;
use App\Team\Http\Controllers\TeamController;
use App\Test\Http\Controllers\TestController;
use App\Topic\Http\Controllers\TopicController;
use App\User\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('about', function (){
    return view('about', ['title' => 'Sobre']);
})->name('about');

Route::middleware('auth')->group(function (){
    Route::get('', [LoginController::class, 'home'])->name('home');

    Route::middleware('can:Role Management')->group(function () {
        Route::resource('role', RoleController::class);
    });

    Route::prefix('user')->group(function (){
        Route::middleware('can:User Management')->group(function () {
            Route::get('create', [UserController::class, 'create'])->name('user.create');
            Route::post('create', [UserController::class, 'store'])->name('user.create.store');
            Route::get('destroy/{userid}', [UserController::class, 'destroy']);
        });

        Route::get('{userid}', [UserController::class, 'show']);
        Route::post('edit/store', [UserController::class, 'update'])->name('user.edit.store');
        Route::get('', [UserController::class, 'index'])->name('user.index');
    });

    Route::middleware('can:Role Management')->group(function (){
        Route::resource('role', RoleController::class);
    });

    Route::get('log', [LogActionController::class, 'index'])->name('log.index')->middleware('can:LOG');

    Route::middleware('can:Question Management')->group(function (){
        Route::resource('subject', SubjectController::class)->except(['destroy']);
        Route::resource('topic', TopicController::class)->except(['destroy']);
        Route::resource('question', QuestionController::class);
        Route::resource('option', OptionController::class);

        Route::prefix('subject')->group(function (){
            Route::get('/topic/destroy/{topicId}', [TopicController::class, 'destroy']);
        });
    });

    Route::middleware('can:Team')->group(function (){
        Route::resource('team', TeamController::class);
        Route::resource('test', TestController::class);
    });
});

