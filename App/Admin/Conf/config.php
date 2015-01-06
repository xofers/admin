<?php
return array(
    /* 主题设置 */
    'DEFAULT_THEME'     => 'default', // 默认模板主题名称
    
    /* 数据缓存设置 */
    'DATA_CACHE_PREFIX'    => 'admin_', // 缓存前缀
    'DATA_CACHE_TYPE'      => 'File', // 数据缓存类型
    'URL_MODEL'            => 2, //URL模式

    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
   		'__SCRIPTS__'  => __ROOT__.'/Public/' . MODULE_NAME . '/scripts',
   		'__ADDONS__'   => __ROOT__.'/Public/' . MODULE_NAME . '/Addons',
        '__IMG__'      => __ROOT__.'/Public/' . MODULE_NAME . '/images',
        '__CSS__'      => __ROOT__.'/Public/' . MODULE_NAME . '/css',
        '__JS__'       => __ROOT__.'/Public/' . MODULE_NAME . '/js',
    ),
    
	/* SESSION 和 COOKIE 配置 */
    'SESSION_PREFIX' => 'max_admin_session', // session前缀
    'COOKIE_PREFIX'  => 'max_admin_cookie', // Cookie前缀 避免冲突
    
//  /* 模板引擎设置 */
//  'TMPL_ACTION_ERROR'     =>  './App/Admin/View/default/Public/error.htm', // 默认错误跳转对应的模板文件
//  'TMPL_ACTION_SUCCESS'   =>  './App/Admin/View/default/Public/success.htm', // 默认成功跳转对应的模板文件
//  'TMPL_EXCEPTION_FILE'   =>  './App/Admin/View/default/Public/exception.htm',// 异常页面的模板文件
);