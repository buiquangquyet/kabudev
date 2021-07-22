<?php

Route::group(['middleware' => ['web', 'theme', 'locale', 'currency']], function () {

    Route::get('/blog', 'Kabu\Blog\Http\Controllers\Shop\BlogController@index')->defaults('_config', [
        'view' => 'blog::shop.index',
    ])->name('blog.shop.index');

});