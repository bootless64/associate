<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Mews\Captcha\CaptchaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SummernoteController;
use App\Http\Controllers\Auth\RegisterController;


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
Route::middleware('access.to.website')->group(function() {

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/vision-and-goal', function () { return view('vision-and-goal'); })->name('vision-and-goal');
Route::get('/missions', function () { return view('missions'); })->name('missions');
Route::get('/work-organization', function () { return view('work-organization'); })->name('work-organization');

Route::get('/about-us', function () { return view('about-us'); })->name('about-us');


Route::get('/projects/titles', [ProjectController::class, 'allProjectTitles'])->name('projects.titles');
Route::get('/projects/progress', [ProjectController::class, 'allProjectProgress'])->name('projects.progress');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('project.show');

Route::get('/news', [NewsController::class, 'allNews'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::post('/news/{news}/comment', [CommentController::class, 'storeForNews'])->name('news.comment');

Route::get('/articles', [ArticleController::class, 'allArticles'])->name('articles');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('article.show');
Route::post('articles/{article}/comment', [CommentController::class, 'storeForArticle'])->name('article.comment');

Route::get('/test-request', function () {
    return view('test-request');
})->name('test-request');



Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {

    Route::get('/', function () {
        return view('dashboard.index');
    })->name('index');


    Route::prefix('profile')->name('profile.')->group(function () {

        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::patch('/update-name', [ProfileController::class, 'updateName'])->name('update-name');
        Route::patch('/update-password', [ProfileController::class, 'updatePassword'])->name('update-password');
        Route::patch('/update-avatar', [ProfileController::class, 'updateAvatar'])->name('update-avatar');
        Route::delete('/delete-avatar', [ProfileController::class, 'deleteAvatar'])->name('delete-avatar');
        Route::delete('/delete-account', [ProfileController::class, 'deleteAccount'])->name('delete-account');

    });


    Route::middleware('can:manage users')->prefix('manage-users')->name('manage-users.')->group(function () {

        Route::get('/', [UserController::class, 'manageUsers'])->name('index');
        Route::patch('/{user}/role', [UserController::class, 'updateRole'])->name('update-role');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });


    Route::middleware('can:manage roles')->prefix('manage-roles')->name('manage-roles.')->group(function () {

        Route::get('/', [RoleController::class, 'manageRoles'])->name('index');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::patch('/{role}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
    });


    Route::middleware('can:manage projects')->prefix('manage-projects')->name('manage-projects.')->group(function () {

        Route::get('/', [ProjectController::class, 'manageProjects'])->name('index');
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::post('/', [ProjectController::class, 'store'])->name('store');
        Route::patch('/{project}', [ProjectController::class, 'update'])->name('update');
        Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('destroy');
    });


    Route::middleware('can:manage news')->prefix('manage-news')->name('manage-news.')->group(function () {

        Route::get('/', [NewsController::class, 'manageNews'])->name('index');
        Route::get('/create', [NewsController::class, 'create'])->name('create');
        Route::get('/{news}/edit', [NewsController::class, 'edit'])->name('edit');
        Route::post('/', [NewsController::class, 'store'])->name('store');
        Route::patch('/{news}', [NewsController::class, 'update'])->name('update');
        Route::delete('/{news}', [NewsController::class, 'destroy'])->name('destroy');
    });


    Route::middleware('can:manage articles')->prefix('manage-articles')->name('manage-articles.')->group(function () {

        Route::get('/', [ArticleController::class, 'manageArticles'])->name('index');
        Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('destroy');
    });


    Route::middleware('can:manage comments')->prefix('manage-comments')->name('manage-comments.')->group(function () {

        Route::get('/', [CommentController::class, 'manageComments'])->name('index');
        Route::patch('/{comment}', [CommentController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('destroy');
    });


    Route::middleware('can:manage tickets')->group(function () {
        Route::get('/manage-tickets', function () {
            return view('dashboard.manage-tickets');
        })->name('manage-tickets.index');
    });


    Route::middleware('can:manage own articles')->prefix('my-articles')->name('my-articles.')->group(function () {

        Route::get('/', [ArticleController::class, 'myArticles'])->name('index');

        Route::get('/create', [ArticleController::class, 'create'])->name('create');
        Route::post('/', [ArticleController::class, 'store'])->name('store');
        Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('edit');
        Route::patch('/{article}', [ArticleController::class, 'update'])->name('update');
        Route::delete('/{article}', [ArticleController::class, 'destroyOwnArticle'])->name('destroyOwnArticle');
    });

});




Auth::routes();




Route::get('captcha/{config?}', [CaptchaController::class, 'getCaptcha'])->name('captcha');



Route::prefix('register')->name('register.')->group(function () {

    Route::post('/', [RegisterController::class, 'validateRegisterData'])->name('validate-register-data');

    Route::prefix('verify-mobile-number')->name('verify-mobile-number.')->group(function () {

        Route::get('/', function (Request $request) {
            if ( ! $request->session()->has('register_data') ) {
                return redirect('/register');
            }
            return view('auth.verify-mobile-number');

        })->name('index');

        Route::post('/verify-code', [RegisterController::class, 'verifyCode'])->name('verify-code');
        Route::post('/resend-code', [RegisterController::class, 'resendVerificationCode'])->name('resend-code');
    });

});



Route::middleware('auth')->post('/summernote/upload', [SummernoteController::class, 'upload'])->name('summernote.upload');



Route::get('/redirect-after-login', function(Request $request) {
    $redirect_to = $request->query('redirect_to', url('/'));
    session(['url.intended' => $redirect_to]);
    return redirect()->route('login');
})->name('redirect-after-login');



if (App::environment('local')) {
    // Route::get('/generate-fake-user', [UserController::class, 'generateFakeUser']);
    // Route::get('/generate-fake-news', [NewsController::class, 'generateFakeNews']);
    // Route::get('/generate-fake-article', [ArticleController::class, 'generateFakeArticle']);
    // Route::get('/generate-fake-comment', [CommentController::class, 'generateFakeComment']);
}



}); //end of access_to_website
