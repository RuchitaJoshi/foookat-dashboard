<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.c
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::group(['namespace' => 'Auth'], function() {
        Route::get('login', 'AuthController@showLoginForm');

        Route::post('login', 'AuthController@login');

        Route::get('logout', 'AuthController@logout');

        Route::post('password/email', 'PasswordController@sendResetLinkEmail');

        Route::post('password/reset', 'PasswordController@reset');

        Route::get('password/reset/{token?}', 'PasswordController@showResetForm');
    });

    Route::group(['namespace' => 'Dashboard','prefix' => 'dashboard'], function() {
        Route::get('dashboard', ['as' => 'dashboard',  'uses' => 'DashboardController@index']);
    });

    Route::group(['namespace' => 'Admin','prefix' => 'admins'], function() {
        Route::get('all', ['as' => 'admins.all',  'uses' => 'AdminController@all']);

        Route::get('create', ['as' => 'admins.create',  'uses' => 'AdminController@create']);

        Route::post('store', ['as' => 'admins.store', 'uses' => 'AdminController@store']);

        Route::get('all/{id}/edit',  ['as' => 'admins.edit', 'uses' => 'AdminController@edit']);

        Route::get('all/{id}/show',  ['as' => 'admins.show', 'uses' => 'AdminController@show']);

        Route::patch('all/{id}',  ['as' => 'admins.update', 'uses' => 'AdminController@update']);

        Route::delete('destroy/{id}',  ['as' => 'admins.destroy', 'uses' => 'AdminController@destroy']);
    });

    Route::group(['namespace' => 'Business','prefix' => 'businesses'], function() {
        Route::get('all', ['as' => 'businesses.all',  'uses' => 'BusinessController@all']);

        Route::get('create', ['as' => 'businesses.create',  'uses' => 'BusinessController@create']);

        Route::post('store', ['as' => 'businesses.store', 'uses' => 'BusinessController@store']);

        Route::post('cities', ['as' => 'businesses.cities', 'uses' => 'BusinessController@cities']);

        Route::get('all/{id}/edit',  ['as' => 'businesses.edit', 'uses' => 'BusinessController@edit']);

        Route::get('all/{id}/show',  ['as' => 'businesses.show', 'uses' => 'BusinessController@show']);

        Route::patch('all/{id}',  ['as' => 'businesses.update', 'uses' => 'BusinessController@update']);

        Route::delete('destroy/{id}',  ['as' => 'businesses.destroy', 'uses' => 'BusinessController@destroy']);

        Route::get('all/{id}/stores',  ['as' => 'businesses.stores', 'uses' => 'BusinessController@stores']);

        Route::get('all/{id}/stores/create',  ['as' => 'businesses.stores.create', 'uses' => 'BusinessController@createStore']);

        Route::post('all/{id}/stores/store',  ['as' => 'businesses.stores.store', 'uses' => 'BusinessController@storeStore']);

        Route::get('all/{business_id}/stores/{store_id}/edit',  ['as' => 'businesses.stores.edit', 'uses' => 'BusinessController@editStore']);

        Route::get('all/{business_id}/stores/{store_id}/show',  ['as' => 'businesses.stores.show', 'uses' => 'BusinessController@showStore']);

        Route::patch('all/{business_id}/stores/{store_id}',  ['as' => 'businesses.stores.update', 'uses' => 'BusinessController@updateStore']);

        Route::delete('destroy/{business_id}/stores/{store_id}',  ['as' => 'businesses.stores.destroy', 'uses' => 'BusinessController@destroyStore']);
    });

    Route::group(['namespace' => 'Category','prefix' => 'categories'], function() {
        Route::get('all', ['as' => 'categories.all',  'uses' => 'CategoryController@all']);

        Route::get('create', ['as' => 'categories.create',  'uses' => 'CategoryController@create']);

        Route::post('store', ['as' => 'categories.store', 'uses' => 'CategoryController@store']);

        Route::get('all/{id}/edit',  ['as' => 'categories.edit', 'uses' => 'CategoryController@edit']);

        Route::get('all/{id}/show',  ['as' => 'categories.show', 'uses' => 'CategoryController@show']);

        Route::patch('all/{id}',  ['as' => 'categories.update', 'uses' => 'CategoryController@update']);

        Route::delete('destroy/{id}',  ['as' => 'categories.destroy', 'uses' => 'CategoryController@destroy']);
    });

    Route::group(['namespace' => 'User','prefix' => 'users'], function() {
        Route::get('all', ['as' => 'users.all',  'uses' => 'UserController@all']);

        Route::get('create', ['as' => 'users.create', 'uses' => 'UserController@create']);

        Route::post('store', ['as' => 'users.store', 'uses' => 'UserController@store']);

        Route::get('all/{id}/edit',  ['as' => 'users.edit', 'uses' => 'UserController@edit']);

        Route::get('all/{id}/show',  ['as' => 'users.show', 'uses' => 'UserController@show']);

        Route::patch('all/{id}',  ['as' => 'users.update', 'uses' => 'UserController@update']);

        Route::delete('destroy/{id}',  ['as' => 'users.destroy', 'uses' => 'UserController@destroy']);
    });

    Route::group(['namespace' => 'Location','prefix' => 'locations'], function() {
        Route::get('states/all', ['as' => 'locations.states.all',  'uses' => 'LocationController@states']);

        Route::get('states/create', ['as' => 'locations.states.create',  'uses' => 'LocationController@createState']);

        Route::post('states/store', ['as' => 'locations.states.store', 'uses' => 'LocationController@storeState']);

        Route::get('states/all/{id}/edit',  ['as' => 'locations.states.edit', 'uses' => 'LocationController@editState']);

        Route::get('states/all/{id}/show',  ['as' => 'locations.states.show', 'uses' => 'LocationController@showState']);

        Route::patch('states/all/{id}',  ['as' => 'locations.states.update', 'uses' => 'LocationController@updateState']);

        Route::delete('states/destroy/{id}',  ['as' => 'locations.states.destroy', 'uses' => 'LocationController@destroyState']);

        Route::get('cities/all', ['as' => 'locations.cities.all',  'uses' => 'LocationController@cities']);

        Route::get('cities/create', ['as' => 'locations.cities.create',  'uses' => 'LocationController@createCity']);

        Route::post('cities/store', ['as' => 'locations.cities.store', 'uses' => 'LocationController@storeCity']);

        Route::get('cities/all/{id}/edit',  ['as' => 'locations.cities.edit', 'uses' => 'LocationController@editCity']);

        Route::get('cities/all/{id}/show',  ['as' => 'locations.cities.show', 'uses' => 'LocationController@showCity']);

        Route::patch('cities/all/{id}',  ['as' => 'locations.cities.update', 'uses' => 'LocationController@updateCity']);

        Route::delete('cities/destroy/{id}',  ['as' => 'locations.cities.destroy', 'uses' => 'LocationController@destroyCity']);
    });

    Route::group(['namespace' => 'MembershipPlan','prefix' => 'membershipPlans'], function() {
        Route::get('all', ['as' => 'membershipPlans.all',  'uses' => 'MembershipPlanController@all']);
    });

});
