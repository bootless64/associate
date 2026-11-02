<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Mews\Captcha\CaptchaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SummernoteController;
use App\Http\Controllers\UserRequestController;
use App\Http\Controllers\Auth\RegisterController;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

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

///////////////////////////////////////////////////////////////////////
// use Spatie\Sitemap\SitemapGenerator;
// use Spatie\Sitemap\Tags\Url;
// Route::get('/generate-sitemap', function()
// {
//     ini_set('max_execution_time', 10000);

//     SitemapGenerator::create("https://asa-center.sadjad.ac.ir")->hasCrawled(function (Url $url) {
//             if (str_contains($url->url, 'redirect')) {
//                 return null;
//             }
//             return $url;
//         })->writeToFile(public_path('sitemap.xml'));

//     return 'sitemap generated! ' . now();
// });
///////////////////////////////////////////////////////////////////////

Route::middleware('access.to.website')->group(function() {


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/vision-and-goal', function () { return view('vision-and-goal'); })->name('vision-and-goal');
Route::get('/activities', function () { return view('activities'); })->name('activities');
Route::get('/work-organization', function () { return view('work-organization'); })->name('work-organization');

Route::get('/policies-and-guidelines', function () { return view('policies-and-guidelines'); })->name('policies-and-guidelines');
Route::get('/executive-regulations', function () { return view('executive-regulations'); })->name('executive-regulations');

Route::get('/about-us', function () { return view('about-us'); })->name('about-us');


Route::get('/news', [NewsController::class, 'allApprovedNews'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
Route::post('/news/{news}/comment', [CommentController::class, 'storeForNews'])->middleware('auth')->name('news.comment');

Route::get('/articles', [ArticleController::class, 'allApprovedArticles'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('article.show');
Route::post('/articles/{article}/comment', [CommentController::class, 'storeForArticle'])->middleware('auth')->name('article.comment');




Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {

    Route::get('/', function () {
        return view('dashboard.index');
    })->name('index');


    Route::prefix('my-profile')->name('my-profile.')->group(function () {

        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::patch('/update-name', [ProfileController::class, 'updateName'])->name('update-name');
        Route::patch('/update-password', [ProfileController::class, 'updatePassword'])->name('update-password');
        Route::patch('/update-avatar', [ProfileController::class, 'updateAvatar'])->name('update-avatar');
        Route::delete('/delete-avatar', [ProfileController::class, 'deleteAvatar'])->name('delete-avatar');
        Route::delete('/delete-account', [ProfileController::class, 'deleteAccount'])->name('delete-account');
    });


    Route::middleware('can:manage_users')->prefix('manage-users')->name('manage-users.')->group(function () {

        Route::get('/', [UserController::class, 'manageUsers'])->name('index');
        Route::patch('/{user}/update-role', [UserController::class, 'updateRole'])->name('update-role');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });


    Route::middleware('can:manage_roles')->prefix('manage-roles')->name('manage-roles.')->group(function () {

        Route::get('/', [RoleController::class, 'manageRoles'])->name('index');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::patch('/{role}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
    });


    Route::middleware('can:manage_projects')->prefix('manage-projects')->name('manage-projects.')->group(function () {

        Route::get('/', [ProjectController::class, 'manageProjects'])->name('index');
        Route::get('/{project}/reports', [ProjectController::class, 'projectReports'])->name('reports');
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        Route::post('/', [ProjectController::class, 'store'])->name('store');
        Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::patch('/{project}', [ProjectController::class, 'update'])->name('update');
        Route::get('/download/{project}/{file}', [ProjectController::class, 'downloadFile'])->name('download-file');
        Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('destroy');


        Route::prefix('manage-requests')->name('manage-requests.')->group(function () {

            Route::get('/', [UserRequestController::class, 'manageRequests'])->name('index');
            Route::get('/{request}', [UserRequestController::class, 'showRequest'])->name('show');
            Route::get('/download/{request_file}', [UserRequestController::class, 'downloadRequestFile'])->name('download-file');
            Route::delete('/{request}', [UserRequestController::class, 'destroyRequest'])->name('destroy');
        });
    });


    Route::middleware('can:manage_news')->prefix('manage-news')->name('manage-news.')->group(function () {

        Route::get('/', [NewsController::class, 'manageNews'])->name('index');
        Route::get('/{news}/edit', [NewsController::class, 'edit'])->name('edit');
        Route::patch('/{news}', [NewsController::class, 'update'])->name('update');
        Route::patch('/{news}/update-status', [NewsController::class, 'updateStatus'])->name('update-status');
        Route::patch('/{news}/update-is-archived', [NewsController::class, 'updateIsArchived'])->name('update-is-archived');
        Route::delete('/{news}', [NewsController::class, 'destroy'])->name('destroy');
    });


    Route::middleware('can:manage_articles')->prefix('manage-articles')->name('manage-articles.')->group(function () {

        Route::get('/', [ArticleController::class, 'manageArticles'])->name('index');
        Route::patch('/{article}/update-status', [ArticleController::class, 'updateStatus'])->name('update-status');
        Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('destroy');
    });


    Route::middleware('can:manage_sliders')->prefix('manage-sliders')->name('manage-sliders.')->group(function () {

        Route::get('/', [SliderController::class, 'manageSliders'])->name('index');
        Route::post('/', [SliderController::class, 'store'])->name('store');
        Route::patch('/{slide}', [SliderController::class, 'update'])->name('update');
        Route::delete('/{slide}', [SliderController::class, 'destroy'])->name('destroy');
    });


    Route::middleware('can:manage_comments')->prefix('manage-comments')->name('manage-comments.')->group(function () {

        Route::get('/', [CommentController::class, 'manageComments'])->name('index');
        Route::patch('/{comment}/update-status', [CommentController::class, 'updateStatus'])->name('update-status');
        Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('destroy');
    });


    Route::middleware('can:manage_tickets')->prefix('manage-tickets')->name('manage-tickets.')->group(function () {

        Route::get('/', [TicketController::class, 'manageTickets'])->name('index');
        Route::patch('/{ticket}/update-status', [TicketController::class, 'updateStatus'])->name('update-status');
        Route::patch('/{ticket}/update-response', [TicketController::class, 'updateResponse'])->name('update-response');
        Route::delete('/{ticket}', [TicketController::class, 'destroy'])->name('destroy');
    });


    Route::middleware('can:manage_support_tickets')->prefix('manage-support-tickets')->name('manage-support-tickets.')->group(function () {

        Route::get('/', [TicketController::class, 'manageSupportTickets'])->name('index');
        Route::post('/', [TicketController::class, 'storeSupportTicket'])->name('store');
        Route::patch('/{ticket}/update-status', [TicketController::class, 'updateSupportTicketStatus'])->name('update-status');
        Route::patch('/{ticket}/update-response', [TicketController::class, 'updateSupportTicketResponse'])->name('update-response');
        Route::delete('/{ticket}', [TicketController::class, 'destroySupportTicket'])->name('destroy');
    });


    Route::middleware('can:manage_logs')->get('/manage-logs', [LogViewerController::class, 'index'])->name('manage-logs');


    Route::prefix('requests')->name('requests.')->group(function () {

        Route::get('/', [UserRequestController::class, 'index'])->name('index');
        Route::get('/assessment', [UserRequestController::class, 'assessment'])->name('assessment');
        Route::post('/assessment', [UserRequestController::class, 'storeAssessmentRequest'])->name('assessment.store');
        Route::get('/assessment/{id}/checklist', [UserRequestController::class, 'assessmentChecklist'])->name('assessment.checklist');
        Route::post('/assessment/{id}/checklist', [UserRequestController::class, 'storeAssessmentChecklist'])->name('assessment.checklist.store');
    });


    Route::prefix('my-projects')->name('my-projects.')->group(function () {

        Route::get('/', [ProjectController::class, 'myProjects'])->name('index');
        Route::get('/{project}/reports', [ProjectController::class, 'myProjectReports'])->name('reports');
        Route::get('download/{project}/{file}', [ProjectController::class, 'downloadMyProjectFile'])->name('reports.download-file');
        Route::get('/{project}/tickets', [ProjectController::class, 'myProjectTickets'])->name('tickets');
        Route::post('/{project}/tickets/store', [TicketController::class, 'storeProjectTicket'])->name('tickets.store');
        Route::patch('/{project}/tickets/{ticket}/update-status', [TicketController::class, 'updateProjectTicketStatus'])->name('tickets.update-status');
        Route::patch('/{project}/tickets/{ticket}/update-response', [TicketController::class, 'updateProjectTicketResponse'])->name('tickets.update-response');
        Route::delete('/{project}/tickets/{ticket}', [TicketController::class, 'destroyProjectTicket'])->name('tickets.destroy');
    });


    Route::prefix('my-tickets')->name('my-tickets.')->group(function () {

        Route::get('/', [TicketController::class, 'myTickets'])->name('index');
        Route::post('/', [TicketController::class, 'store'])->name('store');
        Route::patch('/{ticket}/update-response', [TicketController::class, 'updateMyTicketResponse'])->name('update-response');
    });


    Route::middleware('can:submit_news')->prefix('submit-news')->name('submit-news.')->group(function () {

        Route::get('/create', [NewsController::class, 'create'])->name('create');
        Route::post('/', [NewsController::class, 'store'])->name('store');
    });


    Route::middleware('can:submit_article')->prefix('my-articles')->name('my-articles.')->group(function () {

        Route::get('/', [ArticleController::class, 'myArticles'])->name('index');
        Route::get('/create', [ArticleController::class, 'create'])->name('create');
        Route::post('/', [ArticleController::class, 'store'])->name('store');
        Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('edit');
        Route::patch('/{article}', [ArticleController::class, 'update'])->name('update');
        Route::delete('/{article}', [ArticleController::class, 'destroyOwnArticle'])->name('destroy');
    });

});


Route::middleware('auth')->post('/summernote/upload', [SummernoteController::class, 'upload'])->name('summernote.upload');




Auth::routes();




Route::get('captcha/{config?}', [CaptchaController::class, 'getCaptcha'])->name('captcha');



Route::prefix('register')->name('register.')->group(function () {

    Route::post('/', [RegisterController::class, 'validateRegisterData'])->name('validate-register-data');

    Route::prefix('verify-mobile-number')->name('verify-mobile-number.')->group(function () {

        Route::get('/', function (Request $request)
        {
            if (! $request->session()->has('register_data') ) {
                return redirect('/register');
            }
            return view('auth.verify-mobile-number');
        })->name('index');

        Route::post('/verify-code', [RegisterController::class, 'verifyCode'])->name('verify-code');
        Route::post('/resend-code', [RegisterController::class, 'resendVerificationCode'])->name('resend-code');
    });
});




Route::get('/redirect-after-login', function(Request $request){
    $redirectTo = $request->query('redirect_to', url('/'));
    session(['url.intended' => $redirectTo]);
    return redirect()->route('login', ['redirect_to' => $redirectTo]);
})->name('redirect-after-login');



if (App::environment('local')) {
    // Route::get('/generate-fake-user', [UserController::class, 'generateFakeUser']);
    // Route::get('/generate-fake-news', [NewsController::class, 'generateFakeNews']);
    // Route::get('/generate-fake-article', [ArticleController::class, 'generateFakeArticle']);
    // Route::get('/generate-fake-comment', [CommentController::class, 'generateFakeComment']);
}


}); //end of access_to_website
