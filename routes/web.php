<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Middleware\UserCheckMiddleware;
use App\Http\Middleware\AdminCheckMiddleware;
use App\Http\Controllers\admin\AdminController;

use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\PizzaController;
use App\Http\Controllers\admin\AllUserController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ContactmessageController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
       if(Auth::check()){
           if(Auth::user()->role =='admin'){
                return redirect()->route("admin#profile");
           }
           else if(Auth::user()->role =='user'){
            return redirect()->route("user#index");
           }
       }

    })->name('dashboard');
});


Route::group(['prefix'=>'admin', 'namespace'=>'admin','middleware'=>[AdminCheckMiddleware::class]],function(){
    Route::get('adminprofile',[AdminController::class,'profile'])->name('admin#profile');

    Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');
    Route::get('changePassword',[AdminController::class,'changePassword'])->name('admin#changePassword');
    Route::post('confirmPassword/{id}',[AdminController::class,'confirmPassword'])->name('admin#confirmPassword');


    Route::get('category',[CategoryController::class,'category'])->name('admin#category');
    Route::get('addCategory',[CategoryController::class,'addCategory'])->name('admin#addCategory');
    Route::post('creatCategory',[CategoryController::class,'creatCategory'])->name('admin#creatCategory');
    Route::get('deleteCategory/{id}',[CategoryController::class,'deleteCategory'])->name('admin#deleteCategory');
    Route::get('editCategory/{id}',[CategoryController::class,'editCategory'])->name('admin#editCategory');
    Route::post('updateCategory',[CategoryController::class,'updateCategory'])->name('admin#updateCategory');
    Route::get('category/search',[CategoryController::class,'searchCategory'])->name('admin#searchCategory');
    Route::get("categoryItem/{id}",[CategoryController::class,'categoryItem'])->name('admin#categoryItem');
    Route::get('categoryList/download',[CategoryController::class,'downloadList'])->name('admin#downloadList');

    Route::get('pizza',[PizzaController::class,'pizza'])->name('admin#pizza');
    Route::get('addPizza',[PizzaController::class,'addPizza'])->name('admin#addPizza');
    Route::post('insertPizza',[PizzaController::class,'insertPizza'])->name('admin#insertPizza');
    Route::get('deletePizza/{id}',[PizzaController::class,'deletePizza'])->name('admin#deletePizza');
    Route::get('infoPizza/{id}',[PizzaController::class,'infoPizza'])->name('admin#infoPizza');
    Route::get('editPizza/{id}',[PizzaController::class,'editPizza'])->name('admin#editPizza');
    Route::post('updatePizza/{id}',[PizzaController::class,'updatePizza'])->name('admin#updatePizza');
    Route::get('pizza/search',[PizzaController::class,'searchPizza'])->name('admin#searchPizza');
    Route::get('pizza/download',[PizzaController::class,'downloadPizzaList'])->name('admin#downloadPizza');

    Route::get('userlist',[AllUserController::class,'userlist'])->name('admin#userlist');
    Route::get('adminlist',[AllUserController::class,'adminlist'])->name('admin#adminlist');
    Route::get('userlist/search',[AllUserController::class,'searchUser'])->name('admin#searchUser');
    Route::get('adminlist/search',[AllUserController::class,'searchAdmin'])->name('admin#searchAdmin');
    Route::get('deleteUser/{id}',[AllUserController::class,'deleteUser'])->name('admin#deleteUser');
    Route::get('editAdmin/{id}',[AllUserController::class,'editAdmin'])->name('admin#editAdmin');

    Route::get('contactlist',[ContactmessageController::class,'index'])->name('admin#contactlist');
    Route::get('contactlist/search',[ContactmessageController::class,'search'])->name('admin#searchContact');

    Route::get('orderlist',[OrderController::class,'orderlist'])->name('admin#orderlist');
    Route::get('searchOrder',[OrderController::class,'searchOrder'])->name('admin#searchOrder');
});

Route::group(['prefix'=>'user','middleware'=>[UserCheckMiddleware::class]],function(){
    Route::get('/',[UserController::class,'index'])->name("user#index");
    Route::post('contact/create',[ContactController::class,'index'])->name('contact#index');
    Route::get('contact/details/{id}',[UserController::class,'details'])->name('contact#details');
    Route::get('category/search/{id}',[UserController::class,'search'])->name('user#category');
    Route::get('user/search',[UserController::class,'searchItem'])->name('user#search');
    Route::get('user/search/price',[UserController::class,'searchByPrice'])->name('user#searchByPrice');
    Route::get('order',[UserController::class,'order'])->name('user#order');
    Route::post('placeOrder',[UserController::class,'placeOrder'])->name('user#placeOrder');

});
