<?php

use App\Exports\PaymentsExport;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CartController as AdminCartController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\User\RegisterController;
use App\Http\Controllers\Admin\User\LoginController;
use App\Http\Controllers\Admin\User\LogoutController;
use App\Http\Controllers\MenuController as ControllersMenuController;
use App\Http\Controllers\ProductController as ControllersProductController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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

//login
Route::get('admin/user/login',[LoginController::class, 'login'])->name('admin.user.login');


Route::get('admin/user/register',[RegisterController::class, 'register'])->name('admin.user.register');

Route::group(['middleware' => ['admin']], function () {
    Route::get('admin',[MainController::class, 'index_admin'])->name('admin');
    Route::prefix('admin')->group(function (){  

        // Route::prefix('brand')->group(function (){
        //     Route::get('/', [AdminController::class, 'brands'])->name('admin.brands');   
        //     Route::get('add', [AdminController::class, 'add_brand'])->name('admin.brand.add');  
        //     Route::post('store', [AdminController::class,'brand_store' ])->name('admin.brand.store');
        // });
         

        //Menu
        Route::prefix('category')->group(function (){
            Route::get('/',[MenuController::class, 'index'])->name('admin.categories'); 
            Route::get('add',[MenuController::class, 'add_category'])->name('admin.category.add');
            Route::post('store', [MenuController::class,'store' ])->name('admin.category.store');
            Route::get('edit/{menu}', [MenuController::class,'edit' ]);
            Route::post('edit/{menu}', [MenuController::class,'update' ])->name('admin.category.update');
            Route::get('search', [MenuController::class, 'search'])->name('admin.category.search');
            Route::DELETE('destroy', [MenuController::class,'destroy' ]);
        });

        //Product
        Route::prefix('product')->group(function (){
            Route::get('/',[ProductController::class, 'index'])->name('admin.products'); 
            Route::get('add',[ProductController::class, 'create'])->name('admin.product.add');
            Route::post('store', [ProductController::class,'store' ])->name('admin.product.store');
            Route::get('view/{product}', [ProductController::class,'view' ])->name('admin.product.view');
            Route::get('edit/{product}', [ProductController::class,'edit' ])->name('admin.product.edit');
            Route::post('edit/{product}', [ProductController::class,'update' ])->name('admin.product.update');
            Route::get('search', [ProductController::class, 'search'])->name('admin.product.search');
            Route::DELETE('destroy', [ProductController::class,'destroy' ]);
        });

        //User
        Route::prefix('user')->group(function (){
            Route::get('/',[UserController::class, 'index'])->name('admin.users'); 
            Route::get('add',[UserController::class, 'create'])->name('admin.user.add');
            Route::post('store', [UserController::class,'store' ])->name('admin.user.store');
            Route::get('edit/{user}', [UserController::class,'edit' ])->name('admin.user.edit');
            Route::post('edit/{user}', [UserController::class,'update' ])->name('admin.user.update');
            Route::get('search', [UserController::class, 'search'])->name('admin.user.search');
            Route::DELETE('destroy', [UserController::class,'destroy' ]);
        });


        //Cart
        Route::prefix('cart')->group(function (){
            Route::get('customer',[AdminCartController::class, 'index'])->name('admin.cart.customer');
            Route::get('customer/view/{customer}',[AdminCartController::class, 'showCustomer'])->name('admin.customers.view');
            Route::get('oder',[AdminCartController::class, 'showOrder'])->name('admin.orders');
        });
        
    }); 
});

Route::prefix('danh-muc')->group(function (){
    Route::get('/', [ControllersMenuController::class, 'index']);
    Route::get('{id}-{slug}.html',[ControllersMenuController::class,'index']);
    Route::post('{id}-{slug}.html',[ControllersMenuController::class,'filterByPrice'])->name('products.filterByPrice');
});

Route::get('/san-pham/{id}-{slug}.html',[ControllersProductController::class,'index']);


Route::post('/add-cart',[CartController::class, 'index']);

Route::get('/carts',[CartController::class, 'show']);


Route::post('/update-cart',[CartController::class, 'update']);
Route::get('/carts/delete/{id}',[CartController::class, 'remove']);


//Checkout
Route::get('/carts/checkout',[CartController::class, 'checkout']);

Route::post('carts',[CartController::class, 'addCart'])->name('cart.checkout');


Route::get('/subcategories', [MenuController::class, 'getSubCategories']);
Route::post('services/load-product',[MainController::class,'loadProduct']);
//Store login
Route::post('admin/user/login/store',[LoginController::class, 'store'])->name('user.login.store');
Route::post('admin/user/register/store',[RegisterController::class, 'store'])->name('user.register.store');
Route::post('admin/user/logout',[LogoutController::class, 'logout'])->name('user.logout');


Route::get('/search',[MainController::class, 'search'])->name('client.search');


Route::get('/',[MainController::class, 'index_client'])->name('user');
Route::get('/export-payments', function () {
    return Excel::download(new PaymentsExport, 'payments.xlsx');
});
