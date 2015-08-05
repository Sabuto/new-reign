<?php

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    Route::get('/', 'PagesController@index');

    Route::get('travel', ['as' => 'travel', 'uses' => 'PagesController@travelForm']);
    Route::post('travel', ['as' => 'travelPost', 'uses' => 'PagesController@travel']);
    Route::get('vehicles', ['as' => 'vehicle', 'uses' => 'PagesController@vehicles']);
    Route::post('vehicles', ['as' => 'vehiclePost', 'uses' => 'PagesController@vehiclePost']);
    Route::get('city', 'PagesController@inCity');

    Route::controllers([
        'auth'     => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);

    Route::post('hookers/buy', 'HookerController@buy');
    Route::resource('hookers', 'HookerController');

    Route::get('events/{events}/send', [
        'as'   => 'events.form',
        'uses' => 'EventController@sendForm'
    ]);
    Route::post('events/{events}/send', [
        'as'   => 'events.send',
        'uses' => 'EventController@send'
    ]);
    Route::resource('events', 'EventController');

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'AdminController@index']);
        Route::get('event', ['as' => 'admin.event', 'uses' => 'AdminController@event']);
        Route::post('event', ['as' => 'admin.eventStore', 'uses' => 'AdminController@storeEvent']);
        Route::get('assassination', ['as' => 'admin.assassination', 'uses' => 'AdminController@assassinationTargets']);
        Route::get('ranks', ['as' => 'admin.ranks', 'uses' => 'AdminController@viewRanks']);
        Route::get('vehicles', ['as' => 'admin.vehicles', 'uses' => 'AdminController@viewVehicles']);
    });

    Route::resource('news', 'NewsController', ['except' => 'show']);

    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
        Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
        Route::get('{id}/read', ['as' => 'messages.read', 'uses' => 'MessagesController@read']);
        Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
        Route::get('unread', ['as' => 'messages.unread', 'uses' => 'MessagesController@unread']);
        Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
        Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
    });

    Route::group(['prefix' => 'assassination'], function () {
        Route::get('/', ['as' => 'assassination.index', 'uses' => 'AssassinationController@index']);
        Route::post('/', ['as' => 'assassination.kill', 'uses' => 'AssassinationController@kill']);
    });
