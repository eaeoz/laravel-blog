<?php

use App\Http\Controllers\Front\Homepage;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Back Routes
|--------------------------------------------------------------------------
*/
Route::get('under-const',function(){
    return view('front.offline');
});
Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){
Route::get('login',[\App\Http\Controllers\Back\AuthController::class,'login'])->name('login');
Route::post('login',[\App\Http\Controllers\Back\AuthController::class,'loginPost'])->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
Route::get('panel',[\App\Http\Controllers\Back\Dashboard::class,'index'])->name('dashboard');
// Makale Route Section
Route::get('articlelist/deleted',[\App\Http\Controllers\Back\ArticleController::class,'trashed'])->name('trashed.article');
Route::resource('articlelist',\App\Http\Controllers\Back\ArticleController::class);
Route::get('switch',[\App\Http\Controllers\Back\ArticleController::class,'switch'])->name('switch');
Route::get('/deletearticle/{id}',[\App\Http\Controllers\Back\ArticleController::class,'delete'])->name('delete.article');
Route::get('/harddeletearticle/{id}',[\App\Http\Controllers\Back\ArticleController::class,'harddelete'])->name('hard.delete.article');
Route::get('/recoverarticle/{id}',[\App\Http\Controllers\Back\ArticleController::class,'recover'])->name('recover.article');
// Category Route Section
Route::get('categorylist',[\App\Http\Controllers\Back\CategoryController::class,'index'])->name('category.index');
Route::post('categorylist/create',[\App\Http\Controllers\Back\CategoryController::class,'create'])->name('category.create');
Route::post('categorylist/update',[\App\Http\Controllers\Back\CategoryController::class,'update'])->name('category.update');
Route::post('categorylist/delete',[\App\Http\Controllers\Back\CategoryController::class,'delete'])->name('category.delete');
Route::get('categorystatus',[\App\Http\Controllers\Back\CategoryController::class,'switch'])->name('category.switch');
Route::get('categorylist/getData',[\App\Http\Controllers\Back\CategoryController::class,'getData'])->name('category.getdata');
// PAGES ROUTES
Route::get('/pages',[\App\Http\Controllers\Back\PageController::class,'index'])->name('page.index');
Route::get('/pages/create',[\App\Http\Controllers\Back\PageController::class,'create'])->name('page.create');
Route::get('/pages/switch',[\App\Http\Controllers\Back\PageController::class,'switch'])->name('page.switch');
Route::post('/pages/create',[\App\Http\Controllers\Back\PageController::class,'post'])->name('page.post');
Route::get('/pages/update/{id}',[\App\Http\Controllers\Back\PageController::class,'update'])->name('page.update');
Route::post('/pages/update/{id}',[\App\Http\Controllers\Back\PageController::class,'edit'])->name('page.edit');
Route::get('/pages/delete/{id}',[\App\Http\Controllers\Back\PageController::class,'delete'])->name('page.delete');
Route::get('/pages/siralama',[\App\Http\Controllers\Back\PageController::class,'orders'])->name('page.orders');
//Config's Route
Route::get('/settings',[\App\Http\Controllers\Back\ConfigController::class,'index'])->name('config.index');
Route::post('/settings/update',[\App\Http\Controllers\Back\ConfigController::class,'update'])->name('config.update');

//

Route::get('logout',[\App\Http\Controllers\Back\AuthController::class,'logout'])->name('logout');
});
/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/

Route::get('/',[\App\Http\Controllers\Front\Homepage::class,'index'])->name('homepage');
Route::get('/articles',[\App\Http\Controllers\Front\Homepage::class,'index']);
Route::get('/contact',[\App\Http\Controllers\Front\Homepage::class,'contact'])->name('contact');
Route::post('/iletisim',[\App\Http\Controllers\Front\Homepage::class,'contactpost'])->name('contact.post');
Route::get('/categories/{category}',[\App\Http\Controllers\Front\Homepage::class,'category'])->name('category');
Route::get('/{category}/{slug}',[\App\Http\Controllers\Front\Homepage::class,'single'])->name('single');
Route::get('/{page}',[\App\Http\Controllers\Front\Homepage::class,'page'])->name('page');
