<?php
Route::post('contato', 'HomeController@postContato');




/* * ************************
 *  Lottery Route
 * ************************ */
Route::group(
    [ 'prefix' => 'mobile'], function () {
        Route::get('index', ['as' => 'mobile.lottery', 'uses' => 'LotteryController@getIndex']);
        Route::post('scratch', ['as' => 'mobile.scratch', 'uses' => 'LotteryController@postMobileScratch']);
        Route::get('scratch', ['as' => 'mobile.result', 'uses' => 'LotteryController@getMobileScratch']);
        Route::post('egg', ['as' => 'mobile.egg', 'uses' => 'LotteryController@postMobileEgg']);
        Route::get('egg', ['as' => 'mobile.getEgg', 'uses' => 'LotteryController@getMobileEgg']);
    }
);

/* * ************************
 *  Admin Route
 * ************************ */
Route::group(
    [ 'before' => 'auth'], function () {
        Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@dashBoard']);
        Route::get('rate', ['as' => 'gifts.rate', 'uses' => 'GiftsController@getTestRate']);

        Route::resource('gifts', 'GiftsController');
        Route::resource('confs', 'ConfsController');
        Route::resource('accounts', 'AccountsController');
        Route::resource('winnerlogs', 'WinnerLogsController');
    }
);


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(
    ['middleware' => ['siravel-analytics']], function () {
        $s = 'public.';
        Route::get('/', ['as' => $s . 'home',   'uses' => 'PagesController@getHome']);
        Route::get('contato', array('as' => $s . 'contact', 'uses' =>'PagesController@contact'));
        Route::post('/contact', ['as' => $s . 'contact',   'uses' => 'PagesController@postContact']);
    }
);

$s = 'social.';
Route::get('/social/redirect/{provider}', ['as' => $s . 'redirect',   'uses' => 'Auth\SocialController@getSocialRedirect']);
Route::get('/social/handle/{provider}', ['as' => $s . 'handle',     'uses' => 'Auth\SocialController@getSocialHandle']);

Route::group(
    ['prefix' => 'admin', 'middleware' => 'auth:administrator'], function () {
        $a = 'admin.';
        Route::get('/', ['as' => $a . 'home', 'uses' => 'Admin\AppController@dashboard']);
    
        Route::resource('users', 'Admin\UserController');
        Route::resource('permissions', 'Admin\PermissionController');
        Route::resource('roles', 'Admin\RoleController');
    }
);

Route::group(
    ['prefix' => 'user', 'middleware' => 'auth:user'], function () {
        $a = 'user.';
        Route::get('/', ['as' => $a . 'home', 'uses' => 'UserController@getHome']);

        Route::group(
            ['middleware' => 'activated'], function () {
                $m = 'activated.';
                Route::get('protected', ['as' => $m . 'protected', 'uses' => 'UserController@getProtected']);
            }
        );
    }
);

Route::group(
    ['middleware' => 'auth:all'], function () {
        $a = 'authenticated.';
        Route::get('/logout', ['as' => $a . 'logout', 'uses' => 'Auth\LoginController@logout']);
        Route::get('/activate/{token}', ['as' => $a . 'activate', 'uses' => 'ActivateController@activate']);
        Route::get('/activate', ['as' => $a . 'activation-resend', 'uses' => 'ActivateController@resend']);
        Route::get(
            'not-activated', ['as' => 'not-activated', 'uses' => function () {
                return view('errors.not-activated');
            }]
        );
    }
);


Auth::routes(['login' => 'auth.login']);
