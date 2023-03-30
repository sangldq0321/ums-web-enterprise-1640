<?php
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
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
            Route::get('/ideas', [MainController::class, 'ideaIndex']);
        });
        Route::middleware(['viewIndexIdea'])->group(function () {
            Route::get('/ideas/view/{id}', [MainController::class, 'viewIdea'])->name('viewIdea');
        });
        Route::middleware(['checkStaff'])->group(function () {
            Route::get('/ideas/add', [MainController::class, 'getAddIdea']);
            Route::post('/ideas/add', [MainController::class, 'postAddIdea']);
            Route::get('/ideas/edit/{id}', [MainController::class, 'getEditIdea']);
            Route::post('/ideas/edit/{id}', [MainController::class, 'postEditIdea']);
            Route::get('/ideas/delete/{id}', [MainController::class, 'deleteIdea']);
            Route::post('/ideas/comment', [MainController::class, 'postComment']);
            Route::get('/comments/edit/{id}', [MainController::class, 'getEditComment']);
            Route::post('/comments/edit/{id}', [MainController::class, 'postEditComment']);
            Route::get('/comments/delete/{id}', [MainController::class, 'deleteComment']);
        });


        Route::middleware(['checkQAManager'])->group(function () {
            Route::get('/categories', [MainController::class, 'categoryIndex']);
            Route::get('/categories/add', [MainController::class, 'getAddCategory']);
            Route::post('/categories/add', [MainController::class, 'postAddCategory']);
            Route::get('/categories/edit/{id}', [MainController::class, 'getEditCategory']);
            Route::post('/categories/edit/{id}', [MainController::class, 'postEditCategory']);
            Route::get('/categories/delete/{id}', [MainController::class, 'deleteCategory']);
        });
    });
    Route::get('/account/change-password', [LoginController::class, 'getChangePassword']);
    Route::post('/account/change-password', [LoginController::class, 'postChangePassword']);
    Route::get('/logout', [LoginController::class, 'logOut']);
});
