<?php
use App\Http\Controllers\MainController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LikeDislikeController;
use Illuminate\Support\Facades\Route;

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
Route::get('/login', [LoginController::class, 'getLogin'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'postLogin']);
Route::middleware(['auth'])->group(function () {
    Route::middleware(['checkPass'])->group(function () {
        Route::get('/', [MainController::class, 'index']);
        Route::middleware(['viewIdea'])->group(function () {
            Route::get('/ideas', [IdeaController::class, 'ideaIndex']);
        });
        Route::middleware(['viewIndexIdea'])->group(function () {
            Route::get('/ideas/view/{id}', [IdeaController::class, 'viewIdea'])->name('viewIdea');
        });
        Route::middleware(['checkStaff'])->group(function () {
            Route::get('/ideas/add', [IdeaController::class, 'getAddIdea']);
            Route::post('/ideas/add', [IdeaController::class, 'postAddIdea']);
            Route::get('/ideas/edit/{id}', [IdeaController::class, 'getEditIdea']);
            Route::post('/ideas/edit/{id}', [IdeaController::class, 'postEditIdea']);
            Route::get('/ideas/delete/{id}', [IdeaController::class, 'deleteIdea']);
            Route::post('/ideas/comment', [CommentController::class, 'postComment']);
            Route::get('/comments/edit/{id}', [CommentController::class, 'getEditComment']);
            Route::post('/comments/edit/{id}', [CommentController::class, 'postEditComment']);
            Route::get('/comments/delete/{id}', [CommentController::class, 'deleteComment']);
        });


        Route::middleware(['checkQAManager'])->group(function () {
            Route::get('/categories', [CategoryController::class, 'categoryIndex']);
            Route::get('/categories/add', [CategoryController::class, 'getAddCategory']);
            Route::post('/categories/add', [CategoryController::class, 'postAddCategory']);
            Route::get('/categories/edit/{id}', [CategoryController::class, 'getEditCategory']);
            Route::post('/categories/edit/{id}', [CategoryController::class, 'postEditCategory']);
            Route::get('/categories/delete/{id}', [CategoryController::class, 'deleteCategory']);
        });
    });
    Route::get('/account/change-password', [LoginController::class, 'getChangePassword']);
    Route::post('/account/change-password', [LoginController::class, 'postChangePassword']);
    Route::get('/logout', [LoginController::class, 'logOut']);
});
