<?php
/**
 * Contains web routes for Laracrumbs.
 *
 * @package Laracrumbs
 */
Route::group(['middleware' => ['web']], function() {
    Route::get('/laracrumbs', [
        'as'   => 'laracrumbsHome',
        'uses' => 'Laracrumbs\Http\Controllers\LaracrumbsController@home',
    ]);
});
