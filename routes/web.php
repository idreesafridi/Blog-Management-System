<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\WebsiteController;


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
// Route::get('/', [WebsiteController::class,'index'])->name('index');
// Route::get('/blog', [WebsiteController::class,'blogs'])->name('blogs');
// Route::get('/contact',[WebsiteController::class,'contact'] )->name('contact');
// Route::post('/contact_create',[WebsiteController::class,'contactCreate'])->name('contact_create');
// Route::post('/create_newletters',[WebsiteController::class,'createNewletter'])->name('create_newletters');


// Route::get('/dashboard', [backendController::class, 'dashboard'])->name('dashboard');
// Route::get('/categories', [backendController::class,'categories'])->name('categories');
// Route::post('/category_create', [backendController::class,'createCategory'])->name('category_create');
// Route::get('/category_view/{id}', [backendController::class,'showCategory'])->name('category_view');
// Route::delete('category_destroy/{id}', [backendController::class,'destroyCategory'])->name('category_destroy');
// Route::get('/edit_category/{id}',[backendController::class,'editCategory'])->name('edit_category');
// Route::put('category_update', [backendController::class,'categoryUpdate'])->name('category_update');

// Route::get('/blogs', [backendController::class,'blog'])->name('posts');
// Route::get('/blogs_create', [backendController::class,'blogCreate'])->name('posts_create');
// Route::get('/blog_view/{id}', [backendController::class,'showBlog'])->name('blog_view');
// Route::delete('blog_destroy/{id}',[backendController::class,'blogDestroy'])->name('blog_destroy');
// Route::get('/edit_blog/{id}', [backendController::class,'editBlog'])->name('edit_blog');
// Route::put('blog_update/{id}',[backendController::class,'blogUpdate'])->name('blog_update');
// Route::post('/blog_store', [backendController::class,'blogStore'])->name('blog_store');

// Route::get('/newsletters', [backendController::class,'newsletters'])->name('newsletters');
// Route::delete('/news_destroy/{id}',[backendController::class,'newsDestroy'])->name('news_destroy');
// Route::get('/contacts', [backendController::class,'contact'])->name('contacts');
// Route::delete('/contact_destroy/{id}',[backendController::class,'contactDestroy'])->name('contact_destroy');
// Route::get('/login', [backendController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [backendController::class, 'login']);
// Route::get('/logout', [backendController::class, 'logout'])->name('logout');


Route::get('/well', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('backend.dashboard');
    //return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');






Route::middleware('auth')->group(function () {
            Route::get('/profile_edit', [ProfileController::class, 'edit'])->name('profile_edit');
            Route::put('/profile_update', [ProfileController::class, 'update'])->name('profile_update');
            // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
            // Route::post('register_store', [backendController::class, 'createUser'])->name('register_store');

    

        Route::get('/', [WebsiteController::class,'index'])->name('index');
        // Route::get('/blog', [WebsiteController::class,'blogs'])->name('blogs');
        Route::get('blog_detail/{id}',[WebsiteController::class,'blogDetail'])->name('blog_detail');
        Route::get('blog_tagdetails/{id}',[WebsiteController::class,'blogTagdetail'])->name('blog_tagdetails');
        Route::get('/contact',[WebsiteController::class,'contact'] )->name('contact');
        Route::post('/contact_create',[WebsiteController::class,'contactCreate'])->name('contact_create');
        Route::post('/create_newletters',[WebsiteController::class,'createNewletter'])->name('create_newletters');
        Route::post('post_comment',[WebsiteController::class,'postComment'])->name('post-comment');
        Route::post('/like/{blogId}', [WebsiteController::class, 'likeBlog'])->name('like');
        Route::delete('/unlike/{blogId}', [WebsiteController::class, 'unlikeBlog']);
        Route::get('category_wise/{category}',[WebsiteController::class,'categoryWise'])->name('category_wise');


        Route::get('/dashboard', [backendController::class, 'dashboard'])->name('dashboard');
        Route::get('/categories', [backendController::class,'categories'])->name('categories');
        Route::post('/category_create', [backendController::class,'createCategory'])->name('category_create');
        Route::get('/category_view/{id}', [backendController::class,'showCategory'])->name('category_view');
        Route::delete('category_destroy/{id}', [backendController::class,'destroyCategory'])->name('category_destroy');
        Route::get('/edit_category/{id}',[backendController::class,'editCategory'])->name('edit_category');
        Route::put('category_update', [backendController::class,'categoryUpdate'])->name('category_update');

        Route::get('/blogs', [backendController::class,'blog'])->name('posts');
        Route::get('/blogs_create', [backendController::class,'blogCreate'])->name('posts_create');
        Route::get('/blog_view/{id}', [backendController::class,'showBlog'])->name('blog_view');
        Route::delete('blog_destroy/{id}',[backendController::class,'blogDestroy'])->name('blog_destroy');
        Route::get('/blog_edit/{id}', [backendController::class,'editBlog'])->name('blog_edit');
        Route::put('blog_update/{id}',[backendController::class,'blogUpdate'])->name('blog_update');
        Route::post('/blog_store', [backendController::class,'blogStore'])->name('blog_store');

        Route::get('/newsletters', [backendController::class,'newsletters'])->name('newsletters');
        Route::delete('/news_destroy/{id}',[backendController::class,'newsDestroy'])->name('news_destroy');
        Route::get('/contacts', [backendController::class,'contact'])->name('contacts');
        Route::delete('/contact_destroy/{id}',[backendController::class,'contactDestroy'])->name('contact_destroy');
        Route::get('/api/items/search', [backendController::class, 'search']);



});

require __DIR__.'/auth.php';


Route::get('logout', function() {
    Auth::logout();
    return redirect('/');
});
