<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');
Route::get('api/:version/token/user','api/:version.Token/getToken');

Route::get('api/:version/lastdistance','api/:version.Distance/lastdistance');
Route::get('api/:version/distance/previous','api/:version.Distance/previous');
Route::get('api/:version/distance/next','api/:version.Distance/next');
Route::post('api/:version/albums/add_short_comment','api/:version.Albums/addShortComment');
Route::get('api/:version/albums/:aid/short_comment','api/:version.Albums/getShortComment');
Route::get('api/:version/albums','api/:version.Albums/albums');
Route::get('api/:version/albumDetail/:id','api/:version.Albums/detail');



return [

];
