<?php
/**
 * Contains web routes for Laracrumbs.
 *
 * @package Laracrumbs
 */
Route::group(['middleware' => ['web'], 'namespace'  => '\Laracrumbs\Http\Controllers'], function() {
    Route::get('/laracrumbs', [
        'as'   => 'laracrumbs_home',
        'uses' => 'AdminController@home',
    ]);
    Route::get('/laracrumbs/routes', [
        'as'   => 'laracrumbs_routes',
        'uses' => 'AdminController@routes',
    ]);
    Route::get('/laracrumbs/browse', [
        'as'   => 'laracrumbs_browse',
        'uses' => 'LaracrumbController@index',
    ]);
    Route::get('/laracrumbs/create', [
        'as'   => 'laracrumbs_create',
        'uses' => 'LaracrumbController@create',
    ]);
    Route::post('/laracrumbs/create', [
        'as'   => 'laracrumbs_store',
        'uses' => 'LaracrumbController@store',
    ]);
    Route::get('/laracrumbs/preview/{id}', [
        'as'   => 'laracrumbs_preview',
        'uses' => 'LaracrumbController@show',
    ]);
    Route::get('/laracrumbs/edit/{id}', [
        'as'   => 'laracrumbs_edit',
        'uses' => 'LaracrumbController@edit',
    ]);
    Route::post('/laracrumbs/edit/{id}', [
        'as'   => 'laracrumbs_update',
        'uses' => 'LaracrumbController@update',
    ]);
    Route::get('/laracrumbs/delete/{id}', [
        'as'   => 'laracrumbs_delete',
        'uses' => 'LaracrumbController@destroy',
    ]);
});
