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

use think\Route;

//Route::get('api','api/v1.distance/getLastDistance');
Route::get('api/:version/lastdistance', 'api/:version.Distance/getLastDistance');
Route::get('api/:version/distance/previous/:id','api/:version.Distance/previousDistance');
Route::get('api/:version/distance/next/:id','api/:version.Distance/nextDistance');

//
//
//Route::get('/',function(){
//    return 'Hello,world!';
//});
