<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Distributer\DistributerController;
use App\Http\Controllers\Producer\ProducerController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Categories\CategorieController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Stock\StockControlle;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CommandesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('login',[AuthController::class,'getuser']);

Route::post('signup',[AuthController::class,'signup']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('categorie/add',[CategorieController::class,'addCategorie']);
Route::get('categorie',[CategorieController::class,'getcate']);
Route::get('categorieid/{id}',[CategorieController::class,'getgategorieById']);
Route::post('panier/add',[CartController::class,'store']);
Route::post('stock/add',[StockControlle::class,'addStock']);
Route::get('stocks',[StockControlle::class,'getstok']);

Route::get('products',[ProductController::class,'getProduct']);
Route::get('product/{id}',[ProductController::class,'getProductById']);
Route::post('product/add',[ProductController::class,'addProduct']);
Route::put('product/update/{id}',[ProductController::class,'updateProduct']);
Route::delete('product/delete/{id}',[ProductController::class,'deleteProduct']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    // Route::get('products',[ProductController::class,'getProduct']);
}); 

Route::get('users',[UserController::class,'getUser']);
Route::get('user/{id}',[UserController::class,'getUserById']);
//Route::post('user/register',[UserController::class,'create']);
// Route::post('user/login',[UserController::class,'login']);
Route::put('user/update/{id}',[UserController::class,'updateUser']);
Route::delete('user/delete/{id}',[UserController::class,'deleteUser']);


Route::get('admins',[AdminController::class,'getAdmin']);
Route::get('admin/{id}',[AdminController::class,'getAdminById']);
Route::post('admin/register',[AdminController::class,'create']);
Route::post('admin/login',[AdminController::class,'login']);
Route::put('admin/update/{id}',[AdminController::class,'updateAdmin']);
Route::delete('admin/delete/{id}',[AdminController::class,'deleteAdmin']);


Route::get('distributers',[DistributerController::class,'getdistributer']);
Route::get('distributer/{id}',[DistributerController::class,'getDistributerById']);
Route::post('distributer',[DistributerController::class,'create']);
Route::post('distributer/login',[DistributerController::class,'login']);
Route::put('distributer/update/{id}',[DistributerController::class,'updateDistributer']);
Route::delete('distributer/delete/{id}',[DistributerController::class,'deleteDistributer']);


// Route::get('producers',[Com::class,'getProducer']);


Route::get('producers',[ProducerController::class,'getProducer']);
Route::get('producer/{id}',[ProducerController::class,'getProducerById']);
Route::post('addproducer',[ProducerController::class,'Create']);
Route::post('producer/login',[ProducerController::class,'Login']);
Route::put('producer/update/{id}',[ProducerController::class,'updateProducer']);
Route::delete('producer/delete/{id}',[ProducerController::class,'deleteProducer']); 


Route::post('login', [AuthController::class,'login']);

// Route::get('stripe', [StripeController::class, 'stripe']);
// Route::post('stripe/post', [StripeController::class, 'stripePost'])->name('stripe.post');



Route::post('addcommande',[CommandeController::class,'Create']);

Route::get('commande',[CommandeController::class,'getCommande']);

Route::post('addcommandes',[CommandesController::class,'Create']);

Route::get('commandes',[CommandesController::class,'getCommandess']);

Route::get('allcommandes',[CommandesController::class,'getAllCommandess']);
Route::put('update/commandess/{id}',[CommandesController::class,'updatecommandess']);
Route::delete('commandess/delete/{id}',[CommandesController::class,'deletecommandess']);

Route::delete('commande/delete/{id}',[CommandeController::class,'deleteCommande']);

Route::get('allcommande',[CommandeController::class,'getAllCommandes']);
Route::put('delivry/{id}',[CommandesController::class,'dilivry']);
Route::put('shipping/{id}',[CommandesController::class,'shipping']);