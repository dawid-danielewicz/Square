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
Route::get('/', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function() {
    Route::get('/store', 'StoreController@index')->name('store');
    Route::get('/store/category/add', 'StoreController@addCategory')->name('addCategory');
    Route::post('/store/category/create', 'StoreController@storeCategory')->name('createCategory');
    Route::get('/store/category/{id}/edit', 'StoreController@editCategory')->name('editCategory');
    Route::post('/store/category/update/{id}', 'StoreController@storeCategory')->name('updateCategory');
    Route::get('/store/category/delete/{id}', 'StoreController@deleteCategory')->name('deleteCategory');
    Route::post('/store/products/create', 'StoreController@storeProduct')->name('createProduct');
    Route::get('/store/products/{id}/edit', 'StoreController@editProduct')->name('editProduct');
    Route::post('/store/products/{id}/search/results', 'StoreController@productsResults')->name('productsResults');
    Route::get('/store/products/{id}/search', 'StoreController@searchProducts')->name('searchProducts');
    Route::post('/store/products/update/{id}', 'StoreController@storeProduct')->name('updateProduct');
    Route::get('/store/products/delete{id}', 'StoreController@deleteProduct')->name('deleteProduct');
    Route::get('/store/products/{id}/{name}', 'StoreController@showProducts')->name('showProducts');
    Route::get('/store/products/add', 'StoreController@addProduct')->name('addProduct');
    Route::get('/store/accessories/{id}/edit', 'StoreController@editAccessory')->name('editAccessory');
    Route::post('/store/accessories/search/results', 'StoreController@accessoriesResults')->name('accessoriesResults');
    Route::get('/store/accessories/search', 'StoreController@searchAccessories')->name('searchAccessories');
    Route::post('/store/accessories/update/{id}', 'StoreController@storeAccessory')->name('updateAccessory');
    Route::get('/store/accessories/delete{id}', 'StoreController@deleteAccessory')->name('deleteAccessory');
    Route::get('/store/accessories/{id}/{name}', 'StoreController@showPAccessory')->name('showAccessory');
    Route::get('/store/accessories/add', 'StoreController@addAccessory')->name('addAccessory');
    Route::post('/store/accessories/create', 'StoreController@storeAccessory')->name('createAccessory');
    Route::get('/store/accessories', 'StoreController@showAccessories')->name('showAccessories');

    Route::get('/sets/add', 'SetController@add')->name('addSet');
    Route::get('/sets/search', 'SetController@searchSets')->name('searchSets');
    Route::post('/sets/search/result', 'SetController@searchResults')->name('setsResults');
    Route::post('/sets/create', 'SetController@store')->name('createSet');
    Route::post('/sets/update/{id}', 'SetController@store')->name('updateSet');
    Route::post('/sets/update_set_store/{id}', 'SetController@setStore')->name('updateSetStore');
    Route::get('/sets/{id}/edit', 'SetController@edit')->name('editSet');
    Route::get('/sets/delete/{id}', 'SetController@delete')->name('deleteSet');
    Route::get('/sets/{id}', 'SetController@show')->name('showSet');
    Route::get('/sets', 'SetController@index')->name('sets');

    Route::get('/wholesales/add', 'WholesaleController@add')->name('addWholesale');
    Route::post('/wholesales/update/{id}', 'WholesaleController@store')->name('updateWholesale');
    Route::get('/wholesales/delete/{id}', 'WholesaleController@delete')->name('deleteWholesale');
    Route::get('/wholesales/{id}/edit', 'WholesaleController@edit')->name('editWholesale');
    Route::get('/wholesales/{id}/{name}', 'WholesaleController@show')->name('wholesaleShow');
    Route::post('/wholesales/create', 'WholesaleController@store')->name('createWholesale');

    Route::get('/wholesales', 'WholesaleController@index')->name('wholesales');

    Route::get('/sell', 'SellController@index')->name('sell');
    Route::post('/sell/sets/{id}', 'SellController@sellSet')->name('sellSet');
    Route::get('/sell/sets/search', 'SellController@searchSet')->name('searchSellSet');
    Route::post('/sell/sets/search/result', 'SellController@setResults')->name('sellSetsResults');
    Route::get('/sell/sets/stats', 'SellController@setsStats')->name('setsStats');
    Route::get('/sell/sets', 'SellController@showSets')->name('sellSets');
    Route::post('/sell/products/{id}', 'SellController@sellProduct')->name('sellProduct');
    Route::get('/sell/products/search', 'SellController@searchProduct')->name('searchSellProduct');
    Route::post('/sell/products/search/result', 'SellController@productResults')->name('sellProductsResults');
    Route::get('/sell/products/stats', 'SellController@productsStats')->name('productsStats');
    Route::get('/sell/products', 'SellController@showProducts')->name('sellProducts');
    Route::post('/sell/accessories/{id}', 'SellController@sellAccessory')->name('sellAccessory');
    Route::get('/sell/accessories/search', 'SellController@searchAccessory')->name('searchSellAccessory');
    Route::get('/sell/accessories/stats', 'SellController@accessoriesStats')->name('accessoriesStats');
    Route::post('/sell/accessories/search/result', 'SellController@accessoryResults')->name('sellAccessoriesResults');
    Route::get('/sell/accessories', 'SellController@showAccessories')->name('sellAccessories');

    Route::get('/notes/add', 'NotesController@addNote')->name('addNote');
    Route::get('/notes/search', 'NotesController@searchNote')->name('searchNote');
    Route::post('/notes/search/result', 'NotesController@searchResult')->name('noteResult');
    Route::post('/notes/create', 'NotesController@store')->name('createNote');
    Route::get('/notes/{id}/edit', 'NotesController@editNote')->name('editNote');
    Route::post('/notes/update/{id}', 'NotesController@store')->name('updateNote');
    Route::get('/notes/delete/{id}', 'NotesController@delete')->name('deleteNote');
    Route::get('/notes', 'NotesController@index')->name('notes');

    Route::get('/user/edit', 'UserController@edit')->name('editUser');
    Route::post('/user/update', 'UserController@store')->name('updateUser');
});


Auth::routes();


