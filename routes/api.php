<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AppSettingsController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OrdersDetailsController;
use App\Http\Controllers\OrdersStatusController;
use App\Http\Controllers\PayOutMethodsController;
use App\Http\Controllers\PayOutRequestController;
use App\Http\Controllers\PersonalInformationController;
use App\Http\Controllers\RolsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WalletsController;
use App\Http\Controllers\WalletTransactionsController;
use App\Http\Controllers\AssociationModelController;
use App\Http\Controllers\AssociationTransavtionsController;


use Illuminate\Support\Facades\Password;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
Route::post('/deleteaccount', [AuthController::class, 'deleteaccount'])->middleware('auth:sanctum');
//updatetokne
Route::post('/updatetokne', [AuthController::class, 'updatetokne'])->middleware('auth:sanctum');
//
Route::resource('categories', CategoriesController::class);
Route::resource('items', ItemsController::class);

Route::resource('address', AddressController::class)->middleware('auth:sanctum');
Route::resource('appsettings', AppSettingsController::class)->middleware('auth:sanctum');;

Route::resource('media', MediaController::class)->middleware('auth:sanctum');
Route::resource('notifications', NotificationsController::class)->middleware('auth:sanctum');
Route::resource('orders', OrdersController::class)->middleware('auth:sanctum');
Route::resource('orders-details', OrdersDetailsController::class)->middleware('auth:sanctum');
Route::resource('orders-status', OrdersStatusController::class)->middleware('auth:sanctum');
Route::resource('pay-out-methods', PayOutMethodsController::class)->middleware('auth:sanctum');
Route::resource('pay-out-request', PayOutRequestController::class)->middleware('auth:sanctum');
Route::resource('personal-information', PersonalInformationController::class)->middleware('auth:sanctum');
Route::resource('rols', RolsController::class)->middleware('auth:sanctum');
Route::resource('wallets', WalletsController::class)->middleware('auth:sanctum');
Route::resource('wallet-transactions', WalletTransactionsController::class)->middleware('auth:sanctum');

Route::resource('association', AssociationModelController::class)->middleware('auth:sanctum');
Route::resource('association-transactions', AssociationTransavtionsController::class)->middleware('auth:sanctum');


Route::resource('task', TaskController::class)->middleware('auth:sanctum');


Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');
