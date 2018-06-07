<?php


use think\facade\Route;

Route::group('api', function(){

    //用户相关(不需验证)
    Route::group('user', function(){

        //注册
        Route::any('register', 'api/UserController/register');

        //登录
        Route::any('login', 'api/UserController/login');
    });

    //用户相关(需验证)
    Route::group('user', function(){

        Route::any('info', 'api/UserController/info');
    })->middleware('apiAuth');


    //书编辑相关(需验证)
    Route::group('book/edit', function(){

        //获得我的作品
        Route::any('my', 'api/BookEditController/getMyWorks');

        //添加书
        Route::any('add', 'api/BookEditController/add');

        //指定书操作
        Route::group(':id', function(){

            //删除书
            Route::any('remove', 'api/BookEditController/remove');
        })->pattern('id', '\d+');
    })->middleware('apiAuth');


    //书相关(不需验证)
    Route::group('book', function(){

        //获得书内容
        Route::any(':id', 'api/BookController/getItems')
            ->pattern('id', '\d+');

        //取得书列表
        Route::any('/', 'api/BookController/getList');
        Route::any('all', 'api/BookController/getList');
        Route::any(':type', 'api/BookController/getList');
    });


});