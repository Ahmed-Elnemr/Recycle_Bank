<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartControll;
use  App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Web\ItemController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\AdminControllerController;
use App\Http\Controllers\Web\ShowUserDetailsController;
use App\Http\Controllers\Web\ShowOrderDetailsController;
// use App\Http\Livewire\Crud;
// use App\Http\Livewire\Admin\Category\Crud;
// use App\Http\Livewire\Crud;
// use App\Http\Livewire\Crud ;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\redirect;
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

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', function () {
    return view('start');
});

Route::get('/download', function () {
    $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
    $isTab = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "tablet"));

    // Platform check
    $isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "windows"));
    $isAndroid = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "android"));
    $isIPhone = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "iphone"));
    $isIPad = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "ipad"));
    $isIOS = $isIPhone || $isIPad;

    if($isMob){
        if($isIOS){
            return redirect("https://apps.apple.com/us/app/recycle-bank-egypt/id6447799075");
        }else{
            return redirect("https://play.google.com/store/apps/details?id=eg.recycle.bank.recycle_bank_eg");
        }
    }else{
        return view('start');
    }

});


Route::get('contact',function(){
    return view('index');
})->name('contact');

Route::get('privacy',function(){
    return view('privacy');
})->name('privacy');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');




    Route::resource('tasks', TaskController::class);
    #################
    Route::resource('categories', CategoryController::class);
    Route::resource('items', ItemController::class);

    Route::get('category',function(){
        return view('admin.category');
    })->name('categories');


    Route::get('item',function(){
        return view('admin.item');
    })->name('item');

    Route::get('app_setting',function(){
        return view('admin.app_setting');
    })->name('app_setting');

    Route::get('notification',function(){
        return view('admin.notification');
    })->name('notification');

    Route::get('media',function(){
        return view('admin.media');
    })->name('media');

    Route::get('users',function(){
        return view('admin.users');
    })->name('users');

    Route::get('order',function(){
        return view('admin.order');
    })->name('order');
    Route::get('association',function(){
        return view('admin.association');
    })->name('association');
    Route::get('wallets',function(){
        return view('admin.wallets');
    })->name('wallets');
    Route::get('payOut',function(){
        return view('admin.pay-out');
    })->name('payOut');

    Route::get('user_details/{id}',[ShowUserDetailsController::class,'details'])->name('user.details');
    // Route::get('user_details/{id}',[ShowUserDetailsController::class,'show'])->name('user_details.show');

    // Route::resource('order_details', OrderDetailsController::class);
    Route::get('order_details/{order_details}',[ShowOrderDetailsController::class,'show'])->name('order_details.show');
    // Route::resource('test/{order_details}', OrderDetailsController::class);




    ################################# theme route
    Route::get('/{page} ', [AdminControllerController::class ,'index']);
    //category
    Route::get('category-theme',function(){
        return view('admin.category_theme');
    })->name('category_theme');
});


Route::get('/reset-password/{token}', function ($token , Request $request) {
    return view('auth.reset-password', ['token' => $token , 'request'=> $request]);
})->middleware('guest')->name('password.reset');


Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
