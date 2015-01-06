<?php
/**
 * 系统配文件
 * 所有系统级别的配置
 */
return array(
    //数据库配置信息
    'DB_TYPE'              => 'mysql', // 数据库类型
    'DB_HOST'              => 'localhost', // 服务器地址
    'DB_NAME'              => 'admin', // 数据库名
    'DB_USER'              => 'root', // 用户名
    'DB_PWD'               => 'root', // 密码
    'DB_PORT'              => 3306, // 端口
    'DB_PREFIX'            => 'admin_', // 数据库表前缀
    'DB_CHARSET'           => 'utf8', // 字符集
    /* 系统数据加密设置 */
    'DATA_AUTH_KEY' => '@E}vrT.$+P_WL)z[lAIuCVyf2Kt>(*~Q=no|^Bak', //默认数据加密KEY
    /* 用户相关设置 */
    'USER_MAX_CACHE'       => 1000, //最大缓存用户数
    'USER_ADMINISTRATOR'   => 1, //管理员用户ID
    /* URL配置 */
    'URL_CASE_INSENSITIVE' => true, //默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL'            => 2, //URL模式
    'VAR_URL_PARAMS'       => '', // PATHINFO URL参数变量
    'URL_PATHINFO_DEPR'    => '/', //PATHINFO URL分割符
    /* 全局过滤配置 */
    'DEFAULT_FILTER'       => '', //全局过滤函数
    /* 默认模板文件后缀*/
    'TMPL_TEMPLATE_SUFFIX' => '.htm',
    /* 模块相关配置 */
    'AUTOLOAD_NAMESPACE' => array('Addons' => ONETHINK_ADDON_PATH), //扩展模块列表
	'MODULE_ALLOW_LIST' => array ('Home','Admin'),
    'DEFAULT_MODULE'     => 'Home',
//  'MODULE_DENY_LIST'   => array('Common','User'),
    /* 语言包 */
    'LANG_SWITCH_ON'       => true,
    'LANG_AUTO_DETECT'     => true, // 自动侦测语言 开启多语言功能后有效
    'LANG_LIST'            => 'zh-cn', // 允许切换的语言列表 用逗号分隔
    'VAR_LANGUAGE'         => 'l', // 默认语言切换变量
    /* 开启表单令牌*/
//  'TOKEN_ON'             => true, //是否开启令牌验证
//  'TOKEN_NAME'           => '__hash__',// 令牌验证的表单隐藏字段名称
//  'TOKEN_TYPE'           => 'md5',//令牌验证哈希规则
//  'TOKEN_RESET'          => true,  //令牌验证出错后是否重置令牌 默认为true
    
    /* 文档模型配置 (文档模型核心配置，请勿更改) */
    'DOCUMENT_MODEL_TYPE' => array(2 => '主题', 1 => '目录', 3 => '段落'),
    
    /****************************************************后台上传配置************************************************************/
	
	'WEB_UPLOADER'         =>array(
		'server'=>array(
		
			'uploadDir' => 'Uploads/uploads',//上传文件存放目录,须以根目录'/'开头

			'uploadDirTemp' => 'Uploads/uploads_temp',//上传文件存放目录
			
		),
		//客户端配置
		'client' => array(
	
			'swf' => '/webuploader/js/Uploader.swf',//引用swf地址
			
			'server' => 'Uploader/webuploader',//处理上传的地址
			
			'filelistPah' => 'Uploader/uploaderList',//获取文件列表的地址
			
			'delPath' => 'Uploader/uploaderdel',//删除文件的地址
	
			'chunked' => true,//是否对文件块大小进行检测

			'chunkSize' => 512 * 1024,//文件块大小限制

			'fileNumLimit' => 300,//同时上传的文件个数限制

			'fileSizeLimit' => 400 * 1024 * 1024,//总文件大小限制，单位是Byte(200M)

			'fileSingleSizeLimit' => 40 * 1024 * 1024,//单个文件大小限制，单位是Byte(2M)

			/*
			
			'runtimeOrder' => 'flash', //统一使用flash上传
			
			'accept' => array(上传的文件类型限制
			     
				'title' => 'Images',    //上传的文件类型说明
			     
				'extensions' => 'gif,jpg,jpeg,bmp,png',   //上传的文件类型,你也可以填你需要的文件类型，如果有多个类型的话，中间加上","即可，如extensions => 'gif,jpg,jpeg,bmp,png'
			     
				'mimeTypes' => 'image/*'   //mime类型说明
	
			),
	
			*/
	
			'fileVal' => 'file',//服务端接收文件的键值，相当于<input type="file" name="file" />中name="file"，默认file
	
			'auto' => false,//是否选择完后自动上传
	
			'formData' => array(//传给服务端的额外数据
				
//				's' => session_id()//用于浏览器的session丢失
			
			),
	
			'pick' => array(
	
				'id' => '#filePicker',
	
				'label' => '点击选择文件',
	
				'name' => 'file'
			
			),
	
//			'thumb' => array(
	
//				'width' => 110,
	
//	            'height' => 110,
	
	            // 图片质量，只有type为`image/jpeg`的时候才有效。
//	            'quality' => 70,
	
	            // 是否允许放大，如果想要生成小图的时候不失真，此选项应该设置为false.
//	            'allowMagnify' => false,
	
	            // 是否允许裁剪。
//	            'crop' => true,
	
	            // 是否保留头部meta信息。
//	            'preserveHeaders' => false,
	
	            // 为空的话则保留原有图片格式。
	            // 否则强制转换成指定的类型。
//	            'type' => 'image/jpeg'
	
//			)
		)		
	)
);