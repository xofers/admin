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
        '__STATIC__'   => __ROOT__ . '/Public/Static',
   		'__SCRIPTS__'  => __ROOT__.'/Public/' . MODULE_NAME . '/scripts',
   		'__ADDONS__'   => __ROOT__.'/Public/' . MODULE_NAME . '/Addons',
        '__IMG__'      => __ROOT__.'/Public/' . MODULE_NAME . '/images',
        '__CSS__'      => __ROOT__.'/Public/' . MODULE_NAME . '/css',
        '__JS__'       => __ROOT__.'/Public/' . MODULE_NAME . '/js',
    ),
    
	/* SESSION 和 COOKIE 配置 */
    'SESSION_PREFIX' => 'max_admin_session', // session前缀
    'COOKIE_PREFIX'  => 'max_admin_cookie', // Cookie前缀 避免冲突
    
    
    /* 文件上传相关配置 */
    'DOWNLOAD_UPLOAD' => array(
        'mimes'    => '', //允许上传的文件MiMe类型
        'maxSize'  => 5*1024*1024, //上传的文件大小限制 (0-不做限制)
        'exts'     => 'jpg,gif,png,jpeg,zip,rar,tar,gz,7z,doc,docx,txt,xml', //允许上传的文件后缀
        'autoSub'  => true, //自动子目录保存文件
        'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => './Uploads/Download/', //保存根路径
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'  => '', //文件保存后缀，空则使用原后缀
        'replace'  => false, //存在同名是否覆盖
        'hash'     => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //下载模型上传配置（文件上传类配置）

    /* 图片上传相关配置 */
    'PICTURE_UPLOAD' => array(
		'mimes'    => '', //允许上传的文件MiMe类型
		'maxSize'  => 2*1024*1024, //上传的文件大小限制 (0-不做限制)
		'exts'     => 'jpg,gif,png,jpeg', //允许上传的文件后缀
		'autoSub'  => true, //自动子目录保存文件
		'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
		'rootPath' => './Uploads/Picture/', //保存根路径
		'savePath' => '', //保存路径
		'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
		'saveExt'  => '', //文件保存后缀，空则使用原后缀
		'replace'  => false, //存在同名是否覆盖
		'hash'     => true, //是否生成hash编码
		'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //图片上传相关配置（文件上传类配置）

    'PICTURE_UPLOAD_DRIVER'=>'local',
    //本地上传文件驱动配置
    'UPLOAD_LOCAL_CONFIG'=>array(),
    'UPLOAD_BCS_CONFIG'=>array(
        'AccessKey'=>'',
        'SecretKey'=>'',
        'bucket'=>'',
        'rename'=>false
    ),
    'UPLOAD_QINIU_CONFIG'=>array(
        'accessKey'=>'__ODsglZwwjRJNZHAu7vtcEf-zgIxdQAY-QqVrZD',
        'secrectKey'=>'Z9-RahGtXhKeTUYy9WCnLbQ98ZuZ_paiaoBjByKv',
        'bucket'=>'onethinktest',
        'domain'=>'onethinktest.u.qiniudn.com',
        'timeout'=>3600,
    ),


    /* 编辑器图片上传相关配置 */
    'EDITOR_UPLOAD' => array(
		'mimes'    => '', //允许上传的文件MiMe类型
		'maxSize'  => 2*1024*1024, //上传的文件大小限制 (0-不做限制)
		'exts'     => 'jpg,gif,png,jpeg', //允许上传的文件后缀
		'autoSub'  => true, //自动子目录保存文件
		'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
		'rootPath' => './Uploads/Editor/', //保存根路径
		'savePath' => '', //保存路径
		'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
		'saveExt'  => '', //文件保存后缀，空则使用原后缀
		'replace'  => false, //存在同名是否覆盖
		'hash'     => true, //是否生成hash编码
		'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ),
    
//  /* 模板引擎设置 */
//  'TMPL_ACTION_ERROR'     =>  './App/Admin/View/default/Public/error.htm', // 默认错误跳转对应的模板文件
//  'TMPL_ACTION_SUCCESS'   =>  './App/Admin/View/default/Public/success.htm', // 默认成功跳转对应的模板文件
//  'TMPL_EXCEPTION_FILE'   =>  './App/Admin/View/default/Public/exception.htm',// 异常页面的模板文件
);