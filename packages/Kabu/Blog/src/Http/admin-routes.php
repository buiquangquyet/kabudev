<?php

Route::group(['middleware' => ['web', 'admin']], function () {

    Route::get('/admin/blog', 'Kabu\Blog\Http\Controllers\Admin\BlogController@index')->defaults('_config', [
        'view' => 'blog::admin.index',
    ])->name('blog.admin.index');
});
