<?php

use Illuminate\Support\Facades\Route;

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

Route::group([], function () {
    Route::post('login','\App\Http\Controllers\AuthController@login');
    Route::get('login','\App\Http\Controllers\AuthController@loginPage');

});
Route::group(['prefix'=>"open"],function(){
    Route::get('term-of-service',function(){
        return view('termofservice');
    });
    Route::get('privacy-policy',function(){
        return view('privacypolicy');
    });
});

Route::group(['middleware' => 'check.user'], function () {
    Route::get('/','\App\Http\Controllers\FrontController@home');
    Route::get('pin-message','\App\Http\Controllers\FrontController@pinMessage');
    Route::get('setting','\App\Http\Controllers\SettingController@setting');
    Route::get('get-pairs/{key}','\App\Http\Controllers\SettingController@getPairsByKey');
    Route::get('logout','\App\Http\Controllers\AuthController@logout');
    Route::get('myprofile','\App\Http\Controllers\FrontController@myProfile');
    Route::post('myprofile','\App\Http\Controllers\FrontController@updateMyProfile');
    Route::get('from-menus/{slug}','\App\Http\Controllers\FrontController@fromMenus');
    Route::post('add-setting','\App\Http\Controllers\SettingController@addSetting');
    Route::post('add-setting/return-view','\App\Http\Controllers\SettingController@addSettingReturnView');
    Route::post('remove-setting/return-view','\App\Http\Controllers\SettingController@removeSettingReturnView');
    Route::post('sort-setting','\App\Http\Controllers\SettingController@sortSetting');
    Route::post('update-setting/{id}','\App\Http\Controllers\SettingController@updateSetting');
    Route::get('delete-setting/{id}','\App\Http\Controllers\SettingController@deleteSetting');
    Route::get('delete-account/{id}','\App\Http\Controllers\SettingController@deleteAccount');
    Route::post('add-account','\App\Http\Controllers\AccountController@add');
    Route::get('get-account/{id}','\App\Http\Controllers\AccountController@find');
    // Route::get('trade/{id}','\App\Http\Controllers\TradeController@detail');
    // Route::get('trade/edit/{id}','\App\Http\Controllers\TradeController@edit');
    Route::group(['prefix'=>"trade"],function(){
        Route::get('create-form','\App\Http\Controllers\TradeController@createForm');
        Route::get('edit-form/{id}','\App\Http\Controllers\TradeController@editForm');
        Route::post('save/{id}','\App\Http\Controllers\TradeController@save');
        Route::post('create','\App\Http\Controllers\TradeController@create');
        Route::get('list','\App\Http\Controllers\TradeController@list');
        Route::get('setting','\App\Http\Controllers\TradeController@setting');
        Route::get('detail/{id}','\App\Http\Controllers\TradeController@detail');
        Route::get('edit/{id}','\App\Http\Controllers\TradeController@edit');
        Route::get('delete/{id}','\App\Http\Controllers\TradeController@delete');
        Route::get('mistake-notes','\App\Http\Controllers\MistakeNotesController@mistakeNotes');
        Route::post('mistake-notes-action/{id}','\App\Http\Controllers\MistakeNotesController@updateAction');
        Route::post('mistake-notes','\App\Http\Controllers\MistakeNotesController@createMistakeNotes');
        Route::post('mistake-notes/{id}','\App\Http\Controllers\MistakeNotesController@update');
        Route::get('mistake-notes/view-edit/{id}','\App\Http\Controllers\MistakeNotesController@viewEdit');
        Route::get('mistake-notes/delete/{id}','\App\Http\Controllers\MistakeNotesController@delete');
    });

    Route::group(['prefix'=>"dashboard"],function(){
        Route::get('pnl','\App\Http\Controllers\DashboardController@pnl');
        Route::get('active-accounts','\App\Http\Controllers\DashboardController@activeAccount');
        Route::get('weekly-pnl','\App\Http\Controllers\DashboardController@weeklyPnl');
        Route::get('monthly-pnl','\App\Http\Controllers\DashboardController@monthlyPnl');
        Route::get('execution','\App\Http\Controllers\DashboardController@execution');
        Route::get('top-orders','\App\Http\Controllers\DashboardController@topOrders');
        Route::get('openClose','\App\Http\Controllers\DashboardController@openClose');
        Route::get('montlyWinLoss','\App\Http\Controllers\DashboardController@montlyWinLoss');
        
    });

    Route::group(['prefix'=>"motivation"],function(){
        Route::get('view/{id}','\App\Http\Controllers\MotivationController@view');

    });
    Route::group(['prefix'=>"news"],function(){
        Route::get('view/{id}','\App\Http\Controllers\NewsController@view');

    });
    Route::group(['prefix'=>"like"],function(){
        Route::post('updateOrAdd','\App\Http\Controllers\LikeController@updateOrAdd');

    });
    Route::group(['prefix'=>"forums"],function(){
        Route::get('/','\App\Http\Controllers\ForumsController@home');
        Route::get('latest','\App\Http\Controllers\ForumsController@latest');
        Route::get('pop','\App\Http\Controllers\ForumsController@pop');
        Route::get('{id}','\App\Http\Controllers\ForumsController@detail');
        Route::get('post-form/{id}','\App\Http\Controllers\ForumsController@postForm');
        Route::post('post','\App\Http\Controllers\ForumsController@post');

    });
    Route::post('contact-us','\App\Http\Controllers\GeneralController@contact');
    
});

Route::get('auth/redirect','\App\Http\Controllers\AuthController@redirect');

Route::group(['prefix' => 'admin','middleware'=>['backend.area']], function () {
    Voyager::routes();
    Route::group(['prefix'=>"motivations",'middleware'=>['admin.user']],function(){
        Route::get('/','\App\Http\Controllers\MotivationController@index');
        Route::get('create','\App\Http\Controllers\MotivationController@create');
        Route::post('add','\App\Http\Controllers\MotivationController@add');
    });
    Route::group(['prefix'=>"forums-categories",'middleware'=>['admin.user']],function(){
        Route::get('/','\App\Http\Controllers\ForumsCategoriesController@index');
        Route::get('create','\App\Http\Controllers\ForumsCategoriesController@create');
        Route::post('add','\App\Http\Controllers\ForumsCategoriesController@add');
        Route::get('edit/{id}','\App\Http\Controllers\ForumsCategoriesController@edit'); 
        Route::post('save/{id}','\App\Http\Controllers\ForumsCategoriesController@save'); 
        Route::get('delete/{id}','\App\Http\Controllers\ForumsCategoriesController@delete');
        
    });
    
});
