<?php
// 应用入口文件
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);

//缓存目录
define ( 'RUNTIME_PATH', './Runtime/' );

// 定义应用目录
define('APP_PATH','./App/');

// 引入ThinkPHP入口文件
require './Core/ThinkPHP.php';
