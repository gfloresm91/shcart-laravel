<?php

//Productos
Route::get('/', [
    'uses' => 'ProductController@index',
    'as' => 'product.index'
]);

Route::get('productos', [
    'uses' => 'ProductController@productos',
    'as' => 'product.productos'
]);

Route::get('detalle-producto/{id}', [
    'uses' => 'ProductController@productodetalle',
    'as' => 'product.productodetalle'
]);

Route::get('marca/{id}', [
    'uses' => 'ProductController@marca',
    'as' => 'product.marca'
]);

//Compras
Route::group(['prefix' => 'compras'], function() {
    
    Route::get('comprar', [
        'uses' => 'ProductController@comprar',
        'as' => 'product.comprar',
        'middleware' => 'auth'
    ]);

    Route::post('comprar', [
        'uses' => 'ProductController@postcomprar',
        'as' => 'product.postcomprar',
        'middleware' => 'auth'
    ]);
    
    
    Route::get('anadir-al-carro/{id}', [
    'uses' => 'ProductController@anadiralcarro',
    'as' => 'product.anadiralcarro'
    ]);
    Route::post('anadir-al-carro', [
    'uses' => 'ProductController@postanadiralcarro',
    'as' => 'product.postanadiralcarro'
    ]);
    Route::get('remover-un-item/{id}', [
    'uses' => 'ProductController@removerunitemcarro',
    'as' => 'product.removerunitemcarro'
    ]);
    Route::get('remover-item/{id}', [
    'uses' => 'ProductController@removeritemcarro',
    'as' => 'product.removeritemcarro'
    ]);
    Route::get('carro', [
        'uses' => 'ProductController@carro',
        'as' => 'product.carro'
    ]);
});

//Usuario
Route::group(['prefix' => 'usuario'], function() {
    Route::group(['middleware' => 'guest'], function() {
        Route::get('login' , 'UserController@login')->name('user.login');
        Route::post('login' , 'UserController@postlogin')->name('user.postlogin');
        Route::get('login/{provider}', 'UserController@redirectToProvider')->name('user.sociallogin');
        Route::get('login/{provider}/callback', 'UserController@handleProviderCallback')->name('user.socialcallback');
    });
    Route::group(['middleware' => 'auth'], function() {
        Route::get('perfil' , 'UserController@perfil')->middleware('auth')->name('user.perfil');
        Route::get('logout' , 'UserController@logout')->name('user.logout');
    });
});

//Busqueda
Route::get('/search', 'ProductController@search')->name('product.search');