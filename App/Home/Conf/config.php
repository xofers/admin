<?php
return array(

    /* 主题设置 */
    'DEFAULT_THEME' =>  'default',  // 默认模板主题名称
    
    /* 数据缓存设置 */
    'DATA_CACHE_PREFIX' => 'semeizizhi_', // 缓存前缀
    'DATA_CACHE_TYPE'   => 'File', // 数据缓存类型
    
    /* SESSION 和 COOKIE 配置 */
    'SESSION_PREFIX' => 'semeizizhi_home', //session前缀
    'COOKIE_PREFIX'  => 'semeizizhi_home_', // Cookie前缀 避免冲突
    
    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
    	'__STATIC__'   => __ROOT__ . '/Public/Static',
        '__IMG__'    => '/Public/' . MODULE_NAME . '/Img',
        '__CSS__'    =>	'/Public/' . MODULE_NAME . '/Css',
        '__JS__'     => '/Public/' . MODULE_NAME . '/Js',
    ),
);