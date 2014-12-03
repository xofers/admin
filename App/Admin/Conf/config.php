<?php
return array(
    /* 主题设置 */
    'DEFAULT_THEME'     => 'default', // 默认模板主题名称

    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__IMG__' => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
        '__CSS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
        '__JS__'  => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
   		'__SCRIPTS__'  => __ROOT__ . '/Public/' . MODULE_NAME . '/scripts'
    ),

//  /*Auth权限设置*/
//  'AUTH_CONFIG'       => array(
//      'AUTH_ON'           => true, // 认证开关
//      'AUTH_TYPE'         => 1, // 认证方式，1为实时认证；2为登录认证。
//      'AUTH_GROUP'        => 'car_auth_group', // 用户组数据表名
//      'AUTH_GROUP_ACCESS' => 'car_auth_group_access', // 用户-用户组关系表
//      'AUTH_RULE'         => 'car_auth_rule', // 权限规则表
//      'AUTH_USER'         => 'car_admin_user', // 用户信息表
//  ),
    
//  /* 模板引擎设置 */
//  'TMPL_ACTION_ERROR'     =>  './App/Admin/View/default/Public/error.htm', // 默认错误跳转对应的模板文件
//  'TMPL_ACTION_SUCCESS'   =>  './App/Admin/View/default/Public/success.htm', // 默认成功跳转对应的模板文件
//  'TMPL_EXCEPTION_FILE'   =>  './App/Admin/View/default/Public/exception.htm',// 异常页面的模板文件
);