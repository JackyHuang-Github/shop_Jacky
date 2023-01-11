<?php

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

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

Route::namespace('App\Http\Controllers')->group(function(){
    Route::get('/', 'SiteController@index');
    Route::get('/shop', 'SiteController@shop');
    Route::get('/items/{item}','SiteController@productDetail');
    Route::get('/blog','SiteController@blog');
    Route::get('/blog-detail','SiteController@blogDetail');
    Route::get('/contact','SiteController@contact');
    Route::post('/contacts','SiteController@storeContact');
});

Route::get('picArray', function() {
    $item = Item::find(13);
    dd($item->picsArray);
    // print_r($item->picsArray);
});

Route::get('getlocale', function() {
    App::setLocale('zh_TW');
    return App::getLocale();
});

Route::get('getpwdreset', function() {
    App::setLocale('zh_TW');
    return __('passwords.reset');
});

Route::get('messages', function() {
    App::setLocale('zh_TW');
    return __('messages.welcome');
});

// Route::get('gettimezone', function() {
//     return Config::get('app.timezone', 'UTC');
// });

// Route::get('getTimezone', function() {
//     return Config::get('app.timezone', 'UTC');
// });

Route::get('test', function() {
    return view('test');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('additem', function() {
    $itemId = 1;
    $userId = 1;
    $rowId = 2;
    $item = Item::find($itemId);
    \Cart::session($userId)->add([
        'id' => $rowId,
        'name' => $item->title,
        'price' => $item->price_new,
        'quantity' => 1,
        'attributes' => [],
        'associatedModel' => $item
    ]);
    return '已加入購物車中';
});

Route::get('updateitem', function() {
    $userId = 1;
    $rowId = 2;
    if(!\Cart::isEmpty()) {
        \Cart::session($userId)->update($rowId, [
            'quantity' => 2,
            'price' => 800
        ]);
        return '已更新購物車';
    }
});

Route::get('removeitem', function() {
    $userId = 1;
    $rowId = 2;
    \Cart::session($userId)->remove($rowId);
    return '已移除商品';
});

Route::get('getcart', function() {
    $item = \Cart::session(1)->getContent();
    dd($item);
});

Route::get('/storesession', function(Request $request) {
    // session(['name' => 'zack']);
    $request->session()->put('name', 'zack2');
    $request->session()->put('msg', 'it is done');
    $request->session()->put('price', 1000);
    $request->session()->put('data', ['name' => 'PS5', 'price' => 15800]);
    return 'Session 已儲存';
});

Route::get('/flashsession', function(Request $request) {
    // session(['name' => 'zack']);
    // $request->session()->flash('status', '更新成功');
    $request->session()->flash('status', 'Task was successful !');
    return 'Session 已儲存';
});

Route::get('/getsession', function(Request $request) {
    // $data = session('name', 'jack');
    // $request->session()->get('name', 'jack2');
    // $data = $requests->session()->pull('price');
    $data = $request->session()->get('status', '沒找到');
    return $data;
});

Route::get('/keepsession', function(Request $request) {
    $request->session()->keep(['status']);
    return $data;
});

Route::get('/deletesession', function(Request $request) {
    // $request->session()->forget('msg');
    $request->session()->flush();
    return $request->session()->all();
});

Route::get('/feedback', function () {
    return view('feedback');
});