<?php

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

Auth::routes();

Route::get('/', 'IndexController@index');

// Public pages on tests
Route::any('/tests/search', 'TestsController@search');
Route::get('/tests/{id}/apparatus', 'TestsController@apparatus');
Route::get('/tests/{id}/sample', 'TestsController@sample');
Route::get('/tests/{id}/procedure', 'TestsController@procedure');
Route::get('/tests/{id}/calculation', 'TestsController@calculation');
Route::get('/tests/{id}/report', 'TestsController@report');
Route::resource('/tests', 'TestsController');

// HomeController routes
    Route::prefix('dashboard')->group(function () {
// User info
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('/edit', 'HomeController@edit_user')->name('edit_user');
    Route::put('/update', 'HomeController@update_user')->name('update_user');
// Tests
    Route::get('/tests', 'HomeController@tests');
    Route::get('/tests/create', 'HomeController@create_test');
    Route::post('/tests/store', 'HomeController@store_test');
    Route::get('/tests/{id}/show', 'HomeController@show_test')->name('dashboard.show_test');
    Route::get('/tests/{id}/edit', 'HomeController@edit_test')->name('dashboard.edit_test');
    Route::put('/tests/{id}/update', 'HomeController@update_test');
    Route::get('/tests/{id}/delete', 'HomeController@delete_test')->name('dashboard.delete_test');
// Testworks
    Route::get('/testworks', 'HomeController@testworks');
    Route::get('/select-test', 'HomeController@select_test');
    Route::post('/create-testwork', 'HomeController@create_testwork');
// Direct Shear
    Route::get('/direct-shear/records', 'TestWorks\DirectShearController@records');
    Route::post('/direct-shear/create', 'TestWorks\DirectShearController@create');
    Route::post('/direct-shear/store', 'TestWorks\DirectShearController@store');
    Route::get('/direct-shear/{id}/show', 'TestWorks\DirectShearController@show');
    Route::get('/direct-shear/{id}/edit', 'TestWorks\DirectShearController@edit');
    Route::put('/direct-shear/{id}/update', 'TestWorks\DirectShearController@update');
    Route::get('/direct-shear/{id}/delete', 'TestWorks\DirectShearController@delete');
    Route::get('/direct-shear/{id}/analyze', 'TestWorks\DirectShearController@analyze');
    Route::get('/direct-shear/{id}/create-word', 'TestWorks\DirectShearController@generate_word');
// UCS
    Route::get('/ucs/records', 'TestWorks\UCSController@records');
    Route::post('/ucs/create', 'TestWorks\UCSController@create');
    Route::post('/ucs/store', 'TestWorks\UCSController@store');
    Route::get('/ucs/{id}/show', 'TestWorks\UCSController@show');
    Route::get('/ucs/{id}/edit', 'TestWorks\UCSController@edit');
    Route::put('/ucs/{id}/update', 'TestWorks\UCSController@update');
    Route::get('/ucs/{id}/delete', 'TestWorks\UCSController@delete');
    Route::get('/ucs/{id}/analyze', 'TestWorks\UCSController@analyze');
    Route::get('/ucs/{id}/create-word', 'TestWorks\UCSController@generate_word')->name('ucs.generate_word');
// SPT
    Route::get('/spt/records', 'TestWorks\SPTController@records');
    Route::post('/spt/create', 'TestWorks\SPTController@create');
    Route::post('/spt/store', 'TestWorks\SPTController@store');
    Route::get('/spt/{id}/show', 'TestWorks\SPTController@show');
    Route::get('/spt/{id}/edit', 'TestWorks\SPTController@edit');
    Route::put('/spt/{id}/update', 'TestWorks\SPTController@update');
    Route::get('/spt/{id}/delete', 'TestWorks\SPTController@delete');
    Route::get('/spt/{id}/analyze', 'TestWorks\SPTController@analyze');
    Route::get('/spt/{id}/create-word', 'TestWorks\SPTController@generate_word');
    // Borehole Log
    Route::get('/log/create', 'TestWorks\BoreholeLogController@create');
    Route::post('/log/store', 'TestWorks\BoreholeLogController@store');
    Route::get('/log/{id}/show', 'TestWorks\BoreholeLogController@show');
    Route::get('/log/{id}/edit', 'TestWorks\BoreholeLogController@edit');
    Route::put('/log/{id}/update', 'TestWorks\BoreholeLogController@update');
    Route::get('/log/{id}/delete', 'TestWorks\BoreholeLogController@delete');
    Route::get('/log/{id}/analyze', 'TestWorks\BoreholeLogController@analyze');
    Route::get('/log/{id}/create-word', 'TestWorks\BoreholeLogController@generate_word');
});
